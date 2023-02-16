<?php
global $mcp_cf7;
$workshop_shortcode_key = $mcp_cf7::KEY_WORKSHOPS;
$webinar_shortcode_key = $mcp_cf7::KEY_WEBINARS;
add_shortcode($workshop_shortcode_key, 'create_workshop_shortcode');
add_shortcode($webinar_shortcode_key, 'create_webinar_shortcode');

function create_select_field($options, $option_key, $id_key, $defaultOptionClass) {
    $defaultOption = "<select class=\"$defaultOptionClass\"><option>-- No events at this time --</option></select>";
    $output = "<select class=\"$option_key\">";

    if(empty($options)) {
        return $defaultOption;
    }
    
    foreach($options as $option){
        $id = $option[$id_key];
        $location = $option['location'];
        $date = $option['date'];
        $time = date("g:iA", strtotime($option['time']));
        $output .= "<option value=\"$id\">$location - $date at $time</option>";
    }
    $output .= "</select>";
    return $output;
}

function create_workshop_shortcode() {
    global $mcp_cf7;
    $option_key = 'mcp_workshops_field';
    $options = get_option($mcp_cf7::DB_KEY_WORKSHOPS);
    return create_select_field($options, $option_key, 'id', $option_key . ' mcp-empty');
}

function create_webinar_shortcode() {
    global $mcp_cf7;
    $option_key = 'mcp_webinars_field';
    $options = get_option($mcp_cf7::DB_KEY_WEBINARS);
    return create_select_field($options, $option_key, 'eventId', $option_key . ' mcp-empty');
}
