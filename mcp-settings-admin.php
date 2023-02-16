<?php
add_action( 'admin_menu', 'mcp_add_admin_menus' );

function mcp_add_admin_menus() {
    add_menu_page(
        'Workshops and Webinars',
        'Workshops',
        'manage_options',
        'mcp-workshops-and-webinars',
        'mcp_admin_settings',
        'dashicons-email',
        80
    );
}

function render_admin_template() {
    global $mcp_cf7;
    $option_key_workshops = $mcp_cf7::DB_KEY_WORKSHOPS;
    $option_key_webinars = $mcp_cf7::DB_KEY_WEBINARS;

    $workshops = get_option( $option_key_workshops);
    $webinars = get_option( $option_key_webinars);
    $workshopsCount = is_array($workshops) ? count($workshops) : 0;
    $webinarsCount = is_array($webinars) ? count($webinars) : 0;

    $workshops_page_url = admin_url('admin.php?page=mcp-add-webinar');
    $webinars_page_url = admin_url('admin.php?page=mcp-add-webinar');

    ob_start();
    ?>

    <div class="mcp-admin-home">
        <div class="container">
            <header>
                <h1>Event Manager</h1>
            </header>
            <section>
                <h2>Workshops & Webinars</h2>
                <p>This plugin was designed to help team members maintain webinars and workshops on MyCollegePlan.com.</p>
            </section>
            <section style="padding-bottom:50px; border-bottom: solid 1px #ccc;">
                <h2>Event Overview</h2>
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
                        <td>Active Events: <?php echo $workshopsCount ;?> </td>
                        <td><a class="button-primary" href="<?php echo esc_url($workshops_page_url); ?>">Manage Events</a></td>
                    </tr>
                    <tr>
                        <td>Webinars</td>
                        <td>Active Events: <?php echo $webinarsCount ;?> </td>
                        <td><a class="button-primary" href="<?php echo esc_url($webinars_page_url); ?>">Manage Events</a></td>
                    </tr>
                    </tbody>
                </table>
            </section>
            <section>
                <h2>Developer Documentation</h2>
                <p>The Event Manager plugin generates shortcodes that produce select elements with options formatted for web forms tailored to the specific business use case. To map the corresponding dropdown items to Contact Form 7, the shortcode should be initialized with the utility function(s) provided by the plugin. The shortcode syntax can be found under each table in its respective view.</p>

                <h3 style="margin-top: 30px;">- Initialize the Fields</h3>
                <p>If you are using Contact Form 7, the utility functions to map the dropdown elements can be used when the page loads. Apply the specified class names to target your select elements.</p>
                <table class="wp-list-table widefat fixed striped">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Selector</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Workshop</td>
                            <td>.workshops_target</td>
                        </tr>
                        <tr>
                            <td>Webinars</td>
                            <td>.webinars_target</td>
                        </tr>
                    </tbody>
                </table>
                <pre><code class="language-php">// Initalize Example
jQuery('document').ready(function() {
    mcp_utils.select.init()
});</code></pre>
                
                <h3 style="margin-top: 30px;">- Dependencies</h3>
                <p>jQuery is required for this plugin to operate correctly.</p>

                <h3 style="margin-top: 30px;">- Plugin Updates</h3>
                <p>This plugin will receive updates from its repository located on GitHub.</p>
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
