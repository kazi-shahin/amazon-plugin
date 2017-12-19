<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       blubirdinteractive.com
 * @since      1.0.0
 *
 * @package    Bbil_Amazon_Product
 * @subpackage Bbil_Amazon_Product/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Bbil_Amazon_Product
 * @subpackage Bbil_Amazon_Product/admin
 * @author     Blubird Interactive <info@blubirdinteractive.com>
 */
class Bbil_Amazon_Product_Admin {

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
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name.'-bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/bbil-amazon-product-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
        wp_enqueue_script( $this->plugin_name.'-bootstrap', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/bbil-amazon-product-admin.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Add menu items in admin area
	 *
	 * @since    1.0.0
	 */
	public function add_menus() {
        add_menu_page('Amazon Store', 'Amazon Store', 'manage_options', 'bbil_astore', function (){ $this->bbil_run_plugin(); } ,'',10);
        add_submenu_page('bbil_astore', 'Setup wizard', 'Setup wizard', 'manage_options', 'bbil_astore' );
        add_submenu_page('bbil_astore', 'Theme options', 'Theme options', 'manage_options', 'bbil-theme_options', function (){ $this->bbil_theme_options(); } );
        add_submenu_page('bbil_astore', 'Preferences', 'Preferences', 'manage_options', 'bbil-preferences', function (){ $this->bbil_preferences(); } );
        add_submenu_page('bbil_astore', 'SEO setting', 'SEO setting', 'manage_options', 'bbil-seo', function (){ $this->bbil_seo(); } );
        add_submenu_page('bbil_astore', 'Amazon credential', 'Amazon credential', 'manage_options', 'bbil-amazon_credentials', function (){ $this->bbil_amazon_credentials(); } );
        add_submenu_page('bbil_astore', 'Amazon Categories', 'Amazon Categories', 'manage_options', 'bbil-amazon_categories', function (){ $this->bbil_amazon_categories(); } );
        add_submenu_page('bbil_astore', 'Amazon item', 'Amazon item', 'manage_options', 'bbil-amazon_item', function (){ $this->bbil_amazon_item(); } );
        add_submenu_page('bbil_astore', 'Analytics', 'Analytics', 'manage_options', 'bbil-analytics', function (){ $this->bbil_analytics(); } );
	}

    // Run the plugin
    public function bbil_run_plugin(){
        include plugin_dir_path( dirname( __FILE__ ) ).'admin/templates/setup_wizard.php';
    }

    // bbil_preferences
    public function bbil_preferences(){
        echo 'bbil_preferences';
        //include plugin_dir_path( dirname( __FILE__ ) ).'admin/templates/setup_wizard.php';
    }

    // bbil_seo
    public function bbil_seo(){
        echo 'bbil_seo';
        //include plugin_dir_path( dirname( __FILE__ ) ).'admin/templates/setup_wizard.php';
    }

    // bbil_theme_options
    public function bbil_theme_options(){
        echo 'bbil_theme_options';
        //include plugin_dir_path( dirname( __FILE__ ) ).'admin/templates/setup_wizard.php';
    }

    // bbil_amazon_credentials
    public function bbil_amazon_credentials(){
        echo 'bbil_amazon_credentials';
        //include plugin_dir_path( dirname( __FILE__ ) ).'admin/templates/setup_wizard.php';
    }

    // bbil_amazon_categories
    public function bbil_amazon_categories(){
        echo 'bbil_amazon_categories';
        //include plugin_dir_path( dirname( __FILE__ ) ).'admin/templates/setup_wizard.php';
    }

    // bbil_amazon_item
    public function bbil_amazon_item(){
        echo 'bbil_amazon_item';
        //include plugin_dir_path( dirname( __FILE__ ) ).'admin/templates/setup_wizard.php';
    }

    // bbil_analytics
    public function bbil_analytics(){
        echo 'bbil_analytics';
        //include plugin_dir_path( dirname( __FILE__ ) ).'admin/templates/setup_wizard.php';
    }
}
