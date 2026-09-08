<?php
/*
Template Name: エアコンのクリーニングLP
*/
defined('ABSPATH') || exit;

$page_id  = get_queried_object_id();
$page_url = esc_url_raw(get_permalink($page_id));
$home_url = esc_url_raw(home_url('/'));

$logo_url = esc_url_raw(get_theme_file_uri('cleaninglp/img/logo.png'));
$mv_url   = esc_url_raw(get_theme_file_uri('cleaninglp/img/mv.jpg'));

// NAP（代表番号）と、広告計測等で使う番号（表示している番号）を分離
$main_tel_local     = '052-932-5450';
$main_tel_intl      = '+81-52-932-5450';
$tracking_tel_local = '0800-111-3816';
$tracking_tel_intl  = '+81-800-111-3816';

// tel: hrefは数字列（端末互換性重視）に正規化（表示テキストはそのまま）
$tracking_tel_href = preg_replace('/[^0-9]/', '', $tracking_tel_local); // 08001113816
$main_tel_href     = preg_replace('/[^0-9]/', '', $main_tel_local);     // 0529325450

// SEOの制御はこのテンプレート内で完結させる。共通ファイルは変更しない。
$has_seo_plugin = (
  defined('WPSEO_VERSION')
  || defined('RANK_MATH_VERSION')
  || defined('AIOSEO_VERSION')
  || defined('SEOPRESS_VERSION')
  || defined('SLIM_SEO_VERSION')
  || class_exists('The_SEO_Framework\Load')
  || function_exists('rank_math')
);

// 本文で案内している対象・作業内容・対応地域に合わせる。
$meta_title = '業務用エアコンクリーニング｜愛知・岐阜・三重・静岡｜トータルスマート株式会社';
$meta_description = '愛知・岐阜・三重・静岡の店舗・オフィス・施設向け業務用エアコンクリーニング。天井カセット形・天井吊形など、機種や設置状況に合わせて分解洗浄します。料金・作業の流れ・施工事例をご案内。トータルスマート株式会社が無料見積もりを承ります。';
$meta_description = wp_strip_all_tags($meta_description);

if (!$has_seo_plugin) {
  // title-tag 対応時にも、このLPのタイトルをWordPress標準出力へ反映する。
  // 共通のタイトルフィルター（優先度10）の後に適用する。
  add_filter('pre_get_document_title', static function ($title) use ($page_id, $meta_title) {
    if (!is_page() || (int) get_queried_object_id() !== (int) $page_id) {
      return $title;
    }
    return $meta_title;
  }, 20);

  // このLPには既存のcanonical・OGP・JSON-LD出力があるため、
  // 同じリクエストの共通出力のみ止める。他のテンプレートには影響しない。
  // robots/noindex、CSS/JS、フォーム、計測用のフックは変更しない。
  remove_action('wp_head', 'ts_output_fallback_seo_meta', 1);
  remove_action('wp_head', 'rel_canonical', 10);
  remove_action('wp_head', 'output_ogp', 10);
  remove_action('wp_head', 'ts_output_website_schema_json_ld', 20);
}

// ---------------------------
// JSON-LD（表示内容と整合）
// ※SEOプラグインがschemaを出す場合が多いのでガード
// ---------------------------
// オプションは単独のクリーニング料金ではなく、分解洗浄への追加料金。
$cleaning_option = [
  '@type' => 'Offer',
  'name'  => 'お掃除機能付きオプション',
  'url'   => $page_url . '#price',
  'price' => 6000,
  'priceCurrency' => 'JPY',
  'priceSpecification' => [
    '@type' => 'UnitPriceSpecification',
    'price' => 6000,
    'priceCurrency' => 'JPY',
    'valueAddedTaxIncluded' => false,
  ],
];

// 「円〜」を固定料金や上限額として表現しない。
$offers = [
  [
    '@type' => 'Offer',
    'name'  => '簡単クリーニング（フィルター清掃・風速測定・温度測定）',
    'url'   => $page_url . '#price',
    'priceCurrency' => 'JPY',
    'description' => '5,000円〜（税抜）。フィルター清掃・風速測定・温度測定を実施します。機種や設置状況により料金が異なります。',
    'itemOffered' => ['@id' => $page_url . '#service'],
    'priceSpecification' => [
      '@type' => 'UnitPriceSpecification',
      'minPrice' => 5000,
      'priceCurrency' => 'JPY',
      'valueAddedTaxIncluded' => false,
    ],
  ],
  [
    '@type' => 'Offer',
    'name'  => 'しっかりクリーニング（分解洗浄）',
    'url'   => $page_url . '#price',
    'priceCurrency' => 'JPY',
    'description' => '18,000円〜（税抜）。分解洗浄を実施します。お掃除機能付きの場合は追加6,000円です。機種や設置状況により料金が異なります。',
    'itemOffered' => ['@id' => $page_url . '#service'],
    'priceSpecification' => [
      '@type' => 'UnitPriceSpecification',
      'minPrice' => 18000,
      'priceCurrency' => 'JPY',
      'valueAddedTaxIncluded' => false,
    ],
    'addOn' => $cleaning_option,
  ],
];

$website = [
  '@type' => 'WebSite',
  '@id'   => $home_url . '#website',
  'url'   => $home_url,
  'name'  => 'トータルスマート株式会社',
  'inLanguage' => 'ja-JP',
  'publisher' => ['@id' => $home_url . '#localbusiness'],
];

$primary_image = [
  '@type' => 'ImageObject',
  '@id'   => $page_url . '#primaryimage',
  'url'   => $mv_url,
];

$business = array_replace(ts_get_local_business_schema(), [
  // エアコンLPでは、LocalBusinessの具体的なサブタイプを使用する。
  '@type' => 'HVACBusiness',
  'logo'  => $logo_url,
  'image' => [$mv_url],
  // 上限額や、本文に記載のない支払方法は断定しない。
  'priceRange' => '5,000円〜（税抜・作業内容により見積もり）',
  'currenciesAccepted' => 'JPY',
  'contactPoint' => [
    [
      '@type' => 'ContactPoint',
      'telephone' => $main_tel_intl,
      'contactType' => 'customer service',
      'availableLanguage' => ['ja'],
    ],
    [
      '@type' => 'ContactPoint',
      'telephone' => $tracking_tel_intl,
      'contactType' => 'sales',
      'availableLanguage' => ['ja'],
    ],
  ],
  'makesOffer' => $offers,
]);

