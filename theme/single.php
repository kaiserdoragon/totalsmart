<?php
/*------------------------------------*\
共通詳細ページ
question / service / information / introduction
\*------------------------------------*/

$post_id   = get_queried_object_id();
$post_type = get_post_type($post_id);

$type_settings = [
  'question' => [
    'title' => 'よくあるご質問',
    'img'   => 'eyecatch_question.jpg',
    'slug'  => 'question',
  ],
  'service' => [
    'title' => 'サービス紹介',
    'img'   => 'eyecatch_service.jpg',
    'slug'  => 'service',
  ],
  'information' => [
    'title' => 'お役立ち情報',
    'img'   => 'eyecatch_information.jpg',
    'slug'  => 'information',
  ],
  'introduction' => [
    'title' => '導入事例',
    'img'   => 'eyecatch_introduction.jpg',
    'slug'  => 'introduction',
  ],
];

$current_settings = $type_settings[$post_type] ?? [];
$archive_title    = $current_settings['title'] ?? 'お知らせ';
$img_file         = $current_settings['img'] ?? 'eyecatch_default.jpg';
$slug             = $current_settings['slug'] ?? 'news';

$is_introduction = ('introduction' === $post_type);
$is_question     = ('question' === $post_type);
$is_information  = ('information' === $post_type);
$is_service      = ('service' === $post_type);

$site_name     = get_bloginfo('name');
$current_title = $post_id ? get_the_title($post_id) : '';
$current_url   = $post_id ? get_permalink($post_id) : home_url('/');
$archive_url   = home_url('/' . $slug . '/');

$hero_image_url = get_template_directory_uri() . '/img/page/' . $img_file;
$thumb_url      = ($post_id && has_post_thumbnail($post_id)) ? get_the_post_thumbnail_url($post_id, 'full') : '';

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
  $page_description = mb_strimwidth($description_source, 0, 160, '...', 'UTF-8');
} else {
  $page_description = wp_trim_words($description_source, 120, '...');
}

if ('' === $page_description) {
  $page_description = $current_title . 'の詳細ページです。';
}

if ($is_information && function_exists('ts_get_custom_seo_description')) {
  $custom_description = ts_get_custom_seo_description($post_id);
  if ($custom_description !== '') {
    $page_description = $custom_description;
  }
}

if ($is_information) {
  $GLOBALS['ts_meta_description_override'] = $page_description;
}

$seo_title = $current_title . ' | ' . $archive_title . ' | ' . $site_name;

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
  add_filter('pre_get_document_title', function ($document_title) use ($seo_title, $post_type) {
    if (is_singular($post_type)) {
      return $seo_title;
    }
    return $document_title;
  }, 20);

  /**
   * この詳細ページ専用の canonical を付与
   * SEOプラグインがある場合はそちらを優先
   */
  add_action('wp_head', function () use ($current_url, $post_type) {
    if (!is_singular($post_type)) {
      return;
    }
    echo '<link rel="canonical" href="' . esc_url($current_url) . '">' . "\n";
  }, 20);
}

get_header();
?>

<div class="eyecatch -archive">
  <div><?php echo esc_html($archive_title); ?></div>
  <img
    src="<?php echo esc_url($hero_image_url); ?>"
    alt="<?php echo esc_attr($archive_title); ?>"
    width="1920"
    height="600"
    fetchpriority="high"
    decoding="async">
</div>

