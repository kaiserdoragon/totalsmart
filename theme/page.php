<?php get_header(); ?>
<div class="eyecatch">
  <?php if (has_post_thumbnail()): // サムネイルを持っているとき 
  ?><?php the_post_thumbnail(); ?><?php else: // サムネイルを持っていない 
                                  ?><?php endif; ?>
  <h1><?php the_title(); ?></h1>
</div>

<div class="breadcrumbs--wrap">
  <?php get_template_part('include/common', 'breadcrumb'); ?>
</div>

<?php $slug_name = $post->post_name; ?>
<main class="<?php echo $slug_name; ?>_page">
  <div class="container sec -bottom">
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</main>

<?php get_footer(); ?>