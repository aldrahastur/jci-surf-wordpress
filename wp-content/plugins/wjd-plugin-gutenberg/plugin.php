<?php
/**
 * Plugin Name: WJD Gutenberg Blocks
 * Description: Gutenberg Blöcke für das WJD 2020 Theme.
 * Author: Wirtschaftsjunioren Deutschland e.V.
 * Version: 1.0.5
 *
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Block Initializer.
 */
require_once plugin_dir_path( __FILE__ ) . 'src/init.php';

require_once plugin_dir_path( __FILE__ ) . 'vendor/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://wjd-frontend-wordpress-plugin-gutenberg.s3.eu-central-1.amazonaws.com/master/wjd-plugin-gutenberg.json',
	__FILE__, //Full path to the main plugin file or functions.php.
	'wjd-plugin-gutenberg'
);
