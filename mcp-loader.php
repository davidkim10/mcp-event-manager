<?php
// add_action( 'wp_enqueue_scripts', 'load_styles');
// The PHP_INT_MAX constant tells WordPress to load this plugin last
add_action( 'wp_enqueue_scripts', 'load_public_js', PHP_INT_MAX);
add_action( 'admin_enqueue_scripts', 'load_admin_js', PHP_INT_MAX );
add_action( 'admin_enqueue_scripts', 'load_admin_css');

function get_url($str) {
    return plugins_url($str, __FILE__ );
}

function load_public_js() {
    wp_enqueue_script( 'mcp-utils', get_url('/assets/public/utils.js'), array( 'jquery' ), '1.0', true );
}

// START WP ADMIN ONLY -- Will not be public facing
function load_admin_css() {
    wp_enqueue_style( 'cf7-admin-styles', get_url('/assets/css/cf7-admin-styles.css'));
}

function load_admin_js() {
    wp_enqueue_script( 'mcp-utils', get_url('/assets/js/utils.js'), array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'cf7-custom-tab-script', get_url('/assets/js/cf7-mcp-custom-tab.js'), array( 'jquery', 'mcp-utils' ), '1.0', true );
    wp_localize_script( 'cf7-custom-tab-script', 'cf7_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    wp_enqueue_script( 'mcp-js-init', get_url('/assets/js/init.js', __FILE__ ), array( 'jquery', 'cf7-custom-tab-script' ), '1.0', true );
}
// END WP ADMIN ONLY
