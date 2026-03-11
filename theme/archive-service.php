<?php
/*------------------------------------*\
サービス一覧ページ
\*------------------------------------*/

$ts_archive_title       = 'サービス';
$ts_archive_slug        = 'service';
$ts_archive_img_file    = 'eyecatch_service.jpg';
$ts_archive_base_url    = get_post_type_archive_link('service') ?: home_url('/service/');
$ts_current_paged       = max(1, get_query_var('paged'), get_query_var('page'));
$ts_archive_url         = ($ts_current_paged > 1) ? get_pagenum_link($ts_current_paged) : $ts_archive_base_url;
$ts_archive_description = 'サービス一覧ページです。オフィスや店舗向けに、防犯、通信、省エネ、OA機器などの各種サービスをワンストップでご紹介しています。';
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
if (!$ts_has_seo_plugin) {
  add_filter('pre_get_document_title', function ($title) use ($ts_archive_title, $ts_site_name, $ts_current_paged) {
    if (!is_post_type_archive('service')) {
      return $title;
    }

    $doc_title = $ts_archive_title;
    if ($ts_current_paged > 1) {
      $doc_title .= ' ' . $ts_current_paged . 'ページ目';
    }

    return $doc_title . ' | ' . $ts_site_name;
  }, 20);

  /**
   * このアーカイブ専用の canonical を付与
   * SEOプラグインがある場合はそちらを優先
   */
  add_action('wp_head', function () use ($ts_archive_url) {
    if (!is_post_type_archive('service')) {
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

  <section class="archive_page">
    <div class="container">

      <h1 class="ttl">
        <?php echo esc_html($ts_archive_title); ?>
        <span><?php echo esc_html(strtoupper($ts_archive_slug)); ?></span>
      </h1>
      <p>
        当社は企業のあらゆるシーンに対応する最新テクノロジーと革新的なサービスを、<br class="is-hidden_sp">
        レンタル・リース・購入の柔軟なプランでご提供し、初期投資の負担を抑えつつすぐに導入、<br class="is-hidden_sp">
        各種ソリューションが連携して効率・安心・快適を高め、売上と店舗全体のパフォーマンスを向上させ、<br class="is-hidden_sp">
        もっとスマートに、もっと魅力的に進化させることで、未来のビジネスを力強くサポートします。
      </p>

      <?php
      $ts_item_list_elements = [];
      $ts_position = 0;
      ?>

      <?php if (have_posts()) : ?>
        <ul>
          <?php while (have_posts()) : the_post(); ?>
            <?php
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
                <figure>
                  <?php if (has_post_thumbnail()) : ?>
                    <?php
                    the_post_thumbnail('service-thumb', [
                      'alt'      => the_title_attribute(['echo' => false]),
                      'loading'  => 'lazy',
                      'decoding' => 'async',
                      'width'    => '212',
                      'height'   => '212',
                    ]);
                    ?>
                  <?php else : ?>
                    <img
                      src="<?php echo esc_url(get_theme_file_uri('/img/top/service.jpg')); ?>"
                      alt=""
                      width="212"
                      height="212"
                      loading="lazy"
                      decoding="async">
                  <?php endif; ?>

                  <figcaption>
                    <h3><?php echo esc_html(get_the_title()); ?></h3>
                  </figcaption>
                </figure>
              </a>
            </li>
          <?php endwhile; ?>
        </ul>
      <?php else : ?>
        <p>記事が見つかりませんでした。</p>
      <?php endif; ?>

      <div class="pagination">
        <?php wp_pagination(); ?>
      </div>
    </div>
  </section>

  <?php
  $ts_schema = [
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
            'item'     => $ts_archive_base_url,
          ],
        ],
      ],
      [
        '@type'       => 'CollectionPage',
        '@id'         => $ts_archive_url . '#webpage',
        'url'         => $ts_archive_url,
        'name'        => ($ts_current_paged > 1) ? $ts_archive_title . ' ' . $ts_current_paged . 'ページ目' : $ts_archive_title,
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
    <?php echo wp_json_encode($ts_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
  </script>

  <!-- <section class="mitumori">
    <div class="container">
      <h2 class="page_ttl">見積りシュミレーション（仮）</h2>
      <p>
        希望条件を入力するだけで、複合機・コピー機の月額リース料金を24時間オンラインで自動見積。<br>
        オフィス機器・回線まで含めたトータルのコスト最適化もワンストップでご提案します。
      </p>

      <a class="mitumori--btn" href="<?php echo esc_url(home_url('/')); ?>">
        <span>お見積りはこちら</span>
        無料で見積りをする
      </a>
    </div>
  </section> -->

</main>

<?php get_footer(); ?>