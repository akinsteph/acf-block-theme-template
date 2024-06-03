<?php

namespace AbttWP\Core;
class AdminCustomizer {
    public function __construct() {
        add_action( 'customize_register', [$this, 'register_customizer_fields']);

    }

    //Add Customise Options
    public function register_customizer_fields ( $wp_customize ) {

        // Main Panel
        $wp_customize->add_panel('Abtt_wp', [
            'title' => __('Abtt Settings', 'abtt-wp'),
            'description' => '<p> Abtt Theme Settings</p>',
            'priority' => 10
        ]);



        // Footer Section
        $wp_customize->add_section( 'abtt-footer-section' , array(
            'title'      => __( 'Footer Section', 'abtt-wp' ),
            'priority'   => 30,
            'panel' => 'Abtt_wp'

        ) );


        $wp_customize->add_setting('abtt-logo-setting');
        $wp_customize->add_control(new \WP_Customize_Image_Control($wp_customize, 'abtt-logo-control',
            array(
                'label' => 'Abtt White Mini Logo',
                'section' => 'abtt-footer-section',
                'settings' => 'abtt-logo-setting',
            )
        ));
    }


    /**
     * Singleton poop.
     *
     * @return Customizer|null
     */
    public static function get_instance() {
        static $instance = null;

        if (is_null($instance)) {
            $instance = new self();
        }

        return $instance;
    }


}
