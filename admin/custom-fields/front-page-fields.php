<?php
/**
 * CMB2 metaboxes for the front-page.php
 * 
 * @since 1.0.0
 * @link https://github.com/CMB2/CMB2/blob/develop/example-functions.php
 * 
 */
if( ! function_exists('front_page_banner_metabox') ) {

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

if( ! function_exists( 'front_page_banner' ) ) {

    function front_page_banner() {

        $prefix = 'banner_group_metabox_';

        /**
         * Repeatable Field Groups
         */
        $banner_group_metabox = new_cmb2_box( array(
            'id'           => $prefix . 'id',
            'title'        => esc_html__( 'Banner', 'cmb2' ),
            'object_types' => array( 'page' ),
        ) );

        // $group_field_id is the field id string, so in this case: 'yourprefix_group_demo'
        $group_field_id = $banner_group_metabox->add_field( array(
            'id'          => $prefix . 'group',
            'type'        => 'group',
            'description' => esc_html__( 'Agrega distintos slides al banner del sitio web', 'cmb2' ),
            'options'     => array(
                'group_title'    => esc_html__( 'Slide {#}', 'cmb2' ), // {#} gets replaced by row number
                'add_button'     => esc_html__( 'Agregar slide', 'cmb2' ),
                'remove_button'  => esc_html__( 'Remover slide', 'cmb2' ),
                'sortable'       => true,
                'closed'      => true, // true to have the groups closed by default
                'remove_confirm' => esc_html__( '¿Estás seguro de eliminar éste slide?', 'cmb2' ), // Performs confirmation before removing group.
            ),
        ) );

        $banner_group_metabox->add_group_field( $group_field_id, array(
            'name'       => esc_html__( 'Título del slide', 'cmb2' ),
            'id'         => 'title',
            'type'       => 'text',
            // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
        ) );

        $banner_group_metabox->add_group_field( $group_field_id, array(
            'name'        => esc_html__( 'Descripcion del slide', 'cmb2' ),
            'description' => esc_html__( 'Agrega un texto llamativo para el slide', 'cmb2' ),
            'id'          => 'description',
            'type'        => 'textarea_small',
        ) );

        $banner_group_metabox->add_group_field( $group_field_id, array(
            'name'       => esc_html__( 'Texto del botón uno', 'cmb2' ),
            'id'         => 'button_one',
            'type'       => 'text',
            // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
        ) );

        $banner_group_metabox->add_group_field( $group_field_id, array(
            'name' => esc_html__( 'URL botón 1', 'cmb2' ),
            'id'   => 'url_one',
            'type' => 'text_url',
        ) );

        $banner_group_metabox->add_group_field( $group_field_id, array(
            'name'       => esc_html__( 'Texto del botón dos', 'cmb2' ),
            'id'         => 'button_two',
            'type'       => 'text',
            // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
        ) );

        /**
         * Retrieves all pages of the website
         * 
         * @link https://developer.wordpress.org/reference/functions/get_pages/
         */
        $pages = get_pages( );
        $select_options = array();

        foreach( $pages as $page ) {
            $select_options[ get_permalink( $page->ID ) ] = $page->post_title ;
        }

        $banner_group_metabox->add_group_field( $group_field_id, array(
            'name'             => esc_html__( 'URL botón 2', 'cmb2' ),
            'id'               => 'url_two',
            'type'             => 'select',
            'show_option_none' => true,
            'options'          => $select_options,
        ) );
        

    }
    add_action( 'cmb2_admin_init', 'front_page_banner' );

}