<?php

/*
    ====================================
        ADMIN PAGE
    ====================================
*/
function premium_add_admin_page() {
    
    // Generate premium admin page.
    add_menu_page( 'Premium Theme Options', 'Premium', 'manage_options', 'premium', 'premium_theme_create_page', '
    dashicons-admin-generic', 100 );

    // Generate premium admin sub pages.
    add_submenu_page('premium', 'Premium Theme Options', 'General', 'manage_options', 'premium', 'premium_theme_create_page');

    add_submenu_page('premium', 'Premium CSS Options', 'Custom CSS', 'manage_options', 'premium_css', 'premium_theme_css_page');

}
add_action( 'admin_menu', 'premium_add_admin_page' );

function premium_theme_create_page() {
    
    require_once( get_template_directory() . '/inc/templates/premium-admin.php' );

}

function premium_theme_css_page() {

    echo '<h1>Premium Custom CSS</h1>';

}