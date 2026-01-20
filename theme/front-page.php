<?php get_header(); ?>
<main>
  <div class="mv">
    <h2>
      <span>賢く安く簡単に最適なコスト削減</span>
      ワンストップで<br>全部解決！
    </h2>
    <div class="mv_scroll">
      <div class="mv_scroll--inner">
        <div class="mv_scroll--left">
          <p>
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
          </p>
        </div>
        <div class="mv_scroll--right">
          <p>
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
            Total Smartは経費削減を専門とする会社です。
          </p>
        </div>
      </div>
    </div>
    <div class="mv_parallax_bg">
      <video src="<?php echo get_template_directory_uri(); ?>/video/video.mp4" playsinline autoplay muted loop></video>
    </div>
  </div>

  <section class="lead_worry bg_white sec">
    <div class="container -md">
      <h2>こんな<span class="lead_txt">お悩み</span>ありませんか？？</h2>
      <ul>
        <li>業務が忙しすぎる…<br>もっと<span class="lead_txt">効率化</span>をしたい！！</li>
        <li>無駄な<br><span class="lead_txt">コスト・費用</span>を削りたい</li>
        <li>情報の<span class="lead_txt">セキュリティ管理</span>を<br>徹底したい！</li>
      </ul>
    </div>
  </section>

  <section class="lead_solution bg_gray">
    <div class="lead_solution--inner container sec">
      <div class="container -sm">
        <div class="lead_solution--ttl">
          <h2>
            <p>これらの<span>悩み</span>は</p>
            <img class="lead_solution--logo" src="<?php echo get_template_directory_uri(); ?>/img/top/solution_logo.png" alt="トータルスマート株式会社" width="353" height="42">が<span>スマート</span>に解決します！
          </h2>
          <img src="<?php echo get_template_directory_uri(); ?>/img/top/solution_txt.png" alt="トータルスマート株式会社" width="1024" height="213">
        </div>
        <div class="lead_solution--txt">
          <p class="underline">オフィス関連をトータルにお任せ！</p>
          <p class="underline">保守・メンテナンスをスマート解決！</p>
        </div>
        <p class="u-mb30">
          トータルスマート株式会社はオフィスに係ること全てトータルで依頼可能！<br>
          OA機器・インターネット回線・電気ガスはもちろん<br>
          全て一本化することができコスト削減につながります。
        </p>
        <div class="lead_solution--txt">
          <span>複数の業者に電話して、たらい回しにあう…</span>
          <p class="underline">もうそんな必要はありません！</p>
        </div>
        <p>一本化により、沢山の業者に連絡する手間を省き</p>
        <strong>一本の電話で全て<span>解決！</span></strong>
        <p>となるトータルサポートを可能にしています。</p>
      </div>
      <img src="<?php echo get_template_directory_uri(); ?>/img/top/solution_catch.png" alt="" width="724" height="489">
    </div>
  </section>

  <?php
  $page_data = get_page_by_path('attention');
  if ($page_data && !empty($page_data->post_content)) :
  ?>
    <section class="attention sec">
      <div class="container">
        <h2 class="ttl">
          注目情報
          <span>PICKUP</span>
        </h2>
        <p class="ttl--lead">
          トータルスマートから最新情報・注目情報をお伝えします。<br>
          情報収集にご活用ください。
        </p>

        <div class="attention--inner">
          <?php
          echo apply_filters('the_content', $page_data->post_content);
          ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <section class="feature bg_white sec">
    <div class="container">
      <h2 class="ttl">
        トータルスマートでできること
        <span>FEATURE</span>
      </h2>
      <p class="ttl--lead">コストを抑えて成果を伸ばす、最適な業務改善をご提案します！！</p>
      <ul>
        <li>
          <img src="<?php echo get_template_directory_uri(); ?>/img/top/feature_catch_01.png" alt="" width="400" height="210">
          <h3>コスト削減</h3>
          <p>
            オフィスで必須なOA機器やインターネット回線
            ビジネスフォンをトータルスマートに変えて
            お得に経費削減。<br>
            面倒な初期の手続き工事もお任せで安心。
          </p>
          <img src="<?php echo get_template_directory_uri(); ?>/img/top/feature_icon_01.png" alt="" width="246" height="87">
        </li>
        <li>
          <img src="<?php echo get_template_directory_uri(); ?>/img/top/feature_catch_02.png" alt="" width="400" height="210">
          <h3>業務効率化</h3>
          <p>
            リモートサポートはブロードバンド回線を
            通じてお客様のパソコン画面を
            技術スタッフのパソコンに表示し、
            画面を確認しながらご対応します。
          </p>
          <img src="<?php echo get_template_directory_uri(); ?>/img/top/feature_icon_02.png" alt="" width="245" height="105 ">
        </li>
        <li>
          <img src="<?php echo get_template_directory_uri(); ?>/img/top/feature_catch_03.png" alt="" width="400" height="210">
          <h3>売上・収益向上</h3>
          <p>
            ITを駆使して、企業の可能性を見極め、
            最適な成長の道筋を設計します。<br>
            データに基づいた継続的な進化を通じて、
            企業の成長や売上増加を支援します。
          </p>
          <img src="<?php echo get_template_directory_uri(); ?>/img/top/feature_icon_03.png" alt="" width="164" height="117">
        </li>
      </ul>
      <div class="feature--inner">
        <p>OA機器や配線など、オフィスに関わること全て</p>
        <strong class="underline">トータルで依頼可能！</strong>
        <strong class="underline">一本の電話ですべて解決する</strong>
        <p>お客様にとってストレスのない業務形態です。</p>
      </div>
      <a class="btn_link" href="#">トータルスマートについて詳しく知る</a>
    </div>
  </section>

</main>
<?php get_footer(); ?>