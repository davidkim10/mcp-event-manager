<?php
// *** Alerts ***
function render_alert_container() {
    ob_start();
    ?>
    <div class="cf7-mcp-alerts" id="cf7-mcp-alerts">
        <p class="container"></p>
    </div>
    <?php
    return ob_get_clean();
}

// *** Display Shortcode w/Copy Function 
function render_shortcode_section($shortcode) {
    ob_start();
    ?>
    <section>
        <h2><label for="mcp-live-event-shortcode">Shortcode</label></h2>
        <div class="input-group">
            <input type="text" id="mcp-live-event-shortcode" value="[<?php echo $shortcode; ?>]" readonly>
            <button class="button-secondary mcp-copy-btn">Copy</button>
        </div>
        <p style="font-style: italic;"><small>For developer usage</small></p>
    </section>
    <?php
    return ob_get_clean();
} 

function render_table_row($option, $num_rows, $className = "") {
    $class = $className ? ' ' . esc_attr($className) : '';
    $rowId = isset($option['rowId']) ? esc_attr($option['rowId']) : "";
    $html = '<tr class="custom-field-row' . $class .'" data-id="' . $rowId . '">';
    $input_fields = [
        'location' => ['type' => 'text', 'name' => 'cf7_custom_field_name', 'placeholder' => 'Location'],
        'eventId' => ['type' => 'text', 'name' => 'cf7_custom_field_eventId', 'placeholder' => 'Event ID'],
        'date' => ['type' => 'date', 'name' => 'cf7_custom_field_date', 'placeholder' => ''],
        'time' => ['type' => 'time', 'name' => 'cf7_custom_field_time', 'placeholder' => '']
    ];
    
    foreach ($input_fields as $key => $field) {
        $value = isset($option[$key]) ? esc_attr($option[$key]) : '';
        $type = esc_attr($field['type']);
        $name = esc_attr($field['name']) . '[]';
        $placeholder = esc_attr($field['placeholder']);
        $html .= '<td><input required type="' . $type . '" name="' . $name . '" value="' . $value . '" placeholder="' . $placeholder . '"></td>';
    }

    $remove_button_class = ($num_rows > 1) ? 'visible' : 'hide';
    $remove_button_classes = 'cf7-remove-field button-secondary ' . esc_attr($remove_button_class);
    $html .= '<td><button class="' . $remove_button_classes . '">Remove</button></td>';
    $html .= '</tr>';
    return $html;
}

function render_table($options, $num_rows = 0, $type = "workshops") {
    $location = $type == "webinars" ? "Zoom" : "";
    ob_start();
    ?>
    <table class="wp-list-table widefat fixed striped custom-fields custom-fields-wrap">
        <thead>
            <tr>
                <th>Location</th>
                <th>Event ID</th>
                <th>Date</th>
                <th>Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($options)) : ?>
                <?php foreach($options as $option) : ?>
                    <?php echo render_table_row($option, 2, "db_exist"); ?>
                <?php endforeach; ?>
            <?php else : ?>
                <?php $option = array('location' => $location, 'eventId' => '', 'date' => '', 'time' => ''); ?>
                <?php echo render_table_row($option, $num_rows); ?>
            <?php endif; ?>
        </tbody>
    </table>
    <?php
    return ob_get_clean();
}