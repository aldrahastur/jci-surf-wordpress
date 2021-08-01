<?php
/**
 * @package WordPress
 */

use WJD\TemplatePart\DesktopMenuWalker;
use WJD\TemplatePart\ResponsiveMenuWalker;
use WJD\TemplatePart\SubMenuWalker;

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes();?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class('page-' . get_post_field( 'post_name', get_post() ) ?? '');?>>
        <header>
            <div class="js-header header is-closed is-inverted ">
                <div class="header__container container">
                    <div class="header__container-inner">
                        <div class="header__head">
                            <?php
                            the_custom_logo();
                            if (!has_custom_logo()) {
                                ?>
                                <p><?php bloginfo('name'); ?></p>
                                <?php
                            }
                            ?>
                            <button class="header__toggle hamburger hamburger--emphatic-r no-focus-outline" type="button" aria-label="Menu" aria-controls="headerigation">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                        <nav data-name="meta-nav" class="meta-nav header__meta-nav  is-level-0">
                            <ul class="meta-nav__items no-list-style is-level-0">
                                <li class="meta-nav__item is-level-0 has-name">                                   
                                    <?php 
                                    if (function_exists('dynamic_sidebar')) {
                                        dynamic_sidebar('header-column-1');
                                    }
                                    ?>
                                </li>
                            </ul>
                        </nav>
                        <?php
                            if (function_exists('dynamic_sidebar')) {
                                dynamic_sidebar('header-column-2');
                            }
                        ?>
                        <nav data-name="main-nav" class="main-nav header__main-nav d-none d-sm-none d-lg-block is-level-0">
                            <?php
                                wp_nav_menu(array(
                                    'menu' => '',
                                    'theme_location' => 'main-menu',
                                    'depth' => 1,
                                    'container' => false,
                                    'menu_class' => 'main-nav__items no-list-style is-level-0',
                                    'fallback_cb' => 'wp_page_menu',
                                    'walker' => new DesktopMenuWalker()
                                )); 
                            ?>
                        </nav>
                        <nav data-name="mobile-nav" class="mobile-nav header__mobile-nav d-sm-block d-lg-none is-breakout  is-level-0">
                            <?php
                                wp_nav_menu(array(
                                    'menu' => '',
                                    'theme_location' => 'main-menu',
                                    'depth' => 4,
                                    'container' => false,
                                    'menu_class' => 'mobile-nav__items no-list-style is-level-0',
                                    'fallback_cb' => 'wp_page_menu',
                                    'walker' => new ResponsiveMenuWalker()
                                ));
                            ?>
                        </nav>
                    </div>
                </div>
                <div class="header__sub-nav-wrapper d-none d-sm-none d-lg-block">
                <button class="button header__close is-secondary is-unbreakable"></button>
                    <div class="container">
                        <?php 
                            wp_nav_menu(array(
                                'menu' => '',
                                'theme_location' => 'main-menu',
                                'depth' => 4,
                                'container' => false,
                                'menu_class' => '',
                                'fallback_cb' => 'wp_page_menu',
                                'walker' => new SubMenuWalker(),
                                'items_wrap' => '%3$s'
                            )); 
                        ?>
                    </div>
                </div>
            </div>
        </header>
