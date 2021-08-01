<?php
/**
 * Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since   1.0.0
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 * Assets enqueued:
 * 1. blocks.style.build.css - Frontend + Backend.
 * 2. blocks.build.js - Backend.
 * 3. blocks.editor.build.css - Backend.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function wjd_guten_blocks_cgb_block_assets() { // phpcs:ignore
    wp_enqueue_script( 'wp-api' );
    // function enqueue_wp_api() {
    // }
    // add_action( 'wp_enqueue_scripts', 'enqueue_wp_api' );
	// Register block styles for both frontend + backend.
	wp_register_style(
		'wjd_guten_blocks-cgb-style-css', // Handle.
		plugins_url( 'dist/blocks.style.build.css', dirname( __FILE__ ) ), // Block style CSS.
		array( 'wp-editor' ), // Dependency to include the CSS after it.
		null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.style.build.css' ) // Version: File modification time.
	);

	// Register block editor script for backend.
	wp_register_script(
		'wjd_guten_blocks-cgb-block-js', // Handle.
		plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), // Dependencies, defined above.
		null, // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
		true // Enqueue the script in the footer.
	);

	// Register block editor styles for backend.
	wp_register_style(
		'wjd_guten_blocks-cgb-block-editor-css', // Handle.
		plugins_url( 'dist/blocks.editor.build.css', dirname( __FILE__ ) ), // Block editor CSS.
		array( 'wp-edit-blocks' ), // Dependency to include the CSS after it.
		null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.editor.build.css' ) // Version: File modification time.
	);

	// WP Localized globals. Use dynamic PHP stuff in JavaScript via `cgbGlobal` object.
	wp_localize_script(
		'wjd_guten_blocks-cgb-block-js',
		'cgbGlobal', // Array containing dynamic data for a JS Global.
		[
			'pluginDirPath' => plugin_dir_path( __DIR__ ),
			'pluginDirUrl'  => plugin_dir_url( __DIR__ ),
			// Add more data here that you want to access from `cgbGlobal` object.
		]
	);

	/**
	 * Register Gutenberg block on server-side.
	 *
	 * Register the block on server-side to ensure that the block
	 * scripts and styles for both frontend and backend are
	 * enqueued when the editor loads.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type#enqueuing-block-scripts
	 * @since 1.16.0
	 */
	register_block_type(
		'cgb/block-wjd-guten-blocks', array(
			// Enqueue blocks.style.build.css on both frontend & backend.
			'style'         => 'wjd_guten_blocks-cgb-style-css',
			// Enqueue blocks.build.js in the editor only.
			'editor_script' => 'wjd_guten_blocks-cgb-block-js',
			// Enqueue blocks.editor.build.css in the editor only.
			'editor_style'  => 'wjd_guten_blocks-cgb-block-editor-css',
		)
    );
    register_block_type( 'wjd/test', array(
        'render_callback' => 'wjd_test_render',
    ));
    register_block_type( 'wjd/group', array(
        'render_callback' => 'wjd_group_render',
    ));
    register_block_type( 'wjd/button', array(
        'render_callback' => 'wjd_button_render',
    ));
    register_block_type( 'wjd/card', array(
        'render_callback' => 'wjd_card_render',
    ));
    register_block_type( 'wjd/postcard', array(
        'render_callback' => 'wjd_postcard_render',
    ));
    register_block_type( 'wjd/positioncard', array(
        'render_callback' => 'wjd_positioncard_render',
    ));
    register_block_type( 'wjd/projectcard', array(
        'render_callback' => 'wjd_projectcard_render',
    ));
    register_block_type( 'wjd/download', array(
        'render_callback' => 'wjd_download_render',
    ));
    register_block_type('core/gallery', array(
        'render_callback' => 'wjd_gallery_render',
    ));
    register_block_type('wjd/hero', array(
        'render_callback' => 'wjd_hero_render',
    ));
    register_block_type('wjd/cite', array(
        'render_callback' => 'wjd_cite_render',
    ));
    register_block_type('wjd/calendarwidget', array(
        'render_callback' => 'wjd_calendarwidget_render',
    ));

    add_theme_support( 'disable-custom-colors' );
    add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Blau'),
			'slug'  => 'blue',
			'color'	=> '#013493',
		),
		array(
			'name'  => __( 'Hellblau'),
			'slug'  => 'lightblue',
			'color' => '#e5eaf4',
		),
	) );
}

function wjd_group_render($attributes, $content) {
    $output = '';
    if (!array_key_exists('alignment', $attributes)) {
        $attributes['alignment'] = 'center';
    }
    if ($attributes['sectionType'] === 'funky') {
        $output .= '<div class="section is-funky is-inverted">';
            $output .= '<div class="headline-section">';
                $output .= '<div class="headline-section__content container text-'.$attributes["alignment"].' is-inverted is-transparent">';
                    $output .= '<h2 class="headline-section__headline">'.$attributes["title"].'</h2>';
                $output .= '</div>';
            $output .= '</div>';
            $output .= '<div class="section__content container">'.$content.'</div>';
        $output .= '</div>';
    } else {
        $output .= '<div class="headline-section">';
            $output .= '<div class="headline-section__content container text-'.$attributes["alignment"].'">';
                $output .= '<h2 class="headline-section__headline is-highlighted">'.$attributes["title"].'</h2>';
            $output .= '</div>';
        $output .= '</div>';
        $output .= '<div class="section">';
            $output .= '<div class="section__content container">'.$content.'</div>';
        $output .= '</div>';
    }
    return $output;
}

