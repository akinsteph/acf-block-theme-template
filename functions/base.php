<?php
/**
 * Site wide base functions
 */

add_action('after_setup_theme', function() {

    load_theme_textdomain( 'abtt-wp', get_template_directory() . '/languages' );
    add_theme_support('post-formats', ['video', 'gallery', 'audio']);
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    add_theme_support('custom-logo', [
            'height'      => 130,
            'width'       => 105,
            'flex-width'  => true,
            'flex-height' => true,
        ]
    );

    register_nav_menus([
        'main-menu' => esc_html__( 'Main Menu', 'abtt-wp' ),
        'sponsor-menu' => esc_html__( 'Sponsor Links Menu', 'abtt-wp' ),
        'links-menu' => esc_html__( 'Useful Links Menu', 'abtt-wp' ),
        'services-menu' => esc_html__( 'Services Links', 'abtt-wp' ),
    ]);

    $fn = function(string $name, int $width, int $height, bool $crop = true) {
        add_image_size($name, $width, $height, $crop);
        add_image_size($name.'x2', $width * 2, $height * 2, $crop);
    };

    add_theme_support('automatic-feed-links');
});

add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'abtt_wp-font-style', get_template_directory_uri() . '/assets/styles/css/fonts.css', array(), ABTT_WP_THEME_VERSION. 'all' );
    wp_enqueue_style( 'abtt_wp-style', get_template_directory_uri() . '/style.css', array(), ABTT_WP_THEME_VERSION );
    wp_style_add_data( 'abtt_wp-style', 'rtl', 'replace' );


    wp_enqueue_script( 'abtt-wp-navigation-js', ABTT_ASSETS_URI . '/scripts/navigation.js', array('jquery'), ABTT_WP_THEME_VERSION, true );
    wp_enqueue_script( 'abtt-wp-global-js', ABTT_ASSETS_URI . '/scripts/global.js', array('jquery'), ABTT_WP_THEME_VERSION, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
});

function single_progressbar(): void {
    if(is_single(['post'])) {
        ?>
        <script>
            window.addEventListener('scroll', function() {
                const articleContainer = document.querySelector(".article-content");
                const bodyToElementTop = articleContainer.getBoundingClientRect().top;
                const bodyToElementBottom = articleContainer.getBoundingClientRect().bottom;
                const winScroll = window.scrollY;
                const diff = winScroll - bodyToElementTop;
                const scrolled = (diff / bodyToElementBottom) * 100;
                const progressBar = document.getElementById("progressBar");

                if (winScroll >= 120) {
                    progressBar.style.position = 'fixed';
                    progressBar.style.top = '0';
                } else {
                    progressBar.style.position = 'relative';
                    progressBar.style.top = 'auto';
                }

                progressBar.style.width = Math.min(scrolled, 100) + "%";
            });
        </script>
        <?php
    }
}
add_action('wp_footer', 'single_progressbar');


do_action('abtt_loaded');

/**
 * Initialize Classes.
 */

\AbttWP\Core\Init::init();

\AbttWP\Admin\Init::init();

\AbttWP\Classes\Init::init();

\AbttWP\Pages\Init::init();

// Check if ACF is activated
if ( ! function_exists( 'acf_add_local_field_group' ) ) {
    add_action( 'admin_notices', 'acf_not_activated_notice' );

    function acf_not_activated_notice() {
        ?>
        <div class="notice notice-error">
            <p><?php _e( 'Advanced Custom Fields (ACF) is not activated. Please install and activate the ACF plugin to use this theme.', 'your-theme' ); ?></p>
        </div>
        <?php
    }

}else{

    \AbttWP\Blocks\Init::get_instance();

}
