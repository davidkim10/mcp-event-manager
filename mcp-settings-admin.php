<?php
add_action('admin_menu', 'mcp_add_admin_menus');

function mcp_add_admin_menus() {
  global $wp_mcp;
  $SETTINGS_URL_PATH = $wp_mcp::URL_PATH_ADMIN_HOME;
  add_menu_page(
    'Workshops and Webinars',
    'Workshops',
    'manage_options',
    $SETTINGS_URL_PATH,
    'mcp_admin_settings',
    'dashicons-calendar',
    2
  );
}

function render_admin_template() {
  global $wp_mcp;
  $option_key_workshops = $wp_mcp::DB_KEY_WORKSHOPS;
  $option_key_webinars = $wp_mcp::DB_KEY_WEBINARS;
  $workshops = get_option($option_key_workshops);
  $webinars = get_option($option_key_webinars);
  $workshopsCount = is_array($workshops) ? count($workshops) : 0;
  $webinarsCount = is_array($webinars) ? count($webinars) : 0;
  $workshops_page_url = admin_url("admin.php?page=" . $wp_mcp::URL_PATH_WORKSHOPS);
  $webinars_page_url = admin_url("admin.php?page=" . $wp_mcp::URL_PATH_WEBINARS);

  ob_start();
?>
  <div class="mcp-admin-home">
    <div class="container">
      <header style="margin-bottom: 20px;">
        <h1>Event Manager</h1>
      </header>
      <p>This plugin was designed to help team members maintain webinars and workshops on MyCollegePlan.com.</p>
      <section style="padding-bottom:50px; border-bottom: solid 1px #ccc;">
        <h2>Overview</h2>
        <table class="wp-list-table widefat fixed striped font-md td-align-center">
          <thead>
            <tr>
              <th><strong>Event Type</strong></th>
              <th><strong># Active Events</strong></th>
              <th><strong>Action</strong></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Workshops</td>
              <td>Active Events: <?php echo $workshopsCount; ?> </td>
              <td><a class="button-primary" href="<?php echo esc_url($workshops_page_url); ?>">Manage</a></td>
            </tr>
            <tr>
              <td>Webinars</td>
              <td>Active Events: <?php echo $webinarsCount; ?> </td>
              <td><a class="button-primary" href="<?php echo esc_url($webinars_page_url); ?>">Manage</a></td>
            </tr>
          </tbody>
        </table>
      </section>
      <section style="margin-top: 75px;">
        <h2>View All Workshops and Webinars</h2>
        <p>You can view all workshops and webinars by using the following shortcodes below. They will display all active events in a table format with a register button.</p>
        <table class="wp-list-table widefat fixed striped">
          <thead>
            <tr>
              <th>Type</th>
              <th>Shortcode</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Workshop</td>
              <td>[view_workshops]</td>
            </tr>
            <tr>
              <td>Webinars</td>
              <td>[view_webinars]</td>
            </tr>
          </tbody>
        </table>
      </section>
      <section style="margin-top: 75px;">
        <h2>Developer Documentation</h2>
        <p>The Event Manager plugin generates shortcodes that produce select elements with options formatted for web forms tailored to the specific business use case. To map the corresponding dropdown items to Contact Form 7, the shortcode should be initialized with the utility function(s) provided by the plugin. The shortcode syntax can be found under each table in its respective view.</p>

        <p>Alternatively, if you are using Contact Form 7, you can use the <a href="https://github.com/davidkim10/mcp-event-manager-cf7-integration" target="_blank" title="view plugin repository">mcp-cf7-integration plugin</a> to map the dropdown elements. You will be able to add the form tags directly in the CF7 form settings page. <strong>You do not need to use the utility functions if you choose this option.</strong></p>

        <h3 style="margin-top: 30px;">- Initialize the Fields</h3>
        <p>If you are using Contact Form 7, the utility functions to map the dropdown elements can be used when the page loads. Apply the specified class names to target your select elements.</p>
        <table class="wp-list-table widefat fixed striped">
          <thead>
            <tr>
              <th>Type</th>
              <th>Field Class</th>
              <th>Target Class</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Workshop</td>
              <td>mcp_workshops_field</td>
              <td>mcp_workshops_target</td>
            </tr>
            <tr>
              <td>Webinars</td>
              <td>mcp_webinars_field</td>
              <td>mcp_webinars_target</td>
            </tr>
          </tbody>
        </table>
        <pre><code class="language-php">// Initalize Example
jQuery(document).ready(function() {
    wpmcp_utils.select.init()
});</code></pre>
        <h3 style="margin-top: 30px;">- Dependencies</h3>
        <p>jQuery is required for this plugin to operate correctly.</p>
        <p>This plugin is not fully supported or guaranteed to work for browsers that use IE11.</p>
        <h3 style="margin-top: 30px;">- Plugin Updates</h3>
        <p>This plugin will receive updates from its repository located on <a href="https://github.com/davidkim10/mcp-event-manager-cf7-integration" target="_blank" title="Visit GitHub">GitHub</a>.</p>
      </section>
    </div>
  </div>
<?php
  return ob_get_clean();
}

function mcp_admin_settings() {
?>
  <?php echo render_admin_template(); ?>
<?php
}
