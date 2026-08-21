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
      j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-TKC4PWHS');
  </script>
  <!-- End Google Tag Manager -->

  <meta charset="<?php echo esc_attr(get_bloginfo('charset')); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <meta name="format-detection" content="telephone=no">

  <?php
  $ts_has_seo_plugin = function_exists('ts_is_major_seo_plugin_active')
    ? ts_is_major_seo_plugin_active()
    : (
      defined('WPSEO_VERSION') ||
      defined('RANK_MATH_VERSION') ||
      defined('AIOSEO_VERSION') ||
      defined('SEOPRESS_VERSION') ||
      defined('SLIM_SEO_VERSION') ||
      class_exists('The_SEO_Framework\\Load') ||
      function_exists('rank_math')
    );

  $ts_object_id = get_queried_object_id();
  $ts_post_slug = $ts_object_id ? get_post_field('post_name', $ts_object_id) : '';
  $ts_meta_desc = '';

  if (! $ts_has_seo_plugin) {
    $ts_meta_desc = isset($GLOBALS['ts_meta_description_override'])
      ? (string) $GLOBALS['ts_meta_description_override']
      : '';

    if ('' === trim((string) $ts_meta_desc) && $ts_object_id && function_exists('ts_get_custom_seo_description')) {
      $ts_meta_desc = ts_get_custom_seo_description($ts_object_id);
    }

    $custom_descriptions = [
      'camera' => '「防犯対策を強化したい」「どのカメラを選べばいいかわからない」そんな悩みはトータルスマートが解決します。AI検知、夜間カラー撮影、長期録画など多様なニーズに対応。施工後の保守管理も万全で、導入後も長く安心してご利用いただけます。現地調査・見積もり無料。防犯のプロによる最適な提案を今すぐご確認ください。',
      'hukugouki' => '愛知・岐阜・三重・静岡で法人向け複合機の新規導入・入れ替え・リース・購入ならトータルスマート株式会社。月間印刷枚数やA3利用、カウンター料金、保守内容を確認し、自社に合う機種と契約をご提案します。現地調査・見積もりは無料です。',
      'aircon' => '愛知・岐阜・三重・静岡で業務用エアコンのクリーニング・掃除・修理ならトータルスマート株式会社。店舗・オフィス・クリニックのカビ臭・汚れ・水漏れ・効きの悪さを現地調査・無料見積りで確認します。',
    ];

    if ('' === trim((string) $ts_meta_desc) && array_key_exists($ts_post_slug, $custom_descriptions)) {
      $ts_meta_desc = $custom_descriptions[$ts_post_slug];
    }

    if ('' === trim((string) $ts_meta_desc) && function_exists('ts_get_fallback_meta_description')) {
      $ts_meta_desc = ts_get_fallback_meta_description();
    }

    if ('' === trim((string) $ts_meta_desc) && $ts_object_id) {
      $ts_meta_desc = get_post_field('post_excerpt', $ts_object_id);

      if (empty($ts_meta_desc)) {
        $content = get_post_field('post_content', $ts_object_id);
        $ts_meta_desc = wp_strip_all_tags(strip_shortcodes((string) $content));
      }
    }

    if (empty(trim((string) $ts_meta_desc))) {
      $title = $ts_object_id ? wp_strip_all_tags(get_the_title($ts_object_id)) : '';
      $ts_meta_desc = $title
        ? "{$title}について。トータルスマート株式会社のサービスページです。"
        : 'トータルスマート株式会社のサービスページです。';
    }

    if (function_exists('ts_normalize_meta_text')) {
      $ts_meta_desc = ts_normalize_meta_text($ts_meta_desc, 160);
    } else {
      $ts_meta_desc = html_entity_decode((string) $ts_meta_desc, ENT_QUOTES, get_bloginfo('charset') ?: 'UTF-8');
      $ts_meta_desc = wp_strip_all_tags($ts_meta_desc);
      $ts_meta_desc = preg_replace('/\s+/u', ' ', $ts_meta_desc);
      $ts_meta_desc = trim((string) $ts_meta_desc);

      if (function_exists('mb_strlen') && mb_strlen($ts_meta_desc, 'UTF-8') > 160) {
        $ts_meta_desc = rtrim(mb_substr($ts_meta_desc, 0, 160, 'UTF-8')) . '…';
      }
    }

    // OGP 側も同じ description を使う。
    if ('' !== $ts_meta_desc) {
      $GLOBALS['ts_meta_description_override'] = $ts_meta_desc;
    }
  }
  ?>

  <?php if (!current_theme_supports('title-tag')) : ?>
    <title><?php echo esc_html(wp_get_document_title()); ?></title>
  <?php endif; ?>

  <?php if (!$ts_has_seo_plugin && !empty($ts_meta_desc)) : ?>
    <meta name="description" content="<?php echo esc_attr($ts_meta_desc); ?>">
  <?php endif; ?>

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

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TKC4PWHS"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <?php
  $service_post = is_singular() ? get_post() : null;
  $service_page_url = $service_post ? get_permalink($service_post) : '';
  $service_nav_map = [
    'camera' => [
      ['anchor' => 'camera_reason', 'label' => '選ばれる4つの理由'],
      ['anchor' => 'camera_assignment', 'label' => '3つの最適解'],
      ['anchor' => 'camera_construction', 'label' => '施工実績'],
      ['anchor' => 'camera_flow', 'label' => '導入・施工までの流れ'],
      ['anchor' => 'camera_qa', 'label' => 'よくある質問'],
      ['anchor' => 'camera_area', 'label' => '対応エリア'],
    ],
    'aircon' => [
      ['anchor' => 'aircon_improvement', 'label' => 'エアコンの症状改善'],
      ['anchor' => 'aircon_reason', 'label' => '選ばれる4つの理由'],
      ['anchor' => 'aircon_construction', 'label' => '施工実績'],
      ['anchor' => 'aircon_flow', 'label' => '導入・施工までの流れ'],
      ['anchor' => 'aircon_qa', 'label' => 'よくある質問'],
      ['anchor' => 'aircon_area', 'label' => '対応エリア'],
    ],
    'airconchange' => [
      ['anchor' => 'airconchange_improvement', 'label' => '機器選定から一括対応'],
      ['anchor' => 'airconchange_reason', 'label' => '選ばれる6つの理由'],
      ['anchor' => 'airconchange_construction', 'label' => '施工・導入実績'],
      ['anchor' => 'airconchange_flow', 'label' => '導入・施工までの流れ'],
      ['anchor' => 'airconchange_qa', 'label' => 'よくある質問'],
      ['anchor' => 'airconchange_area', 'label' => '対応エリア'],
    ],
    'hukugouki' => [
      ['anchor' => 'hukugouki_reason', 'label' => '選ばれる4つの理由'],
      ['anchor' => 'hukugouki_assignment', 'label' => '3つの提案'],
      ['anchor' => 'hukugouki_construction', 'label' => '導入事例'],
      ['anchor' => 'hukugouki_flow', 'label' => '導入までの流れ'],
      ['anchor' => 'hukugouki_qa', 'label' => 'よくある質問'],
      ['anchor' => 'hukugouki_area', 'label' => '対応エリア'],
    ],
  ];
  $service_nav_items = $service_post
    ? ($service_nav_map[$service_post->post_name] ?? [])
    : [];

  $render_service_nav = static function ($items, $page_url) {
    if (empty($items) || empty($page_url)) {
      return;
    }
    ?>
    <ul>
      <?php foreach ($items as $item) : ?>
        <li>
          <a href="<?php echo esc_url($page_url . '#' . $item['anchor']); ?>">
            <?php echo esc_html($item['label']); ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
    <?php
  };

  $render_service_header_buttons = static function () {
    ?>
    <div class="header--btn">
      <a href="tel:0529325450" class="header--tel">052-932-5450
        <span>営業時間 9:00～18:00</span>
      </a>
      <a href="<?php echo esc_url(home_url('/contact_corporate/')); ?>" class="header--contact">
        お問い合わせ
      </a>
    </div>
    <?php
  };
  ?>

  <div class="wrap" id="main-content">
    <header class="header header_single_detail">
      <div class="header--inner">
        <p class="header--logo">
          <small>【愛知県・岐阜県・三重県・静岡県対応】<br>
            防犯・通信・省エネをまとめて任せて、コスト削減
            ならトータルスマート株式会社</small>
          <a href="<?php echo esc_url(home_url('/')); ?>">
            <img
              src="<?php echo esc_url(get_theme_file_uri('/img/common/logo.png')); ?>"
              alt="トータルスマート株式会社"
              width="325"
              height="68"
              decoding="async">
          </a>
        </p>
        <?php $render_service_header_buttons(); ?>
      </div>

      <nav class="header_single_detail--menu">
        <?php $render_service_nav($service_nav_items, $service_page_url); ?>
      </nav>

      <nav class="service_nav" id="service_nav">
        <?php $render_service_nav($service_nav_items, $service_page_url); ?>
        <?php $render_service_header_buttons(); ?>
      </nav>

      <div id="service_nav_btn" class="service_nav_btn">
        <span class="service_nav--line service_nav--line1"></span>
        <span class="service_nav--line service_nav--line2"></span>
        <span class="service_nav--line service_nav--line3"></span>
      </div>
    </header>