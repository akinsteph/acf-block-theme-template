<?php
/**
 * Article Quote Block template.
 *
 * @param array $block The block settings and attributes.
 */
global $post;
// Load values and assign defaults.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="quote-block-' . esc_attr( $block['anchor'] ) . '" ';
}

$className = '';
if( !empty($block['className']) ) {
    $className .= $block['className'];
}

if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$quote_text                 = get_field('quote_text');
$quote_author                = get_field('quote_author');
$background_colour        = !empty(get_field('background_colour')) ? get_field('background_colour') : '#446274';

$className .= 'article-quote';

$styles = [ 'background-color: ' . $background_colour ];

$style  = implode( '; ', $styles );

?>
<section <?php echo esc_attr( $anchor ); ?> class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <blockquote class="article-quote__row" style="<?php echo esc_attr( $style ); ?>">
            <?php echo get_template_icon('quote-icon', 'quote-icon', false); ?>
            <?php if(!empty($quote_text)){ ?>
                <div class="article-quote__row-content-text">
                    <?php echo $quote_text; ?>
                </div>
            <?php }
                if(!empty($quote_author)){?>
                    <cite class="article-quote__row-content-author">
                        <?php echo esc_attr($quote_author); ?>
                    </cite>
            <?php } ?>
        </blockquote>
    </div>
</section>
