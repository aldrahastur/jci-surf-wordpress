<?php
defined('ABSPATH') or die();
?>
<?php get_header(); ?>
<?php if ( is_front_page() && is_home() ) {
    $pageTemplate = TEMPLATEPATH . '/templates/default_home.php';
} elseif ( is_front_page() ) {
    $pageTemplate = TEMPLATEPATH . '/templates/static_home.php';
} elseif ( is_home() ) {
    $pageTemplate = TEMPLATEPATH . '/templates/static_blog.php';
} elseif ( is_archive() ) {
    $pageTemplate = TEMPLATEPATH . '/templates/static_archive.php';
} else {
    $pageTemplate = TEMPLATEPATH . '/templates/static_index.php';
}
require_once $pageTemplate;
?>
