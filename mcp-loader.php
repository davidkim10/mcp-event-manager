<?php
// Load Assets
// The PHP_INT_MAX constant tells WordPress to load this plugin last
add_action( 'wp_enqueue_scripts', 'load_public_js', PHP_INT_MAX);
add_action( 'admin_enqueue_scripts', 'load_admin_js', PHP_INT_MAX );
add_action( 'admin_enqueue_scripts', 'load_admin_css');

function get_asset($str) {
    return plugins_url($str, __FILE__ );
}

function load_public_js() {
    wp_enqueue_script( 'mcp-utils', get_asset('/assets/public/utils.js'), array( 'jquery' ), '1.0', true );
}

// START WP ADMIN ONLY -- Will not be public facing
function load_admin_css() {
    wp_enqueue_style( 'cf7-admin-styles', get_asset('/assets/css/cf7-admin-styles.css'));
}

function load_admin_js() {
    wp_enqueue_script( 'mcp-utils', get_asset('/assets/js/utils.js'), array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'mcp-db', get_asset('/assets/js/db.js'), array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'mcp-scripts', get_asset('/assets/js/scripts.js'), array( 'jquery', 'mcp-utils', 'mcp-db' ), '1.0', true );
    wp_localize_script( 'mcp-scripts', 'mcp_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    wp_enqueue_script( 'mcp-js-init', get_asset('/assets/js/init.js', __FILE__ ), array( 'jquery', 'mcp-scripts' ), '1.0', true );
}
// END WP ADMIN ONLY
