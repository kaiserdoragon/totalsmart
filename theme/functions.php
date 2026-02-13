<?php
load_theme_textdomain('origintheme', get_template_directory() . '/languages');

// -------------------------------------
// セキュリティヘッダーの送信
// -------------------------------------

function add_security_headers()
{
  if (!is_admin()) {
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: SAMEORIGIN");
    header("X-XSS-Protection: 1; mode=block");
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
  }
}
add_action('send_headers', 'add_security_headers');



// -------------------------------------
// 	headからいらない項目を削除する
// -------------------------------------

function removed_scripts_styles()
{
  if (!is_admin()) {
    remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);
    remove_action('wp_head', 'www-widgetapi');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    add_filter('emoji_svg_url', '__return_false');
  }
}
add_action('wp_enqueue_scripts', 'removed_scripts_styles');


// -------------------------------------
// 		絵文字無効化
// -------------------------------------

add_action('init', function () {
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('admin_print_styles', 'print_emoji_styles');
  add_filter('tiny_mce_plugins', function ($plugins) {
    return is_array($plugins) ? array_diff($plugins, ['wpemoji']) : [];
  });
  add_filter('wp_mail', 'wp_staticize_emoji_for_email'); // 必要なら外す
});



// -------------------------------------
//　oEmbed のJS（wp-embed.min.js）を読み込ませない
// -------------------------------------

add_action('wp_footer', function () {
  wp_dequeue_script('wp-embed');
}, 100);


// -------------------------------------
//　管理用アイコン（dashicons）をフロントで読み込まない
// -------------------------------------

add_action('wp_enqueue_scripts', function () {
  if (! is_user_logged_in()) {
    wp_deregister_style('dashicons');
  }
});


// -------------------------------------
//　Gutenberg用のCSSを読み込まない
// -------------------------------------

function my_delete_plugin_files()
{
  //IDを指定し解除
  wp_deregister_style('wp-block-library');
}
add_action('wp_enqueue_scripts', 'my_delete_plugin_files');


// -------------------------------------
//　外部のファイル・モジュールの読み込み External files
// -------------------------------------

//カスタムブロック呼び出し
require_once locate_template('block/functions-include.php', true);

// 初期にインストールさせるプラグイン設定
require_once locate_template('settings/tgmpa.php', true);

// OGP設定
require_once locate_template('settings/ogp.php', true);

// あまり変更しない触らない関数たち（ウィジェットなど）
require_once locate_template('settings/settings-import.php', true);

// 通常投稿にサンプル投稿を自動追加
require_once locate_template('settings/sample-post.php', true);


// -------------------------------------
//　テーマ機能設定 add_theme_support
// -------------------------------------

if (!isset($content_width)) {
  $content_width = 1000; //テーマ内任意のoEmbedsや画像の最大許容幅
}


// -------------------------------------
//　画像のサムネイルサイズ設定 post-thumbnails
// -------------------------------------

if (function_exists('add_theme_support')) {


  // アップロード画像のサムネイル設定
  add_theme_support('post-thumbnails');

  // 特定の大きさのサムネイルが必要なとき用使い方→ the_post_thumbnail('custom-size');
  add_image_size('custom-size', 300, 200, true); // 任意の数値を設定

  add_image_size('info-thumb', 345, 220, true);

  add_image_size('service-thumb', 212, 212, true);

  add_image_size('works-thumb', 352, 308, true);



  //タイトルタグ使用をサポート（wp_headに自動でtitleタグが入ります）
  add_theme_support('title-tag');
  //タイトルタグ内のセパレーター設定
  function custom_document_title_separator($sep)
  {
    return '|';
  }

  add_filter('document_title_separator', 'custom_document_title_separator');
  //タイトルタグ内にサイトの説明文を表示させない
  function edit_document_title_parts($title)
  {
    unset($title['tagline']);
    return $title;
  }

  add_filter('document_title_parts', 'edit_document_title_parts');
}



// -------------------------------------
//　読み込まれるcss関連
// -------------------------------------

