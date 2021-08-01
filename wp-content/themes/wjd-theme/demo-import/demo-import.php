<?php
    function ocdi_import_files() {
        return array(
            array(
                'import_file_name'           => 'Daten Importieren',
                'local_import_file'      => get_template_directory() . '/demo-import/demo-data.xml'
            )
        );
    }
    add_filter( 'pt-ocdi/import_files', 'ocdi_import_files' );

    function ocdi_after_import_setup() {
        // // Assign menus to their locations.
        $main_menu = get_term_by( 'name', 'Hauptmenu', 'nav_menu' );
        $footer_menu = get_term_by( 'name', 'Footermenu', 'nav_menu' );

        set_theme_mod( 'nav_menu_locations', array(
            'main-menu' => $main_menu->term_id,
            'footer-menu' => $footer_menu->term_id,
            )
        );
    
        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title( 'Wirtschaftsjunioren Karlsruhe' );
        $blog_page_id  = get_page_by_title( 'News' );
    
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page_id->ID );
        update_option( 'page_for_posts', $blog_page_id->ID );
    
    }
    add_action( 'pt-ocdi/after_import', 'ocdi_after_import_setup' );
?>