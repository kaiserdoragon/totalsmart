<?php get_header(); ?>
<div class="eyecatch">
  <?php if (has_post_thumbnail()): ?>
    <?php the_post_thumbnail(); ?>
  <?php else: ?>
  <?php endif; ?>
  <h1>確認画面</h1>
</div>

<div class="breadcrumbs--wrap">
  <?php get_template_part('include/common', 'breadcrumb'); ?>
</div>
<?php $slug_name = $post->post_name; ?>
<main class="<?php echo $slug_name; ?>_page">

  <section class="sec -sm" id="confirm">
    <div class="container -md">
      <h2 class="ttl">
        お問い合わせ内容の確認です
        <span>CONFIRM</span>
      </h2>
      <?php echo apply_shortcodes('[contact-form-7 id="5655751" title="お問い合わせの確認画面（コーポレートサイト）"]'); ?>
    </div>
  </section>

</main>

<?php get_footer(); ?>