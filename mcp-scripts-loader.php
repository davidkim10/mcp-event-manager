<?php
// Load Assets
// The PHP_INT_MAX constant tells WordPress to load this plugin last
add_action('wp_enqueue_scripts', 'load_public_js', PHP_INT_MAX);
add_action('admin_enqueue_scripts', 'load_admin_js', PHP_INT_MAX);
add_action('admin_enqueue_scripts', 'load_admin_css');

function get_asset($str) {
    return plugins_url($str, __FILE__);
}

function load_public_js() {
    wp_enqueue_script('mcp-public-utils', get_asset('/assets/public/utils.js'), array('jquery'), '1.2', true);
}

// START WP ADMIN ONLY 
function load_admin_css() {
    wp_enqueue_style('mcp-admin-styles', get_asset('/assets/css/mcp-admin-styles.css'));
}

function load_admin_js() {
    wp_enqueue_script('mcp-admin-alerts', get_asset('/assets/js/_alerts.js'), array('jquery'), '1.2', true);
    wp_enqueue_script('mcp-admin-utils', get_asset('/assets/js/_utils.js'), array('jquery'), '1.2', true);
    wp_enqueue_script('mcp-admin-db', get_asset('/assets/js/_db.js'), array('jquery'), '1.2', true);
    wp_enqueue_script('mcp-admin-events', get_asset('/assets/js/_events.js'), array('jquery', 'mcp-admin-utils', 'mcp-admin-db'), '1.2', true);
    wp_enqueue_script('mcp-admin-init', get_asset('/assets/js/init.js', __FILE__), array('jquery', 'mcp-admin-events'), '1.2', true);
    wp_localize_script('mcp-admin-db', 'mcp_ajax_config', array('endpoint' => admin_url('admin-ajax.php')));
}
// END WP ADMIN ONLY
