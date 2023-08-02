<?php
/**
 * CMB2 metaboxes for the front-page.php
 * 
 * @since 1.0.0
 * @link https://github.com/CMB2/CMB2/blob/develop/example-functions.php
 * 
 */
if( ! function_exists('front_page_banner_metabox') ){

    function front_page_banner_metabox() {

        $prefix = 'banner_metabox_';
        /**
         * Sample metabox to demonstrate each field type included
         * 
         * @link https://developer.wordpress.org/reference/functions/add_meta_box/
         */
        $banner_metabox = new_cmb2_box( array(
            'id'            => $prefix . 'id',
            'title'         => esc_html__( 'Banner', 'cmb2' ),
            'object_types'  => array( 'page' ), // Post type
            // 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
            'context'    => 'side',
            'priority'   => 'high',
            'show_names' => true, // Show field names on the left
            // 'cmb_styles' => false, // false to disable the CMB stylesheet
            // 'closed'     => true, // true to keep the metabox closed by default
            // 'classes'    => 'extra-class', // Extra cmb2-wrap classes
            // 'classes_cb' => 'yourprefix_add_some_classes', // Add classes through a callback.
        ) );

        $banner_metabox->add_field( array(
            'name'       => esc_html__( 'Título del banner', 'cmb2' ),
            'id'         => $prefix . 'title',
            'type'       => 'text',
        ) );

        $banner_metabox->add_field( array(
            'name'       => esc_html__( 'Subtítulo del banner', 'cmb2' ),
            'id'         => $prefix . 'subtitle',
            'type'       => 'text',
        ) );

        
    }
    add_action( 'cmb2_admin_init', 'front_page_banner_metabox' );

}

if( ! function_exists( 'front_page_features_metabox' ) ) {

    function front_page_features_metabox() {
        $prefix = 'feature_metabox_';
        /**
         * Sample metabox to demonstrate each field type included
         * 
         * @link https://developer.wordpress.org/reference/functions/add_meta_box/
         */
        $feature_metabox = new_cmb2_box(
            array(
                'id'            => $prefix . 'id',
                'title'         => esc_html__( 'Características', 'cmb2' ),
                'object_types'  => array( 'page' ), // Post type
                // 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
                'context'    => 'normal',
                'priority'   => 'high',
                'show_names' => true, // Show field names on the left
                // 'cmb_styles' => false, // false to disable the CMB stylesheet
                // 'closed'     => true, // true to keep the metabox closed by default
                // 'classes'    => 'extra-class', // Extra cmb2-wrap classes
                // 'classes_cb' => 'yourprefix_add_some_classes', // Add classes through a callback.
            )
        );

        $feature_metabox->add_field(
            array(
                'name' => esc_html__( 'Website URL', 'cmb2' ),
                'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
                'id'   => $prefix . 'url',
                'type' => 'text_url',
                // 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
                // 'repeatable' => true,
            )
        );
    }
    add_action( 'cmb2_admin_init', 'front_page_features_metabox' );

}