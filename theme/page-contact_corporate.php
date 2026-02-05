<?php get_header(); ?>
<div class="eyecatch">
  <?php if (has_post_thumbnail()): ?>
    <?php the_post_thumbnail(); ?>
  <?php else: ?>
  <?php endif; ?>
  <h1>お問い合わせ</h1>
</div>

<div class="archive--wrap">
  <?php get_template_part('include/common', 'breadcrumb'); ?>
</div>
<?php $slug_name = $post->post_name; ?>
<main class="<?php echo $slug_name; ?>_page">

  <section class="contact_corporate sec -sm">
    <div class="container -md">
      <h2 class="ttl">
        お問い合わせ
        <span>CONTACT</span>
      </h2>
      <p>
        メールでのお問い合わせは、下記のフォームにご入力ください。<br>
        内容を確認後、メールまたはお電話にてご連絡させていただきます。<br>
        メールの確認作業に時間を要する場合がございますので、お急ぎの場合はお電話にてお問い合わせください。<br>
        3営業日経っても連絡がない場合は、大変お手数ですが一度お電話にてご連絡をお願いいたします。
      </p>
      <?php echo apply_shortcodes('[contact-form-7 id="9a1f333" title="お問い合わせ（コーポレートサイト）"]'); ?>
    </div>
  </section>

</main>

<?php get_footer(); ?>