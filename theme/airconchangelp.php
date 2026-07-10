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

// NAP（代表番号）と、広告計測等で使う番号（表示している番号）を分離
$main_tel_local     = '052-932-5450';
$main_tel_intl      = '+81-52-932-5450';

// tel: hrefは数字列（端末互換性重視）に正規化（表示テキストはそのまま）
$main_tel_href     = preg_replace('/[^0-9]/', '', $main_tel_local);     // 0529325450

// SEOプラグインの有無（重複出力回避）
$has_seo_plugin = defined('WPSEO_VERSION') || defined('RANK_MATH_VERSION') || defined('AIOSEO_VERSION');

// このテンプレート用のdescription（必要なら固定文→カスタムフィールド化推奨）
$meta_description = '愛知・岐阜・三重・静岡で業務用エアコンの交換・取り換え・入れ替え・買い替え。電話・メールで無料見積り。';
$meta_description = wp_strip_all_tags($meta_description);
if (function_exists('mb_strimwidth')) {
  $meta_description = mb_strimwidth($meta_description, 0, 120, '…', 'UTF-8');
}

// title-tag 非対応テーマのための保険（テーマが対応ならwp_head側で出る）
$meta_title = '業務用エアコンの交換・取り換え・入れ替え・買い替え｜株式会社トータルスマート';

// ---------------------------
// JSON-LD（表示内容と整合）
// ※SEOプラグインがschemaを出す場合が多いのでガード
// ---------------------------
$offers = [
  [
    '@type' => 'Offer',
    'name'  => '簡単クリーニング（フィルター清掃・風速測定・温度測定）',
    'url'   => $page_url . '#price',
    'price' => '5000',
    'priceCurrency' => 'JPY',
    'priceSpecification' => [
      '@type' => 'UnitPriceSpecification',
      'price' => '5000',
      'priceCurrency' => 'JPY',
      'valueAddedTaxIncluded' => false, // LP表記が「税抜」
    ],
  ],
  [
    '@type' => 'Offer',
    'name'  => 'しっかりクリーニング（分解洗浄）',
    'url'   => $page_url . '#price',
    'price' => '18000',
    'priceCurrency' => 'JPY',
    'priceSpecification' => [
      '@type' => 'UnitPriceSpecification',
      'price' => '18000',
      'priceCurrency' => 'JPY',
      'valueAddedTaxIncluded' => false,
    ],
  ],
  [
    '@type' => 'Offer',
    'name'  => 'お掃除機能付きオプション',
    'url'   => $page_url . '#price',
    'price' => '6000',
    'priceCurrency' => 'JPY',
    'priceSpecification' => [
      '@type' => 'UnitPriceSpecification',
      'price' => '6000',
      'priceCurrency' => 'JPY',
      'valueAddedTaxIncluded' => false,
    ],
  ],
];

$website = [
  '@type' => 'WebSite',
  '@id'   => $home_url . '#website',
  'url'   => $home_url,
  'name'  => '株式会社トータルスマート',
  'inLanguage' => 'ja-JP',
];

$primary_image = [
  '@type' => 'ImageObject',
  '@id'   => $page_url . '#primaryimage',
  'url'   => $mv_url,
];

$business = [
  // できる限り具体的なLocalBusinessサブタイプ（HVACBusiness）に寄せる
  '@type' => 'HVACBusiness',
  '@id'   => $home_url . '#localbusiness',
  'name'  => '株式会社トータルスマート',
  'url'   => $home_url,
  // NAPの代表番号
  'telephone' => $main_tel_intl,
  'logo'  => $logo_url,
  'image' => [$mv_url],
  // LP表示（5,000 / 18,000 + 6,000）に合わせてレンジを上限24,000まで含める
  'priceRange' => '¥5,000〜¥24,000（税抜）',
  'paymentAccepted' => '現金',
  'currenciesAccepted' => 'JPY',
  'address' => [
    '@type' => 'PostalAddress',
    'postalCode' => '461-0002',
    'addressRegion' => '愛知県',
    'addressLocality' => '名古屋市東区',
    'streetAddress' => '代官町16-17 代官町ビルディング2F',
    'addressCountry' => 'JP',
  ],
  'areaServed' => [
    ['@type' => 'AdministrativeArea', 'name' => '愛知県'],
    ['@type' => 'AdministrativeArea', 'name' => '岐阜県'],
    ['@type' => 'AdministrativeArea', 'name' => '三重県'],
    ['@type' => 'AdministrativeArea', 'name' => '静岡県'],
  ],
  'contactPoint' => [
    [
      '@type' => 'ContactPoint',
      'telephone' => $main_tel_intl,
      'contactType' => 'customer service',
      'availableLanguage' => ['ja'],
    ],
  ],
  'makesOffer' => $offers,
];