$service = [
  '@type' => 'Service',
  '@id'   => $page_url . '#service',
  'name'  => '業務用エアコンクリーニング',
  'serviceType' => '業務用エアコンクリーニング・分解洗浄',
  'url' => $page_url,
  'description' => '店舗・オフィス・施設の業務用エアコンを、機種や設置状況に合わせて清掃・分解洗浄します。',
  'image' => ['@id' => $page_url . '#primaryimage'],
  'mainEntityOfPage' => ['@id' => $page_url . '#webpage'],
  'provider' => ['@id' => $home_url . '#localbusiness'],
  'areaServed' => $business['areaServed'],
  'offers' => $offers,
];

$webpage = [
  '@type' => 'WebPage',
  '@id'   => $page_url . '#webpage',
  'url'   => $page_url,
  'name'  => $meta_title,
  'description' => $meta_description,
  'inLanguage' => 'ja-JP',
  'isPartOf' => ['@id' => $home_url . '#website'],
  'primaryImageOfPage' => ['@id' => $page_url . '#primaryimage'],
  'about' => ['@id' => $page_url . '#service'],
  'mainEntity' => ['@id' => $page_url . '#service'],
];

// 本文と異なる旧FAQデータは出力しない。表示中のFAQはそのまま本文に残す。
// FAQリッチリザルト向けのデータではなく、このページのサービスを中心に記述する。
$ld_json = [
  '@context' => 'https://schema.org',
  '@graph' => [$website, $primary_image, $business, $service, $webpage],
];

