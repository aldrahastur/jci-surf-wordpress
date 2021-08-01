<?php 
namespace WJD\Core;

use WJD\Core\Updates;
use WJD\Core\Plugins;
use WJD\Shortcodes\Basic;
use WJD\Shortcodes\CF7;
use WJD\Utility\Breadcrumb;

defined('ABSPATH') or die();

/**
 * Base Theme Loader
 */

 class WJD{

    public function __construct()
    {
        add_action('after_setup_theme', array($this, 'themeSetup'));
    }
    /**
     * Setup Theme Functions
     */
    public function themeSetup()
    {
        /**
         * Theme Supports
         */
        add_theme_support('automatic-feed-links');
        add_theme_support('post-thumbnails');
        add_theme_support('post-formats', array('aside', 'image', 'gallery', 'link', 'quote', 'status', 'video', 'audio', 'chat'));
        add_theme_support('title-tag');
        
        /**
         * Add Body Class for Browser Detection
         */
        add_filter('body_class', array($this, 'browserBodyClass'));
        
        /**
         * CF7 Filter
         */
        add_filter( 'wpcf7_form_elements', 'do_shortcode' );

        /**
         * Styles & Scripts
         */
        add_action('wp_enqueue_scripts', array($this, 'stylesLoader'));
        add_action('wp_enqueue_scripts', array($this, 'scriptLoader'));

        /**
         * Menues
         */
        register_nav_menus(array(
            'main-menu' => 'Hauptmenü',
            'footer-menu' => 'Footermenü'
        ));

        /**
         * Widgets
         */
        add_theme_support('widgets');
        register_sidebar(array(
            'name' => __('Responsive Footer Column', 'wjd'),
            'id' => 'responsove-footer-column',
            'description' => __('Responsive Footer Column', 'wjd'),
            'before_widget' => '<aside><div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div></aside>',
            'before_title' => '<h4>',
            'after_title' => '</h4>'
        ));
        register_sidebar(array(
            'name' => __('Footer Column 1', 'wjd'),
            'id' => 'footer-column-1',
            'description' => __('Footer Column 1 - Ist bereits ein Footer Menü gewählt, hier nichts eintragen', 'wjd'),
            'before_widget' => '<aside><div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div></aside>',
            'before_title' => '<h4>',
            'after_title' => '</h4>'
        ));
        for ($i = 1; $i < 3; $i++) {
            register_sidebar(array(
                'name' => __('Footer Column', 'wjd') . ' ' . ($i+1),
                'id' => 'footer-column-' . ($i+1),
                'description' => __('Footer Column ' . ($i+1), 'wjd'),
                'before_widget' => '<aside><div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div></aside>',
                'before_title' => '<span class="footer__content-title">',
                'after_title' => '</span>'
            ));
        }
        register_sidebar(array(
            'name' => __('Header Column Login', 'wjd'),
            'id' => 'header-column-1',
            'description' => __('Header Column Login', 'wjd'),
            'before_widget' => '<div class="header__login">',
            'after_widget' => '</div>',
            'before_title' => '<span class="header__content-title">',
            'after_title' => '</span>'
        ));
        register_sidebar(array(
            'name' => __('Header Column CTA', 'wjd'),
            'id' => 'header-column-2',
            'description' => __('Header Column CTA', 'wjd'),
            'before_widget' => '<div class="header__cta">',
            'after_widget' => '</div>',
            'before_title' => '<span class="header__content-title">',
            'after_title' => '</span>'
        ));

        register_post_type('positionen', array(
            'labels' => array(
                'name' => __('Positionen'),
                'singular_name' => __('Position'),
                'add_new' => __('Hinzufügen')
            ),
            'menu_icon' => 'dashicons-media-default',
            'menu_position' => 20,
            'public' => true,
            'publicly_queryable' => false,
            'has_archive' => false,
            'supports' => array('title', 'editor', 'thumbnail'),
            'show_in_rest' => true,
            'rest_base' => 'positionen'
        ));   

        register_post_type('projekte', array(
            'labels' => array(
                'name' => __('Projekte'),
                'singular_name' => __('Projekt'),
                'add_new' => __('Hinzufügen')
            ),
            'menu_icon' => 'dashicons-clipboard',
            'menu_position' => 21,
            'public' => true,
            'publicly_queryable' => true,
            'has_archive' => false,
            'supports' => array('title', 'editor', 'thumbnail'),
            'show_in_rest' => true,
            'rest_base' => 'projekte',
            'show_in_nav_menus' => true,
        ));
        add_action('add_meta_boxes', array($this, 'wjd_add_custom_box'));
        add_action('save_post', array($this, 'wjd_save_postdata'));

        add_theme_support('custom-logo', array(
            // 'size' => 'wjd-logo',            
            'height'      => 70,
            'width'       => 250,
            'flex-height' => true,
            'flex-width'  => true,
            'header-text' => array( 'site-title', 'site-description' )                
        ));

        /*
         * Core
         */
        $core_updates = new Updates();
        $core_plugins = new Plugins();

        /**
         * Shortcodes
         */
        $basicShortcodes = new Basic();
        $cf7Shortcodes = new CF7();
        /**
         * Utility
         */
        $breadcrumb = new Breadcrumb();
    }

    public function browserBodyClass($classes = '') 
    {
        global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

        if($is_lynx) {
            $classes[] = 'lynx';
        } elseif($is_gecko) {
            $classes[] = 'gecko';
        } elseif($is_opera) {
            $classes[] = 'opera';
        } elseif($is_NS4) { 
            $classes[] = 'ns4';
        } elseif($is_safari) {
            $classes[] = 'safari';
        } elseif($is_chrome) {
            $classes[] = 'chrome';
        } elseif($is_IE) {
            $classes[] = 'ie';
        } elseif($is_iphone) {
            $classes[] = 'iphone';
        } else {
            $classes[] = 'unknown';
        }

        $user_agent = strtolower(getenv("HTTP_USER_AGENT"));
        if (strpos($user_agent, 'windows')) {
            $classes[] = 'windows';
        } elseif (strpos($user_agent, 'macintosh')) {
            $classes[] = 'osx';
        }

        return $classes;
    }

    /**
     * Load CSS styles for theme.
     */
    public static function stylesLoader()
    {
        wp_register_style(THEME_NAME . '-style', THEME_PATH . '/style.css', array(), ASSET_VERSION);
        wp_enqueue_style(THEME_NAME . '-style');
    }
    /**
     * Load JavaScript and jQuery files for theme.
     */
    public static function scriptLoader()
    {
        wp_deregister_script('jquery');
        wp_register_script('jquery', THEME_PATH . '/js/jquery-3.4.1.min.js', false, null, true);
        wp_enqueue_script('jquery');
        
        wp_enqueue_script(THEME_NAME.'-iamgesloaded', THEME_PATH . '/js/imagesloaded.pkgd.min.js', array('jquery'), ASSET_VERSION, true);
        wp_enqueue_script(THEME_NAME.'-swiper', THEME_PATH . '/js/swiper.min.js', array('jquery'), ASSET_VERSION, true);        
        wp_enqueue_script(THEME_NAME.'-core', THEME_PATH . '/js/script.min.js', array('jquery'), ASSET_VERSION, true);
    }

    public function wpse44962_add_meta_boxes()
    {
        foreach ( array_keys( $GLOBALS['wp_post_types'] ) as $post_type )
        {
            if ( in_array( $post_type, array( 'attachment', 'revision', 'nav_menu_item' ) ) )
                continue;
            add_meta_box( 'RelatedImage', __('Archiv Kategorie'), array($this, 'cat_page_metabox'), 'page', 'side', 'high' );
        }
    }

    function wjd_add_custom_box()
    {
        $screens = ['page'];
        foreach ($screens as $screen) {
            add_meta_box(
                'wjd_box_id',
                'Kategorieoptionen',
                array($this, 'wjd_custom_box_html'),
                $screen,
                'side'
            );
        }
    }
    function wjd_custom_box_html($post)
    {
        $value = get_post_meta($post->ID, '_wjd_meta_key', true);
        $value2 = get_post_meta($post->ID, '_wjd_meta_subheadline', true);
        $categories = get_categories();
        if (count($categories) > 0):
            echo '<label>Unterüberschrift eingeben</label><br>';
            echo '<input type="text" name="wjd_subheadline" value="'.$value2.'"><br>';
            echo '<label>Kategorie auswählen</label><br>';
            echo '<select name="wjd_field">';
            foreach ($categories as $cat) {
                ?>
                <option value="<?=$cat->term_id?>" <?php selected($value, $cat->term_id); ?>><?=$cat->name?></option>
                <?php
            } 
            echo '</select>';
        else:
            echo '<p>Keine Kategorien gefunden</p>';
        endif;
    }
    function wjd_save_postdata($post_id)
    {
        if (array_key_exists('wjd_field', $_POST)) {
            update_post_meta(
                $post_id,
                '_wjd_meta_key',
                $_POST['wjd_field']
            );
        }
        if (array_key_exists('wjd_subheadline', $_POST)) {
            update_post_meta(
                $post_id,
                '_wjd_meta_subheadline',
                $_POST['wjd_subheadline']
            );
        }
    }
 }