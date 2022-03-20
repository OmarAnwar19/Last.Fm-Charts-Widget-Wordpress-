<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              N/A
 * @since             1.0.0
 * @package           lastfm_Charts
 *
 * @wordpress-plugin
 * Plugin Name:       Last.Fm Music Charts
 * Plugin URI:        N/A
 * Description:       A simple plugin which allows you to insert music charts provided by Last.fm. Allows users to insert Top Tracks, Top Artists, or Top Tags charts.
 * Version:           1.0.0
 * Author:            Omar Anwar
 * Author URI:        https://www.omaranwar.ga
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       lastfm-charts
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
define( 'lastfm_CHARTS_VERSION', '1.0.0' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-lastfm-charts.php';

/**
 * Requiring our widget class
 */
require plugin_dir_path( __FILE__ ) . 'widget/class-lastfm-charts-widget.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_lastfm_charts() {

	define("PLUGIN_PATH", plugin_basename(__FILE__));

	$plugin = new lastfm_Charts();
	$plugin->run();

}

run_lastfm_charts();

