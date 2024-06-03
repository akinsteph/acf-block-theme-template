<?php
use AbttWP\Classes\Social;

add_action('abtt_loaded', function() {
    Social::setChannels([
        'twitter' => [
            'img' => '/wp-content/themes/abtt-wp/assets/icons/twitter.png',
            'label' => 'Twitter',
        ],
        'facebook' => [
            'img' => '/wp-content/themes/abtt-wp/assets/icons/facebook-light.svg',
            'label' => 'Facebook',
        ],
        'linkedin' => [
            'img' => '/wp-content/themes/abtt-wp/assets/icons/linkedin-light.svg',
            'label' => 'Linkedin',
        ],
        'email' => [
            'img' => '/wp-content/themes/abtt-wp/assets/icons/link-light.svg',
            'label' => 'Email',
        ],
        'instagram' => [
            'img' => '/wp-content/themes/abtt-wp/assets/icons/instagram-light.svg',
            'label' => 'Instagram',
        ],
    ]);

    Social::setShareChannels(['instagram', 'linkedin', 'facebook', 'email']);
    Social::setSocialChannels(['twitter', 'facebook', 'instagram']);
});
