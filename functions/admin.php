<?php
add_action('admin_enqueue_scripts', function() {
    wp_enqueue_style('admin-styles', get_template_directory_uri().'/assets/styles/css/admin.css');
    wp_enqueue_script('admin-scripts', get_template_directory_uri() . '/assets/scripts/admin.js' );
});
