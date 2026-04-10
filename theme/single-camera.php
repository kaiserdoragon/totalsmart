<?php
/*
Template Name: 防犯カメラ
Template Post Type:service
*/

$post_type = 'service';

$type_settings = [
  'service' => [
    'title' => 'サービス',
    'img'   => 'eyecatch_service.jpg',
    'slug'  => 'service',
  ],
];

$title     = $type_settings[$post_type]['title'] ?? 'お知らせ';
$img_file  = $type_settings[$post_type]['img'] ?? 'eyecatch_default.jpg';
$slug      = $type_settings[$post_type]['slug'] ?? 'news';
$post_id   = get_queried_object_id();
$site_name = get_bloginfo('name');

$service_title       = $post_id ? get_the_title($post_id) : '防犯カメラ';
$service_url         = $post_id ? get_permalink($post_id) : home_url('/');
$service_archive_url = get_post_type_archive_link('service') ?: home_url('/service/');
$service_image_url   = $post_id && has_post_thumbnail($post_id)
  ? get_the_post_thumbnail_url($post_id, 'full')
  : '';
$post_slug = $post_id ? get_post_field('post_name', $post_id) : $slug;

$raw_excerpt = $post_id ? get_the_excerpt($post_id) : '';
$raw_content = $post_id ? get_post_field('post_content', $post_id) : '';

$default_description = sprintf(
  '%sの設置・工事なら%s。愛知・岐阜・三重・静岡に対応し、現地調査・見積り無料。既存配線を活かした更新や無電源現場の遠隔監視にも対応します。',
  $service_title ?: '防犯カメラ',
  $site_name
);

$description_source = $raw_excerpt;
if ('' === trim((string) $description_source)) {
  $description_source = wp_strip_all_tags(strip_shortcodes((string) $raw_content));
}
if ('' === trim((string) $description_source)) {
  $description_source = $default_description;
}

$description_source = html_entity_decode((string) $description_source, ENT_QUOTES, get_bloginfo('charset') ?: 'UTF-8');
$description_source = wp_strip_all_tags($description_source);
$description_source = preg_replace('/\s+/u', ' ', $description_source);
$description_source = trim((string) $description_source);

if (function_exists('mb_strimwidth')) {
  $service_description = mb_strimwidth($description_source, 0, 140, '...', 'UTF-8');
} else {
  $service_description = wp_trim_words($description_source, 60, '...');
}

if ('' === $service_description) {
  $service_description = $default_description;
}

$seo_title = sprintf(
  '%sの設置・工事 | %s',
  $service_title ?: '防犯カメラ',
  $site_name
);

$has_seo_plugin = (
  defined('WPSEO_VERSION') ||
  defined('RANK_MATH_VERSION') ||
  defined('AIOSEO_VERSION') ||
  defined('SEOPRESS_VERSION')
);

if (!$has_seo_plugin) {
  add_filter('pre_get_document_title', function ($document_title) use ($seo_title) {
    if (is_singular('service')) {
      return $seo_title;
    }
    return $document_title;
  }, 20);

  add_action('wp_head', function () use ($service_url, $service_description) {
    if (!is_singular('service')) {
      return;
    }
    echo '<meta name="robots" content="max-image-preview:large">' . "
";
  }, 20);
}

get_header('service');
?>

