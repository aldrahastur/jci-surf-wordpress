<?php
/**
 * Default Footer
 * @package WordPress
 */

use WJD\TemplatePart\FooterMenuWalker;

?>
<footer class="footer logo-left">
    <div class="footer__before border-top"></div>
        <div class="container">
            <div class="footer__header row grow-logo">
                <div class="col-12 align-space-between align-middle">
                    <div class="footer-logo">
                        <?php
                        the_custom_logo();
                        if (!has_custom_logo()) {
                            ?>
                            <p><?php bloginfo('name'); ?></p>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="footer__content row">
                <div class="col-12 hide-on-desktop">
                    <?php if (function_exists('dynamic_sidebar')) {
                        dynamic_sidebar('responsive-footer-column');
                    } ?>
                </div>
                <div class="footer__content-list col-6 col-lg-4">
                    <?php
                    if (has_nav_menu('footer-menu')) { ?>
                        <nav data-name="footer-nav" class="footer-nav is-level-0">
                            <?php
                            wp_nav_menu(array(
                                'menu' => '',
                                'theme_location' => 'footer-menu',
                                'depth' => 1,
                                'container' => false,
                                'menu_class' => 'footer-nav__items no-list-style is-level-0',
                                'fallback_cb' => 'wp_page_menu',
                                'walker' => new FooterMenuWalker()
                            )); 
                            ?>
                        </nav>
                    <?php } else {
                        if (function_exists('dynamic_sidebar')) {
                            dynamic_sidebar('footer-column-1');
                        } 
                    } ?>
                </div>
                <div class="footer__content-list col-12 col-md-6 col-lg-4">
                    <nav data-name="footer-nav" class="footer-nav socials  is-level-0">
                        <ul class="footer-nav__items no-list-style is-level-0">
                            <?php 
                            if (function_exists('dynamic_sidebar')) {
                                dynamic_sidebar('footer-column-2');
                            } 
                            ?>
                        </ul>
                    </nav>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="row">
                        <div class="footer__content-list col-12 hide-on-mobile">
                            <?php 
                            if (function_exists('dynamic_sidebar')) {
                                dynamic_sidebar('footer-column-3');
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__after "></div>
    </footer>
    <?php wp_footer(); ?>
    <script src="<?= get_template_directory_uri() . '/js/bootstrap.min.js' ?>"></script>
    </body>
</html>
