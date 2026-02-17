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

// 投稿タイプ判定フラグ
$is_introduction = ($post_type === 'introduction'); // 導入事例か？
$is_question     = ($post_type === 'question');     // よくある質問か？
$is_information     = ($post_type === 'information'); // お役立ち情報か？
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

        <?php if ($is_question): ?>
          <script type="application/ld+json">
            {
              "@context": "https://schema.org",
              "@type": "FAQPage",
              "mainEntity": [{
                "@type": "Question",
                "name": "<?php echo esc_js(get_the_title()); ?>",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "<?php echo esc_js(wp_strip_all_tags(get_the_content())); ?>"
                }
              }]
            }
          </script>
        <?php else: ?>
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
                  /* 通常記事（お役立ち情報など）：著者は「担当者（個人）」 */
                  {
                    "@type": "Person",
                    "name": "<?php echo esc_js(get_the_author_meta('display_name')); ?>",
                    "url": "<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"
                  }
                <?php endif; ?>
              ]
            }
          </script>
        <?php endif; ?>

        <article class="detail_page">
          <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
          <h2 class="detail_page--ttl"><?php the_title(); ?></h2>
          <ul class="detail_page--cat">
            <?php if (function_exists('categories_label')) categories_label(); ?>
          </ul>
          <div class="detail_page--thumb">
            <?php if (has_post_thumbnail()) : ?>
              <?php the_post_thumbnail(''); ?>
            <?php endif; ?>
          </div>

          <?php if ($is_information): ?>
            <!-- // JSで目次を出力させる -->
            <div id="toc-container" class="toc-container">
              <p class="toc-title">目次</p>
              <ul id="toc-list" class="toc-list"></ul>
            </div>
          <?php endif; ?>

          <div class="detail_page--content">
            <?php the_content(); ?>
          </div>

          <?php if ($is_information): ?>
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
                    <p>本記事の情報は<strong>2026年2月時点</strong>のものです。IT・設備機器の仕様や法規制は頻繁にアップデートされるため、常に最新情報を公式サイトや専門機関でご確認ください。</p>
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