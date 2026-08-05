<?php
/*------------------------------------*\
お役立ち情報一覧ページ
\*------------------------------------*/

$ts_archive_title       = 'お役立ち情報';
$ts_archive_slug        = 'information';
$ts_taxonomy_slug       = 'infomation_item';
$ts_archive_img_file    = 'eyecatch_information.jpg';
$ts_archive_base_url    = get_post_type_archive_link('information') ?: home_url('/information/');
$ts_current_paged       = max(1, get_query_var('paged'), get_query_var('page'));
$ts_is_tax              = is_tax($ts_taxonomy_slug);
$ts_current_term        = $ts_is_tax ? get_queried_object() : null;
$ts_archive_url         = ($ts_current_paged > 1)
  ? get_pagenum_link($ts_current_paged)
  : (($ts_is_tax && $ts_current_term instanceof WP_Term) ? get_term_link($ts_current_term) : $ts_archive_base_url);
$ts_doc_title           = ($ts_is_tax && $ts_current_term instanceof WP_Term)
  ? $ts_current_term->name . 'のお役立ち情報'
  : $ts_archive_title;
$ts_archive_description = ($ts_is_tax && $ts_current_term instanceof WP_Term)
  ? $ts_current_term->name . 'に関するお役立ち情報一覧ページです。'
  : 'お役立ち情報一覧ページです。業務改善、コスト削減、設備導入、防犯、通信、省エネなどに役立つ情報をまとめてご紹介しています。';
$ts_site_name           = get_bloginfo('name');

if ($ts_current_paged > 1) {
  $ts_doc_title .= ' ' . $ts_current_paged . 'ページ目';
}

$GLOBALS['ts_meta_description_override'] = $ts_archive_description;

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
if (!$ts_has_seo_plugin) {
  add_filter('pre_get_document_title', function ($title) use ($ts_doc_title, $ts_site_name, $ts_taxonomy_slug) {
    if (!(is_post_type_archive('information') || is_tax($ts_taxonomy_slug))) {
      return $title;
    }

    return $ts_doc_title . ' | ' . $ts_site_name;
  }, 20);

  /**
   * このアーカイブ専用の canonical を付与
   * SEOプラグインがある場合はそちらを優先
   */
  add_action('wp_head', function () use ($ts_archive_url, $ts_taxonomy_slug) {
    if (!(is_post_type_archive('information') || is_tax($ts_taxonomy_slug))) {
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

        <?php
        $ts_information_terms = get_terms([
          'taxonomy'   => $ts_taxonomy_slug,
          'hide_empty' => false,
        ]);
        ?>

        <?php if (!empty($ts_information_terms) && !is_wp_error($ts_information_terms)) : ?>
          <ul class="category_list">
            <li<?php echo !$ts_is_tax ? ' class="is-active"' : ''; ?>>
              <a href="<?php echo esc_url($ts_archive_base_url); ?>">すべて</a>
            </li>

            <?php foreach ($ts_information_terms as $ts_information_term) : ?>
              <?php $ts_information_term_url = get_term_link($ts_information_term); ?>
              <?php if (!is_wp_error($ts_information_term_url)) : ?>
                <li<?php echo is_tax($ts_taxonomy_slug, $ts_information_term->term_id) ? ' class="is-active"' : ''; ?>>
                  <a href="<?php echo esc_url($ts_information_term_url); ?>">
                    <?php echo esc_html($ts_information_term->name); ?>
                  </a>
                </li>
              <?php endif; ?>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

        <?php
        $ts_item_list_elements = [];
        $ts_position = 0;
        ?>

        <?php if (have_posts()) : ?>
          <ul class="<?php echo esc_attr($ts_archive_slug . '_page--inner'); ?>">
            <?php while (have_posts()) : the_post(); ?>
              <?php
              $terms = get_the_terms(get_the_ID(), $ts_taxonomy_slug);
              $top_term_name = '';

              if ($terms && !is_wp_error($terms)) {
                $top_term = $terms[0];
                while (!empty($top_term->parent)) {
                  $top_term = get_term($top_term->parent, $ts_taxonomy_slug);
                }
                if ($top_term && !is_wp_error($top_term)) {
                  $top_term_name = $top_term->name;
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
                      <?php
                      the_post_thumbnail('info-thumb', [
                        'alt'      => the_title_attribute(['echo' => false]),
                        'loading'  => 'lazy',
                        'decoding' => 'async',
                      ]);
                      ?>
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
                    <?php if ('' !== $top_term_name) : ?>
                      <span class="information--cat">
                        <?php echo esc_html($top_term_name); ?>
                      </span>
                    <?php endif; ?>

                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                      <?php echo esc_html(get_the_date('Y.m.d')); ?>
                    </time>
                  </div>

                  <h2><?php echo esc_html(get_the_title()); ?></h2>
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
  $ts_breadcrumb_items = [
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
      'item'     => $ts_archive_base_url,
    ],
  ];

  if ($ts_is_tax && $ts_current_term instanceof WP_Term) {
    $ts_current_term_url = get_term_link($ts_current_term);

    if (!is_wp_error($ts_current_term_url)) {
      $ts_breadcrumb_items[] = [
        '@type'    => 'ListItem',
        'position' => 3,
        'name'     => $ts_current_term->name,
        'item'     => $ts_current_term_url,
      ];
    }
  }

  $ts_schema = [
    '@context' => 'https://schema.org',
    '@graph'   => [
      [
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $ts_breadcrumb_items,
      ],
      [
        '@type'       => 'CollectionPage',
        '@id'         => $ts_archive_url . '#webpage',
        'url'         => $ts_archive_url,
        'name'        => $ts_doc_title,
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
        'name'            => $ts_doc_title . '一覧',
        'numberOfItems'   => count($ts_item_list_elements),
        'itemListElement' => $ts_item_list_elements,
      ],
    ],
  ];
  ?>
  <script type="application/ld+json">
    <?php echo wp_json_encode($ts_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
  </script>
</main>

<?php get_footer(); ?>
