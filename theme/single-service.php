<?php get_header(); ?>

<?php
$post_type = get_post_type();

$type_settings = [
  'service'      => ['title' => 'サービス', 'img' => 'eyecatch_service.jpg', 'slug' => 'service']
];

$title = $type_settings[$post_type]['title'] ?? 'お知らせ';
$img_file = $type_settings[$post_type]['img'] ?? 'eyecatch_default.jpg';
$slug = $type_settings[$post_type]['slug'] ?? 'news';
?>

<div class="eyecatch -archive">
  <div><?php echo $title; ?></div>
  <img src="<?php echo get_template_directory_uri(); ?>/img/page/<?php echo $img_file; ?>" alt="<?php echo $title; ?>" width="1920" height="600" loading="lazy" decoding="async">
</div>

<div class="breadcrumbs--wrap">
  <?php get_template_part('include/common', 'breadcrumb'); ?>
</div>

<main>
  <div class="single_service">
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>

        <script type="application/ld+json">
          {
            "@context": "https://schema.org",
            "@type": "Service",
            "name": "<?php echo esc_js(get_the_title()); ?>",
            "image": "<?php echo has_post_thumbnail() ? esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')) : ''; ?>",
            "description": "<?php echo esc_js(get_the_excerpt()); ?>",
            "provider": {
              "@type": "Organization",
              "name": "トータルスマート株式会社",
              "url": "<?php echo esc_url(home_url('/')); ?>"
            },
            "areaServed": {
              "@type": "State",
              "name": "愛知, 岐阜, 三重, 静岡"
            }
          }
        </script>
        <article>
          <h1 class="page_detail_ttl"><?php the_title(); ?></h1>
          <?php the_content(); ?>
        </article>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</main>

<?php get_footer(); ?>