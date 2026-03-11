<?php
/*------------------------------------*\
事業内容ページ
\*------------------------------------*/

$page_id      = get_queried_object_id();
$page_title   = get_the_title($page_id);
$page_url     = get_permalink($page_id);
$home_url     = home_url('/');
$site_name    = get_bloginfo('name');
$slug_name    = get_post_field('post_name', $page_id);
$archive_title = '事業内容';

$raw_content = $page_id ? get_post_field('post_content', $page_id) : '';
$page_description_source = wp_strip_all_tags(strip_shortcodes((string) $raw_content));
$page_description_source = html_entity_decode((string) $page_description_source, ENT_QUOTES, get_bloginfo('charset'));
$page_description_source = preg_replace('/\s+/u', ' ', $page_description_source);
$page_description_source = trim((string) $page_description_source);

if (function_exists('mb_strimwidth')) {
  $page_description = mb_strimwidth($page_description_source, 0, 160, '...', 'UTF-8');
} else {
  $page_description = wp_trim_words($page_description_source, 120, '...');
}

if ('' === $page_description) {
  $page_description = 'トータルスマート株式会社の事業内容ページです。業務効率化、コスト削減、安心・快適な社内環境づくり、集客強化をワンストップで支援します。';
}

$seo_title = '事業内容 | ' . $site_name;

$has_seo_plugin = (
  defined('WPSEO_VERSION') ||
  defined('RANK_MATH_VERSION') ||
  defined('AIOSEO_VERSION') ||
  defined('SEOPRESS_VERSION')
);

/**
 * この固定ページ専用の title を付与
 * SEOプラグインがある場合はそちらを優先
 */
if (!$has_seo_plugin) {
  add_filter('pre_get_document_title', function ($document_title) use ($seo_title, $page_id) {
    if (is_page($page_id)) {
      return $seo_title;
    }
    return $document_title;
  }, 20);

  /**
   * この固定ページ専用の canonical を付与
   * SEOプラグインがある場合はそちらを優先
   */
  add_action('wp_head', function () use ($page_url, $page_id) {
    if (!is_page($page_id)) {
      return;
    }
    echo '<link rel="canonical" href="' . esc_url($page_url) . '">' . "\n";
  }, 20);
}

get_header();
?>

