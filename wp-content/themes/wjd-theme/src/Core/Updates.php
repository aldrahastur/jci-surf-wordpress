<?php
namespace WJD\Core;

defined('ABSPATH') or die();

require_once get_template_directory() . '/vendor/plugin-update-checker/plugin-update-checker.php';

/**
 * Auto Update logic
 */
class Updates {
    private $update_checker;

    public function __construct()
    {
        $this->update_checker = \Puc_v4_Factory::buildUpdateChecker(
            'https://wjd-frontend-wordpress-theme.s3.eu-central-1.amazonaws.com/master/wjd-theme.json',
            get_template_directory() . '/functions.php',
            'wjd-theme'
        );
    }
}
