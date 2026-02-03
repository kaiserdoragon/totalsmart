<?php get_header(); ?>

<div class="eyecatch">
  <h1>プライバシーポリシー</h1>
  <img src="<?php echo get_template_directory_uri(); ?>/img/page/eyecatch_404.jpg" alt="404 NOT FOUND" width="1920" height="600" loading="lazy" decoding="async">
</div>
<main class="notfound_page bg_gray privacy_page">
  <div class="archive--wrap">
    <?php get_template_part('include/common', 'breadcrumb'); ?>
  </div>
  <div class="container">
    <h2 class="ttl">
      プライバシーポリシー
      <span>PRIVACY</span>
    </h2>
    <p>
      トータルスマート株式会社（以下、「当社」といいます。）は、<br class="is-hidden_sp">
      OA機器や通信回線、電気工事、オフィス関連のコスト削減コンサルティング等、<br class="is-hidden_sp">
      企業のオフィス環境をトータルでサポートする事業を行っております。<br>
      当社は、事業活動を通じてお客様から取得する個人情報の重要性を深く認識し、<br class="is-hidden_sp">
      その情報を適切に保護することが当社の社会的責務であると考えます。<br>
      ここに個人情報の取扱いに関する方針を定め、全役員および全従業員がこれを遵守することにより、<br class="is-hidden_sp">
      お客様の信頼と期待に応えてまいります。
    </p>
    <div class="privacy_page--inner">
      <article>
        <h3>【個人情報の取扱いについて】</h3>
        <dl>
          <dt>＜個人情報の定義＞</dt>
          <dd>本ポリシーにおいて「個人情報」とは、個人情報保護法に規定される、生存する個人に関する情報であって、<br class="is-hidden_sp">
            氏名、生年月日、住所、電話番号、メールアドレス、会社名、その他記述等により特定の個人を識別できる情報を指します。</dd>
        </dl>
        <dl>
          <dt>＜個人情報の利用目的＞</dt>
          <dd>
            当社は、取得した個人情報を、以下の目的のために利用いたします。
            <ol>
              <li>
                1.商品・サービスの提供のため
                <ul>
                  <li>・インターネット回線、OA機器（複合機、ビジネスフォン等）、携帯電話、エアコン等の販売、設置、修理、保守に関する業務</li>
                  <li>・電気工事および通信設備工事の実施</li>
                  <li>・各種商品・サービスの提供に伴う契約の締結、管理、およびアフターサービスのため</li>
                </ul>
              </li>
            </ol>
          </dd>
        </dl>

      </article>
    </div>
    <a class="btn_link" href="<?php echo home_url(); ?>">トップページへ</a>
  </div>
</main>
<?php get_footer(); ?>