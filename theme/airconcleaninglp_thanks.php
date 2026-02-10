<?php
/*
Template Name: エアコンクリーニングLPのサンクスページ
*/
defined('ABSPATH') || exit;

// URL（フラグメントは後で連結する）
$lp_url_raw = home_url('/cleaninglp/');
$lp_url     = esc_url($lp_url_raw);
$lp_contact = esc_url($lp_url_raw . '#contact');

// 表示用電話番号（計測用番号などに差し替えるならここだけ変更）
$tel_display = '0800-111-3816';
$tel_href    = 'tel:' . preg_replace('/[^0-9+]/', '', $tel_display);

// サンクスページは通常 noindex（WP流儀：wp_robots）
if (function_exists('wp_robots_no_robots')) {
  add_filter('wp_robots', 'wp_robots_no_robots');
} else {
  // 旧環境向けフォールバック（wp_robots が無い場合のみ）
  add_action('wp_head', static function () {
    echo "\n" . '<meta name="robots" content="noindex, nofollow">' . "\n";
  }, 0);
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <meta name="format-detection" content="telephone=no">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Michroma&family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet" media="print" onload="this.media='all'">

  <link rel="icon" href="<?php echo esc_url(get_theme_file_uri('/img/icons/favicon.ico')); ?>">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url(get_theme_file_uri('/img/icons/apple-touch-icon.png')); ?>">

  <?php
  // テーマが title-tag 非対応の場合だけフォールバックで title を出す（重複回避）
  if (!current_theme_supports('title-tag')) {
    echo '<title>' . esc_html(wp_get_document_title()) . '</title>' . "\n";
  }
  ?>

  <?php wp_head(); ?>
</head>

<body <?php body_class('cleaninglp-thanks'); ?>>
  <?php wp_body_open(); ?>

  <header class="header">
    <div class="contents">
      <div class="header--logo">
        <a href="<?php echo $lp_url; ?>">
          <p>愛知県・岐阜県・三重県・静岡県のエアコンクリーニングはトータルスマート株式会社</p>
          <picture>
            <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/logo.avif" type="image/avif">
            <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/logo.webp" type="image/webp">
            <img
              src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/logo.png"
              alt="株式会社トータルスマート"
              width="397" height="262"
              fetchpriority="high"
              loading="eager"
              decoding="async">
          </picture>
        </a>
      </div>

      <div class="header--btns">
        <div class="header--btn-item">
          <a href="<?php echo esc_url($tel_href); ?>" class="cv_button gtm-click-tel">
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/tel.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/tel.webp" type="image/webp">
              <img
                src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/tel.png"
                alt="お電話でのご相談はこちら: <?php echo esc_attr($tel_display); ?>"
                width="270" height="70"
                decoding="async">
            </picture>
          </a>
        </div>

        <div class="header--btn-item">
          <a href="<?php echo $lp_contact; ?>" class="cv_button gtm-click-mail">
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/mail.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/mail.webp" type="image/webp">
              <img
                src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/mail.png"
                alt="メールでお問い合わせ（LPへ戻ります）"
                width="270" height="70"
                decoding="async">
            </picture>
          </a>
        </div>

        <div class="header--btn-item">
          <a href="https://lin.ee/fXrKQyq" class="cv_button gtm-click-line" rel="noopener noreferrer">
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/line.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/line.webp" type="image/webp">
              <img
                src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/line.png"
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
        <h1 class="ttl">お問い合わせありがとうございます</h1>
        <p>
          お問い合わせありがとうございます。<br>
          このたびは、トータルスマート株式会社へお問い合わせ頂き誠にありがとうございます。<br>
          お送り頂きました内容を確認の上、2～3営業日以内に折り返しご連絡させて頂きます。<br><br>
          なお、お急ぎの場合は電話でもご相談を受け付けております。<br>
          <?php echo esc_html($tel_display); ?>までご遠慮なくご相談ください。
        </p>

        <div class="thanks--tel">
          <a href="<?php echo esc_url($tel_href); ?>" class="cv_button">
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/tel.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/tel.webp" type="image/webp">
              <img
                src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/tel.png"
                alt="お電話でのご相談はこちら: <?php echo esc_attr($tel_display); ?>"
                width="355" height="90"
                decoding="async">
            </picture>
          </a>
        </div>

        <a class="thanks--back" href="<?php echo $lp_url; ?>">ページのTOPに戻る</a>
      </div>
    </section>
  </main>

  <div class="footer_btn_fixed" id="js_fixed-btn">
    <p class="footer_btn_fixed--tel"><a href="<?php echo esc_url($tel_href); ?>">電話で<br>予約する</a></p>
    <p class="footer_btn_fixed--mail"><a href="<?php echo $lp_contact; ?>">メールで<br>無料見積り</a></p>
    <p class="footer_btn_fixed--line"><a href="https://lin.ee/fXrKQyq" rel="noopener noreferrer">LINEで<br>問い合わせ</a></p>
  </div>

  <footer class="footer">
    <div class="contents -md">
      <div>
        <div class="footer--logo">
          <a href="<?php echo esc_url(home_url('/')); ?>">
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/logo_footer.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/logo_footer.webp" type="image/webp">
              <img
                src="<?php echo esc_url(get_template_directory_uri()); ?>/cleaninglp/img/logo_footer.png"
                alt="株式会社トータルスマート"
                width="397" height="84"
                decoding="async">
            </picture>
          </a>
        </div>

        <div class="footer--info">
          <p>〒461-0002 愛知県名古屋市東区代官町16-17<br>アーク代官町ビルディング2F</p>
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