<?php
/*------------------------------------*\
お知らせ一覧ページ
\*------------------------------------*/
?>

<?php get_header(); ?>

<?php
$post_type = get_post_type();

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

<div class="archive_page">
  <div class="container">
    <main class="<?php echo $slug . '_page'; ?>">

      <h2 class="ttl">
        <?php echo esc_html($title); ?>
        <span><?php echo esc_html(strtoupper($slug)); ?></span>
      </h2>

      <?php if (have_posts()) : ?>

        <?php
        // 1. データの取得と設定をまとめる
        $args = [
          'orderby' => 'description',
          'order'   => 'ASC',
        ];
        $categories = get_categories($args);

        $all_url    = home_url('/news/');
        $is_all_act = (is_home() || is_post_type_archive('post'));
        ?>

        <ul class="category_list">
          <li<?php echo $is_all_act ? ' class="is-active"' : ''; ?>>
            <a href="<?php echo esc_url($all_url); ?>">すべて</a>
            </li>

            <?php // --- カテゴリー一覧 --- 
            ?>
            <?php foreach ($categories as $cat) :
              $url      = get_category_link($cat->term_id);
              $is_active = is_category($cat->term_id);
            ?>
              <li<?php echo $is_active ? ' class="is-active"' : ''; ?>>
                <a href="<?php echo esc_url($url); ?>">
                  <?php echo esc_html($cat->name); ?>
                </a>
                </li>
              <?php endforeach; ?>
        </ul>



        <section class="archive--inner front-news">
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