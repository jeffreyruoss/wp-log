<?php
/**
 * Plugin Name: WP Log
 *
 * @link              https://jeffruoss.com
 * @since             1.0.0
 * @package           Wp_Log
 *
 * @wordpress-plugin
 * Plugin URI:        https://jeffruoss.com
 * Description:       A log system for custom child themes and custom plugins.
 * Version:           1.0.0
 * Author:            Jeff Ruoss
 * Author URI:        https://jeffruoss.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-log
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Log admin page
 */
require plugin_dir_path( __FILE__ ) . 'log-admin.php';


/**
 * Create log entry
 */
require plugin_dir_path( __FILE__ ) . 'create-log-entry.php';
