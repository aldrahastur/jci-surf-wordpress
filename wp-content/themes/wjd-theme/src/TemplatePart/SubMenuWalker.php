<?php

namespace WJD\TemplatePart;
use Walker_Nav_Menu;

defined('ABSPATH') or die();

class SubMenuWalker extends Walker_Nav_Menu
{
    /**
     * @see Walker::start_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of page. Used for padding.
     */
    public function start_lvl(&$output, $depth = 0, $args = NULL)
    {
        if (!$args) {
            $args = new \stdClass();
        }
        if (!isset($args->start_depth) || $depth >= $args->start_depth-1) {
            $indent = str_repeat("\t", $depth);
            if ($depth === 0) {
                $output .= "\n" . $indent . '<ul class="sub-nav__items no-list-style is-level-' . $depth . '">' . "\n";
            } else {
                $output .= "\n" . $indent . '<nav data-name="sub-nav-children" class="sub-nav-children is-level-'.$depth.'"><ul class="sub-nav-children__items no-list-style is-level-' . $depth . '">' . "\n";
            }
        }
    }

    public function end_lvl( &$output, $depth = 0, $args = NULL) 
    {
        if (!$args) {
            $args = new \stdClass();
        }
        if (!isset($args->start_depth) || $depth >= $args->start_depth-1) {
            $indent = str_repeat("\t", $depth);
            if ($depth === 0) {
                $output .= "$indent</ul>\n";
            } else {
                $output .= "$indent</ul></nav>\n";
            }
        }
    }

    /**
     * @see Walker::start_el()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param int $current_page Menu item ID.
     * @param object $args
     */
    public function start_el(&$output, $item, $depth = 0, $args = NULL, $id = 0)
    {
        if (!$args) {
            $args = new \stdClass();
        }
        $args->start_depth = 1;
        if ((!isset($args->start_depth) || $depth >= $args->start_depth)) {
            $indent = ( $depth ) ? str_repeat("\t", $depth) : '';

            /**
             * Dividers, Headers or Disabled
             * =============================
             * Determine whether the item is a Divider, Header, Disabled or regular
             * menu item. To prevent errors we use the strcasecmp() function to so a
             * comparison that is not case sensitive. The strcasecmp() function returns
             * a 0 if the strings are equal.
             */
            if (strcasecmp($item->attr_title, 'divider') == 0 && $depth === 1) {
                $output .= $indent . '<li role="presentation" class="divider">';
            } else if (strcasecmp($item->title, 'divider') == 0 && $depth === 1) {
                $output .= $indent . '<li role="presentation" class="divider">';
            } else if (strcasecmp($item->attr_title, 'dropdown-header') == 0 && $depth === 1) {
                $output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr($item->title);
            } else if (strcasecmp($item->attr_title, 'disabled') == 0) {
                $output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr($item->title) . '</a>';
            } else {

                $class_names = $value = '';

                $classes = empty( $item->classes ) ? array() : (array) $item->classes;
                if ($depth === 1) {
                    $classes[] = 'sub-nav__item';
                } else {
                    $classes[] = 'sub-nav-children__item';
                }
                $classes[] = 'is-level-' . ($depth-1);

                $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));

                if (in_array('current-menu-item', $classes)) {
                    $class_names .= ' is-active';
                }

                $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

                $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
                $id = $id ? ' id="' . esc_attr($id) . '"' : '';

                $output .= $indent . '<li' . $id . $value . $class_names . '>';

                $atts = array();
                $atts['target'] = !empty($item->target) ? $item->target : '';
                $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';

                // If item has_children add atts to a.
                if (in_array('current-menu-item', $classes)) {
                    $atts['class'] .= ' is-active ';
                }
                if ($args->has_children) {
                    $atts['class'] = 'has-children ';
                }
                if ($depth === 1) {
                    $atts['class'] .= 'sub-nav__item-link is-level-'.($depth-1);
                } else {
                    $atts['class'] .= 'sub-nav-children__item-link is-level-'.($depth-1);
                }


                $atts['href'] = !empty($item->url) ? $item->url : '';

                $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);

