<?php

if (!class_exists('WP_Bootstrap_Navwalker')) {

    /**
     * WP_Bootstrap_Navwalker class
     *
     * @package        Template
     * @subpackage     Bootstrap4
     *
     * @since          1.0.0
     * @see            https://getbootstrap.com/docs/4.0/components/navbar/
     * @extends        Walker_Nav_Menu
     * @author         Javier Prieto
     */
    class WP_Bootstrap_Navwalker extends Walker_Nav_Menu
    {
        /**
         * Starts the element output.
         *
         * @since 1.0.0
         *
         * @see Walker::start_el()
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param WP_Post $item Menu item data object.
         * @param int $depth Depth of menu item. Used for padding.
         * @param stdClass $args An object of wp_nav_menu() arguments.
         * @param int $id Current item ID.
         */
        public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
        {
            $href = $item->url;

            if ('/' === substr($href, 0, 1)) {
                $href = cryptotask_get_option('app_url') . $href;
            }

            $attributes  = '';

            ! empty( $item->attr_title )
            and $attributes .= ' title="'  . esc_attr( $item->attr_title ) .'"';
            ! empty( $item->target )
            and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';
            ! empty( $item->xfn )
            and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';
            ! empty( $item->url )
            and $attributes .= ' href="'   . $href .'"';

            $item_classes = array('dropdown-item');
            $title = apply_filters('the_title', $item->title, $item->ID);

            $item_output = $args->before;
            $item_output .= '<a ' . $attributes . ' class="' . implode(' ', $item_classes) . '">';
            $item_output .= $args->link_before . $title . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= $item_output;
        }

        /**
         * Ends the element output, if needed.
         *
         * @since 1.0.0
         *
         * @see Walker::end_el()
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param WP_Post $item Page data object. Not used.
         * @param int $depth Depth of page. Not Used.
         * @param stdClass $args An object of wp_nav_menu() arguments.
         */
        public function end_el(&$output, $item, $depth = 0, $args = array())
        {
            $output .= '</a>';
        }

        /**
         * Menu Fallback
         *
         * @since 1.0.0
         *
         * @param array $args passed from the wp_nav_menu function.
         */
        public static function fallback($args)
        {
            if (current_user_can('edit_theme_options')) {

                $defaults = array(
                    'container' => 'div',
                    'container_id' => false,
                    'container_class' => false,
                    'menu_class' => 'menu',
                    'menu_id' => false,
                );
                $args = wp_parse_args($args, $defaults);
                if (!empty($args['container'])) {
                    echo sprintf('<%s id="%s" class="%s">', $args['container'], $args['container_id'], $args['container_class']);
                }
                echo sprintf('<ul id="%s" class="%s">', $args['container_id'], $args['container_class']) .
                    '<li class="nav-item">' .
                    '<a href="' . admin_url('nav-menus.php') . '" class="nav-link">' . __('Add a menu') . '</a>' .
                    '</li></ul>';
                if (!empty($args['container'])) {
                    echo sprintf('</%s>', $args['container']);
                }
            }
        }
    }
}