<?php
$schema_graph = [
  [
    '@type'           => 'BreadcrumbList',
    '@id'             => $page_url . '#breadcrumb',
    'itemListElement' => [
      [
        '@type'    => 'ListItem',
        'position' => 1,
        'name'     => 'TOP',
        'item'     => $home_url,
      ],
      [
        '@type'    => 'ListItem',
        'position' => 2,
        'name'     => '事業内容',
        'item'     => $page_url,
      ],
    ],
  ],
  [
    '@type'       => 'WebPage',
    '@id'         => $page_url . '#webpage',
    'url'         => $page_url,
    'name'        => $page_title,
    'description' => $page_description,
    'isPartOf'    => [
      '@type' => 'WebSite',
      '@id'   => $home_url . '#website',
      'url'   => $home_url,
      'name'  => $site_name,
    ],
    'breadcrumb'  => [
      '@id' => $page_url . '#breadcrumb',
    ],
    'about'       => [
      '@id' => $home_url . '#organization',
    ],
  ],
  [
    '@type'         => 'Organization',
    '@id'           => $home_url . '#organization',
    'name'          => 'トータルスマート株式会社',
    'alternateName' => 'Total Smart Co., Ltd.',
    'url'           => $home_url,
    'logo'          => get_theme_file_uri('/img/common/logo.png'),
    'description'   => '愛知・岐阜・三重・静岡を中心に、防犯、通信、省エネ、OA機器、空調、集客支援などをワンストップで提供する企業です。',
    'telephone'     => '+81-52-932-5450',
    'areaServed'    => [
      ['@type' => 'AdministrativeArea', 'name' => '愛知県'],
      ['@type' => 'AdministrativeArea', 'name' => '岐阜県'],
      ['@type' => 'AdministrativeArea', 'name' => '三重県'],
      ['@type' => 'AdministrativeArea', 'name' => '静岡県'],
    ],
  ],
];
?>
<script type="application/ld+json">
  <?php echo wp_json_encode(['@context' => 'https://schema.org', '@graph' => $schema_graph], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
</script>

<div class="eyecatch">
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
  <h1><?php echo esc_html($page_title); ?></h1>
</div>

<div class="breadcrumbs--wrap">
  <?php get_template_part('include/common', 'breadcrumb'); ?>
</div>

<main class="<?php echo esc_attr($slug_name . '_page'); ?>">

  <section class="business_lead sec">
    <div class="container -md">
      <h2 class="ttl">
        事業内容
        <span>BUSINESS</span>
      </h2>
      <p>
        賢く、安く、簡単に。コストを最適化し、強い経営へ。<br>
        経費の見直しと業務効率化をワンストップで支援し、日々のムダを可視化して削減します。<br>
        時間も支出もスマートに抑え、組織全体の生産性とパフォーマンスを着実に引き上げます。
      </p>

      <article class="business_lead--item">
        <div>
          <h3>
            <span>業務効率化</span>＆<span>コスト・経費</span>削減
          </h3>
          <img class="business_lead--img_sp" src="<?php echo esc_url(get_template_directory_uri() . '/img/business/lead_01.jpg'); ?>" alt="" width="500" height="400" loading="lazy" decoding="async">
          <ul>
            <li>
              <dl>
                <dt>配膳ロボット、サイネージ、POSレジなど</dt>
                <dd>作業の自動化と会計処理で、操作をスマートに！</dd>
              </dl>
            </li>
            <li>
              <dl>
                <dt>キャッシュレス決済、オーダーシステム</dt>
                <dd>お客様の支払いと注文がスムーズに完了し、<br class="is-hidden_sp">手間解消とミス防止に貢献！</dd>
              </dl>
            </li>
            <li>
              <dl>
                <dt>電話回線＆ネット回線、スマホ＆タブレット提供</dt>
                <dd>安定した通信環境で、社内外の情報連携を強化し<br class="is-hidden_sp">経費も削減！</dd>
              </dl>
            </li>
          </ul>
        </div>
        <img class="business_lead--img_pc" src="<?php echo esc_url(get_template_directory_uri() . '/img/business/lead_01.jpg'); ?>" alt="" width="500" height="400" loading="lazy" decoding="async">
      </article>

      <article class="business_lead--item">
        <div>
          <h3>
            安心・快適な<span>社内環境</span>
          </h3>
          <img class="business_lead--img_sp" src="<?php echo esc_url(get_template_directory_uri() . '/img/business/lead_02.jpg'); ?>" alt="" width="500" height="400" loading="lazy" decoding="async">
          <ul>
            <li>
              <dl>
                <dt>業務用エアコン</dt>
                <dd>快適な温度管理で、従業員もお客様も心地よい空間を提供！</dd>
              </dl>
            </li>
            <li>
              <dl>
                <dt>防犯カメラ、防犯セキュリティ</dt>
                <dd>24時間の安全管理で、安心して店舗運営が可能に！</dd>
              </dl>
            </li>
            <li>
              <dl>
                <dt>電気代＆ガス代削減</dt>
                <dd>最新省エネ技術で、エネルギーコストを大幅にカット！</dd>
              </dl>
            </li>
          </ul>
        </div>
        <img class="business_lead--img_pc" src="<?php echo esc_url(get_template_directory_uri() . '/img/business/lead_02.jpg'); ?>" alt="" width="500" height="400" loading="lazy" decoding="async">
      </article>

      <article class="business_lead--item">
        <div>
          <h3>
            <span>プロモーション＆集客</span>強化
          </h3>
          <img class="business_lead--img_sp" src="<?php echo esc_url(get_template_directory_uri() . '/img/business/lead_03.jpg'); ?>" alt="" width="500" height="400" loading="lazy" decoding="async">
          <ul>
            <li>
              <dl>
                <dt>ホームページ作成、チラシ作成</dt>
                <dd>お店の魅力をわかりやすく伝えるデザインで、ブランド力をアップ！</dd>
              </dl>
            </li>
            <li>
              <dl>
                <dt>オンデマンド導入、USEN、SNS活用</dt>
                <dd>動画や音響を活用した魅力的なプロモーションで、集客効果を最大化！</dd>
              </dl>
            </li>
            <li>
              <dl>
                <dt>LED販売</dt>
                <dd>明るい印象的な照明で、店舗の雰囲気を一新し、来店ワクワクを刺激！</dd>
              </dl>
            </li>
          </ul>
        </div>
        <img class="business_lead--img_pc" src="<?php echo esc_url(get_template_directory_uri() . '/img/business/lead_03.jpg'); ?>" alt="" width="500" height="400" loading="lazy" decoding="async">
      </article>
    </div>
  </section>

  <section class="feature business_strong sec bg_gray">
    <div class="business_strong--inner">
      <h2 class="page_ttl">私たちの強み</h2>
      <p class="business_strong--lead">
        私たちは最新のテクノロジーと革新的なソリューションを融合し、<br class="is-hidden_sp">
        企業の成長を力強く支援するパートナーです。<br>
        市場の変化に柔軟に対応し、店舗に最適なシステムとカスタマイズ可能なサービスを提供することで、<br class="is-hidden_sp">
        業務の効率化と持続的な発展を実現します。<br>
        豊富な導入実績と継続的な技術革新に裏打ちされた信頼性が大きな魅力です。<br>
        未来を切り拓く確かな基盤として、あらゆる店舗の成功をサポートします。<br>
      </p>
      <ul>
        <li>
          <span class="business_flow--step">POINT<span>01</span></span>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/business/strong_01.png'); ?>" alt="" width="315" height="210" loading="lazy" decoding="async">
          <p>
            あなたの会社を
            <span class="underline">より強く、<br class="is-hidden_sp">より快適に。</span>
            最新設備と技術で、<br class="is-hidden_sp">
            経営を刷新します。<br>
            私たちは、御社の成長を設備面から<br class="is-hidden_sp">
            支え続けます。
          </p>
        </li>
        <li>
          <span class="business_flow--step">POINT<span>02</span></span>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/business/strong_02.png'); ?>" alt="" width="315" height="210" loading="lazy" decoding="async">
          <p>
            企業の成長と売上をしっかり支える、最適なソリューションです。<br>
            柔軟なシステムで業務効率を向上させ、<span class="underline">着実な売上アップ</span><br class="is-hidden_sp">
            を実現します。
          </p>
        </li>
        <li>
          <span class="business_flow--step">POINT<span>03</span></span>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/business/strong_03.png'); ?>" alt="" width="315" height="210" loading="lazy" decoding="async">
          <p>
            あなたの会社を時代に合わせて革新します。<br>
            急速に変化する現代において最新設備を導入、<br class="is-hidden_sp">
            効率的なシステムの活用で、<span class="underline">競争力と快適さ</span>を実現します。
          </p>
        </li>
      </ul>
    </div>
  </section>

  <section class="business_plan sec">
    <div class="container">
      <h2 class="page_ttl">選べる3つのプラン</h2>
      <p class="business_strong--lead">
        導入前のご相談から、設置、運用、導入後のフォローアップまで専任スタッフが集中サポートさせていただきます。
      </p>
      <ul class="business_plan--list">
        <li>
          <span>レンタルプラン</span>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/business/plan_01.png'); ?>" alt="" width="220" height="117" loading="lazy" decoding="async">
          初期投資を抑えつつ、最新テクノロジーを<br class="is-hidden_sp">
          すぐにご利用いただけます。<br>
          当面の導入や柔軟なアップグレードが可能です。
        </li>
        <li>
          <span>リースプラン</span>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/business/plan_02.png'); ?>" alt="" width="150" height="112" loading="lazy" decoding="async">
          長期的な運用を見据えたプランで、<br class="is-hidden_sp">
          月々のお支払いにより最新の設備を維持します。<br>
          成長段階に合わせた最適なサポートを提供します。
        </li>
        <li>
          <span>販売プラン</span>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/business/plan_03.png'); ?>" alt="" width="220" height="117" loading="lazy" decoding="async">
          直接購入による全てのメリット。<br>
          最新設備を安心に自社の資産として導入し、
          業務の効率化と売上向上を実現します。
        </li>
      </ul>
      <p>
        サービスについて、機器の操作方法や不明な点など、電話や訪問してサポートするだけでなく、<br class="is-hidden_sp">
        どこでも遠隔サポートが可能。無駄な時間を省いて業務を効率化。
      </p>
      <ul class="business_plan--support">
        <li>リモートサポート</li>
        <li>訪問サポート</li>
        <li>電話サポート</li>
      </ul>
      <div class="business_plan--link">
        <a href="<?php echo esc_url(home_url('/remote/')); ?>">
          リモートサポート<br>
          <span>REMOTE SUPPORT</span>
        </a>
        <a href="<?php echo esc_url(home_url('/question/')); ?>">
          よくある質問<br>
          <span>QUESTION</span>
        </a>
      </div>
    </div>
  </section>

  <section class="business_flow sec bg_gray">
    <div class="container">
      <h2 class="page_ttl">導入の流れ</h2>
      <p>導入前のご相談から、設置、運用、導入後のフォローアップまで専任スタッフが集中サポートさせていただきます。</p>
      <ul>
        <li>
          <span class="business_flow--step">STEP<span>1</span></span>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/business/flow_01.png'); ?>" alt="" width="340" height="200" loading="lazy" decoding="async">
          <dl>
            <dt>
              <span>ご提案</span>
              <span>～設備の効果～</span>
            </dt>
            <dd>
              お客様の現状やお悩みをしっかりとお伺いし最適なソリューションをご提案いたします。<br>
              最新の製品やシステムの特徴、導入することで得られるメリットを分かりやすくご説明し、お客様のニーズに合ったプランを<br class="is-hidden_sp">
              お届けします。
            </dd>
          </dl>
        </li>
        <li>
          <span class="business_flow--step">STEP<span>2</span></span>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/business/flow_02.png'); ?>" alt="" width="340" height="200" loading="lazy" decoding="async">
          <dl>
            <dt>
              <span>ご商談</span>
              <span>～見積もりの提示と調整～</span>
            </dt>
            <dd>
              提案内容にご興味をお持ちいただけたら、具体的な導入方法やお見積もり、スケジュールなど詳細な条件についてお話をいたします。<br>
              お客様との対話を通じて、ご不明な点やご要望を丁寧にお伺いし、双方納得のいくプランを練り上げてまいります。
            </dd>
          </dl>
        </li>
        <li>
          <span class="business_flow--step">STEP<span>3</span></span>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/img/business/flow_03.png'); ?>" alt="" width="340" height="200" loading="lazy" decoding="async">
          <dl>
            <dt>
              <span>ご契約</span>
              <span>～ご契約後の流れについて</span>
            </dt>
            <dd>
              商談内容にご同意いただけましたら、正式な契約手続きに進みます。<br>
              契約書のご説明や必要書類のご案内を通じて、安心してお手続きいただけるようサポートいたします。<br>
              ご契約後も、導入後のフォローアップやアフターサポートをしっかりと行います。
            </dd>
          </dl>
        </li>
      </ul>
    </div>
  </section>

  <section class="cv_contact sec -page">
    <div class="container">
      <div class="cv_contact--ttl">
        <h2 class="ttl">
          お問い合わせ
          <span>CONTACT</span>
        </h2>
        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/page/contact_logo.png'); ?>" alt="トータルスマート株式会社" width="1100" height="117" loading="lazy" decoding="async">
      </div>
      <p>ご不明な点やご質問、または詳細な情報をお求めの場合は、どうぞお気軽にお問い合わせください。<br>
        専門のスタッフが迅速にサポートします。</p>
      <div class="cv_contact--inner">
        <ul>
          <li>
            <a href="<?php echo esc_url(home_url('/contact_corporate/')); ?>">メールで問い合わせ</a>
          </li>
          <!-- <li>
            <a href="">LINEで問い合わせ</a>
          </li> -->
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