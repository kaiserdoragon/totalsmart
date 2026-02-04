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

<div class="archive--wrap">
  <?php get_template_part('include/common', 'breadcrumb'); ?>
</div>
<div class="single_service">
  <main>
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
        <article>
          <h2 class="page_detail_ttl"><?php the_title(); ?></h2>
          <?php the_content(); ?>
        </article>
        <ul class="paging">
          <li class="paging--item paging--item-next">
            <?php if (get_next_post()): ?>
              <?php next_post_link('%link', '%title', false); ?>
            <?php endif; ?>
          </li>
          <li class="paging--item paging--item-gotolist">
            <a href="<?php echo home_url(); ?>/service">一覧へ戻る</a>
          </li>
          <li class="paging--item paging--item-prev">
            <?php if (get_previous_post()): ?>
              <?php previous_post_link('%link', '%title', false); ?>
            <?php endif; ?>
          </li>
        </ul>

      <?php endwhile; ?>
    <?php endif; ?>
  </main>
</div>

<?php get_footer(); ?>