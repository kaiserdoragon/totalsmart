<?php
/*------------------------------------*\
お役立ち情報一覧ページ
\*------------------------------------*/
?>

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
  <div><?php echo esc_html($title); ?></div>
  <img src="<?php echo esc_url(get_template_directory_uri() . '/img/page/' . $img_file); ?>" alt="<?php echo esc_attr($title); ?>" width="1920" height="600" fetchpriority="high">
</div>


<main class="<?php echo esc_attr($slug) . '_page'; ?>">

  <div class="breadcrumbs--wrap">
    <?php get_template_part('include/common', 'breadcrumb'); ?>
  </div>

  <div class="archive_page">
    <div class="container -md">
      <section>
        <h1 class="ttl">
          <?php echo esc_html($title); ?>
          <span><?php echo esc_html(strtoupper($slug)); ?></span>
        </h1>
        <?php if (have_posts()) : ?>
          <ul class="<?php echo esc_attr($slug) . '_page--inner'; ?>">
            <?php while (have_posts()) : the_post(); ?>
              <li>
                <a href="<?php the_permalink(); ?>">
                  <div class="information--image">
                    <?php if (has_post_thumbnail()) : ?>
                      <?php the_post_thumbnail('info-thumb', ['loading' => 'lazy', 'decoding' => 'async']); ?>
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

                  <div class="information--meta">
                    <?php
                    // 親カテゴリーを取得して表示する処理
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

                    <time datetime="<?php echo get_the_date('c'); ?>"><?php echo esc_html(get_the_date('Y.m.d')); ?></time>

                  </div>

                  <h2><?php the_title(); ?></h2>
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

  </div>
</main>


<?php get_footer(); ?>