add_action('wp_head', static function () use ($ld_json, $has_seo_plugin) {
  static $printed = false;
  if ($printed || is_admin() || $has_seo_plugin) {
    return;
  }
  $json = wp_json_encode(
    $ld_json,
    JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
      | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
  );
  if (false === $json) {
    return;
  }
  $printed = true;

  echo "\n" . '<script type="application/ld+json">'
    . $json
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

  <script type="text/javascript">
    (function(c, l, a, r, i, t, y) {
      c[a] = c[a] || function() {
        (c[a].q = c[a].q || []).push(arguments)
      };
      t = l.createElement(r);
      t.async = 1;
      t.src = "https://www.clarity.ms/tag/" + i;
      y = l.getElementsByTagName(r)[0];
      y.parentNode.insertBefore(t, y);
    })(window, document, "clarity", "script", "win4k5tt8k");
  </script>

  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <meta name="format-detection" content="telephone=no">

  <link rel="preload" as="image" href="<?php echo esc_url(get_theme_file_uri('cleaninglp/img/logo.avif')); ?>" type="image/avif">
  <link rel="preload" as="image" href="<?php echo esc_url(get_theme_file_uri('cleaninglp/img/mv_sp.avif')); ?>" type="image/avif" media="(max-width: 767px)">
  <link rel="preload" as="image" href="<?php echo esc_url(get_theme_file_uri('cleaninglp/img/mv.avif')); ?>" type="image/avif" media="(min-width: 768px)">

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
    <meta property="og:site_name" content="トータルスマート株式会社">
    <meta property="og:title" content="<?php echo esc_attr($meta_title); ?>">
    <meta property="og:description" content="<?php echo esc_attr($meta_description); ?>">
    <meta property="og:url" content="<?php echo esc_url($page_url); ?>">
    <meta property="og:image" content="<?php echo esc_url($mv_url); ?>">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr($meta_title); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr($meta_description); ?>">
    <meta name="twitter:image" content="<?php echo esc_url($mv_url); ?>">
  <?php endif; ?>

  <link rel="icon" href="<?php echo esc_url(get_theme_file_uri('/img/icons/favicon.ico')); ?>">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url(get_theme_file_uri('/img/icons/apple-touch-icon.png')); ?>">

  <?php wp_head(); ?>
</head>

<body <?php body_class('cleaninglp'); ?>>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TKC4PWHS"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <?php wp_body_open(); ?>

  <header class="header">
    <div class="contents">
      <div class="header--logo">
        <a href="<?php echo esc_url(home_url('/cleaninglp/')); ?>">
          <p>愛知県・岐阜県・三重県・静岡県の<br>業務用エアコンクリーニングはトータルスマート株式会社</p>

          <h1>
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/logo.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/logo.webp" type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/logo.png"
                alt="トータルスマート株式会社"
                width="397" height="262"
                fetchpriority="high"
                decoding="async">
            </picture>
          </h1>
        </a>
      </div>

      <div class="header--btns">
        <div class="header--btn-item">
          <a href="tel:<?php echo esc_attr($tracking_tel_href); ?>" class="cv_button gtm-click-tel">
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/tel.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/tel.webp" type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/tel.png"
                alt="お電話でのご相談はこちら: <?php echo esc_attr($tracking_tel_local); ?>"
                width="270" height="70"
                decoding="async">
            </picture>
          </a>
        </div>

        <div class="header--btn-item">
          <a href="#contact" class="cv_button gtm-click-mail">
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/mail.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/mail.webp" type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/mail.png"
                alt="メールでお問い合わせ"
                width="270" height="70"
                decoding="async">
            </picture>
          </a>
        </div>

        <div class="header--btn-item">
          <a href="https://lin.ee/fXrKQyq" class="cv_button gtm-click-line">
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/line.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/line.webp" type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/line.png"
                alt="LINEでお問い合わせ"
                width="270" height="70"
                decoding="async">
            </picture>
          </a>
        </div>
      </div>
    </div>
  </header>

  <main>
    <div class="mv">
      <picture>
        <source
          media="(max-width: 767px)"
          srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/mv_sp.avif"
          type="image/avif">
        <source
          media="(max-width: 767px)"
          srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/mv_sp.webp"
          type="image/webp">
        <source
          media="(max-width: 767px)"
          srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/mv_sp.jpg">

        <source
          srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/mv.avif"
          type="image/avif">
        <source
          srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/mv.webp"
          type="image/webp">

        <img
          src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/mv.jpg"
          alt="エアコンクリーニングならトータルスマート株式会社"
          width="1920" height="800"
          fetchpriority="high"
          decoding="async">
      </picture>
    </div>

    <section class="catch sec -sm">
      <div class="catch--inner">
        <img class="catch--ttl" src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/catch_ttl.png" alt="" width="872" height="192" loading="lazy" decoding="async">
        <div class="catch--contents">
          <div class="catch--item">
            <span>簡単クリーニング</span>
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/catch_01.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/catch_01.webp" type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/catch_01.jpg" alt="簡単クリーニング" width="450" height="300" fetchpriority="high" decoding="async">
            </picture>
            <div class="catch--price">
              <p>5<span class="catch--period">,</span>000</p><span class="catch--unit"><span class="catch--jpy">円～</span><span class="catch--tax">（税抜）</span></span>
            </div>
            <small>※フィルター清掃・風速測定・温度測定を実施</small>
          </div>
          <div class="catch--item">
            <span>しっかりクリーニング</span>
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/catch_02.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/catch_02.webp" type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/catch_02.jpg" alt="しっかりクリーニング" width="450" height="300" fetchpriority="high" loading="lazy" decoding="async">
            </picture>
            <div class="catch--price -pink">
              <p>18<span class="catch--period">,</span>000</p><span class="catch--unit"><span class="catch--jpy">円～</span><span class="catch--tax">（税抜）</span></span>
            </div>
            <small>※お掃除機能付きの場合は＋6,000円<br>※分解洗浄を実施します</small>
          </div>
        </div>
        <img class="catch--ttl u-mb60" src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/catch_03.jpg" alt="" width="381" height="254" loading="lazy" decoding="async">
        <img class="catch--ttl u-mb30" src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/catch_ttl_sub.png" alt="" width="798" height="191" loading="lazy" decoding="async">
        <picture>
          <source
            media="(max-width: 767px)"
            srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/catch_txt_sp.avif"
            type="image/avif">
          <source
            media="(max-width: 767px)"
            srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/catch_txt_sp.webp"
            type="image/webp">
          <source
            media="(max-width: 767px)"
            srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/catch_txt_sp.png">

          <source
            srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/catch_txt.avif"
            type="image/avif">
          <source
            srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/catch_txt.webp"
            type="image/webp">

          <img class="catch--ttl u-mb40" src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/catch_txt.png" alt="" width="1164" height="277" loading="lazy" decoding="async">
        </picture>

        <div class="catch--img">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/catch_img_01.jpg" alt="" width="320" height="230" loading="lazy" decoding="async">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/catch_img_02.jpg" alt="" width="320" height="230" loading="lazy" decoding="async">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/catch_img_03.jpg" alt="" width="320" height="230" loading="lazy" decoding="async">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/catch_img_04.jpg" alt="" width="320" height="230" loading="lazy" decoding="async">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/catch_img_05.jpg" alt="" width="320" height="230" loading="lazy" decoding="async">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/catch_img_06.jpg" alt="" width="320" height="230" loading="lazy" decoding="async">
        </div>
      </div>
    </section>

    <section class="lead sec -sm">
      <div class="contents">
        <h2>
          <picture>
            <source media="(max-width: 767px)" srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/lead_txt_sp.avif" type="image/avif">
            <source media="(max-width: 767px)" srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/lead_txt_sp.webp" type="image/webp">
            <source media="(max-width: 767px)" srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/lead_txt_sp.png">

            <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/lead_txt.avif" type="image/avif">
            <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/lead_txt.webp" type="image/webp">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/lead_txt.png" alt="愛知県・岐阜県・三重県・静岡県なら最短当日・即日での訪問も可能です。" width="808" height="131" loading="lazy" decoding="async">
          </picture>
        </h2>
        <div class="lead--inner">
          <p class="lead--ttl">業務用エアコンクリーニングの<span>ご予約・ご相談</span>はこちらから</p>
          <div class="lead--contents">
            <div class="lead--txt">
              <b> <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/lead_txt_02.png" alt="汚れ・カビ・ニオイ効きの悪さ" width="621" height="114" loading="lazy" decoding="async"></b>
              <p>が気になったら<br>まずは<span>お気軽にご相談ください</span></p>
            </div>
            <picture>
              <source
                srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/lead_catch.avif"
                type="image/avif">
              <source
                srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/lead_catch.webp"
                type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/lead_catch.png" alt="" width="438" height="376" loading="lazy" decoding="async">
            </picture>
          </div>

          <div class="header--btns">
            <div class="header--btn-item">
              <a href="tel:<?php echo esc_attr($tracking_tel_href); ?>" class="cv_button gtm-click-tel">
                <picture>
                  <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/tel.avif" type="image/avif">
                  <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/tel.webp" type="image/webp">
                  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/tel.png"
                    alt="お電話でのご相談はこちら: <?php echo esc_attr($tracking_tel_local); ?>"
                    width="350" height="90"
                    decoding="async">
                </picture>
              </a>
            </div>

            <div class="header--btn-item">
              <a href="#contact" class="cv_button gtm-click-mail">
                <picture>
                  <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/mail.avif" type="image/avif">
                  <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/mail.webp" type="image/webp">
                  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/mail.png"
                    alt="メールでお問い合わせ"
                    width="350" height="90"
                    decoding="async">
                </picture>
              </a>
            </div>

            <div class="header--btn-item">
              <a href="https://lin.ee/fXrKQyq" class="cv_button gtm-click-line">
                <picture>
                  <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/line.avif" type="image/avif">
                  <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/line.webp" type="image/webp">
                  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/line.png"
                    alt="LINEでお問い合わせ"
                    width="350" height="90"
                    decoding="async">
                </picture>
              </a>
            </div>
          </div>

        </div>
        <div class="lead--supplement">
          <p>事前に概算のお見積りをご案内いたします。<br>不当な追加料金や高額請求は一切ございませんので、安心してお問い合わせください。</p>
          <p>※設置状況（機種・汚れ具合・作業環境）により、<br class="is-hidden_sp">当日ご案内する金額が事前の概算見積りから変動する場合がございます。</p>
        </div>
      </div>
    </section>

    <section class="sign" id="symptoms">
      <div class="contents">
        <span class="sign--catch">こんなサインが出てきたら</span>
        <h2><span>エアコンクリーニング</span><br class="is-hidden_pc">のタイミングです</h2>
        <ul class="sign--list">
          <li><span>吹き出し口の黒い点々やホコリの塊</span>が目につくようになってきた</li>
          <li>スイッチを入れると、<span>カビっぽいニオイ・ホコリっぽさを感じる</span></li>
          <li><span>冷房／暖房の効きが前より悪くなった</span>気がして、設定温度を下げがち</li>
          <li>フィルター掃除はしているのに、<span>電気代の明細が年々高くなっている</span></li>
          <li>店舗やオフィスで、<span>エアコンの風や室内の空気が気になる</span></li>
          <li><span>高い場所の作業や分解が不安</span>で、自分で中まで掃除するのは難しいと感じている</li>
        </ul>
      </div>
    </section>

    <section class="cvarea bg_skyblue">
      <div class="contents">
        <picture>
          <source
            media="(max-width: 767px)"
            srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/mv_sp.avif"
            type="image/avif">
          <source
            media="(max-width: 767px)"
            srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/mv_sp.webp"
            type="image/webp">
          <source
            media="(max-width: 767px)"
            srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/mv_sp.jpg">

          <source
            srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/cvarea_catch.avif"
            type="image/avif">
          <source
            srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/cvarea_catch.webp"
            type="image/webp">
          <img
            class="cvarea--catch"
            src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/cvarea_catch.png"
            alt=""
            width="1210" height="792"
            fetchpriority="high"
            decoding="async">
        </picture>
        <div class="cvarea--inner">
          <p class="cvarea--txt">
            出張料金・お見積り・ご相談
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/cvarea_num.png" alt="" width="86" height="121" loading="lazy" decoding="async">
            <span>円</span>
          </p>
          <div class="cvarea--ttl">
            <p><span>1台</span>あたり</p>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/cvarea_ttl.png" alt="" width="710" height="235" loading="lazy" decoding="async">
          </div>
          <b class="cvarea--strong">
            業務用エアコンのクリーニングなら<br class="cvarea--br">トータルスマートにお任せください
          </b>
          <span class="cvarea--contact">お問い合わせはこちらから</span>
          <div class="header--btns">
            <div class="header--btn-item">
              <a href="tel:<?php echo esc_attr($tracking_tel_href); ?>" class="cv_button gtm-click-tel">
                <picture>
                  <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/tel.avif" type="image/avif">
                  <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/tel.webp" type="image/webp">
                  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/tel.png"
                    alt="お電話でのご相談はこちら: <?php echo esc_attr($tracking_tel_local); ?>"
                    width="350" height="90"
                    decoding="async">
                </picture>
              </a>
            </div>
            <div class="header--btn-item">
              <a href="#contact" class="cv_button gtm-click-mail">
                <picture>
                  <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/mail.avif" type="image/avif">
                  <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/mail.webp" type="image/webp">
                  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/mail.png"
                    alt="メールでお問い合わせ"
                    width="350" height="90"
                    decoding="async">
                </picture>
              </a>
            </div>
            <div class="header--btn-item">
              <a href="https://lin.ee/fXrKQyq" class="cv_button gtm-click-line">
                <picture>
                  <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/line.avif" type="image/avif">
                  <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/line.webp" type="image/webp">
                  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/line.png"
                    alt="LINEでお問い合わせ"
                    width="350" height="90"
                    decoding="async">
                </picture>
              </a>
            </div>
          </div>
        </div>

      </div>
    </section>

    <section class="merit sec">
      <div class="merit--inner">
        <h2>業務用エアコンの洗浄で得られる<br><span>5</span>つのメリット</h2>
        <ul>
          <li>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/merit_01.jpg" alt="" width="300" height="300" loading="lazy" decoding="async">
            <div>
              <h3>汚れによるエアコンの負荷を軽減し、<br class="is-hidden_sp">電気代のムダを抑えます。</h3>
              <p>
                フィルターや熱交換器に付着した汚れを除去し、風の通りを整えることで、機器にかかる余分な負担を抑えます。<br>
                節電効果は機種や使用環境、汚れの状態によって異なり、一定の削減額を保証するものではありません。
              </p>
            </div>
          </li>
          <li>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/merit_02.jpg" alt="" width="300" height="300" loading="lazy" decoding="async">
            <div>
              <h3>カビ臭・ホコリ臭・油っぽいニオイの原因<br class="is-hidden_sp">となる汚れを洗浄します</h3>
              <p>
                エアコン内部に付着したホコリ、カビ、油汚れなど、ニオイの原因になりやすい汚れを分解洗浄で取り除きます。<br>
                ニオイの原因や機種によって対応範囲が異なるため、現在の症状と設置状況を確認してご案内します。
              </p>
            </div>
          </li>
          <li>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/merit_03.jpg" alt="" width="300" height="300" loading="lazy" decoding="async">
            <div>
              <h3>風量や効きの悪さにつながる汚れを除去<br class="is-hidden_sp">快適な空間へ整えます</h3>
              <p>
                熱交換器や送風ファンにホコリや汚れがたまると、空気の流れが妨げられ、「設定温度にしても効きにくい」「風が弱い」といった状態につながります。内部まで分解して丁寧に洗浄することで、本来の風量や冷暖房効率を取り戻しやすい状態へ。<br>
                店舗やオフィス全体を、より快適な室温に保ちやすくします。
              </p>
            </div>
          </li>
          <li>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/merit_04.jpg" alt="" width="300" height="300" loading="lazy" decoding="async">
            <div>
              <h3>水漏れ・異音・能力低下などの<br class="is-hidden_sp">トラブル予防につなげます。</h3>
              <p>
                エアコン内部にたまったホコリや汚れ、ドレン部分の詰まりは、水漏れや動作不良を引き起こす原因の一つです。内部まで分解して洗浄し、汚れや詰まりを早めに取り除くことで、営業中の突然の停止や水漏れなどのトラブル予防につなげます。<br>
                定期的なメンテナンスで設備を良好な状態に保ちます。
              </p>
            </div>
          </li>
          <li>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/merit_05.jpg" alt="" width="300" height="300" loading="lazy" decoding="async">
            <div>
              <h3>定期的に汚れを除去して、<br class="is-hidden_sp">設備を良好な状態に保ちやすくなります。</h3>
              <p>
                エアコン内部に汚れがたまると、空気の流れが悪くなり、機器に余計な負荷がかかりやすくなります。定期的に熱交換器や送風ファンなどを洗浄し、負担を抑えることで、設備を良好な状態に保ちやすくなります。<br>
                突然の高額な修理や早期の買い替えリスクを抑え、中長期的な設備コストの削減につなげます。
              </p>
            </div>
          </li>
        </ul>
      </div>
    </section>

    <section class="select sec">
      <div class="select--inner">
        <h2>トータルスマートが<br>選ばれる<span>5</span>つの理由</h2>
        <ol>
          <li>
            <h3>カビやニオイの原因まで内部を徹底分解洗浄</h3>
            <div class="select--contents">
              <p>
                エアコンの表面だけを清掃するのではなく、外装パネルやフィルターなどを取り外し、<br class="is-hidden_sp">内部に付着したホコリやカビ汚れまで高圧洗浄します。<br>
                ニオイや汚れの原因になりやすい熱交換器や送風部分にも丁寧にアプローチし、<br class="is-hidden_sp">オフィス内の空気環境を清潔で快適な状態へ整えます。<br>
                さらに、洗浄後は、作業箇所の状態も分かりやすくご説明します。
              </p>
              <div class="select--img">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/select_01_01.jpg" alt="" width="310" height="250" loading="lazy" decoding="async">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/select_01_02.jpg" alt="" width="310" height="250" loading="lazy" decoding="async">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/select_01_03.jpg" alt="" width="310" height="250" loading="lazy" decoding="async">
              </div>
            </div>
          </li>
          <li>
            <h3>機種や設置状況に合わせて最適な方法で洗浄</h3>
            <div class="select--contents">
              <p>
                業務用エアコンは、天井埋込型や天井吊型、壁掛型など、機種によって構造や適切な洗浄方法が異なります。<br>
                設置場所や汚れの状態も確認したうえで、それぞれに適した手順で分解と洗浄を実施します。<br>
                型式が分からない場合も、確認可能な情報をもとに作業内容をご案内します。<br>
                また、現場の状況に応じて、無理のない進め方をご提案します。
              </p>
              <div class="select--img">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/select_02_01.jpg" alt="" width="310" height="250" loading="lazy" decoding="async">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/select_02_02.jpg" alt="" width="310" height="250" loading="lazy" decoding="async">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/select_02_03.jpg" alt="" width="310" height="250" loading="lazy" decoding="async">
              </div>
            </div>
          </li>
          <li>
            <h3>業務への影響を抑えた柔軟な作業方法を提案</h3>
            <div class="select--contents">
              <p>
                オフィスの営業時間や従業員の勤務状況を確認し、<br class="is-hidden_sp">通常業務への影響をできる限り抑えられる作業方法をご提案します。<br>
                複数台を洗浄する場合も、作業するエリアや順番を事前に調整し、<br class="is-hidden_sp">空調をすべて止める時間を減らしながら、職場環境に配慮して計画的に施工します。<br>
                さらに、事前に担当者様との確認を重ね、当日の進行も円滑に整えます。
              </p>
              <div class="select--img">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/select_03_01.jpg" alt="" width="310" height="250" loading="lazy" decoding="async">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/select_03_02.jpg" alt="" width="310" height="250" loading="lazy" decoding="async">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/select_03_03.jpg" alt="" width="310" height="250" loading="lazy" decoding="async">
              </div>
            </div>
          </li>
          <li>
            <h3>作業内容と料金を事前に明確にご案内します</h3>
            <div class="select--contents">
              <p>
                エアコンの種類や台数、設置状況を確認したうえで、<br class="is-hidden_sp">洗浄する範囲と必要な作業、料金の内訳を事前に分かりやすくご案内します。<br>
                どこまで洗浄するのか、何に費用がかかるのかを確認できるため、<br class="is-hidden_sp">法人のお客様も社内稟議や予算申請を進めやすく、安心して依頼できます。<br>
                また、必ず見積もり内容を確認してから、正式にご依頼いただけます。
              </p>
              <div class="select--img">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/select_04_01.jpg" alt="" width="310" height="250" loading="lazy" decoding="async">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/select_04_02.jpg" alt="" width="310" height="250" loading="lazy" decoding="async">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/select_04_03.jpg" alt="" width="310" height="250" loading="lazy" decoding="async">
              </div>
            </div>
          </li>
          <li>
            <h3>台数や型式が不明でも気軽にご相談できます</h3>
            <div class="select--contents">
              <p>
                設置されているエアコンの型式や正確な台数、必要な洗浄内容が分からない場合でもご相談いただけます。<br>
                分かる範囲の情報や設置状況を確認し、必要な作業内容をご案内します。<br>
                専門的な知識がなくてもお問い合わせできるため、まずは現在のお困りごとを気軽にお聞かせください。<br>
                ご相談の段階からも、分かりやすく丁寧に対応いたします。
              </p>
              <div class="select--img">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/select_05_01.jpg" alt="" width="310" height="250" loading="lazy" decoding="async">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/select_05_02.jpg" alt="" width="310" height="250" loading="lazy" decoding="async">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/select_05_03.jpg" alt="" width="310" height="250" loading="lazy" decoding="async">
              </div>
            </div>
          </li>
        </ol>
      </div>
    </section>

    <section class="price sec" id="price">
      <div class="contents">
        <span class="sign--catch">作業内容と料金をご確認ください</span>
        <h2>業務用エアコンのクリーニング料金</h2>
        <div class="price--img js-scrollable">
          <picture>
            <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/price.avif" type="image/avif">
            <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/price.webp" type="image/webp">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/price.png" alt="エアコンクリーニングの比較料金表" width="1503" height="689" loading="lazy" decoding="async">
          </picture>
        </div>
      </div>
    </section>

    <section class="case sec">
      <div class="contents">
        <span class="sign--catch">エアコンクリーニングするとここまできれいになります</span>
        <h2 class="ttl">クリーニングの施工事例</h2>

        <div class="case--item">
          <h3>その黒ずみ、お客様に見られています。</h3>
          <div class="case--inner">
            <p>
              エアコンの吹き出し口が黒く汚れていませんか？<br>
              それはホコリとカビが結合した頑固な汚れです。<br>
              大切なお客様に「不潔」な印象を与えかねません。<br>
              プロの技術でパーツを分解・洗浄すれば、見違えるような白さと清潔さが復活。<br>
              「空気が澄んで、お店が明るくなった！」と、オーナー様からも好評です。
            </p>
            <div class="case--comparison">
              <div class="case--before">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/case_03.jpg" alt="吹き出し口のクリーニング前" width="380" height="400" loading="lazy" decoding="async">
                <p>BEFORE</p>
              </div>
              <div class="case--after">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/case_04.jpg" alt="吹き出し口のクリーニング後" width="380" height="400" loading="lazy" decoding="async">
                <p>AFTER</p>
              </div>
            </div>
          </div>
        </div>

        <div class="case--item">
          <h3>黄ばみを一掃してお店の好感度アップ！</h3>
          <div class="case--inner">
            <p>
              吹き出し口の黒カビや、全体的に茶色くくすんだ汚れは、<br class="is-hidden_sp">
              長年のホコリと油煙が原因です。<br>
              不潔な印象を与えるだけでなく、嫌なニオイの元凶にもなります。<br>
              プロの洗浄技術なら、パネルの裏側から徹底クリーニング。<br>
              お客様が心地よく過ごせる空間へと生まれ変わらせます。<br>
            </p>
            <div class="case--comparison">
              <div class="case--before">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/case_05.jpg" alt="パネルのクリーニング前" width="380" height="400" loading="lazy" decoding="async">
                <p>BEFORE</p>
              </div>
              <div class="case--after">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/case_06.jpg" alt="パネルのクリーニング後" width="380" height="400" loading="lazy" decoding="async">
                <p>AFTER</p>
              </div>
            </div>
          </div>
        </div>

        <div class="case--item">
          <h3>フィルターに蓄積したホコリを除去</h3>
          <div class="case--inner">
            <p>長年蓄積されたホコリと汚れで、フィルターが完全に目詰まりしていました。<br>
              「最近、風がカビ臭い」「効きが悪い」と感じたら、<br class="is-hidden_sp">
              内部はもっと汚れているサインかもしれません。<br>
              分解洗浄では、日常のフィルター清掃だけでは落としにくい内部の汚れにも対応します。<br>
              店舗やオフィスの空調を清潔に保つため、機種と設置状況に合った洗浄方法をご案内します。</p>
            <div class="case--comparison">
              <div class="case--before">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/case_02.jpg" alt="フィルターのクリーニング前" width="380" height="400" loading="lazy" decoding="async">
                <p>BEFORE</p>
              </div>
              <div class="case--after">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/case_01.jpg" alt="フィルターのクリーニング後" width="380" height="400" loading="lazy" decoding="async">
                <p>AFTER</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>

    <section class="voice sec bg_skyblue" id="reviews">
      <div class="voice--inner">
        <h2>お客様からの評価も頂いています</h2>
        <div class="voice--contents">
          <div class="voice--item">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/voice_01.jpg" alt="" width="380" height="230" loading="lazy" decoding="async">
            <div>
              <ul>
                <li>オフィス</li>
                <li>天井カセット</li>
              </ul>
              <h3>オフィスの空気が一気に軽くなりました</h3>
              <span>名古屋市　IT企業　A様</span>
            </div>
            <p>クリーニング後は同じ設定温度でもムラなく冷え、
              会議室のこもったニオイも解消。<br>
              社員から「空気が変わった」と好評で、
              来客対応にも自信が持てるようになりました。</p>
          </div>
          <div class="voice--item">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/voice_02.jpg" alt="" width="380" height="230" loading="lazy" decoding="async">
            <div>
              <ul>
                <li>飲食店</li>
                <li>油汚れ</li>
              </ul>
              <h3>「前より居心地がいい」と言われました</h3>
              <span>岐阜市　飲食店　I様</span>
            </div>
            <p>油煙まじりの風がサラッと変わり、客席の
              カビっぽさもなくなりました。営業前後の
              冷暖房効率も上がり、ピークタイムでも安定
              して快適な温度を保てています。</p>
          </div>
          <div class="voice--item">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/voice_03.jpg" alt="" width="380" height="230" loading="lazy" decoding="async">
            <div>
              <ul>
                <li>クリニック</li>
                <li>天吊り</li>
              </ul>
              <h3>「清潔感が増した」と評判です</h3>
              <span>四日市市　クリニック　T様</span>
            </div>
            <p>天井カセットを分解洗浄してもらったところ、
              見えない内部の汚れに驚きました。<br>
              クリーニング後は空気がすっきりし、
              患者様やスタッフからも好印象の声が
              増えています。</p>
          </div>
          <div class="voice--item">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/voice_04.jpg" alt="" width="380" height="230" loading="lazy" decoding="async">
            <div>
              <ul>
                <li>クリニック</li>
                <li>天吊り</li>
              </ul>
              <h3>気になっていたニオイが改善しました</h3>
              <span>岡崎市　美容院　C様</span>
            </div>
            <p>
              ニオイと、以前より冷房の効きが悪くなっていることが気になり、クリーニングをお願いしました。<br>
              店内の空気もすっきりして、より快適な空間を提供できるようになりました。。
            </p>
          </div>
          <div class="voice--item">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/voice_05.jpg" alt="" width="380" height="230" loading="lazy" decoding="async">
            <div>
              <ul>
                <li>倉庫</li>
                <li>風量低下</li>
              </ul>
              <h3>倉庫内での作業が快適になりました</h3>
              <span>羽島市　配送業　H様</span>
            </div>
            <p>
              倉庫内が涼しくならず、吹き出す風も以前より弱く感じるようになったためお願いをしました。<br>
              クリーニング後は風量が以前より安定し、倉庫内の温度も下がりやすくなったようになりました。
            </p>
          </div>
          <div class="voice--item">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/voice_06.jpg" alt="" width="380" height="230" loading="lazy" decoding="async">
            <div>
              <ul>
                <li>クリニック</li>
                <li>天吊り</li>
              </ul>
              <h3>清潔感のある教室になりました</h3>
              <span>津市　教育　E様</span>
            </div>
            <p>
              湿ったようなニオイがすることがあり、お客様に不快な印象を与えないか心配になったため、クリーニングをお願いしました。<br>クリーニング後は清潔で
              快適な環境を整えられたことに満足しています。
            </p>
          </div>
        </div>
      </div>
    </section>

    <section class="flow sec">
      <div class="flow--inner">
        <h2>分解洗浄の作業手順</h2>
        <ol>
          <li>
            <span>STEP1</span>
            <div>
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/flow_01.jpg" alt="" width="180" height="100" loading="lazy" decoding="async">
              <dl>
                <dt>エアコンの分解</dt>
                <dd>
                  パーツを分解していきます。<br>
                  内部の汚れを確認します。
                </dd>
              </dl>
            </div>
          </li>
          <li>
            <span>STEP2</span>
            <div>
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/flow_02.jpg" alt="" width="180" height="100" loading="lazy" decoding="async">
              <dl>
                <dt>ホコリ除去</dt>
                <dd>
                  ホコリや汚れを<br>
                  丁寧に取り除きます。
                </dd>
              </dl>
            </div>
          </li>
          <li>
            <span>STEP3</span>
            <div>
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/flow_03.jpg" alt="" width="180" height="100" loading="lazy" decoding="async">
              <dl>
                <dt>エアコン内部洗浄</dt>
                <dd>
                  専用洗剤で熱交換器や<br>
                  内部を洗浄します。
                </dd>
              </dl>
            </div>
          </li>
          <li>
            <span>STEP4</span>
            <div>
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/flow_04.jpg" alt="" width="180" height="100" loading="lazy" decoding="async">
              <dl>
                <dt>パーツの汚れ除去</dt>
                <dd>
                  分解したパーツも<br>
                  細部まで洗浄します。
                </dd>
              </dl>
            </div>
          </li>
          <li>
            <span>STEP5</span>
            <div>
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/flow_05.jpg" alt="" width="180" height="100" loading="lazy" decoding="async">
              <dl>
                <dt>最終確認</dt>
                <dd>
                  正常に動くか確認し、<br>
                  拭き上げまで行います。
                </dd>
              </dl>
            </div>
          </li>
        </ol>
        <ul class="flow--icons">
          <li>養生して丁寧に作業</li>
          <li>営業前・営業後も相談可</li>
          <li>作業内容は事前にご案内</li>
        </ul>
      </div>
    </section>

    <section class="use sec">
      <div class="contents">
        <h2>ご利用の流れ</h2>
        <ol>
          <li>
            <div class="use--txt">
              <h3>お問い合わせ</h3>
              <img class="is-hidden_pc" src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/use_01.jpg" alt="" width="250" height="250" loading="lazy" decoding="async">
              <p>業務用エアコンの型番・台数・設置場所や、汚れ・ニオイなどのお困りごとを、
                お電話またはメールフォームにてお知らせください。</p>
            </div>
            <div>
              <img class="is-hidden_sp" src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/use_01.jpg" alt="" width="250" height="250" loading="lazy" decoding="async">
            </div>
          </li>
          <li>
            <div class="use--txt">
              <h3>ヒアリング</h3>
              <img class="is-hidden_pc" src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/use_02.jpg" alt="" width="250" height="250" loading="lazy" decoding="async">
              <p>
                お見積り訪問日時などを相談させていただきます。<br>
                エアコンの機種や台数、汚れの状態、店舗・施設の営業時間などを伺い、
                必要な洗浄内容と作業条件を確認します。
              </p>
            </div>
            <div>
              <img class="is-hidden_sp" src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/use_02.jpg" alt="" width="250" height="250" loading="lazy" decoding="async">
            </div>
          </li>
          <li>
            <div class="use--txt">
              <h3>お見積りご提示</h3>
              <img class="is-hidden_pc" src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/use_03.jpg" alt="" width="250" height="250" loading="lazy" decoding="async">
              <p>
                担当スタッフが訪問し、お掃除対象箇所を確認後無料でお見積りを
                ご提示します。<br>
                お掃除の際の注意事項などもご説明します。
              </p>
            </div>
            <div>
              <img class="is-hidden_sp" src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/use_03.jpg" alt="" width="250" height="250" loading="lazy" decoding="async">
            </div>
          </li>
          <li>
            <div class="use--txt">
              <h3>スケジュールの相談</h3>
              <img class="is-hidden_pc" src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/use_04.jpg" alt="" width="250" height="250" loading="lazy" decoding="async">
              <p>お見積りから正式にご依頼をいただいたのち、サービス実施日時やスケジュールについて相談させていただきます。</p>
            </div>
            <div>
              <img class="is-hidden_sp" src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/use_04.jpg" alt="" width="250" height="250" loading="lazy" decoding="async">
            </div>
          </li>
          <li>
            <div class="use--txt">
              <h3>サービス実施</h3>
              <img class="is-hidden_pc" src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/use_05.jpg" alt="" width="250" height="250" loading="lazy" decoding="async">
              <p>担当スタッフが訪問し、サービスを実施します。お見積り以上の請求が発生することはありませんが、追加のご要望などがあれば請求額が変わる場合もございます。</p>
            </div>
            <div>
              <img class="is-hidden_sp" src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/use_05.jpg" alt="" width="250" height="250" loading="lazy" decoding="async">
            </div>
          </li>
        </ol>
      </div>
    </section>

    <section class="region sec" id="area">
      <div class="contents -md">
        <h2>対応エリア</h2>
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/map.png" alt="" width="518" height="534" loading="lazy" decoding="async">
        <dl>
          <div>
            <dt>愛知エリア</dt>
            <dd>
              名古屋市（天白区・北区・昭和区・千種区・中区・中川区・西区・東区・瑞穂区・緑区・南区・港区・名東区・守山区）・
              愛西市・あま市・安城市・一宮市・稲沢市・大府市・岡崎市・尾張旭市・春日井市・刈谷市・北名古屋市・清須市・江南市・
              小牧市・瀬戸市・高浜市・知多市・知立市・津島市・東海市・常滑市・豊明市・豊田市・長久手市・西尾市・日進市・半田市・
              碧南市・みよし市・弥富市・東郷町・大治町・蟹江町・阿久比町・美浜町・扶桑町・新城市・豊川市・豊橋市・蒲郡市・幸田町
            </dd>
          </div>
          <div>
            <dt>岐阜エリア</dt>
            <dd>
              岐阜市・羽島市・各務原市・山県市・瑞穂市・本巣市・羽島郡・本巣郡・大垣市・海津市・養老郡・不破郡・安八郡・揖斐郡・
              関市・美濃市・美濃加茂市・可児市・多治見市・瑞浪市・恵那市
            </dd>
          </div>
          <div>
            <dt>三重エリア</dt>
            <dd>
              桑名市・いなべ市・木曽岬町・東員町・四日市市・朝日町・川越町・鈴鹿市・亀山市・津市・松阪市・多気町・明和町・大台町・伊勢市・
              鳥羽市・志摩市・玉城町・度会町・伊賀市・名張市
            </dd>
          </div>
          <div>
            <dt>静岡エリア</dt>
            <dd>
              浜松市・磐田市・掛川市・袋井市・湖西市・御前崎市・菊川市・森町・静岡市・島田市・焼津市・藤枝市・牧之原市・吉田町・
              川根本町・沼津市・熱海市・三島市・富士宮市・伊東市・富士市・御殿場市・裾野市・伊豆市・伊豆の国市・函南町・清水町・
              長泉町・小山町・下田市・東伊豆町・河津町・南伊豆町・松崎町・西伊豆町
            </dd>
          </div>
        </dl>
      </div>
    </section>

    <section class="faq sec">
      <div class="contents -md">
        <h2>クリーニングのよくある質問</h2>
        <p>
          業務用エアコンのクリーニングについて、よくいただくご質問をまとめました。<br>
          設置状況や機種によって異なる場合がありますので、まずはお気軽にお問い合わせください。
        </p>
        <dl>
          <dt>対応エリアはどこですか？</dt>
          <dd>愛知県・岐阜県・三重県・静岡県の法人・店舗・施設を基本対象としています。<br>
            まずはエアコンの設置場所をお知らせください。</dd>
          <dt>どのような施設のエアコンクリーニングに対応していますか？</dt>
          <dd>店舗、オフィス、工場、倉庫、クリニック、介護施設、商業施設、事務所など、法人・店舗・施設向けの業務用エアコンクリーニングに対応しています。</dd>
          <dt>業務用エアコンのクリーニング料金はいくらですか？</dt>
          <dd>簡単クリーニングは5,000円〜、分解洗浄は18,000円〜（いずれも税抜）です。<br>
            お掃除機能付きは＋6,000円です。機種・台数・設置状況によって金額が変わるため、型番や写真をもとにお見積もりします。</dd>
          <dt>業務用エアコンはどのくらいの頻度でクリーニングしたほうがよいですか？</dt>
          <dd>使用環境や稼働時間によって異なりますが、定期的なクリーニングをおすすめしています。<br>
            飲食店や工場など、油・ホコリ・粉じんが多い環境では汚れやすいため、使用状況を確認したうえで適切なクリーニング時期をご案内します。</dd>
          <dt>エアコンの効きが悪いのですが、クリーニングで改善しますか？</dt>
          <dd>フィルターや熱交換器、内部部品に汚れが蓄積している場合は、クリーニングによって風量や空調効率が改善することがあります。<br>
            ただし、故障や冷媒などが原因の場合もあるため、状況を確認しながらご案内します。</dd>
          <dt>エアコンから臭いがするのですが、クリーニングできますか？</dt>
          <dd>はい、ご相談いただけます。エアコン内部に付着したホコリ、カビ、油汚れなどが臭いの原因になっている場合があります。<br>
            内部を分解して洗浄することで、汚れや臭いの原因を取り除いていきます。</dd>
          <dt>どのような業務用エアコンをクリーニングできますか？</dt>
          <dd>天井カセット形、天井吊形、床置形、壁掛形など、さまざまな業務用エアコンのクリーニングをご相談いただけます。<br>
            現在のエアコンの種類が分からない場合は、型番や写真をお送りください。</dd>
          <dt>複数台のエアコンをまとめてクリーニングできますか？</dt>
          <dd>はい、複数台の業務用エアコンもまとめてご相談いただけます。<br>
            店舗、オフィス、工場、施設など、複数台設置されている現場についても、台数や作業条件を確認したうえでお見積もりします。</dd>
          <dt>営業中の店舗や稼働中の施設でも作業できますか？</dt>
          <dd>作業内容や現場状況によって異なりますが、営業や業務への影響をできるだけ抑えられるよう、作業日程や時間帯を確認しながら調整します。<br>
            休日・営業時間外の作業をご希望の場合も事前にご相談ください。</dd>
          <dt>クリーニングにはどのくらい時間がかかりますか？</dt>
          <dd>作業時間は、エアコンの種類、台数、汚れの程度、設置状況によって異なります。<br>
            営業時間や施設の稼働予定がある場合は、事前にお知らせいただければ作業スケジュールをご案内します。</dd>
          <dt>見積もりをお願いするには何を伝えればよいですか？</dt>
          <dd>エアコンの型番、種類、台数、設置場所、設置状況が分かる写真などをご用意いただけるとスムーズです。<br>
            詳細が分からない場合でも、分かる範囲でお知らせいただければご案内します。</dd>
          <dt>クリーニングを依頼するか決まっていなくても相談できますか？</dt>
          <dd>はい、ご相談いただけます。エアコンの汚れ、臭い、効きの悪さ、クリーニング時期など、気になる症状や現在の状況をお知らせください。<br>
            設置状況や使用環境を確認しながら、必要なクリーニング内容をご案内します。</dd>
        </dl>
      </div>
    </section>

    <section class="contact sec" id="contact">
      <div class="contents">
        <h2 class="ttl">無料見積もり・お問い合わせ</h2>
        <p class="contact--lead">
          店舗・オフィスのエアコンの型番や台数、汚れ・ニオイなどのお困りごとを、<br class="is-hidden_sp">
          こちらのフォームからお知らせください。<br>
          内容を確認し、無料でお見積もり・ご提案いたします。
        </p>
        <p class="contact--remarks">簡単入力<span>1分</span>で完了</p>
        <ul class="contact--step">
          <li>項目の入力</li>
          <!-- <li>入力内容の確認</li> -->
          <li>送信完了</li>
        </ul>
        <?php echo do_shortcode('[contact-form-7 id="565" title="エアコンのクリーニングのフォーム"]'); ?>
      </div>
    </section>
  </main>

  <div class="footer_btn_fixed" id="js_fixed-btn">
    <p class="footer_btn_fixed--tel"><a href="tel:<?php echo esc_attr($tracking_tel_href); ?>">電話で<br>予約する</a></p>
    <p class="footer_btn_fixed--mail"><a href="#contact">メールで<br>無料見積り</a></p>
    <p class="footer_btn_fixed--line"><a href="https://lin.ee/fXrKQyq">LINEで<br>問い合わせ</a></p>
  </div>

  <footer class="footer">
    <div class="contents -md">
      <div>
        <div class="footer--logo">
          <a href="<?php echo esc_url(home_url('/')); ?>">
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/logo_footer.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/logo_footer.webp" type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/logo_footer.png"
                alt="トータルスマート株式会社"
                width="397" height="84"
                decoding="async">
            </picture>
            <p>愛知県・岐阜県・三重県・静岡県の業務用エアコンクリーニングはトータルスマート株式会社</p>
          </a>
        </div>
        <div class="footer--info">
          <p>〒461-0002 愛知県名古屋市東区代官町16-17
            <br>代官町ビルディング2F
          </p>
          <p>TEL:<?php echo esc_html($main_tel_local); ?></p>
          <p>FAX:052-932-5451</p>
        </div>
      </div>
      <div class="footer--catch">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/footer_catch.jpg" alt="トータルスマート" width="357" height="349" decoding="async">
      </div>
    </div>
    <p class="footer--copy"><small>Copyright© トータルスマート株式会社 All Rights Reserved.</small></p>
  </footer>

  <?php wp_footer(); ?>
</body>

</html>