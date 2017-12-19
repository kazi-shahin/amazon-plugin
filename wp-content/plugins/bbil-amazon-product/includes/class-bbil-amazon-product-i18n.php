<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       blubirdinteractive.com
 * @since      1.0.0
 *
 * @package    Bbil_Amazon_Product
 * @subpackage Bbil_Amazon_Product/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Bbil_Amazon_Product
 * @subpackage Bbil_Amazon_Product/includes
 * @author     Blubird Interactive <info@blubirdinteractive.com>
 */
class Bbil_Amazon_Product_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'bbil-amazon-product',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
