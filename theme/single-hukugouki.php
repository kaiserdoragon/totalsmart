<?php
/*
Template Name: 複合機
Template Post Type:service
*/

/*
タイトルタグ・メタディスクリプションなどは「header-service.php」を参照
*/

$title     = 'サービス';
$post_id   = get_queried_object_id();
$site_name = get_bloginfo('name');

$service_title       = $post_id ? get_the_title($post_id) : '複合機';
$service_url         = $post_id ? get_permalink($post_id) : home_url('/');
$service_archive_url = get_post_type_archive_link('service') ?: home_url('/service/');
$service_image_url   = $post_id && has_post_thumbnail($post_id)
  ? get_the_post_thumbnail_url($post_id, 'full')
  : '';
$post_slug = $post_id ? get_post_field('post_name', $post_id) : 'service';

$raw_excerpt = $post_id ? get_the_excerpt($post_id) : '';
$raw_content = $post_id ? get_post_field('post_content', $post_id) : '';

$default_description = sprintf(
  '%sの設置・工事なら%s。愛知・岐阜・三重・静岡に対応し、現地調査・見積り無料。既存配線を活かした更新や無電源現場の遠隔監視にも対応します。',
  $service_title ?: '複合機',
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

//タイトルタグ生成
$seo_title = sprintf(
  '%sの設置・工事 | %s',
  $service_title ?: '複合機',
  $site_name
);

$has_seo_plugin = (
  defined('WPSEO_VERSION') ||
  defined('RANK_MATH_VERSION') ||
  defined('AIOSEO_VERSION') ||
  defined('SEOPRESS_VERSION')
);

//タイトルタグの差し替え
if (!$has_seo_plugin) {
  add_filter('pre_get_document_title', function ($document_title) use ($seo_title) {
    if (is_singular('service')) {
      return $seo_title;
    }
    return $document_title;
  }, 20);

  add_action('wp_head', function () {
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
    $organization_id = home_url('/') . '#localbusiness';
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
        <p class="camera_mv--lead">複合機の新規導入・コスト見直しを検討中の中小企業様</p>
        <h1 class="camera_mv--ttl">
          <span class="camera_mv--txt"><span class="camera_mv--strong">複合機</span>の見直しで</span>
          <span class="camera_mv--txt"><span class="camera_mv--strong">コスト</span>や<span class="camera_mv--strong">無駄</span>を削減！</span>
        </h1>
        <p class="camera_mv--supplement">複合機の購入・リース・入れ替え相談に対応<br>最適な導入プランをご提案します</p>
        <ul>
          <li>毎月の固定コストを<br><span>しっかり削減</span></li>
          <li>無駄のない契約内容へ<br><span>最適化</span></li>
          <li><span>日々の業務ロスを</span><br>大幅に改善</li>
          <li>複合機のコストを<br><span>明確に見える化</span></li>
        </ul>
      </div>
      <div class="camera_mv--image">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/mv_catch_hukugouki.png'); ?>" alt="複合機の見直しサービスのイメージ" width="667" height="490" loading="eager" fetchpriority="high" decoding="async">
      </div>
    </div>
    <img class="camera_mv--bg" src="<?php echo esc_url(get_template_directory_uri() . '/img/service/mv_bg.jpg'); ?>" alt="" width="1920" height="750" loading="eager" fetchpriority="high" decoding="async">
  </section>

  <section class="camera_lead hukugouki_lead">
    <div class="container -md">
      <h2>
        複合機の見直し・導入で<br>
        このような<span>お悩み</span>はありませんか？
      </h2>
      <ul>
        <li>毎月のリース料金や印刷の<span>料金が高い気がする</span></li>
        <li><span>購入・リース・レンタル</span>のどれを選べばいいのかわからない</li>
        <li>自社に合う<span>機種がわからない</span></li>
        <li>故障時やトナー交換など<span>保守対応が不安</span></li>
        <li><span>紙書類の管理やスキャン業務</span>を効率化したい</li>
      </ul>
      <p>
        複合機は、単に安い機種を選べばよいわけではありません。<br>
        月間の印刷枚数、A3利用の有無、カラー比率、設置スペース、保守内容まで含めて、
        自社に合った機種と契約方法を選ぶことが重要です。
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
            <h3>最適な複合機を提案</h3>
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/reason_02.png'); ?>" alt="地域密着・迅速対応のイメージ" width="240" height="240" loading="lazy" decoding="async">
            <p>
              複合機は、会社の規模や印刷枚数、A3利用の有無、設置スペースによって最適な機種が変わります。<br>
              必要以上に高い機種をすすめるのではなく、現在の利用状況やご希望を確認したうえで、中小企業に合った複合機をご提案します。
            </p>
          </li>
          <li>
            <h3>リース・購入をまとめて相談</h3>
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/reason_03.png'); ?>" alt="現場課題に合わせた提案のイメージ" width="240" height="240" loading="lazy" decoding="async">
            <p>
              現在利用中の複合機のコスト見直しにも対応しています。<br>
              月額リース料、カウンター料金、保守内容、機種スペックなどを整理し、無駄なコストが発生していないか確認できます。
              リースと購入のどちらがよいか迷っている場合も、導入条件に合わせて比較できます。
            </p>
          </li>
          <li>
            <h3>圧倒的なコスト最適化</h3>
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/reason_04.png'); ?>" alt="コスト最適化のイメージ" width="240" height="240" loading="lazy" decoding="async">
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
            <h3>愛知・岐阜・三重・静岡に対応</h3>
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/reason_01.png'); ?>" alt="使いやすさを考えた提案のイメージ" width="240" height="240" loading="lazy" decoding="async">
            <p>
              愛知県・岐阜県・三重県・静岡県の中小企業様向けに、複合機の新規導入・リース・購入・コスト見直しのご相談に対応しています。<br>
              事務所、店舗、工場、士業事務所など、利用環境に合わせて、導入前の機種選定から費用の確認までご相談いただけます。
            </p>
          </li>
        </ol>
      </div>
    </div>
  </section>

  <section class="camera_assignment hukugouki_assignment sec" id="camera_assignment">
    <div class="container -md">
      <div class="u-txt_center">
        <h2 class="single_detail_page--ttl -double">
          現場の課題を解決する<br>
          <span>3</span>つの課題
        </h2>
      </div>
      <article>
        <h3>
          SHARP BP-61C26
        </h3>
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/assignment_01_huugouki.jpg'); ?>" alt="AIネットワークカメラの導入イメージ" width="600" height="327" loading="lazy" decoding="async">
        <div class="camera_assignment--inner">
          <h4>標準的なA3カラー複合機を導入したい企業へ</h4>
          <ul>
            <li>A3サイズの印刷やコピーを使う</li>
            <li>標準的で使いやすい複合機を選びたい</li>
            <li>コストと性能のバランスを重視したい</li>
          </ul>
          <p>
            「A3も使いたい」「カラー印刷も必要」「でも必要以上に高い機種は避けたい」<br>
            そのような場合には「SHARP BP-61C26」です。<br>
            <br>
            BP-61C26は、A4ヨコで1分間に26枚のコピー・プリントに<br class="is-hidden_sp">対応したA3カラー複合機です。<br>
            日常的な見積書、請求書、契約書、社内資料、図面、提案資料など、<br class="is-hidden_sp">幅広いオフィス業務に対応できます。<br>
            印刷速度が高い上位機種もありますが、一般的な中小企業では、<br class="is-hidden_sp">必要以上に高速な機種を選ぶよりも、利用頻度と月額コストの<br class="is-hidden_sp">バランスを重視することが重要です。
          </p>
        </div>
      </article>
      <article>
        <h3>
          KYOCERA TASKalfa MZ2501ci
        </h3>
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/assignment_02_huugouki.jpg'); ?>" alt="同軸ケーブル流用による5M AHDカメラ更新のイメージ" width="600" height="327" loading="lazy" decoding="async">
        <div class="camera_assignment--inner">
          <h4>クラウド連携・文書管理・DXを進めたい企業へ</h4>
          <ul>
            <li>紙書類をPDF化して管理したい</li>
            <li>経理・総務・事務作業を効率化したい</li>
            <li>クラウド保存や文書共有を活用したい</li>
          </ul>
          <p>
            「紙書類をデータ化したい」「スキャンした書類をクラウドで管理したい」<br>「文書管理や業務効率化も考えたい」<br class="is-hidden_sp">そのような企業には「KYOCERA TASKalfa MZ2501ci」です。<br>
            TASKalfa MZ2501ciは、A3対応のカラー複合機として、<br class="is-hidden_sp">コピー・プリント・スキャン・FAX業務に対応できます。<br>
            さらに、クラウド連携や文書管理、スキャンデータの活用など、<br class="is-hidden_sp">紙文書を扱う業務の効率化にもつなげやすい機種です。<br>
            経理書類、請求書、契約書、社内申請書、図面、顧客資料などを<br class="is-hidden_sp">紙のまま管理している企業では、<br class="is-hidden_sp">複合機の見直しをきっかけに、<br class="is-hidden_sp">スキャン・保存・共有の流れを整えることができます。<br>
          </p>
        </div>
      </article>
      <article>
        <h3>
          卓上複合機
        </h3>
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/assignment_03_huugouki.jpg'); ?>" alt="MOBITY BOXによる遠隔監視のイメージ" width="600" height="327" loading="lazy" decoding="async">
        <div class="camera_assignment--inner">
          <h4>A3を使わない・設置スペースを抑えたい企業へ</h4>
          <ul>
            <li>A4中心の印刷・コピーで足りる</li>
            <li>事務所や店舗のスペースが限られている</li>
            <li>月額コストをできるだけ抑えたい</li>
          </ul>
          <p>
            「A3はほとんど使わない」「事務所が狭い」「床置きの大型複合機までは必要ない」<br>
            そのような企業には、卓上複合機が向いている場合があります。<br>
            複合機というと大型の床置きタイプをイメージされることが多いですが、<br class="is-hidden_sp">
            すべての企業にA3対応機が必要なわけではありません。<br>
            A4中心の印刷・コピー・スキャンで十分な場合は、<br class="is-hidden_sp">
            卓上型を選ぶことで設置スペースを抑えながら、必要な機能を確保できます。<br>
            小規模な事務所、店舗、士業事務所、開業直後の法人などでは、<br class="is-hidden_sp">
            床置き複合機ではなく、卓上複合機の方が現場に合うケースもあります。
          </p>
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