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

$default_seo_title = sprintf(
  '複合機のリース・購入・入れ替え | 愛知・岐阜・三重・静岡 | %s',
  $site_name
);

$default_description = sprintf(
  '愛知・岐阜・三重・静岡で法人向け複合機の新規導入・入れ替え・リース・購入なら%s。月間印刷枚数やA3利用、カウンター料金、保守内容を確認し、自社に合う機種と契約をご提案します。現地調査・見積もりは無料です。',
  $site_name
);

$seo_title = function_exists('ts_get_custom_seo_title') ? ts_get_custom_seo_title($post_id) : '';
if ('' === $seo_title) {
  $seo_title = $default_seo_title;
}

$service_description = function_exists('ts_get_custom_seo_description') ? ts_get_custom_seo_description($post_id) : '';
if ('' === $service_description) {
  $service_description = $default_description;
}

$GLOBALS['ts_meta_description_override'] = $service_description;

$service_schema_name = '法人向け複合機の導入・入れ替え・リース・購入';

$faq_items = [
  [
    'question' => '複合機とコピー機の違いは何ですか？',
    'answer'   => 'コピー機は主に紙の原稿を複写する機器ですが、複合機はコピーに加えて、プリント、スキャン、FAXなど複数の機能を1台で利用できるオフィス機器です。中小企業では、見積書・請求書・契約書・図面・社内資料などを扱う機会が多いため、コピーだけでなく印刷やスキャンまでまとめて使える複合機が選ばれるケースが多くあります。',
  ],
  [
    'question' => '複合機とプリンターの違いは何ですか？',
    'answer'   => 'プリンターは、パソコンやスマートフォンからデータを印刷することが主な役割です。一方、複合機は印刷だけでなく、コピー、スキャン、FAX、A3印刷、ネットワーク共有など、法人利用に必要な機能をまとめて使える点が特徴です。印刷枚数が多い会社や、複数人で共有して使う事務所では、家庭用・小型プリンターよりも複合機の方が業務に合う場合があります。',
  ],
  [
    'question' => '複合機は購入とリースのどちらがよいですか？',
    'answer'   => '購入は初期費用が必要ですが、機器を所有でき、長く使うほど総支払額を抑えやすい方法です。リースは初期費用を抑えて月額費用を平準化しやすい一方、原則として契約途中で解約できません。機種、本体構成、契約期間、カウンター料金、保守内容を含めた総コストで比較することが大切です。',
  ],
  [
    'question' => '卓上複合機と床置き複合機の違いは何ですか？',
    'answer'   => '卓上複合機は、設置スペースを抑えやすく、A4中心の業務や小規模オフィスに向いています。床置き複合機は、A3対応、大容量給紙、印刷速度、複数人での共有利用などに強く、事務所全体で使う場合に向いています。A3を使うか、月間印刷枚数がどの程度あるか、設置スペースに余裕があるかによって選び方が変わります。',
  ],
  [
    'question' => '複合機の設置や初期設定も相談できますか？',
    'answer'   => 'はい、複合機の搬入・設置・初期設定までご相談いただけます。設置場所の確認、ネットワーク接続、プリンター設定、スキャン設定など、業務で使い始めるために必要な内容を確認しながら進めます。対応内容は機種や契約条件によって異なるため、事前にお見積もり時にご案内します。',
  ],
  [
    'question' => '保守や故障時の対応もありますか？',
    'answer'   => '複合機は導入後の保守内容も重要です。トナー、部品交換、故障時の対応、メンテナンス範囲などは契約内容によって異なります。導入前に保守条件を確認することで、運用開始後のトラブルや想定外の費用を防ぎやすくなります。',
  ],
  [
    'question' => 'まだ導入するか決まっていなくても相談できますか？',
    'answer'   => 'はい、検討段階でもご相談いただけます。「複合機が必要か判断したい」「リース料金の目安を知りたい」「今の費用が高いのか確認したい」「A3対応機と卓上型で迷っている」といった段階でも問題ありません。現在の状況をお聞きしたうえで、無理のない導入方法をご案内します。',
  ],
];

$has_seo_plugin = function_exists('ts_is_major_seo_plugin_active')
  ? ts_is_major_seo_plugin_active()
  : (
    defined('WPSEO_VERSION') ||
    defined('RANK_MATH_VERSION') ||
    defined('AIOSEO_VERSION') ||
    defined('SEOPRESS_VERSION') ||
    defined('SLIM_SEO_VERSION') ||
    class_exists('The_SEO_Framework\Load') ||
    function_exists('rank_math')
  );

