<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       blubirdinteractive.com
 * @since      1.0.0
 *
 * @package    Bbil_Amazon_Product
 * @subpackage Bbil_Amazon_Product/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Bbil_Amazon_Product
 * @subpackage Bbil_Amazon_Product/public
 * @author     Blubird Interactive <info@blubirdinteractive.com>
 */
class Bbil_Amazon_Product_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Bbil_Amazon_Product_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Bbil_Amazon_Product_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( $this->plugin_name.'-bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-jquery_ui', plugin_dir_url( __FILE__ ) . 'css/jquery-ui.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-jquery_ui_theme', plugin_dir_url( __FILE__ ) . 'css/jquery-ui.theme.min.css', array(), $this->version, 'all' );

		wp_enqueue_style( $this->plugin_name.'-ubuntu', 'https://fonts.googleapis.com/css?family=Ubuntu', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-pacifico', 'https://fonts.googleapis.com/css?family=Pacifico', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-font_awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), $this->version, 'all' );

		wp_enqueue_style( $this->plugin_name.'-common', plugin_dir_url( __FILE__ ) . 'css/common-styles.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-style', plugin_dir_url( __FILE__ ) . 'css/style.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-mediaquery', plugin_dir_url( __FILE__ ) . 'css/mediaquery.css', array(), $this->version, 'all' );

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/bbil-amazon-product-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Bbil_Amazon_Product_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Bbil_Amazon_Product_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name.'-jquery_ui', plugin_dir_url( __FILE__ ) . 'js/jquery-ui.min.js', array('jquery'), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'-bootstrap', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array('jquery'), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'-masonry', 'https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js', array('jquery'), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'-custom', plugin_dir_url( __FILE__ ) . 'js/custom.js', array('jquery'), $this->version, false );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/bbil-amazon-product-public.js', array('jquery'), $this->version, false );

	}

}
