<?php
/*------------------------------------*\
よくある質問一覧ページ
\*------------------------------------*/

$taxonomy_slug = 'question_cat';

// taxonomyページで get_post_type() が期待通り取れないケースがあるので補正
$post_type = is_tax($taxonomy_slug) ? 'question' : get_post_type();
if (empty($post_type)) {
  $post_type = 'question';
}

// 設定
$type_settings = [
  'question' => [
    'title' => 'よくある質問',
    'img'   => 'eyecatch_question.jpg',
    'slug'  => 'question',
  ],
];

$title    = $type_settings[$post_type]['title'] ?? 'お知らせ';
$img_file = $type_settings[$post_type]['img'] ?? 'eyecatch_default.jpg';
$slug     = $type_settings[$post_type]['slug'] ?? 'news';

$ts_site_name     = get_bloginfo('name');
$ts_current_paged = max(1, get_query_var('paged'), get_query_var('page'));
$ts_is_tax        = is_tax($taxonomy_slug);
$ts_current_term  = $ts_is_tax ? get_queried_object() : null;

$ts_archive_base_url = get_post_type_archive_link('question') ?: home_url('/question/');
$ts_current_url      = ($ts_current_paged > 1)
  ? get_pagenum_link($ts_current_paged)
  : (($ts_is_tax && $ts_current_term instanceof WP_Term) ? get_term_link($ts_current_term) : $ts_archive_base_url);

$ts_doc_title    = $title;
$ts_schema_title = $title . '一覧';

if ($ts_is_tax && $ts_current_term instanceof WP_Term) {
  $ts_doc_title    = $ts_current_term->name . 'のよくある質問';
  $ts_schema_title = $ts_current_term->name . 'のよくある質問一覧';
}

if ($ts_current_paged > 1) {
  $ts_doc_title .= ' ' . $ts_current_paged . 'ページ目';
}

$ts_archive_description = ($ts_is_tax && $ts_current_term instanceof WP_Term)
  ? $ts_current_term->name . 'カテゴリのよくある質問一覧ページです。'
  : 'よくある質問一覧ページです。サービス内容、契約、料金、導入までの流れなど、よくあるご質問をまとめています。';

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
  add_filter('pre_get_document_title', function ($document_title) use ($ts_doc_title, $ts_site_name, $taxonomy_slug) {
    if (is_post_type_archive('question') || is_tax($taxonomy_slug)) {
      return $ts_doc_title . ' | ' . $ts_site_name;
    }
    return $document_title;
  }, 20);

  /**
   * このアーカイブ専用の canonical を付与
   * SEOプラグインがある場合はそちらを優先
   */
  add_action('wp_head', function () use ($ts_current_url, $taxonomy_slug) {
    if (!(is_post_type_archive('question') || is_tax($taxonomy_slug))) {
      return;
    }
    echo '<link rel="canonical" href="' . esc_url($ts_current_url) . '">' . "\n";
  }, 20);
}

// カテゴリ一覧は「投稿が0件でも」出す
$categories = get_terms([
  'taxonomy'   => $taxonomy_slug,
  'orderby'    => 'description',
  'order'      => 'ASC',
  'hide_empty' => false,
]);

$all_url    = home_url('/question/');
$is_all_act = (is_post_type_archive('question') && !is_tax($taxonomy_slug));

// FAQ / ItemList 用
$ts_faq_list           = [];
$ts_item_list_elements = [];
$ts_position           = 0;

global $wp_query;
if (!empty($wp_query->posts)) {
  foreach ($wp_query->posts as $post_obj) {
    $question_name = wp_strip_all_tags(get_the_title($post_obj));
    $answer_text   = wp_strip_all_tags((string) $post_obj->post_content);

    if ('' !== trim($answer_text)) {
      $ts_faq_list[] = [
        '@type' => 'Question',
        'name'  => $question_name,
        'acceptedAnswer' => [
          '@type' => 'Answer',
          'text'  => $answer_text,
        ],
      ];
    }

    $ts_position++;
    $ts_item_list_elements[] = [
      '@type'    => 'ListItem',
      'position' => $ts_position,
      'item'     => [
        '@id'  => get_permalink($post_obj),
        'name' => $question_name,
      ],
    ];
  }
}

