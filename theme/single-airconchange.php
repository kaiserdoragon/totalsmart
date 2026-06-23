<?php
/*
Template Name: 業務用エアコン交換・取り換え・買い替え
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

$default_seo_title = sprintf(
  '業務用エアコン交換・取り換え・買い替え | %s',
  $site_name
);

$default_description = sprintf(
  '愛知・岐阜・三重・静岡で業務用エアコンの交換・取り換え・買い替えなら%s。店舗・オフィス・工場・クリニックの老朽化、効きの悪さ、修理費の増加、省エネ更新を現地調査・無料見積りで確認します。',
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

$service_schema_name = sprintf(
  '%sの交換・取り換え・買い替え',
  $service_title ?: '業務用エアコン'
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

  add_action('wp_head', function () use ($service_url) {
    if (!is_singular('service')) {
      return;
    }
    echo '<link rel="canonical" href="' . esc_url($service_url) . '">' . "
";
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
      'name'        => $service_schema_name,
      'serviceType' => '業務用エアコン交換・業務用エアコン取り換え・業務用エアコン買い替え',
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
          'name'        => $service_schema_name,
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

  <section class="camera_mv aircon_mv airconchange_mv">
    <div class="camera_mv--contents">
      <div class="camera_mv--block">
        <span class="camera_mv--area">愛知・岐阜・三重・静岡対応</span>
        <p class="camera_mv--lead">店舗・オフィス・クリニック・施設など空調更新に対応。</p>
        <h1 class="camera_mv--ttl">
          <span class="camera_mv--txt"><span class="camera_mv--strong">業務用エアコン</span>の交換・買い替えから</span>
          <span class="camera_mv--txt">工事・設置まで一括で対応</span>
        </h1>
        <p class="camera_mv--supplement">
          交換、取り換え、入れ替え、既存機器の撤去、フロン回収、取付工事、試運転までまとめてご相談いただけます。
        </p>
        <ul>
          <li>出張費・お見積り<br><span>完全無料</span></li>
          <li>業務用エアコンの<br><span>導入・交換に対応</span></li>
          <li><span>導入・工事・撤去</span><br>まで一括相談</li>
          <li>メーカー問わず<br><span>相談可能</span></li>
        </ul>
      </div>
    </div>
    <picture>
      <source
        media="(max-width: 1024px)"
        srcset="<?php echo esc_url(get_template_directory_uri() . '/img/service/mv_bg.jpg'); ?>">

      <img
        class="airconchange_mv--bg"
        src="<?php echo esc_url(get_template_directory_uri() . '/img/service/mv_bg_airconchange.jpg'); ?>"
        alt=""
        width="1920"
        height="820"
        loading="eager"
        fetchpriority="high"
        decoding="async">
    </picture>
  </section>

  <section class="airconchange_lead sec">
    <div class="container -lg">
      <h2 class="airconchange_lead--ttl">
        業務用エアコンの<span>不</span><span>調</span>や<span>老</span><span>朽</span><span>化</span>を<br class="is-hidden_sp">
        そのままにしていませんか？？
      </h2>
      <p class="airconchange_lead--txt">
        業務用エアコンの不調や老朽化を放置すると、<br class="is-hidden_sp">
        電気代の増加、急な故障、店舗・施設の営業停止リスクにつながる場合があります。<br>
        愛知・岐阜・三重・静岡で、法人・店舗・施設の空調更新をご検討中の方は、<br class="is-hidden_sp">
        まずは現在の状況をお聞かせください。
      </p>
      <ul>
        <li>10年以上使用していて、交換時期か分からない</li>
        <li>冷えない・暖まらないなど、空調の効きが悪い</li>
        <li>電気代が高く、省エネ型に更新したい</li>
        <li>新店舗・新事務所・新施設に業務用エアコンを導入したい</li>
        <li>古い機器の撤去やフロン回収までまとめて相談したい</li>
        <li>購入・設置にかかる費用を知りたい</li>
      </ul>
    </div>
  </section>

  <section class="aircon_middle airconchange_middle bg_gray">
    <div class="container">
      <h2>
        ひとつでも当てはまる方は、<br class="is-hidden_sp">
        是非ごご相談ください！！
      </h2>
      <p>
        業務用エアコンの不調や老朽化は、<br class="is-hidden_sp">
        <span>放置すると急な故障や営業・業務への影響につながる場合があります。</span><br>
        まずは現在の機器の型番・設置写真・台数など、<br class="is-hidden_sp">
        分かる範囲の情報だけでもお知らせください。<br>
        交換が必要か、導入・更新の選択肢があるかを確認します。
      </p>
    </div>
  </section>

  <section class="aircon_solution airconchange_solution sec" id="airconchange_improvement">
    <div class="container">
      <div class="u-txt_center">
        <h2 class="aircon_solution--ttl">
          <span>業務用エアコン</span>の導入・交換を<br>
          機器選定から工事まで一括対応します
        </h2>
      </div>
      <p class="aircon_solution--lead">
        業務用エアコンの導入・交換では、本体価格だけでなく、<br class="is-hidden_sp">
        設置場所、馬力、台数、配管、室外機の位置・撤去、フロン回収、<br class="is-hidden_sp">
        工事日程まで確認する必要があります。<br>
        法人・店舗・施設の状況をヒアリングしたうえで、導入・交換に必要な内容をまとめてご提案します。
      </p>
      <div class="airconchange_solution--list">
        <article>
          <h3>現在の機器が<br><span>交換時期か確認</span></h3>
          <div>
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/aircon_solution_01.jpg'); ?>" alt="" width="250" height="250">
            <p>
              「まだ修理で使えるのか」<br>「そろそろ交換したほうがよいのか」<br>
              使用年数や故障状況、部品供給、設置環境によって判断が変わります。<br>
              現在の業務用エアコンの型番・使用年数を確認し、交換を検討すべき状態かどうかを整理します。
            </p>
          </div>
        </article>
        <article>
          <h3>施設用途に合わせた<br><span>機器選定</span></h3>
          <div>
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/aircon_solution_02.jpg'); ?>" alt="" width="250" height="250">
            <p>
              業務用エアコンは部屋の広さだけで選ぶと能力不足や過剰設備につながる場合があります。<br>
              店舗・オフィス・クリニック・介護施設など、施設の用途、稼働時間、<br class="is-hidden_sp">熱源、天井高、利用人数に合わせて、適切な機種や馬力をご提案します。
            </p>
          </div>
        </article>
        <article>
          <h3><span>販売から取付工事</span><br>まで対応</h3>
          <div>
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/aircon_solution_03.jpg'); ?>" alt="" width="250" height="250">
            <p>
              業務用エアコンの導入・交換では、本体の選定だけでなく、設置条件、配管、電源、室外機の位置、工事日程まで確認が必要です。
              機器の販売から取付工事、試運転までまとめてご相談いただけるため、複数の業者に個別で依頼する手間を抑えられます。
            </p>
          </div>
        </article>
        <article>
          <h3>既存機器の<span>撤去・</span><br><span>フロン回収</span>も相談可能</h3>
          <div>
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/aircon_solution_04.jpg'); ?>" alt="" width="250" height="250">
            <p>
              古い業務用エアコンを交換する際は、新しい機器の設置だけでなく、既存機器の撤去やフロン回収まわりの確認も必要です。<br>
              交換時に必要となる撤去・回収まわりも含めて、現在の状況に合わせてご相談いただけます。
            </p>
          </div>
        </article>
      </div>
    </div>
  </section>

  <section class="camera_reason airconchange_reason bg_skyblue sec" id="airconchange_reason">
    <div class="container -md">
      <h2 class="single_detail_page--ttl">
        選ばれる<span>6</span>つの理由
      </h2>
      <p class="airconchange_reason--lead">
        業務用エアコンは、施設の広さや用途、稼働時間、設置環境によって選ぶべき機種や工事内容が変わります。<br>
        そのため、単に本体を入れ替えるだけでなく、現場に合った機器選定と施工計画が重要です。<br>
        法人・店舗・施設の状況を丁寧に確認し、導入・交換・買い替えに必要な内容をまとめてサポートします。
      </p>
      <ol>
        <li>
          <h3>省エネ性能まで考えた機種選定</h3>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/airconchange_reason_01.jpg'); ?>" alt="" width="280" height="280" loading="lazy" decoding="async">
          <p>
            業務用エアコンは、同じ馬力でも省エネ性能や制御機能によって、長期的な電気代が変わります。安い機種を選ぶと、初期費用は抑えられても、毎月の電気代で損をする可能性があります。<br>
            使用時間、部屋の広さ、天井高、人数、熱源、業種、営業日数を確認し、過剰スペックにも能力不足にもならない機種をご提案します。<br>
            初期費用だけでなく、運用コストまで考えたサポートします。
          </p>
        </li>
        <li>
          <h3>総額が見える見積り</h3>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/airconchange_reason_02.jpg'); ?>" alt="" width="280" height="280" loading="lazy" decoding="async">
          <p>
            業務用エアコンの交換費用は、本体価格だけでは判断できません。撤去費、配管工事、電源工事、冷媒回収、搬入経路、室外機の設置条件によって総額が変わります。<br>
            現地状況を確認したうえで「本体費」「標準工事費」「撤去・処分費」「追加工事の可能性」を分けてご提示します。<br>
            あとから追加費用が膨らむ不安を抑え、納得して比較できる見積りを行います。
          </p>
        </li>
        <li>
          <h3>業種別に最適な空調を提案</h3>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/airconchange_reason_03.jpg'); ?>" alt="" width="280" height="280" loading="lazy" decoding="async">
          <p>
            飲食店、美容室、クリニック、事務所など空調に求められる条件が異なります。<br>
            飲食店では厨房熱や油汚れ、美容室では薬剤臭や温度ムラ、クリニックでは快適性と清潔感の配慮が必要です。<br>
            単に既存機器と同等品を入れ替えるだけでなく、業種・使用環境・お客様の動線・スタッフの作業環境に合わせて、最適なタイプと能力を選定します。
          </p>
        </li>
        <li>
          <h3>工事後の保証・アフター対応</h3>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/airconchange_reason_04.jpg'); ?>" alt="" width="280" height="280" loading="lazy" decoding="async">
          <p>
            業務用エアコンは、設置して終わりではありません。<br>
            長く安定して使うには、工事品質、試運転、保証、メンテナンス体制が重要です。<br>
            設置後に試運転を行い、冷暖房の効き、異音、排水、リモコン動作などを確認します。
            工事後の不具合やメンテナンスの相談にも対応し、長期的に安心して使える環境をサポートします。
          </p>
        </li>
        <li>
          <h3>リース・分割払いの相談ができる</h3>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/airconchange_reason_05.jpg'); ?>" alt="" width="280" height="280" loading="lazy" decoding="async">
          <p>
            業務用エアコンの交換は、まとまった初期費用がかかる設備投資です。<br>
            リース、分割払いなどを含めて検討することが重要です。<br>
            初期費用を抑えたい、月額化したいといったご相談にも対応します。<br>
            購入がよいのか、リースがよいのかも、使用年数や台数、会社の資金計画に合わせてご提案します。
          </p>
        </li>
        <li>
          <h3>回収・撤去・処分まで一括対応</h3>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/airconchange_reason_06.jpg'); ?>" alt="" width="280" height="280" loading="lazy" decoding="async">
          <p>
            業務用エアコンの撤去には、冷媒回収や適切な処分が関わります。<br>
            機器を外して終わりではなく、法令に沿った対応が必要です。<br>
            当社では既存機器の撤去、冷媒回収、搬出、処分、新しい機器の設置まで一括で対応します。
            複数業者を手配する手間を減らし、工事全体をスムーズに進めます。
          </p>
        </li>
      </ol>
    </div>
  </section>

  <section class="camera_construction aircon_construction sec bg_gray" id="airconchange_construction">
    <div class="container">
      <h2>施工・導入実績</h2>
      <p>
        実際にご依頼いただいた事例の一部をご紹介します。<br>
        症状や現場環境に応じて、適切な方法で対応しています。
      </p>
      <article>
        <h3>夏場のピーク前に、店内が冷えない不安を何とかしたかった</h3>
        <div class="camera_construction--inner">
          <dl>
            <dt>古い天井カセット形エアコンを交換</dt>
            <dd>
              特にランチタイムや満席の時間帯が心配でした。<br>
              お客様に「暑い」と思われるのは避けたいですし、夏本番に
              急に止まってしまうのも困ります。営業にできるだけ影響が
              出ないように、早めに入れ替えを相談と思っていました。
            </dd>
          </dl>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/construction_01_aircon.jpg'); ?>" alt="業務用エアコンの施工事例写真" width="500" height="348" loading="lazy" decoding="async">
        </div>
      </article>
      <article>
        <h3>何度も修理するより、交換した方がいいのではと悩んでいた</h3>
        <div class="camera_construction--inner">
          <dl>
            <dt>10年以上使った業務用エアコンの入れ替え</dt>
            <dd>
              ここ数年、エアコンの調子が悪くなることが増えていて、そのたび
              に修理を依頼していました。このまま修理を続けた方がいいのか、
              思い切って交換した方がいいのか判断できずにいました。<br>
              業務中に止まると困るので、今後のことも考えて一度見てほしいとおもっていました。
            </dd>
          </dl>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/airconchange_construction_02.jpg'); ?>" alt="" width="500" height="348" loading="lazy" decoding="async">
        </div>
      </article>
      <article>
        <h3>開業日が決まっているので、空調を間に合わせたかった</h3>
        <div class="camera_construction--inner">
          <dl>
            <dt>新店舗に業務用エアコンを新規設置しました</dt>
            <dd>
              開業日が決まっているので、それまでにエアコンの設置を終わらせ
              たいとおもっていました。内装工事も進んでいるのですが、どの
              くらいの能力のエアコンが必要なのか分からなくて不安でした。<br>
              ドライヤーを使うので店内が暑くなりやすいと思いますし、お客様
              に快適に過ごしてもらえる空調にしたいとおもっていました。
            </dd>
          </dl>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/airconchange_construction_03.jpg'); ?>" alt="" width="500" height="348" loading="lazy" decoding="async">
        </div>
      </article>
      <article>
        <h3>従業員から暑いと言われていて、作業環境を改善したかった</h3>
        <div class="camera_construction--inner">
          <dl>
            <dt>作業場に業務用エアコンを増設しました</dt>
            <dd>
              夏場になると作業場がかなり暑くなってしまい、従業員からも暑さ
              について声が上がっていました。今ある空調だけでは全体まで効い
              ていないようで、作業効率にも影響が出ている気がしました。<br>
              どこに、どのくらいのエアコンを追加すればいいのかを相談させ
              てもらって増設を決めました。
            </dd>
          </dl>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/airconchange_construction_04.jpg'); ?>" alt="" width="500" height="348" loading="lazy" decoding="async">
        </div>
      </article>
      <article>
        <h3>電気代が高くなっていて、使い続けるべきか迷っていた</h3>
        <div class="camera_construction--inner">
          <dl>
            <dt>省エネ型の機種へ取り換えました</dt>
            <dd>
              エアコン自体はまだ動いているのですが、電気代が高くなってきて
              いるのが気になっていました。<br>
              古い機種をこのまま使い続けるより、新しいものに交換した方が結果的に安くなるのかを一度見てもらいました。
              初期費用だけでなく、今後のランニングコストも含めてシミュレーションをしてもらって取り換えるようとおもいました。
            </dd>
          </dl>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/airconchange_construction_05.jpg'); ?>" alt="" width="500" height="348" loading="lazy" decoding="async">
        </div>
      </article>
    </div>
  </section>

  <section class="camera_flow -border sec" id="airconchange_flow">
    <div class="container -md">
      <h2>ご依頼・作業までの流れ</h2>
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
          <h3>お問い合わせ・見積もり（無料）</h3>
          <p>
            まずはフォームまたはお電話にてお問い合わせください。<br>
            設置先の市区町村、施設の種類、現在の業務用エアコンの状況、台数、導入
            ・交換希望時期など、分かる範囲でお知らせください。<br>
            現在の機器の型番や、室内機・室外機の写真がある場合は、
            あわせて共有いただくと確認がスムーズです。<br>
          </p>
        </div>
      </article>
      <article>
        <p class="camera_flow--step">
          <span>STEP</span>
          02
        </p>
        <div class="camera_flow--inner">
          <h3>メール・電話でヒアリング</h3>
          <p>
            お問い合わせ内容をもとに、担当者がメールまたは電話で詳しく状況を
            確認します。現在の機器が交換時期か、新規導入か、複数台の更新か、
            工事時期の希望があるかなどを整理します。<br>
            この段階で、対応エリア・対象施設・工事内容を確認し、
            導入・交換のご相談として進められるかを確認します。<br>
          </p>
        </div>
      </article>
      <article>
        <p class="camera_flow--step">
          <span>STEP</span>
          03
        </p>
        <div class="camera_flow--inner">
          <h3>現地調査・日程調整</h3>
          <p>
            必要に応じて現地調査を行い、設置場所、天井高、配管ルート、電源、
            室外機の設置場所、搬入経路、既存機器の撤去条件などを確認します。<br>
            現場状況を踏まえて、施設用途や使用環境に合った機種・馬力・台数を
            ご提案します。
          </p>
        </div>
      </article>
      <article>
        <p class="camera_flow--step">
          <span>STEP</span>
          04
        </p>
        <div class="camera_flow--inner">
          <h3>工事日調整</h3>
          <p>
            現地状況とご希望内容をもとに、機器本体・工事内容・撤去・フロン回収まわりを含めたお見積もりをご案内します。<br>
            内容にご納得いただけましたら、工事日程を調整し、機器手配へ進みます。店舗や施設の営業・業務への影響を抑えたい場合は、希望日程もあわせてご相談ください。
          </p>
        </div>
      </article>
      <article>
        <p class="camera_flow--step">
          <span>STEP</span>
          05
        </p>
        <div class="camera_flow--inner">
          <h3>工事・既存機器の撤去</h3>
          <p>
            工事当日は、作業箇所の養生を行ったうえで、既存の業務用エアコンを撤去し、新しい機器を設置します。<br>
            室内機・室外機の取付、配管接続、ドレン配管、電源まわりの確認など、現場状況に応じて必要な工事を進めます。<br>
            安全面や周辺環境に配慮しながら、店舗や施設の営業・業務への影響をできる限り抑えて作業を行います。
          </p>
        </div>
      </article>
      <article>
        <p class="camera_flow--step">
          <span>STEP</span>
          06
        </p>
        <div class="camera_flow--inner">
          <h3>試運転・動作確認</h3>
          <p>
            設置工事が完了しましたら、試運転を行い、冷暖房の運転状況、風量、異音、水漏れ、リモコン操作などを確認します。<br>
            配管・電源まわりにも問題がないかを確認し、正常に運転できる状態であることを確認します。<br>
            問題がないことを確認したうえで、お客様へお引き渡しします。
          </p>
        </div>
      </article>
      <article>
        <p class="camera_flow--step">
          <span>STEP</span>
          07
        </p>
        <div class="camera_flow--inner">
          <h3>工事完了・お引き渡し</h3>
          <p>
            試運転・動作確認が完了しましたら、設置状態や運転状況に問題がないことを確認し、お客様へお引き渡しします。<br>
            作業後は、担当者様にリモコン操作、運転時の注意点、今後のメンテナンスについてわかりやすくご説明します。<br>
            設置後に気になる点や不具合がございましたら、お気軽にご相談ください。<br>
            工事完了後も、業務用エアコンを安心してお使いいただけるようサポートいたします。
          </p>
        </div>
      </article>
    </div>
  </section>

  <section class="camera_qa bg_gray sec" id="airconchange_qa">
    <div class="container -md">
      <h2>よくある質問</h2>
      <p>
        お問い合わせ前に気になる点を、まとめてお答えします。<br>
        ご不明な点は、お気軽にお問い合わせください。
      </p>
      <dl>
        <dt>対応エリアはどこですか？</dt>
        <dd>
          愛知県・岐阜県・三重県・静岡県の法人・店舗・施設を基本対象としています。<br>
          まずは設置場所をお知らせください。
        </dd>
        <dt>どのような施設に対応していますか？</dt>
        <dd>
          店舗、オフィス、工場、倉庫、クリニック、介護施設、商業施設、事務所など、<br>
          法人・店舗・施設向けの業務用エアコン導入・交換に対応しています。
        </dd>
        <dt>現地調査や見積もりは必要ですか？</dt>
        <dd>
          業務用エアコンは、機器の馬力や台数だけでなく、配管、電源、搬入経路、室外機の設置場所、
          既存機器の撤去条件によって費用が変わります。<br>
          事前に型番・設置写真・室外機写真・台数を共有頂けるとスムーズです。
        </dd>
        <dt>工事代などの初期費用はかからないの？</dt>
        <dd>
          かかりません。
        </dd>
        <dt>業務用エアコンの交換時期が分かりません。相談できますか？</dt>
        <dd>
          はい、相談可能です。<br>
          使用年数、故障頻度、修理費用、部品供給の状況、電気代、現在の効き具合などを確認し、修理を続けるべきか、交換・買い替えを検討すべきかを整理します。
        </dd>
        <dt>修理と交換のどちらがいいかわからない時は相談できますか？</dt>
        <dd>
          はい、現在の状態を確認したうえでご相談いただけます。<br>
          部品交換のみ、応急処置のみ、リモコン・パーツのみのご相談は対象外となる場合があります。
        </dd>
        <dt>機種や馬力の選び方が分かりません</dt>
        <dd>
          業務用エアコンは、部屋の広さだけで機種を決めると、能力不足や過剰設備につながる場合があります。<br>
          施設の用途、稼働時間、天井高、熱源、利用人数、設置環境を確認し、現場に合った機種・馬力・形状をご提案します。
        </dd>
        <dt>対応できる業務用エアコンの種類は何ですか？</dt>
        <dd>
          天井カセット形、天井吊形、床置形、壁掛形業務用エアコン、ビルトイン形、ダクト形、パッケージエアコンなど、各種業務用エアコンの導入・交換をご相談いただけます。<br>
          現在の機器タイプが分からない場合は、一度ご相談ください。
        </dd>
        <dt>本体の販売から取付工事までまとめて依頼できますか？</dt>
        <dd>
          はい、機器選定、本体販売、取付工事、試運転までまとめてご相談いただけます。<br>
          既存機器の交換の場合は、撤去やフロン回収まわりも含めて、現場条件を確認しながらご提案します。
        </dd>
        <dt>営業中の店舗や稼働中の施設でも工事できますか？</dt>
        <dd>
          工事内容や現場状況によって異なります。店舗・オフィス・工場・施設の営業や業務への影響を抑えられるよう、工事日程や作業時間を確認しながら調整します。<br>
          休日・営業時間外の工事をご希望の場合も、事前にご相談ください。
        </dd>
        <dt>他メーカーからの入れ替えもできますか？</dt>
        <dd>
          可能です！他メーカーからの入替が7割です。
        </dd>
        <dt>支払い方法やリースは相談できますか？</dt>
        <dd>
          支払い方法やリースについては、案件内容や条件により確認が必要です。<br>
          導入台数、機器内容、工事範囲、希望時期を確認したうえで、対応可能な方法をご案内します。
        </dd>
        <dt>保証やアフター対応はありますか？</dt>
        <dd>
          メーカー保証や工事後の対応については、選定する機器や工事内容により異なります。<br>
          正式見積もり時に、保証範囲やアフター対応についても確認できるようご案内します。
        </dd>
      </dl>
    </div>
  </section>

  <section class="camera_area bg_skyblue sec" id="airconchange_area">
    <div class="container -md">
      <h2>
        <span>愛知県・岐阜県・三重県・静岡県</span>
        へ迅速に対応します
      </h2>
      <p>
        愛知県・岐阜県・三重県・静岡県で、業務用エアコンの取り換え・交換・入れ替えを<br class="is-hidden_sp">
        ご検討中の方はお気軽にご相談ください。<br>
        店舗・オフィス・工場・倉庫・医療施設・福祉施設・飲食店など、施設の用途や使用環境に合わせて、
        最適な業務用エアコンの入れ替えをご提案します。<br>
        既存機器の状況確認、現地調査、機器選定、撤去工事、フロン回収、設置工事、試運転まで一括対応。<br>
        老朽化した業務用エアコンの交換や、効きが悪くなった空調設備の入れ替えもご相談いただけます。<br>
        東海エリアでの業務用エアコン工事に迅速に対応し、<br class="is-hidden_sp">
        店舗や施設の営業・業務への影響をできる限り抑えた施工をご案内します。
      </p>
      <article>
        <span>愛知県</span>
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/area_01_airconchange.jpg'); ?>" alt="愛知県の対応エリアイメージ" width="600" height="450" loading="lazy" decoding="async">
        <p>
          名古屋市を中心とした店舗・オフィス・商業施設をはじめ、<br class="is-hidden_sp">
          三河エリアの工場・倉庫・物流施設など、<br class="is-hidden_sp">
          幅広い現場の業務用エアコン取り換え・交換に対応しています。<br>
          製造業が盛んな地域では、作業環境の温度管理や設備稼働への影響を抑えることが重要です。<br>
          飲食店や小売店、事務所では、来店されるお客様や従業員の快適性を維持するためにも、<br class="is-hidden_sp">
          空調設備の安定した運転が欠かせません。<br>
          古くなった業務用エアコンの入れ替え、効きが悪くなった空調設備の交換、<br class="is-hidden_sp">
          複数台の一括更新など、現場の使用状況に合わせてご提案します。<br>
          既存機器の撤去、フロン回収、新しい機器の設置、試運転まで一貫して対応し、<br class="is-hidden_sp">
          営業や業務への影響をできる限り抑えた施工を行います。<br>
        </p>
      </article>
      <article>
        <span>岐阜県</span>
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/area_02_airconchange.jpg'); ?>" alt="岐阜県の対応エリアイメージ" width="600" height="450" loading="lazy" decoding="async">
        <p>
          岐阜市・大垣市・各務原市周辺の店舗・事務所・工場・物流施設をはじめ、<br class="is-hidden_sp">
          地場産業の作業場、医療施設、福祉施設、宿泊施設などの<br class="is-hidden_sp">
          業務用エアコン取り換え・交換に対応しています。<br>
          内陸部の事業所や工場では、夏場・冬場ともに空調への負荷が大きくなりやすく、<br class="is-hidden_sp">
          業務用エアコンの能力選定や設置環境の確認が重要です。<br>
          観光地や宿泊施設では、利用者が快適に過ごせる空調環境づくりが求められます。<br>
          現地調査では、設置場所、配管ルート、室外機の設置スペース、搬入経路、<br class="is-hidden_sp">
          既存機器の撤去条件などを確認し、施設の用途に合った機種・馬力・台数をご提案します。<br>
          老朽化した空調設備の交換から、複数台の入れ替えまで丁寧に対応いたします。<br>
        </p>
      </article>
      <article>
        <span>三重県</span>
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/area_03_airconchange.jpg'); ?>" alt="三重県の対応エリアイメージ" width="600" height="450" loading="lazy" decoding="async">
        <p>
          四日市市・鈴鹿市・いなべ市周辺の工場・倉庫・事業所をはじめ、<br class="is-hidden_sp">
          津市・松阪市・桑名市・伊勢志摩エリアの店舗・飲食店・宿泊施設・医療施設など、<br class="is-hidden_sp">
          さまざまな現場の業務用エアコン取り換え・交換に対応しています。<br>
          工業エリアでは、作業環境や設備稼働に支障が出ないよう、<br class="is-hidden_sp">
          現場状況に合わせた空調設備の選定が重要です。<br>
          観光施設や飲食店、宿泊施設では、お客様の快適性に直結するため、<br class="is-hidden_sp">
          故障前の早めの入れ替えや計画的な更新もおすすめです。<br>
          既存機器の状況を確認したうえで、撤去工事、フロン回収、新しい業務用エアコンの設置、<br class="is-hidden_sp">
          配管・電源まわりの確認、試運転まで一括対応します。
          海沿いの地域や屋外設置環境についても、<br class="is-hidden_sp">
          室外機の設置場所や使用環境を踏まえてご案内します。
        </p>
      </article>
      <article>
        <span>静岡県</span>
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/service/area_04_airconchange.jpg'); ?>" alt="静岡県の対応エリアイメージ" width="600" height="450" loading="lazy" decoding="async">
        <p>
          浜松市・静岡市・沼津市・富士市周辺をはじめ、<br class="is-hidden_sp">
          県内各地の店舗・オフィス・工場・倉庫・飲食店・医療施設・福祉施設などの<br class="is-hidden_sp">
          業務用エアコン取り換え・交換に対応しています。<br>
          東西に広い静岡県では、地域や施設によって空調設備に求められる条件が異なります。<br>
          製造業の工場や倉庫では作業環境に合わせた能力選定が必要になり、<br class="is-hidden_sp">
          店舗や飲食店では来店客の快適性、医療・福祉施設では安定した室内環境が重要になります。<br>
          古くなった業務用エアコンの交換、冷暖房の効きが悪い空調設備の入れ替え、<br class="is-hidden_sp">
          複数台の更新など、現場ごとの課題に合わせてご提案します。<br>
          現地調査から機器選定、撤去、フロン回収、設置、試運転までスムーズに対応し、<br class="is-hidden_sp">
          安心して使える空調環境づくりをサポートします。
        </p>
      </article>
    </div>
  </section>

</main>

<?php get_footer(); ?>