<?php 
namespace WJD\Core;

defined('ABSPATH') or die();

require_once get_template_directory() . '/vendor/tgm-plugin-activation/class-tgm-plugin-activation.php';

/**
 * Plugin depencies
 */
class Plugins {
    public function __construct()
    {
        add_action( 'tgmpa_register', array($this, 'wjd_theme_register_required_plugins') );
    }
    
    /**
     * Register the required plugins for this theme.
     *
     * In this example, we register five plugins:
     * - one included with the TGMPA library
     * - two from an external source, one from an arbitrary source, one from a GitHub repository
     * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
     *
     * The variables passed to the `tgmpa()` function should be:
     * - an array of plugin arrays;
     * - optionally a configuration array.
     * If you are not changing anything in the configuration array, you can remove the array and remove the
     * variable from the function call: `tgmpa( $plugins );`.
     * In that case, the TGMPA default settings will be used.
     *
     * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
     */
    function wjd_theme_register_required_plugins() {
        /*
        * Array of plugin arrays. Required keys are name and slug.
        * If the source is NOT from the .org repo, then source is also required.
        */
        $plugins = array(
            // WJD Gutenberg Blocks
            array(
                'name'         => 'WJD Gutenberg Blocks',
                'slug'         => 'wjd-plugin-gutenberg',
                'source'       => 'https://wjd-frontend-wordpress-plugin-gutenberg.s3.eu-central-1.amazonaws.com/master/wjd-plugin-gutenberg.zip', // The plugin source.
                'required'     => true, 
                'external_url' => 'https://gitlab.com/wjd-frontend/wordpress-plugin-gutenberg', 
            ),

            // Contact Form 7
            array(
                'name'      => 'Contact Form 7',
                'slug'      => 'contact-form-7',
                'required'  => true,
            ),

            // Safe SVG
            array(
                'name'      => 'Safe SVG',
                'slug'      => 'safe-svg',
                'required'  => true,
            ),
            
            // My Calendar
            array(
                'name'      => 'My Calendar',
                'slug'      => 'my-calendar',
                'required'  => false,
            ),
            
            // Events-Manager
            array(
                'name'      => 'Events Manager',
                'slug'      => 'events-manager',
                'required'  => true,
            ),
            array(
                'name'         => 'Events Manager Pro',
                'slug'         => 'events-manager-pro',
                'source'       => get_template_directory_uri() . '/plugins/events-manager-pro.zip', // The plugin source.
                'required'     => true, 
                'external_url' => 'https://eventsmanagerpro.com/', 
            ),

            array(
                'name'         => 'Gravity Forms',
                'slug'         => 'gravityforms',
                'source'       => get_template_directory_uri() . '/plugins/gravityforms.zip', // The plugin source.
                'required'     => true, 
                'external_url' => 'https://www.gravityforms.com/', 
            ),

            array(
                'name'         => 'One Click Demo Import',
                'slug'         => 'one-click-demo-import',
                'source'       => get_template_directory_uri() . '/plugins/one-click-demo-import.zip', // The plugin source.
                'required'     => true, 
                'external_url' => 'https://github.com/awesomemotive/one-click-demo-import', 
            ),

            // // One Click Demo Import
            // array(
            //     'name'      => 'One Click Demo Import',
            //     'slug'      => 'https://github.com/awesomemotive/one-click-demo-import',
            //     'required'  => true,
            // ),   

            // This is an example of the use of 'is_callable' functionality. A user could - for instance -
            // have WPSEO installed *or* WPSEO Premium. The slug would in that last case be different, i.e.
            // 'wordpress-seo-premium'.
            // By setting 'is_callable' to either a function from that plugin or a class method
            // `array( 'class', 'method' )` similar to how you hook in to actions and filters, TGMPA can still
            // recognize the plugin as being installed.
            array(
                'name'        => 'WordPress SEO by Yoast',
                'slug'        => 'wordpress-seo',
                'is_callable' => 'wpseo_init',
            ),

        );

        /*
        * Array of configuration settings. Amend each line as needed.
        *
        * TGMPA will start providing localized text strings soon. If you already have translations of our standard
        * strings available, please help us make TGMPA even better by giving us access to these translations or by
        * sending in a pull-request with .po file(s) with the translations.
        *
        * Only uncomment the strings in the config array if you want to customize the strings.
        */
        $config = array(
            'id'           => 'wjd-theme',                 // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '',                      // Default absolute path to bundled plugins.
            'menu'         => 'tgmpa-install-plugins', // Menu slug.
            'parent_slug'  => 'themes.php',            // Parent menu slug.
            'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
            'has_notices'  => true,                    // Show admin notices or not.
            'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => true,                    // Automatically activate plugins after installation or not.
            'message'      => '',                      // Message to output right before the plugins table.

            
            'strings'      => array(
                'page_title'                      => __( 'Install Required Plugins', 'wjd-theme' ),
                'menu_title'                      => __( 'Install Plugins', 'wjd-theme' ),
                /* translators: %s: plugin name. */
                'installing'                      => __( 'Installing Plugin: %s', 'wjd-theme' ),
                /* translators: %s: plugin name. */
                'updating'                        => __( 'Updating Plugin: %s', 'wjd-theme' ),
                'oops'                            => __( 'Something went wrong with the plugin API.', 'wjd-theme' ),
                'notice_can_install_required'     => _n_noop(
                    /* translators: 1: plugin name(s). */
                    'This theme requires the following plugin: %1$s.',
                    'This theme requires the following plugins: %1$s.',
                    'wjd-theme'
                ),
                'notice_can_install_recommended'  => _n_noop(
                    /* translators: 1: plugin name(s). */
                    'This theme recommends the following plugin: %1$s.',
                    'This theme recommends the following plugins: %1$s.',
                    'wjd-theme'
                ),
                'notice_ask_to_update'            => _n_noop(
                    /* translators: 1: plugin name(s). */
                    'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                    'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                    'wjd-theme'
                ),
                'notice_ask_to_update_maybe'      => _n_noop(
                    /* translators: 1: plugin name(s). */
                    'There is an update available for: %1$s.',
                    'There are updates available for the following plugins: %1$s.',
                    'wjd-theme'
                ),
                'notice_can_activate_required'    => _n_noop(
                    /* translators: 1: plugin name(s). */
                    'The following required plugin is currently inactive: %1$s.',
                    'The following required plugins are currently inactive: %1$s.',
                    'wjd-theme'
                ),
                'notice_can_activate_recommended' => _n_noop(
                    /* translators: 1: plugin name(s). */
                    'The following recommended plugin is currently inactive: %1$s.',
                    'The following recommended plugins are currently inactive: %1$s.',
                    'wjd-theme'
                ),
                'install_link'                    => _n_noop(
                    'Begin installing plugin',
                    'Begin installing plugins',
                    'wjd-theme'
                ),
                'update_link' 					  => _n_noop(
                    'Begin updating plugin',
                    'Begin updating plugins',
                    'wjd-theme'
                ),
                'activate_link'                   => _n_noop(
                    'Begin activating plugin',
                    'Begin activating plugins',
                    'wjd-theme'
                ),
                'return'                          => __( 'Return to Required Plugins Installer', 'wjd-theme' ),
                'plugin_activated'                => __( 'Plugin activated successfully.', 'wjd-theme' ),
                'activated_successfully'          => __( 'The following plugin was activated successfully:', 'wjd-theme' ),
                /* translators: 1: plugin name. */
                'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'wjd-theme' ),
                /* translators: 1: plugin name. */
                'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'wjd-theme' ),
                /* translators: 1: dashboard link. */
                'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'wjd-theme' ),
                'dismiss'                         => __( 'Dismiss this notice', 'wjd-theme' ),
                'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'wjd-theme' ),
                'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'wjd-theme' ),

                'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
            ),
            
        );

        tgmpa( $plugins, $config );
    } // end wjd_theme_register_required_plugins
}

