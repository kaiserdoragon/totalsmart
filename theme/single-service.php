<?php
/*------------------------------------*\
サービス詳細ページ
\*------------------------------------*/

$post_type = 'service';

$type_settings = [
  'service' => [
    'title' => 'サービス',
    'img'   => 'eyecatch_service.jpg',
    'slug'  => 'service',
  ],
];

$title    = $type_settings[$post_type]['title'] ?? 'お知らせ';
$img_file = $type_settings[$post_type]['img'] ?? 'eyecatch_default.jpg';
$slug     = $type_settings[$post_type]['slug'] ?? 'news';

$post_id            = get_queried_object_id();
$site_name          = get_bloginfo('name');
$service_title      = $post_id ? get_the_title($post_id) : '';
$service_url        = $post_id ? get_permalink($post_id) : home_url('/');
$service_archive_url = get_post_type_archive_link('service') ?: home_url('/service/');
$hero_image_url     = get_template_directory_uri() . '/img/page/' . $img_file;
$service_image_url  = $post_id && has_post_thumbnail($post_id)
  ? get_the_post_thumbnail_url($post_id, 'full')
  : '';

$raw_excerpt = $post_id ? get_the_excerpt($post_id) : '';
$raw_content = $post_id ? get_post_field('post_content', $post_id) : '';

$description_source = $raw_excerpt;
if ('' === trim((string) $description_source)) {
  $description_source = wp_strip_all_tags(strip_shortcodes((string) $raw_content));
}

$description_source = html_entity_decode((string) $description_source, ENT_QUOTES, get_bloginfo('charset'));
$description_source = wp_strip_all_tags($description_source);
$description_source = preg_replace('/\s+/u', ' ', $description_source);
$description_source = trim((string) $description_source);

if (function_exists('mb_strimwidth')) {
  $service_description = mb_strimwidth($description_source, 0, 160, '...', 'UTF-8');
} else {
  $service_description = wp_trim_words($description_source, 120, '...');
}

if ('' === $service_description) {
  $service_description = $service_title . 'の詳細ページです。';
}

$has_seo_plugin = (
  defined('WPSEO_VERSION') ||
  defined('RANK_MATH_VERSION') ||
  defined('AIOSEO_VERSION') ||
  defined('SEOPRESS_VERSION')
);

/**
 * この詳細ページ専用の title を付与
 * SEOプラグインがある場合はそちらを優先
 * サービス詳細ページのタイトルタグの制御
 */
if (!$has_seo_plugin) {
  add_filter('pre_get_document_title', function ($document_title) use ($service_title, $title, $site_name) {
    if (is_singular('service')) {
      // return $service_title . ' | ' . $title . ' | ' . $site_name;
      return $service_title . ' | ' . $site_name;
    }
    return $document_title;
  }, 20);

  /**
   * この詳細ページ専用の canonical を付与
   * SEOプラグインがある場合はそちらを優先
   */
  add_action('wp_head', function () use ($service_url) {
    if (!is_singular('service')) {
      return;
    }
    echo '<link rel="canonical" href="' . esc_url($service_url) . '">' . "\n";
  }, 20);
}

get_header();
?>

<div class="eyecatch -archive">
  <div><?php echo esc_html($title); ?></div>
  <img
    src="<?php echo esc_url($hero_image_url); ?>"
    alt="<?php echo esc_attr($title); ?>"
    width="1920"
    height="600"
    fetchpriority="high"
    decoding="async">
</div>

<div class="breadcrumbs--wrap">
  <?php get_template_part('include/common', 'breadcrumb'); ?>
</div>

<main>
  <div class="single_service">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <?php
        $schema_graph = [];

        $schema_graph[] = [
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
              'name'     => $title,
              'item'     => $service_archive_url,
            ],
            [
              '@type'    => 'ListItem',
              'position' => 3,
              'name'     => get_the_title(),
              'item'     => get_permalink(),
            ],
          ],
        ];

        $schema_graph[] = [
          '@type'       => 'WebPage',
          '@id'         => get_permalink() . '#webpage',
          'url'         => get_permalink(),
          'name'        => get_the_title(),
          'description' => $service_description,
          'isPartOf'    => [
            '@type' => 'WebSite',
            '@id'   => home_url('/') . '#website',
            'url'   => home_url('/'),
            'name'  => $site_name,
          ],
          'breadcrumb'  => [
            '@type' => 'BreadcrumbList',
            '@id'   => get_permalink() . '#breadcrumb',
          ],
          'mainEntity'  => [
            '@id' => get_permalink() . '#service',
          ],
        ];

        $service_schema = [
          '@type'       => 'Service',
          '@id'         => get_permalink() . '#service',
          'name'        => get_the_title(),
          'serviceType' => get_the_title(),
          'description' => $service_description,
          'url'         => get_permalink(),
          'provider'    => [
            '@type' => 'Organization',
            '@id'   => home_url('/') . '#organization',
            'name'  => 'トータルスマート株式会社',
            'url'   => home_url('/'),
          ],
          'areaServed'  => [
            ['@type' => 'AdministrativeArea', 'name' => '愛知県'],
            ['@type' => 'AdministrativeArea', 'name' => '岐阜県'],
            ['@type' => 'AdministrativeArea', 'name' => '三重県'],
            ['@type' => 'AdministrativeArea', 'name' => '静岡県'],
          ],
        ];

        if ($service_image_url) {
          $service_schema['image'] = $service_image_url;
        }

        $schema_graph[] = $service_schema;

        $schema_data = [
          '@context' => 'https://schema.org',
          '@graph'   => $schema_graph,
        ];
        ?>
        <script type="application/ld+json">
          <?php echo wp_json_encode($schema_data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
        </script>

        <article>
          <h1 class="page_detail_ttl"><?php echo esc_html(get_the_title()); ?></h1>
          <?php the_content(); ?>
        </article>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</main>

<?php get_footer(); ?>