add_action('wp_enqueue_scripts', function () {

  $lp_pages = ['cleaninglp', 'shuurilp', 'cleaning_thanks', 'shuuri_thanks'];
  $is_lp    = is_page($lp_pages);

  $uri  = fn($file) => get_theme_file_uri($file);
  $path = fn($file) => get_theme_file_path($file);

  $enqueue = function ($handle, $file, $deps = [], $media = 'all') use ($uri, $path) {
    $p = $path($file);
    if (!file_exists($p)) return;
    wp_enqueue_style($handle, $uri($file), $deps, (string) filemtime($p), $media);
  };

  // ─────────────────────────────
  // 全体CSSだけ（LPには適応されない）
  // ─────────────────────────────
  if (!$is_lp) {
    $enqueue('mytheme-reset',      'css/reset.css', []);
    $enqueue('mytheme-swiper',     'css/swiper-bundle.min.css', ['mytheme-reset']);
    $enqueue('mytheme-scrollhint', 'css/scroll-hint.css',        ['mytheme-reset']);
    $enqueue('mytheme-theme',      'style.css', ['mytheme-reset', 'mytheme-swiper', 'mytheme-scrollhint']);
    $enqueue('mytheme-custom',     'css/style.css', ['mytheme-theme']);
    return;
  }

  // ─────────────────────────────
  // LP専用CSSだけ（クリーニング、修理など）
  // ─────────────────────────────
  if (is_page(['cleaninglp', 'cleaning_thanks'])) {
    $folder = 'cleaninglp';

    $enqueue('lp-cleaning-reset',      "{$folder}/css/reset.css", []);
    $enqueue('lp-cleaning-scrollhint', "{$folder}/css/scroll-hint.css", ['lp-cleaning-reset']);
    $enqueue('lp-cleaning-main',       "{$folder}/css/style.css", ['lp-cleaning-reset', 'lp-cleaning-scrollhint']);

    return;
  }

  if (is_page(['shuurilp', 'shuuri_thanks'])) {
    $folder = 'shuurilp';

    $enqueue('lp-shuuri-reset', "{$folder}/css/reset.css", []);
    $enqueue('lp-shuuri-main',  "{$folder}/css/style.css", ['lp-shuuri-reset']);

    return;
  }
}, 20);


// -------------------------------------
//　type='text/css' を削除（任意・微小な省バイト）
// -------------------------------------

add_filter('style_loader_tag', function ($tag) {
  return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}, 9);


// -------------------------------------
//　非クリティカルCSSを非ブロッキング化（プリロード + noscript）
// -------------------------------------

add_filter('style_loader_tag', function ($html, $handle, $href, $media) {
  if (is_admin()) return $html;

  // 本当に初期描画に必要なものだけを列挙
  // 例: "custom" はUI調整が多く初期描画に関与しがち
  $preload_handles = ['custom'];

  if (!in_array($handle, $preload_handles, true)) {
    return $html; // それ以外は通常のブロッキングCSSとして読み込み
  }

  $orig  = trim($html);
  $href  = esc_url($href);
  $id    = esc_attr("{$handle}-css");
  $media = $media ? ' media="' . esc_attr($media) . '"' : '';

  // rel=preload で先に取得し、onloadで stylesheet に切替
  // JS無効時は <noscript> でフォールバック
  return "<link rel=\"preload\" id=\"{$id}\" href=\"{$href}\" as=\"style\" onload=\"this.onload=null;this.rel='stylesheet'\"{$media}>\n"
    . "<noscript>{$orig}</noscript>\n";
}, 10, 4);


// -------------------------------------
//　読み込まれるjs関連
// -------------------------------------

// LP（特定のスラッグ）により条件判定させてJSを読み込み準備をする
if (!function_exists('theme_is_lp_page')) {
  function theme_is_lp_page()
  {
    return is_page(array('cleaninglp', 'shuurilp', 'cleaning_thanks', 'shuuri_thanks'));
  }
}

