<?php
/*
Template Name: エアコンのクリーニングLP
*/
defined('ABSPATH') || exit;

$page_url = esc_url_raw(get_permalink());
$home_url = esc_url_raw(home_url('/'));

$logo_url = esc_url_raw(get_theme_file_uri('cleaninglp/img/logo.png'));
$mv_url   = esc_url_raw(get_theme_file_uri('cleaninglp/img/mv.jpg'));

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
  '@type' => ['LocalBusiness', 'HVACBusiness'],
  '@id'   => $home_url . '#localbusiness',
  'name'  => '株式会社トータルスマート',
  'url'   => $home_url,
  'telephone' => '+81-52-932-5450',
  'logo'  => $logo_url,
  'image' => [$mv_url],
  'priceRange' => '¥18,000',
  'paymentAccepted' => '現金',
  'currenciesAccepted' => 'JPY',
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
  'contactPoint' => [[
    '@type' => 'ContactPoint',
    'telephone' => '+81-52-932-5450',
    'contactType' => 'customer service',
    'availableLanguage' => ['ja'],
  ]],
  // LP上に表示されている価格のみをOffer化（見えている情報と一致させる）
  'makesOffer' => [
    [
      '@type' => 'Offer',
      'name' => '簡単クリーニング（フィルター清掃・風速測定・温度測定）',
      'price' => '5500',
      'priceCurrency' => 'JPY',
      'url' => $page_url . '#price',
    ],
    [
      '@type' => 'Offer',
      'name' => 'しっかりクリーニング（分解洗浄）',
      'price' => '18000',
      'priceCurrency' => 'JPY',
      'url' => $page_url . '#price',
    ],
  ],
];

$webpage = [
  '@type' => 'WebPage',
  '@id'   => $page_url . '#webpage',
  'url'   => $page_url,
  'name'  => 'エアコンクリーニング（エアコン掃除）｜株式会社トータルスマート',
  'inLanguage' => 'ja-JP',
  'isPartOf' => ['@id' => $home_url . '#website'],
  'primaryImageOfPage' => ['@id' => $page_url . '#primaryimage'],
  'about' => [
    '@type' => 'Service',
    'name'  => 'エアコンクリーニング（エアコン掃除）',
  ],
  'mainEntity' => ['@id' => $home_url . '#localbusiness'],
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
        'text'  => 'エアコン本体の料金＋オプション（ご希望時のみ）が総額です。出張費・基本的な養生・洗浄作業料はすべて含まれています。勝手に追加請求することは一切ございません。',
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
        'text'  => 'エアコンの真下や周辺の小物の移動、作業スペース（1〜2畳）の確保、部品洗浄に使用できる場所（お風呂場またはベランダ等）のご提供をお願いしています。',
      ],
    ],
    [
      '@type' => 'Question',
      'name'  => '猫や犬などのペットがいますが大丈夫ですか？',
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text'  => '作業には基本的にオーガニック洗剤を使用しています。安心して下さい。',
      ],
    ],
  ],
];

$ld_json = [
  '@context' => 'https://schema.org',
  '@graph' => [$website, $primary_image, $business, $webpage, $faqpage],
];

