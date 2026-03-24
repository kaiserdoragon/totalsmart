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
        現場の環境（明るさ、広さ、配線状況、電源の有無）や目的に合っていない機器を選んでしまうと、
        本来の役割を果たせないだけでなく、無駄なコストがかかってしまいます。
      </p>
    </div>
  </section>

  <div class="camera_middle bg_gray">
    <p>
      お客様の現場の課題を解決するための<br>
      <span>最適なソリューション</span>をご提供します
    </p>
  </div>

  <section class="camera_reason sec">
    <div class="container -md">
      <h2 class="single_detail_page--ttl">
        選ばれる<span>4</span>つの理由
      </h2>
      <div class="container camera_reason--inner">
        <ol>
          <li>
            <h3>地域密着・迅速対応</h3>
            <img src="<?php echo get_template_directory_uri(); ?>/img/service/reason_01.png" alt="" width="240" height="240" loading="lazy" decoding="async">
            <p>
              愛知・岐阜・三重・静岡の商圏に絞り、現地調査から
              施工、運用相談までスピーディーに対応。<br>
              「名古屋の店舗」「四日市の工場」「岐阜の倉庫」
              「浜松の資材置き場」など、地域特有の設置条件も
              踏まえて提案します。
            </p>
          </li>
          <li>
            <h3>現場課題に合わせての提案</h3>
            <img src="<?php echo get_template_directory_uri(); ?>/img/service/reason_02.png" alt="" width="240" height="240" loading="lazy" decoding="async">
            <p>
              防犯カメラは、どこにでも同じものを付ければよいわけ
              ではありません。<br>
              建物の形、見たい場所、夜の明るさ、今ある配線、
              予算の考え方によって、合う設備は変わります。
              それぞれの環境に合った設置方法をご提案します。
            </p>
          </li>
          <li>
            <h3>圧倒的なコスト最適化</h3>
            <img src="<?php echo get_template_directory_uri(); ?>/img/service/reason_03.png" alt="" width="240" height="240" loading="lazy" decoding="async">
            <p>
              「入れ替えたいけど工事費が…」というご担当者様に
              喜ばれているのが、既存の同軸ケーブルを流用できる
              5MAHDカメラシステムです。<br>
              アナログカメラ時代の配線をそのままに、高画質なシス
              テムへ更新できます。<br>
              現有資産を活かしたコスト最適化を実現します。
            </p>
          </li>
          <li>
            <h3>使いやすさまで考えます</h3>
            <img src="<?php echo get_template_directory_uri(); ?>/img/service/reason_04.png" alt="" width="240" height="240" loading="lazy" decoding="async">
            <p>
              防犯カメラは、性能が高ければそれで十分というもの
              ではありません。<br>
              当社では、映像のきれいさや見える範囲だけでなく、
              導入のしやすさまで含めて考えます。<br>
              現場に合っていて、導入後も使いやすいことまで考えて
              ご提案します。
            </p>
          </li>
        </ol>
      </div>
    </div>
  </section>

  <section class="camera_assignment sec">
    <div class="container -md">
      <div class="u-txt_center">
        <h2 class="single_detail_page--ttl -double">
          現場の課題を解決する<br>
          <span>3</span>つの課題
        </h2>
      </div>
      <article>
        <h3>
          AIネットワークカメラ<br>
          （NEXT AIシリーズ / Sシリーズ）
        </h3>
        <img src="<?php echo get_template_directory_uri(); ?>/img/service/assignment_01.jpg" alt="" width="600" height="327" loading="lazy" decoding="async">
        <div class="camera_assignment--inner">
          <ul>
            <li>誤検知が多すぎてアラートを信頼できない</li>
            <li>画質が悪くて証拠映像として使えない</li>
            <li>来客数や動線の把握にも活用したい</li>
          </ul>
          <p>
            人と車をAIが高精度に識別するネットワークカメラです。<br>
            風で揺れる木や通過する虫などによる誤検知を大幅に削減し、<br>
            「本当に注意すべき動き」だけを通知します。<br>
            また、高解像度の映像は万が一の際に明確な証拠映像となります。<br>
            誤報を抑えながら、必要なアラートに集中しやすくなります。<br>
            工場・倉庫では侵入監視や搬入口確認、店舗では来店状況や導線把握、<br class="is-hidden_sp">
            事務所や駐車場ではトラブル時の確認性向上につながります。
          </p>
          <strong>
            名古屋市や豊橋市の店舗、刈谷市・安城市の工場など、<br>
            用途の幅広いお客様に特に喜ばれているシリーズです。
          </strong>
        </div>
      </article>
      <article>
        <h3>
          5M AHDカメラシステム<br>
          （同軸ケーブル流用ソリューション）
        </h3>
        <img src="<?php echo get_template_directory_uri(); ?>/img/service/assignment_02.jpg" alt="" width="600" height="327" loading="lazy" decoding="async">
        <div class="camera_assignment--inner">
          <ul>
            <li>古いアナログカメラを高画質に更新したいが、配線工事費が高すぎる</li>
            <li>なるべく工事の手間とコストを抑えてリプレイスしたい</li>
            <li>映像の遅延が気になるので、シンプルな構成がいい</li>
          </ul>
          <p>
            既存のアナログカメラ用配線（同軸ケーブル）をそのまま流用しながら、<br class="is-hidden_sp">
            5メガピクセル（約250万画素以上）の高画質カメラシステムに更新できます。<br>
            新たに配線を引き直す必要がないため、工事費を大幅に抑えることができます。<br>
            配線工事費を抑えやすく、更新コストの最適化につながります。<br>
            遅延の少ない映像で見やすく、既存環境を活用できるため、<br class="is-hidden_sp">
            工場・倉庫・店舗・事務所の入れ替え時にも現実的な選択肢になります。
          </p>
          <strong>
            「岐阜市・各務原市の製造業の倉庫や、<br>
            大垣市・多治見市の工場などで多くご採用いただいています。
          </strong>
        </div>
      </article>
      <article>
        <h3>
          MOBITY BOX<br>
          （モバイル遠隔監視システム）
        </h3>
        <img src="<?php echo get_template_directory_uri(); ?>/img/service/assignment_03.jpg" alt="" width="600" height="327" loading="lazy" decoding="async">
        <div class="camera_assignment--inner">
          <ul>
            <li>建設現場や農地など、電源もネット回線もない場所を監視したい</li>
            <li>資材の盗難・不法投棄が心配だが、固定設備を引くのが難しい</li>
            <li>工期に合わせて設置場所を移動させたい</li>
          </ul>
          <p>
            4G LTEルーターとバッテリーを内蔵した、可搬型の遠隔監視システムです。<br>
            電源工事も回線工事も不要で、<br class="is-hidden_sp">
            現場にそのまま設置するだけでスマートフォンや<br class="is-hidden_sp">
            PCからリアルタイムに映像を確認できます。<br>
            ソーラーパネルとの組み合わせにより、長期間の無電源監視にも対応します。<br>
            建設現場では夜間の侵入対策や進捗確認、資材置き場では盗難抑止、<br class="is-hidden_sp">
            農地では離れた場所の状況確認など、<br class="is-hidden_sp">
            これまで設置が難しかった場所にも監視体制を構築できます。<br>
            「電源がないから無理」と諦めていた現場に、実用的な選択肢をつくれます。
          </p>
          <strong>
            三重県の伊賀市・松阪市、静岡県の掛川市・藤枝市など、<br>
            比較的郊外や山間部での建設現場・農地でご採用いただいています。
          </strong>
        </div>
      </article>
    </div>
  </section>

  <div class="camera_introduction bg_blue">
    <div class="camera_introduction--inner">
      <p>
        他にも熱源を検知するサーマルカメラ（夜間・視界不良時の不審者対策など）や、<br class="is-hidden_sp">
        既存の同軸ケーブルにPoE給電を可能にするPoC対応カメラ、<br class="is-hidden_sp">
        複数の録画方式に対応するハイブリッドレコーダーなども取り扱っています。
      </p>
      <p>
        「この現場に何が合うかわからない」という場合も、<br class="is-hidden_sp">
        まず無料現地調査でご相談ください。<br>
        現場を直接確認したうえで、最適な構成をご提案します。
      </p>
    </div>
  </div>



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