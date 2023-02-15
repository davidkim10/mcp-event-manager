<?php
require_once plugin_dir_path( __FILE__ ) . 'includes/templates.php';
add_action( 'admin_menu', 'cf7_add_workshops' );

function cf7_add_workshops() {
    add_submenu_page(
        'wpcf7',
        'Add Workshop',
        'Add Workshop',
        'manage_options',
        'cf7-add-workshop',
        'admin_settings_workshops'
    );
}

function admin_settings_workshops() {
    global $mcp_cf7;
    $optionKey = $mcp_cf7::DB_KEY_WORKSHOPS;
    $shortcode = $mcp_cf7::KEY_WORKSHOPS;
    $options = get_option($optionKey);
    $num_rows = is_array($options) ? count($options) : 0;
    ?>
    <div class="cf7-mcp-tabs" style="padding: 40px 40px 0 20px;" data-scope="<?php echo $optionKey; ?>">
        <?php echo render_alert_container(); ?>
        <header class="header">
            <h1>Manage Workshops</h1>
            <div class="btn-group">
                <button class="cf7-add-field button-secondary">Add Workshop</button>
                <button class="cf7-save-fields button-primary" data-scope="<?php echo $optionKey; ?>">Save & Publish</button>
            </div>
        </header>
        <?php echo render_table($options, $num_rows); ?>
        <p>
        <button class="cf7-save-fields button-primary" data-scope="<?php echo $optionKey; ?>">Save & Publish</button>
        </p>
        <div style="margin: 50px 0 25px 0;">
          <label for="mcp-live-event-shortcode"><strong>Use Shortcode:</strong></label>
          <input type="text" id="mcp-live-event-shortcode" value="[<?php echo $shortcode; ?>]" readonly>
          <p style="font-style: italic;"><small>Don't forget to initialize and map fields for CF7. Use the public mcp_utils.</small></p>
        </div>
    </div>
    <script>
        jQuery(document).ready(function($) {
            $('.cf7-remove-field').attr('data-scope','<?php echo $optionKey; ?>');
            $('.cf7-add-field').click(function(e) {
                e.preventDefault();
                var tableRow = '<?php echo addslashes(render_table_row(array('location' => '', 'id' => '', 'date' => '', 'time' => ''), 2)); ?>';
                $('table.custom-fields tbody').append(tableRow);
            });
        });
    </script>
    <?php
}
