<?php
// add_action( 'wp_enqueue_scripts', 'rg_load_styles');
// The PHP_INT_MAX constant tells WordPress to load this plugin last
add_action( 'wp_enqueue_scripts', 'rg_load_public_js', PHP_INT_MAX);
add_action( 'admin_enqueue_scripts', 'rg_load_admin_styles');
add_action( 'admin_enqueue_scripts', 'rg_load_admin_js', PHP_INT_MAX );

function rg_load_public_js() {
    wp_enqueue_script( 'mcp-utils', plugins_url('/public/utils.js', __FILE__ ), array( 'jquery' ), '1.0', true );
}

// START WP ADMIN ONLY -- Will not be public facing
function rg_load_admin_styles() {
    wp_enqueue_style( 'cf7-admin-styles', plugins_url('/css/cf7-admin-styles.css', __FILE__ ));
}

function rg_load_admin_js() {
    wp_enqueue_script( 'mcp-utils', plugins_url('/js/utils.js', __FILE__ ), array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'cf7-custom-tab-script', plugins_url('/js/cf7-mcp-custom-tab.js', __FILE__ ), array( 'jquery', 'mcp-utils' ), '1.0', true );
    wp_localize_script( 'cf7-custom-tab-script', 'cf7_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    wp_enqueue_script( 'mcp-js-init', plugins_url('/js/init.js', __FILE__ ), array( 'jquery', 'cf7-custom-tab-script' ), '1.0', true );
}
// END WP ADMIN ONLY
