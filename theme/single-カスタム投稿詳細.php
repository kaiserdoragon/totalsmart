<?php get_header(); ?>
<div class="eyecatch">
  <h1>お知らせ（記事詳細ページ）</h1>
</div>

<?php get_template_part('include/common', 'breadcrumb'); //　Breadcrumb NavXTを使わないときは削除
?>

<div class="has_sidebar news_page">
  <main>
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
        <article class="post_single">
          <h2><?php the_title(); ?></h2>
          <div class="post_meta">
            <time class="post_meta--date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
            <ul class="post_meta--cat_list">
              <?php categories_label() ?>
            </ul>
            <p class="post_meta--tag">
              <?php echo get_the_tag_list('#', ' #', ''); ?>
            </p>
          </div>
          <div class="post_content">
            <?php the_content(); ?>
          </div>
        </article>

        <?php //comments_template(); //コメント機能を使いたい場合は利用
        ?>


        <!-- 記事のページング機能 -->
        <?php
        /**
         * 投稿が指定されたタームに属しているかチェックする
         *
         * @param int    $post_id   投稿ID
         * @param string $term_slug タームスラッグ
         * @param string $taxonomy  タクソノミー
         * @return bool
         */
        function post_has_term($post_id, $term_slug, $taxonomy)
        {
          $terms = wp_get_post_terms($post_id, $taxonomy, array('fields' => 'slugs'));
          return in_array($term_slug, $terms);
        }

        /**
         * カスタムページングHTMLを生成する
         *
         * @param array $args 設定オプション
         * @return string ページングHTML
         */
        function get_custom_paging($args = array())
        {
          // デフォルト値とマージ
          $defaults = array(
            'post_type'  => 'post',
            'taxonomy'   => 'category',
            'term_slug'  => '',
            'next_text'  => '次の記事',
            'prev_text'  => '前の記事',
            'list_text'  => '一覧へ戻る',
            'show_title' => true,
            'classes'    => array(
              'wrapper' => 'paging',
              'item'    => 'paging--item',
              'next'    => 'paging--item-next',
              'prev'    => 'paging--item-prev',
              'list'    => 'paging--item-gotolist'
            )
          );
          $args = wp_parse_args($args, $defaults);

          // 前後の投稿を取得
          $next_post = get_next_post(true, '', $args['taxonomy']);
          $prev_post = get_previous_post(true, '', $args['taxonomy']);

          $html = "<ul class=\"{$args['classes']['wrapper']}\">";

          // 次の記事
          $html .= get_paging_item($next_post, $args, 'next');

          // 一覧へ戻るリンク
          $list_link = $args['term_slug'] ? get_term_link($args['term_slug'], $args['taxonomy']) : get_post_type_archive_link($args['post_type']);
          $html .= "<li class=\"{$args['classes']['item']} {$args['classes']['list']}\"><a href=\"{$list_link}\">{$args['list_text']}</a></li>";

          // 前の記事
          $html .= get_paging_item($prev_post, $args, 'prev');

          $html .= '</ul>';

          return $html;
        }

        /**
         * ページング項目のHTMLを生成する
         *
         * @param WP_Post $post 投稿オブジェクト
         * @param array   $args 設定オプション
         * @param string  $type 'next' または 'prev'
         * @return string ページング項目HTML
         */
        function get_paging_item($post, $args, $type)
        {
          if (empty($post) || $post->post_type !== $args['post_type'] || ($args['term_slug'] && !post_has_term($post->ID, $args['term_slug'], $args['taxonomy']))) {
            return "<li class=\"{$args['classes']['item']} {$args['classes'][$type]}\"></li>";
          }

          $link = get_permalink($post->ID);
          $text = $args[$type . '_text'];
          $title = $args['show_title'] ? ': ' . get_the_title($post->ID) : '';

          return "<li class=\"{$args['classes']['item']} {$args['classes'][$type]}\"><a href=\"{$link}\">{$text}{$title}</a></li>";
        }

        // 使用例
        echo get_custom_paging(array(
          'post_type'  => 'sports',
          'taxonomy'   => 'sportscat',
          'term_slug'  => 'spikeout',
          'next_text'  => '次の記事',
          'prev_text'  => '前の記事',
          'list_text'  => '一覧へ戻る',
          'show_title' => true
        ));
        ?>

        <?php endwhile; ?><?php endif; ?>
  </main>
  <!-- <?php get_sidebar(); ?> -->
</div>
<!-- <?php get_footer(); ?> -->