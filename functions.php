<?php
/**
 * Abtt functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package AbttWP
 */

require __DIR__ . '/vendor/autoload.php';

if ( ! defined( 'ABTT_WP_THEME_VERSION' ) ) {
    // Replace the version number of the theme on each release.
    define( 'ABTT_WP_THEME_VERSION', '1.0.0.97' );
}

// Define Paths to directories and files in the theme
include(__DIR__.'/functions/define-paths.php');


include(__DIR__.'/functions/base.php');
include(__DIR__.'/functions/header.php');
include(__DIR__.'/functions/socials.php');
include(__DIR__.'/functions/helpers.php');

// Admin
include(__DIR__.'/functions/admin.php');
