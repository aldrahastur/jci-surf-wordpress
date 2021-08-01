<?php
defined('ABSPATH') or die();
use WJD\Utility\Breadcrumb;
?>
<?php get_header(); ?>
<main>
    <?php the_post(); ?>
    <?php the_content(); ?>
</main>
<?php
get_footer(); 
