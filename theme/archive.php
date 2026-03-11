<?php
// ---------------------------------------------
//  お知らせ一覧ページ
// ---------------------------------------------

$ts_news_settings = [
  'post' => [
    'title' => 'お知らせ',
    'img'   => 'eyecatch_default.jpg',
    'slug'  => 'news',
  ],
];

$post_type = get_post_type();
if (empty($post_type)) {
  $post_type = 'post';
}

$title    = $ts_news_settings[$post_type]['title'] ?? 'お知らせ';
$img_file = $ts_news_settings[$post_type]['img'] ?? 'eyecatch_default.jpg';
$slug     = $ts_news_settings[$post_type]['slug'] ?? 'news';

$ts_site_name       = get_bloginfo('name');
$ts_current_paged   = max(1, get_query_var('paged'), get_query_var('page'));
$ts_is_category     = is_category();
$ts_current_term    = $ts_is_category ? get_queried_object() : null;
$ts_news_base_url   = home_url('/news/');
$ts_current_url     = ($ts_current_paged > 1) ? get_pagenum_link($ts_current_paged) : (($ts_is_category && $ts_current_term instanceof WP_Term) ? get_category_link($ts_current_term->term_id) : $ts_news_base_url);
$ts_doc_title       = $title;
$ts_schema_title    = $title . '一覧';

if ($ts_is_category && $ts_current_term instanceof WP_Term) {
  $ts_doc_title    = $ts_current_term->name . 'のお知らせ';
  $ts_schema_title = $ts_current_term->name . 'のお知らせ一覧';
}

if ($ts_current_paged > 1) {
  $ts_doc_title .= ' ' . $ts_current_paged . 'ページ目';
}

$ts_has_seo_plugin = (
  defined('WPSEO_VERSION') ||
  defined('RANK_MATH_VERSION') ||
  defined('AIOSEO_VERSION') ||
  defined('SEOPRESS_VERSION')
);

if (!$ts_has_seo_plugin) {
  add_filter('pre_get_document_title', function ($document_title) use ($ts_doc_title, $ts_site_name) {
    if (is_home() || is_post_type_archive('post') || is_category()) {
      return $ts_doc_title . ' | ' . $ts_site_name;
    }
    return $document_title;
  }, 20);

  add_action('wp_head', function () use ($ts_current_url) {
    if (!(is_home() || is_post_type_archive('post') || is_category())) {
      return;
    }
    echo '<link rel="canonical" href="' . esc_url($ts_current_url) . '">' . "\n";
  }, 20);
}

get_header();
?>

<div class="eyecatch -archive">
  <h1><?php echo esc_html($title); ?></h1>
  <img
    src="<?php echo esc_url(get_template_directory_uri() . '/img/page/' . $img_file); ?>"
    alt="<?php echo esc_attr($title); ?>"
    width="1920"
    height="600"
    fetchpriority="high"
    decoding="async">
</div>

<div class="breadcrumbs--wrap">
  <?php get_template_part('include/common', 'breadcrumb'); ?>
</div>

<div class="archive_page">
  <div class="container">
    <main class="<?php echo esc_attr($slug . '_page'); ?>">

      <h2 class="ttl">
        <?php echo esc_html($title); ?>
        <span><?php echo esc_html(strtoupper($slug)); ?></span>
      </h2>

      <?php if (have_posts()) : ?>

        <?php
        $categories = get_categories([
          'orderby' => 'description',
          'order'   => 'ASC',
        ]);

        $all_url    = $ts_news_base_url;
        $is_all_act = (is_home() || is_post_type_archive('post'));

        $ts_item_list_elements = [];
        $ts_position = 0;
        ?>

        <ul class="category_list">
          <li<?php echo $is_all_act ? ' class="is-active"' : ''; ?>>
            <a href="<?php echo esc_url($all_url); ?>">すべて</a>
            </li>

            <?php foreach ($categories as $cat) : ?>
              <?php
              $url = get_category_link($cat->term_id);
              $is_active = is_category($cat->term_id);
              $unique_class = 'cat-' . $cat->slug;
              $li_classes = [$unique_class];

              if ($is_active) {
                $li_classes[] = 'is-active';
              }

              $class_attr = ' class="' . esc_attr(implode(' ', $li_classes)) . '"';
              ?>
              <li<?php echo $class_attr; ?>>
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
              $terms = get_the_terms(get_the_ID(), 'category');

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
                  <div class="front-news--info">
                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                      <?php echo esc_html(get_the_date('Y.m.d')); ?>
                    </time>

                    <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
                      <?php foreach ($terms as $term) : ?>
                        <span class="front-news--cat_label -<?php echo esc_attr($term->slug); ?>">
                          <?php echo esc_html($term->name); ?>
                        </span>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </div>
                  <p><?php echo esc_html(get_the_title()); ?></p>
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
          'name'     => 'お知らせ',
          'item'     => $ts_news_base_url,
        ],
      ];

      if ($ts_is_category && $ts_current_term instanceof WP_Term) {
        $ts_breadcrumb_items[] = [
          '@type'    => 'ListItem',
          'position' => 3,
          'name'     => $ts_current_term->name,
          'item'     => get_category_link($ts_current_term->term_id),
        ];
      }

      $ts_news_description = $ts_is_category && $ts_current_term instanceof WP_Term
        ? $ts_current_term->name . 'カテゴリのお知らせ一覧ページです。'
        : 'お知らせ一覧ページです。最新情報や重要なお知らせをご案内しています。';

      $ts_schema = [
        '@context' => 'https://schema.org',
        '@graph'   => [
          [
            '@type'           => 'BreadcrumbList',
            'itemListElement' => $ts_breadcrumb_items,
          ],
          [
            '@type'       => 'CollectionPage',
            '@id'         => $ts_current_url . '#webpage',
            'url'         => $ts_current_url,
            'name'        => $ts_doc_title,
            'description' => $ts_news_description,
            'isPartOf'    => [
              '@type' => 'WebSite',
              '@id'   => home_url('/') . '#website',
              'url'   => home_url('/'),
              'name'  => $ts_site_name,
            ],
            'mainEntity'  => [
              '@id' => $ts_current_url . '#itemlist',
            ],
          ],
          [
            '@type'           => 'ItemList',
            '@id'             => $ts_current_url . '#itemlist',
            'name'            => $ts_schema_title,
            'numberOfItems'   => isset($ts_item_list_elements) ? count($ts_item_list_elements) : 0,
            'itemListElement' => isset($ts_item_list_elements) ? $ts_item_list_elements : [],
          ],
        ],
      ];
      ?>
      <script type="application/ld+json">
        <?php echo wp_json_encode($ts_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
      </script>

    </main>
  </div>
</div>

<?php get_footer(); ?>