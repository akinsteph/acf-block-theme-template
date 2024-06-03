<?php

namespace AbttWP\Classes;

class Social
{

    static $channels = [
        'instagram' => [
            'img'  => '/wp-content/themes/abtt-wp/assets/icons/instagram-light.svg',
            'label' => 'Instagram',
            'url' => 'https://www.instagram.com/we.are.abtt/',
        ],
        'linkedin' => [
            'img' => '/wp-content/themes/abtt-wp/assets/icons/linkedin-light.svg',
            'label' => 'LinkedIn',
            'url' => '#',
            'share_url' => 'https://www.linkedin.com/shareArticle?mini=true&url=#{url}&title=#{tagged_title}&summary=#{description}',
        ],
        'facebook' => [
            'img' => '/wp-content/themes/abtt-wp/assets/icons/facebook-light.svg',
            'label' => 'Facebook',
            'url' => '#',
            'app_id' => '252296078952383',
            'share_url' => 'https://www.facebook.com/dialog/share?app_id=#{app_id}&display=popup&href=#{url}',
        ],
        'email' => [
            'img' => '/wp-content/themes/abtt-wp/assets/icons/link-light.svg',
            'label' => 'Email',
            'share_url' => 'mailto:?body=#{url}&subject=#{tagged_title}',
        ],
//        'twitter' => [
//            'img' => '/wp-content/themes/abtt-wp/assets/icons/icon-twitter.png',
//            'label' => 'Twitter',
//            'url' => '#',
//            'share_url' => 'https://twitter.com/share?url=#{url}&text=#{tagged_title}'
//        ],
//        'whatsapp' => [
//            'img' => '/wp-content/themes/abtt-wp/assets/icons/icon-whatsapp.png',
//            'label' => 'WhatsApp',
//            'share_url' => 'https://api.whatsapp.com/send?text=#{url}'
//        ],
    ];


    static $shareChannels = null; # null = all
    static $socialChannels = null; # null = all - email


    public static function get_share_url_for_post( string $channel, ?string $url = null, ?string $title = null, ?string $description = null, ?string $tag = null ) : string
    {
        if( $url == null ) {
            $url = get_permalink();
        }
        if( $title == null ) {
            $title = html_entity_decode( get_the_title() );
        } // titles sometimes contain %#xx; entities
        if( $description == null ) {
            $description = get_the_excerpt();
        }

        $c = [];
        if( isset( self::$channels[ $channel ] ) ) {
            $c = self::$channels[ $channel ];
        }

        $tagged_title = ( $tag === null ) ? $title : $title . ' ' . $tag;

        if( isset( $c['share_url'] ) ) {
            $vals = array_merge( $c, [
                'url' => $url,
                'title' => $title,
                'description' => $description,
                'tagged_title' => $tagged_title,
            ] );

            return preg_replace_callback( '/\#\{([^\}]+)\}/', function ( $matches ) use ( $vals ) {
                if( isset( $vals[ $matches[1] ] ) ) {
                    return str_replace( '+', '%20', urlencode( $vals[ $matches[1] ] ) ); // + doesn't work too well with mail
                }

                return "";
            }, $c['share_url'] );
        }

        return "#";
    }


    public static function setChannels( array $in = [] ) : void
    {
        # Specifically overwriting given keys only so as not to override defaults for each network
        # This way, we don't have to specify *everything* every time.
        foreach( $in as $network => $values ) {
            foreach( $values as $k => $v ) {
                self::$channels[ $network ][ $k ] = $v;
            }
        }
    }


    public static function setShareChannels( array $shareChannels ) : void
    {
        # Channels to share posts/URLs via
        self::$shareChannels = $shareChannels;
    }


    public static function setSocialChannels( array $socialChannels ) : void
    {
        # Our Social pages that we want people to visit
        self::$socialChannels = $socialChannels;
    }


    /**
     * @return self
     */
    public static function get_instance() {
        static $instance = null;

        if (is_null($instance)) {
            $instance = new self();
        }

        return $instance;
    }
}