function wjd_button_render($attributes) {
    $classes = 'button ';
    if ($attributes['mainColor'] == '#013493' && $attributes['buttonType'] == 'default') {
        $classes .= ' is-default';
    }
    if ($attributes['mainColor'] == '#013493' && $attributes['buttonType'] == 'solid') {
        $classes .= ' is-default is-solid';
    }
    if ($attributes['mainColor'] == '#013493' && $attributes['buttonType'] == 'inverted') {
        $classes .= 'is-default is-inverted';
    }
    if ($attributes['mainColor'] == '#41d4ae' && $attributes['buttonType'] == 'default') {
        $classes .= ' is-secondary';
    }
    if ($attributes['mainColor'] == '#41d4ae' && $attributes['buttonType'] == 'solid') {
        $classes .= ' is-secondary-solid';
    }
    if ($attributes['mainColor'] == '#41d4ae' && $attributes['buttonType'] == 'inverted') {
        $classes .= ' is-secondary is-inverted';
    }
    if ($attributes['mainColor'] == '#f8a102' && $attributes['buttonType'] == 'default') {
        $classes .= ' is-tertiary';
    }
    if ($attributes['mainColor'] == '#f8a102' && $attributes['buttonType'] == 'solid') {
        $classes .= ' is-tertiary-solid';
    }
    if ($attributes['mainColor'] == '#f8a102' && $attributes['buttonType'] == 'inverted') {
        $classes .= ' is-tertiary is-inverted';
    }
	$destination = (isset($attributes['buttonUrl']) && !empty($attributes['buttonUrl'])) ?
		' href="' . $attributes['buttonUrl'] . '" ' : '';
    if (!array_key_exists('icons',$attributes) ||$attributes['icons'] == 'none') {
        $output = '<a' . $destination . 'class="'.$classes.'"><span class="button__text">'.$attributes['buttonText'].'</span></a>';
    }
    if ($attributes['icons'] == 'start') {
        $output = '<a' . $destination . 'class="'.$classes.'"><i class="button__icon-before fa fa-'.$attributes['iconType'].$attributes['faFreeText'].'"></i> <span class="button__text">'.$attributes['buttonText'].'</span></a>';
    }
    if ($attributes['icons'] == 'end') {
        $output = '<a' . $destination . 'class="'.$classes.'"><span class="button__text">'.$attributes['buttonText'].'</span> <i class="button__icon-after fa fa-'.$attributes['iconType'].$attributes['faFreeText'].'"></i></a>';
    }
    if ($attributes['icons'] == 'both') {
        $output = '<a' . $destination . 'class="'.$classes.'"><i class="button__icon-before fa fa-'.$attributes['iconType'].$attributes['faFreeText'].'"></i> <span class="button__text">'.$attributes['buttonText'].'</span> <i class="button__icon-after fa fa-'.$attributes['iconType'].$attributes['faFreeText'].'"></i></a>';
    }
    return '<div class="wjd-button-wrapper '.$attributes['buttonAlignment'].'">'.$output.'</div>';
}

