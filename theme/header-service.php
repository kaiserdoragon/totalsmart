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
  $ts_is_front_like = is_home() || is_front_page();

  $ts_has_seo_plugin = (
    defined('WPSEO_VERSION') ||
    defined('RANK_MATH_VERSION') ||
    defined('AIOSEO_VERSION') ||
    defined('SEOPRESS_VERSION')
  );

  $ts_meta_desc = '';
  $ts_robots    = '';

  $ts_noindex_pages = [
    'attention',
    'contact_corporate-confirm',
    'contact_corporate-thanks',
    'cleaning_thanks',
    'shuuri_thanks',
  ];

  if (is_front_page()) {
    $ts_meta_desc = get_bloginfo('description');

    if ('' === trim((string) $ts_meta_desc)) {
      $ts_meta_desc = '愛知県・岐阜県・三重県・静岡県対応。防犯・通信・省エネをまとめて任せて、コスト削減を支援するトータルスマート株式会社。';
    }
  } elseif (is_home()) {
    $ts_meta_desc = 'トータルスマート株式会社のお知らせ一覧です。最新情報や重要なお知らせをご案内します。';
  } elseif (is_page($ts_noindex_pages)) {
    $ts_meta_desc = wp_strip_all_tags(get_the_title(get_queried_object_id())) . 'のページです。';
    $ts_robots    = 'noindex,follow';
  } elseif (is_search()) {
    $ts_meta_desc = '「' . get_search_query() . '」の検索結果ページです。';
    $ts_robots    = 'noindex,follow';
  } elseif (is_404()) {
    $ts_meta_desc = 'お探しのページは見つかりませんでした。';
    $ts_robots    = 'noindex,follow';
  } elseif (is_singular()) {
    $ts_object_id = get_queried_object_id();
    $ts_excerpt   = get_the_excerpt($ts_object_id);

    if (!empty($ts_excerpt)) {
      $ts_meta_desc = $ts_excerpt;
    } else {
      $ts_content   = get_post_field('post_content', $ts_object_id);
      $ts_meta_desc = wp_trim_words(
        wp_strip_all_tags(strip_shortcodes((string) $ts_content)),
        120,
        '...'
      );
    }

    if ('' === trim((string) $ts_meta_desc)) {
      $ts_meta_desc = wp_strip_all_tags(get_the_title($ts_object_id)) . 'について。トータルスマートは愛知・岐阜・三重・静岡でオフィスのコスト削減を支援します。';
    }
  } elseif (is_category() || is_tag() || is_tax()) {
    $ts_term_desc = term_description();

    if (!empty($ts_term_desc)) {
      $ts_meta_desc = wp_strip_all_tags($ts_term_desc);
    } else {
      $ts_meta_desc = wp_strip_all_tags(single_term_title('', false)) . 'の一覧ページです。';
    }
  } elseif (is_post_type_archive()) {
    $ts_archive_desc = get_the_archive_description();

    if (!empty($ts_archive_desc)) {
      $ts_meta_desc = wp_strip_all_tags($ts_archive_desc);
    } else {
      $ts_meta_desc = wp_strip_all_tags(post_type_archive_title('', false)) . 'の一覧ページです。';
    }
  } elseif (is_archive()) {
    $ts_archive_desc = get_the_archive_description();

    if (!empty($ts_archive_desc)) {
      $ts_meta_desc = wp_strip_all_tags($ts_archive_desc);
    } else {
      $ts_meta_desc = wp_strip_all_tags(get_the_archive_title()) . 'の一覧ページです。';
    }
  } else {
    $ts_meta_desc = get_bloginfo('description');
  }

  $ts_meta_desc = html_entity_decode((string) $ts_meta_desc, ENT_QUOTES, get_bloginfo('charset'));
  $ts_meta_desc = wp_strip_all_tags($ts_meta_desc);
  $ts_meta_desc = preg_replace('/\s+/u', ' ', $ts_meta_desc);
  $ts_meta_desc = trim((string) $ts_meta_desc);
  ?>

  <?php if (!current_theme_supports('title-tag')) : ?>
    <title><?php echo esc_html(wp_get_document_title()); ?></title>
  <?php endif; ?>

  <?php if (!$ts_has_seo_plugin && !empty($ts_meta_desc)) : ?>
    <meta name="description" content="<?php echo esc_attr($ts_meta_desc); ?>">
  <?php endif; ?>

  <?php if (!$ts_has_seo_plugin && !empty($ts_robots)) : ?>
    <meta name="robots" content="<?php echo esc_attr($ts_robots); ?>">
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

  <div class="wrap" id="main-content">
    <header class="header header_single_detail">
      <div class="header--inner">
        <p class="header--logo">
          <small>【愛知県・岐阜県・三重県・静岡県対応】<br>防犯・通信・省エネをまとめて任せて、コスト削減ならトータルスマート株式会社</small>
          <a href="<?php echo esc_url(home_url('/')); ?>">
            <img
              src="<?php echo esc_url(get_theme_file_uri('/img/common/logo.png')); ?>"
              alt="トータルスマート株式会社"
              width="325"
              height="68"
              decoding="async">
          </a>
        </p>
        <div class="header--btn">
          <a href="tel:0529325450" class="header--tel">052-932-5450
            <span>営業時間 9:00～18:00</span>
          </a>
          <a href="<?php echo esc_url(home_url('/contact_corporate/')); ?>" class="header--contact">
            お問い合わせ
          </a>
        </div>
      </div>
      <nav class="header_single_detail--menu">
        <ul>
          <li><a href="<?php echo esc_url(home_url('/business/')); ?>">選ばれる4つの理由</a></li>
          <li><a href="<?php echo esc_url(home_url('/service/')); ?>">3つの最適解</a></li>
          <li><a href="<?php echo esc_url(home_url('/introduction/')); ?>">施工実績</a></li>
          <li><a href="<?php echo esc_url(home_url('/company/')); ?>">導入・施工までの流れ</a></li>
          <li><a href="<?php echo esc_url(home_url('/information/')); ?>">よくある質問</a></li>
          <li><a href="<?php echo esc_url(home_url('/recruit/')); ?>">対応エリア</a></li>
        </ul>
      </nav>
      <nav class="service_nav" id="service_nav">
        <ul>
          <li><a href="<?php echo esc_url(home_url('/business/')); ?>">選ばれる4つの理由</a></li>
          <li><a href="<?php echo esc_url(home_url('/service/')); ?>">3つの最適解</a></li>
          <li><a href="<?php echo esc_url(home_url('/introduction/')); ?>">施工実績</a></li>
          <li><a href="<?php echo esc_url(home_url('/company/')); ?>">導入・施工までの流れ</a></li>
          <li><a href="<?php echo esc_url(home_url('/information/')); ?>">よくある質問</a></li>
          <li><a href="<?php echo esc_url(home_url('/recruit/')); ?>">対応エリア</a></li>
        </ul>
      </nav>
      <div id="service_nav--line" class="service_nav--line">
        <span class="service_nav--line1" id="service_nav--line1"></span>
        <span class="service_nav--line2" id="service_nav--line2"></span>
        <span class="service_nav--line3" id="service_nav--line3"></span>
      </div>
    </header>