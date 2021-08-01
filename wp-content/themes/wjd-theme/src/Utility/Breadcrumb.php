<?php
namespace WJD\Utility;

defined('ABSPATH') or die;

class Breadcrumb
{
    public static function nav_breadcrumb()
    {
        $delimiter = '<i class="breadcrumbs__separator-icon fa fa-chevron-right"></i>';
        $home = '<i class="breadcrumbs__icon fa fa-home is-first"></i>';
        $before = '<li class="breadcrumbs__item is-last">'.$delimiter.'<span class="breadcrumbs__disabled-link is-last">';
        if (get_query_var('paged')) {
            $pageAddition = '';
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
                $pageAddition .= ' (';
            }
            $pageAddition .= ': ' . __('Seite') . ' ' . get_query_var('paged');
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
                $pageAddition .= ')';
            }
            $after = $pageAddition.'</span></li>';
        } else {
            $after = '</span></li>';            
        }
        if (!is_front_page() || is_paged()) {
            echo '<div class="container breadcrumbs-container"><ul class="breadcrumbs mb-md no-list-style">';
            global $post;
            $homeLink = get_bloginfo('url');
            echo '<li class="breadcrumbs__item is-first"><a class="breadcrumbs__link is-first" href="' . $homeLink . '">' . $home . '</a></li>';
            if (is_category()) {
                global $wp_query;
                $cat_obj = $wp_query->get_queried_object();
                $thisCat = $cat_obj->term_id;
                $thisCat = get_category($thisCat);
                $parentCat = get_category($thisCat->parent);
                if ($thisCat->parent != 0) {
                    echo (get_category_parents($parentCat, true, ' ' . $delimiter . ' '));
                }
                echo $before . single_cat_title('', false) . $after;
            } elseif (is_day()) {
                echo '<li class="breadcrumbs__item">'.$delimiter.'<a class="breadcrumbs__link" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
                echo '<li class="breadcrumbs__item">'.$delimiter.'<a class="breadcrumbs__link" href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a></li>';
                echo $before . get_the_time('d') . $after;
            } elseif (is_month()) {
                echo '<li class="breadcrumbs__item">'.$delimiter.'<a class="breadcrumbs__link" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
                echo $before . get_the_time('F') . $after;
            } elseif (is_year()) {
                echo $before . get_the_time('Y') . $after;
            } elseif (is_single() && !is_attachment()) {
                if (get_post_type() != 'post') {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    echo '<li class="breadcrumbs__item">'.$delimiter.'<a class="breadcrumbs__link test" href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->name . '</a></li>';
                    echo $before . get_the_title() . $after;
                } else {
                    $cat = get_the_category();
                    $cat = $cat[0];
                    echo get_category_parents($cat, true, ' ' . $delimiter . ' ');
                    echo $before . get_the_title() . $after;
                }
            } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
                $post_type = get_post_type_object(get_post_type());
                echo $before . $post_type->labels->name . $after;
            } elseif (is_attachment()) {
                $parent = get_post($post->post_parent);
                $cat = get_the_category($parent->ID);
                $cat = $cat[0];
                echo get_category_parents($cat, true, ' ' . $delimiter . ' ');
                echo '<li class="breadcrumbs__item">'.$delimiter.'<a class="breadcrumbs__link" href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
                echo $before . get_the_title() . $after;
            } elseif (is_page() && !$post->post_parent) {
                echo $before . get_the_title() . $after;
            } elseif (is_page() && $post->post_parent) {
                $parent_id = $post->post_parent;
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    $breadcrumbs[] = '<li class="breadcrumbs__item">'.$delimiter.'<a class="breadcrumbs__link" href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
                    $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                foreach ($breadcrumbs as $crumb) {
                    echo $crumb;
                }
                echo $before . get_the_title() . $after;
            } elseif (is_search()) {
                echo $before . 'Ergebnisse für Ihre Suche nach "' . get_search_query() . '"' . $after;
            } elseif (is_tag()) {
                echo $before . 'Beiträge mit dem Schlagwort "' . single_tag_title('', false) . '"' . $after;
            } elseif (is_404()) {
                echo $before . 'Fehler 404' . $after;
            } elseif (is_home()) {
                $ancestors = get_post_ancestors(get_queried_object_id());
                if (count($ancestors) > 0) {                    
                    foreach ($ancestors as $ancestor) {
                        echo '<li class="breadcrumbs__item">'.$delimiter.'<a class="breadcrumbs__link" href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    }
                }
                echo $before.get_queried_object()->post_title.$after;
            }
            echo '</ul></div>';
        }
    }
}
