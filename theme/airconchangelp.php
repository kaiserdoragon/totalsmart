<?php
/*
Template Name: エアコンの交換・買い替えLP
*/
defined('ABSPATH') || exit;

$page_id  = get_queried_object_id();
$page_url = esc_url_raw(get_permalink($page_id));
$home_url = esc_url_raw(home_url('/'));

$logo_url = esc_url_raw(get_theme_file_uri('airconchangelp/img/logo.png'));
$mv_url   = esc_url_raw(get_theme_file_uri('airconchangelp/img/mv.jpg'));
$page_modified = get_post_modified_time('c', true, $page_id);

// NAP（代表番号）と、広告計測等で使う番号（表示している番号）を分離
$main_tel_local     = '052-932-5450';
$main_tel_intl      = '+81-52-932-5450';

// tel: hrefは数字列（端末互換性重視）に正規化（表示テキストはそのまま）
$main_tel_href     = preg_replace('/[^0-9]/', '', $main_tel_local);     // 0529325450

// SEOプラグインの有無（重複出力回避）
$has_seo_plugin = defined('WPSEO_VERSION') || defined('RANK_MATH_VERSION') || defined('AIOSEO_VERSION');

// このLP専用の検索結果向けタイトル・説明文
$meta_description = '愛知・岐阜・三重・静岡の業務用エアコン交換・入れ替え・買い替え。機器選定、本体販売、撤去・フロン回収、取付工事、試運転まで一括対応。法人・店舗・工場・施設向けに無料でお見積もりします。';
$meta_description = wp_strip_all_tags($meta_description);
if (function_exists('mb_strimwidth')) {
  $meta_description = mb_strimwidth($meta_description, 0, 200, '…', 'UTF-8');
}

$meta_title = '業務用エアコン交換・入れ替え・買い替え｜東海4県対応｜トータルスマート株式会社';

// 表示中のFAQと構造化データを同じ配列から生成し、内容のずれを防ぐ。
$faq_items = [
  [
    'question' => '対応エリアはどこですか？',
    'answer'   => "愛知県・岐阜県・三重県・静岡県の法人・店舗・施設を基本対象としています。\nまずは設置場所をお知らせください。",
  ],
  [
    'question' => 'どのような施設に対応していますか？',
    'answer'   => '店舗、オフィス、工場、倉庫、クリニック、介護施設、商業施設、事務所など、法人・店舗・施設向けの業務用エアコン導入・交換に対応しています。',
  ],
  [
    'question' => '現地調査や見積もりは必要ですか？',
    'answer'   => "業務用エアコンは、機器の馬力や台数だけでなく、配管、電源、搬入経路、室外機の設置場所、既存機器の撤去条件によって費用が変わります。\n事前に型番・設置写真・室外機写真・台数を共有いただけるとスムーズです。",
  ],
  [
    'question' => '業務用エアコンの交換時期を相談できますか？',
    'answer'   => "はい、相談可能です。設置から10年以上経過している場合や、修理を繰り返している場合は、交換を検討するタイミングです。\n使用状況を確認したうえで、交換したほうがよいかをご案内します。",
  ],
  [
    'question' => '修理と交換のどちらがよいか分かりません。',
    'answer'   => "使用年数、故障頻度、修理費用、部品供給の状況、電気代、現在の効き具合などを確認し、修理を続けるべきか、交換・買い替えを検討すべきかを整理します。\nぜひ一度ご相談ください。",
  ],
  [
    'question' => '機種や馬力の選び方が分かりません。',
    'answer'   => "業務用エアコンは、部屋の広さだけで機種を決めると、能力不足や過剰設備につながる場合があります。\n施設の用途、稼働時間、天井高、熱源、利用人数、設置環境を確認し、現場に合った機種・馬力・形状をご提案します。",
  ],
  [
    'question' => '対応できる業務用エアコンの種類は何ですか？',
    'answer'   => "天井カセット形、天井吊形、床置形、壁掛形、ビルトイン形、ダクト形、パッケージエアコンなど、各種業務用エアコンの導入・交換をご相談いただけます。\n現在の機器タイプが分からない場合もお問い合わせください。",
  ],
  [
    'question' => '本体の販売から取付工事までまとめて依頼できますか？',
    'answer'   => "はい、機器選定、本体販売、取付工事、試運転までまとめてご相談いただけます。\n既存機器の交換では、撤去やフロン回収も含めて、現場条件を確認しながらご提案します。",
  ],
  [
    'question' => '営業中の店舗や稼働中の施設でも工事できますか？',
    'answer'   => "工事内容や現場状況によって異なります。営業や業務への影響を抑えられるよう、工事日程や作業時間を確認しながら調整します。\n休日・営業時間外の工事をご希望の場合も事前にご相談ください。",
  ],
  [
    'question' => '他メーカーからの入れ替えもできますか？',
    'answer'   => "はい、他メーカーの業務用エアコンからの入れ替えにも対応しています。\n現在のメーカーや機種を確認し、設置環境や配管・電源の状況に合った交換機種をご提案します。",
  ],
  [
    'question' => '支払い方法やリースは相談できますか？',
    'answer'   => "支払い方法やリースについては、案件内容や条件により確認が必要です。\n導入台数、機器内容、工事範囲、希望時期を確認したうえで、対応可能な方法をご案内します。",
  ],
  [
    'question' => '保証やアフター対応はありますか？',
    'answer'   => "メーカー保証や工事後の対応は、選定する機器や工事内容により異なります。\n正式見積もり時に、保証範囲やアフター対応についてもご案内します。",
  ],
];

$business = array_replace(ts_get_local_business_schema(), [
  '@type' => 'HVACBusiness',
  'logo'  => $logo_url,
  'image' => [$mv_url],
]);

