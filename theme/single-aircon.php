<?php
/*
Template Name: 業務用エアコン
Template Post Type:service
*/

/*
タイトルタグ・メタディスクリプションなどは「header-service.php」を参照
*/

$title     = 'サービス';
$post_id   = get_queried_object_id();
$site_name = get_bloginfo('name');

$service_title       = $post_id ? get_the_title($post_id) : '業務用エアコン';
$service_url         = $post_id ? get_permalink($post_id) : home_url('/');
$service_archive_url = get_post_type_archive_link('service') ?: home_url('/service/');
$service_image_url   = $post_id && has_post_thumbnail($post_id)
  ? get_the_post_thumbnail_url($post_id, 'full')
  : '';
$post_slug = $post_id ? get_post_field('post_name', $post_id) : 'service';

$raw_excerpt = $post_id ? get_the_excerpt($post_id) : '';
$raw_content = $post_id ? get_post_field('post_content', $post_id) : '';

$default_description = sprintf(
  '%sのクリーニング・修理・取付なら%s。愛知・岐阜・三重・静岡に対応し、業務用エアコンのクリーニング・修理・取付のサービスを行っています。',
  $service_title ?: '業務用エアコン',
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
  '%sのクリーニング・修理・取付 | %s',
  $service_title ?: '業務用エアコン',
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

  <section class="camera_mv aircon_mv">
    <div class="camera_mv--contents container -lg">
      <div class="camera_mv--block">
        <span class="camera_mv--area">愛知・岐阜・三重・静岡対応</span>
        <p class="camera_mv--lead">業務用エアコンのトラブルをまとめて対応いたします。</p>
        <h1 class="camera_mv--ttl">
          <span class="camera_mv--txt"><span class="camera_mv--strong">業務用エアコン</span>のクリーニング</span>
          <span class="camera_mv--txt">修理・取付を全て解決！！</span>
        </h1>
        <p class="camera_mv--supplement">
          店舗・オフィスなど環境に合わせて、<br>
          修理・洗浄・点検まで最適な方法をご提案
        </p>
        <ul>
          <li>出張費・お見積り<br><span>無料</span></li>
          <li>損害賠償保険<br>すべて<span>加入済み</span></li>
          <li>明朗会計<br><span>追加料金なし</span></li>
          <li><span>業界最安値</span><br>低価格</li>
        </ul>
      </div>
      <div class="camera_mv--image">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/mv_catch_aircon.png'); ?>" alt="業務用エアコン" width="517" height="635" loading="eager" fetchpriority="high" decoding="async">
      </div>
    </div>
    <img class="camera_mv--bg" src="<?php echo esc_url(get_template_directory_uri() . '/img/service/mv_bg.jpg'); ?>" alt="" width="1920" height="750" loading="eager" fetchpriority="high" decoding="async">
  </section>

  <section class="aircon_lead sec bg_darkblue">
    <div class="container -lg">
      <h2 class="aircon_lead--ttl">
        業務用エアコンで<br>
        このような<b><span>お</span><span>悩</span><span>み</span></b>はありませんか？？
      </h2>
      <p class="aircon_lead--txt">
        業務用エアコンの不調は、クリーニングで改善する場合と<br class="is-hidden_sp">
        修理が必要な場合とがあります。<br>
        現在の症状に近いものをご確認ください。<br>
      </p>
      <div class="aircon_lead--select tab_change_smooth">
        <ul class="tab_change--list" role="tablist">
          <li class="tab_change--item -selected" data-id="tab-1" id="tab-label-1" role="tab" aria-controls="tab-1" aria-selected="true" tabindex="0">
            クリーニングが<br>必要な場合
          </li>
          <li class="tab_change--item" data-id="tab-2" id="tab-label-2" role="tab" aria-controls="tab-2" aria-selected="false" tabindex="-1">
            修理が<br>必要な場合
          </li>
        </ul>
        <div class="aircon_lead--catch">
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/aircon_lead_catch.png'); ?>" alt="業務用エアコン" width="562" height="351" loading="eager" fetchpriority="high" decoding="async">
        </div>
        <div class="tab_change--content -show" id="tab-1" role="tabpanel" aria-labelledby="tab-label-1" tabindex="0">
          <section class="aircon_lead--inner">
            <h3>クリーニングが必要な場合</h3>
            <p>
              内部の汚れやカビ、ホコリ詰まりが原因のことがあります。<br>
              分解洗浄によって風量・ニオイ・効きの改善が期待できます。
            </p>
            <ul>
              <li>カビ臭い、嫌なニオイがする</li>
              <li>吹き出し口に黒い汚れが見える</li>
              <li>効きが悪くなった気がする</li>
              <li>電気代が上がった</li>
              <li>送風が弱い</li>
              <li>衛生面が気になる</li>
            </ul>
          </section>
        </div>
        <div class="tab_change--content" id="tab-2" role="tabpanel" aria-labelledby="tab-label-2" tabindex="0">
          <section class="aircon_lead--inner">
            <h3>修理が必要な場合</h3>
            <p>
              部品不良や機器トラブルの可能性があります。<br>
              早めの点検・修理で損失を最小限に抑えます。
            </p>
            <ul>
              <li>電源が入らない</li>
              <li>冷えない、暖まらない</li>
              <li>水漏れしている</li>
              <li>異音がする</li>
              <li>室外機が動かない</li>
              <li>室外機が動かない</li>
            </ul>
          </section>
        </div>
      </div>
    </div>
  </section>

  <section class="aircon_middle bg_gray">
    <div class="container">
      <h2>
        「クリーニング」か「修理」か<br>
        分からない場合もご相談ください
      </h2>
      <p>
        故障なのか、内部の汚れが原因なのかは、<br class="is-hidden_sp">
        見た目だけでは判断しづらいことも少なくありません。<br>
        弊社では修理とクリーニングの両方に対応しているため、<br class="is-hidden_sp">
        <span>現地の状態を確認したうえで最適な方法をご案内できます。</span><br>
      </p>
    </div>
  </section>

  <section class="aircon_solution sec">
    <div class="container">
      <div class="u-txt_center">
        <h2 class="aircon_solution--ttl">
          <span>業務用エアコン</span>の<br>
          クリーニング・修理をまとめて対応します
        </h2>
      </div>
      <p class="aircon_solution--lead">
        業務用エアコンの「クリーニング」と「修理」の両方に対応しています。<br>
        不具合を直すだけでなく、汚れやニオイ、<br class="is-hidden_sp">
        効率低下まで含めて総合的にサポートできるのが強みです。<br>
        「とりあえず見てほしい」「原因がわからない」という段階でも問題ありません。<br>
        症状や設置状況を確認し、修理・クリーニングのどちらが適しているか、<br class="is-hidden_sp">
        わかりやすくご説明いたします。
      </p>
      <div class="aircon_solution--box">
        <div class="aircon_solution--item">
          <h3>業務用エアコンクリーニング</h3>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/solution_01_aircon.png'); ?>" alt="" width="355" height="294" loading="lazy" decoding="async">
          <p>
            冷暖房が効かない、水漏れする、
            異音がする、電源が入らないなど、
            営業や業務に支障が出る
            不具合に対応いたします。<br>
            急なトラブルにもできる限り
            迅速に対応し、原因を確認したうえで
            必要な修理内容をご案内します。
          </p>
          <a href="">
            クリーニングについて詳しく見る
          </a>
        </div>
        <div class="aircon_solution--item -orange">
          <h3>業務用エアコン修理</h3>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/solution_02_aircon.png'); ?>" alt="" width="355" height="294" loading="lazy" decoding="async">
          <p>
            業務用エアコンの内部には、
            ホコリ、カビ、油分などが
            蓄積しやすく、ニオイや効きの悪さ、
            衛生面の不安につながります。<br>
            分解洗浄によって内部まで
            しっかり清掃し、快適で清潔な
            空調環境へ整えます。
          </p>
          <a href="">
            修理について詳しく見る
          </a>
        </div>
      </div>
    </div>
  </section>

  <section class="aircon_symptoms sec bg_skyblue">
    <div class="container">
      <h2 class="aircon_symptoms--ttl">
        業務用エアコンクリーニングで<br>
        改善が期待できる症状
      </h2>
      <p>
        汚れが蓄積した業務用エアコンは、見た目だけでなく、空気環境や冷暖房効率にも影響します。<br>
        定期的なクリーニングによって、快適性の維持と設備負担の軽減が期待できます。
      </p>
      <div class="aircon_symptoms--contents">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/symptoms_01.png'); ?>" alt="" width="240" height="240" loading="lazy" decoding="async">
        <div>
          <h3>カビ臭い・嫌なニオイがする</h3>
          <p>
            内部にたまったカビや汚れが、ニオイの原因になっている
            ことがあります。分解洗浄によって、ニオイの元にしっかり
            アプローチします。
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="camera_reason aircon_reason sec">
    <div class="container -md">
      <h2 class="single_detail_page--ttl">
        選ばれる<span>4</span>つの理由
      </h2>
      <p class="aircon_reason--lead">
        業務用エアコンは、故障時のスピードだけでなく、対応の丁寧さや提案の正確さも重要です。<br>
        多くのお客様にご相談いただいている理由をご紹介します。
      </p>
      <div class="container camera_reason--inner">
        <ol>
          <li>
            <h3>最短当日・即日対応</h3>
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/reason_01_aircon.png'); ?>" alt="最短当日・即日対応のイメージ" width="240" height="240" loading="lazy" decoding="async">
            <p>
              急な故障や、営業に支障が出る空調トラブルにも、
              できる限り迅速に対応します。緊急性の高いケース
              にも柔軟に対応し、現場の状況に合わせた判断で
              必要な処置を的確に行います。
            </p>
          </li>
          <li>
            <h3>クリーニングも修理も対応可</h3>
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/reason_02_aircon.png'); ?>" alt="クリーニングも修理も対応可のイメージ" width="240" height="240" loading="lazy" decoding="async">
            <p>
              エアコンのニオイやカビ、油汚れ、効きの悪さ
              といった日常的なお悩みから、異音、水漏れ、
              動作不良、部品の劣化による故障まで幅広く
              対応します。安心してお任せください。
            </p>
          </li>
          <li>
            <h3>明確な料金体系で安心</h3>
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/reason_03_aircon.png'); ?>" alt="明確な料金体系で安心のイメージ" width="240" height="240" loading="lazy" decoding="async">
            <p>
              当社では、作業内容と費用の目安を事前にわかりや
              すくご案内し、ご納得いただいたうえで進めること
              を大切にしています。費用面の不安を減らし、相談
              しやすさにもつなげています。
            </p>
          </li>
          <li>
            <h3>安全面・作業品質にも配慮</h3>
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/reason_04_aircon.png'); ?>" alt="安全面・作業品質にも配慮のイメージ" width="240" height="240" loading="lazy" decoding="async">
            <p>
              当社では、作業前の確認から養生、機器の取り扱い、
              周囲への配慮まで基本を徹底し、現場環境に合わせ
              て丁寧に対応します。作業後の確認まで責任を持って
              対応します。
            </p>
          </li>
        </ol>
      </div>
    </div>
  </section>

  <section class="camera_construction aircon_construction sec bg_gray">
    <div class="container">
      <h2>施工・導入実績</h2>
      <p>
        実際にご依頼いただいた事例の一部をご紹介します。<br>
        症状や現場環境に応じて、適切な方法で対応しています。
      </p>
      <article>
        <h3>カビのようなニオイが気になっていました</h3>
        <div class="camera_construction--inner">
          <dl>
            <dt>クリニック【業務用エアコンクリーニング】</dt>
            <dd>
              院内の嫌なニオイがするようになり、内部までは自分たちでは対応できず、衛生面でも不安がありました。<br>
              今回は内部の汚れが原因の可能性が高いと説明してもらえたので、安心してお願いしました。<br>
              作業後は気になっていたニオイがやわらぎ、空気環境がすっきりしたように感じました。<br>
              定期的なクリーニングは必要だと実感しました。<br>
            </dd>
          </dl>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/construction_01_aircon.jpg'); ?>" alt="" width="500" height="348" loading="lazy" decoding="async">
        </div>
      </article>
      <article>
        <h3>エアコンが急に冷えなくなりました</h3>
        <div class="camera_construction--inner">
          <dl>
            <dt>飲食店【業務用エアコン修理】</dt>
            <dd>
              店舗のエアコンが急に冷えにくくなり、店内の暑さが気になり始めていました。<br>
              修理で直るのかも分からず、一度見てもらいたいと思って相談しました。<br>
              実際に見てもらったところ、症状に合わせて必要な対応を説明してもらえたので、納得してお願いできました。<br>
              対応後はしっかり冷えるようになりました。
            </dd>
          </dl>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/construction_02_aircon.jpg'); ?>" alt="" width="500" height="348" loading="lazy" decoding="async">
        </div>
      </article>
      <article>
        <h3>吹き出し口の汚れが気になっていました</h3>
        <div class="camera_construction--inner">
          <dl>
            <dt>美容院【業務用エアコンクリーニング】</dt>
            <dd>
              郊外の仮設資材置き場で、夜間に銅線ケーブルなどの盗難被害が出ていました。<br>
              すぐに監視カメラを設置したかったものの、現場には100V電源もインターネット回線もなく、通常のカメラでは対応できない状態でした。<br>
              お問い合わせをしてから最短で現場まで来てもらって、その日のうちに稼働ができました。<br>
              スマートフォンからいつでも現地の状況を遠隔監視できるようになりました。<br>
              カメラの存在自体が強力な威嚇となり、導入以降は盗難被害が一切発生していません。
            </dd>
          </dl>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/construction_03_aircon.jpg'); ?>" alt="無電源現場での遠隔監視導入事例" width="500" height="348" loading="lazy" decoding="async">
        </div>
      </article>
      <article>
        <h3>天井からの水漏れがありました</h3>
        <div class="camera_construction--inner">
          <dl>
            <dt>事務所【業務用エアコン修理】</dt>
            <dd>
              エアコンから水漏れがあり、デスクや床に影響が出ないか心配していました。<br>
              業務にも影響しますし使い続けて大きなトラブルになったら困るという不安がありました。<br>
              すぐに相談したところ、状況を丁寧に確認してもらえたので、慌てずに対応を進めることができました。<br>
              対応後は水漏れの不安が解消され、通常通り使用できるようになりました。
            </dd>
          </dl>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/construction_04_aircon.jpg'); ?>" alt="" width="500" height="348" loading="lazy" decoding="async">
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