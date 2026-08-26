<?php
$site_home_url   = home_url('/');
$ts_site_name    = get_bloginfo('name');
$ts_poster_url   = get_theme_file_uri('/img/top/mv_video.jpg');
$ts_has_seo_plugin = (
  defined('WPSEO_VERSION') ||
  defined('RANK_MATH_VERSION') ||
  defined('AIOSEO_VERSION') ||
  defined('SEOPRESS_VERSION')
);

/**
 * フロントページ専用の title を付与
 * SEOプラグインがある場合はそちらを優先
 */
if (!$ts_has_seo_plugin) {
  add_filter('pre_get_document_title', function ($document_title) use ($ts_site_name) {
    if (is_front_page()) {
      return 'トータルスマート株式会社 | コスト削減・設備工事・オフィス支援';
    }
    return $document_title;
  }, 20);

  /**
   * フロントページ専用の canonical を付与
   */
  add_action('wp_head', function () use ($site_home_url) {
    if (!is_front_page()) {
      return;
    }
    echo '<link rel="canonical" href="' . esc_url($site_home_url) . '">' . "\n";
  }, 20);
}

/**
 * ヒーロー動画ポスター画像を先読み
 */
add_action('wp_head', function () use ($ts_poster_url) {
  if (!is_front_page()) {
    return;
  }
  echo '<link rel="preload" as="image" href="' . esc_url($ts_poster_url) . '" fetchpriority="high">' . "\n";
}, 5);

get_header();

$faq_data = [
  [
    'q' => '法人契約でないと契約は出来ないのですか？',
    'a' => '商品サービスによって異なりますが、ご商売をされているお客さまでしたらお申込いただけます。',
  ],
  [
    'q' => '料金はいくらですか？',
    'a' => 'ご利用企業様の利用計画に応じて、さまざまな料金プランをご用意しております。詳しくはお問い合わせください。',
  ],
  [
    'q' => '導入までにどれくらい時間がかかりますか？',
    'a' => 'お申し込み後、数日でご利用を開始していただけます。契約後は専任のスタッフにより、開設・ご利用方法をご説明いたします。',
  ],
];

