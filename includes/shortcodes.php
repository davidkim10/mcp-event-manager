<?php
global $mcp_cf7;
$workshop_shortcode_key = $mcp_cf7::KEY_WORKSHOPS;
$webinar_shortcode_key = $mcp_cf7::KEY_WEBINARS;
add_shortcode($workshop_shortcode_key, 'create_workshop_shortcode');
add_shortcode($webinar_shortcode_key, 'create_webinar_shortcode');

function create_workshop_shortcode() {
    global $mcp_cf7;
    $option_key = $mcp_cf7::DB_KEY_WORKSHOPS;
    $defaultOption = '<select><option>-- No events at this time --</option>';
    $options = get_option($option_key);
    $output = '';
    
    if(!empty($options)){
        $output = '<select class="mcp_live_events">';
        foreach($options as $option){
            $id = $option['id'];
            $location = $option['location'];
            $date = $option['date'];
            $time = date("g:iA", strtotime($option['time']));
            $output .= '<option value="'.$id.'">'.$location.' - '.$date.' at '.$time.'</option>';
        }
        $output .= '</select>';
    } else {
       $output = $defaultOption;
    }

    return $output;
}


function create_webinar_shortcode() {
    global $mcp_cf7;
    $option_key = $mcp_cf7::DB_KEY_WEBINARS;
    $defaultOption = '<select><option>-- No events at this time --</option>';
    $options = get_option($option_key);
    $output = '';
    
    if(!empty($options)){
        $output = '<select class="mcp_live_events">';
        foreach($options as $option){
            $id = $option['id'];
            $location = $option['location'];
            $date = $option['date'];
            $time = date("g:iA", strtotime($option['time']));
            $output .= '<option value="'.$id.'">'.$location.' - '.$date.' at '.$time.'</option>';
        }
        $output .= '</select>';
    } else {
       $output = $defaultOption;
    }

    return $output;
}
