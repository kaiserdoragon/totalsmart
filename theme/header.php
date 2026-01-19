<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width">
  <meta name="format-detection" content="telephone=no">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Michroma&family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
  <meta name="description" content="<?php if (wp_title('', false)): ?><?php bloginfo('name'); ?>の<?php echo trim(wp_title('', false)); ?>のページです。<?php endif; ?><?php bloginfo('description'); ?>">
  <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/img/icons/apple-touch-icon.png">
  <?php wp_head(); ?>
</head>

<body>
  <div class="wrap">
    <header class="header">
      <div class="header--inner">
        <h1 class="header--logo">
          <a href="<?php echo esc_url(home_url('/')); ?>">
            <small>【愛知県・岐阜県・三重県・静岡県対応】<br>防犯・通信・省エネをまとめて任せて、コスト削減ならトータルスマート株式会社</small>
            <img src="<?php echo get_template_directory_uri(); ?>/img/common/logo.png" alt="トータルスマート株式会社" width="325" height="68" />
          </a>
        </h1>
        <button id="js-gnav_btn" class="gnav_btn">
          <span></span>
          <span></span>
          <span></span>
        </button>
        <nav id="js-gnav" class="gnav">
          <div class="gnav--inner">
            <ul>
              <li><a href="#">事業内容</a></li>
              <li><a href="#">サービス</a></li>
              <li><a href="#">導入実績</a></li>
              <li><a href="#">会社概要</a></li>
              <li><a href="#">お役立ち情報</a></li>
              <li><a href="#">採用情報</a></li>
            </ul>
            <div class="header--btn">
              <a href="#" class="header--tel">
                052-932-5450
                <span>営業時間 9:00～18:00</span>
              </a>
              <a href="#" class="header--contact">
                お問い合わせ
              </a>
            </div>
          </div>
        </nav>
      </div>
    </header>