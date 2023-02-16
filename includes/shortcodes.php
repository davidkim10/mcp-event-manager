<?php
global $wp_mcp;
$workshop_shortcode_key = $wp_mcp::KEY_WORKSHOPS;
$webinar_shortcode_key = $wp_mcp::KEY_WEBINARS;
add_shortcode($workshop_shortcode_key, 'create_workshop_shortcode');
add_shortcode($webinar_shortcode_key, 'create_webinar_shortcode');

function create_select_field($options, $option_key, $id_key, $defaultOptionClass) {
    $className = "mcp-field-sanitized";
    $defaultOption = "<select class=\"$className $defaultOptionClass\"><option>-- No events at this time --</option></select>";
    $output = "<select class=\"$className $option_key\">";

    if(empty($options)) {
        return $defaultOption;
    }
    
    foreach($options as $option){
        $id = sanitize_text_field($option[$id_key]);
        $location = sanitize_text_field($option['location']);
        $date = date("m/d/Y", strtotime($option['date']));
        $time = date("g:iA", strtotime(sanitize_text_field($option['time'])));
        $output .= "<option value=\"$id\">" . esc_html("$location - $date at $time") . "</option>";
    }
    $output .= "</select>";
    return $output;
}


function create_workshop_shortcode() {
    global $wp_mcp;
    $option_key = 'mcp_workshops_field';
    $options = get_option($wp_mcp::DB_KEY_WORKSHOPS);
    return create_select_field($options, $option_key, 'id', $option_key . ' mcp-field mcp-empty');
}

function create_webinar_shortcode() {
    global $wp_mcp;
    $option_key = 'mcp_webinars_field';
    $options = get_option($wp_mcp::DB_KEY_WEBINARS);
    return create_select_field($options, $option_key, 'eventId', $option_key . 'mcp-field mcp-empty');
}
