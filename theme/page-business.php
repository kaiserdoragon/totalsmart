<?php get_header(); ?>
<div class="eyecatch">
  <?php if (has_post_thumbnail()): // サムネイルを持っているとき 
  ?><?php the_post_thumbnail(); ?><?php else: // サムネイルを持っていない 
                                  ?><?php endif; ?>
  <h1><?php the_title(); ?></h1>
</div>

<?php get_template_part('include/common', 'breadcrumb'); //　Breadcrumb NavXTを使わないときは削除
?>

<?php $slug_name = $post->post_name; ?>
<main class="<?php echo $slug_name; ?>_page">
  <section class="about_lead sec">
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
      <article class="about_lead--item">
        <div>
          <h3>
            <span>業務効率化</span>＆<span>コスト・経費</span>削減
          </h3>
          <img class="about_lead--img_sp" src="<?php echo get_template_directory_uri(); ?>/img/business/lead_01.jpg" alt="" width="500" height="400" loading="lazy" decoding="async">
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
        <img class="about_lead--img_pc" src="<?php echo get_template_directory_uri(); ?>/img/business/lead_01.jpg" alt="" width="500" height="400" loading="lazy" decoding="async">
      </article>
      <article class="about_lead--item">
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
      <article class="about_lead--item">
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

  <section class="feature about_strong sec bg_gray">
    <div class="about_strong--inner">
      <h2 class="page_ttl">私たちの強み</h2>
      <p class="about_strong--lead">
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
          <p>
            あなたの会社をより強く、<br class="is-hidden_sp">
            より快適に。最新設備と技術で、<br class="is-hidden_sp">
            経営を刷新します。<br>
            私たちは、御社の成長を設備面から<br class="is-hidden_sp">
            支え続けます。
          </p>
        </li>
        <li>
          <img src="<?php echo get_template_directory_uri(); ?>/img/business/strong_02.png" alt="" width="315" height="210" loading="lazy" decoding="async">
          <p>
            企業の成長と売上をしっかり支<br class="is-hidden_sp">
            える、最適なソリューションで<br class="is-hidden_sp">
            す。柔軟なシステムで業務効率<br class="is-hidden_sp">
            を向上させ、着実な売上アップ<br class="is-hidden_sp">
            を実現します。
          </p>
        </li>
        <li>
          <img src="<?php echo get_template_directory_uri(); ?>/img/business/strong_03.png" alt="" width="315" height="210" loading="lazy" decoding="async">
          <p>
            あなたの会社を時代に合わせて<br class="is-hidden_sp">
            革新します。急速に変化する現<br class="is-hidden_sp">
            代において最新設備を導入、効<br class="is-hidden_sp">
            率的なシステムの活用で、競争<br class="is-hidden_sp">
            力と快適さを実現します。
          </p>
        </li>
      </ul>
    </div>
  </section>

  <h2 class="page_ttl">下層ページの共通見出し</h2>
</main>

<?php get_footer(); ?>