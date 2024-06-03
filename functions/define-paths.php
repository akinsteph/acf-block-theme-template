<?php

//define some path
define('ABTT_ASSETS_URI', get_template_directory_uri() . '/assets');
define('ABTT_ASSETS_DIR', get_template_directory() . '/assets');
define('ABTT_BLOCKS_URI', get_template_directory_uri() . '/src/Blocks');
define('ABTT_ASSETS_ICONS_URI', ABTT_ASSETS_URI . '/icons');
define('ABTT_ASSETS_ICONS_DIR', ABTT_ASSETS_DIR . '/icons');
define('ABTT_ASSETS_IMAGES_URI', ABTT_ASSETS_URI . '/images');
define('ABTT_ASSETS_FONTS_URI', ABTT_ASSETS_URI . '/fonts');
define('ABTT_PARTIAL_VIEWS', get_template_directory() . '/partials');
define('ABTT_WEB_COMPONENTS', get_template_directory() . '/components');
define('ABTT_PRELOADER_SVG', ABTT_ASSETS_ICONS_DIR . '/preloader.svg');
define('ABTT_PLACEHOLDER_IMG', ABTT_ASSETS_IMAGES_URI . '/placeholder.png');
define('ABTT_CUSTOM_LOGO', ABTT_ASSETS_IMAGES_URI . '/abtt-logo.png');
define('ABTT_API_BASE_ROUTE', 'abtt-wp/v1');
define('ABTT_API_BASE', get_home_url() . '/wp-json/' . ABTT_API_BASE_ROUTE);
