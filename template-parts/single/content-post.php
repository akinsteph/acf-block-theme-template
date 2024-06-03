<?php
use \AbttWP\Classes\Blog;

$post_id = get_the_ID();
$post_data = Blog::get_instance()->get_blog_item_by_id($post_id);
$author_data = $post_data['author'];

$related_articles_data = Blog::get_instance()->get_all_blogs([$post_id], 3, 1);

?>
<article class="article-content">
    <div class="container">
        <div class="article-content__row">
            <div class="article-content__row-nav">
                <span><?php esc_html_e('Contents', 'abtt-wp'); ?></span>
                <ul id="content-headings"></ul>
            </div>
            <div class="article-content__row-main block-content">
                <?php echo apply_filters('the_content', $post_data['content']); ?>
            </div>
            <div class="article-content__row-socials">
                <?php component('social-share'); ?>
            </div>
        </div>
    </div>
</article>

<?php component('related-articles', ['data' => $related_articles_data, 'class' => 'not-off']); ?>
