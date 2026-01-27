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
        <div class="about_lead--img">
          <img src="<?php echo get_template_directory_uri(); ?>/img/business/lead_01.jpg" alt="" width="500" height="400" loading="lazy" decoding="async">
        </div>
      </article>
      <h2 class="page_ttl">下層ページの共通見出し</h2>
    </div>
  </section>
</main>

<?php get_footer(); ?>