<?php
add_shortcode( 'mcp_live_events', 'cf7_mcp_live_events_shortcode' );

function cf7_mcp_live_events_shortcode() {
    $defaultOption = '<select><option>-- No events at this time --</option>';
    $options = get_option('cf7_mcp_live_events');
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