add_action('wp_head', static function () use ($ld_json) {
  echo "\n" . '<script type="application/ld+json">'
    . wp_json_encode($ld_json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
    . '</script>' . "\n";
}, 1);
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php echo implode(' ', get_body_class()); ?>">

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover maximum-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <link rel="preload" as="image" href="<?php echo get_theme_file_uri('/img/common/logo.png'); ?>" fetchpriority="high">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Michroma&family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet" media="print" onload="this.media='all'">

  <?php if (is_front_page()): ?>
    <meta name="description" content="<?php bloginfo('description'); ?>">
  <?php else: ?>
    <meta name="description" content="<?php echo trim(wp_title('', false)); ?>について。トータルスマートは愛知・岐阜・三重・静岡でオフィスのコスト削減を支援します。">
  <?php endif; ?>

  <link rel="icon" href="<?php echo get_theme_file_uri('/img/icons/favicon.ico'); ?>">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_theme_file_uri('/img/icons/apple-touch-icon.png'); ?>">

  <?php wp_head(); ?>
</head>

<body>

  <header class="header">
    <div class="contents">
      <section class="header--logo">
        <a href="<?php echo esc_url(home_url('/cleaninglp/')); ?>">
          <p>愛知県・岐阜県・三重県・静岡県のエアコンクリーニングはトータルスマート株式会社</p>
          <h1>
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/logo.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/logo.webp" type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/logo.png"
                alt="株式会社トータルスマート"
                width="397" height="262"
                fetchpriority="high"
                loading="eager"
                decoding="async">
            </picture>
          </h1>
        </a>
      </section>
      <div class="header--btns">
        <div class="header--btn-item">
          <a href="tel:0800-111-3816" class="cv_button gtm-click-tel">
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/tel.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/tel.webp" type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/tel.png"
                alt="お電話でのご相談はこちら: 0800-111-3816"
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
          alt="エアコンクリーニングなら株式会社トータルスマート"
          width="1920" height="800"
          fetchpriority="high"
          loading="eager"
          decoding="async">
      </picture>
    </div>

    <section class="catch sec -sm">
      <div class="contents">
        <h2>業界最安値に<br class="is-hidden_pc">挑戦</h2>
        <div class="catch--inner">
          <div class="catch--item">
            <span>簡単クリーニング</span>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/catch_01.jpg" alt="簡単クリーニング" width="430" height="271" decoding="async">
            <p>フィルター清掃・風速測定・温度測定</p>
            <div class="catch--price">
              <p>5<span class="catch--period">,</span>000</p><span class="catch--unit"><span class="catch--jpy">円～</span><span class="catch--tax">（税抜）</span></span>
            </div>
          </div>
          <div class="catch--item">
            <span>しっかりクリーニング</span>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/catch_02.jpg" alt="業務用エアコン" width="430" height="271" decoding="async">
            <div class="catch--price">
              <p>18<span class="catch--period">,</span>000</p><span class="catch--unit"><span class="catch--jpy">円～</span><span class="catch--tax">（税抜）</span></span>
            </div>
            <small>※お掃除機能付きの場合は＋6,000円<br>※分解洗浄</small>
          </div>
        </div>
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/catch_03.jpg" alt="" width="283" height="178" decoding="async">
        <p class="catch--txt">エアコンのクリーニングは<br class="is-hidden_pc">全てお任せ下さい。</p>
        <p>エアコンの専門の技術スタッフが、<br class="is-hidden_sp">
          エアコンの悩みを解消します！</p>
      </div>
    </section>

    <section class="lead sec -sm bg_blue">
      <div class="contents -md">
        <h2>
          <picture>
            <source media="(max-width: 767px)" srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/lead_txt_sp.png">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/lead_txt.png" alt="愛知県・岐阜県・三重県・静岡県なら最短当日・即日での訪問も可能です。" width="621" height="114" decoding="async">
          </picture>
        </h2>
        <div class="lead--inner">
          <h3>エアコンクリーニングのご予約・ご相談はこちら</h3>
          <div class="lead--txt">
            <p>
              <span>汚れ・カビ・ニオイ・効きの悪さ</span>が気になったら、<br class="is-hidden_sp">
              まずはお電話でお気軽にご相談ください。
            </p>
            <div class="header--btns">
              <div class="header--btn-item">
                <a href="tel:0800-111-3816" class="cv_button gtm-click-tel">
                  <picture>
                    <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/tel.avif" type="image/avif">
                    <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/tel.webp" type="image/webp">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/tel.png" alt="お電話でのご相談はこちら: 0800-111-3816" width="270" height="70" decoding="async">
                  </picture>
                </a>
              </div>
              <div class="header--btn-item">
                <a href="#contact" class="cv_button gtm-click-mail">
                  <picture>
                    <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/mail.avif" type="image/avif">
                    <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/mail.webp" type="image/webp">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/mail.png" alt="メールでお問い合わせ" width="270" height="70" decoding="async">
                  </picture>
                </a>
              </div>
              <div class="header--btn-item">
                <a href="https://lin.ee/fXrKQyq" class="cv_button gtm-click-line">
                  <picture>
                    <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/line.avif" type="image/avif">
                    <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/line.webp" type="image/webp">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/line.png" alt="LINEでお問い合わせ" width="270" height="70" decoding="async">
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
          ※設置状況（機種・汚れ具合・作業環境）により、<br class="is-hidden_sp">
          当日ご案内する金額が事前の概算見積りから変動する場合がございます。
        </p>
      </div>
    </section>

    <section class="sign bg_skyblue" id="symptoms">
      <div class="contents">
        <span class="sign--catch">こんなサインが出てきたら</span>
        <h2><span>エアコンクリーニング</span><br class="is-hidden_pc">のタイミングです</h2>
        <ul class="sign--list">
          <li><span>吹き出し口の黒い点々やホコリの塊</span>が目につくようになってきた</li>
          <li>スイッチを入れると、<span>カビっぽいニオイ・ホコリっぽさを感じる</span></li>
          <li><span>冷房／暖房の効きが前より悪くなった</span>気がして、設定温度を下げがち</li>
          <li>フィルター掃除はしているのに、<span>電気代の明細が年々高くなっている</span></li>
          <li>小さなお子さまやペットがいて、<span>エアコンの風やお部屋の空気が少し心配</span></li>
          <li><span>高い場所の作業や分解が不安</span>で、自分で中まで掃除するのは難しいと感じている</li>
        </ul>
      </div>
    </section>

    <section class="cvarea bg_blue">
      <div class="contents">
        <picture>
          <source media="(max-width: 767px)" srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/cvarea_sp.png">
          <img class="cvarea--bg" src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/cvarea.png" alt="エアコンクリーニングならトータルスマートにお任せください" width="1366" height="618" decoding="async">
        </picture>
        <div class="header--btns">
          <div class="header--btn-item">
            <a href="tel:0800-111-3816" class="cv_button gtm-click-tel">
              <picture>
                <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/tel.avif" type="image/avif">
                <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/tel.webp" type="image/webp">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/tel.png"
                  alt="お電話でのご相談はこちら: 0800-111-3816"
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
    </section>

    <section class="price sec" id="price">
      <div class="contents">
        <span class="sign--catch">他社との比較でわかる！</span>
        <h2>
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/select_logo.png" alt="株式会社トータルスマート" width="401" height="44" loading="lazy" decoding="async">の<br>圧倒的なコスパ
        </h2>
        <div class="price--img js-scrollable">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/price.png" alt="エアコンクリーニングの比較料金表" width="1509" height="834" loading="lazy" decoding="async">
        </div>
      </div>
    </section>

    <section class="merit sec bg_skyblue">
      <div class="contents -md">
        <h2>エアコンクリーニングをする<br><span>5</span>つのメリット</h2>
        <ul>
          <li>
            <p>不具合の<br>早期発見</p>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/merit_01.jpg" alt="" width="300" height="300" loading="lazy" decoding="async">
          </li>
          <li>
            <p>大きな故障の<br>防止</p>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/merit_02.jpg" alt="" width="300" height="300" loading="lazy" decoding="async">
          </li>
          <li>
            <p>電気代の<br>削減</p>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/merit_03.jpg" alt="" width="300" height="300" loading="lazy" decoding="async">
          </li>
          <li>
            <p>エアコンの<br>寿命UP</p>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/merit_04.jpg" alt="" width="300" height="300" loading="lazy" decoding="async">
          </li>
          <li>
            <p>エアコンの<br>機能安定</p>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/merit_05.jpg" alt="" width="300" height="300" loading="lazy" decoding="async">
          </li>
        </ul>
      </div>
    </section>

    <section class="select sec" id="reasons">
      <div class="contents">
        <h2>
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/select_logo.png" alt="株式会社トータルスマート" width="401" height="44" loading="lazy" decoding="async">が<br>選ばれる<span>4</span>つの理由
        </h2>
        <ol>
          <li>
            <h3>
              確かな技術力・品質
            </h3>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/select_01.jpg" alt="" width="400" height="250" loading="lazy" decoding="async">
            <p>エアコン本体を分解し、アルミフィン・送風ファン・ドレンパンなど自分では触れない内部まで徹底洗浄します。
              お掃除機能付きエアコンにも対応しているので、ご自宅の機種も安心してお任せください。</p>
          </li>
          <li>
            <h3>
              明確な料金体系
            </h3>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/select_02.jpg" alt="" width="400" height="250" loading="lazy" decoding="async">
            <p>1台だけのご依頼から、複数台のご依頼まで、台数ごとのお得なセット料金をご用意しています。
              お掃除機能付きや室外機洗浄など、追加オプションも事前に料金をお伝えするため、当日になって突然金額が増えることはありません。</p>
          </li>
          <li>
            <h3>
              スピード対応
            </h3>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/select_03.jpg" alt="" width="400" height="250" loading="lazy" decoding="async">
            <p>移動時間を含めたスケジュール調整がしやすく、繁忙期を除けば最短当日〜数日以内のご訪問が可能です。</p>
          </li>
          <li>
            <h3>
              安心・安全への配慮
            </h3>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/select_04.jpg" alt="" width="400" height="250" loading="lazy" decoding="async">
            <p>作業中の思わぬトラブルにも備え、損害賠償保険に加入しています。
              室内はビニールシートでしっかり養生し、壁や床・家具に水や汚れが飛び散らないよう配慮して作業します。</p>
          </li>
        </ol>
      </div>
    </section>

    <section class="case sec -sm">
      <div class="contents">
        <span class="sign--catch">エアコンクリーニングするとここまできれいになります</span>
        <h2 class="ttl">施工事例</h2>
        <div class="case--item">
          <h3>まさか、この空気を吸っていたなんて…</h3>
          <div class="case--inner">
            <p>長年蓄積されたホコリと汚れで、フィルターが完全に目詰まりしていました。<br>
              「最近、風がカビ臭い」「効きが悪い」と感じたら、<br class="is-hidden_sp">
              内部はもっと汚れているサインかもしれません。<br>
              プロの分解洗浄なら、ご家庭では落としきれない汚れもスッキリ除去。<br>
              アレルギー対策や、小さなお子様のいるご家庭にもおすすめです。</p>
            <div class="case--comparison">
              <div class="case--before">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/case_02.jpg" alt="エアコンクリーニングの前の画像" width="380" height="400" loading="lazy" decoding="async">
                <p>BEFORE</p>
              </div>
              <div class="case--after">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/case_01.jpg" alt="エアコンクリーニングの後の画像" width="380" height="400" loading="lazy" decoding="async">
                <p>AFTER</p>
              </div>
            </div>
          </div>
        </div>
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
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/case_03.jpg" alt="エアコンクリーニングの前の画像" width="380" height="400" loading="lazy" decoding="async">
                <p>BEFORE</p>
              </div>
              <div class="case--after">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/case_04.jpg" alt="エアコンクリーニングの後の画像" width="380" height="400" loading="lazy" decoding="async">
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
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/case_05.jpg" alt="エアコンクリーニングの前の画像" width="380" height="400" loading="lazy" decoding="async">
                <p>BEFORE</p>
              </div>
              <div class="case--after">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/case_06.jpg" alt="エアコンクリーニングの後の画像" width="380" height="400" loading="lazy" decoding="async">
                <p>AFTER</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="voice sec bg_skyblue" id="reviews">
      <div class="contents">
        <h2 class="ttl">お客様からの評価も頂いています</h2>
        <div class="voice--inner">
          <div class="voice--item">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/voice_01.jpg" alt="" width="380" height="200" loading="lazy" decoding="async">
            <div>
              <h3>オフィスの空気が一気に軽くなりました</h3>
              <span>名古屋市　IT企業　A様</span>
            </div>
            <p>クリーニング後は同じ設定温度でもムラなく冷え、
              会議室のこもったニオイも解消。<br>
              社員から「空気が変わった」と好評で、
              来客対応にも自信が持てるようになりました。</p>
          </div>
          <div class="voice--item">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/voice_02.jpg" alt="" width="380" height="200" loading="lazy" decoding="async">
            <div>
              <h3>「前より居心地がいい」と言われました</h3>
              <span>岐阜市　飲食店　I様</span>
            </div>
            <p>油煙まじりの風がサラッと変わり、客席の
              カビっぽさもなくなりました。営業前後の
              冷暖房効率も上がり、ピークタイムでも安定
              して快適な温度を保てています。</p>
          </div>
          <div class="voice--item">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/voice_03.jpg" alt="" width="380" height="200" loading="lazy" decoding="async">
            <div>
              <h3>「清潔感が増した」と評判です</h3>
              <span>四日市市　クリニック　T様</span>
            </div>
            <p>天井カセットを分解洗浄してもらったところ、
              見えない内部の汚れに驚きました。<br>
              クリーニング後は空気がすっきりし、
              患者様やスタッフからも好印象の声が
              増えています。</p>
          </div>
        </div>
      </div>
    </section>

    <section class="flow sec">
      <div class="contents">
        <h2 class="ttl">エアコンクリーニングの流れ</h2>
        <ol>
          <li>
            <span>
              STEP1
            </span>
            <div>
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/flow_01.jpg" alt="" width="180" height="100" loading="lazy" decoding="async">
              <dl>
                <dt>エアコンの分解</dt>
                <dd>パーツを分解して<br class="is-hidden_sp">
                  いきます。</dd>
              </dl>
            </div>
          </li>
          <li>
            <span>
              STEP2
            </span>
            <div>
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/flow_02.jpg" alt="" width="180" height="100" loading="lazy" decoding="async">
              <dl>
                <dt>ホコリ除去</dt>
                <dd>ホコリや汚れを<br class="is-hidden_sp">
                  除去します。</dd>
              </dl>
            </div>
          </li>
          <li>
            <span>
              STEP3
            </span>
            <div>
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/flow_03.jpg" alt="" width="180" height="100" loading="lazy" decoding="async">
              <dl>
                <dt>エアコン内部洗浄</dt>
                <dd>高圧洗浄機で<br class="is-hidden_sp">
                  きれいにします。</dd>
              </dl>
            </div>
          </li>
          <li>
            <span>
              STEP4
            </span>
            <div>
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/flow_04.jpg" alt="" width="180" height="100" loading="lazy" decoding="async">
              <dl>
                <dt>パーツの汚れ除去</dt>
                <dd>分解したパーツも<br class="is-hidden_sp">
                  洗浄します。</dd>
              </dl>
            </div>
          </li>
          <li>
            <span>
              STEP5
            </span>
            <div>
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/flow_05.jpg" alt="" width="180" height="100" loading="lazy" decoding="async">
              <dl>
                <dt>最終確認</dt>
                <dd>正常に動くかの<br class="is-hidden_sp">
                  最終確認をします。</dd>
              </dl>
            </div>
          </li>
        </ol>
      </div>
    </section>

    <section class="use bg_blue sec">
      <div class="contents">
        <h2 class="ttl">ご利用の流れ</h2>
        <ol>
          <li>
            <div class="use--txt">
              <h3>お問い合わせ</h3>
              <img class="is-hidden_pc" src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/use_01.jpg" alt="" width="250" height="250" loading="lazy" decoding="async">
              <p>サービスの詳細、気になっている汚れやお掃除したい箇所についてなど、
                お電話またはメールフォームにてお気軽にお問い合わせください。</p>
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
                ご希望のサービス内容を詳しくお伺いし、お掃除・お手伝いする
                箇所の確認をいたします。
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
        <h2 class="ttl">対応エリア</h2>
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/map.png" alt="" width="518" height="534" loading="lazy" decoding="async">
        <dl>
          <div>
            <dt>
              愛知エリア
            </dt>
            <dd>
              名古屋市（天白区・北区・昭和区・千種区・中区・中川区・西区・東区・瑞穂区・緑区・南区・港区・名東区・守山区）・
              愛西市・あま市・安城市・一宮市・稲沢市・大府市・岡崎市・尾張旭市・春日井市・刈谷市・北名古屋市・清須市・江南市・
              小牧市・瀬戸市・高浜市・知多市・知立市・津島市・東海市・常滑市・豊明市・豊田市・長久手市・西尾市・日進市・半田市・
              碧南市・みよし市・弥富市・東郷町・大治町・蟹江町・阿久比町・美浜町・扶桑町・新城市・豊川市・豊橋市・蒲郡市・幸田町
            </dd>
          </div>
          <div>
            <dt>
              岐阜エリア
            </dt>
            <dd>
              岐阜市・羽島市・各務原市・山県市・瑞穂市・本巣市・羽島郡・本巣郡・大垣市・海津市・養老郡・不破郡・安八郡・揖斐郡・
              関市・美濃市・美濃加茂市・可児市・多治見市・瑞浪市・恵那市
            </dd>
          </div>
          <div>
            <dt>
              三重エリア
            </dt>
            <dd>
              桑名市・いなべ市・木曽岬町・東員町・四日市市・朝日町・川越町・鈴鹿市・亀山市・津市・松阪市・多気町・明和町・大台町・伊勢市・
              鳥羽市・志摩市・玉城町・度会町・伊賀市・名張市
            </dd>
          </div>
          <div>
            <dt>
              静岡エリア
            </dt>
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
            <dt>
              表示されている料金以外に、追加でかかる費用はありますか？
            </dt>
            <dd>
              エアコン本体の料金＋オプション（ご希望時のみ）が総額です。<br>
              出張費・基本的な養生・洗浄作業料はすべて含まれています。<br>
              勝手に追加請求することは一切ございません。<br>
              お客様にとって一番負担の少ない方法をご提案し、無理な工事を押しつけることもありません。
            </dd>
          </div>
          <div>
            <dt>
              出張料はかかりますか？？
            </dt>
            <dd>
              出張料はいただきません。
            </dd>
          </div>
          <div>
            <dt>
              キャンセル料はかかりますか？
            </dt>
            <dd>
              お見積りをした後でも、納得がいかなければキャンセルいただけます。<br>
              作業着手前のキャンセルに関しては代金をいただいておりません。
            </dd>
          </div>
          <div>
            <dt>
              事前に準備しておくことはありますか？
            </dt>
            <dd>
              下記のご協力をお願いしています。
              <ul>
                <li>・エアコンの真下や周辺にある小物・壊れやすいものの移動</li>
                <li>・作業スペースとして1〜2畳ほどの空きスペースの確保</li>
                <li>・お風呂場またはベランダなど、部品洗浄に使用できる場所のご提供</li>
              </ul>
            </dd>
          </div>
          <div>
            <dt>
              猫や犬などのペットがいますが大丈夫ですか？
            </dt>
            <dd>
              エアコンクリーニングなどの作業には基本的にはオーガニック洗剤を使用しています<br>
              安心して下さい。
            </dd>
          </div>
        </dl>
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
        <?php echo apply_shortcodes('[contact-form-7 id="565" title="エアコンのクリーニングのフォーム"]'); ?>
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
            <br>アーク代官町ビルディング2F
          </p>
          <p>TEL:052-932-5450</p>
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