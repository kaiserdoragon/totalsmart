<?php
/*
Template Name: エアコンの修理LP
*/
defined('ABSPATH') || exit;

$page_id  = get_queried_object_id();
$page_url = esc_url_raw(get_permalink($page_id));
$home_url = esc_url_raw(home_url('/'));

$logo_url = esc_url_raw(get_theme_file_uri('shuurilp/img/logo.png'));
$mv_url   = esc_url_raw(get_theme_file_uri('shuurilp/img/mv.jpg'));

$has_seo_plugin = defined('WPSEO_VERSION') || defined('RANK_MATH_VERSION') || defined('AIOSEO_VERSION');

// タイトル（テーマがtitle-tag対応なら wp_get_document_title() が最適）
$meta_title = wp_get_document_title();
if (empty($meta_title)) {
  $meta_title = 'エアコン修理｜株式会社トータルスマート';
}

// description（未定義回避：固定LPなので固定文が安定）
$meta_description = '愛知・岐阜・三重・静岡でエアコン修理（冷えない・動かない・水漏れ・異音）なら株式会社トータルスマート。最短当日訪問、見積り無料。電話・メール・LINEで受付。';
$meta_description = wp_strip_all_tags($meta_description);
if (function_exists('mb_strimwidth')) {
  $meta_description = mb_strimwidth($meta_description, 0, 120, '…', 'UTF-8');
}

// OGP/Twitter（OGタイトルはページ主題と一致させる）
$og_title       = $meta_title ?: 'エアコン修理｜株式会社トータルスマート';
$og_description = $meta_description;
$og_image       = $mv_url;

// =======================
// Structured Data (JSON-LD)
// =======================
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
  'url'   => $og_image,
];

$business = [
  '@type' => 'HVACBusiness',
  '@id'   => $home_url . '#localbusiness',
  'name'  => '株式会社トータルスマート',
  'url'   => $home_url,
  'telephone' => '+81-52-932-5450',
  'faxNumber' => '+81-52-932-5451',
  'logo'  => $logo_url,
  'image' => [$og_image],
  'currenciesAccepted' => 'JPY',
  'paymentAccepted' => '現金, 銀行振込, クレジットカード',
  'priceRange' => '要見積',
  'address' => [
    '@type' => 'PostalAddress',
    'postalCode' => '461-0002',
    'addressRegion' => '愛知県',
    'addressLocality' => '名古屋市東区',
    'streetAddress' => '代官町16-17 アーク代官町ビルディング2F',
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
      'telephone' => '+81-800-111-3816',
      'contactType' => 'customer service',
      'availableLanguage' => ['ja'],
    ],
    [
      '@type' => 'ContactPoint',
      'telephone' => '+81-52-932-5450',
      'contactType' => 'customer service',
      'availableLanguage' => ['ja'],
    ],
  ],
];

$service = [
  '@type' => 'Service',
  '@id'   => $page_url . '#service',
  'name'  => 'エアコン修理',
  'serviceType' => 'エアコン修理（冷えない・動かない・水漏れ・異音など）',
  'provider' => ['@id' => $home_url . '#localbusiness'],
  'areaServed' => $business['areaServed'],
];

$webpage = [
  '@type' => 'WebPage',
  '@id'   => $page_url . '#webpage',
  'url'   => $page_url,
  'name'  => $og_title,
  'inLanguage' => 'ja-JP',
  'isPartOf' => ['@id' => $home_url . '#website'],
  'primaryImageOfPage' => ['@id' => $page_url . '#primaryimage'],
  'about' => ['@id' => $page_url . '#service'],
  'mainEntity' => ['@id' => $page_url . '#service'],
];

// FAQ：ページ上のFAQ表示内容と完全一致させる（不一致はNG）
$faqpage = [
  '@type' => 'FAQPage',
  '@id'   => $page_url . '#faq',
  'mainEntity' => [
    [
      '@type' => 'Question',
      'name'  => '見積りだけでも来てもらうことはできますか？',
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text'  => 'お見積りは無料にて行わせて頂きます。別途調査費用がかかる場合もございますが、その際は事前にお伝えしますので安心してください。',
      ],
    ],
    [
      '@type' => 'Question',
      'name'  => '追加料金が発生することはありますか？',
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text'  => 'ご提示したお見積り金額を超えることはございません。事前に判明しなかった内容が作業当日に判明した場合は作業前に必ずご説明させて頂きます。',
      ],
    ],
    [
      '@type' => 'Question',
      'name'  => '支払いは現金のみですか？',
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text'  => '現金以外にクレジットカードがご使用頂けます。予めお伝えください。',
      ],
    ],
    [
      '@type' => 'Question',
      'name'  => '作業してもらう際、こちらで何かすることはありますか？',
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text'  => '特にございません。準備・後片付けも全て施工スタッフにて行わせていただきます。',
      ],
    ],
    [
      '@type' => 'Question',
      'name'  => '予約はどのようにすればいいですか？',
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text'  => 'このサイトのお申し込みフォーム、もしくはお電話にてご連絡ください。担当から日時の調整連絡をいたします。',
      ],
    ],
  ],
];