$service = [
  '@type' => 'Service',
  '@id'   => $page_url . '#service',
  'url'   => $page_url,
  'name'  => '業務用エアコンの交換・入れ替え・買い替え工事',
  'serviceType' => '業務用エアコンの機器選定・販売・撤去・フロン回収・取付工事・試運転',
  'description' => $meta_description,
  'provider' => $business,
  'areaServed' => $business['areaServed'],
  'image' => $mv_url,
  'audience' => [
    '@type' => 'BusinessAudience',
    'audienceType' => '法人・店舗・工場・施設',
  ],
];

$faqpage = [
  '@type' => 'FAQPage',
  '@id'   => $page_url . '#faq',
  'mainEntity' => array_map(static function ($item) {
    return [
      '@type' => 'Question',
      'name'  => $item['question'],
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text'  => $item['answer'],
      ],
    ];
  }, $faq_items),
];

if (!empty($page_modified)) {
  $faqpage['dateModified'] = $page_modified;
}

$ld_json = [
  '@context' => 'https://schema.org',
  '@graph' => [$service, $faqpage],
];

// 共通テーマのcanonical・OGPと、このテンプレートの専用タグの重複を防ぐ。
remove_action('wp_head', 'ts_output_fallback_seo_meta', 1);
remove_action('wp_head', 'output_ogp');

if (!$has_seo_plugin) {
  add_filter('pre_get_document_title', static function ($title) use ($meta_title) {
    return $meta_title;
  }, 20);
}

