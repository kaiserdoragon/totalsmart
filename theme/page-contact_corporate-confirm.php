<?php get_header(); ?>
<div class="eyecatch">
  <?php if (has_post_thumbnail()): ?>
    <?php the_post_thumbnail(); ?>
  <?php else: ?>
  <?php endif; ?>
  <div>確認画面です</div>
</div>

<?php $slug_name = $post->post_name; ?>

<main class="<?php echo $slug_name; ?>_page bg_gray">
  <div class="container">
    <div class="breadcrumbs--wrap">
      <?php get_template_part('include/common', 'breadcrumb'); ?>
    </div>

    <section class="sec -sm contact_page -confirm" id="confirm">
      <div class="container -md">
        <h1 class="ttl">
          お問い合わせ内容の確認です
          <span>CONFIRM</span>
        </h1>
        <?php echo apply_shortcodes('[contact-form-7 id="5655751" title="お問い合わせの確認画面（コーポレートサイト）"]'); ?>
      </div>
    </section>
  </div>
</main>

<?php get_footer(); ?>