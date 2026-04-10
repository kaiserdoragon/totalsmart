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
  $ts_has_seo_plugin = (
    defined('WPSEO_VERSION') ||
    defined('RANK_MATH_VERSION') ||
    defined('AIOSEO_VERSION') ||
    defined('SEOPRESS_VERSION')
  );

  $ts_object_id = get_queried_object_id();
  $ts_post_slug = $ts_object_id ? get_post_field('post_name', $ts_object_id) : '';
  $ts_meta_desc = '';

  if (!$ts_has_seo_plugin) {
    if ('camera' === $ts_post_slug) {
      $ts_meta_desc = '「防犯対策を強化したい」「どのカメラを選べばいいかわからない」そんな悩みはトータルスマートが解決します。AI検知、夜間カラー撮影、長期録画など多様なニーズに対応。施工後の保守管理も万全で、導入後も長く安心してご利用いただけます。現地調査・見積もり無料。防犯のプロによる最適な提案を今すぐご確認ください。';
    } elseif ('aircon' === $ts_post_slug) {
      $ts_meta_desc = '業務用エアコンのメタディスクリプションが入ります。';
    } else {
      $ts_excerpt = $ts_object_id ? get_post_field('post_excerpt', $ts_object_id) : '';

      if (!empty($ts_excerpt)) {
        $ts_meta_desc = $ts_excerpt;
      } else {
        $ts_content = $ts_object_id ? get_post_field('post_content', $ts_object_id) : '';
        $ts_content_clean = wp_strip_all_tags(strip_shortcodes((string) $ts_content));

        if (function_exists('mb_strlen') && function_exists('mb_substr')) {
          if (mb_strlen($ts_content_clean, 'UTF-8') > 120) {
            $ts_meta_desc = mb_substr($ts_content_clean, 0, 120, 'UTF-8') . '...';
          } else {
            $ts_meta_desc = $ts_content_clean;
          }
        } else {
          $ts_meta_desc = wp_trim_words($ts_content_clean, 120, '...');
        }
      }

      if ('' === trim((string) $ts_meta_desc)) {
        $ts_meta_desc = $ts_object_id
          ? wp_strip_all_tags(get_the_title($ts_object_id)) . 'について。トータルスマート株式会社のサービスページです。'
          : 'トータルスマート株式会社のサービスページです。';
      }
    }
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
          <li><a href="<?php echo esc_url(home_url('/service/camera/#camera_reason')); ?>">選ばれる4つの理由</a></li>
          <li><a href="<?php echo esc_url(home_url('/service/camera/#camera_assignment')); ?>">3つの最適解</a></li>
          <li><a href="<?php echo esc_url(home_url('/service/camera/#camera_construction')); ?>">施工実績</a></li>
          <li><a href="<?php echo esc_url(home_url('/service/camera/#camera_flow')); ?>">導入・施工までの流れ</a></li>
          <li><a href="<?php echo esc_url(home_url('/service/camera/#camera_qa')); ?>">よくある質問</a></li>
          <li><a href="<?php echo esc_url(home_url('/service/camera/#camera_area')); ?>">対応エリア</a></li>
        </ul>
      </nav>
      <nav class="service_nav" id="service_nav">
        <ul>
          <li><a href="<?php echo esc_url(home_url('/service/camera/#camera_reason')); ?>">選ばれる4つの理由</a></li>
          <li><a href="<?php echo esc_url(home_url('/service/camera/#camera_assignment')); ?>">3つの最適解</a></li>
          <li><a href="<?php echo esc_url(home_url('/service/camera/#camera_construction')); ?>">施工実績</a></li>
          <li><a href="<?php echo esc_url(home_url('/service/camera/#camera_flow')); ?>">導入・施工までの流れ</a></li>
          <li><a href="<?php echo esc_url(home_url('/service/camera/#camera_qa')); ?>">よくある質問</a></li>
          <li><a href="<?php echo esc_url(home_url('/service/camera/#camera_area')); ?>">対応エリア</a></li>
        </ul>
        <div class="header--btn">
          <a href="tel:0529325450" class="header--tel">052-932-5450
            <span>営業時間 9:00～18:00</span>
          </a>
          <a href="<?php echo esc_url(home_url('/contact_corporate/')); ?>" class="header--contact">
            お問い合わせ
          </a>
        </div>
      </nav>
      <div id="service_nav_btn" class="service_nav_btn">
        <span class="service_nav--line service_nav--line1"></span>
        <span class="service_nav--line service_nav--line2"></span>
        <span class="service_nav--line service_nav--line3"></span>
      </div>
    </header>