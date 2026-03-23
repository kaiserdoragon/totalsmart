<?php
/*
Template Name: 防犯カメラ
Template Post Type:service
*/
?>

<?php
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
 */
if (!$has_seo_plugin) {
  add_filter('pre_get_document_title', function ($document_title) use ($service_title, $title, $site_name) {
    if (is_singular('service')) {
      return $service_title . ' | ' . $title . ' | ' . $site_name;
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

get_header('service');
?>


<main class="single_<?php echo esc_attr(get_post_field('post_name', get_post())); ?> single_detail_page">
  <section class="camera_mv">
    <div class="camera_mv--contents container -lg">
      <div>
        <span class="camera_mv--area">愛知・岐阜・三重・静岡対応</span>
        <p class="camera_mv--lead">不審者対策も、内部トラブル対策もこれで解決！</p>
        <h2 class="camera_mv--ttl">
          <span class="camera_mv--txt"><span class="camera_mv--strong">防犯カメラ</span>の設置・工事は</span>
          <span class="camera_mv--txt">お任せください！！</span>
        </h2>
        <p class="camera_mv--supplement">オフィス・店舗・施設の環境に合わせた、<br>防犯カメラをご提案します</p>
        <ul>
          <li>出張費・見積り<br><span>無料</span></li>
          <li>アフターサポートまで<br>すべて<span>自社対応</span></li>
          <li><span>電源・回線のない現場</span><br>にも対応可能</li>
          <li><span>既存の配線を活かした</span><br>リプレイスにも対応</li>
        </ul>
      </div>
      <div class="camera_mv--image">
        <img src="<?php echo get_template_directory_uri(); ?>/img/service/mv_catch.png" alt="" width="515" height="645" loading="lazy" decoding="async">
      </div>
    </div>
    <img class="camera_mv--bg" src="<?php echo get_template_directory_uri(); ?>/img/service/mv_bg.jpg" alt="" width="1920" height="750" loading="lazy" decoding="async">
  </section>

  <section class="camera_lead">
    <div class="container -md">
      <h2>
        防犯・監視カメラ導入で<br>
        このような<span>お悩み</span>はありませんか？
      </h2>
      <ul>
        <li>古いカメラのままで画質が悪く、<span>いざという時に顔や車のナンバーが判別できない</span></li>
        <li>システム一式の入れ替えを検討しているが、<span>配線工事費が高額で予算が合わない</span></li>
        <li>動物や木の揺れによる誤報が多く、<span>本当に必要な通知が埋もれてしまう</span></li>
        <li>建設現場や資材置き場、農地など<span>電源もインターネット回線もない場所を監視したい</span></li>
        <li>トラブル発生時に<span>すぐ駆けつけてくれる地元の業者がわからない</span></li>
      </ul>
      <p>
        防犯カメラは「ただ設置すればよい」というものではありません。<br>
        現場の環境（明るさ、広さ、配線状況、電源の有無）や目的に合っていない機器を選んでしまうと、<br>
        本来の役割を果たせないだけでなく、無駄なコストがかかってしまいます。
      </p>
    </div>
  </section>



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