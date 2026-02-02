<?php get_header(); ?>

<?php
$post_type = get_post_type();

// 設定を配列にまとめる
$type_settings = [
  'question'     => ['title' => 'よくあるご質問', 'img' => 'eyecatch_question.jpg', 'slug' => 'question'],
  'service'      => ['title' => 'サービス紹介', 'img' => 'eyecatch_service.jpg', 'slug' => 'service'],
  'information'  => ['title' => 'お役立ち情報', 'img' => 'eyecatch_information.jpg', 'slug' => 'information'],
  'introduction' => ['title' => '導入実績',     'img' => 'eyecatch_introduction.jpg', 'slug' => 'introduction'],
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
  <div class="archive container">
    <main class="<?php echo $slug . '_page'; ?>">
      <h2 class="ttl">
        <?php echo esc_html($title); ?>
        <span><?php echo esc_html(strtoupper($slug)); ?></span>
      </h2>

      <?php if (have_posts()) : ?>
        <section class="archive--inner">
          <ul>
            <?php while (have_posts()) : the_post(); ?>
              <?php
              $current_post_type = get_post_type();
              $taxonomy = ($current_post_type === 'post') ? 'category' : (get_object_taxonomies($current_post_type)[0] ?? '');
              $terms = ($taxonomy) ? get_the_terms(get_the_ID(), $taxonomy) : [];
              ?>
              <li>
                <a href="<?php the_permalink(); ?>">
                  <div class="front-news--info">
                    <time datetime="<?php echo get_the_date('c'); ?>">
                      <?php echo get_the_date('Y.m.d'); ?>
                    </time>

                    <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
                      <?php foreach ($terms as $term) : ?>
                        <span class="front-news--cat_label -<?php echo esc_attr($term->slug); ?>">
                          <?php echo esc_html($term->name); ?>
                        </span>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </div>
                  <p><?php the_title(); ?></p>
                </a>
              </li>
            <?php endwhile; ?>
          </ul>
        </section>
      <?php else : ?>
        <p>記事が見つかりませんでした。</p>
      <?php endif; ?>

      <div class="pagination">
        <?php wp_pagination(); ?>
      </div>
    </main>

  </div>
</div>

<?php get_footer(); ?>