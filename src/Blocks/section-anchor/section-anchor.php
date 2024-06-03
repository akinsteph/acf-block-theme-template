<?php
/**
 * Article Highlight Block template.
 *
 * @param array $block The block settings and attributes.
 */
global $post;
// Load values and assign defaults.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="section-anchor-block-' . esc_attr( $block['anchor'] ) . '" ';
}

$className = '';
if( !empty($block['className']) ) {
    $className .= $block['className'];
}

if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$section_title                   = get_field('section_anchor_text');

$className .= 'section-anchor';

?>
<section <?php echo esc_attr( $anchor ); ?> class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <div class="section-anchor__row">
            <div class="section-anchor__row-content">
                <?php if($section_title){ ?>
                    <h3 class="section-anchor__row-content-text">
                        <?php esc_html_e( $section_title,'abtt-wp') ?>
                    </h3>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
