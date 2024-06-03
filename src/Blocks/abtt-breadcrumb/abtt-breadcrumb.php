<?php
/**
 * Breadcrumb Block template.
 *
 * @param array $block The block settings and attributes.
 */
global $post;

// Load values and assign defaults.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="breadcrumb-block-' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'abtt-breadcrumb';
if( !empty($block['className']) ) {
    $className .= '' . $block['className'];
}

$background_colour        = !empty(get_field('background_colour')) ? get_field('background_colour') : '#F9F6F3';

$styles = [ 'background-colour: ' . $background_colour ];
$style  = implode( '; ', $styles );

$breadcrumbs = [];

$divider = '<svg xmlns="http://www.w3.org/2000/svg" width="6" height="8" viewBox="0 0 6 8" fill="none">
  <path d="M1.66656 0L0.726562 0.94L3.7799 4L0.726562 7.06L1.66656 8L5.66656 4L1.66656 0Z" fill="#FB2600" fill-opacity="0.25"/>
</svg>';

$breadcrumbs[] = '<a href="' . esc_url(home_url('/')) . '">' . __('Home', 'abtt-wp') . '</a>';

// Check if it's a post or a page
if (is_singular(['post', 'team', 'case-study']) || is_page()) {
    $post_type = get_post_type();
    $post_type_obj = get_post_type_object($post_type);

    // Check if the post type has a custom breadcrumb path
    switch ($post_type) {
        case 'post':
            $breadcrumbs[] = '<a href="' . esc_url(home_url('/blog')) . '">' . __('Blog', 'abtt-wp') . '</a>';
            break;
        case 'team':
            $breadcrumbs[] = '<a href="' . esc_url(home_url('/team')) . '">' . __('Team', 'abtt-wp') . '</a>';
            break;
        case 'services':
            $breadcrumbs[] = '<a href="' . esc_url(home_url('/services')) . '">' . __('Services', 'abtt-wp') . '</a>';
            break;
        // Add more cases for other post types as needed
    }

    // Get the ancestors of the post
    $parents = get_post_ancestors($post->ID);

    // Reverse the array to start from the top-level parent
    $parents = array_reverse($parents);

    foreach ($parents as $parent_id) {
        $breadcrumbs[] = '<a href="' . esc_url(get_permalink($parent_id)) . '">' . get_the_title($parent_id) . '</a>';
    }
}

$breadcrumbs[] = '<span>' . get_the_title() . '</span>';

?>
<section <?php echo esc_attr( $anchor ); ?> class="<?php echo esc_attr($className); ?>" style="<?php echo esc_attr( $style ); ?>">
    <div class="container">
        <div class="abtt-breadcrumb__row">
            <?php echo implode($divider, $breadcrumbs); ?>
        </div>
    </div>
</section>
