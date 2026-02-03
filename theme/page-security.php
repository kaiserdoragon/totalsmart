<?php get_header(); ?>

<div class="eyecatch">
  <h1>情報セキュリティ方針</h1>
  <img src="<?php echo get_template_directory_uri(); ?>/img/page/eyecatch_404.jpg" alt="404 NOT FOUND" width="1920" height="600" loading="lazy" decoding="async">
</div>
<main class="notfound_page bg_gray security_page">
  <div class="archive--wrap">
    <?php get_template_part('include/common', 'breadcrumb'); ?>
  </div>
  <div class="container">
    <h2 class="ttl">
      情報セキュリティ基本方針
      <span>SECURITY</span>
    </h2>
    <p>
      お客様から信頼される企業として、お客様からお預かりした情報資産をサイバー攻撃などの脅威から守ります。<br>
      全社的な管理体制の元に以下の基本方針を定め、実施し推進します。
    </p>
    <ol class="security_page--inner">
      <li>
        1.情報資産の保護
        <p>当社は、情報資産の機密性、完全性および可用性を確保、中でも機密性を重視した管理を徹底し、安心されるお客様サービスの向上に努めます。</p>
      </li>
      <li>
        2.情報セキュリティ体制の構築
        <p>当社は、機密情報及び情報システム等の機密性、完全性、可用性を確保するために、情報管理体制を整備するとともに、
          適切な組織的・人的・物理的・技術的措置を徹底します。</p>
      </li>
      <li>
        3.教育・訓練
        <p>当社は、情報セキュリティ水準の維持・向上を図るため、必要な教育を継続的に実施し、関係法令・規制や社内規程、
          情報セキュリティ管理の重要性に対する意識を高め、遵守を徹底します。</p>
      </li>
      <li>
        4.違反及び事故への対応
        <p>当社は、情報セキュリティに関わる法令違反、契約違反及び事故が発生した場合には適切に対処し、再発防止に努めます。</p>
      </li>
      <li>
        5.継続的な改善
        <p>当社は、法令や社会環境、情報セキュリティ上のリスクの変化に合わせて、情報セキュリティ確保への継続的な改善・向上を図ってまいります。</p>
      </li>
    </ol>
    <a class="btn_link" href="<?php echo home_url(); ?>">トップページへ</a>
  </div>
</main>
<?php get_footer(); ?>