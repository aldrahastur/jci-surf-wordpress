<?php
defined('ABSPATH') or die();
?>
<?php get_header(); ?>
<main>
    <?php the_post(); ?>
    <?php the_content(); ?>
</main>
<?php
get_footer(); 
