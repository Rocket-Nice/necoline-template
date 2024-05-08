<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://Import-of-railways
 * @since      1.0.0
 *
 * @package    Import_Of_Railways
 * @subpackage Import_Of_Railways/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Import_Of_Railways
 * @subpackage Import_Of_Railways/includes
 * @author     Import-of-railways <Import-of-railways@Import-of-railways>
 */
class Import_Of_Railways_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'import-of-railways',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
