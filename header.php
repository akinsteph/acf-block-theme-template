<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AbttWP
 */
if (!defined('TITLE')) {
    define('TITLE', is_single() ? get_the_title() : get_bloginfo('title'));
}
if (!defined('SECTION')) {
    define('SECTION', is_single() ? get_post_type() : get_post_field( 'post_name', get_post()));
}
if (!defined('DESCRIPTION')) {
    define('DESCRIPTION', is_single() ? get_the_excerpt() : get_bloginfo('description'));
}
if (!defined('PERMALINK')) {
    global $wp;
    define('PERMALINK', is_front_page() ? get_bloginfo('url') : (is_single() ? get_the_permalink() : home_url(add_query_arg([], $wp->request))));
}


$body_class = defined('BODY_CLASS') ? BODY_CLASS : '';
if (defined('SECTION')) $body_class .= ' section-' . SECTION;
if ($body_class === '') $body_class = null;

use AbttWP\Core\MainMenu_Walker;
?>

<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <title><?= esc_html(TITLE); ?></title>
        <link rel="canonical" href="<?= esc_attr(PERMALINK) ?>" />
        <meta name="description" content="<?= esc_attr(DESCRIPTION) ?>">
        <?php
            wp_head();
            do_action('abtt_head');
        ?>

    </head>

    <body <?php body_class($body_class); ?>>
        <?php wp_body_open(); ?>
        <header>
            <div class="container">
                <div class="header-wrapper">
                    <nav class="site-navigation" id="site-navigation">
                        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                            <div class="hamburger-icon">
                                <div class="dash burger1"></div>
                                <div class="dash burger2"></div>
                            </div>
                        </button>
                        <div class="site-menu">
                            <div class="container">
                                <div class="site-menu__row">
                                    <div class="site-menu__row-brand">
                                        <?php
                                        if(has_custom_logo()):
                                            echo get_custom_logo();
                                        endif;
                                        ?>
                                        <button class="menu-toggle close" aria-controls="primary-menu" aria-expanded="false">
                                            <span><?php esc_html_e('CLOSE', 'abtt-wp'); ?></span>
                                            <div class="hamburger-icon">
                                                <div class="dash burger1"></div>
                                                <div class="dash burger2"></div>
                                            </div>
                                        </button>
                                    </div>

                                    <?php
                                        wp_nav_menu([
                                            'theme_location' => 'main-menu',
                                            'menu_id' => 'main-menu',
                                            'menu_class' => 'nav-content',
                                            'container' => false,
                                            'items_wrap' => '<ul id="%1$s" class="%2$s" >%3$s</ul>',
                                            'walker' => new MainMenu_Walker(),
                                        ]);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </header>
<?php
