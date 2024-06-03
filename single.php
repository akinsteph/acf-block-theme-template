<?php

the_post();
global $post;

get_header();

?>
<main class="section-<?php echo get_post_type(); ?> article-content">
    <?php get_template_part( 'template-parts/single/content', get_post_type() ); ?>
</main>
<?php
get_footer();