function wjd_card_render($attributes, $content) {
    $output = '';
    $cardClass = 'card';
    if ($attributes['mediaURL']) {
        $cardClass .= ' has-image';
    } else {
        $cardClass .= ' has-no-image';
    }
    if ($attributes['imageAttribution']) {
        $cardClass .= ' has-credit';
    }
    if (array_key_exists('imageAlignment', $attributes) && $attributes['imageAlignment'] == 'right') {
        $cardClass .= ' is-mirrored';
    }
    if ($attributes['cardColor'] === '#013493') {
        $cardClass .= ' is-inverted';
    }
    $cardClass .= ' '.$attributes['cardStyle'];
    if (!array_key_exists('cardStyle', $attributes)) {
        $output .= '<div class="'.$cardClass.' is-plain">';
            $output .= '<div class="card__content">';
                if ($attributes['cardTag'] || $attributes['cardDate']) {
                    $output .= '<ul class="card__meta-data no-list-style">';
                        if ($attributes['cardDate']) {
                            $output .= '<li class="card__meta-data-item is-date">'.$attributes['cardDate'].'</li>';
                        }
                        if ($attributes['cardTag']) {
                            $output .= '<li class="card__meta-data-item is-text">'.$attributes['cardTag'].'</li>';
                        }
                    $output .= '</ul>';
                }
                $output .= '<div class="card__main">';
                    if ($attributes['cardHeadline']) {
                        $output .= '<h3 class="card__headline">'.$attributes['cardHeadline'].'</h3>';
                    }
                    $output .= '<div class="rte-content v-margin-collapse">';
                        if ($attributes['mediaURL']) {
                            $output .= '<div class="card__image-wrapper">';
                                $output .= '<figure class="figure">';
                                    $output .= '<div class="figure__image-wrapper is-highlighted">';
                                        $output .= '<div class="figure__image">';
                                            $output .= '<img src="'.$attributes['mediaURL'].'">';
                                        $output .= '</div>';
                                    $output .= '</div>';
                                $output .= '</figure>';
                                if ($attributes['imageAttribution']) {
                                    $output .= '<div class="card__image-credit" title="© '.$attributes['imageAttribution'].'">';
                                        $output .= '© '.$attributes['imageAttribution'];
                                    $output .= '</div>';
                                }
                            $output .= '</div>';
                        }
                        $output .= $content;
                    $output .= '</div>';
                $output .= '</div>';
                if ($attributes['cardLinkText'] && $attributes['cardLink']) {
                    $output .= ' <div class="card__footer">';
                        if ($attributes['linkType'] === 'link-file') {
                            $output .= '<a download href="'.$attributes['cardLink'].'" ref="cta" class="card__cta is-file" target="_blank">'.$attributes['cardLinkText'];
                                $output .= '<i class="card__icon  fa fa-chevron-down" aria-hidden="true"></i>';
                            $output .= '</a>';
                        } else {
                            $output .= '<a href="'.$attributes['cardLink'].'" ref="cta" class="card__cta is-link" target="_blank">'.$attributes['cardLinkText'];
                                $output .= '<i class="card__icon  fas fa-chevron-right" aria-hidden="true"></i>';
                            $output .= '</a>';
                        }
                    $output .= '</div>';
                }
            $output .= '</div>';
        $output .= '</div>';
    } else {
        $output .= '<div class="'.$cardClass.'">';
            if ($attributes['cardStyle'] === 'v-card is-mirrored') {
                $output .= '<div class="card__image-wrapper order-1">';
            } else {
                $output .= '<div class="card__image-wrapper">';
            }
                $output .= '<figure class="figure">';
                    $output .= '<div class="figure__image-wrapper is-highlighted">';
                        $output .= '<div class="figure__image">';
                            $output .= '<img src="'.$attributes['mediaURL'].'">';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</figure>';
                if ($attributes['imageAttribution']) {
                    $output .= '<div class="card__image-credit" title="© '.$attributes['imageAttribution'].'">';
                        $output .= '© '.$attributes['imageAttribution'];
                    $output .= '</div>';
                }
            $output .= '</div>';
            if ($attributes['cardColor'] === '#013493') {
                $output .= '<div class="card__content is-inverted">';
            } else {
                $output .= '<div class="card__content">';
            }
                if ($attributes['cardTag'] || $attributes['cardDate']) {
                    $output .= '<ul class="card__meta-data no-list-style">';
                        if ($attributes['cardDate']) {
                            $output .= '<li class="card__meta-data-item is-date">'.$attributes['cardDate'].'</li>';
                        }
                        if ($attributes['cardTag']) {
                            $output .= '<li class="card__meta-data-item is-text">'.$attributes['cardTag'].'</li>';
                        }
                    $output .= '</ul>';
                }
                $output .= '<div class="card__main">';
                    if ($attributes['cardHeadline']) {
                        $output .= '<h3 class="card__headline">'.$attributes['cardHeadline'].'</h3>';
                    }
                    $output .= '<div class="rte-content v-margin-collapse">';
                        $output .= $content;
                    $output .= '</div>';
                $output .= '</div>';
                if ($attributes['cardLinkText'] && $attributes['cardLink']) {
                    $output .= ' <div class="card__footer">';
                        if ($attributes['linkType'] === 'link-file') {
                            $output .= '<a download href="'.$attributes['cardLink'].'" ref="cta" class="card__cta is-file" target="_blank">'.$attributes['cardLinkText'];
                                $output .= '<i class="card__icon  fa fa-chevron-down" aria-hidden="true"></i>';
                            $output .= '</a>';
                        } else {
                            $output .= '<a href="'.$attributes['cardLink'].'" ref="cta" class="card__cta is-link" target="_blank">'.$attributes['cardLinkText'];
                                $output .= '<i class="card__icon  fas fa-chevron-right" aria-hidden="true"></i>';
                            $output .= '</a>';
                        }
                    $output .= '</div>';
                }
            $output .= '</div>';
        $output .= '</div>';
    }
    return $output;
}

