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
    add_submenu_page('premium', 'Premium Sidebar Options', 'Sidebar', 'manage_options', 'premium', 'premium_theme_create_page');
    add_submenu_page('premium', 'Premium Theme Options', 'Theme Options', 'manage_options', 'premium_theme', 'premium_theme_support_page');
    add_submenu_page('premium', 'Premium Contact Form', 'Contact Form', 'manage_options', 'premium_theme_contact', 'premium_theme_contact_form_page');
    add_submenu_page('premium', 'Premium CSS Options', 'Custom CSS', 'manage_options', 'premium_css', 'premium_theme_css_page');
    
    // Activate custom settings.
    add_action( 'admin_init', 'premium_custom_settings' );

}
add_action( 'admin_menu', 'premium_add_admin_page' );

function premium_custom_settings() {
    // Sidebar options
    register_setting( 'premium-settings-group', 'profile_picture' );
    register_setting( 'premium-settings-group', 'first_name' );
    register_setting( 'premium-settings-group', 'last_name' );
    register_setting( 'premium-settings-group', 'user_description' );
    register_setting( 'premium-settings-group', 'twitter_handler', 'sunset_sanitize_twitter_handler' );
    register_setting( 'premium-settings-group', 'facebook_handler' );
    register_setting( 'premium-settings-group', 'gplus_handler' );

    add_settings_section('premium-sidebar-options', 'Sidebar Options', 'premium_sidebar_options', 'premium');

    add_settings_field('sidebar-profile-picture', 'Profile Picture', 'premium_sidebar_profile', 'premium', 'premium-sidebar-options');
    add_settings_field('sidebar-name', 'Full Name', 'premium_sidebar_name', 'premium', 'premium-sidebar-options');
    add_settings_field('sidebar-description', 'Description', 'premium_sidebar_description', 'premium', 'premium-sidebar-options');
    add_settings_field('sidebar-twitter', 'Twitter Handler', 'premium_sidebar_twitter', 'premium', 'premium-sidebar-options');
    add_settings_field('sidebar-facebook', 'Facebook Handler', 'premium_sidebar_facebook', 'premium', 'premium-sidebar-options');
    add_settings_field('sidebar-gplus', 'Google+ Handler', 'premium_sidebar_gplus', 'premium', 'premium-sidebar-options');

    // Theme support options.
    register_setting( 'premium-theme-support', 'post_formats' );
    register_setting( 'premium-theme-support', 'custom_header' );
    register_setting( 'premium-theme-support', 'custom_background' );

    add_settings_section('premium-theme-options', 'Theme Options', 'premium_theme_options', 'premium_theme');

    add_settings_field( 'post-formats', 'Post Formats', 'premium_post_formats', 'premium_theme', 'premium-theme-options' );
    add_settings_field( 'custom-header', 'Custom Header', 'premium_custom_header', 'premium_theme', 'premium-theme-options' );
    add_settings_field( 'custom-background', 'Custom Background', 'premium_custom_background', 'premium_theme', 'premium-theme-options' );

    // Contact form options.
    register_setting( 'premium-contact-options', 'activate_contact' );

    add_settings_section( 'premium-contact-section', 'Contact Form', 'premium_contact_section', 'premium_theme_contact' );

    add_settings_field( 'activate-form', 'Activate Contact Form', 'premium_activate_contact', 'premium_theme_contact', 'premium-contact-section' );

}

function premium_theme_options() {
    echo 'Activate and Deactivate specific Theme Support Options';
}

function premium_contact_section() {
    echo 'Activate and Deactivate the Built-in contact form.';
}

function premium_activate_contact() {
    $options = get_option( 'activate_contact' );
    $checked = ( @$options == 1 ? 'checked' : '' );
    $output .= '<label><input type="checkbox" id="activate_contact" name="activate_contact" value="1" '.$checked.'></label><br>';
    echo $output;
}

function premium_post_formats() {
    $options = get_option( 'post_formats' );
    $formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
    $output = '';
    foreach ( $formats as $format ) {
        $checked = ( @$options[$format] == 1 ? 'checked' : '' );
        $output .= '<label><input type="checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1" '.$checked.'>'.$format.'</label><br>';
    }
    echo $output;

}

function premium_custom_header() {
    $options = get_option( 'custom_header' );
    $checked = ( @$options == 1 ? 'checked' : '' );
    $output .= '<label><input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.'>Activate Custom Header</label><br>';
    echo $output;

}

function premium_custom_background() {
    $options = get_option( 'custom_background' );
    $checked = ( @$options == 1 ? 'checked' : '' );
    $output .= '<label><input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.'>Activate Custom Background</label><br>';
    echo $output;

}

// Sidebar Options Functions
function premium_sidebar_options() {
    echo 'Customize Your Sidebar Information';
}

function premium_sidebar_profile() {

    $picture = esc_attr(get_option( 'profile_picture' )); 
    if( empty($picture) ) {
        echo '<input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button" /><input id="profile-picture" type="hidden" name="profile_picture" value="" />';
    } else {
        echo '<input type="button" class="button button-secondary" value="Replace Profile Picture" id="upload-button" /><input id="profile-picture" type="hidden" name="profile_picture" value="'.$picture.'" /> <input type="button" class="button button-secondary" value="Remove" id="remove-picture" /><input id="profile-picture" type="hidden" name="profile_picture" value="" ';
    }
    
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

//Template submenu functions
function premium_theme_create_page() {
    
    require_once( get_template_directory() . '/inc/templates/premium-admin.php' );

}

function premium_theme_css_page() {

    echo '<h1>Premium Custom CSS</h1>';

}

function premium_theme_support_page() {
    require_once( get_template_directory() . '/inc/templates/premium-theme-support.php' );
}

function premium_theme_contact_form_page() {
    require_once( get_template_directory() . '/inc/templates/premium-contact-form.php' );
}