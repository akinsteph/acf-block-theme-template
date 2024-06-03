<?php

namespace AbttWP\Blocks;

class Init
{
    public function __construct() {
        add_filter('acf/settings/load_json', [$this, 'load_theme_field_json']);
        add_action( 'init', [$this, '_abtt_acf_init_block_types'] );
    }

    public function _abtt_acf_init_block_types() {
        if (function_exists('acf_register_block_type')){

            acf_register_block_type([
                'name'              => 'article-quote-block',
                'title'             => __('Custom Quote Block'),
                'description'       => __('Custom Quote Section'),
                'render_template'   => __DIR__ . '/article-quote/article-quote.php',
                'category'          => 'theme',
                'icon'              => 'dashicons-welcome-widgets-menus',
                'keywords'          => [ 'Article', 'Quota', 'Abtt' ],
                'enqueue_assets'    => function() {
                    wp_enqueue_style( 'article-quote-block', ABTT_BLOCKS_URI . '/article-quote/article-quote.css', '', ABTT_WP_THEME_VERSION, 'all' );
                }
            ]);

            acf_register_block_type([
                'name'              => 'section-anchor-block',
                'title'             => __('Section Anchor Block'),
                'description'       => __('Section Anchor Section'),
                'render_template'   => __DIR__ . '/section-anchor/section-anchor.php',
                'category'          => 'theme',
                'icon'              => 'dashicons-welcome-widgets-menus',
                'keywords'          => [ 'Section', 'Anchor', 'Abtt' ],
                'enqueue_assets'    => function() {
                    wp_enqueue_style( 'section-anchor-block', ABTT_BLOCKS_URI . '/section-anchor/section-anchor.css', '', ABTT_WP_THEME_VERSION, 'all' );
                }
            ]);

            acf_register_block_type([
                'name'              => 'navigator-breadcrumb-block',
                'title'             => __('Navigator Breadcrumb'),
                'description'       => __('Navigator Breadcrumb'),
                'render_template'   => __DIR__ . '/navigator-breadcrumb/navigator-breadcrumb.php',
                'category'          => 'theme',
                'icon'              => 'dashicons-admin-links',
                'keywords'          => [ 'Breadcrumb', 'Navigator' ],
                'enqueue_assets'    => function() {
                    wp_enqueue_style( 'navigator-breadcrumb-block', NAVIGATOR_BLOCKS_URI . '/navigator-breadcrumb/navigator-breadcrumb.css', '', NAVIGATOR_WP_THEME_VERSION, 'all' );
                }
            ]);


        }
    }

    public function load_theme_field_json($paths) {

        // Append our custom path
        $paths[] = ABTT_ASSETS_DIR . '/acf-json';

        return $paths;
    }

    /**
     * @return \AbttWP\Blocks\Init
     */
    public static function get_instance()
    {
        static $instance = null;

        if (is_null($instance)) {
            $instance = new self();
        }

        return $instance;
    }
}