function wjd_postcard_render($attributes) {
    if ($attributes['selectedPost'] == null) {
        return '<div></div>';
    }
    $output = '';
    $classes = '';
    $classes .= $attributes['cardStyle'];
    if ($attributes['selectedImage']) {
        $classes .= ' has-image';
    } else {
        $classes .= ' has-no-image';
    }
    if ($attributes['selectedImageCaption']) {
        $classes .= ' has-credit';
    }
    if ($attributes['isCTA']) {
        $classes .= ' has-cta has-link';
    } else {
        $classes .= ' has-no-footer';
    }
    if ($attributes['cardColor'] === '#013493') {
        $classes .= ' is-inverted';
    }
    $content = get_the_content(null,null,$attributes['selectedPost']);
    $content = apply_filters('the_content', $content);
    $content = strip_tags($content, '<br><br/><wbr><wbr/>');
    if (strlen($content) > 300 || $content == '') {
        $words = preg_split('/\s/', $content);
        $excerpt = '';
        $i      = 0;
        while (1) {
            $length = strlen($excerpt)+strlen($words[$i]);
            if ($length > 300) {
                break;
            }
            else {
                $excerpt .= " " . $words[$i];
                ++$i;
            }
        }
        $excerpt .= '...';
    }
    else {
        $excerpt = $content;
    }
    $output .= '<div class="card '.$classes.'">';
        if ($attributes['selectedImage']) {
            if ($attributes['cardStyle'] === 'v-card is-mirrored') {
                $output .= '<div class="card__image-wrapper order-1">';
            } else {
                $output .= '<div class="card__image-wrapper">';
            }
                $output .= '<figure class="figure">';
                    $output .= '<div class="figure__image-wrapper is-highlighted">';
                        $output .= '<div class="figure__image">';
                            $output .= '<img src="'.get_the_post_thumbnail_url($attributes['selectedPost']).'">';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</figure>';
                if ($attributes['selectedImageCaption']) {
                    $output .= '<div class="card__image-credit" title="'.get_the_post_thumbnail_caption($attributes['selectedPost']).'">';
                        $output .= get_the_post_thumbnail_caption($attributes['selectedPost']);
                    $output .= '</div>';
                }
            $output .= '</div>';
        }
        if ($attributes['cardColor'] === '#013493') {
            $output .= '<div class="card__content is-inverted">';
        } else {
            $output .= '<div class="card__content">';
        }
            $output .= '<ul class="card__meta-data no-list-style">';
                if ($attributes['date']) {
                    $output .= '<li class="card__meta-data-item is-date">';
                        $output .= get_the_date('d.m.Y', $attributes['selectedPost']);
                    $output .= '</li>';
                }
                if ($attributes['selectedCategory']) {
                    $output .= '<li class="card__meta-data-item is-text">';
                        $output .= get_the_category($attributes['selectedPost'])[0]->name;
                    $output .= '</li>';
                }
            $output .= '</ul>';
            $output .= '<div class="card__main">';
                $output .= '<h3 class="card__headline">';
                    $output .= get_the_title($attributes['selectedPost']);
                $output .= '</h3>';
                $output .= '<div class="rte-content v-margin-collapse">';
                    $output .= '<p>';
                        $output .= $excerpt;
                    $output .= '</p>';
                $output .= '</div>';
            $output .= '</div>';
            if ($attributes['isCTA']) {
                $output .= '<div class="card__footer">';
                    $output .= '<a href="#default" ref="cta" class="card__cta is-link" target="_self">';
                        $output .= 'Mehr lesen';
                        $output .= '<i class="card__icon  fas fa-chevron-right" aria-hidden="true"></i>';
                    $output .= '</a>';
                $output .= '</div>';
            }
        $output .= '</div>';
    $output .= '</div>';
    return $output;
}

function wjd_positioncard_render($attributes) {
    if ($attributes['selectedPost'] == null) {
        return '<div></div>';
    }
    $output = '';
    $classes = '';
    $classes .= $attributes['cardStyle'];
    if ($attributes['selectedImage']) {
        $classes .= ' has-image';
    } else {
        $classes .= ' has-no-image';
    }
    if ($attributes['selectedImageCaption']) {
        $classes .= ' has-credit';
    }
    if ($attributes['isCTA']) {
        $classes .= ' has-cta has-link';
    } else {
        $classes .= ' has-no-footer';
    }
    if ($attributes['cardColor'] === '#013493') {
        $classes .= ' is-inverted';
    }
    $content = get_the_content(null,null,$attributes['selectedPost']);
    $content = apply_filters('the_content', $content);
    $content = strip_tags($content, '<br><br/><wbr><wbr/>');
    if (strlen($content) > 300 || $content == '') {
        $words = preg_split('/\s/', $content);
        $excerpt = '';
        $i      = 0;
        while (1) {
            $length = strlen($excerpt)+strlen($words[$i]);
            if ($length > 300) {
                break;
            }
            else {
                $excerpt .= " " . $words[$i];
                ++$i;
            }
        }
        $excerpt .= '...';
    }
    else {
        $excerpt = $content;
    }
    $output .= '<div class="card '.$classes.'">';
        if ($attributes['selectedImage']) {
            if ($attributes['cardStyle'] === 'v-card is-mirrored') {
                $output .= '<div class="card__image-wrapper order-1">';
            } else {
                $output .= '<div class="card__image-wrapper">';
            }
                $output .= '<figure class="figure">';
                    $output .= '<div class="figure__image-wrapper is-highlighted">';
                        $output .= '<div class="figure__image">';
                            $output .= '<img src="'.get_the_post_thumbnail_url($attributes['selectedPost']).'">';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</figure>';
                if ($attributes['selectedImageCaption']) {
                    $output .= '<div class="card__image-credit" title="'.get_the_post_thumbnail_caption($attributes['selectedPost']).'">';
                        $output .= get_the_post_thumbnail_caption($attributes['selectedPost']);
                    $output .= '</div>';
                }
            $output .= '</div>';
        }
        if ($attributes['cardColor'] === '#013493') {
            $output .= '<div class="card__content is-inverted">';
        } else {
            $output .= '<div class="card__content">';
        }
            $output .= '<div class="card__main">';
                $output .= '<h3 class="card__headline">';
                    $output .= get_the_title($attributes['selectedPost']);
                $output .= '</h3>';
                $output .= '<div class="rte-content v-margin-collapse">';
                    $output .= '<p>';
                        $output .= $excerpt;
                    $output .= '</p>';
                $output .= '</div>';
            $output .= '</div>';
            if ($attributes['isCTA']) {
                $output .= '<div class="card__footer">';
                    $output .= '<a href="#default" ref="cta" class="card__cta is-link" target="_self">';
                        $output .= 'Mehr lesen';
                        $output .= '<i class="card__icon  fas fa-chevron-right" aria-hidden="true"></i>';
                    $output .= '</a>';
                $output .= '</div>';
            }
        $output .= '</div>';
    $output .= '</div>';
    return $output;
}

