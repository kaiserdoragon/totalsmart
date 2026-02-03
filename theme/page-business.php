<?php get_header(); ?>
<div class="eyecatch">
  <?php if (has_post_thumbnail()): ?>
    <?php the_post_thumbnail(); ?>
  <?php else: ?>
  <?php endif; ?>
  <h1><?php the_title(); ?></h1>
</div>

<div class="archive--wrap">
  <?php get_template_part('include/common', 'breadcrumb'); ?>
</div>
<?php $slug_name = $post->post_name; ?>
<main class="<?php echo $slug_name; ?>_page">

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
          <img class="business_lead--img_sp" src="<?php echo get_template_directory_uri(); ?>/img/business/lead_01.jpg" alt="" width="500" height="400" loading="lazy" decoding="async">
          <ul>
            <li>
              配膳ロボット、サイネージ、POSレジなど<br>
              <span>作業の自動化とな会計処理で、操作をスマートに！</span>
            </li>
            <li>
              キャッシュレス決済、オーダーシステム<br>
              <span>お客様の支払いと注文がスムーズに完了し、<br class="is-hidden_sp">手間解消とミス防止に貢献！</span>
            </li>
            <li>
              電話回線＆ネット回線、スマホ＆タブレット提供<br>
              <span>安定した通信環境で、社内外の情報連携を強化し<br class="is-hidden_sp">経費も削減！</span>
            </li>
          </ul>
        </div>
        <img class="business_lead--img_pc" src="<?php echo get_template_directory_uri(); ?>/img/business/lead_01.jpg" alt="" width="500" height="400" loading="lazy" decoding="async">
      </article>
      <article class="business_lead--item">
        <div>
          <h3>
            <span>業務効率化</span>＆<span>コスト・経費</span>削減
          </h3>
          <ul>
            <li>
              配膳ロボット、サイネージ、POSレジなど<br>
              <span>作業の自動化とな会計処理で、操作をスマートに！</span>
            </li>
            <li>
              キャッシュレス決済、オーダーシステム<br>
              <span>お客様の支払いと注文がスムーズに完了し、<br class="is-hidden_sp">手間解消とミス防止に貢献！</span>
            </li>
            <li>
              電話回線＆ネット回線、スマホ＆タブレット提供<br>
              <span>安定した通信環境で、社内外の情報連携を強化し<br class="is-hidden_sp">経費も削減！</span>
            </li>
          </ul>
        </div>
        <img src="<?php echo get_template_directory_uri(); ?>/img/business/lead_02.jpg" alt="" width="500" height="400" loading="lazy" decoding="async">
      </article>
      <article class="business_lead--item">
        <div>
          <h3>
            <span>業務効率化</span>＆<span>コスト・経費</span>削減
          </h3>
          <ul>
            <li>
              配膳ロボット、サイネージ、POSレジなど<br>
              <span>作業の自動化とな会計処理で、操作をスマートに！</span>
            </li>
            <li>
              キャッシュレス決済、オーダーシステム<br>
              <span>お客様の支払いと注文がスムーズに完了し、<br class="is-hidden_sp">手間解消とミス防止に貢献！</span>
            </li>
            <li>
              電話回線＆ネット回線、スマホ＆タブレット提供<br>
              <span>安定した通信環境で、社内外の情報連携を強化し<br class="is-hidden_sp">経費も削減！</span>
            </li>
          </ul>
        </div>
        <img src="<?php echo get_template_directory_uri(); ?>/img/business/lead_03.jpg" alt="" width="500" height="400" loading="lazy" decoding="async">
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
          <img src="<?php echo get_template_directory_uri(); ?>/img/business/strong_01.png" alt="" width="315" height="210" loading="lazy" decoding="async">
          あなたの会社を
          <span class="underline">より強く、<br class="is-hidden_sp">より快適に。</span>
          最新設備と技術で、<br class="is-hidden_sp">
          経営を刷新します。<br>
          私たちは、御社の成長を設備面から<br class="is-hidden_sp">
          支え続けます。
        </li>
        <li>
          <img src="<?php echo get_template_directory_uri(); ?>/img/business/strong_02.png" alt="" width="315" height="210" loading="lazy" decoding="async">
          企業の成長と売上をしっかり支<br class="is-hidden_sp">
          える、最適なソリューションで<br class="is-hidden_sp">
          す。柔軟なシステムで業務効率<br class="is-hidden_sp">
          を向上させ、<span class="underline">着実な売上アップ</span><br class="is-hidden_sp">
          を実現します。
        </li>
        <li>
          <img src="<?php echo get_template_directory_uri(); ?>/img/business/strong_03.png" alt="" width="315" height="210" loading="lazy" decoding="async">
          あなたの会社を時代に合わせて<br class="is-hidden_sp">
          革新します。急速に変化する現<br class="is-hidden_sp">
          代において最新設備を導入、効<br class="is-hidden_sp">
          率的なシステムの活用で、<span class="underline">競争<br class="is-hidden_sp">
            力と快適さ</span>を実現します。
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
          <img src="<?php echo get_template_directory_uri(); ?>/img/business/plan_01.png" alt="" width="220" height="117" loading="lazy" decoding="async">
          初期投資を抑えつつ、最新テクノロジーを<br class="is-hidden_sp">
          すぐにご利用いただけます。<br>
          当面の導入や柔軟なアップグレードが可能です。
        </li>
        <li>
          <span>リースプラン</span>
          <img src="<?php echo get_template_directory_uri(); ?>/img/business/plan_02.png" alt="" width="150" height="112" loading="lazy" decoding="async">
          長期的な運用を見据えたプランで、<br class="is-hidden_sp">
          月々のお支払いにより最新の設備を維持します。<br>
          成長段階に合わせた最適なサポートを提供します。
        </li>
        <li>
          <span>販売プラン</span>
          <img src="<?php echo get_template_directory_uri(); ?>/img/business/plan_03.png" alt="" width="220" height="117" loading="lazy" decoding="async">
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
          <img src="<?php echo get_template_directory_uri(); ?>/img/business/flow_01.png" alt="" width="340" height="200" loading="lazy" decoding="async">
          <dl>
            <dt>
              ご提案
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
          <img src="<?php echo get_template_directory_uri(); ?>/img/business/flow_02.png" alt="" width="340" height="200" loading="lazy" decoding="async">
          <dl>
            <dt>
              ご商談
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
          <img src="<?php echo get_template_directory_uri(); ?>/img/business/flow_03.png" alt="" width="340" height="200" loading="lazy" decoding="async">
          <dl>
            <dt>
              ご契約
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
        <img src="<?php echo get_template_directory_uri(); ?>/img/page/contact_logo.png" alt="トータルスマート株式会社" width="1100" height="117" loading="lazy" decoding="async">
      </div>
      <p>ご不明な点やご質問、または詳細な情報をお求めの場合は、どうぞお気軽にお問い合わせください。<br>
        専門のスタッフが迅速にサポートします。</p>
      <div class="cv_contact--inner">
        <ul>
          <li>
            <a href="">メールで問い合わせ</a>
          </li>
          <li>
            <a href="">LINEで問い合わせ</a>
          </li>
        </ul>
        <a href="tel:052-932-5450" class="cv_contact--btn">
          052-932-5450
          <span>受付時間<br class="is-hidden_sp">平日9:00～18:00</span>
        </a>
      </div>
    </div>
  </section>

  <h2 class="page_ttl">下層ページの共通見出し</h2>

  <h2 class="page_detail_ttl">詳細ページの共通見出し</h2>
</main>

<?php get_footer(); ?>