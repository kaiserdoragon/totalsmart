<?php if(comments_open())://コメント可能な記事でのみ表示?>
<aside id="comment_area">
    <h2 class="comment_ttl">
        コメント
    </h2>
    <?php if (have_comments()): // コメントがあったら ?>
        <ol class="commets-list">
            <?php
            wp_list_comments(); //コメント一覧を表示 ?>
        </ol>
        <div class="comment-page-link">
            <?php paginate_comments_links(); //コメントが多い場合、ページャーを表示 ?>
        </div>
    <?php else: ?>
        <p>コメントはありません</p>
    <?php endif; ?>
    <?php comment_form(); ?>
</aside>
<?php endif;?>

