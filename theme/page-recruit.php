<?php get_header(); ?>

<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "GeneralContractor",
    "name": "トータルスマート株式会社",
    "alternateName": "Total Smart Co., Ltd.",
    "url": "<?php echo esc_url(home_url('/')); ?>",
    "logo": "<?php echo get_template_directory_uri(); ?>/img/common/logo.png",
    "image": "<?php echo get_template_directory_uri(); ?>/img/top/recruit.png",
    "description": "名古屋市を中心に愛知・岐阜・三重・静岡でエアコン修理・クリーニング、防犯カメラ、LED照明、光回線、OA機器などオフィス・店舗・住宅の設備工事を一括対応する総合設備会社。",
    "foundingDate": "2014",
    "address": {
      "@type": "PostalAddress",
      "postalCode": "461-0002",
      "addressRegion": "愛知県",
      "addressLocality": "名古屋市東区",
      "streetAddress": "代官町16-17 アーク代官町ビルディング2F",
      "addressCountry": "JP"
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": "35.1763",
      "longitude": "136.9205"
    },
    "telephone": "052-932-5450",
    "faxNumber": "052-932-5451",
    "contactPoint": {
      "@type": "ContactPoint",
      "telephone": "052-932-5450",
      "contactType": "customer service",
      "areaServed": ["JP", "愛知県", "岐阜県", "三重県", "静岡県"],
      "availableLanguage": "Japanese"
    },
    "employee": {
      "@type": "Person",
      "name": "京田 貴志",
      "jobTitle": "代表取締役"
    },
    "priceRange": "$$"
  }
</script>
<div class="eyecatch">
  <?php if (has_post_thumbnail()): ?>
    <?php the_post_thumbnail(); ?>
  <?php else: ?>
  <?php endif; ?>
  <h1><?php the_title(); ?></h1>
</div>

<div class="breadcrumbs--wrap">
  <?php get_template_part('include/common', 'breadcrumb'); ?>
</div>
<?php $slug_name = $post->post_name; ?>
<main class="<?php echo $slug_name; ?>_page">
  <section class="recruit_lead sec">
    <div class="container">
      <h2 class="ttl">
        採用情報
        <span>RECRUIT</span>
      </h2>
      <dl>
        <dt>自由な発想とチームワークを最大限に高める企業風土の創出</dt>
        <dd>
          弊社では決められたマニュアルはなく自分なりのルールで行動し、提案ができる社風です。<br>
          その為人間性を重視し、「誰と働くか」ということを大切にしています。<br>
          また働き方や雇用形態には縛られず、リモートワークなどを積極的に取り入れ、<br class="is-hidden_sp">
          成果に対してしっかりと還元をする独自の評価システムを構築することによってチームワークを強化し、<br class="is-hidden_sp">
          お客様はもちろん従業員がよりよい環境で働けることを目指します。
        </dd>
      </dl>
    </div>
    <div class="swiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/slide_01.jpg" alt="" width="320" height="270" loading="lazy" decoding="async">
        </div>
        <div class="swiper-slide">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/slide_02.jpg" alt="" width="320" height="270" loading="lazy" decoding="async">
        </div>
        <div class="swiper-slide">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/slide_03.jpg" alt="" width="320" height="270" loading="lazy" decoding="async">
        </div>
        <div class="swiper-slide">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/slide_04.jpg" alt="" width="320" height="270" loading="lazy" decoding="async">
        </div>
        <div class="swiper-slide">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/slide_05.jpg" alt="" width="320" height="270" loading="lazy" decoding="async">
        </div>
        <div class="swiper-slide">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/slide_06.jpg" alt="" width="320" height="270" loading="lazy" decoding="async">
        </div>
        <div class="swiper-slide">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/slide_01.jpg" alt="" width="320" height="270" loading="lazy" decoding="async">
        </div>
        <div class="swiper-slide">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/slide_02.jpg" alt="" width="320" height="270" loading="lazy" decoding="async">
        </div>
        <div class="swiper-slide">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/slide_03.jpg" alt="" width="320" height="270" loading="lazy" decoding="async">
        </div>
        <div class="swiper-slide">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/slide_04.jpg" alt="" width="320" height="270" loading="lazy" decoding="async">
        </div>
        <div class="swiper-slide">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/slide_05.jpg" alt="" width="320" height="270" loading="lazy" decoding="async">
        </div>
        <div class="swiper-slide">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/slide_06.jpg" alt="" width="320" height="270" loading="lazy" decoding="async">
        </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>