// Service / FAQはページ固有情報のため、SEOプラグインの有無にかかわらず出力する。
add_action('wp_head', static function () use ($ld_json) {
  static $printed = false;
  if ($printed || is_admin()) {
    return;
  }
  $printed = true;

  echo "\n" . '<script type="application/ld+json">'
    . wp_json_encode($ld_json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
    . '</script>' . "\n";
}, 1);

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-TKC4PWHS');
  </script>
  <!-- End Google Tag Manager -->

  <script>
    // ヒートマップ計測は主要コンテンツの読込み完了後に開始する。
    window.addEventListener('load', function() {
      var loadClarity = function() {
        (function(c, l, a, r, i, t, y) {
          c[a] = c[a] || function() {
            (c[a].q = c[a].q || []).push(arguments);
          };
          t = l.createElement(r);
          t.async = 1;
          t.src = 'https://www.clarity.ms/tag/' + i;
          y = l.getElementsByTagName(r)[0];
          y.parentNode.insertBefore(t, y);
        })(window, document, 'clarity', 'script', 'win4k5tt8k');
      };

      if ('requestIdleCallback' in window) {
        window.requestIdleCallback(loadClarity, {
          timeout: 2000
        });
      } else {
        window.setTimeout(loadClarity, 0);
      }
    }, {
      once: true
    });
  </script>

  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <meta name="format-detection" content="telephone=no">

  <link rel="preload" as="image" href="<?php echo esc_url(get_theme_file_uri('airconchangelp/img/mv_sp.avif')); ?>" type="image/avif" media="(max-width: 767px)">
  <link rel="preload" as="image" href="<?php echo esc_url(get_theme_file_uri('airconchangelp/img/mv.avif')); ?>" type="image/avif" media="(min-width: 768px)">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Michroma&family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
  <noscript>
    <link href="https://fonts.googleapis.com/css2?family=Michroma&family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
  </noscript>

  <?php if (!$has_seo_plugin): ?>
    <?php if (!current_theme_supports('title-tag')): ?>
      <title><?php echo esc_html($meta_title); ?></title>
    <?php endif; ?>

    <meta name="description" content="<?php echo esc_attr($meta_description); ?>">
    <link rel="canonical" href="<?php echo esc_url($page_url); ?>">

    <!-- OG（SEOプラグイン導入時は重複回避） -->
    <meta property="og:type" content="website">
    <meta property="og:locale" content="ja_JP">
    <meta property="og:site_name" content="株式会社トータルスマート">
    <meta property="og:title" content="<?php echo esc_attr($meta_title); ?>">
    <meta property="og:description" content="<?php echo esc_attr($meta_description); ?>">
    <meta property="og:url" content="<?php echo esc_url($page_url); ?>">
    <meta property="og:image" content="<?php echo esc_url($mv_url); ?>">
    <meta property="og:image:width" content="5760">
    <meta property="og:image:height" content="3042">
    <meta property="og:image:alt" content="業務用エアコンの交換・入れ替え・買い替えサービス">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr($meta_title); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr($meta_description); ?>">
    <meta name="twitter:image" content="<?php echo esc_url($mv_url); ?>">
  <?php endif; ?>

  <link rel="icon" href="<?php echo esc_url(get_theme_file_uri('/img/icons/favicon.ico')); ?>">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url(get_theme_file_uri('/img/icons/apple-touch-icon.png')); ?>">

  <?php wp_head(); ?>
</head>

<body <?php body_class('airconchangelp'); ?>>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TKC4PWHS"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <?php wp_body_open(); ?>

  <header class="header">
    <div class="contents">
      <div class="header--logo">
        <a href="<?php echo esc_url($page_url); ?>">
          <p>業務用エアコンの交換・取り換え・入れ替え・買い替えは<br>トータルスマート株式会社</p>

          <div class="header--brand">
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/logo.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/logo.webp" type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/logo.png"
                alt="株式会社トータルスマート"
                width="397" height="84"
                decoding="async">
            </picture>
          </div>
        </a>
      </div>

      <div class="header--btns">
        <div class="header--btn-item">
          <a href="tel:<?php echo esc_attr($main_tel_href); ?>" class="cv_button gtm-click-tel">
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/tel.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/tel.webp" type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/tel.png"
                alt="お電話でのご相談はこちら: <?php echo esc_attr($main_tel_local); ?>"
                width="270" height="80"
                decoding="async">
            </picture>
          </a>
        </div>

        <div class="header--btn-item">
          <a href="#contact" class="cv_button gtm-click-mail">
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/mail.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/mail.webp" type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/mail.png"
                alt="メールでお問い合わせ"
                width="270" height="80"
                decoding="async">
            </picture>
          </a>
        </div>
      </div>
    </div>
  </header>

  <main>
    <div class="mv">
      <h1>
        <picture>
          <source
            media="(max-width: 1024px)"
            srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/mv_sp.avif"
            type="image/avif"
            width="750" height="1789">
          <source
            media="(max-width: 1024px)"
            srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/mv_sp.webp"
            type="image/webp"
            width="750" height="1789">
          <source
            media="(max-width: 1024px)"
            srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/mv_sp.jpg"
            width="750" height="1789">

          <source
            srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/mv.avif"
            type="image/avif">
          <source
            srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/mv.webp"
            type="image/webp">

          <img
            src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/mv.jpg"
            alt="業務用エアコンの交換・入れ替え・買い替え。愛知・岐阜・三重・静岡対応"
            width="1920" height="1014"
            fetchpriority="high"
            decoding="async">
        </picture>
      </h1>
    </div>

    <section class="issue">
      <div class="contents">
        <h2>
          業務用エアコンの<br><strong><b><span>不</span><span>調</span></b></strong>や<strong><b><span>老</span><span>朽</span><span>化</span></b></strong>を<br class="is-hidden_sp">そのままにしていませんか？？
        </h2>
        <p>
          業務用エアコンは、故障してから慌てて交換しようとすると、<br class="is-hidden_sp">
          <span>営業停止、従業員や来店客の不快感、</span><br class="is-hidden_sp">
          <span>急な工事費用の発生</span>につながる場合があります。<br class="is-hidden_sp">
          特に店舗・工場・オフィス・施設では、<br class="is-hidden_sp">
          空調トラブルがそのまま事業運営のリスクになります。
        </p>
        <img class="issue--img" src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/issue_catch.png" alt="" width="674" height="520" loading="lazy" decoding="async">

        <div class="issue--inner">
          <picture>
            <source media="(max-width: 767px)" srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/issue_txt_sp.png" width="724" height="175">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/issue_txt.png" alt="こんなお悩みはありませんか？" width="900" height="100" loading="lazy" decoding="async">
          </picture>
          <ul>
            <li>10年以上使用していて、交換時期が分からない</li>
            <li>冷えない・暖まらないなど、空調の効きが悪い</li>
            <li>修理費用が高く、交換するべきか悩んでいる</li>
            <li>電気代が高いので、省エネ型に変えたい</li>
            <li>複数台まとめて入れ替えたい</li>
            <li>新店舗・新事務所に新しいエアコンを導入したい</li>
            <li>どのメーカー・機種・馬力を選べばいいか分からない</li>
            <li>古い機種の撤去やフロン回収までまとめて相談したい</li>
          </ul>
        </div>
      </div>
    </section>

    <section class="solution">
      <div class="contents">
        <div class="solution--inner">
          <h2>
            <picture>
              <source media="(max-width: 1024px)" srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/solution_ttl_sp.png" width="730" height="245">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/solution_ttl.png" alt="そのお悩み、ご相談ください！" width="1194" height="120" loading="lazy" decoding="async">
            </picture>
          </h2>
          <div class="solution--lead">
            <b>業務用エアコンの</b>
            <p class="solution--item"><span>交換</span><span>取り換え</span><span>入れ替え</span><span>買い替え</span></p>は
          </div>
          <p class="solution--strong">
            <strong>トータルスマート株式会社</strong>に<br class="is-hidden_sp">お任せください
          </p>
          <div class="solution--guide">
            <div>
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/solution_txt_1.png" alt="型番やメーカーが分からなくても大丈夫です" width="686" height="163" loading="lazy" decoding="async">
            </div>
            <p>
              現在のエアコンの写真、設置場所、台数、使用年数など、<br class="is-hidden_sp">
              分かる範囲の情報だけでご相談いただけます。<br>
              修理を続けるべきか、交換した方がよいか、<br class="is-hidden_sp">
              現地状況を確認したうえでご案内します。
            </p>
          </div>
          <div class="solution--cv">
            <p>お問い合わせはこちらから</p>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/solution_txt_2.png" alt="まずは無料でご相談ください" width="683" height="59" loading="lazy" decoding="async">
            <div class="header--btns">
              <div class="header--btn-item">
                <a href="tel:<?php echo esc_attr($main_tel_href); ?>" class="cv_button gtm-click-tel">
                  <picture>
                    <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/tel.avif" type="image/avif">
                    <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/tel.webp" type="image/webp">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/tel.png"
                      alt="お電話でのご相談はこちら: <?php echo esc_attr($main_tel_local); ?>"
                      width="487" height="144"
                      loading="lazy"
                      decoding="async">
                  </picture>
                </a>
              </div>

              <div class="header--btn-item">
                <a href="#contact" class="cv_button gtm-click-mail">
                  <picture>
                    <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/mail.avif" type="image/avif">
                    <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/mail.webp" type="image/webp">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/mail.png"
                      alt="メールでお問い合わせ"
                      width="487" height="144"
                      loading="lazy"
                      decoding="async">
                  </picture>
                </a>
              </div>
            </div>
          </div>
          <div class="solution--img">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/solution_catch_01.jpg" alt="" width="400" height="250" loading="lazy" decoding="async">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/solution_catch_02.jpg" alt="" width="400" height="250" loading="lazy" decoding="async">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/solution_catch_03.jpg" alt="" width="400" height="250" loading="lazy" decoding="async">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/solution_catch_04.jpg" alt="" width="400" height="250" loading="lazy" decoding="async">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/solution_catch_05.jpg" alt="" width="400" height="250" loading="lazy" decoding="async">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/solution_catch_06.jpg" alt="" width="400" height="250" loading="lazy" decoding="async">
          </div>
        </div>
      </div>
    </section>

    <section class="service sec">
      <div class="contents">
        <div class="service--ttl">
          <h2>
            <strong>業務用エアコン</strong>の交換・取り換えを<br class="is-hidden_sp">
            機器選定から工事まで一括対応します
          </h2>
        </div>
        <p class="service--lead">
          業務用エアコンの交換・取り換えは本体価格だけでなく、<br class="is-hidden_sp">
          設置場所、馬力、台数、配管、室外機の位置・撤去、フロン回収、<br class="is-hidden_sp">
          工事日程まで確認する必要があります。<br class="is-hidden_sp">
          法人・店舗・施設の状況をヒアリングしたうえで、<br class="is-hidden_sp">
          導入・交換に必要な内容をまとめてご提案します。
        </p>
        <div class="service--inner">
          <article>
            <h3>今のエアコンが<br class="is-hidden_sp"><span>交換時期</span>か確認します</h3>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_icon_01.jpg" alt="" width="250" height="250" loading="lazy" decoding="async">
            <p>
              「まだ修理で使えるのか」<br>
              「今のうちに交換したほうがよいのか」<br>
              使用年数、故障内容、部品供給、修理費用、設置環境によって変わります。
              現在の機器の型番、使用年数、症状、エラー内容などを確認し、
              修理対応でよいケースと交換を検討すべきケースを整理します。
            </p>
          </article>
          <article>
            <h3>能力不足・過剰設備を<br class="is-hidden_sp">避けた<span>機器選定</span></h3>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_icon_02.jpg" alt="" width="250" height="250" loading="lazy" decoding="async">
            <p>
              部屋の広さだけで選ぶと、冷暖房が効きにくい、電気代が高くなる、必要以上に高額な機器を選んでしまうといった問題につながる場合があります。<br class="is-hidden_sp">
              施設用途、稼働時間、天井高、利用人数、発熱機器の有無を確認し、現場に合った機種・馬力・台数をご提案します。
            </p>
          </article>
          <article>
            <h3>本体販売から取付工事まで<br class="is-hidden_sp"><span>まとめて依頼できます</span></h3>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_icon_03.jpg" alt="" width="250" height="250" loading="lazy" decoding="async">
            <p>
              業務用エアコンの交換では、本体の選定だけでなく、配管、電源、室外機の設置場所、搬入経路、工事可能日まで確認する必要があります。<br class="is-hidden_sp">
              機器の手配から取付工事までまとめて対応し、販売店、工事業者、撤去業者を個別に探す手間を抑えられます。
            </p>
          </article>
          <article>
            <h3><span>既存機器の撤去・フロン回収</span><br class="is-hidden_sp">まで一括対応します</h3>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_icon_04.jpg" alt="" width="250" height="250" loading="lazy" decoding="async">
            <p>
              古い業務用エアコンを交換する際は、新しい機器の設置だけでなく、既存機器の撤去やフロン回収に関する確認も必要です。<br class="is-hidden_sp">
              交換時に必要となる撤去、回収、処分まわりについても、現在の設置状況に合わせてご相談いただけます。
            </p>
          </article>
          <article>
            <h3><span>業務の影響を抑えた</span><br class="is-hidden_sp">工事計画を提案します</h3>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_icon_05.jpg" alt="" width="250" height="250" loading="lazy" decoding="async">
            <p>
              店舗の営業時間や工場・施設の稼働状況を確認し、営業・業務への影響をできる限り抑えた工事日程と作業手順をご提案します。<br class="is-hidden_sp">
              休日や営業時間外の工事、複数台を段階的に入れ替える計画についてもご相談いただけます。
            </p>
          </article>
          <article>
            <h3><span>追加の工事・費用</span>は<br class="is-hidden_sp">事前に確認できます</h3>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_icon_06.jpg" alt="" width="250" height="250" loading="lazy" decoding="async">
            <p>
              既存の配管・電源・室外機の位置・搬入経路・天井内の状況によって、必要な工事内容が変わる場合があります。<br class="is-hidden_sp">
              「見積もり後に費用が変わらないか不安」<br>
              「どこまで工事費に含まれるのか？」<br>
              追加工事が発生する可能性がある部分を事前に確認します。<br class="is-hidden_sp">
            </p>
          </article>

        </div>

        <section class="service--maker">
          <h3>
            <picture>
              <source media="(max-width: 767px)" srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_txt_sp.png" width="697" height="220">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_txt.png" alt="様々な種類の業務用エアコンに対応可能" width="776" height="76" loading="lazy" decoding="async">
            </picture>
          </h3>
          <div>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_maker_01.png" alt="パナソニック" width="397" height="61" loading="lazy" decoding="async">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_maker_02.png" alt="ダイキン" width="338" height="72" loading="lazy" decoding="async">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_maker_03.png" alt="東芝" width="408" height="63" loading="lazy" decoding="async">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_maker_04.png" alt="三菱重工" width="394" height="76" loading="lazy" decoding="async">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_maker_05.png" alt="三菱電機" width="314" height="131" loading="lazy" decoding="async">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_maker_06.png" alt="日立" width="371" height="59" loading="lazy" decoding="async">
          </div>
        </section>


        <section class="service--building">
          <h3>
            店舗・事務所・工場・施設など幅広く対応
          </h3>
          <div class="service--img">
            <div>
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_building_01.jpg" alt="" width="350" height="250" loading="lazy" decoding="async">
              <p>事務所</p>
            </div>
            <div>
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_building_02.jpg" alt="" width="350" height="250" loading="lazy" decoding="async">
              <p>飲食店</p>
            </div>
            <div>
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_building_03.jpg" alt="" width="350" height="250" loading="lazy" decoding="async">
              <p>美容院</p>
            </div>
            <div>
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_building_04.jpg" alt="" width="350" height="250" loading="lazy" decoding="async">
              <p>クリニック</p>
            </div>
            <div>
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_building_05.jpg" alt="" width="350" height="250" loading="lazy" decoding="async">
              <p>工場・倉庫</p>
            </div>
            <div>
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_building_06.jpg" alt="" width="350" height="250" loading="lazy" decoding="async">
              <p>塾</p>
            </div>
          </div>
        </section>
      </div>
    </section>

    <section class="reason">
      <div class="contents">
        <h2>選ばれる<span>6</span>つの理由</h2>
        <p class="reason--lead">
          業務用エアコンの導入・交換では、機器本体の価格だけでなく、<br class="is-hidden_sp">
          設置環境、必要な能力、工事内容、既存機器の撤去、フロン回収、<br class="is-hidden_sp">
          導入後の使いやすさまで総合的に考える必要があります。<br>
          機器選定から販売、取付工事、試運転まで一括でご相談いただけます。
        </p>
        <div class="reason--inner">
          <article>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/reason_01.jpg" alt="" width="500" height="300" loading="lazy" decoding="async">
            <h3>省エネ性能まで考えた機種選定</h3>
            <p>
              同じ馬力でも省エネ性能や制御機能によって、長期的な電気代が変わります。<br>
              安い機種を選ぶと、初期費用は抑えられても、毎月の電気代で損をする可能性があります。<br>
              使用時間、部屋の広さ、天井高、人数、熱源、業種、営業日数を確認し、過剰スペックにも能力不足にもならない機種をご提案します。<br>
              初期費用だけでなく、運用コストまで考えたサポートをします。
            </p>
          </article>
          <article>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/reason_02.jpg" alt="" width="500" height="300" loading="lazy" decoding="async">
            <h3>総額が見える見積り</h3>
            <p>
              交換費用は、本体価格だけでは判断できません。<br>
              撤去費、配管工事、電源工事、冷媒回収、搬入経路、室外機の設置条件によって総額が変わります。<br>
              現地状況を確認したうえで「本体費」「標準工事費」「撤去・処分費」「追加工事の可能性」を分けてご提示します。<br>
              あとから追加費用が膨らむ不安を抑え、納得して比較できる見積りを行います。
            </p>
          </article>
          <article>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/reason_03.jpg" alt="" width="500" height="300" loading="lazy" decoding="async">
            <h3>業種別に最適な空調を提案</h3>
            <p>
              飲食店、美容室、クリニック、事務所など空調に求められる条件が異なります。<br>
              飲食店では厨房熱や油汚れ、美容室では薬剤臭や温度ムラ、クリニックでは快適性と清潔感の配慮が必要です。<br>
              単に既存機器と同等品を入れ替えるだけでなく、業種・使用環境・お客様の動線・スタッフの作業環境に合わせて、最適なタイプと能力を選定します。
            </p>
          </article>
          <article>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/reason_04.jpg" alt="" width="500" height="300" loading="lazy" decoding="async">
            <h3>工事後の保証・アフター対応</h3>
            <p>
              業務用エアコンは、設置して終わりではありません。長く安定して使うには、工事品質、試運転、保証、メンテナンス体制が重要です。<br>
              設置後に試運転を行い、冷暖房の効き、異音、排水、リモコン動作などを確認します。<br>
              工事後の不具合やメンテナンスの相談にも対応し、長期的に安心して使える環境をサポートします。
            </p>
          </article>
          <article>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/reason_05.jpg" alt="" width="500" height="300" loading="lazy" decoding="async">
            <h3>リース・分割払いの相談ができる</h3>
            <p>
              業務用エアコンの交換や買い替えをするとまとまった初期費用がかかります。<br>
              一括での支払いが難しい場合にはリース、分割払いなどを検討することが重要です。<br>
              初期費用を抑えたい、月額化したいといったご相談にも対応します。<br>
              購入がよいのか、リースがよいのかも、使用年数や台数、会社の資金計画に合わせてご提案します。
            </p>
          </article>
          <article>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/reason_06.jpg" alt="" width="500" height="300" loading="lazy" decoding="async">
            <h3>撤去・フロン回収・処分まで一括対応</h3>
            <p>
              使わなくなった業務用エアコンの撤去には、冷媒回収や適切な処分が関わります。<br>
              機器を外して終わりではなく、法令に沿った対応が必要です。<br>
              既存機器の撤去、冷媒回収、搬出、処分、新しい機器の設置まで一括で対応します。<br>
              複数業者を手配する手間を減らし、工事全体をスムーズに進めます。
            </p>
          </article>
        </div>
      </div>
    </section>

    <section class="worry sec">
      <div class="contents">
        <h2 class="worry--ttl">
          <span>このような店舗・施設に選ばれています</span>
          それぞれの現場が抱える<b>お悩みを解決</b>
        </h2>
        <p class="worry--lead">
          実際にご依頼いただいた事例の一部をご紹介します。<br>
          症状や現場環境に応じて、適切な方法で対応しています。
        </p>
        <article>
          <h3>夏本番前に、店内が冷えない不安を何とかしたかった</h3>
          <div class="worry--inner">
            <div>
              <p class="worry--txt"><span>飲食店</span>古い天井カセット形エアコンを交換</p>
              <p>
                特にランチタイムや満席の時間帯が心配でした。<br>
                お客様に「暑い」と思われるのは避けたいですし、夏本番に 急に止まってしまうのも困ります。
                営業にできるだけ影響が 出ないように、早めに入れ替えを相談したいと思っていました。
              </p>
            </div>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/worry_01.jpg" alt="" width="350" height="250" loading="lazy" decoding="async">
          </div>
        </article>
        <article>
          <h3>何度も修理するより、交換した方がいいのではと悩んでいた</h3>
          <div class="worry--inner">
            <div>
              <p class="worry--txt"><span>オフィス</span>10年以上使った業務用エアコンの入れ替え</p>
              <p>
                ここ数年、エアコンの調子が悪くなることが増えていて、そのたびに修理を依頼していました。<br>
                このまま修理を続けた方がいいのか、思い切って交換した方がいいのか判断できずにいました。<br>
                業務中に止まると困るので、今後のことも考えて一度見てほしいとおもっていました。
              </p>
            </div>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/worry_02.jpg" alt="" width="350" height="250" loading="lazy" decoding="async">
          </div>
        </article>
        <article>
          <h3>開業日が決まっているので、空調を間に合わせたかった</h3>
          <div class="worry--inner">
            <div>
              <p class="worry--txt"><span>美容院</span>新店舗に業務用エアコンを新規設置しました</p>
              <p>
                開業日が決まっているので、それまでにエアコンの設置を終わらせたいとおもっていました。<br>
                内装工事も進んでいるのですが、どのくらいの性能のエアコンが必要なのか分からなくて不安でした。<br>
                ドライヤーを使うので店内が暑くなりやすいと思いますし、お客様に快適に過ごしてもらえる空調にしたいとおもっていました。
              </p>
            </div>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/worry_03.jpg" alt="" width="350" height="250" loading="lazy" decoding="async">
          </div>
        </article>
        <article>
          <h3>従業員から暑いと言われていて、作業環境を改善したかった</h3>
          <div class="worry--inner">
            <div>
              <p class="worry--txt"><span>工場</span>作業場に業務用エアコンを増設しました</p>
              <p>
                夏場になると作業場がかなり暑くなってしまい、従業員からも暑さについて声が上がっていました。<br>
                今ある空調だけでは全体まで効いていないようで、作業効率にも影響が出ている気がしました。<br>
                どこに、どのくらいのエアコンを追加すればいいのかを相談させ てもらって増設を決めました。
              </p>
            </div>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/worry_04.jpg" alt="" width="350" height="250" loading="lazy" decoding="async">
          </div>
        </article>
        <article>
          <h3>電気代が高くなっていて、使い続けるべきか迷っていた</h3>
          <div class="worry--inner">
            <div>
              <p class="worry--txt"><span>塾</span>省エネ型の機種へ取り換えました</p>
              <p>
                エアコン自体はまだ動いているのですが、電気代が高くなってきているのが気になっていました。<br>
                古い機種をこのまま使い続けるより、新しいものに交換した方が結果的に安くなるのかを一度見てもらいました。<br>
                初期費用だけでなく、今後のランニングコストも含めてシミュレーションをしてもらって取り換えようとおもいました。
              </p>
            </div>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/worry_05.jpg" alt="" width="350" height="250" loading="lazy" decoding="async">
          </div>
        </article>
      </div>
    </section>

    <div class="cvarea">
      <div class="cvarea--btn">
        <div class="header--btns">
          <div class="header--btn-item">
            <a href="tel:<?php echo esc_attr($main_tel_href); ?>" class="cv_button gtm-click-tel">
              <picture>
                <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/tel.avif" type="image/avif">
                <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/tel.webp" type="image/webp">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/tel.png"
                  alt="お電話でのご相談はこちら: <?php echo esc_attr($main_tel_local); ?>"
                  width="487" height="144"
                  loading="lazy"
                  decoding="async">
              </picture>
            </a>
          </div>

          <div class="header--btn-item">
            <a href="#contact" class="cv_button gtm-click-mail">
              <picture>
                <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/mail.avif" type="image/avif">
                <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/mail.webp" type="image/webp">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/mail.png"
                  alt="メールでお問い合わせ"
                  width="487" height="144"
                  loading="lazy"
                  decoding="async">
              </picture>
            </a>
          </div>
        </div>
      </div>
      <picture>
        <source
          media="(max-width: 767px)"
          srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/cvarea_sp.avif"
          type="image/avif"
          width="750" height="1258">
        <source
          media="(max-width: 767px)"
          srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/cvarea_sp.webp"
          type="image/webp"
          width="750" height="1258">
        <source
          media="(max-width: 767px)"
          srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/cvarea_sp.jpg"
          width="750" height="1258">

        <source
          srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/cvarea.avif"
          type="image/avif">
        <source
          srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/cvarea.webp"
          type="image/webp">

        <img
          src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/cvarea.jpg"
          alt="業務用エアコンの交換・入れ替え！施工から保守まで一括サポート。まずは無料でご相談ください"
          class="cvarea--img"
          width="1920" height="641"
          loading="lazy"
          decoding="async">
      </picture>
    </div>

    <section class="flow sec">
      <div class="contents">
        <h2>ご依頼・作業までの流れ</h2>
        <p>
          初めてご依頼の方も、既存設備の入れ替えをお考えの方も、<br class="is-hidden_sp">
          まずはお気軽にご連絡ください。
        </p>
        <article class="flow--item">
          <div>
            <span class="flow--num">STEP<span>01</span></span>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/flow_01.jpg" alt="" width="450" height="250" loading="lazy" decoding="async">
          </div>
          <h3>お問い合わせ・見積もり（無料）</h3>
          <p>
            まずはフォームまたはお電話にてお問い合わせください。<br>
            設置先の市区町村、施設の種類、現在の業務用エアコンの状況、台数、導入 ・<br class="is-hidden_sp">
            交換希望時期など、分かる範囲でお知らせください。現在の機器の型番や、<br class="is-hidden_sp">
            室内機・室外機の写真がある場合は、 あわせて共有いただくと確認がスムーズです。
          </p>
        </article>
        <article class="flow--item">
          <div>
            <span class="flow--num">STEP<span>02</span></span>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/flow_02.jpg" alt="" width="450" height="250" loading="lazy" decoding="async">
          </div>
          <h3>メール・電話でヒアリング</h3>
          <p>
            お問い合わせ内容をもとに、担当者がメールまたは電話で詳しく状況を確認します。<br>
            現在の機器が交換時期か、新規導入か、複数台の更新か、<br class="is-hidden_sp">
            工事時期の希望があるかなどを整理します。<br>
            この段階で、対応エリア・対象施設・工事内容を確認し、<br class="is-hidden_sp">
            導入・交換のご相談として進められるかを確認します。
          </p>
        </article>
        <article class="flow--item">
          <div>
            <span class="flow--num">STEP<span>03</span></span>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/flow_03.jpg" alt="" width="450" height="250" loading="lazy" decoding="async">
          </div>
          <h3>現地調査・日程調整</h3>
          <p>
            必要に応じて現地調査を行い、設置場所、天井高、配管ルート、<br class="is-hidden_sp">
            電源、 室外機の設置場所、搬入経路、既存機器の撤去条件などを確認します。<br>
            現場状況を踏まえて、施設用途や使用環境に合った<br class="is-hidden_sp">
            機種・馬力・台数を ご提案します。
          </p>
        </article>
        <article class="flow--item">
          <div>
            <span class="flow--num">STEP<span>04</span></span>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/flow_04.jpg" alt="" width="450" height="250" loading="lazy" decoding="async">
          </div>
          <h3>工事日調整</h3>
          <p>
            現地状況とご希望内容をもとに、機器本体・工事内容・撤去・<br class="is-hidden_sp">
            フロン回収まわりを含めたお見積もりをご案内します。<br>
            内容にご納得いただけましたら、工事日程を調整し、機器手配へ進みます。<br>
            店舗や施設の営業・業務への影響を抑えたい場合は、希望日程もあわせてご相談ください。
          </p>
        </article>
        <article class="flow--item">
          <div>
            <span class="flow--num">STEP<span>05</span></span>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/flow_05.jpg" alt="" width="450" height="250" loading="lazy" decoding="async">
          </div>
          <h3>工事・既存機器の撤去</h3>
          <p>
            工事当日は、作業箇所の養生を行ったうえで、<br class="is-hidden_sp">
            既存の業務用エアコンを撤去し、新しい機器を設置します。<br>
            室内機・室外機の取付、配管接続、ドレン配管、電源まわりの確認など、<br class="is-hidden_sp">
            現場状況に応じて必要な工事を進めます。<br>
            安全面や周辺環境に配慮しながら、<br class="is-hidden_sp">
            店舗や施設の営業・業務への影響をできる限り抑えて作業を行います。
          </p>
        </article>
        <article class="flow--item">
          <div>
            <span class="flow--num">STEP<span>06</span></span>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/flow_06.jpg" alt="" width="450" height="250" loading="lazy" decoding="async">
          </div>
          <h3>試運転・動作確認</h3>
          <p>
            設置工事が完了しましたら、試運転を行い、冷暖房の運転状況、<br class="is-hidden_sp">
            風量、異音、水漏れ、リモコン操作などを確認します。<br>
            配管・電源まわりにも問題がないかを確認し、<br class="is-hidden_sp">
            正常に運転できる状態であることを確認します。<br>
            問題がないことを確認したうえで、お客様へお引き渡しします。
          </p>
        </article>
        <article class="flow--item">
          <div>
            <span class="flow--num">STEP<span>07</span></span>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/flow_07.jpg" alt="" width="450" height="250" loading="lazy" decoding="async">
          </div>
          <h3>工事完了・お引き渡し</h3>
          <p>
            試運転・動作確認が完了しましたら、<br class="is-hidden_sp">
            設置状態や運転状況に問題がないことを確認し、お客様へお引き渡しします。<br>
            作業後は、担当者様にリモコン操作、運転時の注意点、<br class="is-hidden_sp">
            今後のメンテナンスについてわかりやすくご説明します。<br>
            設置後に気になる点や不具合がございましたら、お気軽にご相談ください。<br>
            工事完了後も、業務用エアコンを安心して<br class="is-hidden_sp">
            お使いいただけるようサポートいたします。
          </p>
        </article>
      </div>
    </section>

    <section class="question sec">
      <div class="contents">
        <h2>よくある質問</h2>
        <p>
          お問い合わせ前に気になる点を、まとめてお答えします。<br>
          ご不明な点は、お気軽にお問い合わせください。
        </p>
        <dl id="faq">
          <?php foreach ($faq_items as $faq_item): ?>
            <dt><?php echo esc_html($faq_item['question']); ?></dt>
            <dd><?php echo nl2br(esc_html($faq_item['answer'])); ?></dd>
          <?php endforeach; ?>
        </dl>
      </div>
    </section>

    <section class="area sec">
      <div class="contents">
        <h2>
          <b>愛知県・岐阜県・三重県・静岡県</b>へ迅速に対応します
        </h2>
        <p>
          愛知県・岐阜県・三重県・静岡県で、<br class="is-hidden_sp">
          業務用エアコンの取り換え・交換・入れ替えをご検討中の方はお気軽にご相談ください。<br>
          店舗・オフィス・工場・倉庫・医療施設・福祉施設・飲食店など、<br class="is-hidden_sp">
          施設の用途や使用環境に合わせて、 最適な業務用エアコンの入れ替えをご提案します。<br>
          既存機器の状況確認、現地調査、機器選定、撤去工事、<br class="is-hidden_sp">
          フロン回収、設置工事、試運転まで一括対応します。<br>
          老朽化した業務用エアコンの交換や、効きが悪くなった空調設備の入れ替えもご相談いただけます。<br>
          東海エリアでの業務用エアコン工事に迅速に対応し、<br class="is-hidden_sp">
          店舗や施設の営業・業務への影響をできる限り抑えた施工をご案内します。
        </p>

        <article class="area--list">
          <span>愛知県</span>
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/area_01.jpg" alt="" width="500" height="375" loading="lazy" decoding="async">
          <p>
            名古屋市を中心とした店舗・オフィス・商業施設をはじめ、<br class="is-hidden_sp">
            三河エリアの工場・倉庫・物流施設など、<br class="is-hidden_sp">
            幅広い現場の業務用エアコン取り換え・交換に対応しています。<br>
            製造業が盛んな地域では、作業環境の温度管理や設備稼働への影響を抑えることが重要です。<br>
            飲食店や小売店、事務所では、来店されるお客様や従業員の快適性を維持するためにも、<br class="is-hidden_sp">
            空調設備の安定した運転が欠かせません。<br>
            古くなった業務用エアコンの入れ替え、効きが悪くなった空調設備の交換、<br class="is-hidden_sp">
            複数台の一括更新など、現場の使用状況に合わせてご提案します。<br>
            既存機器の撤去、フロン回収、新しい機器の設置、試運転まで一貫して対応し、<br class="is-hidden_sp">
            営業や業務への影響をできる限り抑えた施工を行います。
          </p>
        </article>
        <article class="area--list">
          <span>岐阜県</span>
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/area_02.jpg" alt="" width="500" height="375" loading="lazy" decoding="async">
          <p>
            岐阜市・大垣市・各務原市周辺の店舗・事務所・工場・物流施設をはじめ、<br class="is-hidden_sp">
            地場産業の作業場、医療施設、福祉施設、宿泊施設などの<br class="is-hidden_sp">
            業務用エアコン取り換え・交換に対応しています。
            内陸部の事業所や工場では、夏場・冬場ともに空調への負荷が大きくなりやすく、<br class="is-hidden_sp">
            業務用エアコンの能力選定や設置環境の確認が重要です。<br>
            観光地や宿泊施設では、利用者が快適に過ごせる空調環境づくりが求められます。<br>
            現地調査では、設置場所、配管ルート、室外機の設置スペース、搬入経路、<br class="is-hidden_sp">
            既存機器の撤去条件などを確認し、施設の用途に合った機種・馬力・台数をご提案します。<br>
            老朽化した空調設備の交換から、複数台の入れ替えまで丁寧に対応いたします。
          </p>
        </article>
        <article class="area--list">
          <span>三重県</span>
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/area_03.jpg" alt="" width="500" height="375" loading="lazy" decoding="async">
          <p>
            四日市市・鈴鹿市・いなべ市周辺の工場・倉庫・事業所をはじめ、<br class="is-hidden_sp">
            津市・松阪市・桑名市・伊勢志摩エリアの店舗・飲食店・宿泊施設・医療施設など、<br class="is-hidden_sp">
            さまざまな現場の業務用エアコン取り換え・交換に対応しています。<br>
            工業エリアでは、作業環境や設備稼働に支障が出ないよう、<br class="is-hidden_sp">
            現場状況に合わせた空調設備の選定が重要です。<br>
            観光施設や飲食店、宿泊施設では、お客様の快適性に直結するため、<br class="is-hidden_sp">
            故障前の早めの入れ替えや計画的な更新もおすすめです。<br>
            既存機器の状況を確認したうえで、撤去工事、フロン回収、新しい業務用エアコンの設置、<br class="is-hidden_sp">
            配管・電源まわりの確認、試運転まで一括対応します。 海沿いの地域や屋外設置環境についても、<br class="is-hidden_sp">
            室外機の設置場所や使用環境を踏まえてご案内します。
          </p>
        </article>
        <article class="area--list">
          <span>静岡県</span>
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/area_04.jpg" alt="" width="500" height="375" loading="lazy" decoding="async">
          <p>
            浜松市・静岡市・沼津市・富士市周辺をはじめ、<br class="is-hidden_sp">
            県内各地の店舗・オフィス・工場・倉庫・飲食店・医療施設・福祉施設などの<br class="is-hidden_sp">
            業務用エアコン取り換え・交換に対応しています。<br>
            東西に広い静岡県では、地域や施設によって空調設備に求められる条件が異なります。
            製造業の工場や倉庫では作業環境に合わせた能力選定が必要になり、<br class="is-hidden_sp">
            店舗や飲食店では来店客の快適性、医療・福祉施設では安定した室内環境が重要になります。<br>
            古くなった業務用エアコンの交換、冷暖房の効きが悪い空調設備の入れ替え、<br class="is-hidden_sp">
            複数台の更新など、現場ごとの課題に合わせてご提案します。<br>
            現地調査から機器選定、撤去、フロン回収、設置、試運転までスムーズに対応し、<br class="is-hidden_sp">
            安心して使える空調環境づくりをサポートします。
          </p>
        </article>
      </div>
    </section>

    <section class="contact sec" id="contact">
      <div class="contents">
        <h2 class="ttl">お問い合わせは<br class="is-hidden_pc">こちらから！</h2>
        <p class="contact--lead">
          料金の目安を知りたい方・具体的な日程のご相談をされたい方は、<br class="is-hidden_sp">
          こちらのフォームからご連絡ください。<br>
          無料でお見積もり・ご提案いたします。
        </p>
        <div class="contact--inner">
          <?php echo apply_filters('the_content', '<!-- wp:snow-monkey-forms/snow-monkey-form {"formId":756} /-->'); ?>
        </div>
      </div>
    </section>
  </main>

  <div class="footer_btn_fixed" id="js_fixed-btn">
    <p class="footer_btn_fixed--tel"><a href="tel:<?php echo esc_attr($main_tel_href); ?>">電話で<br>相談する</a></p>
    <p class="footer_btn_fixed--mail"><a href="#contact">メールで<br>無料見積り</a></p>
  </div>

  <footer class="footer">
    <div class="contents -md">
      <div>
        <div class="footer--logo">
          <a href="<?php echo esc_url(home_url('/')); ?>">
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/logo_footer.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/logo_footer.webp" type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/logo_footer.png"
                alt="株式会社トータルスマート"
                width="397" height="84"
                loading="lazy"
                decoding="async">
            </picture>
            <p>業務用エアコンの交換・買い替え・取り換え・入れ替えは<br>トータルスマート株式会社</p>
          </a>
        </div>
        <div class="footer--info">
          <p>〒461-0002 愛知県名古屋市東区代官町16-17
            <br>代官町ビルディング2F
          </p>
          <p>TEL:<?php echo esc_html($main_tel_local); ?></p>
          <p>FAX:052-932-5451</p>
          <p>URL:<a href="https://total-smart-ltd.com/">https://total-smart-ltd.com</a></p>
          <p>
            <a href="<?php echo esc_url(home_url('/company/')); ?>">会社概要</a>｜
            <a href="<?php echo esc_url(home_url('/privacy/')); ?>">プライバシーポリシー</a>
          </p>
        </div>
      </div>
      <div class="footer--catch">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/footer_catch.jpg" alt="トータルスマート" width="357" height="350" loading="lazy" decoding="async">
      </div>
    </div>
    <p class="footer--copy"><small>Copyright© 株式会社トータルスマート All Rights Reserved.</small></p>
  </footer>

  <?php wp_footer(); ?>
</body>

</html>