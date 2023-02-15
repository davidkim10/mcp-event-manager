<?php
require_once 'cf7-mcp-templates.php';

add_action( 'admin_menu', 'cf7_add_workshops' );

function cf7_add_workshops() {
    add_submenu_page(
        'wpcf7',
        'Add Workshop',
        'Add Workshop',
        'manage_options',
        'cf7-add-add-workshop',
        'cf7_add_workshops_admin_panel'
    );
}

function cf7_add_workshops_admin_panel() {
    $options = get_option('cf7_mcp_live_events');
    $num_rows= count($options) ?? 0;
    ?>
    <div class="cf7-mcp-tabs" style="padding: 40px 40px 0 20px;">
        <?php echo render_alert_container(); ?>
        <header class="header">
            <h1>Manage Workshops</h1>
            <div class="btn-group">
                <button class="cf7-add-field button-secondary">Add Workshop</button>
                <button class="cf7-save-fields button-primary">Save & Publish</button>
            </div>
        </header>
        <?php echo render_table($options, $num_rows); ?>
        <p>
            <button class="cf7-save-fields button-primary">Save & Publish</button>
        </p>
        <div style="margin: 50px 0 25px 0;">
          <label for="mcp-live-event-shortcode"><strong>Use Shortcode:</strong></label>
          <input type="text" id="mcp-live-event-shortcode" value="[mcp_live_events]" readonly>
          <p style="font-style: italic;"><small>Don't forget to initialize and map fields for CF7. Use the public mcp_utils.</small></p>
        </div>
    </div>
    <script>
        jQuery(document).ready(function($) {
            $('.cf7-add-field').click(function(e) {
                e.preventDefault();
                
                var num_rows = <?php echo $num_rows; ?>;
                var html = '<?php echo addslashes(render_table_row(array('location' => '', 'id' => '', 'date' => '', 'time' => ''), 3)); ?>';
                $('table.custom-fields tbody').append(html);
            });
        });
    </script>
    <?php
}
