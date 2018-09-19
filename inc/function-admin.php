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

    // Activate custom settings.
    add_action( 'admin_init', 'premium_custom_settings' );

}
add_action( 'admin_menu', 'premium_add_admin_page' );

function premium_custom_settings() {
    register_setting( 'premium-settings-group', 'first_name' );
    register_setting( 'premium-settings-group', 'last_name' );

    add_settings_section('premium-sidebar-options', 'Sidebar Options', 'premium_sidebar_options', 'premium');

    add_settings_field('sidebar-name', 'Full Name', 'premium_sidebar_name', 'premium', 'premium-sidebar-options');
}

function premium_sidebar_options() {
    echo 'Customize Your Sidebar Information';
}

function premium_sidebar_name() {
    $firstName = esc_attr(get_option( 'first_name' ));
    $lastName = esc_attr(get_option( 'last_name' ));
    echo '<input type="text" name="first_name" value="'.$firstName.'" placeholder="First Name" />' .
    '<input type="text" name="last_name" value="'.$lastName.'" placeholder="Last Name" />';
}

function premium_theme_create_page() {
    
    require_once( get_template_directory() . '/inc/templates/premium-admin.php' );

}

function premium_theme_css_page() {

    echo '<h1>Premium Custom CSS</h1>';

}