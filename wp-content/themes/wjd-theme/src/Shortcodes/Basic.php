<?php
namespace WJD\Shortcodes;

defined('ABSPATH') or die();

class Basic{
    public function __construct()
    {
        add_shortcode('button', array($this, 'buttonShortcode'));
        add_shortcode('social_link', array($this, 'socialLinkShortcode'));
        add_shortcode('icon_link', array($this, 'iconLinkShortcode'));
        add_shortcode('nv_display_posts', array($this, 'nvDisplayPostsShortcode'));
        add_shortcode('latest_news', array($this, 'nova_news_shortcode'));
    }

    public function buttonShortcode($atts, $content) {
        $atts = shortcode_atts([
            'type' => 'primary',
            'size' => 'large',
        ], $atts, 'buttonShortcode');
        return str_replace('<a ', '<a class="button is-'.$atts['type'].' is-'.$atts['size'].'"', $content);
    }
    public function socialLinkShortcode($atts) {
        $atts = shortcode_atts([
            'type' => '',
            'url' => '',
            'text' => '',
        ], $atts, 'socialLinkShortcode');

        return '<a href="'.$atts['url'].'" target="_blank" class="is-social-icon"><i class="fab fa-'.$atts['type'].'-square" aria-hidden="true"></i>'.$atts['text'].'</a>';
    }
    public function iconLinkShortcode($atts) {
        $atts = shortcode_atts([
            'icon' => '',
            'url' => '',
            'text' => '',
        ], $atts, 'iconLinkShortcode');

        return '<a href="'.$atts['url'].'" target="_self"><i class="meta-nav__icon  fa fa-'.$atts['icon'].'-alt" aria-hidden="true"></i>'.$atts['text'].'</a>';
    }
    function nvDisplayPostsShortcode($atts) {
        if (!isset($atts['category'])) {
            return;
        }

        $args = [
            'category' => $atts['category'],
            'posts_per_page' => isset($atts['numberposts']) ? $atts['numberposts'] : -1
        ];

        $posts = get_posts($args);

        $markup = '<div class="nv-display-posts-listing"><div class="container"><div class="row">';

        foreach ($posts as $post) {
            setup_postdata($post);

            $markup .= '
          <div class="col col-12">
            <div class="card has-image v-card">
              <div class="card__image-wrapper">
                <figure class="figure">
                  <div class="figure__image-wrapper is-highlighted">
                    <div class="figure__image">
                      '. get_the_post_thumbnail($post->ID) .'
                    </div>
                  </div>
                </figure>
              </div>
              <div class="card__content">
                <div class="card__main">
                  <h3 class="card__headline">'. get_the_title($post->ID) .'</h3>
                  <div class="rte-content v-margin-collapse">'. get_the_excerpt($post->ID) .'</div>
                </div>
                <div class="card__footer">
                  <a class="card__cta is-link" href="'. get_the_permalink($post->ID) .'">
                    '. __('mehr lesen') .'
                    <i class="card__icon  fas fa-chevron-right" aria-hidden="true"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        ';
        }

        wp_reset_postdata();

        $markup .= '</div></div></div>';

        return $markup;
    }
    function nova_news_shortcode()
    {
        $args = [
            'post_type' => 'post',
            'posts_per_page' => 3
        ];

        $html = '';
        $html .= '<div class="wp-block-columns news">';
        $the_query = new  \WP_Query( $args );

        if ( $the_query->have_posts() ) :
            while ( $the_query->have_posts() ) : $the_query->the_post();
                $post_image_uri     = wp_get_attachment_url( get_post_thumbnail_id() ) ?? '';
                $post_date          = get_the_date('d.m.Y') ?? '';
                $post_title         = get_the_title() ?? '';
                $post_content       = get_the_excerpt() ?? '';
                $post_uri           = get_the_permalink(get_the_ID(), false) ?? '';
                $cats               = get_the_category() ?? '';
                $first_cat_name     = $cats[0]->cat_name ?? '';

                $html .= <<<CARDS
            <div class="wp-block-column">
                <div class="card  has-image has-credit has-cta has-link">
                    <div class="card__image-wrapper">
                        <figure class="figure">
                            <div class="figure__image-wrapper is-highlighted">
                                <div class="figure__image">
                                    <a class="card__image-link" href="#default">
                                        <img src="$post_image_uri"></a>
                                </div>
                            </div>
                        </figure>
                    </div>
                    <div class="card__content">
                        <ul class="card__meta-data no-list-style">
                            <li class="card__meta-data-item is-date">$post_date</li>
                            <li class="card__meta-data-item is-text">$first_cat_name</li>
                        </ul>
                        <div class="card__main">
                            <h3 class="card__headline">$post_title</h3>
                            <div class="rte-content v-margin-collapse">
                                <p>$post_content</p>
                            </div>
                        </div>
                        <div class="card__footer">
                            <a href="$post_uri" ref="cta" class="card__cta is-link n-link" target="_self">Mehr lesen<i class="card__icon  fas fa-chevron-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
CARDS;
            endwhile;
            wp_reset_postdata();
        endif;
        $html .= '</div>';

        return $html;
    }
}