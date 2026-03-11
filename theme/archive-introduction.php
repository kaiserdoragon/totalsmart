<?php
/*------------------------------------*\
導入実績一覧ページ
\*------------------------------------*/

$ts_archive_title       = '導入実績';
$ts_archive_slug        = 'introduction';
$ts_archive_img_file    = 'eyecatch_introduction.jpg';
$ts_archive_url         = get_post_type_archive_link('introduction') ?: home_url('/introduction/');
$ts_archive_description = '導入実績一覧ページです。最新設備を導入いただいた企業の事例や活用方法、業務効率化や顧客満足度向上につながった実例をご紹介しています。';
$ts_site_name           = get_bloginfo('name');

$ts_has_seo_plugin = (
  defined('WPSEO_VERSION') ||
  defined('RANK_MATH_VERSION') ||
  defined('AIOSEO_VERSION') ||
  defined('SEOPRESS_VERSION')
);

/**
 * このアーカイブ専用の title を付与
 * SEOプラグインがある場合はそちらを優先
 */
if (! $ts_has_seo_plugin) {
  add_filter('pre_get_document_title', function ($title) use ($ts_archive_title, $ts_site_name) {
    if (is_post_type_archive('introduction')) {
      return $ts_archive_title . ' | ' . $ts_site_name;
    }
    return $title;
  }, 20);

  /**
   * このアーカイブ専用の canonical を付与
   * SEOプラグインがある場合はそちらを優先
   */
  add_action('wp_head', function () use ($ts_archive_url) {
    if (!is_post_type_archive('introduction')) {
      return;
    }
    echo '<link rel="canonical" href="' . esc_url($ts_archive_url) . '">' . "\n";
  }, 20);
}

get_header();
?>

<div class="eyecatch -archive">
  <div><?php echo esc_html($ts_archive_title); ?></div>
  <img
    src="<?php echo esc_url(get_template_directory_uri() . '/img/page/' . $ts_archive_img_file); ?>"
    alt="<?php echo esc_attr($ts_archive_title); ?>"
    width="1920"
    height="600"
    fetchpriority="high"
    decoding="async">
</div>

<main class="<?php echo esc_attr($ts_archive_slug . '_page'); ?>">

  <div class="breadcrumbs--wrap">
    <?php get_template_part('include/common', 'breadcrumb'); ?>
  </div>

  <div class="archive_page">
    <div class="container -md">
      <section>
        <h1 class="ttl">
          <?php echo esc_html($ts_archive_title); ?>
          <span><?php echo esc_html(strtoupper($ts_archive_slug)); ?></span>
        </h1>

        <p class="<?php echo esc_attr($ts_archive_slug . '_page--txt'); ?>">
          私たちの最新設備を導入いただいた様々な企業の体験談が掲載されています。<br>
          実際にご利用いただいた企業の成功事例や具体的な活用方法、<br class="is-hidden_sp">
          改善された業務効率やお客様満足度の向上など、リアルな声をぜひご覧ください。<br>
          あなたのお店の未来を変えるヒントがここにあります！
        </p>

        <?php
        $ts_item_list_elements = [];
        $ts_position = 0;
        ?>

        <?php if (have_posts()) : ?>
          <ul class="<?php echo esc_attr($ts_archive_slug . '_page--inner'); ?>">
            <?php while (have_posts()) : the_post(); ?>
              <?php
              $taxonomy = 'introduction_cat';
              $terms    = get_the_terms(get_the_ID(), $taxonomy);

              $thumb_attr = [
                'alt'      => the_title_attribute(['echo' => false]),
                'loading'  => 'lazy',
                'decoding' => 'async',
              ];

              $parent_terms = [];
              $child_terms  = [];

              if (!empty($terms) && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                  if ((int) $term->parent === 0) {
                    $parent_terms[] = $term;
                  } else {
                    $child_terms[] = $term;
                  }
                }
              }

              $ts_position++;
              $ts_item_list_elements[] = [
                '@type'    => 'ListItem',
                'position' => $ts_position,
                'item'     => [
                  '@id'  => get_permalink(),
                  'name' => get_the_title(),
                ],
              ];
              ?>
              <li>
                <a href="<?php echo esc_url(get_permalink()); ?>">
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

                  <div class="front-news--info">
                    <?php if (!empty($child_terms)) : ?>
                      <div class="introduction_page--child_labels">
                        <?php foreach ($child_terms as $child) : ?>
                          <span class="child_labels <?php echo esc_attr($child->slug); ?>">
                            <?php echo esc_html($child->name); ?>
                          </span>
                        <?php endforeach; ?>
                      </div>
                    <?php endif; ?>

                    <?php if (!empty($parent_terms)) : ?>
                      <?php foreach ($parent_terms as $parent) : ?>
                        <span class="introduction_page--parent_labels <?php echo esc_attr($parent->slug); ?>">
                          <?php echo esc_html($parent->name); ?>
                        </span>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </div>

                  <p><?php echo esc_html(get_the_title()); ?></p>
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

  <?php
  $ts_breadcrumb_schema = [
    '@context' => 'https://schema.org',
    '@graph'   => [
      [
        '@type'           => 'BreadcrumbList',
        'itemListElement' => [
          [
            '@type'    => 'ListItem',
            'position' => 1,
            'name'     => 'TOP',
            'item'     => home_url('/'),
          ],
          [
            '@type'    => 'ListItem',
            'position' => 2,
            'name'     => $ts_archive_title,
            'item'     => $ts_archive_url,
          ],
        ],
      ],
      [
        '@type'       => 'CollectionPage',
        '@id'         => $ts_archive_url . '#webpage',
        'url'         => $ts_archive_url,
        'name'        => $ts_archive_title,
        'description' => $ts_archive_description,
        'isPartOf'    => [
          '@type' => 'WebSite',
          '@id'   => home_url('/') . '#website',
          'url'   => home_url('/'),
          'name'  => $ts_site_name,
        ],
        'mainEntity'  => [
          '@id' => $ts_archive_url . '#itemlist',
        ],
      ],
      [
        '@type'           => 'ItemList',
        '@id'             => $ts_archive_url . '#itemlist',
        'name'            => $ts_archive_title . '一覧',
        'numberOfItems'   => count($ts_item_list_elements),
        'itemListElement' => $ts_item_list_elements,
      ],
    ],
  ];
  ?>
  <script type="application/ld+json">
    <?php echo wp_json_encode($ts_breadcrumb_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
  </script>
</main>

<?php get_footer(); ?>