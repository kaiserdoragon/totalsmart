<?php

/**
 * OGP を echo する
 */
if (!function_exists('ts_ogp_clean_description')) {
  function ts_ogp_clean_description($text, $limit = 160)
  {
    $charset = get_bloginfo('charset') ?: 'UTF-8';
    $text = html_entity_decode((string) $text, ENT_QUOTES, $charset);
    $text = wp_strip_all_tags(strip_shortcodes($text));
    $text = preg_replace('/\s+/u', ' ', $text);
    $text = trim((string) $text);

    if ($text === '') {
      return '';
    }

    if (function_exists('mb_strimwidth')) {
      return mb_strimwidth($text, 0, $limit, '...', 'UTF-8');
    }

    return wp_trim_words($text, $limit, '...');
  }
}

function output_ogp()
{
  global $post, $wp;

  # デフォルト値（トップページ）
  $og_site_name   = get_bloginfo('name');
  $og_title       = get_bloginfo('name');
  $og_type        = 'website';
  $og_url         = home_url();
  $og_image       = get_template_directory_uri() . '/img/ogp.png'; //できるだけpng
  $og_description = get_bloginfo('description');
  $og_description_override = isset($GLOBALS['ts_meta_description_override'])
    ? (string) $GLOBALS['ts_meta_description_override']
    : '';
  $has_og_description_override = '' !== trim($og_description_override);

  if ($has_og_description_override) {
    $og_description = $og_description_override;
  } elseif (!is_front_page()) {
    //TOPページ以外は、og_titleに「ページのタイトル|サイト名」
    //og_urlに現在のページのURLを入れる
    //og_descriptionにページ名＋基本のdescriptionの文章を入れる
    $og_title       = trim(wp_title('', false)) . '|' . get_bloginfo('name');
    $og_url = home_url($wp->request);
    $og_description = get_bloginfo('name') . 'の' . trim(wp_title('', false)) . 'のページです。' . get_bloginfo('description');
  }

  if (is_singular()) {
    //投稿 or 固定ページの時は og_typeをarticleにする
    $og_type = 'article';
    setup_postdata($post);
    if (is_single() && !$has_og_description_override) {
      $post_id = get_queried_object_id();
      $description_source = function_exists('ts_get_custom_seo_description')
        ? ts_get_custom_seo_description($post_id)
        : '';

      if ('' === trim((string) $description_source)) {
        $description_source = get_post_field('post_excerpt', $post_id);
      }

      if ('' === trim((string) $description_source)) {
        $description_source = get_post_field('post_content', $post_id);
      }

      //本文データのある記事ページなら、あれば記事の本文抜粋を入れる
      $clean_description = ts_ogp_clean_description($description_source, 160);
      if ($clean_description !== '') {
        $og_description = $clean_description;
      }
    }
    if (is_single() && has_post_thumbnail()) {
      //アイキャッチ画像のある記事ページなら、og_imageにはアイキャッチ画像を入れる
      $og_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')[0];
    }
    wp_reset_postdata();
  }

  //管理画面以外のとき、以下のコードを出力
  $og_description = ts_ogp_clean_description($og_description, 160);

  if (!is_admin()): ?>
    <meta property="og:title" content="<?php echo esc_attr($og_title); ?>">
    <meta property="og:type" content="<?php echo $og_type; ?>" />
    <meta property="og:url" content="<?php echo esc_url($og_url); ?>">
    <meta property="og:image" content="<?php echo esc_url($og_image); ?>">
    <meta property="og:description" content="<?php echo esc_attr($og_description); ?>">
    <meta property="og:site_name" content="<?php echo esc_attr($og_site_name); ?>">
<?php endif;
}

// <head> 要素に追加
add_action('wp_head', 'output_ogp');