get_header();
?>

<div class="eyecatch -archive">
  <div><?php echo esc_html($title); ?></div>
  <img
    src="<?php echo esc_url(get_template_directory_uri() . '/img/page/' . $img_file); ?>"
    alt="<?php echo esc_attr($title); ?>"
    width="1920"
    height="600"
    fetchpriority="high"
    decoding="async">
</div>

<main class="<?php echo esc_attr($slug . '_page'); ?>">

  <div class="breadcrumbs--wrap">
    <?php get_template_part('include/common', 'breadcrumb'); ?>
  </div>

  <section class="archive_page">
    <div class="container">
      <h1 class="ttl">
        <?php echo esc_html($title); ?>
        <span><?php echo esc_html(strtoupper($slug)); ?></span>
      </h1>

      <ul class="category_list">
        <li<?php echo $is_all_act ? ' class="is-active"' : ''; ?>>
          <a href="<?php echo esc_url($all_url); ?>">すべて</a>
          </li>

          <?php if (!empty($categories) && !is_wp_error($categories)) : ?>
            <?php foreach ($categories as $cat) : ?>
              <?php
              $url       = get_term_link($cat);
              $is_active = is_tax($taxonomy_slug, $cat->term_id);
              ?>
              <li<?php echo $is_active ? ' class="is-active"' : ''; ?>>
                <a href="<?php echo esc_url($url); ?>"><?php echo esc_html($cat->name); ?></a>
                </li>
              <?php endforeach; ?>
            <?php endif; ?>
      </ul>

      <div class="question-search">
        <input type="search" id="js-question-search" placeholder="検索したいキーワードを入力してください" autocomplete="off">
      </div>

      <section class="archive--inner front-news">
        <ul id="js-question-results">
          <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
              <?php $terms = get_the_terms(get_the_ID(), $taxonomy_slug); ?>
              <li>
                <a href="<?php echo esc_url(get_permalink()); ?>">
                  <div class="front-news--info">
                    <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
                      <?php foreach ($terms as $term) : ?>
                        <span class="front-news--cat_label -<?php echo esc_attr($term->slug); ?>">
                          <?php echo esc_html($term->name); ?>
                        </span>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <span class="front-news--cat_label -other">その他</span>
                    <?php endif; ?>
                  </div>
                  <p><?php echo esc_html(get_the_title()); ?></p>
                </a>
              </li>
            <?php endwhile; ?>
          <?php else : ?>
            <li class="no-result">記事が見つかりませんでした。</li>
          <?php endif; ?>
        </ul>
      </section>

      <div class="pagination">
        <?php wp_pagination(); ?>
      </div>
    </div>
  </section>

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
      'name'     => 'よくある質問',
      'item'     => $ts_archive_base_url,
    ],
  ];

  if ($ts_is_tax && $ts_current_term instanceof WP_Term) {
    $ts_breadcrumb_items[] = [
      '@type'    => 'ListItem',
      'position' => 3,
      'name'     => $ts_current_term->name,
      'item'     => get_term_link($ts_current_term),
    ];
  }

  $ts_schema_graph = [
    [
      '@type'           => 'BreadcrumbList',
      'itemListElement' => $ts_breadcrumb_items,
    ],
    [
      '@type'       => 'CollectionPage',
      '@id'         => $ts_current_url . '#webpage',
      'url'         => $ts_current_url,
      'name'        => $ts_doc_title,
      'description' => $ts_archive_description,
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
      'numberOfItems'   => count($ts_item_list_elements),
      'itemListElement' => $ts_item_list_elements,
    ],
  ];

  // FAQPage は補助的に付与
  if (!empty($ts_faq_list)) {
    $ts_schema_graph[] = [
      '@type'      => 'FAQPage',
      'mainEntity' => $ts_faq_list,
    ];
  }

  $ts_schema = [
    '@context' => 'https://schema.org',
    '@graph'   => $ts_schema_graph,
  ];
  ?>
  <script type="application/ld+json">
    <?php echo wp_json_encode($ts_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
  </script>
</main>

<?php get_footer(); ?>