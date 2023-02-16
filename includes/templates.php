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
    $class = $className ? ' ' . $className : '';
    $html = '<tr class="custom-field-row' . $class . '">';
    $html .= '<td><input required type="text" name="cf7_custom_field_name[]" value="' . $option['location'] . '" placeholder="Location"></td>';
    $html .= '<td><input required type="text" name="cf7_custom_field_id[]" value="' . $option['id'] . '" placeholder="Event ID"></td>';
    $html .= '<td><input required type="date" name="cf7_custom_field_date[]" value="' . $option['date'] . '"></td>';
    $html .= '<td><input required type="time" name="cf7_custom_field_time[]" value="' . $option['time'] . '"></td>';
    $html .= '<td><button class="cf7-remove-field button-secondary ' . ($num_rows > 1 ? 'visible' : 'hide') . '">Remove</button></td>';
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
                <?php $option = array('location' => $location, 'id' => '', 'date' => '', 'time' => ''); ?>
                <?php echo render_table_row($option, $num_rows); ?>
            <?php endif; ?>
        </tbody>
    </table>
    <?php
    return ob_get_clean();
}