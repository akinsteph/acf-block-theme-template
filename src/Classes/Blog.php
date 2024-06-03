<?php

namespace AbttWP\Classes;

class Blog
{
    public string $post_type = 'post';
    public int $post_per_page = 6;
    public int $paged = 1;

    public function __construct() {
        add_action( 'init', [ $this, 'update_posts_to_blogs'] );
        add_action( 'admin_menu', [ $this, 'change_admin_menu'] );
        add_action('wp_enqueue_scripts', [$this, 'load_blog_scripts']);

         // Filter ajax add action Callback
//         add_action('wp_ajax_blogs_filter_by_ajax', array($this,'blogs_filter_by_ajax'));//Filter new : ajax
//         add_action('wp_ajax_nopriv_blogs_filter_by_ajax', array($this,'blogs_filter_by_ajax'));//Filter new : ajax
//
//
//         // Filter ajax add action Callback
//         add_action('wp_ajax_blogs_paginate_by_ajax', array($this,'blogs_paginate_by_ajax'));//Paginate new by Tax : ajax
//         add_action('wp_ajax_nopriv_blogs_paginate_by_ajax', array($this,'blogs_paginate_by_ajax'));//Paginate new by Tax : ajax


    }

    public function load_blog_scripts()
    {
        //Enqueue scripts and styles only on Single psot page
        if (is_singular('post')) {
        }
    }

    /**
     * Change the posts name to blogs
     */
    public function update_posts_to_blogs() {
        global $wp_post_types;
        $labels = &$wp_post_types['post']->labels;

        $labels->name = 'Blogs';
        $labels->singular_name = 'Blogs';
        $labels->add_new = 'Add Blogs';
        $labels->add_new_item = 'Add Blogs';
        $labels->edit_item = 'Edit Blogs';
        $labels->new_item = 'Blogs';
        $labels->view_item = 'View Blogs';
        $labels->search_items = 'Search Blogs';
        $labels->not_found = 'No Blogs found';
        $labels->not_found_in_trash = 'No Blogs found in Trash';
        $labels->all_items = 'All Blogs';
        $labels->menu_name = 'Blogs';
        $labels->name_admin_bar = 'Blogs';
    }


    /**
     * Change the posts to news
     */
    public function change_admin_menu() {
        global $menu;
        global $submenu;

        $menu[5][0] = 'Blogs'; // Change Posts to Blogs
        $submenu['edit.php'][5][0] = 'Blogs';
        $submenu['edit.php'][10][0] = 'Add Blogs';
    }

    public function get_most_recent_featured_post() {

        $return_post = [];

        $args = [
            'post_type'           => $this->post_type,
            'posts_per_page'      => 1,
            'post__in'            => get_option('sticky_posts'),
            'ignore_sticky_posts' => 1,
            'orderby'        => 'post_date',
            'order'          => 'DESC',
        ];

        $results = new \WP_Query( $args );

        $posts = $results->posts;

        if ( ! empty( $posts ) ) {

            $post = $posts[0];

            $post_id = $post->ID;

            $article_heading = get_field('article_heading', $post_id) ?: $post->post_title;

            $post_thumbnail = has_post_thumbnail( $post_id )
                ? wp_get_attachment_image_src(get_post_thumbnail_id($post_id), array(400, 400))[0]
                :  ABTT_ASSETS_URI .'/post-dummy.png';

            $post_cover = get_field('landscape_post_image', $post_id)
                ? get_field('landscape_post_image', $post_id)
                :  get_template_image('placeholder-img', '', true);

            $author_id = get_post_field('post_author', $post_id);

            $author_details = get_field('article_author') ? Team::get_instance()->get_team_member_by_id(get_field('article_author') ) : [
                'title'        => get_the_author_meta('display_name', $author_id),
                'image'        => get_avatar_url($author_id),
                'designation'  => ''
            ];

            $categories = get_the_category($post_id);

            $return_post = [
                'id'                          => $post->ID,
                'slug'                        => $post->post_name,
                'title'                       => $article_heading,
                'summary'                     => wp_trim_words($post->post_content, 30, '...'),
                'image'                       => $post_thumbnail,
                'link'                        => get_permalink( $post->ID ),
                'date'                        => get_the_time('d M, Y', $post),
                'author'                      => $author_details,
                'category'                    => $categories
            ];
        }

        return $return_post;
    }

