<?php

defined('ABSPATH') or die();

/**
 * WJD2020 Wordpress Theme Functions
 */
$wjd_theme = wp_get_theme();
define('ASSET_VERSION', $wjd_theme->headers->version);
define('THEME_NAME', $wjd_theme->headers->TextDomain);
define('THEME_PATH', get_template_directory_uri()); 

require_once('vendor/autoload.php');

require_once('demo-import/demo-import.php');

$calendar = new WJD\Calendar\CalendarExtension();

// Default content for new page
add_filter( 'default_content', function() {
	return '<!-- wp:wjd/hero -->
<div class="wp-block-wjd-hero"><div class="gallery-grid" data-total-slides="0"></div></div>
<!-- /wp:wjd/hero -->

<!-- wp:wjd/group -->
<div class="wp-block-wjd-group"></div>
<!-- /wp:wjd/group -->';
} );

/*
 ** Altered default CF7 Shortcodes
 */
add_action('after_setup_theme','wjd_wpcf7_submit_button');
function wjd_wpcf7_submit_button() 
{
    if(function_exists('wpcf7_remove_form_tag')) {
        wpcf7_remove_form_tag('submit');
        remove_action( 'admin_init', 'wpcf7_add_tag_generator_submit', 55 );
        $wjd_cf7_module = TEMPLATEPATH . '/cf7/submit.php';
        require_once $wjd_cf7_module;
    }
}

add_action('after_setup_theme','wjd_wpcf7_acceptance');
function wjd_wpcf7_acceptance() 
{
    if(function_exists('wpcf7_remove_form_tag')) {
        wpcf7_remove_form_tag('acceptance');
        remove_action( 'admin_init', 'wpcf7_add_tag_generator_acceptance', 55 );
        $wjd_cf7_module = TEMPLATEPATH . '/cf7/acceptance.php';
        require_once $wjd_cf7_module;
    }
}

add_action('after_setup_theme','wjd_wpcf7_checkbox');
function wjd_wpcf7_checkbox() 
{
if(function_exists('wpcf7_remove_form_tag')) {
        wpcf7_remove_form_tag('radio');
        remove_action( 'admin_init', 'wpcf7_add_tag_generator_checkbox_and_radio', 55 );
        $wjd_cf7_module = TEMPLATEPATH . '/cf7/checkbox.php';
        require_once $wjd_cf7_module;
    }
}

add_action('admin_enqueue_scripts', 'wjd_admin_script');

function wjd_admin_script()
{
    wp_register_script('wjd-admin', THEME_PATH.'/js/admin.js', array('jquery'), '1.0.0', ASSET_VERSION);
    wp_enqueue_script('wjd-admin');
}

add_action('admin_enqueue_scripts', 'wjd_nova_admin_script');

function wjd_nova_admin_script()
{
    wp_register_script('wjd-nova-backend-option', THEME_PATH.'/js/backend-option.js', array('jquery'), '1.0.0', ASSET_VERSION);
    wp_enqueue_script('wjd-nova-backend-option');
}

$wjd = new WJD\Core\NOVA_WJD();

require_once('functions_nova.php');