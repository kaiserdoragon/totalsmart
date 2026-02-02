<?php get_header(); ?>

<?php
$post_type = get_post_type();

// 設定を配列にまとめる
$type_settings = [
  'information'  => ['title' => 'お役立ち情報', 'img' => 'eyecatch_information.jpg', 'slug' => 'information'],
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
  <main class="<?php echo $slug . '_page'; ?>">
    <div class="container -md">
      <section>
        <h2 class="ttl">
          <?php echo esc_html($title); ?>
          <span><?php echo esc_html(strtoupper($slug)); ?></span>
        </h2>
        <?php if (have_posts()) : ?>
          <ul class="<?php echo $slug . '_page--inner'; ?>">
            <?php while (have_posts()) : the_post(); ?>
              <?php
              $current_post_type = get_post_type();
              $taxonomy = ($current_post_type === 'post') ? 'category' : (get_object_taxonomies($current_post_type)[0] ?? '');
              $terms = ($taxonomy) ? get_the_terms(get_the_ID(), $taxonomy) : [];
              ?>
              <li>
                <a href="<?php the_permalink(); ?>">
                  <div class="information--image">
                    <?php if (has_post_thumbnail()) : ?>
                      <?php the_post_thumbnail('info-thumb', $thumb_attr); ?>
                    <?php else : ?>
                      <img
                        src="<?php echo esc_url(get_theme_file_uri('/img/top/information.jpg')); ?>"
                        alt=""
                        width="345"
                        height="220"
                        loading="lazy"
                        decoding="async">
                    <?php endif; ?>
                  </div>

                  <?php
                  // --- 準備：親子カテゴリーをここで仕分けておく ---
                  $parent_terms = [];
                  $child_terms  = [];
                  if (!empty($terms) && !is_wp_error($terms)) {
                    foreach ($terms as $term) {
                      if ($term->parent === 0) {
                        $parent_terms[] = $term;
                      } else {
                        $child_terms[] = $term;
                      }
                    }
                  }
                  ?>

                  <div class="information--meta">
                    <?php
                    $terms = get_the_terms(get_the_ID(), 'information_cat');
                    if ($terms && !is_wp_error($terms)) :
                      $top_term = $terms[0];
                      while ($top_term->parent != 0) {
                        $top_term = get_term($top_term->parent, 'information_cat');
                      }
                    ?>
                      <span class="information--cat">
                        <?php echo esc_html($top_term->name); ?>
                      </span>
                    <?php endif; ?>

                    <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('Y.m.d'); ?></time>

                  </div>

                  <p><?php the_title(); ?></p>
                </a>
              </li>
            <?php endwhile; ?>
          </ul>
        <?php else : ?>
          <p>記事が見つかりませんでした。</p>
        <?php endif; ?>
      </section>
      <div class="pagination">
        <?php wp_pagination(); ?>
      </div>
    </div>
  </main>
</div>

<?php get_footer(); ?>