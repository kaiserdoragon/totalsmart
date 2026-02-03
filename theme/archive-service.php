<?php
/*------------------------------------*\
サービス一覧ページ
\*------------------------------------*/
?>

<?php get_header(); ?>

<?php
$post_type = get_post_type();

// 設定を配列にまとめる
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
  <div class="archive container">
    <main class="<?php echo $slug . '_page'; ?>">
      <h2 class="ttl">
        <?php echo esc_html($title); ?>
        <span><?php echo esc_html(strtoupper($slug)); ?></span>
      </h2>
      <p>
        当社は企業のあらゆるシーンに対応する最新テクノロジーと革新的なサービスを、<br class="is-hidden_sp">
        レンタル・リース・購入の柔軟なプランでご提供し、初期投資の負担を抑えつつすぐに導入、<br class="is-hidden_sp">
        各種ソリューションが連携して効率・安心・快適を高め、売上と店舗全体のパフォーマンスを向上させ、<br class="is-hidden_sp">
        もっとスマートに、もっと魅力的に進化させることで、未来のビジネスを力強くサポートします。
      </p>

      <?php if (have_posts()) : ?>
        <section>
          <?php if (have_posts()) : ?>
            <ul>
              <?php while (have_posts()) : the_post(); ?>
                <li>
                  <a href="<?php the_permalink(); ?>">
                    <figure>
                      <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('service-thumb', [
                          'alt'      => the_title_attribute(['echo' => false]),
                          'loading'  => 'lazy',
                          'decoding' => 'async',
                          'width'    => '212',
                          'height'   => '212',
                        ]); ?>
                      <?php else : ?>
                        <img src="<?php echo esc_url(get_theme_file_uri('/img/top/service.jpg')); ?>" alt="" width="212" height="212" loading="lazy">
                      <?php endif; ?>

                      <figcaption>
                        <h3><?php the_title(); ?></h3>
                      </figcaption>
                    </figure>
                  </a>
                </li>
              <?php endwhile; ?>
            </ul>
          <?php else : ?>
            <p>記事が見つかりませんでした。</p>
          <?php endif; ?>
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