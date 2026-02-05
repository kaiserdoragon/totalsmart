<?php get_header(); ?>
<div class="eyecatch">
  <?php if (has_post_thumbnail()): // サムネイルを持っているとき 
  ?><?php the_post_thumbnail(); ?><?php else: // サムネイルを持っていない 
                                  ?><?php endif; ?>
  <h1><?php the_title(); ?></h1>
</div>

<div class="breadcrumbs--wrap">
  <?php get_template_part('include/common', 'breadcrumb'); ?>
</div>

<?php $slug_name = $post->post_name; ?>
<main class="<?php echo $slug_name; ?>_page">
  <section class="sec">
    <div class="container">
      <h2 class="ttl">
        リモートサポート
        <span>REMOTE</span>
      </h2>
      <p>
        弊社からのサービス提供後、お困りのことがございましたら、訪問または遠隔操作にてサポートさせていただきます。<br>
        弊社のリモート対応は、瞬時に世界中のPCやサーバーと接続可能なTeamViewerを利用します。
      </p>
      <img src="<?php echo get_template_directory_uri(); ?>/img/remote/teamviewer.png" alt="" width="900" height="652" loading="lazy" decoding="async">
      <a class="btn_link" href="https://download.teamviewer.com/download/TeamViewerQS.exe">こちらからダウンロードできます</a>
    </div>
  </section>
</main>

<?php get_footer(); ?>