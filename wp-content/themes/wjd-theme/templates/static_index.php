<?php
defined('ABSPATH') or die();
use WJD\Utility\Breadcrumb;
?>
<?php get_header(); ?>
<main id="<?php echo get_post_field( 'post_name', get_post() ) ?? ''; ?>">
    <?php the_post(); ?>

    <?php if(has_block('wjd/hero')): ?>
        <?php the_content(); ?>
    <?php elseif(!isset($_GET['old'])): ?>
        <div class="container">
            <?php
                $size = 'cover';
                $attributes['heroHeight'] = 600;

                $thumbnail = get_the_post_thumbnail_url();

                $extra_classes = !empty($thumbnail) ? 'hero__no_image' : '';

                $output = '';
                $output .= '<div class="v-hero hero has-max-width mb-xxl">';

                if (!empty($thumbnail)):
                    $output .= '<div class="hero-swiper test swiper-container">';
                    $output .= '<div class="swiper-wrapper">';
                    $output .= '<div class="swiper-slide" style="
                                height:' . $attributes['heroHeight'] . 'px!important; 
                                background-image:url(' . get_the_post_thumbnail_url() . '); 
                                background-position:' . $attributes['heroDetailHorizontalSelect'] . ' ' . $attributes['heroDetailVerticalSelect'] . ';
                                background-repeat: no-repeat;
                                background-size:' . $size . '
                                ">';
                    $output .= '</div>';
                    $output .= '</div>';
                    $output .= '</div>';
                endif;

                $margin_top = 'style="' . (empty($thumbnail) ? 'margin-top: 0; width: 100%;' : 'margin-top: -130px') . '"';

                $output .= '<div class="hero__box ' . $extra_classes . ' is-highlighted" ' . $margin_top . '>';
                $output .= '<h1 class="hero__headline">'. get_the_title() .'</h1>';
                $output .= '</div>';
                $output .= '</div>';

                echo $output;
            ?>
            <?php the_content(); ?>
        </div>
    <?php else: ?>
        <?php the_content(); ?>

    <?php endif; ?>

    <?php Breadcrumb::nav_breadcrumb(); ?>
</main>
<?php
get_footer(); 