$service = [
  '@type' => 'Service',
  '@id'   => $page_url . '#service',
  'name'  => 'エアコンクリーニング（エアコン掃除）',
  'provider' => ['@id' => $home_url . '#localbusiness'],
  'areaServed' => $business['areaServed'],
  'offers' => $offers,
];

$webpage = [
  '@type' => 'WebPage',
  '@id'   => $page_url . '#webpage',
  'url'   => $page_url,
  'name'  => $meta_title,
  'inLanguage' => 'ja-JP',
  'isPartOf' => ['@id' => $home_url . '#website'],
  'primaryImageOfPage' => ['@id' => $page_url . '#primaryimage'],
  'about' => ['@id' => $page_url . '#service'],
  'mainEntity' => ['@id' => $page_url . '#service'],
];

$faqpage = [
  '@type' => 'FAQPage',
  '@id'   => $page_url . '#faq',
  'mainEntity' => [
    [
      '@type' => 'Question',
      'name'  => '表示されている料金以外に、追加でかかる費用はありますか？',
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text'  => 'エアコン本体の料金＋オプション（ご希望時のみ）が総額です。出張費・基本的な養生・洗浄作業料はすべて含まれています。勝手に追加請求することは一切ございません。お客様にとって一番負担の少ない方法をご提案し、無理な工事を押しつけることもありません。',
      ],
    ],
    [
      '@type' => 'Question',
      'name'  => '出張料はかかりますか？？',
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text'  => '出張料はいただきません。',
      ],
    ],
    [
      '@type' => 'Question',
      'name'  => 'キャンセル料はかかりますか？',
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text'  => 'お見積りをした後でも、納得がいかなければキャンセルいただけます。作業着手前のキャンセルに関しては代金をいただいておりません。',
      ],
    ],
    [
      '@type' => 'Question',
      'name'  => '事前に準備しておくことはありますか？',
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text'  => '下記のご協力をお願いしています。エアコンの真下や周辺にある小物・壊れやすいものの移動、作業スペースとして1〜2畳ほどの空きスペースの確保、お風呂場またはベランダなど、部品洗浄に使用できる場所のご提供。',
      ],
    ],
    [
      '@type' => 'Question',
      'name'  => '猫や犬などのペットがいますが大丈夫ですか？',
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text'  => 'エアコンクリーニングなどの作業には基本的にはオーガニック洗剤を使用しています。安心して下さい。',
      ],
    ],
  ],
];

$ld_json = [
  '@context' => 'https://schema.org',
  '@graph' => [$website, $primary_image, $business, $service, $webpage, $faqpage],
];

