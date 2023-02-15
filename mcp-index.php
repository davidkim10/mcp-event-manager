<?php
/*
Plugin Name: CF7 Manage Events - MyCollegePlan
Description: A cleaner UI to add events for CF7 for MyCollegePlan
Version: 1.0.0
Author: David K
Author URI: https://davekim.io

License: MIT
License URI: https://opensource.org/licenses/MIT

Requires PHP: 7.4
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class MCP {
	const KEY_WORKSHOPS = 'mcp_workshops';
	const KEY_WEBINARS = 'mcp_webinars';
	const DB_KEY_WORKSHOPS = "cf7_mcp_workshops";
	const DB_KEY_WEBINARS = "cf7_mcp_webinars";
	private static $instance;
	private function __construct() {
	  // constructor code here
	}
	public static function get_instance() {
	  if ( ! isset( self::$instance ) ) {
		self::$instance = new self();
	  }
	  return self::$instance;
	}
}

// Store the instance in a global variable
global $mcp_cf7;
$mcp_cf7 = MCP::get_instance();

require_once plugin_dir_path( __FILE__ ) . 'mcp-loader.php';
require_once plugin_dir_path( __FILE__ ) . 'mcp-settings-workshops.php'; 
require_once plugin_dir_path( __FILE__ ) . 'mcp-settings-webinars.php'; 
require_once plugin_dir_path( __FILE__ ) . 'includes/shortcodes.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/db.php';