if (!function_exists('theme_enqueue_js_only_optimized_assets')) {

  function theme_enqueue_js_only_optimized_assets()
  {

    // 管理画面・ログイン・REST/AJAX/cron・WP-CLI 等には影響させない
    if (
      is_admin()
      || (defined('WP_CLI') && WP_CLI)
      || (isset($GLOBALS['pagenow']) && $GLOBALS['pagenow'] === 'wp-login.php')
      || (function_exists('wp_doing_ajax') && wp_doing_ajax())
      || (function_exists('wp_is_serving_rest_request') && wp_is_serving_rest_request())
      || (function_exists('wp_doing_cron') && wp_doing_cron())
    ) {
      return;
    }

    // 子テーマ互換：stylesheet_* を使う
    $theme_dir = get_stylesheet_directory();
    $theme_uri = get_stylesheet_directory_uri();

    // 共通ヘルパー：ローカルJSを（存在すれば）登録・enqueue
    $register_local_script = function ($handle, $relative_path, $deps = array(), $strategy = 'defer') use ($theme_dir, $theme_uri) {
      $relative_path = ltrim($relative_path, '/');
      $full_path     = $theme_dir . '/' . $relative_path;

      if (!file_exists($full_path)) {
        return false;
      }

      $src = $theme_uri . '/' . $relative_path;
      $ver = filemtime($full_path);

      wp_register_script($handle, $src, $deps, $ver, true);

      // WP 6.3+ の loading strategy（旧版では無害に無視される）
      if (!empty($strategy) && function_exists('wp_script_add_data')) {
        wp_script_add_data($handle, 'strategy', $strategy);
      }

      wp_enqueue_script($handle);
      return true;
    };

    // ===== LPページ：全体JSを読まない。LP専用だけ読む =====
    if (theme_is_lp_page()) {

      // LPグループ判定（thanks も同フォルダ運用）
      $folder = '';
      if (is_page(array('cleaninglp', 'cleaning_thanks'))) {
        $folder = 'cleaninglp';
      } elseif (is_page(array('shuurilp', 'shuuri_thanks'))) {
        $folder = 'shuurilp';
      } else {
        return;
      }

      // 1) LP用 scroll-hint（ローカルのみ。CDNは使わない）
      $scrollhint_handle = "lp-{$folder}-scrollhint";
      $scrollhint_loaded = $register_local_script(
        $scrollhint_handle,
        "{$folder}/js/scroll-hint.min.js",
        array(),
        'defer'
      );

      // 2) LP用メインJS（scroll-hint がある時だけ依存に入れる）
      $deps = array('jquery');
      if ($scrollhint_loaded) {
        $deps[] = $scrollhint_handle;
      }

      $register_local_script(
        "lp-{$folder}-scripts",
        "{$folder}/js/scripts.js",
        $deps,
        'defer'
      );

      return;
    }

    // ===== 全体JS（※LP以外でのみ読み込み）=====
    $register_local_script('swiperjs',     'js/swiper-bundle.min.js', array(), 'defer');
    $register_local_script('scrollhint',   'js/scroll-hint.min.js',   array(), 'defer');
    $register_local_script('mainscripts',  'js/scripts.js',           array('jquery'), 'defer');
    $register_local_script('animationjs',  'js/animation.js',         array('jquery'), 'defer');
    $register_local_script('slider',       'js/slider.js',            array('jquery', 'swiperjs'), 'defer');
    $register_local_script('mokujijs',  'js/mokuji.js',         array('jquery'), 'defer');

    if (is_front_page()) {
      $register_local_script('loadinganimation', 'js/loadinganimation.js', array('jquery'), 'defer');
    }
  }

  add_action('wp_enqueue_scripts', 'theme_enqueue_js_only_optimized_assets', 20);


  /**
   * scriptタグへ defer を付与（全体JSのみ）
   */
  function theme_add_defer_attribute_safe($tag, $handle, $src)
  {

    global $wp_version;
    if (isset($wp_version) && version_compare($wp_version, '6.3', '>=')) {
      return $tag;
    }

    if (
      is_admin()
      || (function_exists('wp_doing_ajax') && wp_doing_ajax())
      || (function_exists('wp_is_serving_rest_request') && wp_is_serving_rest_request())
      || (function_exists('wp_doing_cron') && wp_doing_cron())
    ) {
      return $tag;
    }

    // defer を付けたくないハンドル
    $exclude_handles = array(
      'jquery',
      'jquery-core',
      'jquery-migrate',
      'wp-emoji-release',
      'wp-embed',
    );
    if (in_array($handle, $exclude_handles, true)) {
      return $tag;
    }

    // defer を付けたいハンドル（全体JSのみ）
    $defer_handles = array('mainscripts', 'slider', 'animationjs', 'swiperjs', 'loadinganimation', 'scrollhint', 'mokujijs');
    if (!in_array($handle, $defer_handles, true)) {
      return $tag;
    }

    if (
      stripos($tag, ' defer') !== false
      || stripos($tag, ' async') !== false
      || preg_match('/\btype\s*=\s*[\'"]module[\'"]/i', $tag)
    ) {
      return $tag;
    }

    return preg_replace('/<script(\s)/i', '<script defer$1', $tag, 1);
  }

  add_filter('script_loader_tag', 'theme_add_defer_attribute_safe', 10, 3);
}


