<?php
/*
Template Name: エアコン修理LPのサンクスページ
*/
defined('ABSPATH') || exit;

// LP URL
$lp_url_raw     = home_url('/shuurilp/');
$lp_url         = esc_url($lp_url_raw);
$lp_contact     = esc_url($lp_url_raw . '#contact');

// 電話（表示用 / telリンク用）
$tel            = '0800-111-3816';
$tel_href       = 'tel:' . preg_replace('/[^0-9+]/', '', $tel);

// サンクスページは通常インデックス不要（WPのrobots出力をnoindexに寄せる）
if (function_exists('wp_robots_no_robots')) {
  add_filter('wp_robots', 'wp_robots_no_robots', 99);
} else {
  // 古いWP向け（wp_no_robots は後方互換用途）
  add_action('wp_head', 'wp_no_robots', 1);
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover, maximum-scale=1.0">
  <meta name="format-detection" content="telephone=no">

  <!-- サンクスページは通常インデックス不要。不要ならこの1行を削除 -->
  <meta name="robots" content="noindex, nofollow">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Michroma&family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet" media="print" onload="this.media='all'">

  <link rel="icon" href="<?php echo esc_url(get_theme_file_uri('/img/icons/favicon.ico')); ?>">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url(get_theme_file_uri('/img/icons/apple-touch-icon.png')); ?>">

  <?php wp_head(); ?>
</head>

<body <?php body_class(['shuurilp-thanks']); ?>>
  <?php wp_body_open(); ?>

  <header class="header">
    <div class="contents">
      <section class="header--logo">
        <a href="<?php echo $lp_url; ?>">
          <p>エアコンが冷えない・動かない・水漏れ・異音の修理はトータルスマート株式会社</p>
          <h1>
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/logo.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/logo.webp" type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/logo.png"
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
          <a href="<?php echo esc_url($tel_href); ?>" class="cv_button">
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/tel.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/tel.webp" type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/tel.png"
                alt="お電話でのご相談はこちら: <?php echo esc_attr($tel); ?>"
                width="270" height="70"
                decoding="async">
            </picture>
          </a>
        </div>

        <div class="header--btn-item">
          <a href="<?php echo $lp_contact; ?>" class="cv_button">
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/mail.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/mail.webp" type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/mail.png"
                alt="メールでお問い合わせ（LPへ戻ります）"
                width="270" height="70"
                decoding="async">
            </picture>
          </a>
        </div>

        <div class="header--btn-item">
          <a href="https://lin.ee/fXrKQyq" class="cv_button" rel="noopener">
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
    <section class="thanks sec -sm">
      <div class="contents -md">
        <h2 class="ttl">お問い合わせありがとうございます</h2>
        <p>
          お問い合わせありがとうございます。<br>
          このたびは、トータルスマート株式会社へお問い合わせ頂き誠にありがとうございます。<br>
          お送り頂きました内容を確認の上、2～3営業日以内に折り返しご連絡させて頂きます。<br><br>
          なお、お急ぎの場合は電話でもご相談を受け付けております。<br>
          <?php echo esc_html($tel); ?>までご遠慮なくご相談ください。
        </p>

        <div class="thanks--tel">
          <a href="<?php echo esc_url($tel_href); ?>" class="cv_button">
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/tel.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/tel.webp" type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/shuurilp/img/tel.png"
                alt="お電話でのご相談はこちら: <?php echo esc_attr($tel); ?>"
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
    <p class="footer_btn_fixed--line"><a href="https://lin.ee/fXrKQyq" rel="noopener">LINEで<br>問い合わせ</a></p>
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