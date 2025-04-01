<?php
global $wp_mcp;
$workshop_shortcode_key = $wp_mcp::KEY_WORKSHOPS;
$webinar_shortcode_key = $wp_mcp::KEY_WEBINARS;
add_shortcode($workshop_shortcode_key, 'create_workshop_shortcode');
add_shortcode($webinar_shortcode_key, 'create_webinar_shortcode');
add_shortcode('view_workshops', 'view_all_workshops_shortcode');
add_shortcode('view_webinars', 'view_all_webinars_shortcode');

function create_select_field($options, $option_key, $id_key, $defaultOptionClass) {
    $className = "mcp-field";
    $defaultOption = "<select class=\"$className $defaultOptionClass\"><option>-- No events at this time --</option></select>";
    $output = "<select class=\"$className $option_key\">";

    if (empty($options)) {
        return $defaultOption;
    }

    foreach ($options as $option) {
        $id = sanitize_text_field($option[$id_key]);
        $location = sanitize_text_field($option['location']);
        $date = date("m/d/Y", strtotime($option['date']));
        $time = date("g:iA", strtotime(sanitize_text_field($option['time'])));
        $output .= "<option value=\"$id\">" . esc_html("$location - $date at $time") . "</option>";
    }
    $output .= "</select>";
    return $output;
}

function cf7_mcp_generate_events_table($events, $type = 'workshops') {
    $output  = '<table class="table-striped mcp-table mcp-table-' . $type . '">';
    $output .= '<thead><tr><th>Location</th><th>Date</th><th>Time</th><th>---</th></tr></thead>';
    $output .= '<tbody>';
    foreach ($events as $event) {
        // Ensure required keys exist.
        if (! isset($event['eventId'], $event['location'], $event['date'], $event['time'])) {
            continue;
        }
        $id       = sanitize_text_field($event['eventId']);
        $location = sanitize_text_field($event['location']);
        $date     = date("m/d/Y", strtotime($event['date']));
        $time     = date("g:iA", strtotime(sanitize_text_field($event['time'])));
        $location_label = $location . ' - ' . $date . ' at ' . $time;
        $href     = '/lp-free-college-planning-webinar?type=' . $type . '&eventId=' . $id . '&location=' . urlencode($location_label);

        $output .= '<tr class="mcp-item" data-event-id="' . esc_attr($id) . '">';
        $output .= '<td class="mcp-location">' . esc_html($location) . '</td>';
        $output .= '<td class="mcp-date">' . esc_html($date) . '</td>';
        $output .= '<td class="mcp-time">' . esc_html($time) . '</td>';
        $output .= '<td style="text-align: center;"><a class="btn btn-color-primary btn-size-extra-small" href="' . $href . '" class="mcp-register-link link"><strong>Register</strong></a></td>';
        $output .= '</tr>';
    }
    $output .= '</tbody></table>';
    return $output;
}

function create_workshop_shortcode() {
    global $wp_mcp;
    $option_key = 'mcp_workshops_field';
    $options = get_option($wp_mcp::DB_KEY_WORKSHOPS);
    return create_select_field($options, $option_key, 'eventId', $option_key . ' mcp-field mcp-empty');
}

function create_webinar_shortcode() {
    global $wp_mcp;
    $option_key = 'mcp_webinars_field';
    $options = get_option($wp_mcp::DB_KEY_WEBINARS);
    return create_select_field($options, $option_key, 'eventId', $option_key . 'mcp-field mcp-empty');
}

// Shortcode: [view_workshops]
function view_all_workshops_shortcode() {
    global $wp_mcp;
    $workshops = get_option($wp_mcp::DB_KEY_WORKSHOPS);

    if (empty($workshops) || ! is_array($workshops)) {
        return '<p class="mcp-empty mcp-empty-workshops">No workshops available at this time.</p>';
    }
    return cf7_mcp_generate_events_table($workshops, 'workshops');
}

// Shortcode: [view_webinars]
function view_all_webinars_shortcode() {
    global $wp_mcp;
    $webinars = get_option($wp_mcp::DB_KEY_WEBINARS);

    if (empty($webinars) || !is_array($webinars)) {
        return '<p class="mcp-empty mcp-empty-webinars">No webinars available at this time.</p>';
    }
    return cf7_mcp_generate_events_table($webinars, 'webinars');
}