add_action('wp_head', static function () use ($ld_json, $has_seo_plugin) {
  static $printed = false;
  if ($printed || is_admin() || $has_seo_plugin) {
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

  <link rel="preload" as="image" href="<?php echo esc_url(get_theme_file_uri('airconchangelp/img/logo.avif')); ?>" type="image/avif">
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
        <a href="<?php echo esc_url(home_url('/airconchangelp/')); ?>">
          <p>業務用エアコンの交換・取り換え・入れ替え・買い替えは<br>トータルスマート株式会社</p>

          <h1>
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/logo.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/logo.webp" type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/logo.png"
                alt="株式会社トータルスマート"
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
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/tel.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/tel.webp" type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/tel.png"
                alt="お電話でのご相談はこちら: <?php echo esc_attr($tracking_tel_local); ?>"
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
      <picture>
        <source
          media="(max-width: 767px)"
          srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/mv_sp.avif"
          type="image/avif">
        <source
          media="(max-width: 767px)"
          srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/mv_sp.webp"
          type="image/webp">
        <source
          media="(max-width: 767px)"
          srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/mv_sp.jpg">

        <source
          srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/mv.avif"
          type="image/avif">
        <source
          srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/mv.webp"
          type="image/webp">

        <img
          src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/mv.jpg"
          alt="エアコンクリーニングなら株式会社トータルスマート"
          width="1920" height="1778"
          fetchpriority="high"
          decoding="async">
      </picture>
    </div>

    <section class="issue sec">
      <div class="contents">
        <h2>
          業務用エアコンの<br class="is-hidden_sp">
          <strong><b><span>不</span><span>調</span></b></strong>や<strong><b><span>老</span><span>朽</span><span>化</span></b></strong>を<br class="is-hidden_sp">
          そのままにしていませんか？？
        </h2>
        <p>
          業務用エアコンは、故障してから慌てて交換しようとすると、<br class="is-hidden_sp">
          <span>営業停止、従業員や来店客の不快感、</span><br class="is-hidden_sp">
          <span>急な工事費用の発生</span>につながる場合があります。<br class="is-hidden_sp">
          特に店舗・工場・オフィス・施設では、<br class="is-hidden_sp">
          空調トラブルがそのまま事業運営のリスクになります。
        </p>
        <img class="issue--img" src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/issue_catch.png" alt="" width="674" height="520" decoding="async">

        <div class="issue--inner">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/issue_txt.png" alt="" width="900" height="100" decoding="async">
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

    <section class="solution sec">
      <div class="contents">
        <div class="solution--inner">
          <h2>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/solution_ttl.png" alt="" width="1194" height="120" decoding="async">
          </h2>
          <div class="solution--lead">
            業務用エアコンの<br class="is-hidden_sp">
            <p class="solution--item"><span>交換</span><span>取り換え</span><span>入れ替え</span><span>買い替え</span></p>は
          </div>
          <p class="solution--strong">
            <strong>トータルスマート株式会社</strong>に<br class="is-hidden_sp">
            お任せください
          </p>
          <div class="solution--guide">
            <div>
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/solution_txt_1.png" alt="" width="686" height="163" decoding="async">
            </div>
            <p>
              現在のエアコンの写真、設置場所、台数、使用年数など、<br class="is-hidden_sp">
              分かる範囲の情報だけでご相談いただけます。<br class="is-hidden_sp">
              修理を続けるべきか、交換した方がよいか、<br class="is-hidden_sp">
              現地状況を確認したうえでご案内します。
            </p>
          </div>
          <div class="solution--cv">
            <p>お問い合わせはこちらから</p>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/solution_txt_2.png" alt="" width="683" height="59" decoding="async">
            <div class="header--btns">
              <div class="header--btn-item">
                <a href="tel:<?php echo esc_attr($tracking_tel_href); ?>" class="cv_button gtm-click-tel">
                  <picture>
                    <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/tel.avif" type="image/avif">
                    <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/tel.webp" type="image/webp">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/tel.png"
                      alt="お電話でのご相談はこちら: <?php echo esc_attr($tracking_tel_local); ?>"
                      width="487" height="144"
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
                      decoding="async">
                  </picture>
                </a>
              </div>
            </div>
          </div>
          <div class="solution--img">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/solution_catch_01.jpg" alt="" width="400" height="250" decoding="async">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/solution_catch_02.jpg" alt="" width="400" height="250" decoding="async">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/solution_catch_03.jpg" alt="" width="400" height="250" decoding="async">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/solution_catch_04.jpg" alt="" width="400" height="250" decoding="async">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/solution_catch_05.jpg" alt="" width="400" height="250" decoding="async">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/solution_catch_06.jpg" alt="" width="400" height="250" decoding="async">
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
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_icon_01.jpg" alt="" width="250" height="250" decoding="async">
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
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_icon_02.jpg" alt="" width="250" height="250" decoding="async">
            <p>
              部屋の広さだけで選ぶと、冷暖房が効きにくい、電気代が高くなる、必要以上に高額な機器を選んでしまうといった問題につながる場合があります。<br class="is-hidden_sp">
              施設用途、稼働時間、天井高、利用人数、発熱機器の有無を確認し、現場に合った機種・馬力・台数をご提案します。
            </p>
          </article>
          <article>
            <h3>本体販売から取付工事まで<br class="is-hidden_sp"><span>まとめて依頼できます</span></h3>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_icon_03.jpg" alt="" width="250" height="250" decoding="async">
            <p>
              業務用エアコンの交換では、本体の選定だけでなく、配管、電源、室外機の設置場所、搬入経路、工事可能日まで確認する必要があります。<br class="is-hidden_sp">
              機器の手配から取付工事までまとめて対応し、販売店、工事業者、撤去業者を個別に探す手間を抑えられます。
            </p>
          </article>
          <article>
            <h3><span>既存機器の撤去・フロン回収</span><br class="is-hidden_sp">本体販売から取付工事まで</h3>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_icon_04.jpg" alt="" width="250" height="250" decoding="async">
            <p>
              古い業務用エアコンを交換する際は、新しい機器の設置だけでなく、既存機器の撤去やフロン回収に関する確認も必要です。<br class="is-hidden_sp">
              交換時に必要となる撤去、回収、処分まわりについても、現在の設置状況に合わせてご相談いただけます。
            </p>
          </article>
          <article>
            <h3><span>業務の影響を抑えた</span><br class="is-hidden_sp">工事計画を提案します</h3>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_icon_05.jpg" alt="" width="250" height="250" decoding="async">
            <p>
              古い業務用エアコンを交換する際は、新しい機器の設置だけでなく、既存機器の撤去やフロン回収に関する確認も必要です。<br class="is-hidden_sp">
              交換時に必要となる撤去、回収、処分まわりについても、現在の設置状況に合わせてご相談いただけます。
            </p>
          </article>
          <article>
            <h3><span>追加の工事・費用</span>は<br class="is-hidden_sp">事前に確認できます</h3>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_icon_06.jpg" alt="" width="250" height="250" decoding="async">
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
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_txt.png" alt="" width="776" height="76" decoding="async">
          </h3>
          <div>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_maker_01.png" alt="" width="397" height="61" decoding="async">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_maker_02.png" alt="" width="338" height="72" decoding="async">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_maker_03.png" alt="" width="408" height="63" decoding="async">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_maker_04.png" alt="" width="394" height="76" decoding="async">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_maker_05.png" alt="" width="314" height="131" decoding="async">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_maker_06.png" alt="" width="371" height="59" decoding="async">
          </div>
        </section>


        <section class="service--building">
          <h3>
            店舗・事務所・工場・施設など幅広く対応
          </h3>
          <div class="service--img">
            <div>
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_building_01.jpg" alt="" width="350" height="250" decoding="async">
              <p>事務所</p>
            </div>
            <div>
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_building_02.jpg" alt="" width="350" height="250" decoding="async">
              <p>飲食店</p>
            </div>
            <div>
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_building_03.jpg" alt="" width="350" height="250" decoding="async">
              <p>美容院</p>
            </div>
            <div>
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_building_04.jpg" alt="" width="350" height="250" decoding="async">
              <p>クリニック</p>
            </div>
            <div>
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_building_05.jpg" alt="" width="350" height="250" decoding="async">
              <p>工場・倉庫</p>
            </div>
            <div>
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/service_building_06.jpg" alt="" width="350" height="250" decoding="async">
              <p>塾</p>
            </div>
          </div>
        </section>
      </div>
    </section>

    <section class="reason sec">
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
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/reason_01.jpg" alt="" width="500" height="300" decoding="async">
            <h3>省エネ性能まで考えた機種選定</h3>
            <p>
              同じ馬力でも省エネ性能や制御機能によって、長期的な電気代が変わります。<br>
              安い機種を選ぶと、初期費用は抑えられても、毎月の電気代で損をする可能性があります。<br>
              使用時間、部屋の広さ、天井高、人数、熱源、業種、営業日数を確認し、過剰スペックにも能力不足にもならない機種をご提案します。<br>
              初期費用だけでなく、運用コストまで考えたサポートをします。
            </p>
          </article>
          <article>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/reason_02.jpg" alt="" width="500" height="300" decoding="async">
            <h3>総額が見える見積り</h3>
            <p>
              交換費用は、本体価格だけでは判断できません。<br>
              撤去費、配管工事、電源工事、冷媒回収、搬入経路、室外機の設置条件によって総額が変わります。<br>
              現地状況を確認したうえで「本体費」「標準工事費」「撤去・処分費」「追加工事の可能性」を分けてご提示します。<br>
              あとから追加費用が膨らむ不安を抑え、納得して比較できる見積りを行います。
            </p>
          </article>
          <article>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/reason_03.jpg" alt="" width="500" height="300" decoding="async">
            <h3>業種別に最適な空調を提案</h3>
            <p>
              飲食店、美容室、クリニック、事務所など空調に求められる条件が異なります。<br>
              飲食店では厨房熱や油汚れ、美容室では薬剤臭や温度ムラ、クリニックでは快適性と清潔感の配慮が必要です。<br>
              単に既存機器と同等品を入れ替えるだけでなく、業種・使用環境・お客様の動線・スタッフの作業環境に合わせて、最適なタイプと能力を選定します。
            </p>
          </article>
          <article>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/reason_04.jpg" alt="" width="500" height="300" decoding="async">
            <h3>工事後の保証・アフター対応</h3>
            <p>
              業務用エアコンは、設置して終わりではありません。長く安定して使うには、工事品質、試運転、保証、メンテナンス体制が重要です。<br>
              設置後に試運転を行い、冷暖房の効き、異音、排水、リモコン動作などを確認します。<br>
              工事後の不具合やメンテナンスの相談にも対応し、長期的に安心して使える環境をサポートします。
            </p>
          </article>
          <article>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/reason_05.jpg" alt="" width="500" height="300" decoding="async">
            <h3>リース・分割払いの相談ができる</h3>
            <p>
              業務用エアコンの交換や買い替えをするとまとまった初期費用がかかります。<br>
              一括での支払いが難しい場合にはリース、分割払いなどを検討することが重要です。<br>
              初期費用を抑えたい、月額化したいといったご相談にも対応します。<br>
              購入がよいのか、リースがよいのかも、使用年数や台数、会社の資金計画に合わせてご提案します。
            </p>
          </article>
          <article>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/reason_06.jpg" alt="" width="500" height="300" decoding="async">
            <h3>工事後の保証・アフター対応</h3>
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
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/worry_01.jpg" alt="" width="350" height="250" decoding="async">
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
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/worry_02.jpg" alt="" width="350" height="250" decoding="async">
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
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/worry_03.jpg" alt="" width="350" height="250" decoding="async">
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
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/worry_04.jpg" alt="" width="350" height="250" decoding="async">
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
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/worry_05.jpg" alt="" width="350" height="250" decoding="async">
          </div>
        </article>
      </div>
    </section>

    <div class="cvarea">
      <div class="cvarea--btn">
        <div class="header--btns">
          <div class="header--btn-item">
            <a href="tel:<?php echo esc_attr($tracking_tel_href); ?>" class="cv_button gtm-click-tel">
              <picture>
                <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/tel.avif" type="image/avif">
                <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/tel.webp" type="image/webp">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/tel.png"
                  alt="お電話でのご相談はこちら: <?php echo esc_attr($tracking_tel_local); ?>"
                  width="487" height="144"
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
          type="image/avif">
        <source
          media="(max-width: 767px)"
          srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/cvarea_sp.webp"
          type="image/webp">
        <source
          media="(max-width: 767px)"
          srcset="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/cvarea_sp.jpg">

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
          width="1920" height="1778"
          fetchpriority="high"
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
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/flow_01.jpg" alt="" width="450" height="250" decoding="async">
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
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/flow_02.jpg" alt="" width="450" height="250" decoding="async">
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
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/flow_03.jpg" alt="" width="450" height="250" decoding="async">
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
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/flow_04.jpg" alt="" width="450" height="250" decoding="async">
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
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/flow_05.jpg" alt="" width="450" height="250" decoding="async">
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
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/flow_06.jpg" alt="" width="450" height="250" decoding="async">
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
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/flow_07.jpg" alt="" width="450" height="250" decoding="async">
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
        <dl>
          <dt>対応エリアはどこですか？？</dt>
          <dd>
            愛知県・岐阜県・三重県・静岡県の法人・店舗・施設を基本対象としています。<br>
            まずは設置場所をお知らせください。
          </dd>
          <dt>どのような施設に対応していますか？</dt>
          <dd>
            店舗、オフィス、工場、倉庫、クリニック、介護施設、商業施設、事務所など、法人・店舗・施設向けの業務用エアコン導入・交換に対応しています。
          </dd>
          <dt>現地調査や見積もりは必要ですか？</dt>
          <dd>
            業務用エアコンは、機器の馬力や台数だけでなく、配管、電源、搬入経路、室外機の設置場所、 既存機器の撤去条件によって費用が変わります。<br>
            事前に型番・設置写真・室外機写真・台数を共有頂けるとスムーズです。
          </dd>
          <dt>業務用エアコンの交換時期を相談できますか？</dt>
          <dd>
            はい、相談可能です。<br>
            設置から10年以上経過している場合や、修理を繰り返している場合は、交換を検討するタイミングです。<br>
            使用状況を確認したうえで、交換したほうがよいかをご案内します。
          </dd>
          <dt>修理と交換のどちらがいいかわからないです</dt>
          <dd>
            是非一度私たちにご相談をしてください。<br>
            使用年数、故障頻度、修理費用、部品供給の状況、電気代、現在の効き具合などを確認し、修理を続けるべきか、交換・買い替えを検討すべきかを整理します。
          </dd>
          <dt>機種や馬力の選び方が分かりません</dt>
          <dd>
            業務用エアコンは、部屋の広さだけで機種を決めると、能力不足や過剰設備につながる場合があります。<br>
            施設の用途、稼働時間、天井高、熱源、利用人数、設置環境を確認し、現場に合った機種・馬力・形状をご提案します。
          </dd>
          <dt>対応できる業務用エアコンの種類は何ですか？</dt>
          <dd>
            天井カセット形、天井吊形、床置形、壁掛形業務用エアコン、ビルトイン形、ダクト形、パッケージエアコンなど、各種業務用エアコンの導入・交換をご相談いただけます。<br>
            現在の機器タイプが分からない場合は、一度ご相談ください。
          </dd>
          <dt>本体の販売から取付工事までまとめて依頼できますか？</dt>
          <dd>
            はい、機器選定、本体販売、取付工事、試運転までまとめてご相談いただけます。<br>
            既存機器の交換の場合は、撤去やフロン回収まわりも含めて、現場条件を確認しながらご提案します。
          </dd>
          <dt>営業中の店舗や稼働中の施設でも工事できますか？</dt>
          <dd>
            工事内容や現場状況によって異なります。店舗・オフィス・工場・施設の営業や業務への影響を抑えられるよう、工事日程や作業時間を確認しながら調整します。<br>
            休日・営業時間外の工事をご希望の場合も、事前にご相談ください。
          </dd>
          <dt>他メーカーからの入れ替えもできますか？</dt>
          <dd>
            はい、他メーカーの業務用エアコンからの入れ替えにも対応しています。<br>
            現在設置されているメーカーや機種を確認したうえで、設置環境や配管・電源の状況に合わせて、最適な交換機種をご提案します。
          </dd>
          <dt>支払い方法やリースは相談できますか？</dt>
          <dd>
            支払い方法やリースについては、案件内容や条件により確認が必要です。<br>
            導入台数、機器内容、工事範囲、希望時期を確認したうえで、対応可能な方法をご案内します。
          </dd>
          <dt>保証やアフター対応はありますか？</dt>
          <dd>
            メーカー保証や工事後の対応については、選定する機器や工事内容により異なります。<br>
            正式見積もり時に、保証範囲やアフター対応についても確認できるようご案内します。
          </dd>
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
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/area_01.jpg" alt="" width="500" height="375" decoding="async">
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
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/area_02.jpg" alt="" width="500" height="375" decoding="async">
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
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/area_03.jpg" alt="" width="500" height="375" decoding="async">
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
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/airconchangelp/img/area_04.jpg" alt="" width="500" height="375" decoding="async">
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
        <h2 class="ttl">お問い合わせフォーム</h2>
        <p class="contact--lead">
          料金の目安を知りたい方・具体的な日程のご相談をされたい方は、<br class="is-hidden_sp">
          こちらのフォームからご連絡ください。<br>
          無料でお見積もり・ご提案いたします。
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
                alt="株式会社トータルスマート"
                width="397" height="84"
                decoding="async">
            </picture>
            <p>愛知県・岐阜県・三重県・静岡県のエアコンクリーニングはトータルスマート株式会社</p>
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
    <p class="footer--copy"><small>Copyright© 株式会社トータルスマート All Rights Reserved.</small></p>
  </footer>

  <?php wp_footer(); ?>
</body>

</html>