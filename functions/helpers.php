<?php
function component(string $component_name, array $vars = []) : void
{
    extract($vars);
    $dirs = [ get_stylesheet_directory(), get_template_directory() ];
    foreach ($dirs as $dir) {
        $fn = $dir.'/components/'.$component_name.'.php';
        if (file_exists($fn)) {
            include $fn;
            return;
        }
    }
    echo "COMPONENT NOT FOUND: $component_name";
}

function get_template_icon($svg_name, $class_name = '', $echo = true) {
    // Define the path to the SVG directory
    $svg_directory = get_template_directory() . '/assets/icons/';

    // Construct the full path to the SVG file
    $svg_path = $svg_directory . $svg_name . '.svg';

    // Check if the SVG file exists
    if (file_exists($svg_path)) {
        // Read the SVG content
        $svg_content = file_get_contents($svg_path);

        // Add the provided class to the SVG content
        if (!empty($class_name)) {
            $svg_content = str_replace('<svg', '<svg class="' . esc_attr($class_name) . '"', $svg_content);
        }
        if ($echo) {
            // Display the modified SVG content
            echo $svg_content;
        }else{
            return $svg_content;
        }
    } else {
        echo 'SVG not found.';
    }
}

function get_template_image($image_name, $class_name = '', $return_url = false) {
    // Define the path to the image directory
    $image_directory = get_template_directory() . '/assets/images/';

    // Check if PNG and JPG versions exist
    $png_path = $image_directory . $image_name . '.png';
    $jpg_path = $image_directory . $image_name . '.jpg';
    $gif_path = $image_directory . $image_name . '.gif';

    if (file_exists($png_path) || file_exists($jpg_path) || file_exists($gif_path)) {
        // Determine which image format to use
        $image_path = file_exists($png_path) ? $png_path : $jpg_path;

        $img_ext = file_exists($png_path) ? '.png' : '.jpg';

        $image_path = file_exists($gif_path) ? $gif_path : $image_path;

        $img_ext = file_exists($gif_path) ? '.gif' : $img_ext ;

        // Get the image URL
        $image_url = get_template_directory_uri() . '/assets/images/' . $image_name . $img_ext;

        if ($return_url) {
            return esc_url($image_url);
        } else {
            // Add the provided class to the image tag
            $class_attribute = !empty($class_name) ? 'class="' . esc_attr($class_name) . '"' : '';

            // Display the image with the URL
            echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_name) . '" ' . $class_attribute . ' />';
        }
    } else {
        echo 'Image not found.';
    }
}

function get_menu_title($theme_location) {
    $menu_title = '';
    $locations = get_nav_menu_locations();
    $menu_id   = $locations[$theme_location];

    $menu_object = wp_get_nav_menu_object($menu_id);

    if ($menu_object) {
        $menu_title = $menu_object->name;
    }

    return $menu_title;
}
