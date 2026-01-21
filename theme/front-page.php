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
    <section class="attention sec bg_orange">
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
          <img src="<?php echo get_template_directory_uri(); ?>/img/top/feature_icon_02.png" alt="" width="245" height="105">
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
      <img src="<?php echo get_template_directory_uri(); ?>/img/top/feature_anima.png" alt="" width="900" height="1088">
      <a class="btn_link" href="#">トータルスマートについて詳しく知る</a>
    </div>
  </section>

  <section class="reason sec bg_orange">
    <div class="container">
      <h2 class="ttl">
        トータルスマートが選ばれる理由
        <span>REASON</span>
      </h2>
      <p>
        最新のテクノロジーと革新的なソリューションを融合し、<br class="is-hidden_sp">
        企業の成長を力強く支援するパートナーです。<br>
        市場の変化に柔軟に対応し、企業に最適なシステムとカスタマイズ可能なサービスを提供することで、<br class="is-hidden_sp">
        業務の効率化と持続的な発展を実現します。<br>
        豊富な導入実績と継続的な技術革新に裏打ちされた信頼性が私たちの大きな魅力です。<br>
        未来を切り拓く確かな基盤として、あらゆる企業の成功をサポートします。<br>
      </p>
      <ul>
        <li>
          <img src="<?php echo get_template_directory_uri(); ?>/img/top/reason_02.png" alt="" width="136" height="117">
          <h3>一括契約の提供</h3>
          <p>
            工事を行った後に発生する保守やメンテナ
            ンスなどのサービスも含めて、<span>一つの契約で
              提供しています。</span><br>
            工事の費用と保守の費用を別々に考える必要
            はありません。
          </p>
        </li>
        <li>
          <img src="<?php echo get_template_directory_uri(); ?>/img/top/reason_03.png" alt="" width="171" height="103">
          <h3>総合的なサポート</h3>
          <p>
            工事だけでなく、その後の保守や修理、サポー
            トも含めて一括で対応することで、<span>便利で経済
              的な提案をいたします。</span><br>
            別々の業者との契約や交渉をする手間を省くこ
            とができます。
          </p>

        </li>
        <li>
          <img src="<?php echo get_template_directory_uri(); ?>/img/top/reason_01.png" alt="" width="129" height="129">
          <h3>透明性と予測可能性</h3>
          <p>
            一括契約の場合、費用が明確に提示されるた
            め、将来の費用や予算をより<span>正確に見積もる
              ことができます。</span><br>
            リースと保守金額が一緒になることで、予測
            可能性が高まります。
          </p>
        </li>
      </ul>
    </div>
  </section>

  <section class="cv_area">
    <div class="cv_area--inner">
      <h2>小さな見直しが<span>大きな成果</span>につながる。</h2>
      <p>
        成果を伸ばす最適な業務改善を！<br>
        今の業務に潜む可能性を一緒に探しましょう！
      </p>
      <span>受付時間　平日9：00～18：00</span>
      <div class="cv_area--btns">
        <a class="cv_area--mail" href="">メールで問い合わせ</a>
        <a class="cv_area--tel" href="">電話で問い合わせ</a>
      </div>
    </div>
  </section>

  <section class="service bg_white sec">
    <div class="container">
      <h2 class="ttl">
        サービス
        <span>SERVICE</span>
      </h2>
      <p>
        当社のサービスは企業におけるあらゆる課題を解決するために<br class="is-hidden_sp">
        設計された革新的なソリューションです。<br>
        最新の技術を活用し、業務プロセスの自動化と効率化を図ることで、<br class="is-hidden_sp">
        従業員の負担を軽減し、顧客満足度の向上に寄与します。<br>
        また、厳格な管理体制と先進の安全対策を融合し、安心してご利用いただける環境を提供します。
        これにより、企業の競争力強化と持続的な成長を実現し、<br class="is-hidden_sp">
        多様な業種のお客様から高い評価をいただいております。<br>
      </p>
    </div>
  </section>
</main>
<?php get_footer(); ?>