<main class="single_<?php echo esc_attr($post_slug); ?> single_detail_page">
  <?php
  if (is_singular('service')) :
    $website_id    = home_url('/') . '#website';
    $organization_id = home_url('/') . '#organization';
    $webpage_id    = $service_url . '#webpage';
    $breadcrumb_id = $service_url . '#breadcrumb';
    $service_id    = $service_url . '#service';

    $service_schema = [
      '@type'       => 'Service',
      '@id'         => $service_id,
      'name'        => $service_title,
      'serviceType' => $service_title,
      'description' => $service_description,
      'url'         => $service_url,
      'provider'    => [
        '@id' => $organization_id,
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

    $schema_graph = [$service_schema];

    if (!$has_seo_plugin) {
      $schema_graph = [
        [
          '@type' => 'Organization',
          '@id'   => $organization_id,
          'name'  => $site_name,
          'url'   => home_url('/'),
        ],
        [
          '@type'     => 'WebSite',
          '@id'       => $website_id,
          'url'       => home_url('/'),
          'name'      => $site_name,
          'publisher' => [
            '@id' => $organization_id,
          ],
        ],
        [
          '@type'           => 'BreadcrumbList',
          '@id'             => $breadcrumb_id,
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
              'name'     => $service_title,
              'item'     => $service_url,
            ],
          ],
        ],
        [
          '@type'       => 'WebPage',
          '@id'         => $webpage_id,
          'url'         => $service_url,
          'name'        => $service_title,
          'description' => $service_description,
          'isPartOf'    => [
            '@id' => $website_id,
          ],
          'breadcrumb'  => [
            '@id' => $breadcrumb_id,
          ],
          'mainEntity'  => [
            '@id' => $service_id,
          ],
        ],
        $service_schema,
      ];

      if ($service_image_url) {
        $schema_graph[3]['primaryImageOfPage'] = [
          '@type' => 'ImageObject',
          'url'   => $service_image_url,
        ];
      }
    }

    $schema_data = [
      '@context' => 'https://schema.org',
      '@graph'   => $schema_graph,
    ];
  ?>
    <script type="application/ld+json">
      <?php echo wp_json_encode($schema_data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
    </script>
  <?php endif; ?>

  <section class="camera_mv">
    <div class="camera_mv--contents container -lg">
      <div class="camera_mv--block">
        <span class="camera_mv--area">愛知・岐阜・三重・静岡対応</span>
        <p class="camera_mv--lead">不審者対策も、内部トラブル対策もこれで解決！</p>
        <h1 class="camera_mv--ttl">
          <span class="camera_mv--txt"><span class="camera_mv--strong">防犯カメラ</span>の設置・工事は</span>
          <span class="camera_mv--txt">お任せください！！</span>
        </h1>
        <p class="camera_mv--supplement">オフィス・店舗・施設の環境に合わせた、<br>防犯カメラをご提案します</p>
        <ul>
          <li>出張費・お見積り<br><span>無料</span></li>
          <li>アフターサポートまで<br>すべて<span>自社対応</span></li>
          <li><span>電源・回線のない現場</span><br>にも対応可能</li>
          <li><span>既存の配線を活かした</span><br>リプレイスにも対応</li>
        </ul>
      </div>
      <div class="camera_mv--image">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/mv_catch.png'); ?>" alt="防犯カメラ設置サービスのイメージ" width="515" height="645" loading="eager" fetchpriority="high" decoding="async">
      </div>
    </div>
    <img class="camera_mv--bg" src="<?php echo esc_url(get_template_directory_uri() . '/img/service/mv_bg.jpg'); ?>" alt="" width="1920" height="750" loading="eager" fetchpriority="high" decoding="async">
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
    <div class="container">
      <p>
        お客様の現場の課題を解決するための<br>
        <span>最適なソリューション</span>をご提供します
      </p>
    </div>
  </div>

  <section class="camera_reason sec" id="camera_reason">
    <div class="container -md">
      <h2 class="single_detail_page--ttl">
        選ばれる<span>4</span>つの理由
      </h2>
      <div class="container camera_reason--inner">
        <ol>
          <li>
            <h3>地域密着・迅速対応</h3>
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/reason_01.png'); ?>" alt="地域密着・迅速対応のイメージ" width="240" height="240" loading="lazy" decoding="async">
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
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/reason_02.png'); ?>" alt="現場課題に合わせた提案のイメージ" width="240" height="240" loading="lazy" decoding="async">
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
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/reason_03.png'); ?>" alt="コスト最適化のイメージ" width="240" height="240" loading="lazy" decoding="async">
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
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/reason_04.png'); ?>" alt="使いやすさを考えた提案のイメージ" width="240" height="240" loading="lazy" decoding="async">
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

  <section class="camera_assignment sec" id="camera_assignment">
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
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/assignment_01.jpg'); ?>" alt="AIネットワークカメラの導入イメージ" width="600" height="327" loading="lazy" decoding="async">
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
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/assignment_02.jpg'); ?>" alt="同軸ケーブル流用による5M AHDカメラ更新のイメージ" width="600" height="327" loading="lazy" decoding="async">
        <div class="camera_assignment--inner">
          <ul>
            <li>古いアナログカメラを高画質に更新したいが、配線工事費が高すぎる</li>
            <li>なるべく工事の手間とコストを抑えてリプレイスしたい</li>
            <li>映像の遅延が気になるので、シンプルな構成がいい</li>
          </ul>
          <p>
            既存のアナログカメラ用配線（同軸ケーブル）をそのまま流用しながら、<br class="is-hidden_sp">
            5メガピクセル級の高画質カメラシステムに更新できます。<br>
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
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/assignment_03.jpg'); ?>" alt="MOBITY BOXによる遠隔監視のイメージ" width="600" height="327" loading="lazy" decoding="async">
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

  <section class="camera_construction sec" id="camera_construction">
    <div class="container -md">
      <h2>施工・導入実績</h2>
      <p>
        工場・倉庫・店舗・建設現場など、現場ごとに求められる監視体制は異なります。<br>
        私たちは、防犯カメラを一律にご提案するのではなく、<br class="is-hidden_sp">
        課題・設置環境・既存設備に合わせて、最適な機器構成と工事方法をご提案しています。
      </p>
      <article>
        <h3>誤報の嵐から解放され、業務管理も劇的に改善</h3>
        <div class="camera_construction--inner">
          <dl>
            <dt>愛知県名古屋市 自動車部品工場様</dt>
            <dd>敷地外周に設置していた従来の動体検知カメラが、
              野良猫や風で揺れる木々に反応してしまい、夜間の誤報が多発。<br>
              警備システムとの連動で無駄な出動コストがかかっていました。<br>
              導入後は動物や天候による誤報が「ゼロ」になり、本当に必要な
              不審者の侵入時のみ正確にアラートが鳴る仕組みが完成しました。<br>
              画質な映像を活用し、日中は工場内の安全管理や作業工程の確認
              など、防犯以外の業務改善にも役立てています。
            </dd>
          </dl>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/construction_01.jpg'); ?>" alt="自動車部品工場での防犯カメラ導入事例" width="500" height="348" loading="lazy" decoding="async">
        </div>
      </article>
      <article>
        <h3>他社の高額見積もりを覆す、低コストな高画質化</h3>
        <div class="camera_construction--inner">
          <dl>
            <dt>岐阜県岐阜市　小売店様</dt>
            <dd>
              駐車場での当て逃げトラブルが起きた際、古いアナログカメラ
              の画質では車のナンバープレートが読み取れませんでした。<br>
              システム一式の入れ替えを検討したものの、他社からは「配線
              をすべてLANケーブルに引き直す必要がある」と高額な見積も
              りを出され、予算が合わず困っていました。<br>
              今回配線工事費を大幅にカットできたため、他社見積もりの
              約半分のコストでフルハイビジョンを超える高画質監視ができ
              ました。<br>
              ナンバープレートもくっきりと録画できるようになり、トラ
              ブルの早期解決と犯罪抑止力が飛躍的に向上しました。
            </dd>
          </dl>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/construction_02.jpg'); ?>" alt="小売店での高画質カメラ更新事例" width="500" height="348" loading="lazy" decoding="async">
        </div>
      </article>
      <article>
        <h3>電源なし・ネットなしの過酷な環境を即日監視</h3>
        <div class="camera_construction--inner">
          <dl>
            <dt>三重県四日市市　建設会社様</dt>
            <dd>
              郊外の仮設資材置き場で、夜間に銅線ケーブルなどの盗難被害
              が出ていました。<br>
              すぐに監視カメラを設置したかったものの、現場には100V電源
              もインターネット回線もなく、通常のカメラでは対応できない
              状態でした。<br>
              お問い合わせをしてから最短で現場まで来てもらって、その日
              のうちに稼働ができました。<br>
              スマートフォンからいつでも現地の状況を遠隔監視できるよう
              になりました。<br>
              カメラの存在自体が強力な威嚇となり、導入以降は盗難被害が
              一切発生していません。
            </dd>
          </dl>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/construction_03.jpg'); ?>" alt="無電源現場での遠隔監視導入事例" width="500" height="348" loading="lazy" decoding="async">
        </div>
      </article>
    </div>
  </section>

  <section class="camera_flow bg_gray sec" id="camera_flow">
    <div class="container -md">
      <h2>導入・施工までの流れ</h2>
      <p>
        初めてご依頼の方も、既存設備の入れ替えをお考えの方も、まずはお気軽にご連絡ください。<br>
        以下のステップで、現場に最適なシステムを丁寧に構築します。
      </p>
      <article>
        <p class="camera_flow--step">
          <span>STEP</span>
          01
        </p>
        <div class="camera_flow--inner">
          <h3>お問い合わせ・ご相談（無料）</h3>
          <p>
            フォームまたはお電話にてご連絡ください。<br>
            現場の種類・現在の設備状況・お悩みの概要などをお聞きします。<br>
            「何から話せばいいかわからない」という段階でも歓迎です。<br>
            まずは気軽にお声がけください。
          </p>
        </div>
      </article>
      <article>
        <p class="camera_flow--step">
          <span>STEP</span>
          02
        </p>
        <div class="camera_flow--inner">
          <h3>無料現地調査</h3>
          <p>
            実際に現場へ伺い、設置環境・既存配線の状況・死角になりやすい箇所などを
            詳しく確認します。<br>
            東海4県（愛知・岐阜・三重・静岡）への出張費は無料です。<br>
            現場を見ることで、最適解が見えてきます。
          </p>
        </div>
      </article>
      <article>
        <p class="camera_flow--step">
          <span>STEP</span>
          03
        </p>
        <div class="camera_flow--inner">
          <h3>ご提案・無料お見積り</h3>
          <p>
            現地調査の結果をもとに、現場に最適な機器構成と設置プランをご提案します。<br>
            お見積りは無料で、複数のプラン（例：コスト重視プラン・高画質プランなど）
            を比較提示することも可能です。<br>
            「こんな提案は想定していなかった」というご意見をよくいただきます。
          </p>
        </div>
      </article>
      <article>
        <p class="camera_flow--step">
          <span>STEP</span>
          04
        </p>
        <div class="camera_flow--inner">
          <h3>ご契約・設置スケジュールの確定</h3>
          <p>
            ご提案内容にご納得いただけましたら、ご契約となります。<br>
            施工日程は現場の稼働状況に合わせて柔軟に調整します。<br>
            工場や店舗の営業時間外の施工にも対応しています。
          </p>
        </div>
      </article>
      <article>
        <p class="camera_flow--step">
          <span>STEP</span>
          05
        </p>
        <div class="camera_flow--inner">
          <h3>機器設置・動作確認</h3>
          <p>
            専門スタッフが現場で機器を設置し、映像確認・録画設定・<br>
            リモートアクセスの設定まで丁寧に行います。<br>
            設置後は、実際の映像を確認しながら動作確認を実施し、
            問題がないことを確かめてから引き渡します。
          </p>
        </div>
      </article>
      <article>
        <p class="camera_flow--step">
          <span>STEP</span>
          06
        </p>
        <div class="camera_flow--inner">
          <h3>操作説明・アフターサポート</h3>
          <p>
            設置後の操作方法を担当者様にわかりやすくご説明します。<br>
            「映像の確認方法がわからない」「追加でカメラを増設したい」<br>
            「故障かもしれない」など、導入後のご相談にも対応しています。<br>
            長期的なパートナーとしてお付き合いしています。
          </p>
        </div>
      </article>
    </div>
  </section>

  <section class="camera_qa sec" id="camera_qa">
    <div class="container -md">
      <h2>よくある質問</h2>
      <p>
        お問い合わせ前に気になる点を、まとめてお答えします。<br>
        ご不明な点は、お気軽にお問い合わせください。
      </p>
      <dl>
        <dt>現地調査や見積もりは本当に無料ですか？</dt>
        <dd>
          はい、完全無料です。<br>
          現地調査・お見積りに費用は一切かかりません。<br>
          また、ご提案後にご依頼いただかなくても、キャンセル料等も発生しませんのでご安心ください。<br>
          「まず話を聞いてみたい」という段階でのお問い合わせを歓迎しています。
        </dd>
        <dt>既存のカメラや配線はそのまま使えますか？</dt>
        <dd>
          現場の状況によって異なりますが、アナログカメラ時代の同軸ケーブルが残っている場合、<br>
          それをそのまま流用した高画質システムへの更新が可能なケースが多いです。<br>
          現地調査の際に配線の状態を確認したうえで、最適な方法をご提案します。<br>
        </dd>
        <dt>電源もネット回線もない場所には設置できますか？</dt>
        <dd>
          はい、対応可能です。<br>
          4G LTEとバッテリーを内蔵したMOBITY BOX（モバイル遠隔監視システム）により、<br>
          電源・回線工事なしで遠隔監視を実現できます。<br>
          建設現場・農地・資材置き場など、インフラが整っていない場所でも設置実績があります。<br>
          詳しくは現地調査にてご相談ください。
        </dd>
        <dt>導入費用の目安はどれくらいですか？</dt>
        <dd>
          現場の規模・設置台数・機種・既存設備の状況によって大きく異なるため、<br>
          一概にはお伝えできません。<br>
          ただし、既存配線の流用や、必要最低限の構成から始める段階的な導入など、<br>
          コストを抑えるご提案も積極的に行っています。まずはお気軽にご相談ください。
        </dd>
        <dt>施工はどのくらいの期間がかかりますか？</dt>
        <dd>
          現場の規模・台数・既存配線の状況によって異なりますが、<br>
          小規模な設置（数台程度）であれば1日で完了することもあります。<br>
          大規模な工場や複数フロアへの設置の場合は、数日程度かかることもあります。<br>
          工期の見通しはお見積り時に合わせてご提示します。
        </dd>
        <dt>工場や店舗の営業時間中でも施工できますか？</dt>
        <dd>
          可能な場合も多いですが、現場の状況によっては夜間・休日対応をご提案することもあります。<br>
          現場の稼働スケジュールに合わせた施工計画を立てますので、まずはご相談ください。
        </dd>
        <dt>設置後のサポートはありますか？</dt>
        <dd>
          はい、設置後の操作説明から、機器の不具合・追加増設のご相談まで対応しています。<br>
          「映像が映らなくなった」「録画がうまくできていない」といった<br>
          トラブルにも迅速に対応しますのでご安心ください。
        </dd>
      </dl>
    </div>
  </section>

  <section class="camera_area bg_skyblue sec" id="camera_area">
    <div class="container -md">
      <h2>
        <span>愛知県・岐阜県・三重県・静岡県</span>
        へ迅速に対応します
      </h2>
      <p>
        東海エリアに密着した防犯カメラ設置・販売の会社として、<br>
        愛知県・岐阜県・三重県・静岡県での現地調査・施工・アフターサポートを行っています。
      </p>
      <article>
        <span>愛知県</span>
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/area_01.jpg'); ?>" alt="愛知県の対応エリアイメージ" width="600" height="327" loading="lazy" decoding="async">
        <p>
          名古屋市・豊田市・岡崎市・一宮市・春日井市・<br class="is-hidden_sp">
          豊橋市・安城市・刈谷市・小牧市・半田市・<br class="is-hidden_sp">
          および愛知県内全域に対応しております。<br class="is-hidden_sp">
          製造業が盛んな豊田市・刈谷市・安城市のエリアの工場や倉庫、<br>
          名古屋市内の店舗・事務所からの<br class="is-hidden_sp">
          ご相談も多数いただいています。
        </p>
      </article>
      <article>
        <span>岐阜県</span>
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/area_02.jpg'); ?>" alt="岐阜県の対応エリアイメージ" width="600" height="327" loading="lazy" decoding="async">
        <p>
          岐阜県・大垣市・各務原市・多治見市・可児市・<br class="is-hidden_sp">
          関市・高山市・および岐阜県全域に<br class="is-hidden_sp">
          対応しています。<br>
          岐阜市・大垣市周辺の倉庫や工場、<br class="is-hidden_sp">
          山間部の建設現場・農地での<br class="is-hidden_sp">
          無電源監視のご相談も承っています。
        </p>
      </article>
      <article>
        <span>三重県</span>
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/area_03.jpg'); ?>" alt="三重県の対応エリアイメージ" width="600" height="327" loading="lazy" decoding="async">
        <p>
          四日市市・津市・鈴鹿市・桑名市・松阪市・<br class="is-hidden_sp">
          伊勢市・伊賀市、および三重県全域に<br class="is-hidden_sp">
          対応しています。<br>
          四日市市・鈴鹿市のコンビナート・<br class="is-hidden_sp">
          工場エリアや伊賀市・松阪市の農地・<br class="is-hidden_sp">
          建設現場での実績があります。
        </p>
      </article>
      <article>
        <span>静岡県</span>
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/area_04.jpg'); ?>" alt="静岡県の対応エリアイメージ" width="600" height="327" loading="lazy" decoding="async">
        <p>
          静岡市・浜松市・沼津市・富士市・焼津市・<br class="is-hidden_sp">
          藤枝市・磐田市・掛川市・三島市・<br class="is-hidden_sp">
          および静岡県全域に対応しています。<br>
          浜松市・磐田市の工場、富士市・焼津市の<br class="is-hidden_sp">
          倉庫・物流拠点からのご相談も対応しています。
        </p>
      </article>
    </div>
  </section>

</main>

<?php get_footer(); ?>