// -------------------------------------
//   管理画面で変更可能なメニュー機能
// -------------------------------------

// メニューの場所名登録（管理画面に表示する名前）
function register_menu()
{
  register_nav_menus(array( //メニューを追加する場合は行を追加
    'global-menu' => "グローバルナビゲーション",
  ));
}

add_action('init', 'register_menu'); // Add HTML5 Blank Menu

// 出力されるメニューのHTMLタグ設定 add_globalmenu();をテンプレート側に書いて表示
function add_globalmenu()
{
  wp_nav_menu(array(
    'theme_location' => 'global-menu', //メニューの位置（どのメニューか）
    'menu' => '',
    'container' => 'nav', // ulを囲う要素を指定。div or nav。なしの場合には false
    'container_class' => '', // containerに適用するCSSクラス名
    'container_id' => 'gnav', // コンテナに適用するCSS ID名
    'menu_class' => '', // メニューを構成するul要素につけるCSSクラス名
    'fallback_cb' => 'wp_page_menu', // メニューが存在しない場合にコールバック関数を呼び出す
    'before' => '', // メニューアイテムのリンクの前に挿入するテキスト
    'after' => '', // メニューアイテムのリンクの後に挿入するテキスト
    'echo' => true, // メニューをHTML出力する（true）かPHPの値で返す（false）か
    'depth' => 1, // 何階層まで表示するか。0は全階層、1は親メニューまで、2は子メニューまで…という感じ
    'walker' => '', // カスタムウォーカーを使用する場合
  ));
}


// -------------------------------------
//  投稿機能設定 post functions
// -------------------------------------

// ====== newsを通常投稿のアーカイブページにする ======
/*
 * 投稿にアーカイブ(投稿一覧)を持たせるようにします。
 * ※ 記載後にパーマリンク設定で「変更を保存」してください。
 */
function post_has_archive($args, $post_type)
{
  if ('post' == $post_type) {
    $args['rewrite'] = true;
    $args['has_archive'] = 'news'; // ページ名
  }
  return $args;
}

add_filter('register_post_type_args', 'post_has_archive', 10, 2);
// 投稿記事のURLに/news/を含めたい場合は https://yamatonamiki.com/blog/178/ 参照の上用変更