function wjd_projectcard_render($attributes) {
    if ($attributes['selectedPost'] == null) {
        return '<div></div>';
    }
    $output = '';
    $classes = '';
    $classes .= $attributes['cardStyle'];
    if ($attributes['selectedImage']) {
        $classes .= ' has-image';
    } else {
        $classes .= ' has-no-image';
    }
    if ($attributes['selectedImageCaption']) {
        $classes .= ' has-credit';
    }
    if ($attributes['isCTA']) {
        $classes .= ' has-cta has-link';
    } else {
        $classes .= ' has-no-footer';
    }
    if ($attributes['cardColor'] === '#013493') {
        $classes .= ' is-inverted';
    }
    $content = get_the_content(null,null,$attributes['selectedPost']);
    $content = apply_filters('the_content', $content);
    $content = strip_tags($content, '<br><br/><wbr><wbr/>');
    if (strlen($content) > 300 || $content == '') {
        $words = preg_split('/\s/', $content);
        $excerpt = '';
        $i      = 0;
        while (1) {
            $length = strlen($excerpt)+strlen($words[$i]);
            if ($length > 300) {
                break;
            }
            else {
                $excerpt .= " " . $words[$i];
                ++$i;
            }
        }
        $excerpt .= '...';
    }
    else {
        $excerpt = $content;
    }
    $output .= '<div class="card '.$classes.'">';
        if ($attributes['selectedImage']) {
            if ($attributes['cardStyle'] === 'v-card is-mirrored') {
                $output .= '<div class="card__image-wrapper order-1">';
            } else {
                $output .= '<div class="card__image-wrapper">';
            }
                $output .= '<figure class="figure">';
                    $output .= '<div class="figure__image-wrapper is-highlighted">';
                        $output .= '<div class="figure__image">';
                            $output .= '<img src="'.get_the_post_thumbnail_url($attributes['selectedPost']).'">';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</figure>';
                if ($attributes['selectedImageCaption']) {
                    $output .= '<div class="card__image-credit" title="'.get_the_post_thumbnail_caption($attributes['selectedPost']).'">';
                        $output .= get_the_post_thumbnail_caption($attributes['selectedPost']);
                    $output .= '</div>';
                }
            $output .= '</div>';
        }
        if ($attributes['cardColor'] === '#013493') {
            $output .= '<div class="card__content is-inverted">';
        } else {
            $output .= '<div class="card__content">';
        }
            $output .= '<div class="card__main">';
                $output .= '<h3 class="card__headline">';
                    $output .= get_the_title($attributes['selectedPost']);
                $output .= '</h3>';
                $output .= '<div class="rte-content v-margin-collapse">';
                    $output .= '<p>';
                        $output .= $excerpt;
                    $output .= '</p>';
                $output .= '</div>';
            $output .= '</div>';
            if ($attributes['isCTA']) {
                $output .= '<div class="card__footer">';
                    $output .= '<a href="#default" ref="cta" class="card__cta is-link" target="_self">';
                        $output .= 'Mehr lesen';
                        $output .= '<i class="card__icon  fas fa-chevron-right" aria-hidden="true"></i>';
                    $output .= '</a>';
                $output .= '</div>';
            }
        $output .= '</div>';
    $output .= '</div>';
    return $output;
}

function wjd_download_render($attributes) {
    $output = '';
    $output .= '<a class="download is-detail" title="'.$attributes['downloadText'].'" href="'.$attributes['mediaURL'].'">';
        $output .= '<div class="download__image">';
        $output .= '<img class="'.$attributes['mediaType'].'" src="'.$attributes['mediaURL'].'">';
        $output .= '</div>';
        $output .= '<h3 class="download__title">';
            $output .= $attributes['downloadText'];
        $output .= '</h3>';
        $output .= '<div class="download__icon">';
            $output .= '<i class="fa fa-arrow-down" aria-hidden="true"></i>';
        $output .= '</div>';
    $output .= '</a>';
    return $output;
}