$home_schema = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    ts_get_local_business_schema(),
    [
      '@type'      => 'WebSite',
      '@id'        => $site_home_url . '#website',
      'name'       => 'トータルスマート株式会社',
      'url'        => $site_home_url,
      'inLanguage' => 'ja-JP',
      'publisher'  => [
        '@id' => $site_home_url . '#localbusiness',
      ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $site_home_url . '#webpage',
      'url'         => $site_home_url,
      'name'        => 'トータルスマート株式会社',
      'description' => '愛知・岐阜・三重・静岡対応。防犯・通信・省エネ・設備工事をワンストップで支援し、コスト削減と業務効率化を実現します。',
      'isPartOf'    => [
        '@id' => $site_home_url . '#website',
      ],
      'about'       => [
        '@id' => $site_home_url . '#localbusiness',
      ],
    ],
  ],
];
?>
<script type="application/ld+json">
  <?php echo wp_json_encode($home_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
</script>

<main>

  <section class="mv">
    <h1>
      <span>賢く安く簡単に最適なコスト削減</span>
      ワンストップで<br class="is-hidden_sp">全部解決！
    </h1>

    <div class="mv_scroll" aria-hidden="true">
      <div class="mv_scroll--inner">
        <div class="mv_scroll--left">
          <p><?php echo esc_html(str_repeat('Total Smartは経費削減を専門とする会社です。 ', 20)); ?></p>
        </div>
        <div class="mv_scroll--right">
          <p><?php echo esc_html(str_repeat('Total Smartは経費削減を専門とする会社です。 ', 20)); ?></p>
        </div>
      </div>
    </div>

    <div class="mv--scroll_down">
      <span>Scroll</span>
    </div>

    <div class="mv_parallax_bg">
      <video
        src="<?php echo esc_url(get_theme_file_uri('/video/video2.mp4')); ?>"
        poster="<?php echo esc_url($ts_poster_url); ?>"
        playsinline
        autoplay
        muted
        loop
        preload="metadata"
        aria-label="<?php echo esc_attr('トータルスマート サービス紹介動画'); ?>">
      </video>
    </div>
  </section>

  <section class="lead_worry bg_white sec">
    <div class="container -md">
      <h2>店舗・オフィス運営の<span class="lead_txt">お悩み</span>を解決します！</h2>
      <ul role="list">
        <li>業務が忙しすぎる…<br>もっと<span class="lead_txt">効率化</span>をしたい！！</li>
        <li>無駄な<br><span class="lead_txt">コスト・費用</span>を削りたい</li>
        <li>情報の<span class="lead_txt">セキュリティ管理</span>を<br>徹底したい！</li>
      </ul>
    </div>
  </section>

  <section class="lead_solution bg_gray">
    <div class="lead_solution--inner container sec">
      <div class="container -sm">
        <div class="lead_solution--ttl">
          <h2>
            <p>これらの<span>悩み</span>は</p>
            <img class="lead_solution--logo" src="<?php echo get_template_directory_uri(); ?>/img/top/solution_logo.png" alt="トータルスマート株式会社" width="353" height="42" loading="lazy" decoding="async">が<span>スマート</span>に解決します！
          </h2>
          <img src="<?php echo get_template_directory_uri(); ?>/img/top/solution_txt.png" alt="トータルスマート株式会社" width="1024" height="213" loading="lazy" decoding="async">
        </div>
        <div class="lead_solution--txt">
          <p class="underline">オフィス関連をトータルにお任せ！</p><br>
          <p class="underline">保守・メンテナンスをスマート解決！</p>
        </div>
        <p class="u-mb30">
          トータルスマート株式会社はオフィスに係ること全てトータルで依頼可能！<br>
          OA機器・インターネット回線・電気ガスはもちろん<br class="is-hidden_sp">
          全て一本化することができコスト削減につながります。
        </p>
        <div class="lead_solution--txt">
          <span>複数の業者に電話して、<br class="is-hidden_pc">たらい回しにあう…</span>
          <p class="underline">もうそんな必要はありません！</p>
        </div>
        <p>一本化により、沢山の業者に連絡する手間を省き</p>
        <strong>一本の電話で全て<span>解決！</span></strong>
        <p>となるトータルサポートを可能にしています。</p>
      </div>
      <img src="<?php echo get_template_directory_uri(); ?>/img/top/solution_catch.png" alt="" width="724" height="489" loading="lazy" decoding="async">
    </div>
  </section>





  <section class="feature bg_white sec">
    <div class="container">
      <h2 class="ttl">
        トータルスマートの主なサービス
        <span>FEATURE</span>
      </h2>
      <p class="ttl--lead">コストを抑えて成果を伸ばす、最適な業務改善をご提案します！！</p>
      <ul>
        <li>
          <img src="<?php echo esc_url(get_theme_file_uri('/img/top/feature_catch_01.png')); ?>" alt="" width="400" height="210" loading="lazy" decoding="async">
          <h3>コスト削減・固定費の見直し</h3>
          <p>
            電気代や通信費、設備費など、店舗・オフィスの運営にかかるコストを総合的に見直します。<br>
            LED照明、新電力、電子ブレーカー、通信回線など、現在の利用状況を確認したうえで、無理のないコスト削減をご提案します。
          </p>
          <img src="<?php echo esc_url(get_theme_file_uri('/img/top/feature_icon_01.png')); ?>" alt="" width="246" height="87" loading="lazy" decoding="async">
        </li>
        <li>
          <img src="<?php echo esc_url(get_theme_file_uri('/img/top/feature_catch_02.png')); ?>" alt="" width="400" height="210" loading="lazy" decoding="async">
          <h3>設備・セキュリティの改善</h3>
          <p>
            業務用エアコンやWi-Fi、防犯カメラ、UTM、OA機器など、店舗・オフィスに欠かせない設備をまとめてサポートします。<br>
            導入から施工、設定、保守まで一括して対応し、安心して業務を続けられる環境づくりを支援します。
          </p>
          <img src="<?php echo esc_url(get_theme_file_uri('/img/top/feature_icon_02.png')); ?>" alt="" width="245" height="105" loading="lazy" decoding="async">
        </li>
        <li>
          <img src="<?php echo esc_url(get_theme_file_uri('/img/top/feature_catch_03.png')); ?>" alt="" width="400" height="210" loading="lazy" decoding="async">
          <h3>業務効率化・集客支援</h3>
          <p>
            POSレジや配膳ロボット、キャッシュレス決済、Googleビジネスプロフィール、Web制作などを活用し、日々の業務効率化や人手不足対策、集客力向上を支援します。<br>
            店舗や企業ごとの課題に合わせて、必要なサービスを組み合わせてご提案します。
          </p>
          <img src="<?php echo esc_url(get_theme_file_uri('/img/top/feature_icon_03.png')); ?>" alt="" width="164" height="117" loading="lazy" decoding="async">
        </li>
      </ul>
      <div class="feature--inner">
        <p>OA機器や配線など、オフィスに関わること全て</p>
        <strong class="underline">トータルで依頼可能！</strong><br>
        <strong class="underline">一本の電話ですべて解決する</strong>
        <p>お客様にとってストレスのない業務形態です。</p>
      </div>
      <img src="<?php echo esc_url(get_theme_file_uri('/img/top/feature_anima.jpg')); ?>" alt="" width="800" height="1200" loading="lazy" decoding="async">
      <a class="btn_link" href="<?php echo esc_url(home_url('/company/')); ?>" rel="noopener">トータルスマートについて詳しく知る</a>
    </div>
  </section>

  <section class="reason bg_orange">
    <div class="container">
      <h2 class="ttl">
        「どこに相談すればいい？」をまとめて解決します
        <span>REASON</span>
      </h2>
      <p class="reason--lead">
        店舗・オフィスでは、業務用エアコンや通信、防犯、IT、電気、OA機器など、さまざまな設備やサービスが必要になります。<br>
        そのたびに別々の業者を探し、相談・手配するのは大きな負担です。<br>
        トータルスマートなら、店舗・オフィスに関する幅広いお困りごとを、ひとつの窓口でまとめてご相談いただけます。<br>
        お客様の状況や課題に合わせて必要なサービスをご提案し、導入から施工、設定、保守まで一貫してサポートします。<br>
      </p>
      <ul>
        <li>
          <img src="<?php echo esc_url(get_theme_file_uri('/img/top/reason_02.png')); ?>" alt="" width="136" height="117" loading="lazy" decoding="async">
          <h3>店舗・オフィスの<br class="is-hidden_sp">窓口を一本化</h3>
          <p>
            業務用エアコン、通信、防犯、IT、電気、OA機器など、<span>店舗・オフィスに関するさまざまなお困りごとをまとめてご相談いただけます。</span><br>
            複数の業者へ個別に問い合わせる手間を減らし、トータルスマートがひとつの窓口となってスムーズに対応します。
          </p>
        </li>
        <li>
          <img src="<?php echo esc_url(get_theme_file_uri('/img/top/reason_03.png')); ?>" alt="" width="171" height="103" loading="lazy" decoding="async">
          <h3>販売から施工・保守まで<br class="is-hidden_sp">一貫対応</h3>
          <p>
            商品のご提案や販売だけでなく、設置工事、各種設定、導入後の保守・修理まで一貫してサポートします。<br>
            導入前から導入後まで継続して対応することで、<span>安心して設備やサービスをご利用いただける環境を提供します。</span>
          </p>
        </li>
        <li>
          <img src="<?php echo esc_url(get_theme_file_uri('/img/top/reason_01.png')); ?>" alt="" width="129" height="129" loading="lazy" decoding="async">
          <h3>複数の課題を<br class="is-hidden_sp">まとめて最適化</h3>
          <p>
            コスト削減、設備改善、通信環境、IT、防犯・セキュリティ、業務効率化など、お客様が抱える課題を総合的に確認します。<br>
            幅広いサービスの中から必要なものを組み合わせ、<span>店舗・オフィス全体を見据えた最適なプランをご提案します。</span>
          </p>
        </li>
      </ul>
    </div>
    <section class="cv_area">
      <div class="cv_area--inner">
        <h2>小さな見直しが<b>大きな成果</b>につながる</h2>
        <p class="cv_area--lead">
          成果を伸ばす最適な業務改善を！<br>
          今の業務に潜む可能性を一緒に探しましょう！
        </p>
        <span>受付時間　平日9：00～18：00</span>
        <div class="cv_area--btns">
          <a class="cv_area--mail" href="<?php echo esc_url(home_url('/contact_corporate/')); ?>" target="_blank" rel="noopener noreferrer">メールで問い合わせ</a>
          <a class="cv_area--tel" href="tel:0529325450">お電話で問い合わせ</a>
        </div>
      </div>
    </section>
  </section>

  <?php
  /**
   * サービス一覧
   */
  ?>
  <section class="service bg_white">
    <div class="container">
      <h2 class="ttl">
        サービス一覧
        <span>SERVICE</span>
      </h2>

      <?php
      $service_terms = get_terms([
        'taxonomy'   => 'service_cat',
        'orderby'    => 'description',
        'order'      => 'ASC',
        'hide_empty' => true,
      ]);

      $service_posts = get_posts([
        'post_type'              => 'service',
        'post_status'            => 'publish',
        'posts_per_page'         => -1,
        'orderby'                => ['menu_order' => 'ASC', 'date' => 'DESC'],
        'no_found_rows'          => true,
        'update_post_meta_cache' => false,
        'update_post_term_cache' => true,
      ]);

      $services_by_term   = [];
      $json_ld_services   = [];
      $displayed_services = [];
      $service_position   = 0;

      if (!empty($service_posts)) {
        foreach ($service_posts as $service_post) {
          $term_ids = wp_get_post_terms($service_post->ID, 'service_cat', ['fields' => 'ids']);
          if (empty($term_ids) || is_wp_error($term_ids)) {
            continue;
          }

          foreach ($term_ids as $term_id) {
            $services_by_term[$term_id][] = $service_post;
          }
        }
      }

      if (!empty($service_terms) && !is_wp_error($service_terms)) :
      ?>
        <ul class="service--list">
          <?php foreach ($service_terms as $service_term) : ?>
            <?php if (empty($services_by_term[$service_term->term_id])) : ?>
              <?php continue; ?>
            <?php endif; ?>

            <?php foreach ($services_by_term[$service_term->term_id] as $service_post) : ?>
              <?php
              if (in_array($service_post->ID, $displayed_services, true)) {
                continue;
              }

              $displayed_services[] = $service_post->ID;
              $service_position++;
              $service_title = get_the_title($service_post);
              $service_link  = get_permalink($service_post);

              $json_ld_services[] = [
                '@type'    => 'ListItem',
                'position' => $service_position,
                'name'     => $service_title,
                'url'      => $service_link,
              ];
              ?>
              <li>
                <article>
                  <a href="<?php echo esc_url($service_link); ?>">
                    <figure>
                      <?php if (has_post_thumbnail($service_post)) : ?>
                        <?php
                        echo get_the_post_thumbnail(
                          $service_post->ID,
                          'service-thumb',
                          [
                            'alt'      => $service_title,
                            'loading'  => 'lazy',
                            'decoding' => 'async',
                            'width'    => '212',
                            'height'   => '212',
                          ]
                        );
                        ?>
                      <?php else : ?>
                        <img src="<?php echo esc_url(get_theme_file_uri('/img/top/service.jpg')); ?>" alt="" width="212" height="212" loading="lazy" decoding="async">
                      <?php endif; ?>
                      <figcaption>
                        <h3><?php echo esc_html($service_title); ?></h3>
                      </figcaption>
                    </figure>
                  </a>
                </article>
              </li>
            <?php endforeach; ?>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>

      <?php if (!empty($json_ld_services)) : ?>
        <script type="application/ld+json">
          <?php echo wp_json_encode([
            '@context'        => 'https://schema.org',
            '@type'           => 'ItemList',
            '@id'             => $site_home_url . '#service-list',
            'name'            => 'サービス一覧',
            'itemListElement' => $json_ld_services,
          ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
        </script>
      <?php endif; ?>

      <a class="btn_link" href="<?php echo esc_url(home_url('/service/')); ?>">サービス一覧を見る</a>
    </div>
  </section>


  <?php
  /**
   * 注目情報
   */
  ?>
  <?php
  $attention_page = get_page_by_path('attention', OBJECT, 'page');

  if (
    $attention_page instanceof WP_Post
    && 'publish' === $attention_page->post_status
    && '' !== trim($attention_page->post_content)
  ) :
  ?>
    <section class="attention sec bg_orange">
      <div class="container">
        <h2 class="ttl">
          注目情報
          <span>PICKUP</span>
        </h2>

        <p class="ttl--lead">
          トータルスマートから最新情報・注目情報をお伝えします。<br>
          情報収集にご活用ください。
        </p>

        <div class="attention--inner">
          <?php
          echo apply_filters(
            'the_content',
            $attention_page->post_content
          );
          ?>
        </div>
      </div>
    </section>
  <?php endif; ?>


  <?php
  /**
   * 導入実績スライダー
   */
  ?>
  <section class="works bg_white sec">
    <div class="container">
      <h2 class="ttl">
        導入実績
        <span>WORKS</span>
      </h2>
      <p class="works--lead">
        私たちの最新店舗設備を導入いただいた様々なお店の体験談が掲載されています。<br>
        実際にご利用いただいた企業の成功事例や具体的な活用方法、<br class="is-hidden_sp">
        改善された業務効率やお客様満足度の向上など、リアルな声をぜひご覧ください。<br>
        あなたの会社の未来を変えるヒントがここにあります！
      </p>
    </div>

    <div class="works--inner">
      <?php
      $works_query = new WP_Query([
        'post_type'              => 'introduction',
        'post_status'            => 'publish',
        'posts_per_page'         => 13,
        'orderby'                => 'date',
        'order'                  => 'DESC',
        'no_found_rows'          => true,
        'update_post_meta_cache' => false,
        'update_post_term_cache' => true,
      ]);

      $json_ld_works = [];
      $works_position = 0;

      if ($works_query->have_posts()) :
        $post_count = 0;
      ?>
        <div class="swiper">
          <div class="swiper-wrapper">
            <?php while ($works_query->have_posts()) : $works_query->the_post(); ?>
              <?php
              $post_count++;
              $works_position++;

              $json_ld_works[] = [
                '@type'    => 'ListItem',
                'position' => $works_position,
                'name'     => get_the_title(),
                'url'      => get_permalink(),
              ];

              $thumb_attr = [
                'alt'      => wp_strip_all_tags(get_the_title()),
                'loading'  => ($post_count <= 3) ? 'eager' : 'lazy',
                'decoding' => 'async',
              ];

              if (1 === $post_count) {
                $thumb_attr['fetchpriority'] = 'high';
              }

              $intro_terms      = get_the_terms(get_the_ID(), 'introduction_cat');
              $root_term_name   = '';
              $child_term_names = [];

              if ($intro_terms && !is_wp_error($intro_terms)) {
                $root_term = $intro_terms[0];
                while (!empty($root_term->parent)) {
                  $root_term = get_term($root_term->parent, 'introduction_cat');
                }
                if ($root_term && !is_wp_error($root_term)) {
                  $root_term_name = $root_term->name;
                }

                foreach ($intro_terms as $intro_term) {
                  if (!empty($intro_term->parent)) {
                    $child_term_names[] = $intro_term->name;
                  }
                }
              }
              ?>
              <article class="swiper-slide">
                <a href="<?php echo esc_url(get_permalink()); ?>">
                  <div class="works--thumbnail">
                    <?php if (has_post_thumbnail()) : ?>
                      <?php echo get_the_post_thumbnail(get_the_ID(), 'works-thumb', $thumb_attr); ?>
                    <?php else : ?>
                      <img
                        src="<?php echo esc_url(get_theme_file_uri('/img/top/works.jpg')); ?>"
                        alt="<?php echo esc_attr(wp_strip_all_tags(get_the_title())); ?>"
                        width="352"
                        height="308"
                        <?php echo (1 === $post_count) ? 'fetchpriority="high"' : ''; ?>
                        loading="<?php echo esc_attr(($post_count <= 3) ? 'eager' : 'lazy'); ?>"
                        decoding="async">
                    <?php endif; ?>
                  </div>

                  <div class="works--contents">
                    <div>
                      <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('Y.m.d')); ?></time>
                      <?php if ('' !== $root_term_name) : ?>
                        <span class="works--cat"><?php echo esc_html($root_term_name); ?></span>
                      <?php endif; ?>
                    </div>

                    <p><?php echo esc_html(get_the_title()); ?></p>

                    <?php if (!empty($child_term_names)) : ?>
                      <div>
                        <?php foreach ($child_term_names as $child_term_name) : ?>
                          <span class="works--cat_child"><?php echo esc_html($child_term_name); ?></span>
                        <?php endforeach; ?>
                      </div>
                    <?php endif; ?>
                  </div>
                </a>
              </article>
            <?php endwhile; ?>
          </div>
        </div>
        <?php wp_reset_postdata(); ?>
      <?php else : ?>
        <p>表示する投稿がありません。</p>
      <?php endif; ?>
    </div>

    <?php if (!empty($json_ld_works)) : ?>
      <script type="application/ld+json">
        <?php echo wp_json_encode([
          '@context'        => 'https://schema.org',
          '@type'           => 'ItemList',
          '@id'             => $site_home_url . '#works-list',
          'name'            => '導入実績一覧',
          'itemListElement' => $json_ld_works,
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
      </script>
    <?php endif; ?>

    <a class="btn_link" href="<?php echo esc_url(home_url('/introduction/')); ?>">導入実績一覧を見る</a>
  </section>

  <section class="company bg_white sec">
    <div class="container">
      <h2 class="ttl">
        会社概要
        <span>COMPANY</span>
      </h2>
      <p>
        最新のテクノロジーと革新的なソリューションを駆使し、<br class="is-hidden_sp">
        企業の効率化と安全・快適な環境の実現を目指す企業です。<br>
        お客様の多様なニーズに応えるため、柔軟な導入プランと確かな技術力で、<br class="is-hidden_sp">
        未来を切り拓くパートナーとしての信頼と実績を築いております。
      </p>
      <div class="company--inner">
        <div>
          <ul>
            <li><a href="<?php echo esc_url(home_url('/company/#philosophy')); ?>">企業理念</a></li>
            <li><a href="<?php echo esc_url(home_url('/company/#history')); ?>">沿革</a></li>
            <li><a href="<?php echo esc_url(home_url('/company/#access')); ?>">アクセス</a></li>
          </ul>
          <a class="btn_link" href="<?php echo esc_url(home_url('/company/')); ?>" rel="noopener">会社概要の詳細はこちらから</a>
        </div>
        <img src="<?php echo esc_url(get_theme_file_uri('/img/top/company.png')); ?>" alt="" width="415" height="407" loading="lazy" decoding="async">
      </div>
    </div>
  </section>

  <section class="recruit sec">
    <div class="container">
      <h2 class="ttl">
        採用情報
        <span>RECRUIT</span>
      </h2>
      <div class="recruit--inner">
        <div>
          <dl>
            <dt>自由な発想とチームワークを<br>最大限に高める企業風土の創出</dt>
            <dd>ベンチャー企業として日々新事業を展開する弊社では、<br class="is-hidden_sp">
              決められたマニュアルはなく自分なりのルールで行動し、提案ができる社風です。<br>
              その為人間性を重視し、「誰と働くか」ということを大切にしています。<br>
              また働き方や雇用形態には縛られず、リモートワークなどを積極的に取り入れ、<br class="is-hidden_sp">
              成果に対してしっかりと還元をする独自の評価システムを構築することによって<br class="is-hidden_sp">
              チームワークを強化し、お客様はもちろん従業員がよりよい環境で働けることを目指します。
            </dd>
          </dl>
          <a class="btn_link" href="<?php echo esc_url(home_url('/recruit/')); ?>" target="_blank" rel="noopener noreferrer">採用情報はこちらから</a>
        </div>
        <img src="<?php echo esc_url(get_theme_file_uri('/img/top/recruit_catch.png')); ?>" alt="" width="477" height="492" loading="lazy" decoding="async">
      </div>
    </div>
  </section>

  <?php
  /**
   * お知らせ一覧
   */
  $news_query = new WP_Query([
    'post_type'              => 'post',
    'post_status'            => 'publish',
    'posts_per_page'         => 3,
    'orderby'                => 'date',
    'order'                  => 'DESC',
    'ignore_sticky_posts'    => true,
    'no_found_rows'          => true,
    'update_post_meta_cache' => false,
    'update_post_term_cache' => true,
  ]);

  if ($news_query->have_posts()) : ?>
    <section class="front-news bg_white sec">
      <div class="container">
        <h2 class="ttl">
          <?php esc_html_e('お知らせ', 'origintheme'); ?>
          <span>NEWS</span>
        </h2>
        <ul class="front-news--list">
          <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
            <li>
              <a href="<?php echo esc_url(get_permalink()); ?>">
                <div class="front-news--info">
                  <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                    <?php echo esc_html(get_the_date('Y.m.d')); ?>
                  </time>
                  <?php
                  $categories = get_the_category();
                  if (!empty($categories)) :
                    foreach ($categories as $category) :
                  ?>
                      <span class="front-news--cat_label -<?php echo esc_attr($category->slug); ?>">
                        <?php echo esc_html($category->name); ?>
                      </span>
                  <?php
                    endforeach;
                  endif;
                  ?>
                </div>
                <p><?php echo esc_html(mb_strimwidth(wp_strip_all_tags(get_the_title()), 0, 250, '...', 'UTF-8')); ?></p>
              </a>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>
      <a class="btn_link" href="<?php echo esc_url(home_url('/news/')); ?>">お知らせ一覧はこちらから</a>
    </section>
  <?php
    wp_reset_postdata();
  endif;
  ?>

  <section class="information bg_white sec">
    <div class="container">
      <h2 class="ttl">
        お役立ち情報
        <span>INFORMATION</span>
      </h2>

      <?php
      $information_query = new WP_Query([
        'post_type'              => 'information',
        'post_status'            => 'publish',
        'posts_per_page'         => 9,
        'orderby'                => 'date',
        'order'                  => 'DESC',
        'no_found_rows'          => true,
        'update_post_meta_cache' => false,
        'update_post_term_cache' => true,
      ]);

      if ($information_query->have_posts()) :
      ?>
        <div class="information--list">
          <?php while ($information_query->have_posts()) : $information_query->the_post(); ?>
            <?php
            $information_terms = get_the_terms(get_the_ID(), 'infomation_item');
            $top_term_name     = '';

            if ($information_terms && !is_wp_error($information_terms)) {
              $top_term = $information_terms[0];
              while (!empty($top_term->parent)) {
                $top_term = get_term($top_term->parent, 'infomation_item');
              }
              if ($top_term && !is_wp_error($top_term)) {
                $top_term_name = $top_term->name;
              }
            }
            ?>
            <article>
              <a href="<?php echo esc_url(get_permalink()); ?>" class="information--link">
                <div class="information--image">
                  <?php if (has_post_thumbnail()) : ?>
                    <?php
                    echo get_the_post_thumbnail(
                      get_the_ID(),
                      'info-thumb',
                      [
                        'alt'      => wp_strip_all_tags(get_the_title()),
                        'loading'  => 'lazy',
                        'decoding' => 'async',
                      ]
                    );
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

                <h3><?php echo esc_html(get_the_title()); ?></h3>
              </a>
            </article>
          <?php endwhile; ?>
        </div>
        <?php wp_reset_postdata(); ?>
      <?php else : ?>
        <p>現在、お役立ち情報はありません。</p>
      <?php endif; ?>

      <a class="btn_link" href="<?php echo esc_url(home_url('/information/')); ?>">お役立ち情報一覧を見る</a>
    </div>
  </section>

  <section class="flow bg_gray sec">
    <div class="container">
      <h2 class="ttl">
        導入の流れ
        <span>FLOW</span>
      </h2>
      <ul>
        <li>
          <h3>ご提案</h3>
          <p>
            まずは、お客様の現状やお悩みをしっかりとお伺いし、最適なソリューションをご提案いたします。<br>
            最新の製品やシステムの特徴、導入することで得られるメリットを分かりやすくご説明し、<br class="is-hidden_sp">
            お客様のニーズに合ったプランをお届けします。
          </p>
        </li>
        <li>
          <h3>ご商談</h3>
          <p>
            具体的な導入方法やお見積もり、スケジュールなど詳細な条件について商談を進めます。<br>
            お客様との対話を通じて、ご不明な点やご要望を丁寧にお伺いし、双方納得のいくプランを練り上げて<br class="is-hidden_sp">
            まいります。
          </p>
        </li>
        <li>
          <h3>ご契約</h3>
          <p>
            商談内容にご同意いただけましたら、正式な契約手続きに進みます。<br>
            契約書のご説明や必要書類のご案内を通じて、安心してお手続きいただけるようサポートいたします。<br>
            ご契約後も、導入後のフォローアップやアフターサポートをしっかりと行っていきます。
          </p>
        </li>
      </ul>
    </div>
  </section>

  <section class="question sec bg_white">
    <div class="container">
      <h2 class="ttl">
        よくある質問
        <span>QUESTION</span>
      </h2>
      <p>皆様からのご質問を回答させていただいています。</p>
      <dl>
        <?php foreach ($faq_data as $faq) : ?>
          <dt><?php echo esc_html($faq['q']); ?></dt>
          <dd><?php echo esc_html($faq['a']); ?></dd>
        <?php endforeach; ?>
      </dl>
      <a class="btn_link" href="<?php echo esc_url(home_url('/question/')); ?>" rel="noopener">よくある質問の一覧を見る</a>
    </div>
  </section>

  <section class="cv_contact sec">
    <div class="container">
      <div class="cv_contact--ttl">
        <h2 class="ttl">
          お問い合わせ
          <span>CONTACT</span>
        </h2>
        <img src="<?php echo esc_url(get_theme_file_uri('/img/page/contact_logo.png')); ?>" alt="トータルスマート株式会社" width="1100" height="117" loading="lazy" decoding="async">
      </div>
      <p>ご不明な点やご質問、または詳細な情報をお求めの場合は、どうぞお気軽にお問い合わせください。<br>
        専門のスタッフが迅速にサポートします。</p>
      <div class="cv_contact--inner">
        <ul>
          <li>
            <a href="<?php echo esc_url(home_url('/contact/')); ?>">メールで問い合わせ</a>
          </li>
        </ul>
        <a href="tel:0529325450" class="cv_contact--btn">
          052-932-5450
          <span>受付時間<br class="is-hidden_sp">平日9:00～18:00</span>
        </a>
      </div>
    </div>
  </section>

</main>
<?php get_footer(); ?>