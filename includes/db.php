<?php
add_action('wp_ajax_cf7_remove_field', 'cf7_remove_field');
add_action('wp_ajax_cf7_save_fields', 'cf7_save_fields');

function cf7_save_fields() {
    $data = $_POST['data'];
    $optionKey = $_POST['optionKey'] ?? 'cf7_mcp_workshops';
    $options = array();
    foreach($data as $field) {
        $options[] = array(
            'location' => $field['location'],
            'id' => $field['id'],
            'date' => $field['date'],
            'time' => $field['time']
        );
    }
    update_option($optionKey, $options);
    wp_die();
}

function cf7_remove_field() { 
    $id = $_POST['id'];
    $optionKey = $_POST['optionKey'] ?? 'cf7_mcp_workshops';
    $options = get_option($optionKey);
    if (!empty($options)) {
        foreach ($options as $index => $option) {
            if ($option['id'] == $id) {
                unset($options[$index]);
                update_option($optionKey, $options);
                wp_send_json_success("Event removed successfully");
                wp_die();
            }
        }
    }
    $response = array('status' => 'error', 'message' => 'Entry not found');
    wp_send_json_error('Error removing field.');
    wp_die();
}



