<?php
require_once plugin_dir_path(__FILE__) . 'includes/templates.php';
add_action('admin_menu', 'register_mcp_admin_settings_webinars');

function register_mcp_admin_settings_webinars() {
  global $wp_mcp;
  $SETTINGS_URL_PATH = $wp_mcp::URL_PATH_WEBINARS;
  add_submenu_page(
    'mcp-workshops-and-webinars',
    'Edit Webinars',
    'Edit Webinars',
    'manage_options',
    $SETTINGS_URL_PATH,
    'admin_settings_webinars'
  );
}

function admin_settings_webinars() {
  global $wp_mcp;
  $optionKey = $wp_mcp::DB_KEY_WEBINARS;
  $shortcode = $wp_mcp::KEY_WEBINARS;
  $options = get_option($optionKey);
  $num_rows = is_array($options) ? count($options) : 0;
?>
  <div class="cf7-mcp-tabs" style="padding: 40px 40px 0 20px;" data-scope="<?php echo $optionKey; ?>">
    <?php echo render_alert_container(); ?>
    <header class="header">
      <h1>Webinars</h1>
    </header>
    <section class="section-wrapper">
      <div class="table-header">
        <h2>Manage Events</h2>
        <div class="btn-group">
          <button class="cf7-add-field button-secondary">Add</button>
          <button class="cf7-save-fields button-primary" data-scope="<?php echo $optionKey; ?>">Save & Publish</button>
        </div>
      </div>
      <div>
        <?php echo render_table($options, $num_rows, "webinars"); ?>
        <p>Friendly Reminder: All fields are required
        <p>
      </div>
      <div style="margin: 20px 0;">
        <button class="cf7-save-fields button-primary" data-scope="<?php echo $optionKey; ?>">Save & Publish</button>
      </div>
    </section>
    <?php echo render_shortcode_section($shortcode); ?>
  </div>
  <script>
    jQuery(document).ready(function($) {
      $('.cf7-remove-field').attr('data-scope', '<?php echo $optionKey; ?>');
      $('.cf7-add-field').click(function(e) {
        e.preventDefault();
        var tableRow = '<?php echo addslashes(render_table_row(array('location' => 'Zoom', 'id' => '', 'date' => '', 'time' => ''), 2)); ?>';
        $('table.custom-fields tbody').append(tableRow);
      });
    });
  </script>
<?php
}