    /**
     * @param array $exclude
     * @param int $post_per_page
     * @param int $paged
     */
    public function get_all_blogs( array $exclude = [], int $post_per_page = 9, int $paged = 1) {
        if(empty($post_per_page)){
            $post_per_page = get_option( 'posts_per_page' );
        }
        if (empty($paged)) {
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        }

        $return_post = [];

        $args = [
            'post_type'           => $this->post_type,
            'posts_per_page'      => $post_per_page,
            'post__not_in'        => $exclude,
            'paged'               => $paged,
            'ignore_sticky_posts' => 1,
            'tax_query'           => [],
        ];

        $results = new \WP_Query( $args );

        $max_num_pages = $results->max_num_pages;

        $posts = $results->posts;

        $return_post['data']  = [];
        $return_post['count'] = 0;

        if ( ! empty( $posts ) ) {
            foreach ( $posts as $post ) {

                $post_thumbnail = ( has_post_thumbnail( $post->ID ) )
                    ?  wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), array(400, 400))[0]
                    : ABTT_ASSETS_IMAGES_URI .'/post-dummy.png';

                $return_post['data'][] = [
                    'id'                          => $post->ID,
                    'slug'                        => $post->post_name,
                    'title'                       => $post->post_title,
                    'excerpt'                     => $post->post_excerpt,
                    'summary'                     => wp_trim_words($post->post_content, 10, '...'),
                    'image'                       => $post_thumbnail,
                    'link'                        => get_permalink( $post->ID ),
                    'date'                        => get_the_time('d M, Y', $post),
                ];
            }

            $return_post['count'] = count( $posts );
        }

        $return_post['max_num_pages'] = $max_num_pages;

        return $return_post;
    }

    /**
     * @param $slug
     * @return array
     */
    public function get_blog_item_by_id($post_id) {
        $return_post = [];

        $args = [
            'posts_per_page'    => 1,
            'post_type'         => $this->post_type,
            'p'                 => $post_id,
            'post_status' => ['draft','publish'],

        ];

        $post = get_posts($args);

        if(!empty($post)) {

            $post = $post[0];
            $post_id = $post->ID;

            $article_heading = get_field('article_heading', $post->ID) ?: $post->post_title;


            $post_thumbnail = ( has_post_thumbnail( $post_id ) )
                ?  wp_get_attachment_image_src(get_post_thumbnail_id($post_id), array(400, 400))[0]
                : ABTT_ASSETS_IMAGES_URI .'/post-dummy.png';

            $post_cover = get_field('landscape_post_image', $post_id)
                ? get_field('landscape_post_image', $post_id)
                :  get_template_image('placeholder-img', '', true);

            $author_id = get_post_field('post_author', $post_id);

            $author_details = get_field('article_author') ? Team::get_instance()->get_team_member_by_id(get_field('article_author') ) : [
                'title'        => get_the_author_meta('display_name', $author_id),
                'image'        => get_avatar_url($author_id),
                'designation'  => ''
            ];

            $categories = get_the_category($post_id);

            $return_post = [
                'id'                          => $post->ID,
                'slug'                        => $post->post_name,
                'title'                       => $article_heading,
                'image'                       => $post_thumbnail,
                'cover'                       => $post_cover,
                'link'                        => get_permalink( $post->ID ),
                'summary'                     => wp_trim_words($post->post_content, 25, ''),
                'content'                     => $post->post_content,
                'date'                        => get_the_time('d M, Y', $post),
                'author'                      => $author_details,
                'category'                    => $categories,
                'reading_time'                => get_field('reading_time', $post_id)
            ];
        }

        return $return_post;
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