$ld_json = [
  '@context' => 'https://schema.org',
  '@graph' => [$website, $primary_image, $business, $service, $webpage, $faqpage],
];

add_action('wp_head', static function () use ($ld_json, $has_seo_plugin) {
  if ($has_seo_plugin) return;
  echo "\n" . '<script type="application/ld+json">'
    . wp_json_encode($ld_json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
    . '</script>' . "\n";
}, 1);

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <meta name="format-detection" content="telephone=no">

  <?php if (!$has_seo_plugin): ?>
    <title><?php echo esc_html($meta_title); ?></title>
    <meta name="description" content="<?php echo esc_attr($meta_description); ?>">
    <link rel="canonical" href="<?php echo esc_url($page_url); ?>">

    <meta property="og:type" content="website">
    <meta property="og:locale" content="ja_JP">
    <meta property="og:site_name" content="株式会社トータルスマート">
    <meta property="og:title" content="<?php echo esc_attr($og_title); ?>">
    <meta property="og:description" content="<?php echo esc_attr($og_description); ?>">
    <meta property="og:url" content="<?php echo esc_url($page_url); ?>">
    <meta property="og:image" content="<?php echo esc_url($og_image); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr($og_title); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr($og_description); ?>">
    <meta name="twitter:image" content="<?php echo esc_url($og_image); ?>">
  <?php endif; ?>

  <link rel="preload" as="image" href="<?php echo esc_url(get_theme_file_uri('shuurilp/img/logo.avif')); ?>" type="image/avif">
  <link rel="preload" as="image" href="<?php echo esc_url(get_theme_file_uri('shuurilp/img/mv_sp.avif')); ?>" type="image/avif" media="(max-width: 767px)">
  <link rel="preload" as="image" href="<?php echo esc_url(get_theme_file_uri('shuurilp/img/mv.avif')); ?>" type="image/avif" media="(min-width: 768px)">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Michroma&family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
  <noscript>
    <link href="https://fonts.googleapis.com/css2?family=Michroma&family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
  </noscript>

  <link rel="icon" href="<?php echo esc_url(get_theme_file_uri('/img/icons/favicon.ico')); ?>">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url(get_theme_file_uri('/img/icons/apple-touch-icon.png')); ?>">

  <?php wp_head(); ?>
</head>

<body <?php body_class('shuurilp'); ?>>
  <?php wp_body_open(); ?>

  <header class="header">
    <div class="contents">
      <div class="header--logo">
        <a href="<?php echo esc_url(home_url('/shuurilp/')); ?>">
          <p>エアコンが冷えない・動かない・水漏れ・異音の修理はトータルスマート株式会社</p>
          <picture>
            <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/logo.avif" type="image/avif">
            <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/logo.webp" type="image/webp">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/logo.png"
              alt="株式会社トータルスマート"
              width="397" height="262"
              fetchpriority="high"
              decoding="async">
          </picture>
        </a>
      </div>

      <div class="header--btns">
        <div class="header--btn-item">
          <a href="tel:0800-111-3816" class="cv_button">
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/tel.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/tel.webp" type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/tel.png"
                alt="お電話でのご相談はこちら: 0800-111-3816"
                width="270" height="70"
                decoding="async">
            </picture>
          </a>
        </div>

        <div class="header--btn-item">
          <a href="#contact" class="cv_button">
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/mail.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/mail.webp" type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/mail.png"
                alt="メールでお問い合わせ"
                width="270" height="70"
                decoding="async">
            </picture>
          </a>
        </div>

        <div class="header--btn-item">
          <a href="https://lin.ee/fXrKQyq" class="cv_button">
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/line.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/line.webp" type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/line.png"
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
        <source media="(max-width: 767px)" srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/mv_sp.avif" type="image/avif">
        <source media="(max-width: 767px)" srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/mv_sp.webp" type="image/webp">
        <source media="(max-width: 767px)" srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/mv_sp.jpg">

        <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/mv.avif" type="image/avif">
        <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/mv.webp" type="image/webp">

        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/mv.jpg"
          alt="エアコンの修理なら株式会社トータルスマート"
          width="1920" height="800"
          fetchpriority="high"
          decoding="async">
      </picture>
    </div>

    <section class="lead sec -sm bg_yellow">
      <div class="contents -md">
        <h2>
          <picture>
            <source media="(max-width: 767px)" srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/lead_txt_sp.png">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/lead_txt.png" alt="愛知県・岐阜県・三重県・静岡県なら最短当日・即日での訪問も可能です。" width="621" height="114" loading="lazy" decoding="async">
          </picture>
        </h2>

        <div class="lead--inner">
          <h3>エアコン修理のご予約・ご相談はこちら</h3>
          <div class="lead--txt">
            <p>
              <span>冷えない・動かない・水漏れ・異音</span>が気になったら、<br class="is-hidden_sp">
              まずはお電話でお気軽にご相談ください。
            </p>

            <div class="header--btns">
              <div class="header--btn-item">
                <a href="tel:0800-111-3816" class="cv_button">
                  <picture>
                    <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/tel.avif" type="image/avif">
                    <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/tel.webp" type="image/webp">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/tel.png"
                      alt="お電話でのご相談はこちら: 0800-111-3816"
                      width="270" height="70"
                      decoding="async">
                  </picture>
                </a>
              </div>

              <div class="header--btn-item">
                <a href="#contact" class="cv_button">
                  <picture>
                    <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/mail.avif" type="image/avif">
                    <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/mail.webp" type="image/webp">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/mail.png"
                      alt="メールでお問い合わせ"
                      width="270" height="70"
                      decoding="async">
                  </picture>
                </a>
              </div>

              <div class="header--btn-item">
                <a href="https://lin.ee/fXrKQyq" class="cv_button">
                  <picture>
                    <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/line.avif" type="image/avif">
                    <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/line.webp" type="image/webp">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/line.png"
                      alt="LINEでお問い合わせ"
                      width="270" height="70"
                      decoding="async">
                  </picture>
                </a>
              </div>
            </div>
          </div>
        </div>

        <p class="lead--supplement">
          まずはお電話にて事前に概算のお見積りをご案内いたします。<br>
          不当な追加料金や高額請求は一切ございませんので、安心してお問い合わせください。
        </p>
        <p class="lead--supplement -sm">
          ※設置状況（機種・故障状況・作業環境）により、<br class="is-hidden_sp">
          当日ご案内する金額が事前の概算見積りから変動する場合がございます。
        </p>
      </div>
    </section>

    <section class="sign bg_skyblue" id="symptoms">
      <div class="contents">
        <span class="sign--catch">こんなサインが出てきたら</span>
        <h2><span>エアコン修理</span><br class="is-hidden_pc">のタイミングです</h2>
        <ul class="sign--list">
          <li>エアコンから<span>水が落ちてくる</span></li>
          <li>エアコンから<span>変な音がする</span></li>
          <li>エアコンが<span>突然動かなくなった</span></li>
          <li>エアコンから<span>変な臭いがする</span></li>
          <li>冷房・暖房の<span>効きが悪い</span></li>
          <li>天井カセットから<span>水が垂れてくる</span></li>
          <li><span>室外機</span>がちゃんと動いていない</li>
          <li>フロアの一部だけ<span>冷えていない</span></li>
        </ul>
      </div>
    </section>

    <!-- id重複解消：reviews → attention -->
    <section class="attention sec -md" id="attention">
      <div class="contents">
        <div class="attention--strong">
          <h2>上記に当てはまる場合<br><img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/attention_txt.png" alt="" width="491" height="83" loading="lazy" decoding="async">が必要です</h2>
          <p class="attention--lead">ご自身でのエアコンの修理は<br>大変危険です！</p>
        </div>
        <div class="attention--inner">
          <p class="attention--txt">
            エアコンは精密機械であり、内部には高電圧が流れています。<br>
            ご自身での修理やガスの補充は、<span>感電や火災、</span><br class="is-hidden_sp">
            予期せぬ<span>ガス爆発</span>などの大きなリスクを伴います。
          </p>
          <p class="attention--txt -sm">
            安易な自己判断は、思わぬ事故や環境汚染の原因になります。<br>
            安心・安全のために、国家資格（電気工事士）<br class="is-hidden_sp">
            を持つ専門業者である私たちにご依頼ください。
          </p>
        </div>
      </div>
    </section>

    <section class="cvarea bg_yellow sec">
      <div class="contents">
        <div class="cvarea--lead">
          <picture>
            <source media="(max-width: 1024px)" srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/cvarea_sp.png">
            <img class="cvarea--bg" src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/cvarea.png" alt="エアコンの修理ならトータルスマートにお任せください" width="1366" height="618" loading="lazy" decoding="async">
          </picture>
          <div class="header--btns">
            <div class="header--btn-item">
              <a href="tel:0800-111-3816" class="cv_button">
                <picture>
                  <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/tel.avif" type="image/avif">
                  <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/tel.webp" type="image/webp">
                  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/tel.png"
                    alt="お電話でのご相談はこちら: 0800-111-3816"
                    width="270" height="70"
                    decoding="async">
                </picture>
              </a>
            </div>
            <div class="header--btn-item">
              <a href="#contact" class="cv_button">
                <picture>
                  <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/mail.avif" type="image/avif">
                  <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/mail.webp" type="image/webp">
                  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/mail.png"
                    alt="メールでお問い合わせ"
                    width="270" height="70"
                    decoding="async">
                </picture>
              </a>
            </div>
            <div class="header--btn-item">
              <a href="https://lin.ee/fXrKQyq" class="cv_button">
                <picture>
                  <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/line.avif" type="image/avif">
                  <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/line.webp" type="image/webp">
                  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/line.png"
                    alt="LINEでお問い合わせ"
                    width="270" height="70"
                    decoding="async">
                </picture>
              </a>
            </div>
          </div>
          <p>店舗・オフィスにて幅広く対応中！</p>
        </div>

        <div class="cvarea--inner">
          <div>
            <span>飲食店</span>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/instance_01.jpg" alt="" width="350" height="250" loading="lazy" decoding="async">
          </div>
          <div>
            <span>車屋</span>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/instance_02.jpg" alt="" width="350" height="250" loading="lazy" decoding="async">
          </div>
          <div>
            <span>美容院</span>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/instance_03.jpg" alt="" width="350" height="250" loading="lazy" decoding="async">
          </div>
          <div>
            <span>アパレル</span>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/instance_04.jpg" alt="" width="350" height="250" loading="lazy" decoding="async">
          </div>
          <div>
            <span>塾</span>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/instance_05.jpg" alt="" width="350" height="250" loading="lazy" decoding="async">
          </div>
          <div>
            <span>医療</span>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/instance_06.jpg" alt="" width="350" height="250" loading="lazy" decoding="async">
          </div>
        </div>
      </div>
    </section>

    <section class="select sec" id="reasons">
      <div class="contents">
        <h2>
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/select_logo.png" alt="株式会社トータルスマート" width="401" height="44" loading="lazy" decoding="async">が<br>選ばれる<span>4</span>つの理由
        </h2>

        <ol>
          <li>
            <h3>最短当日訪問</h3>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/select_01.jpg" alt="" width="400" height="250" loading="lazy" decoding="async">
            <p>スケジュールの組み方を工夫することで「最短当日訪問」が実現可能です。<br>
              急なご依頼に対応できる枠をあらかじめ確保しているのが特徴です。</p>
          </li>
          <li>
            <h3>親切・丁寧</h3>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/select_02.jpg" alt="" width="400" height="250" loading="lazy" decoding="async">
            <p>専門用語をなるべく使わずに、わかりやすい言葉でご説明することを徹底しています。<br>
              安心してお任せいただける対応を心がけています。</p>
          </li>
          <li>
            <h3>見積り無料</h3>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/select_03.jpg" alt="" width="400" height="250" loading="lazy" decoding="async">
            <p>作業前に必ず見積りを提示します。作業前に、故障箇所と修理内容・料金をわかりやすくご説明しご納得いただいてから作業に入ります。</p>
          </li>
          <li>
            <h3>業界最安値</h3>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/select_04.jpg" alt="" width="400" height="250" loading="lazy" decoding="async">
            <p>完全自社施工だから低価格！<br>
              余計な費用が一切掛かりません。
              余分なコストを徹底的に削減し、業界最安値を目指します。</p>
          </li>
        </ol>
      </div>
    </section>

    <!-- reviews はここだけに -->
    <section class="voice sec bg_skyblue" id="reviews">
      <div class="contents">
        <h2 class="ttl">お客様からの評価も頂いています</h2>
        <div class="voice--inner">
          <div class="voice--item">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/voice_01.jpg" alt="" width="380" height="200" loading="lazy" decoding="async">
            <div>
              <h3>真夏でも当日対応してもらえて、本当に助かりました</h3>
              <span>愛知県名古屋市／飲食店A様</span>
            </div>
            <p>真夏の週末にエアコンが急に冷えなくなり、当日朝に電話をしました。<br>
              夕方には来訪し丁寧に症状と料金を説明してくれたので安心しました。</p>
          </div>

          <div class="voice--item">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/voice_02.jpg" alt="" width="380" height="200" loading="lazy" decoding="async">
            <div>
              <h3>業務に支障が出ないよう、早朝対応で解決してくれました</h3>
              <span>岐阜県岐阜市／レンタカー店K様</span>
            </div>
            <p>早朝なら作業可能と柔軟に提案してくれ、部品交換が必要な箇所と様子見でよい箇所を丁寧に説明してくれたので、信頼できる業者だと思いました。</p>
          </div>

          <div class="voice--item">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/voice_03.jpg" alt="" width="380" height="200" loading="lazy" decoding="async">
            <div>
              <h3>ニオイと効きの悪さが一度に改善されました。</h3>
              <span>三重県四日市市／アパレル店 S様</span>
            </div>
            <p>店内エアコンの効き悪化とカビ臭で相談しました。<br>
              二種類の見積で納得して依頼し、売り場が快適になり今後も定期メンテをお願いする予定です。</p>
          </div>
        </div>
      </div>
    </section>

    <section class="use bg_blue sec">
      <div class="contents">
        <h2 class="ttl">ご利用の流れ</h2>
        <ol>
          <li>
            <div class="use--txt">
              <h3>お問い合わせ</h3>
              <img class="is-hidden_pc" src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/use_01.jpg" alt="" width="250" height="250" loading="lazy" decoding="async">
              <p>サービスの詳細、気になっている故障や修理したい箇所についてなど、
                お電話またはメールフォームにてお気軽にお問い合わせください。</p>
            </div>
            <div>
              <img class="is-hidden_sp" src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/use_01.jpg" alt="" width="250" height="250" loading="lazy" decoding="async">
            </div>
          </li>

          <li>
            <div class="use--txt">
              <h3>ヒアリング</h3>
              <img class="is-hidden_pc" src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/use_02.jpg" alt="" width="250" height="250" loading="lazy" decoding="async">
              <p>
                お見積り訪問日時などを相談させていただきます。<br>
                ご希望のサービス内容を詳しくお伺いし、修理箇所の確認をいたします。
              </p>
            </div>
            <div>
              <img class="is-hidden_sp" src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/use_02.jpg" alt="" width="250" height="250" loading="lazy" decoding="async">
            </div>
          </li>

          <li>
            <div class="use--txt">
              <h3>お見積りご提示</h3>
              <img class="is-hidden_pc" src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/use_03.jpg" alt="" width="250" height="250" loading="lazy" decoding="async">
              <p>
                担当スタッフが訪問し、修理対象箇所を確認後無料でお見積りを
                ご提示します。<br>
                修理の際の注意事項などもご説明します。
              </p>
            </div>
            <div>
              <img class="is-hidden_sp" src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/use_03.jpg" alt="" width="250" height="250" loading="lazy" decoding="async">
            </div>
          </li>

          <li>
            <div class="use--txt">
              <h3>スケジュールの相談</h3>
              <img class="is-hidden_pc" src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/use_04.jpg" alt="" width="250" height="250" loading="lazy" decoding="async">
              <p>お見積りから正式にご依頼をいただいたのち、サービス実施日時やスケジュールについて相談させていただきます。</p>
            </div>
            <div>
              <img class="is-hidden_sp" src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/use_04.jpg" alt="" width="250" height="250" loading="lazy" decoding="async">
            </div>
          </li>

          <li>
            <div class="use--txt">
              <h3>サービス実施</h3>
              <img class="is-hidden_pc" src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/use_05.jpg" alt="" width="250" height="250" loading="lazy" decoding="async">
              <p>担当スタッフが訪問し、サービスを実施します。お見積り以上の請求が発生することはありませんが、追加のご要望などがあれば請求額が変わる場合もございます。</p>
            </div>
            <div>
              <img class="is-hidden_sp" src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/use_05.jpg" alt="" width="250" height="250" loading="lazy" decoding="async">
            </div>
          </li>
        </ol>
      </div>
    </section>

    <section class="region sec" id="area">
      <div class="contents -md">
        <h2 class="ttl">対応エリア</h2>
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/map.png" alt="" width="518" height="534" loading="lazy" decoding="async">
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

    <section class="faq sec bg_skyblue" id="faq">
      <div class="contents -md">
        <h2 class="ttl">よくある質問</h2>

        <dl>
          <div>
            <dt>見積りだけでも来てもらうことはできますか？？</dt>
            <dd>
              お見積りは無料にて行わせて頂きます。<br>
              別途調査費用がかかる場合もございますが、その際は事前にお伝えしますので安心してください。
            </dd>
          </div>

          <div>
            <dt>追加料金が発生することはありますか？？</dt>
            <dd>
              ご提示したお見積り金額を超えることはございません。<br>
              事前に判明しなかった内容が作業当日に判明した場合は作業前に必ずご説明させて頂きます。
            </dd>
          </div>

          <!-- JSON-LDと一致させるため追加 -->
          <div>
            <dt>支払いは現金のみですか？？</dt>
            <dd>
              現金以外にクレジットカードがご使用頂けます。予めお伝えください。
            </dd>
          </div>

          <div>
            <dt>作業してもらう際、こちらで何かすることはありますか？</dt>
            <dd>
              特にございません。<br>
              準備・後片付けも全て施工スタッフにて行わせていただきます。
            </dd>
          </div>

          <div>
            <dt>予約はどのようにすればいいですか？</dt>
            <dd>
              このサイトのお申し込みフォーム、もしくはお電話にてご連絡ください。
              担当から日時の調整連絡をいたします。
            </dd>
          </div>
        </dl>
      </div>
    </section>

    <section class="contact sec" id="contact">
      <div class="contents">
        <h2 class="ttl">お問い合わせフォーム</h2>
        <p class="contact--lead">
          エアコンの故障、今すぐ解決しませんか？<br>
          こちらの2〜3分で完了する簡単フォームです。<br>
          お急ぎの方は、お電話の方が早くご案内できます。
        </p>

        <div class="thanks--tel">
          <a href="tel:0800-111-3816" class="cv_button">
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/tel.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/tel.webp" type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/tel.png"
                alt="お電話でのご相談はこちら: 0800-111-3816"
                width="355" height="90"
                decoding="async">
            </picture>
          </a>
        </div>

        <?php echo do_shortcode('[contact-form-7 id="571" title="エアコンの修理のフォーム"]'); ?>
      </div>
    </section>

  </main>

  <div class="footer_btn_fixed" id="js_fixed-btn">
    <p class="footer_btn_fixed--tel"><a href="tel:0800-111-3816">電話で<br>予約する</a></p>
    <p class="footer_btn_fixed--mail"><a href="#contact">メールで<br>無料見積り</a></p>
    <p class="footer_btn_fixed--line"><a href="https://lin.ee/fXrKQyq">LINEで<br>問い合わせ</a></p>
  </div>

  <footer class="footer">
    <div class="contents -md">
      <div>
        <div class="footer--logo">
          <a href="<?php echo esc_url(home_url('/')); ?>">
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/logo_footer.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/logo_footer.webp" type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/logo_footer.png"
                alt="株式会社トータルスマート"
                width="397" height="84"
                decoding="async">
            </picture>
            <p>エアコンが冷えない・動かない・水漏れ・異音の修理はトータルスマート株式会社</p>
          </a>
        </div>

        <div class="footer--info">
          <p>〒461-0002 愛知県名古屋市東区代官町16-17
            <br>アーク代官町ビルディング2F
          </p>
          <p>TEL:052-932-5450</p>
          <p>FAX:052-932-5451</p>
        </div>
      </div>

      <div class="footer--catch">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/footer_catch.jpg" alt="トータルスマート" width="357" height="349" decoding="async">
      </div>
    </div>

    <p class="footer--copy"><small>Copyright© 株式会社トータルスマート All Rights Reserved.</small></p>
  </footer>

  <?php wp_footer(); ?>
</body>

</html>