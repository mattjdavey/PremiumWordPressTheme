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
    register_setting( 'premium-settings-group', 'user_description' );
    register_setting( 'premium-settings-group', 'twitter_handler', 'sunset_sanitize_twitter_handler' );
    register_setting( 'premium-settings-group', 'facebook_handler' );
    register_setting( 'premium-settings-group', 'gplus_handler' );

    add_settings_section('premium-sidebar-options', 'Sidebar Options', 'premium_sidebar_options', 'premium');

    add_settings_field('sidebar-name', 'Full Name', 'premium_sidebar_name', 'premium', 'premium-sidebar-options');
    add_settings_field('sidebar-description', 'Description', 'premium_sidebar_description', 'premium', 'premium-sidebar-options');
    add_settings_field('sidebar-twitter', 'Twitter Handler', 'premium_sidebar_twitter', 'premium', 'premium-sidebar-options');
    add_settings_field('sidebar-facebook', 'Facebook Handler', 'premium_sidebar_facebook', 'premium', 'premium-sidebar-options');
    add_settings_field('sidebar-gplus', 'Google+ Handler', 'premium_sidebar_gplus', 'premium', 'premium-sidebar-options');
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

function premium_sidebar_description() {
    $description = esc_attr(get_option( 'user_description' ));    
    echo '<input type="text" name="user_description" value="'.$description.'" placeholder="Description" />';
}

function premium_sidebar_twitter() {
    $twitter = esc_attr(get_option( 'twitter_handler' ));
    echo '<input type="text" name="twitter_handler" value="'.$twitter.'" placeholder="Twitter Handler" /><p class="description">Input your twitter username without the @ character.</p>';
}

function premium_sidebar_facebook() {
    $facebook = esc_attr(get_option( 'facebook_handler' ));
    echo '<input type="text" name="facebook_handler" value="'.$facebook.'" placeholder="Facebook Handler" />';
}

function premium_sidebar_gplus() {
    $gplus = esc_attr(get_option( 'gplus_handler' ));
    echo '<input type="text" name="gplus_handler" value="'.$gplus.'" placeholder="Google+ Handler" />';
}

// Sanitization settings
function sunset_sanitize_twitter_handler( $input ) {
      $output = sanitize_text_field( $input );
      $output = str_replace('@', '', $output);
      return $output;  
}

function premium_theme_create_page() {
    
    require_once( get_template_directory() . '/inc/templates/premium-admin.php' );

}

function premium_theme_css_page() {

    echo '<h1>Premium Custom CSS</h1>';

}