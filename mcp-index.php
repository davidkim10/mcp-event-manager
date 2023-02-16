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

// Plugin Configuration
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'mcp_plugin_settings_link');

function mcp_plugin_settings_link( $links ) {
  $settings_link = '<a href="' . admin_url( 'admin.php?page=mcp-plugin-settings' ) . '">' . __( 'Settings', 'mcp-plugin' ) . '</a>';
  array_splice( $links, count( $links ) - 1, 0, $settings_link );
  return $links;
}

class MCP {
  const URL_PATH_ADMIN_HOME= 'mcp-workshops-and-webinars';
  const URL_PATH_WORKSHOPS= 'mcp-add-workshops';
  const URL_PATH_WEBINARS= 'mcp-add-webinars';
  const KEY_WORKSHOPS = 'mcp_workshops';
  const KEY_WEBINARS = 'mcp_webinars';
  const DB_KEY_WORKSHOPS = "cf7_mcp_workshops";
  const DB_KEY_WEBINARS = "cf7_mcp_webinars";
  
  private static $instance;
  private function __construct() {}

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

require_once plugin_dir_path( __FILE__ ) . 'mcp-scripts-loader.php';
require_once plugin_dir_path( __FILE__ ) . 'mcp-settings-admin.php';
require_once plugin_dir_path( __FILE__ ) . 'mcp-settings-workshops.php'; 
require_once plugin_dir_path( __FILE__ ) . 'mcp-settings-webinars.php'; 
require_once plugin_dir_path( __FILE__ ) . 'includes/shortcodes.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/db.php';