<?php get_header(); ?>

<?php
$post_type = get_post_type();

// 設定を配列にまとめる
$type_settings = [
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
  <div class="container">
    <main class="<?php echo $slug . '_page'; ?>">
      <h2 class="ttl">
        <?php echo esc_html($title); ?>
        <span><?php echo esc_html(strtoupper($slug)); ?></span>
      </h2>
      <p class="<?php echo $slug . '_page--txt'; ?>">
        私たちの最新設備を導入いただいた様々な企業の体験談が掲載されています。<br>
        実際にご利用いただいた企業の成功事例や具体的な活用方法、<br class="is-hidden_sp">
        改善された業務効率やお客様満足度の向上など、リアルな声をぜひご覧ください。<br>
        あなたのお店の未来を変えるヒントがここにあります！
      </p>
      <?php if (have_posts()) : ?>
        <section class="<?php echo $slug . '_page--inner'; ?>">
          <ul>
            <?php while (have_posts()) : the_post(); ?>
              <?php
              $current_post_type = get_post_type();
              $taxonomy = ($current_post_type === 'post') ? 'category' : (get_object_taxonomies($current_post_type)[0] ?? '');
              $terms = ($taxonomy) ? get_the_terms(get_the_ID(), $taxonomy) : [];
              ?>
              <li>
                <a href="<?php the_permalink(); ?>">
                  <div class="works--thumbnail">
                    <?php if (has_post_thumbnail()) : ?>
                      <?php the_post_thumbnail('works-thumb', $thumb_attr); ?>
                    <?php else : ?>
                      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/top/works.jpg"
                        alt="<?php the_title_attribute(); ?>"
                        width="352" height="308"
                        <?php echo ($post_count <= 3) ? 'loading="eager"' : 'loading="lazy"'; ?>>
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

                  <div class="front-news--info">
                    <time datetime="<?php echo get_the_date('c'); ?>">
                      <?php echo get_the_date('Y.m.d'); ?>
                    </time>

                    <?php /* --- 親カテゴリーのみここに出力 --- */ ?>
                    <?php if (!empty($parent_terms)) : ?>
                      <?php foreach ($parent_terms as $parent) : ?>
                        <span class="introduction_page--parent_labels <?php echo esc_attr($parent->slug); ?>">
                          <?php echo esc_html($parent->name); ?>
                        </span>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </div>

                  <p><?php the_title(); ?></p>

                  <?php /* --- ここに子カテゴリーを出力 --- */ ?>
                  <?php if (!empty($child_terms)) : ?>
                    <div class="introduction_page--child_labels">
                      <?php foreach ($child_terms as $child) : ?>
                        <span class="child_labels <?php echo esc_attr($child->slug); ?>">
                          <?php echo esc_html($child->name); ?>
                        </span>
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>

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