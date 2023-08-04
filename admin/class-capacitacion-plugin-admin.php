<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/marcoAspeitia31/
 * @since      1.0.0
 *
 * @package    Capacitacion_Plugin
 * @subpackage Capacitacion_Plugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Capacitacion_Plugin
 * @subpackage Capacitacion_Plugin/admin
 * @author     Marco Aspeitia <maspeitiap@devitm.com>
 */
class Capacitacion_Plugin_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->load_dependencies();

		add_action( 'rest_api_init', array( $this, 'cp_post_new_rest_fields' ) );

	}

	public function load_dependencies() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/custom-fields/front-page-fields.php';
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Capacitacion_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Capacitacion_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/capacitacion-plugin-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Capacitacion_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Capacitacion_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/capacitacion-plugin-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register custom fields in the WP REST API v2
	 * 
	 * @since 1.0.0
	 * @link https://developer.wordpress.org/reference/functions/register_rest_field/
	 */
	public function cp_post_new_rest_fields(){

		register_rest_field( 
			array( 'post' ),
			'featured_image_src',
			array(
				'get_callback' 		=> array( $this, 'cp_get_featured_image_src' ),
				'update_callback'   => null,
				'schema'			=> null
			)
		);

		register_rest_field(
			'post',
			'categories_names',
			array(
				'get_callback' 		=> array( $this, 'cp_get_categories_names' ),
				'update_callback'	=> null,
				'schema'			=> null
			)
		);

	}

	// Get the image src
	public function cp_get_featured_image_src( $object ) {

		if( $object['featured_media'] ) {

			$field = wp_get_attachment_image_src( $object['featured_media'], 'thumbnail', false );

			return $field[0];

		}

		return false;

	}

	// Get the categories names
	public function cp_get_categories_names( $array ) {

		$categories_names = array();

		$categories = get_the_terms( $array[ 'id' ], 'category' );

		foreach( $categories as $category ) {
			array_push($categories_names, $category->name);
		}

		return $categories_names;

	}

}
