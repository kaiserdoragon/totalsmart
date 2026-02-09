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
  <h1><?php echo $title; ?></h1>
  <img src="<?php echo get_template_directory_uri(); ?>/img/page/<?php echo $img_file; ?>" alt="<?php echo $title; ?>" width="1920" height="600" loading="lazy" decoding="async">
</div>

<div class="breadcrumbs--wrap">
  <?php get_template_part('include/common', 'breadcrumb'); ?>
</div>

<main>
  <div class="single_service">
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
        <article>
          <h2 class="page_detail_ttl"><?php the_title(); ?></h2>
          <?php the_content(); ?>
        </article>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</main>

<?php get_footer(); ?>