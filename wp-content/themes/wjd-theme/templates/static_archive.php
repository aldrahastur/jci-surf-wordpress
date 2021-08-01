<?php
defined('ABSPATH') or die();
use WJD\Utility\Breadcrumb;
use WJD\Utility\Pagination;

/**
 * Description: Default Index template to display loop of blog posts
 */
?>
<?php get_header(); ?>
<?php
$postID = get_queried_object_id();
$args = array(
    'post_type' => 'post',
    'posts_per_page' => -1,
    'cat' => get_post_meta($postID, '_wjd_meta_key', true)
);
$query = new \WP_Query($args);
if ($query->have_posts()) : ?>
    <main>
        <div class="v-hero hero has-max-width mb-xxl">

            <?php
                $has_hero_image = get_the_post_thumbnail_url(get_queried_object_id()) !== false
                ?>
            <?php if ($has_hero_image): ?>
            <div ref="heroSwiper">
                <img src="<?= get_the_post_thumbnail_url(get_queried_object_id()) ?>" alt="">
            </div>
            <?php endif; ?>
        </div>
        <div class="section">
            <div class="section__content container">
                <?php while (have_posts()) : the_post(); ?>
                    <?php 
                    $excerpt_length = 300;
                    $content = get_the_content();
                    $content = apply_filters('the_content', $content);
                    $content = strip_tags($content, '<br><br/><wbr><wbr/>');
                    if (mb_strlen($content) > $excerpt_length) {
                        $pos = strpos($content, ' ', $excerpt_length);
                    } else {
                        $pos = null;
                    }
                    ?>
                    <div class="views-row">
                        <div class="card v-card has-credit has-cta has-image has-link" data-url="<?php //the_permalink()?>">
                            <?php if (has_post_thumbnail()): ?>
                                <div class="card__image-wrapper">
                                    <figure class="figure">
                                        <div class="figure__image-wrapper is-highlighted">
                                            <div class="figure__image">
                                                <img src="<?= get_the_post_thumbnail_url() ?>" alt="">
                                            </div>
                                        </div>
                                    </figure>
                                    <div class="card__image-credit" title="<?= get_the_post_thumbnail_caption(); ?>">
                                        <?= get_the_post_thumbnail_caption(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="card__content">
                                <ul class="card__meta-data no-list-style">
                                    <li class="card__meta-data-item is-date">
                                        <?php the_date('d.m.Y') ?>
                                    </li>
                                    <li class="card__meta-data-item is-text">
                                        <?= get_the_category()[0]->name;?>
                                    </li>
                                </ul>
                                <div class="card__main">
                                    <h3 class="card__headline">
                                        <?= the_title() ?>
                                    </h3>
                                    <div class="rte-content v-margin-collapse">
                                        <p>
                                            <?php echo $pos === null ? $content : substr($content, 0, $pos); ?>
                                            <?php echo $pos === null ? '' : '...'; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="card__footer">
                                    <a href="<?php the_permalink()?>" ref="cta" class="card__cta is-link" target="_self">
                                        Mehr lesen
                                        <i class="card__icon  fas fa-chevron-right" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </main>
<?php endif; ?>
<div class="section">
    <div class="section__content container">
        <?= Pagination::wjd_paginate_links() ?>
    </div>
</div>
<?= Breadcrumb::nav_breadcrumb(); ?>
<?php
get_footer(); 
