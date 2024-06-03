<?php
use AbttWP\Classes\Social;

$channels = Social::$channels;

$url = $url ?? get_permalink();
$title = $title ?? html_entity_decode(get_the_title());
$description = $description ?? get_the_excerpt();

$classes = ['social-links'];
if (isset($class)) $classes[] = $class;

if (isset($header)) {
    echo '<div class="share-block' . (isset($class) ? " " . $class : "") . '">';
    echo '<div class="share-header">' . esc_html($header) . '</div>';
}
?>
<ul class="<?= join(" ", $classes) ?>">
    <?php
    if (isset($pre)) {
        echo $pre;
    }

    $shareChannels = Social::$shareChannels ?: array_keys($channels);
    foreach ($shareChannels as $key) {
        $vals = $channels[$key];
        $img = $vals['img'];
        $alt = $vals['label'];
        if (isset($vals['svg'])) {
            $img_elem = '<svg viewBox="0 0 133 100" width="100"><use xlink:href="' . $vals['svg'] . '"/></svg>';
        } else if (isset($vals['img'])) {
            // Calculate the retina image URL
            $retina_src = preg_replace('/(\.(?:png|jpg|gif))$/', '@2x$1', $img);
            // Output the image element with srcset attribute for retina display
            echo '<li>';
            echo '<a target="_blank" href="' . Social::get_share_url_for_post($key, $url, $title, $description) . '" class="share-icon share-' . $key . '" data-type="' . $key . '">';
            echo '<img src="' . $img . '" alt="' . $alt . '">';
            echo '</a>';
            echo '</li>';
        } else {
            $img_elem = $alt ?? $key;
        }
    }
    ?>
</ul>
<?php
if (isset($header)) {
    echo '</div>';
}
?>
