<?php
/**
 * This snippet has been updated to reflect the official supporting of options pages by CMB2
 * in version 2.2.5.
 *
 * If you are using the old version of the options-page registration,
 * it is recommended you swtich to this method.
 */
add_action('cmb2_admin_init', 'cryptotask_register_theme_options_metabox');
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function cryptotask_register_theme_options_metabox()
{

    /**
     * Registers options page menu item and form.
     */
    $cmb_options = new_cmb2_box(array(
        'id' => 'cryptotask_option_metabox',
        'title' => esc_html__('CT Settings', 'cryptotask'),
        'object_types' => array('options-page'),

        /*
         * The following parameters are specific to the options-page box
         * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
         */

        'option_key' => 'cryptotask_options', // The option key and admin menu page slug.
        // 'icon_url'        => 'dashicons-palmtree', // Menu icon. Only applicable if 'parent_slug' is left empty.
        // 'menu_title'      => esc_html__( 'Options', 'cryptotask' ), // Falls back to 'title' (above).
        // 'parent_slug'     => 'themes.php', // Make options page a submenu item of the themes menu.
        // 'capability'      => 'manage_options', // Cap required to view options-page.
        // 'position'        => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
        // 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
        // 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
        // 'save_button'     => esc_html__( 'Save Theme Options', 'cryptotask' ), // The text for the options-page save button. Defaults to 'Save'.
    ));

    /*
     * Options fields ids only need
     * to be unique within this box.
     * Prefix is not needed.
     */

    $cmb_options->add_field(array(
        'name' => __('App URL', 'cryptotask'),
        'desc' => __('App frontend URL', 'cryptotask'),
        'id' => 'app_url',
        'type' => 'text',
    ));

    $cmb_options->add_field(array(
        'name' => __('App CSS URL', 'cryptotask'),
        'desc' => __('URL for main CSS file', 'cryptotask'),
        'id' => 'app_css',
        'type' => 'text',
    ));

    $cmb_options->add_field(array(
        'name' => __('S3 bucket URL', 'cryptotask'),
        'desc' => __('URL for S3 bucket where images are hosted', 'cryptotask'),
        'id' => 'app_s3_url',
        'type' => 'text',
    ));

    $cmb_options->add_field(array(
        'name' => __('Categories on front page', 'cryptotask'),
        'desc' => __('List of categories delimited with pipe | to be displayed on front page', 'cryptotask'),
        'id' => 'app_categories',
        'type' => 'text',
    ));

    $cmb_options->add_field(array(
        'name' => __('App Database Host', 'cryptotask'),
        'desc' => __('App backend database host URL', 'cryptotask'),
        'id' => 'app_db_host',
        'type' => 'text',
    ));

    $cmb_options->add_field(array(
        'name' => __('App Database Name', 'cryptotask'),
        'desc' => __('App backend database name', 'cryptotask'),
        'id' => 'app_db_name',
        'type' => 'text',
    ));

    $cmb_options->add_field(array(
        'name' => __('App Database Username', 'cryptotask'),
        'desc' => __('App backend database username', 'cryptotask'),
        'id' => 'app_db_username',
        'type' => 'text',
    ));

    $cmb_options->add_field(array(
        'name' => __('App Database Password', 'cryptotask'),
        'desc' => __('App backend database password', 'cryptotask'),
        'id' => 'app_db_password',
        'type' => 'text',
    ));

}

/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string $key Options array key
 * @param  mixed $default Optional default value
 * @return mixed           Option value
 */
function cryptotask_get_option($key = '', $default = false)
{
    if (function_exists('cmb2_get_option')) {
        // Use cmb2_get_option as it passes through some key filters.
        return cmb2_get_option('cryptotask_options', $key, $default);
    }

    // Fallback to get_option if CMB2 is not loaded yet.
    $opts = get_option('cryptotask_options', $default);

    $val = $default;

    if ('all' == $key) {
        $val = $opts;
    } elseif (is_array($opts) && array_key_exists($key, $opts) && false !== $opts[$key]) {
        $val = $opts[$key];
    }

    return $val;
}
