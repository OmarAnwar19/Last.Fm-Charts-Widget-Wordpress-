<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       N/A
 * @since      1.0.0
 *
 * @package    lastfm_Charts
 * @subpackage lastfm_Charts/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    lastfm_Charts
 * @subpackage lastfm_Charts/admin
 * @author     Omar Anwar <omaranwar04@gmail.com>
 */
class lastfm_Charts_Admin {

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
		$this->define_settings();
		$this->define_plugin_functions();

	}

	public function load_dependencies() {
		
		/**
		 * Requiring our settings class
		 */
		require_once plugin_dir_path( __FILE__ ) . 'partials/class-lastfm-charts-settings.php';

		/**
		 * Requiring our plugin_functions class
		 */
		require_once plugin_dir_path( __FILE__ ) . 'partials/class-lastfm-charts-functions.php';

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
		 * defined in lastfm_Charts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The lastfm_Charts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/lastfm-charts-admin.css', array(), $this->version, 'all' );

	}

	//Defining our plugin settings
	private function define_settings() {
		new plugin_settings_config;
	}

	//Setting up other plugin functions
	private function define_plugin_functions() {
		new plugin_functions;
	}

}
