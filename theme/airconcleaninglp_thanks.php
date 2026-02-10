<?php
/*
Template Name: エアコンクリーニングLPのサンクスページ
*/
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
  <section class="thanks sec -sm">
    <div class="contents -md">
      <h2 class="ttl">お問い合わせありがとうございます</h2>
      <p>
        お問い合わせありがとうございます。<br>
        このたびは、トータルスマート株式会社へお問い合わせ頂き誠にありがとうございます。<br>
        お送り頂きました内容を確認の上、2～3営業日以内に折り返しご連絡させて頂きます。<br>

        なお、お急ぎの場合は電話でもご相談を受け付けております。<br>
        0800-111-3816までご遠慮なくご相談ください。
      </p>
      <div class="thanks--tel">
        <a href="tel:0800-111-3816" class="cv_button">
          <picture>
            <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/tel.avif" type="image/avif">
            <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/tel.webp" type="image/webp">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/tel.png"
              alt="お電話でのご相談はこちら: 0800-111-3816"
              width="355" height="90"
              decoding="async">
          </picture>
        </a>
      </div>

      <a class="thanks--back" href="<?php echo esc_url(home_url('/cleaninglp/')); ?>">ページのTOPに戻る</a>
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
        <a href="<?php echo esc_url(home_url('/')); ?>" itemprop="url">
          <picture>
            <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/logo_footer.avif" type="image/avif">
            <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/logo_footer.webp" type="image/webp">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/logo_footer.png"
              alt="株式会社トータルスマート"
              width="397" height="84"
              decoding="async"
              itemprop="logo">
          </picture>
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