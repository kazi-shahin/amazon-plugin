<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              blubirdinteractive.com
 * @since             1.0.0
 * @package           Bbil_Amazon_Product
 *
 * @wordpress-plugin
 * Plugin Name:       BBIL Amazon Products
 * Plugin URI:        #
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Blubird Interactive
 * Author URI:        blubirdinteractive.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bbil-amazon-product
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently pligin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bbil-amazon-product-activator.php
 */
function activate_bbil_amazon_product() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bbil-amazon-product-activator.php';
	Bbil_Amazon_Product_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bbil-amazon-product-deactivator.php
 */
function deactivate_bbil_amazon_product() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bbil-amazon-product-deactivator.php';
	Bbil_Amazon_Product_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_bbil_amazon_product' );
register_deactivation_hook( __FILE__, 'deactivate_bbil_amazon_product' );

/**
 * The class responsible for loading amazon api
 * Custome amazon api class.
 */
require_once plugin_dir_path( __FILE__ ) . 'lib/amazon/amazon_product_api.php';

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-bbil-amazon-product.php';
require plugin_dir_path( __FILE__ ) . 'includes/ajax_functions_call.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_bbil_amazon_product() {

	$plugin = new Bbil_Amazon_Product();
	$plugin->run();

}
run_bbil_amazon_product();
