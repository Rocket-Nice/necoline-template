<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://Import-of-railways
 * @since             1.0.0
 * @package           Import_Of_Railways
 *
 * @wordpress-plugin
 * Plugin Name:       Import Of Railways
 * Plugin URI:        https://Import-of-railways
 * Description:       This is a description of the plugin.
 * Version:           1.0.0
 * Author:            Import-of-railways
 * Author URI:        https://Import-of-railways/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       import-of-railways
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'IMPORT_OF_RAILWAYS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-import-of-railways-activator.php
 */
function activate_import_of_railways() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-import-of-railways-activator.php';
	Import_Of_Railways_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-import-of-railways-deactivator.php
 */
function deactivate_import_of_railways() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-import-of-railways-deactivator.php';
	Import_Of_Railways_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_import_of_railways' );
register_deactivation_hook( __FILE__, 'deactivate_import_of_railways' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-import-of-railways.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_import_of_railways() {

	$plugin = new Import_Of_Railways();
	$plugin->run();

}
run_import_of_railways();