<main class="<?php echo esc_attr($slug . '_page'); ?>">

  <div class="breadcrumbs--wrap">
    <?php get_template_part('include/common', 'breadcrumb'); ?>
  </div>

  <div class="container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <?php
        $schema_graph = [];

        $schema_graph[] = [
          '@type'           => 'BreadcrumbList',
          '@id'             => get_permalink() . '#breadcrumb',
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
              'name'     => $archive_title,
              'item'     => $archive_url,
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
          'description' => $page_description,
          'isPartOf'    => [
            '@type' => 'WebSite',
            '@id'   => home_url('/') . '#website',
            'url'   => home_url('/'),
            'name'  => $site_name,
          ],
          'breadcrumb'  => [
            '@id' => get_permalink() . '#breadcrumb',
          ],
        ];

        if ($is_question) {
          $answer_text = wp_strip_all_tags(strip_shortcodes(get_post_field('post_content', get_the_ID())));
          $faq_schema = [
            '@type'      => 'FAQPage',
            '@id'        => get_permalink() . '#faq',
            'mainEntity' => [[
              '@type' => 'Question',
              'name'  => wp_strip_all_tags(get_the_title()),
              'acceptedAnswer' => [
                '@type' => 'Answer',
                'text'  => $answer_text,
              ],
            ]],
          ];

          $schema_graph[] = $faq_schema;
          $schema_graph[1]['mainEntity'] = ['@id' => get_permalink() . '#faq'];
        } elseif ($is_service) {
          $service_schema = [
            '@type'       => 'Service',
            '@id'         => get_permalink() . '#service',
            'name'        => get_the_title(),
            'serviceType' => get_the_title(),
            'description' => $page_description,
            'url'         => get_permalink(),
            'provider'    => [
              '@type' => 'Organization',
              '@id'   => home_url('/') . '#localbusiness',
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

          if ($thumb_url) {
            $service_schema['image'] = $thumb_url;
          }

          $schema_graph[] = $service_schema;
          $schema_graph[1]['mainEntity'] = ['@id' => get_permalink() . '#service'];
        } else {
          $author_schema = $is_introduction
            ? [
              '@type' => 'Organization',
              '@id'   => home_url('/') . '#localbusiness',
              'name'  => 'トータルスマート株式会社',
              'url'   => home_url('/'),
            ]
            : [
              '@type' => 'Person',
              'name'  => get_the_author_meta('display_name'),
              'url'   => get_author_posts_url(get_the_author_meta('ID')),
            ];

          $article_schema = [
            '@type'            => 'Article',
            '@id'              => get_permalink() . '#article',
            'headline'         => wp_strip_all_tags(get_the_title()),
            'datePublished'    => get_the_date('c'),
            'dateModified'     => get_the_modified_date('c'),
            'description'      => $page_description,
            'mainEntityOfPage' => get_permalink(),
            'author'           => $author_schema,
            'publisher'        => [
              '@type' => 'Organization',
              '@id'   => home_url('/') . '#localbusiness',
              'name'  => 'トータルスマート株式会社',
              'url'   => home_url('/'),
            ],
          ];

          if ($thumb_url) {
            $article_schema['image'] = [$thumb_url];
          }

          $schema_graph[] = $article_schema;
          $schema_graph[1]['mainEntity'] = ['@id' => get_permalink() . '#article'];
        }

        $schema_data = [
          '@context' => 'https://schema.org',
          '@graph'   => $schema_graph,
        ];
        ?>
        <script type="application/ld+json">
          <?php echo wp_json_encode($schema_data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
        </script>

        <article class="detail_page">
          <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('Y.m.d')); ?></time>
          <h1 class="detail_page--ttl"><?php echo esc_html(get_the_title()); ?></h1>

          <ul class="detail_page--cat">
            <?php if (function_exists('categories_label')) categories_label(); ?>
          </ul>

          <div class="detail_page--thumb">
            <?php if (has_post_thumbnail()) : ?>
              <?php
              the_post_thumbnail('full', [
                'alt'           => the_title_attribute(['echo' => false]),
                'loading'       => 'eager',
                'fetchpriority' => 'high',
                'decoding'      => 'async',
              ]);
              ?>
            <?php endif; ?>
          </div>

          <?php if ($is_information) : ?>
            <div id="toc-container" class="toc-container">
              <p class="toc-title">目次</p>
              <ul id="toc-list" class="toc-list"></ul>
            </div>
          <?php endif; ?>

          <div class="detail_page--content">
            <?php the_content(); ?>
          </div>

          <?php if ($is_information) : ?>
            <div class="disclaimer">
              <div class="disclaimer--ttl">
                <span>⚠️</span>
                <h2>【重要】本記事をご利用になる前に必ずお読みください</h2>
              </div>
              <div class="disclaimer--inner">
                <p class="disclaimer--lead">
                  本記事は、OA機器、空調設備、防犯カメラ等のIT・設備機器に関する一般的な情報提供を目的としたものです。以下の点をご留意のうえ、ご自身の責任と判断でご活用ください。
                </p>
                <ol class="disclaimer--list">
                  <li>
                    <h3>1. 機器の保証および故障リスクについて</h3>
                    <p>本記事で紹介する設定変更、カスタマイズ、または非純正品の利用は、メーカーや販売店の<strong>製品保証の対象外</strong>となる可能性があります。また、操作ミス等による故障やデータ消失について、筆者は一切の責任を負いません。</p>
                  </li>
                  <li>
                    <h3>2. 法令および専門資格の遵守について</h3>
                    <p>エアコンの設置や電気配線、防犯カメラの設置等には、<strong>電気工事士等の国家資格</strong>が必要な場合や、建物賃貸借契約上の制限がある場合があります。ご自身で作業を行う際は、必ず関連法令や契約内容を確認し、必要に応じて専門業者へ依頼してください。</p>
                  </li>
                  <li>
                    <h3>3. プライバシーと肖像権について（防犯カメラ等）</h3>
                    <p>防犯カメラの設置・運用に関しては、個人情報保護法や各自治体の迷惑防止条例、肖像権への配慮が必要です。設置場所や管理方法については、法的リスクをご自身で十分にご検討ください。</p>
                  </li>
                  <li>
                    <h3>4. 環境による差異と効果の非保証</h3>
                    <p>記載されている省エネ効果、導入コスト、性能数値などは、特定の条件下での事例であり、すべての利用環境において同様の結果を保証するものではありません。</p>
                  </li>
                  <li>
                    <h3>5. 情報の鮮度と正確性について</h3>
                    <p>IT・設備機器の仕様や法規制は頻繁にアップデートされるため、常に最新情報を公式サイトなどで必ずご確認ください。</p>
                  </li>
                </ol>
                <div class="disclaimer--attention">
                  <p><strong>【免責事項】</strong><br>
                    本記事に掲載された情報に基づいて発生した損害（直接的・間接的を問わず、機器の故障、事故、法的トラブル、契約上の不利益等）について、筆者および掲載媒体は<strong>一切の責任を負いかねます。</strong> 最終的な判断と実施は、すべて利用者ご自身の責任において行っていただきますようお願い申し上げます。</p>
                </div>
              </div>
            </div>
          <?php endif; ?>
        </article>

        <ul class="paging">
          <li class="paging--item paging--item-next">
            <?php if (get_next_post()) : ?>
              <?php next_post_link('%link', '次の記事へ', false); ?>
            <?php endif; ?>
          </li>
          <li class="paging--item paging--item-gotolist">
            <a href="<?php echo esc_url($archive_url); ?>">一覧へ戻る</a>
          </li>
          <li class="paging--item paging--item-prev">
            <?php if (get_previous_post()) : ?>
              <?php previous_post_link('%link', '前の記事へ', false); ?>
            <?php endif; ?>
          </li>
        </ul>

        <?php if ($is_information) : ?>
          <?php
          /**
           * 関連記事を関連度スコアで選定する。
           *
           * 優先順位:
           * 1. お役立ち情報一覧で利用している infomation_item の完全一致
           * 2. information_cat の完全一致（既存運用との互換）
           * 3. 同じ親カテゴリ配下
           * 4. 同点なら新しい記事
           */
          $related_information_limit = 3;
          $related_information_current_id = get_the_ID();
          $related_information_taxonomies = ['infomation_item', 'information_cat'];
          $related_information_current_terms = [];
          $related_information_current_parents = [];

          foreach ($related_information_taxonomies as $taxonomy) {
            if (!taxonomy_exists($taxonomy)) {
              continue;
            }

            $terms = wp_get_post_terms($related_information_current_id, $taxonomy);
            if (is_wp_error($terms) || empty($terms)) {
              continue;
            }

            $related_information_current_terms[$taxonomy] = [];
            $related_information_current_parents[$taxonomy] = [];

            foreach ($terms as $term) {
              $term_id = (int) $term->term_id;
              $related_information_current_terms[$taxonomy][$term_id] = true;

              $ancestors = get_ancestors($term_id, $taxonomy, 'taxonomy');
              foreach ($ancestors as $ancestor_id) {
                $related_information_current_parents[$taxonomy][(int) $ancestor_id] = true;
              }

              if (!empty($term->parent)) {
                $related_information_current_parents[$taxonomy][(int) $term->parent] = true;
              }
            }
          }

          // 候補は一度広めに取得し、PHP側で関連度を算出する。
          // 全件取得を避けるため、最新60件を候補上限とする。
          $related_information_candidate_query = new WP_Query([
            'post_type'              => 'information',
            'post_status'            => 'publish',
            'posts_per_page'         => 60,
            'post__not_in'           => [$related_information_current_id],
            'orderby'                => 'date',
            'order'                  => 'DESC',
            'ignore_sticky_posts'    => true,
            'no_found_rows'          => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => true,
            'fields'                 => 'ids',
          ]);

          $related_information_scored = [];

          foreach ($related_information_candidate_query->posts as $candidate_id) {
            $score = 0;
            $shared_exact_terms = 0;
            $shared_parent_terms = 0;

            foreach ($related_information_taxonomies as $taxonomy) {
              if (empty($related_information_current_terms[$taxonomy]) || !taxonomy_exists($taxonomy)) {
                continue;
              }

              $candidate_terms = wp_get_post_terms($candidate_id, $taxonomy);
              if (is_wp_error($candidate_terms) || empty($candidate_terms)) {
                continue;
              }

              $candidate_term_ids = [];
              $candidate_parent_ids = [];

              foreach ($candidate_terms as $candidate_term) {
                $candidate_term_id = (int) $candidate_term->term_id;
                $candidate_term_ids[$candidate_term_id] = true;

                $candidate_ancestors = get_ancestors($candidate_term_id, $taxonomy, 'taxonomy');
                foreach ($candidate_ancestors as $ancestor_id) {
                  $candidate_parent_ids[(int) $ancestor_id] = true;
                }

                if (!empty($candidate_term->parent)) {
                  $candidate_parent_ids[(int) $candidate_term->parent] = true;
                }
              }

              $exact_matches = array_intersect_key(
                $related_information_current_terms[$taxonomy],
                $candidate_term_ids
              );
              $parent_matches = array_intersect_key(
                $related_information_current_parents[$taxonomy] ?? [],
                $candidate_parent_ids
              );

              $exact_count = count($exact_matches);
              $parent_count = count($parent_matches);

              $shared_exact_terms += $exact_count;
              $shared_parent_terms += $parent_count;

              // 一覧側で使われている infomation_item を主分類として重く評価。
              if ('infomation_item' === $taxonomy) {
                $score += $exact_count * 100;
                $score += $parent_count * 25;
              } else {
                // information_cat は既存互換用の補助分類。
                $score += $exact_count * 50;
                $score += $parent_count * 10;
              }
            }

            // 複数分類が一致する記事は、単一一致より明確に上位へ。
            if ($shared_exact_terms >= 2) {
              $score += ($shared_exact_terms - 1) * 30;
            }

            // 完全一致がなくても親カテゴリが共通なら関連候補として残す。
            if ($score > 0) {
              $related_information_scored[] = [
                'id'    => (int) $candidate_id,
                'score' => $score,
                'date'  => (int) get_post_time('U', true, $candidate_id),
              ];
            }
          }

          usort($related_information_scored, function ($a, $b) {
            if ($a['score'] === $b['score']) {
              return $b['date'] <=> $a['date'];
            }
            return $b['score'] <=> $a['score'];
          });

          $related_information_ids = array_slice(
            array_column($related_information_scored, 'id'),
            0,
            $related_information_limit
          );

          // 関連記事が3件に満たない場合のみ、新着記事で補完する。
          if (count($related_information_ids) < $related_information_limit) {
            $fallback_exclude_ids = array_merge(
              [$related_information_current_id],
              $related_information_ids
            );

            $fallback_ids = get_posts([
              'post_type'              => 'information',
              'post_status'            => 'publish',
              'posts_per_page'         => $related_information_limit - count($related_information_ids),
              'post__not_in'           => $fallback_exclude_ids,
              'orderby'                => 'date',
              'order'                  => 'DESC',
              'ignore_sticky_posts'    => true,
              'no_found_rows'          => true,
              'update_post_meta_cache' => false,
              'update_post_term_cache' => false,
              'fields'                 => 'ids',
            ]);

            $related_information_ids = array_merge($related_information_ids, $fallback_ids);
          }

          $related_information_query = new WP_Query([
            'post_type'              => 'information',
            'post_status'            => 'publish',
            'posts_per_page'         => $related_information_limit,
            'post__in'               => $related_information_ids ?: [0],
            'orderby'                => 'post__in',
            'ignore_sticky_posts'    => true,
            'no_found_rows'          => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => true,
          ]);
          ?>

          <?php if ($related_information_query->have_posts()) : ?>
            <section class="related_information" aria-labelledby="related-information-title">
              <h2 id="related-information-title" class="related_information--ttl">関連記事</h2>

              <ul class="related_information--list">
                <?php while ($related_information_query->have_posts()) : $related_information_query->the_post(); ?>
                  <?php
                  $related_terms = get_the_terms(get_the_ID(), 'information_cat');
                  if ((!$related_terms || is_wp_error($related_terms)) && taxonomy_exists('infomation_item')) {
                    $related_terms = get_the_terms(get_the_ID(), 'infomation_item');
                  }
                  $related_top_term_name = '';

                  if ($related_terms && !is_wp_error($related_terms)) {
                    $related_top_term = $related_terms[0];
                    $related_taxonomy = $related_top_term->taxonomy;
                    while (!empty($related_top_term->parent)) {
                      $related_top_term = get_term($related_top_term->parent, $related_taxonomy);
                    }
                    if ($related_top_term && !is_wp_error($related_top_term)) {
                      $related_top_term_name = $related_top_term->name;
                    }
                  }
                  ?>
                  <li>
                    <a href="<?php the_permalink(); ?>">
                      <div class="related_information--thumb">
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

                      <div class="related_information--meta">
                        <?php if ('' !== $related_top_term_name) : ?>
                          <span class="related_information--cat">
                            <?php echo esc_html($related_top_term_name); ?>
                          </span>
                        <?php endif; ?>
                        <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                          <?php echo esc_html(get_the_date('Y.m.d')); ?>
                        </time>
                      </div>

                      <h3><?php echo esc_html(get_the_title()); ?></h3>
                    </a>
                  </li>
                <?php endwhile; ?>
              </ul>
            </section>
          <?php endif; ?>

          <?php wp_reset_postdata(); ?>
        <?php endif; ?>

      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</main>

<?php get_footer(); ?>