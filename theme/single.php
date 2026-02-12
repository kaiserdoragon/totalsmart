<?php get_header(); ?>

<?php
$post_type = get_post_type();

// 設定を配列にまとめる
$type_settings = [
  'question'     => ['title' => 'よくあるご質問', 'img' => 'eyecatch_question.jpg', 'slug' => 'question'],
  'service'      => ['title' => 'サービス紹介',   'img' => 'eyecatch_service.jpg',  'slug' => 'service'],
  'information'  => ['title' => 'お役立ち情報',   'img' => 'eyecatch_information.jpg', 'slug' => 'information'],
  'introduction' => ['title' => '導入事例',       'img' => 'eyecatch_introduction.jpg', 'slug' => 'introduction'],
];

$archive_title = $type_settings[$post_type]['title'] ?? 'お知らせ';
$img_file      = $type_settings[$post_type]['img'] ?? 'eyecatch_default.jpg';
$slug          = $type_settings[$post_type]['slug'] ?? 'news';

// ★追加判定：導入実績（introduction）かどうか
$is_introduction = ($post_type === 'introduction');
?>

<div class="eyecatch -archive">
  <div><?php echo esc_html($archive_title); ?></div>
  <img src="<?php echo get_template_directory_uri(); ?>/img/page/<?php echo esc_attr($img_file); ?>" alt="<?php echo esc_attr($archive_title); ?>" width="1920" height="600" loading="lazy" decoding="async">
</div>

<main class="<?php echo esc_attr($slug . '_page'); ?>">

  <div class="breadcrumbs--wrap">
    <?php get_template_part('include/common', 'breadcrumb'); ?>
  </div>

  <div class="container">
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>

        <script type="application/ld+json">
          {
            "@context": "https://schema.org",
            "@type": "Article",
            "headline": "<?php echo esc_js(get_the_title()); ?>",
            "image": [
              "<?php echo has_post_thumbnail() ? esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')) : ''; ?>"
            ],
            "datePublished": "<?php echo get_the_date('c'); ?>",
            "dateModified": "<?php echo get_the_modified_date('c'); ?>",
            "author": [
              <?php if ($is_introduction): ?>
                /* 導入実績の場合：著者は「会社」 */
                {
                  "@type": "Organization",
                  "name": "トータルスマート株式会社",
                  "url": "<?php echo esc_url(home_url('/')); ?>"
                }
              <?php else: ?>
                /* お役立ち情報の場合：著者は「担当者（個人）」 */
                {
                  "@type": "Person",
                  "name": "<?php echo esc_js(get_the_author_meta('display_name')); ?>",
                  "url": "<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"
                }
              <?php endif; ?>
            ]
          }
        </script>

        <article class="detail_page">
          <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
          <h1 class="detail_page--ttl"><?php the_title(); ?></h1>
          <ul class="detail_page--cat">
            <?php if (function_exists('categories_label')) categories_label(); ?>
          </ul>
          <div class="detail_page--thumb">
            <?php if (has_post_thumbnail()) : ?>
              <?php the_post_thumbnail('info-thumb'); ?>
            <?php endif; ?>
          </div>
          <div>
            <?php the_content(); ?>
          </div>
        </article>

        <ul class="paging">
          <li class="paging--item paging--item-next">
            <?php if (get_next_post()): ?>
              <?php next_post_link('%link', '次の記事へ', false); ?>
            <?php endif; ?>
          </li>
          <li class="paging--item paging--item-gotolist">
            <a href="<?php echo esc_url(home_url('/' . $slug . '/')); ?>">一覧へ戻る</a>
          </li>
          <li class="paging--item paging--item-prev">
            <?php if (get_previous_post()): ?>
              <?php previous_post_link('%link', '前の記事へ', false); ?>
            <?php endif; ?>
          </li>
        </ul>

      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</main>

<?php get_footer(); ?>