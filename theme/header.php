<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
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

<body <?php body_class(); ?>> <?php wp_body_open(); ?> <div class="wrap">
    <header class="header">
      <div class="header--inner">
        <?php $tag = is_front_page() ? 'h1' : 'p'; ?>
        <<?php echo $tag; ?> class="header--logo">
          <small>【愛知県・岐阜県・三重県・静岡県対応】<br>防犯・通信・省エネをまとめて任せて、コスト削減ならトータルスマート株式会社</small>
          <a href="<?php echo esc_url(home_url('/')); ?>">
            <img src="<?php echo get_theme_file_uri('/img/common/logo.png'); ?>"
              alt="トータルスマート株式会社"
              width="325" height="68"
              fetchpriority="high"
              decoding="async" />
          </a>
        </<?php echo $tag; ?>>

        <button id="js-gnav_btn" class="gnav_btn" aria-label="メニューを開く" aria-controls="js-gnav">
          <span></span>
          <span></span>
          <span></span>
        </button>

        <nav id="js-gnav" class="gnav" aria-label="グローバルナビゲーション">
          <div class="gnav--inner">
            <ul>
              <li><a href="<?php echo esc_url(home_url('/business')); ?>">事業内容</a></li>
              <li><a href="<?php echo esc_url(home_url('/service')); ?>">サービス</a></li>
              <li><a href="<?php echo esc_url(home_url('/introduction')); ?>">導入実績</a></li>
              <li><a href="<?php echo esc_url(home_url('/company')); ?>">会社概要</a></li>
              <li><a href="<?php echo esc_url(home_url('/news')); ?>">お役立ち情報</a></li>
              <li><a href="<?php echo esc_url(home_url('/recruit')); ?>">採用情報</a></li>
            </ul>
            <div class="header--btn">
              <a href="tel:052-932-5450" class="header--tel"> 052-932-5450
                <span>営業時間 9:00～18:00</span>
              </a>
              <a href="<?php echo esc_url(home_url('/contact')); ?>" class="header--contact">
                お問い合わせ
              </a>
            </div>
          </div>
        </nav>
      </div>
    </header>