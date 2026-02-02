<?php get_header(); ?>

<?php
$post_type = get_post_type();

// 設定を配列にまとめる
$type_settings = [
  'question'     => ['title' => 'よくあるご質問', 'img' => 'eyecatch_question.jpg', 'slug' => 'question'],
  'service'      => ['title' => 'サービス紹介', 'img' => 'eyecatch_service.jpg', 'slug' => 'service'],
  'information'  => ['title' => 'お役立ち情報', 'img' => 'eyecatch_information.jpg', 'slug' => 'information'],
  'introduction' => ['title' => '導入事例',     'img' => 'eyecatch_introduction.jpg', 'slug' => 'introduction'],
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
  <div>
    <main class="<?php echo $slug . '_page'; ?>">
      <?php if (have_posts()): while (have_posts()) : the_post(); ?>
          <article class="detail_page">
            <div class="container">
              <time class="post_meta--date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
              <h2><?php the_title(); ?></h2>
              <ul class="detail_page--cat">
                <?php categories_label() ?>
              </ul>
              <div>
                <?php the_content(); ?>
              </div>
            </div>
          </article>

          <ul class="paging">
            <li class="paging--item paging--item-next">
              <?php if (get_next_post()): ?>
                <?php next_post_link('%link', '%title', false); ?>
              <?php endif; ?>
            </li>
            <li class="paging--item paging--item-gotolist">
              <a href="<?php echo home_url(); ?>/news/">一覧へ戻る</a>
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
</div>
<?php get_footer(); ?>