//タイトルタグの差し替え
if (!$has_seo_plugin) {
  add_filter('pre_get_document_title', function ($document_title) use ($seo_title) {
    if (is_singular('service')) {
      return $seo_title;
    }
    return $document_title;
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
    $faq_id        = $service_url . '#faq';

    $service_schema = [
      '@type'       => 'Service',
      '@id'         => $service_id,
      'name'        => $service_schema_name,
      'serviceType' => $service_schema_name,
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

    $faq_schema = [
      '@type'      => 'FAQPage',
      '@id'        => $faq_id,
      'url'        => $service_url . '#hukugouki_qa',
      'name'       => '複合機の導入・リース・購入に関するよくある質問',
      'inLanguage' => 'ja-JP',
      'mainEntity' => array_map(function ($faq_item) {
        return [
          '@type'          => 'Question',
          'name'           => $faq_item['question'],
          'acceptedAnswer' => [
            '@type' => 'Answer',
            'text'  => $faq_item['answer'],
          ],
        ];
      }, $faq_items),
    ];

    $schema_graph = [$service_schema, $faq_schema];

    if (!$has_seo_plugin) {
      $provider_schema = function_exists('ts_get_local_business_schema')
        ? ts_get_local_business_schema()
        : [
          '@type' => 'LocalBusiness',
          '@id'   => $organization_id,
          'name'  => $site_name,
          'url'   => home_url('/'),
        ];

      $schema_graph = [
        $provider_schema,
        [
          '@type'     => 'WebSite',
          '@id'       => $website_id,
          'url'       => home_url('/'),
          'name'      => $site_name,
          'inLanguage' => 'ja-JP',
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
          'name'        => $service_schema_name,
          'description' => $service_description,
          'inLanguage'  => 'ja-JP',
          'isPartOf'    => [
            '@id' => $website_id,
          ],
          'breadcrumb'  => [
            '@id' => $breadcrumb_id,
          ],
          'mainEntity'  => [
            '@id' => $service_id,
          ],
          'hasPart'     => [
            '@id' => $faq_id,
          ],
        ],
        $service_schema,
        $faq_schema,
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

  <section class="camera_reason sec" id="hukugouki_reason">
    <div class="container -md">
      <h2 class="single_detail_page--ttl">
        選ばれる<span>4</span>つの理由
      </h2>
      <div class="container camera_reason--inner">
        <ol>
          <li>
            <h3>最適な複合機を提案</h3>
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/reason_02.png'); ?>" alt="利用状況に合った複合機提案のイメージ" width="240" height="240" loading="lazy" decoding="async">
            <p>
              複合機は、会社の規模や印刷枚数、A3利用の有無、設置スペースによって最適な機種が変わります。<br>
              必要以上に高い機種をすすめるのではなく、現在の利用状況やご希望を確認したうえで、中小企業に合った複合機をご提案します。
            </p>
          </li>
          <li>
            <h3>リース・購入をまとめて相談</h3>
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/reason_03.png'); ?>" alt="複合機のリース・購入相談のイメージ" width="240" height="240" loading="lazy" decoding="async">
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
              複合機の費用は、本体価格や月額リース料だけでなく、カウンター料金、保守料金、消耗品まで含めて判断する必要があります。<br>
              現在の契約内容と月間印刷枚数、カラー比率などを整理し、必要な機能を確保しながら総コストを見直します。<br>
              過剰なスペックや使っていないオプションを省き、無駄の少ない導入プランをご提案します。
            </p>
          </li>
          <li>
            <h3>愛知・岐阜・三重・静岡に対応</h3>
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/reason_01.png'); ?>" alt="東海4県への複合機導入対応のイメージ" width="240" height="240" loading="lazy" decoding="async">
            <p>
              愛知県・岐阜県・三重県・静岡県の中小企業様向けに、複合機の新規導入・リース・購入・コスト見直しのご相談に対応しています。<br>
              事務所、店舗、工場、士業事務所など、利用環境に合わせて、導入前の機種選定から費用の確認までご相談いただけます。
            </p>
          </li>
        </ol>
      </div>
    </div>
  </section>

  <section class="camera_assignment hukugouki_assignment sec" id="hukugouki_assignment">
    <div class="container -md">
      <div class="u-txt_center">
        <h2 class="single_detail_page--ttl -double">
          現場の課題を解決する<br>
          <span>3</span>つの提案
        </h2>
      </div>
      <article>
        <h3>
          SHARP BP-61C26
        </h3>
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/assignment_01_huugouki.jpg'); ?>" alt="SHARP BP-61C26 A3カラー複合機" width="600" height="327" loading="lazy" decoding="async">
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
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/assignment_02_huugouki.jpg'); ?>" alt="KYOCERA TASKalfa MZ2501ci A3カラー複合機" width="600" height="327" loading="lazy" decoding="async">
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
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/assignment_03_huugouki.jpg'); ?>" alt="省スペース型の卓上複合機" width="600" height="327" loading="lazy" decoding="async">
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

  <section class="camera_introduction hukugouki_introduction bg_blue">
    <div class="camera_introduction--inner hukugouki_introduction--inner">
      <h2>自社に合う複合機は、使い方によって変わります</h2>
      <p>
        複合機選びで大切なのは、人気機種をそのまま選ぶことではありません。<br>
        月間の印刷枚数、A3利用の有無、カラー印刷の頻度、設置スペース、スキャン・FAXの利用状況によって、<br class="is-hidden_sp">最適な機種は変わります。<br>
        当社では、愛知県・岐阜県・三重県・静岡県の中小企業様向けに、<br class="is-hidden_sp">複合機の新規導入・リース・購入・コスト見直しのご相談に対応しています。<br>
        現在の利用状況をお聞きしたうえで、必要以上に高い機種を選ばない、<br class="is-hidden_sp">現場に合った複合機をご提案します。
      </p>
    </div>
  </section>

  <section class="camera_construction sec" id="hukugouki_construction">
    <div class="container -md">
      <h2>複合機の導入事例</h2>
      <p>
        複合機の新規導入・入れ替え・リース・コスト見直しのご相談に対応しています。<br>
        事務所の規模、印刷枚数、A3利用の有無、設置スペース、保守条件などを確認したうえで、<br class="is-hidden_sp">
        現場に合った複合機をご提案しています。
      </p>
      <article>
        <h3>製造業の事務所にA3カラー複合機を導入</h3>
        <div class="camera_construction--inner">
          <dl>
            <dt>愛知県名古屋市 自動車部品工場様</dt>
            <dd>
              自動車部品工場のお客様では、見積書・納品書・図面・検査書類など、
              日常的に紙資料を扱う場面が多く、既存のプリンターではA3資料の
              印刷やスキャンに対応しづらいことが課題でした。<br>
              月間の印刷枚数やA3利用の頻度、設置スペースを確認したうえで、
              A3対応のカラー複合機をご提案。<br>
              導入後は、コピー・プリント・スキャンを1台に集約でき、
              図面や社内資料の出力、書類共有がスムーズになりました。
            </dd>
          </dl>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/construction_01_hukugouki.jpg'); ?>" alt="名古屋市の自動車部品工場に導入したA3カラー複合機" width="500" height="348" loading="lazy" decoding="async">
        </div>
      </article>
      <article>
        <h3>士業事務所の複合機コストを見直し</h3>
        <div class="camera_construction--inner">
          <dl>
            <dt>岐阜県岐阜市　税理士事務所様</dt>
            <dd>
              顧問先の資料、申告書類、契約書、控え書類などの印刷・コピーが
              日常的に発生していましたが、現在利用している複合機の
              月額リース料やカウンター料金が適正なのか判断しづらい状況でした。<br>
              印刷枚数、カラー利用の頻度、A3利用の有無、保守内容を
              確認したうえで、業務量に合った複合機プランをご提案。<br>
              導入後は、必要な機能を確保しながら、毎月の費用構造を見直す
              ことができました。
            </dd>
          </dl>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/construction_02_hukugouki.jpg'); ?>" alt="岐阜市の税理士事務所で複合機コストを見直した事例" width="500" height="348" loading="lazy" decoding="async">
        </div>
      </article>
      <article>
        <h3>建設業の事務所に図面対応のA3複合機を導入</h3>
        <div class="camera_construction--inner">
          <dl>
            <dt>三重県四日市市　建設会社様</dt>
            <dd>
              見積書・請求書・工程表・図面などを印刷する機会が多く、
              A3対応の複合機が必要でした。一方で、事務所スペースには限りが
              あり、設置場所や使いやすさも考慮する必要がありました。<br>
              業務内容、A3利用の頻度、図面出力の有無、設置スペースを確認し、
              日常業務で使いやすいA3カラー複合機をご提案。<br>
              導入後は、書類作成から図面の印刷・スキャンまでを社内で
              対応しやすくなり、事務作業の効率化につながりました。
            </dd>
          </dl>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/construction_03_hukugouki.jpg'); ?>" alt="四日市市の建設会社に導入した図面対応A3複合機" width="500" height="348" loading="lazy" decoding="async">
        </div>
      </article>
      <article>
        <h3>店舗兼事務所に省スペース型の複合機を導入</h3>
        <div class="camera_construction--inner">
          <dl>
            <dt>静岡県浜松市　店舗運営会社様</dt>
            <dd>
              請求書・納品書・販促資料・社内資料などの印刷は必要でしたが、
              A3印刷の頻度は少なく、床置きの大型複合機を導入すべきか
              迷われていました。設置スペース、月間印刷枚数、A3利用の有無、
              スキャン利用の頻度を確認したうえで、過剰なスペックにならない
              省スペース型の複合機をご提案。<br>
              導入後は、日常的な印刷・コピー・スキャン業務を無理なく
              行えるようになり、店舗兼事務所の限られたスペースでも使いやすい環境を整えることができました。
            </dd>
          </dl>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/construction_04_hukugouki.jpg'); ?>" alt="浜松市の店舗兼事務所に導入した省スペース型複合機" width="500" height="348" loading="lazy" decoding="async">
        </div>
      </article>
    </div>
  </section>

  <section class="camera_flow bg_gray sec" id="hukugouki_flow">
    <div class="container -md">
      <h2>お問い合わせから複合機導入までの流れ</h2>
      <p>
        複合機の新規導入・入れ替え・コスト見直しまで、専門知識がない方にもわかりやすくご案内します。<br>
        現在の利用状況やご希望を確認したうえで、<br class="is-hidden_sp">
        機種選定からお見積もり、設置・初期設定までスムーズに対応します。
      </p>
      <article>
        <p class="camera_flow--step">
          <span>STEP</span>
          01
        </p>
        <div class="camera_flow--inner">
          <h3>お問い合わせ・ご相談（無料）</h3>
          <p>
            まずは、お問い合わせフォームまたはお電話よりご相談ください。<br>
            「新しく複合機を導入したい」「今のリース料金を見直したい」「どの機種を選べばよいかわからない」など、検討段階でのご相談も可能です。<br>
            複合機の購入・リース・入れ替えに関するご相談を承っています。
          </p>
        </div>
      </article>
      <article>
        <p class="camera_flow--step">
          <span>STEP</span>
          02
        </p>
        <div class="camera_flow--inner">
          <h3>ヒアリング・機種選定</h3>
          <p>
            現在の印刷枚数、A3利用の有無、カラー印刷の頻度、設置スペース、FAX・スキャンの利用状況などを確認します。<br>
            そのうえで、必要以上に高い機種を選ばないよう、業務内容に合った複合機をご提案します。<br>
            A3対応の床置き複合機、省スペース型の卓上複合機、コスト重視のリースプランなど、利用環境に合わせて候補を整理します。
          </p>
        </div>
      </article>
      <article>
        <p class="camera_flow--step">
          <span>STEP</span>
          03
        </p>
        <div class="camera_flow--inner">
          <h3>お見積もり・ご契約</h3>
          <p>
            ヒアリング内容をもとに、機種構成・リース料金・購入費用・保守内容などを含めたお見積もりをご案内します。月額費用だけでなく、カウンター料金や保守条件も含めて確認できるため、導入後の費用感を把握しやすくなります。内容にご納得いただいたうえで、リース契約または購入手続きを進めます。
          </p>
        </div>
      </article>
      <article>
        <p class="camera_flow--step">
          <span>STEP</span>
          04
        </p>
        <div class="camera_flow--inner">
          <h3>搬入・設置・初期設定</h3>
          <p>
            ご契約後、設置日程を調整し、複合機の搬入・設置を行います。<br>
            設置場所の確認、ネットワーク接続、プリンター設定、スキャン設定など、業務で使い始めるために必要な初期設定まで対応します。<br>
            設置後は、基本的な使い方や注意点をご案内し、スムーズに運用を開始できるようサポートします。
          </p>
        </div>
      </article>
    </div>
  </section>

  <section class="camera_qa sec" id="hukugouki_qa">
    <div class="container -md">
      <h2>よくある質問</h2>
      <p>
        お問い合わせ前に気になる点を、まとめてお答えします。<br>
        ご不明な点は、お気軽にお問い合わせください。
      </p>
      <dl>
        <?php foreach ($faq_items as $faq_item) : ?>
          <dt><?php echo esc_html($faq_item['question']); ?></dt>
          <dd><?php echo esc_html($faq_item['answer']); ?></dd>
        <?php endforeach; ?>
      </dl>
    </div>
  </section>

  <section class="camera_area bg_skyblue sec" id="hukugouki_area">
    <div class="container -md">
      <h2>
        <span>愛知県・岐阜県・三重県・静岡県</span>
        へ迅速に対応します
      </h2>
      <p>
        東海エリアに密着した法人向け複合機の導入・入れ替え支援会社として、<br>
        愛知県・岐阜県・三重県・静岡県で機種選定、見積もり、設置・初期設定、導入後の保守相談まで対応しています。
      </p>
      <article>
        <span>愛知県</span>
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/area_01_hukugouki.jpg'); ?>" alt="愛知県の対応エリアイメージ" width="600" height="360" loading="lazy" decoding="async">
        <p>
          名古屋市をはじめ、豊田市、岡崎市、一宮市、豊橋市、春日井市など、<br class="is-hidden_sp">
          事務所・店舗・工場・士業事務所など幅広い業種でご相談いただけます。<br>
          製造業や自動車関連企業、営業所、店舗運営会社など、<br class="is-hidden_sp">
          紙資料やA3書類を扱う機会が多い企業様には、<br class="is-hidden_sp">
          利用状況に合わせたA3対応複合機をご提案可能です。<br>
          月間印刷枚数、カラー印刷の頻度、設置スペース、<br class="is-hidden_sp">
          現在のリース料金などを確認したうえで、<br class="is-hidden_sp">
          必要以上に高い機種を選ばない導入プランをご案内します。
        </p>
      </article>
      <article>
        <span>岐阜県</span>
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/area_02_hukugouki.jpg'); ?>" alt="岐阜県の対応エリアイメージ" width="600" height="360" loading="lazy" decoding="async">
        <p>
          岐阜市、大垣市、各務原市、多治見市、可児市など、<br class="is-hidden_sp">
          事務所・工場・士業事務所・店舗などの利用環境に合わせてご提案します。<br>
          「今の複合機コストが適正かわからない」「A3対応機が必要か判断したい」<br class="is-hidden_sp">
          「リースと購入のどちらがよいか知りたい」といった段階でもご相談可能です。<br>
          印刷枚数や利用人数、スキャン・FAXの使用状況を確認し、<br class="is-hidden_sp">
          業務に合った複合機選びをサポートします。
        </p>
      </article>
      <article>
        <span>三重県</span>
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/area_03_hukugouki.jpg'); ?>" alt="三重県の対応エリアイメージ" width="600" height="360" loading="lazy" decoding="async">
        <p>
          津市、四日市市、鈴鹿市、桑名市、松阪市など、<br class="is-hidden_sp">
          建設会社、製造業、店舗、事務所など、業種や設置環境に合わせたご提案が可能です。<br>
          図面や資料の印刷が多い企業様にはA3対応複合機を、<br class="is-hidden_sp">
          A4中心で設置スペースを抑えたい企業様には省スペース型の複合機をご提案します。<br>
          導入前に、月額費用・カウンター料金・保守内容・設置場所を整理し、<br class="is-hidden_sp">
          無理のない複合機導入をサポートします。
        </p>
      </article>
      <article>
        <span>静岡県</span>
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/area_04_hukugouki.jpg'); ?>" alt="静岡県の対応エリアイメージ" width="600" height="360" loading="lazy" decoding="async">
        <p>
          静岡市、浜松市、沼津市、富士市、磐田市など、<br class="is-hidden_sp">
          事務所・店舗・工場・営業所など、さまざまな利用環境に合わせてご案内します。<br>
          新規開設の事務所や、現在利用中の複合機の費用を見直したい企業様にも対応可能です。
          A3利用の有無、月間印刷枚数、カラー印刷の頻度、設置スペースなどを確認し、<br class="is-hidden_sp">
          自社に合った複合機の機種選定からお見積もりまでサポートします。
        </p>
      </article>
    </div>
  </section>

</main>

<?php get_footer(); ?>
