<?php get_header(); ?>

<div class="eyecatch">
  <h1>404 NOT FOUND</h1>
  <img src="<?php echo get_template_directory_uri(); ?>/img/page/eyecatch_404.jpg" alt="404 NOT FOUND" width="1920" height="600" loading="lazy" decoding="async">
</div>
<main class="notfound_page bg_gray">
  <div class="breadcrumbs--wrap">
    <?php get_template_part('include/common', 'breadcrumb'); ?>
  </div>
  <div class="container">
    <h2 class="ttl">
      404 NOT FOUND
      <span>NOT FOUND</span>
    </h2>
    <p>
      アクセスしようとしたページが見つかりませんでした。<br>
      ページが移動または削除されたか、URLの入力間違いの可能性があります。
    </p>
    <a class="btn_link" href="<?php echo home_url(); ?>">トップページへ</a>
  </div>
</main>
<?php get_footer(); ?>