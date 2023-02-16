<?php
add_action('wp_ajax_cf7_remove_field', 'cf7_remove_field');
add_action('wp_ajax_cf7_save_fields', 'cf7_save_fields');

function createID() {
    $timestamp = microtime(true);
    $id = uniqid($timestamp);
    $id = preg_replace("/[^a-zA-Z0-9]/", "", $id);
    return $id;
}


function cf7_save_fields() {
    $DATA = $_POST['data'];
    $OPTION_KEY = $_POST['optionKey'];
    $options = array();
        
    if(!$OPTION_KEY) {
        wp_send_json_error('optionKey missing');
        wp_die();
    }
    
    foreach($DATA as $field) {
        $options[] = array(
            'rowId' => createID(),
            'location' => $field['location'],
            'eventId' => $field['eventId'],
            'date' => $field['date'],
            'time' => $field['time']
        );
    }
    update_option($OPTION_KEY, $options);
    wp_send_json_success(json_encode( $options));
    wp_die();
}

function cf7_remove_field() { 
    $rowId = $_POST['rowId'];
    $optionKey = $_POST['optionKey'];
    
    if(!$optionKey) {
        wp_send_json_error('optionKey missing');
        wp_die();
    }

    $options = get_option($optionKey);
    if (!empty($options)) {
        foreach ($options as $index => $option) {
            if ($option['rowId'] == $rowId) {
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