// ページネーション表示
function wp_pagination()
{
  global $wp_query;
  $big = 999999999;
  echo paginate_links(array('base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))), 'format' => '?paged=%#%', 'current' => max(1, get_query_var('paged')), 'prev_text' => '<span>≪</span>', 'next_text' => '<span>≫</span>', 'total' => $wp_query->max_num_pages));
}

add_action('init', 'wp_pagination');


// -------------------------------------
//  抜粋表示設定 the_excerpt();
// -------------------------------------
remove_filter('the_excerpt', 'wpautop'); // 自動挿入のpタグを抜粋欄から消す

// 抜粋表示時のリンク表示を設定
function custom_view_more($more)
{
  global $post;
  return '<a class="link_more" href="' . get_permalink($post->ID) . '">' . '' . '</a>';
}

add_filter('excerpt_more', 'custom_view_more');

// 抜粋文字数設定（不具合時は WP Multibyte Patch プラグインを入れる）
function custom_excerpt_length($length)
{
  return 40; //単語数：日本語の場合は2倍の文字数
}

add_filter('excerpt_length', 'custom_excerpt_length', 999);


// -------------------------------------
//  プラグイン関連設定  settings for plugin
// -------------------------------------

if (function_exists('bcn_display_list')) {

  // デフォルトのHOMEパンくずを除去（HOMEが最後に入っている前提）
  add_action('bcn_after_fill', 'foo_pop');
  function foo_pop($trail)
  {
    array_pop($trail->breadcrumbs);
  }

  // 静的にパンくずを追加／特定固定ページは作り直す
  add_action('bcn_after_fill', 'my_static_breadcrumb_adder');
  function my_static_breadcrumb_adder($breadcrumb_trail)
  {

    // ---- ここから：ご希望の固定ページフロー（TOP > ○○ のみ） ----
    if (is_page()) {
      $page_id = get_queried_object_id();
      $slug    = $page_id ? get_post_field('post_name', $page_id) : '';

      // thanks / confirm / contact_ の優先順（slugが複合するケース対策）
      $label = '';
      if ($slug !== '') {
        if (strpos($slug, 'thanks') !== false) {
          $label = 'お問い合わせありがとうございました';
        } elseif (strpos($slug, 'confirm') !== false) {
          $label = '確認画面';
        } elseif (strpos($slug, 'contact_') !== false) {
          $label = 'お問い合わせ';
        }
      }

      if ($label !== '') {
        // いったん全消しして、2階層だけ作り直す（空のままreturnしない）
        $breadcrumb_trail->breadcrumbs = array();

        // 現在ページ（リンクなし）
        // bcn_breadcrumb は引数末尾で linked を指定できる（例: trueでリンクあり） :contentReference[oaicite:3]{index=3}
        $breadcrumb_trail->add(
          new bcn_breadcrumb($label, null, array('page'), null, null, false)
        );

        // TOP（リンクあり）※最後にaddすると表示上は先頭（TOP）になりやすい
        $breadcrumb_trail->add(
          new bcn_breadcrumb(
            'TOP',
            '<a title="%title%." href="%link%">%htitle%</a>',
            array('home'),
            home_url('/'),
            null,
            true
          )
        );
        return;
      }
    }


    // 既存：投稿詳細／カテゴリ／タグに「お知らせ」を挿入
    if (is_singular('post') || is_category() || is_tag()) {
      $breadcrumb_trail->add(
        new bcn_breadcrumb(
          'お知らせ',
          '<a title="%title%." href="%link%">%htitle%</a>',
          array(),
          home_url('/news/'),
          null,
          true
        )
      );
    }

    // 1つめ（常に表示されるTOP）
    $breadcrumb_trail->add(
      new bcn_breadcrumb(
        'TOP',
        '<a title="%title%." href="%link%">%htitle%</a>',
        array('home'),
        home_url('/'),
        null,
        true
      )
    );
  }
}

// ---------------------------------------------
//  投稿タイプごとに一覧・アーカイブページにて表示件数を変更する
// ---------------------------------------------

function my_customize_query_total_posts($query)
{
  // 管理画面、またはメインクエリではない場合は何もしない
  if (is_admin() || ! $query->is_main_query()) {
    return;
  }

  // 対象とする投稿タイプ
  $post_types = ['question', 'information', 'introduction', 'post'];

  if (is_post_type_archive($post_types) || is_home() || is_category()) {
    $query->set('posts_per_page', 9);
  }
}
add_action('pre_get_posts', 'my_customize_query_total_posts');


// ---------------------------------------------
//  カスタム追加設定 additional functions
// ---------------------------------------------

function categories_label()
{
  global $post;

  // 1. 設定マップ：投稿タイプ => [タクソノミー名, 追加クラス名]
  $post_type_settings = [
    'introduction' => [
      'taxonomy'    => 'introduction_cat',
      'extra_class' => 'introduction_cat'
    ],
    'information'  => [
      'taxonomy'    => 'information_cat',
      'extra_class' => 'information_cat'
    ],
    'question'  => [
      'taxonomy'    => 'question_cat',
      'extra_class' => 'question_cat'
    ],
    // 新しい投稿タイプが増えたらここに行を追加するだけ
    // 'gallery' => ['taxonomy' => 'gallery_cat', 'extra_class' => 'gallery_cat'],
  ];

  // 2. 現在の投稿タイプ設定を取得（未登録ならデフォルトの「category/news_cat」を使用）
  $current_type = get_post_type($post);
  $setting = isset($post_type_settings[$current_type])
    ? $post_type_settings[$current_type]
    : ['taxonomy' => 'category', 'extra_class' => 'news_cat'];

  $taxonomy    = $setting['taxonomy'];
  $extra_class = $setting['extra_class'];

  // 3. タームの取得
  $terms = get_the_terms($post->ID, $taxonomy);

  if (!$terms || is_wp_error($terms)) {
    return;
  }

  // 4. 親カテゴリーが先に来るように並び替え
  usort($terms, function ($a, $b) {
    return $a->parent - $b->parent;
  });

  // 5. HTML出力
  $output = '';
  foreach ($terms as $term) {
    $class_attr = sprintf('cat_label cat_%s %s', esc_attr($term->slug), esc_attr($extra_class));
    $term_link  = get_term_link($term);

    $output .= sprintf(
      '<li><a href="%s" class="%s">%s</a></li>',
      esc_url($term_link),
      $class_attr,
      esc_html($term->name)
    );
  }

  echo $output;
}

// ---------------------------------------------
//  カスタム投稿表示件数変更
// ---------------------------------------------
// function change_posts_per_page($query) {
//   if ( is_admin() || ! $query->is_main_query() )
//       return;
//   if ( $query->is_post_type_archive('post') ) {  // カスタム投稿タイプを指定
//       $query->set( 'posts_per_page', '10' );  // 表示件数を指定
//   }
// }
// add_action( 'pre_get_posts', 'change_posts_per_page' );


// -------------------------------------
// お知らせページ名称変更
// -------------------------------------
function custom_gettext($translated, $text, $domain)
{
  $custom_translates = array(
    'default' => array(
      '投稿' => 'お知らせ',
      '投稿編集' => 'お知らせ編集',
      '投稿一覧' => 'お知らせ一覧',
      '投稿を検索' => 'お知らせを検索',
      '投稿を表示' => 'お知らせを表示',
      '投稿は見つかりませんでした。' => 'お知らせは見つかりませんでした。',
      'ゴミ箱内に投稿が見つかりませんでした。' => 'ゴミ箱内にお知らせは見つかりませんでした。',
      '投稿を更新しました。<a href="%s">投稿を表示する</a>' => 'お知らせを更新しました。<a href="%s">お知らせを表示する</a>',
      'この投稿を先頭に固定表示' => 'このお知らせを先頭に固定表示'
    )
  );
  if (isset($custom_translates[$domain][$translated])) {
    $translated = $custom_translates[$domain][$translated];
  }
  return $translated;
}

add_filter('gettext', 'custom_gettext', 10, 3);

function trans_custom_gettext()
{
  $args = func_get_args();
  $translated = $args[0];
  $text = $args[1];
  $domain = array_pop($args);
  $translated = custom_gettext($translated, $text, $domain);
  return $translated;
}

add_filter('gettext_with_context', 'trans_custom_gettext', 10, 4);
add_filter('ngettext', 'trans_custom_gettext', 10, 5);
add_filter('ngettext_with_context', 'trans_custom_gettext', 10, 6);


// -------------------------------------
// ショートコードでphpファイルを呼び出す
// -------------------------------------
// includeフォルダ内にphpを追加　例）include/shortcode.php
// [myphp file="shortcode.php"]を記述
function Include_my_php($params = array())
{
  extract(shortcode_atts(array(
    'file' => 'default'
  ), $params));
  ob_start();
  include(get_theme_root() . '/' . get_template() . "/include/$file.php");
  return ob_get_clean();
}
add_shortcode('myphp', 'Include_my_php');



// -------------------------------------
// Snow Monkey Form 送信完了後にサンクスページへリダイレクト
// -------------------------------------
add_action(
  'wp_enqueue_scripts',
  function () {
    // セキュリティ: 管理画面では実行しない
    if (is_admin()) {
      return;
    }

    // JavaScriptコードをバッファリング開始
    ob_start();
?>
  <script>
    window.addEventListener(
      'load', // ページ全体の読み込み完了後に実行
      function() {
        // 対象のフォーム要素を取得（'snow-monkey-form-9' の部分は実際のフォームIDに合わせてください）
        const form = document.getElementById('snow-monkey-form-9');

        // フォーム要素が存在する場合のみ処理を実行
        if (form) {
          // Snow Monkey Forms の送信イベントを監視
          form.addEventListener(
            'smf.submit', // Snow Monkey Forms が発行するカスタムイベント
            function(event) {
              // セキュリティ: イベントオブジェクトの検証
              if (!event || !event.detail || typeof event.detail.status !== 'string') {
                return;
              }

              // 送信ステータスが 'complete' (完了) の場合のみ処理を実行
              if ('complete' === event.detail.status) {
                // 指定したサンクスページへリダイレクト
                // '/thanks/' の部分は実際のサンクスページのスラッグ等に合わせてください
                window.location.href = '<?php echo esc_url(home_url("/thanks/")); ?>';
              }
            }
          );
        }
      }
    );
  </script>
  <?php
    // バッファリングしたJavaScriptコードを取得
    $data = ob_get_clean();

    // セキュリティ: データの検証
    if (empty($data)) {
      return;
    }

    // <script> タグを除去（wp_add_inline_script が自動で追加するため）
    $data = str_replace(['<script>', '</script>'], '', $data);

    // snow-monkey-forms スクリプトの後に追加
    wp_add_inline_script(
      'snow-monkey-forms', // Snow Monkey Forms のスクリプトハンドル名
      $data,
      'after' // snow-monkey-forms スクリプトの後に出力
    );
  },
  11 // 優先度を少し高く設定 (デフォルトは10)
);


// -------------------------------------
// YubinBangoライブラリ（郵便番号と住所連動）
// -------------------------------------
wp_enqueue_script('yubinbango', 'https://yubinbango.github.io/yubinbango/yubinbango.js', array(), null, true);



// ---------------------------------------------------------
// サービス一覧（service）ページの並び替えの制御と表示件数の制御
// ---------------------------------------------------------
add_action('pre_get_posts', function ($q) {
  if (is_admin() || !$q->is_main_query()) return;

  // archive-service.php（post_type=service のアーカイブ）だけ
  if ($q->is_post_type_archive('service')) {
    $q->set('posts_per_page', 15);

    // 並び替え用SQLを追加
    add_filter('posts_clauses', 'service_archive_orderby_service_cat_description', 10, 2);
  }
});

function service_archive_orderby_service_cat_description($clauses, $q)
{
  if (is_admin() || !$q->is_main_query() || !$q->is_post_type_archive('service')) {
    return $clauses;
  }

  global $wpdb;

  // service_cat の term_taxonomy.description を join
  $clauses['join'] .= "
    LEFT JOIN {$wpdb->term_relationships} AS tr_sc
      ON ({$wpdb->posts}.ID = tr_sc.object_id)
    LEFT JOIN {$wpdb->term_taxonomy} AS tt_sc
      ON (tr_sc.term_taxonomy_id = tt_sc.term_taxonomy_id AND tt_sc.taxonomy = 'service_cat')
  ";

  // 1投稿=複数タームでも壊れないように集約（1投稿=1ターム運用ならそのままでOK）
  $clauses['fields']  .= ", MIN(tt_sc.description) AS service_cat_desc";
  $clauses['groupby'] = "{$wpdb->posts}.ID";

  // NULL（ターム未設定）を後ろにしたい場合
  $clauses['orderby'] = "
    (service_cat_desc IS NULL) ASC,
    service_cat_desc ASC,
    {$wpdb->posts}.post_date DESC
  ";

  // description を数字で運用しているなら、上の orderby をこれに置換（01,02…運用でもOK）
  // $clauses['orderby'] = "CAST(service_cat_desc AS UNSIGNED) ASC, {$wpdb->posts}.post_date DESC";

  return $clauses;
}


// -------------------------------------
// よくある質問のリアルタイム検索機能
// -------------------------------------


add_action('wp_enqueue_scripts', function () {

  if (is_post_type_archive('question') || is_tax('question_cat') || is_page('question')) {

    $rel_path  = '/js/question-live-search.js';
    $file_path = get_theme_file_path($rel_path);
    $ver       = file_exists($file_path) ? filemtime($file_path) : false;

    wp_enqueue_script(
      'question-live-search',
      get_theme_file_uri($rel_path),
      [],
      $ver,   // nullにしない（キャッシュが残りやすい） :contentReference[oaicite:6]{index=6}
      true
    );

    $term_slug = '';
    if (is_tax('question_cat')) {
      $qo = get_queried_object();
      $term_slug = !empty($qo->slug) ? $qo->slug : '';
    }

    wp_localize_script('question-live-search', 'QuestionSearch', [
      'ajaxurl' => admin_url('admin-ajax.php'),
      'nonce'   => wp_create_nonce('question_search'),
      'term'    => $term_slug,
      // JS側の挙動調整用
      'minLen'  => 1,
      'limit'   => 30,
    ]);
  }
});


// ===== リアルタイム検索：AJAX受け口 =====
add_action('wp_ajax_question_live_search', 'question_live_search');
add_action('wp_ajax_nopriv_question_live_search', 'question_live_search');

function question_live_search()
{
  check_ajax_referer('question_search', 'nonce'); // nonce検証 :contentReference[oaicite:8]{index=8}

  $keyword = isset($_POST['keyword']) ? sanitize_text_field(wp_unslash($_POST['keyword'])) : '';
  $term    = isset($_POST['term'])    ? sanitize_text_field(wp_unslash($_POST['term']))    : '';

  $keyword = trim($keyword);

  // 超短時間キャッシュ（同じ検索語の連打対策）
  $cache_key = 'q_live_' . md5($term . '|' . $keyword);
  $cached = get_transient($cache_key);
  if ($cached !== false) {
    wp_send_json_success(['html' => $cached]); // JSON返して終了 :contentReference[oaicite:9]{index=9}
  }

  $args = [
    'post_type'              => 'question',
    'post_status'            => 'publish',
    'posts_per_page'         => 30,
    'no_found_rows'          => true,
    'ignore_sticky_posts'    => true,
    'update_post_meta_cache' => false,
  ];

  // 空文字なら「最新30件」、キーワードありなら通常検索
  if ($keyword !== '') {
    $args['s'] = $keyword;
  } else {
    $args['orderby'] = 'date';
    $args['order']   = 'DESC';
  }

  if ($term !== '') {
    $args['tax_query'] = [[
      'taxonomy' => 'question_cat',
      'field'    => 'slug',
      'terms'    => $term,
    ]];
  }

  $q = new WP_Query($args);

  ob_start();
  if ($q->have_posts()) {
    while ($q->have_posts()) {
      $q->the_post();
      $terms = get_the_terms(get_the_ID(), 'question_cat');
  ?>
      <li>
        <a href="<?php the_permalink(); ?>">
          <div class="front-news--info">
            <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
              <?php foreach ($terms as $t) : ?>
                <span class="front-news--cat_label -<?php echo esc_attr($t->slug); ?>">
                  <?php echo esc_html($t->name); ?>
                </span>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
          <p><?php echo esc_html(get_the_title()); ?></p>
        </a>
      </li>
<?php
    }
  } else {
    echo '<li class="no-result">該当する記事がありません。</li>';
  }

  wp_reset_postdata();

  $html = ob_get_clean();

  // 60秒だけキャッシュ（必要なら短く/長く調整）
  set_transient($cache_key, $html, 30);

  wp_send_json_success(['html' => $html]); //
}