function wjd_gallery_render($attributes, $content) {
	$teaser = true;
	if ($attributes['imageCrop'] === false) {
		$teaser = false;
	}
	$imageCaptions = [];
	libxml_use_internal_errors( TRUE );
	$dom = new DOMDocument();
	$dom->preserveWhiteSpace = FALSE;
	$dom->loadHtml( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
	$finder = new DomXPath($dom);
	$classname="blocks-gallery-item";
	$nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
	foreach ($nodes as $node) {
		array_push($imageCaptions, $node->textContent);
	}
	$imageAmount = count($attributes['ids']);
	$output = '';
	$output .= '<div class="v-image-gallery is-desktop image-gallery d-none d-md-block is-detail is-overflow" data-mediaquery="md">';
	$output .= '<div class="image-gallery-overlay is-ready invis">';
	$output .= '<div class="image-gallery-overlay__inner">';
	$output .= '<a class="button m-sm image-gallery-overlay__close is-small is-tertiary is-inverted is-close is-unbreakable">';
	$output .= '<i aria-hidden="true" class="button__icon  far fa-times"></i>';
	$output .= '</a>';
	$output .= '<div class="gallery-swiper swiper-container">';
	$output .= '<div class="swiper-wrapper">';
	foreach ($attributes['ids'] as $key => $slide) {
		$date = get_post($slide)->post_date;
		$outputDate = substr($date,8,2).'.'.substr($date,5,2).'.'.substr($date,0,4);
		$output .= '<div class="image-gallery-overlay__slide swiper-slide">';
		$output .= '<div class="image-gallery-overlay__thumbnail">';
		$output .= '<figure class="figure">';
		$output .= '<div class="figure__image-wrapper">';
		$output .= '<img src="'.wp_get_attachment_image_src($slide,'full')[0].'" class="figure__image" alt="'.get_post_meta($slide, '_wp_attachment_image_alt', true ).'">';
		$output .= '</div>';
		$output .= '<figcaption class="figure__caption">';
		$output .= '<div class="image-gallery-overlay__caption caption rte-content">';
		//$output .= '<div class="image-gallery-overlay__caption-meta caption__meta">'.$outputDate.'</div>';
		$output .= '<div class="image-gallery-overlay__caption-title caption__title">'.wp_get_attachment_caption($slide).'</div>';
		$output .= '<div class="image-gallery-overlay__caption-pagination caption__pagination">'.($key+1).'/'.$imageAmount.'</div>';
		$output .= '</div>';
		$output .= '</figcaption>';
		$output .= '</figure>';
		$output .= '</div>';
		$output .= '</div>';
	}
	$output .= '</div>';
	$output .= '<button class="button image-gallery-overlay__prev is-tertiary-plain m-sm is-unbreakable" tabindex="0" role="button" aria-label="Previous slide" aria-disabled="false">';
	$output .= '<i aria-hidden="true" class="button__icon  fa fa-chevron-left"></i>';
	$output .= '</button>';
	$output .= '<button class="button image-gallery-overlay__next is-tertiary-plain m-sm is-unbreakable" tabindex="0" role="button" aria-label="Next slide" aria-disabled="false">';
	$output .= '<i aria-hidden="true" class="button__icon  fa fa-chevron-right"></i>';
	$output .= '</button>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '<div class="image-gallery__thumbnails-wrapper">';
	foreach ($attributes['ids'] as $key => $slide) {
		$date = get_post($slide)->post_date;
		$outputDate = substr($date,8,2).'.'.substr($date,5,2).'.'.substr($date,0,4);
		$output .= '<div class="image-gallery__thumbnail" data-index-image="'.($key+1).'">';
		$output .= '<figure class="figure is-detail">';
		$output .= '<div class="figure__image-wrapper is-highlighted">';
		$output .= '<div class="figure__image">';
		$output .= '<img src="'.wp_get_attachment_image_src($slide,'full')[0].'" alt="'.get_post_meta($slide, '_wp_attachment_image_alt', true ).'" />';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '<figcaption>';
		$output .= '<div class="image-gallery__caption caption">';
		//$output .= '<div class="image-gallery__caption-meta caption__meta">'.$outputDate.'</div>';
		$output .= '<div class="image-gallery__caption-title caption__title">'.wp_get_attachment_caption($slide).'</div>';
		$output .= '</div>';
		$output .= '</figcaption>';
		$output .= '</figure>';
		$output .= '</div>';
		if ($teaser && $key > 5) {
			break;
		}
	}
	if ($teaser) {
		$output .= '<div class="image-gallery__thumbnail-redirect">';
		$output .= '<a href="#">Galerie öffnen<i class="fas fa-chevron-right"></i></a>';
		$output .= '</div>';
	}
	$output .= '</div>';
	$output .= '</div>';
	$jsonImages = [];
	foreach ($attributes['ids'] as $key => $slide) {
		$date = get_post($slide)->post_date;
		$outputDate = substr($date,8,2).'.'.substr($date,5,2).'.'.substr($date,0,4);
		array_push($jsonImages,
			array(
				'src' => wp_get_attachment_image_src($slide,'full')[0],
				'meta' => $outputDate,
				'caption' => $imageCaptions[$key]
			)
		);
	}
	$echo = json_encode($jsonImages);
	$echo = str_replace('[','&#x5B;',$echo);
	$echo = str_replace('{','&#x7B;',$echo);
	$echo = str_replace('"','&quot;',$echo);
	$echo = str_replace(':','&#x3A;',$echo);
	$echo = str_replace('/','&#x2F;',$echo);
	$echo = str_replace('\\','&#x5C;',$echo);
	$echo = str_replace('}','&#x7D;',$echo);
	$echo = str_replace(']','&#x5D;',$echo);
	$echo = str_replace(' ','&#x20;',$echo);
	$echo = str_replace('<','&lt;',$echo);
	$echo = str_replace('>','&gt;',$echo);
	$output .= '<div class="v-mobile-image-gallery image-gallery is-mobile d-md-none d-lg-none d-xl-none is-detail is-overflow" data-images="'.$echo.'">';
	$output .= '<div class="swiper-container">';
	$output .= '<div class="swiper-wrapper">';
	$output .= '<div class="image-gallery__slide swiper-slide">';
	$output .= '<div class="image-gallery__thumbnail">';
	$output .= '<figure class="figure">';
	$output .= '<div class="figure__image-wrapper is-highlighted"><img src="'.wp_get_attachment_image_src($attributes['ids'][0],'full')[0].'"class="figure__image"></div>';
	$output .= '</figure>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '<button class="button image-gallery__prev is-tertiary-plain is-unbreakable swiper-button-disabled" style="display: none;" tabindex="0" role="button" aria-label="Previous slide" aria-disabled="true">';
	$output .= '<i aria-hidden="true" class="button__icon  fa fa-chevron-left"></i>';
	$output .= '</button>';
	$output .= '<button class="button image-gallery__next is-tertiary-plain is-unbreakable swiper-button-disabled" style="display: none;" tabindex="0" role="button" aria-label="Next slide" aria-disabled="true">';
	$output .= '<i aria-hidden="true" class="button__icon  fa fa-chevron-right"></i>';
	$output .= '</button>';
	$output .= '<span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>';
	$output .= '</div>';
	$output .= '<div class="image-gallery__pagination">1 / '.$imageAmount.'</div>';
	$output .= '<div class="image-gallery__thumbnail-redirect">';
	$output .= '<a href="#" class="toggle">Galerie öffnen<i class="fas fa-chevron-right"></i></a>';
	$output .= '<span class="image-gallery__thumbnail-image-count">'.$imageAmount.' Bilder</span>';
	$output .= '</div>';
	$output .= '</div>';

	return $output;
}

function wjd_hero_render($attributes, $content) {
	if (!is_front_page() && $attributes['useSlider'] === true) {
		$cat_id = get_post_meta(get_the_ID(), '_wjd_meta_key', true);
		$all_terms = get_terms([
			'taxonomy' => 'category',
		]);

		$terms = [];
		foreach ($all_terms as $term) {
			$terms[] = $term->term_id ?? null;
		}

		if (in_array($cat_id, $terms)) {
			$args = [
				'post_type' => 'post',
				'posts_per_page' => 3,
				'tax_query' => [
					[
						'taxonomy' => 'category',
						'terms' => $cat_id,
						'include_children' => false // Remove if you need posts from term 7 child terms
					],
				],
			];

			$query = new WP_Query($args);

			foreach ($query->posts as $post) {
				$blocks[] = parse_blocks( $post->post_content );
			}
		}

		$output = '';
		$output .= '<div class="custom-hero v-hero hero has-max-width mb-xxl">';
		$output .= '<div class="hero-swiper swiper-container">';
		$output .= '<div class="swiper-wrapper">';
		foreach ($query->posts as $post) {
			$output .= '<div class="swiper-slide" style="display: none;">';
			$blocks = parse_blocks( $post->post_content );

			if ($blocks[0]['blockName'] === 'wjd/hero') {
				$attributes = $blocks[0]['attrs'];

				$image_url = $attributes['images'][0]['url'];
				if (empty($image_url)) {
					$image_url = get_the_post_thumbnail_url($post->ID);
				}

				$output .= '<div class="swiper-slide" style="
                                height:'.$attributes['heroHeight'].'px!important;
                                background-image:url('.$image_url.');
                                background-position:'.$attributes['heroDetailHorizontalSelect'].' '.$attributes['heroDetailVerticalSelect'].';
                                background-repeat: no-repeat;
                                background-size:cover
                                ">';

				$output .= '</div>';


				$output .= '<div class="hero__box is-highlighted">';

				$output .= '<h1 class="hero__headline">';
				$output .= '<a class="text-white" href="' . get_post_permalink($post->ID) . '">';
				$output .= $attributes['headline'];
				$output .= '</a>';
				$output .= '</h1>';
				$output .= '<h3 class="hero__subheadline">'.$attributes['subheadline'].'</h3>';
				if (is_countable($attributes['images']) && count($attributes['images']) >= 0) {
					$output .= '<ul class="hero__pagination no-list-style"></ul>';
				}
				$output .= '</div>';
			}

			$output .= '</div>';
		}
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';

	} else {
		if ($attributes['heroImageSize'] === false) {
			$size = 'contain';
		} else {
			$size = 'cover';
		}

		if (empty($attributes['heroHeight'])) {
			$attributes['heroHeight'] = 600;
		}


		if (!isset($attributes['images']) || sizeof($attributes['images']) <= 0) {
			$extra_classes = 'hero__no_image';
		} else {
			$extra_classes = '';
		}

		if (isset($_GET['dev']) && false) {
			echo '<pre>';
			var_dump($attributes['images'], !isset($attributes['images']), sizeof($attributes['images']) <= 0); die();
		}

		$output = '';
		$output .= '<div class="v-hero hero has-max-width mb-xxl">';
		$output .= '<div class="hero-swiper test swiper-container">';
		$output .= '<div class="swiper-wrapper">';
		if (is_countable($attributes['images'])) {
			foreach ($attributes['images'] as $image) {
				$output .= '<div class="swiper-slide" style="
                                height:' . $attributes['heroHeight'] . 'px!important;
                                background-image:url(' . $image['url'] . ');
                                background-position:' . $attributes['heroDetailHorizontalSelect'] . ' ' . $attributes['heroDetailVerticalSelect'] . ';
                                background-repeat: no-repeat;
                                background-size:' . $size . '
                                ">';
				$output .= '</div>';
			}
		}
		$output .= '</div>';
		$output .= '</div>';
		$output .= '<div class="hero__box ' . $extra_classes . ' is-highlighted">';
		$output .= '<h1 class="hero__headline">'.$attributes['headline'].'</h1>';
		$output .= '<h3 class="hero__subheadline">'.$attributes['subheadline'].'</h3>';
		if (is_countable($attributes['images']) && count($attributes['images']) > 1) {
			$output .= '<ul class="hero__pagination no-list-style"></ul>';
		}
		$output .= '</div>';
		$output .= '</div>';

	}
	return $output;
}

function wjd_cite_render($attributes, $content) {
    $output = '';
    $cardClass = 'quote';
    if ($attributes['mediaURL']) {
        $cardClass .= ' has-image';
    }
    if ($attributes['citeStyle']) {
        $cardClass .= ' is-highlight';
    } else {
        $cardClass .= ' is-detail';
    }
    if ($attributes['cite'] && strpos($attributes['cite'],'<br>') > 0) {
        $cardClass .= ' has-paragraphs';
    } else {
        $cardClass .= ' has-no-paragraphs';
    }
    $output .= '<blockquote class="quote '.$cardClass.'">';
        if ($attributes['mediaURL']) {
            $output .= '<div class="quote__image">';
                $output .= '<img src="'.$attributes['mediaURL'].'">';
            $output .= '</div>';
        }
        $output .= '<div class="quote__inner">';
            $output .= '<div class="quote__body">';
                if ($attributes['cite'] && strpos($attributes['cite'],'<br>') > 0) {
                    $explodedCite = explode('<br>',$attributes['cite']);
                    foreach ($explodedCite as $part) {
                        $output .= '<p class="cite-part">'.$part.'</p>';
                    }
                } else {
                    $output .= '<span class="cite-part">'.$attributes['cite'].'</span>';
                }
            $output .= '</div>';
            if ($attributes['person'] || $attributes['enterprise']) {
                $output .= '<footer class="quote__footer">';
                    if ($attributes['person']) {
                        $output .= '<p class="quote__name mh-gutter">'.$attributes['person'].'</p>';
                    }
                    if ($attributes['enterprise']) {
                        $output .= '<p class="quote__title mh-gutter">'.$attributes['enterprise'].'</p>';
                    }
                $output .= '</footer>';
            }
        $output .= '</div>';
    $output .= '</blockquote>';
    return $output;
}

function wjd_calendarwidget_render($attributes) {
    if (!$attributes['title']) {
        $attributes['title'] = 'Nächste Veranstaltungen';
    }
    global $wpdb;
    $date = new \DateTime();
    $result = $wpdb->get_results(
        'SELECT * FROM wjd_my_calendar WHERE "'.$date->format('Y-m-d').'" <= `event_end` LIMIT 3'
    );
    $output = '';
    $output .= '<div class="card v-card event-widget" style="height: 620px;">';
        $output .= '<div class="card__content">';
            $output .= '<h3 class="card__headline">Nächste Veranstaltungen</h3>';
            $output .= '<div class="card__main">';
                foreach ($result as $event_item) {
                    $output .= '<div class="event__item">';
                        $output .= '<span class="is-date">'.substr($event_item->event_begin,8,2).'.'.substr($event_item->event_begin,5,2).'.'.substr($event_item->event_begin,0,4).'</span>';
                        $output .= '<h3>'.$event_item->event_title.'</h3>';
                        $output .= '<a href="'.get_permalink(get_option('mc_uri_id')).'?mc_id='.$event_item->event_id.'" ref="cta" class="card__cta is-link" target="_self">Mehr lesen';
                            $output .= '<i class="card__icon  fas fa-chevron-right" aria-hidden="true"></i>';
                        $output .= '</a>';
                    $output .= '</div>';
                }
            $output .= '</div>';
        $output .= '</div>';
    $output .= '</div>';
    return $output;
}

// Hook: Block assets.
add_action( 'init', 'wjd_guten_blocks_cgb_block_assets' );