                $attributes = '';
                foreach ($atts as $attr => $value) {
                    if (!empty($value)) {
                        $value = ( 'href' === $attr ) ? esc_url($value) : esc_attr($value);
                        $attributes .= ' ' . $attr . '="' . $value . '"';
                    }
                }

                $item_output = $args->before;
                $description = ( ! empty ( trim($item->post_content) ) ) ? '<span class="sub-nav__subtitle">' . esc_attr( $item->post_content ) . '</span>' : '';

                /*
                 * Glyphicons
                 * ===========
                 * Since the the menu item is NOT a Divider or Header we check the see
                 * if there is a value in the attr_title property. If the attr_title
                 * property is NOT null we apply it as the class name for the glyphicon.
                 */
                if (!empty($item->attr_title))
                    $item_output .= '<a' . $attributes . '><span class="glyphicon ' . esc_attr($item->attr_title) . '"></span>&nbsp;';
                else
                    $item_output .= '<a' . $attributes . '>';

                $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
                $item_output .= $description.'</a>';
                $item_output .= $args->after;

                $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
            }
        } else {
            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $active = '';
            if (in_array('current-menu-item', $classes) || in_array('current-page-ancestor', $classes)) {
                $active = ' is-active'; 
            }
            $output .= '<nav data-name="sub-nav" class="sub-nav header__sub-nav is-level-'.$depth. $active . '">';
        }
    }

    public function end_el( &$output, $item, $depth = 0, $args = NULL ) 
    {
        if (!$args) {
            $args = new \stdClass();
        }
        if (!isset($args->start_depth) || $depth >= $args->start_depth) {
            $output .= '</li>';
        } else {
            $output .= '</nav>';
        }
    }

    /**
     * Traverse elements to create list from elements.
     *
     * Display one element if the element doesn't have any children otherwise,
     * display the element and its children. Will only traverse up to the max
     * depth and no ignore elements under that depth.
     *
     * This method shouldn't be called directly, use the walk() method instead.
     *
     * @see Walker::start_el()
     * @since 2.5.0
     *
     * @param object $element Data object
     * @param array $children_elements List of elements to continue traversing.
     * @param int $max_depth Max depth to traverse.
     * @param int $depth Depth of current element.
     * @param array $args
     * @param string $output Passed by reference. Used to append additional content.
     * @return null Null on failure with no changes to parameters.
     */
    public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
    {
        if (!$element)
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if (is_object($args[0]))
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);

        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    /**
     * Menu Fallback
     * =============
     * If this function is assigned to the wp_nav_menu's fallback_cb variable
     * and a manu has not been assigned to the theme location in the WordPress
     * menu manager the function with display nothing to a non-logged in user,
     * and will add a link to the WordPress menu manager if logged in as an admin.
     *
     * @param array $args passed from the wp_nav_menu function.
     *
     */
    public static function fallback($args)
    {
        if (current_user_can('manage_options')) {

            $fb_output = null;

            if ($args['container']) {
                $fb_output = '<' . $args['container'];

                if ($args['container_id']) {
                    $fb_output .= ' id="' . $args['container_id'] . '"';
                }

                if ($args['container_class']) {
                    $fb_output .= ' class="' . $args['container_class'] . '"';
                }

                $fb_output .= '>';
            }

            $fb_output .= '<ul';

            if ($args['menu_id']) {
                $fb_output .= ' id="' . $args['menu_id'] . '"';
            }

            if ($args['menu_class']) {
                $fb_output .= ' class="' . $args['menu_class'] . '"';
            }

            $fb_output .= '>';
            $fb_output .= '<li><a href="' . admin_url('nav-menus.php') . '">Add a menu</a></li>';
            $fb_output .= '</ul>';

            if ($args['container'])
                $fb_output .= '</' . $args['container'] . '>';

            echo $fb_output;
        }
    }

}
