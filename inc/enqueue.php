<?php 

/*
    ====================================
        ADMIN ENQUEUE FUNCTIONS
    ====================================
*/

function premium_load_admin_scripts( $hook ) {    
        
    if ('toplevel_page_premium' == $hook) {
       
        wp_register_style( 'premium_admin', get_template_directory_uri() . '/css/premium.admin.css', array(), '1.0.0', 'all' );    
        wp_enqueue_style( 'premium_admin' );

        wp_enqueue_media();

        wp_register_script('premium-admin-script', get_template_directory_uri() . '/js/premium.admin.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script( 'premium-admin-script' );
    } else if ( 'premium_page_premium_css' == $hook ) {

        wp_enqueue_style('ace-css', get_template_directory_uri() . '/css/premium.ace.css', array(), '1.0.0', 'all' );

        wp_enqueue_script( 'ace', get_template_directory_uri() . '/js/ace/ace.js', array('jquery'), '1.2.1', true );
        wp_enqueue_script( 'premium-custom-css-script', get_template_directory_uri() . '/js/premium.custom_css.js', array('jquery'), '1.0.0', true );

    } else { return; }

}
add_action( 'admin_enqueue_scripts', 'premium_load_admin_scripts' );

/*
    ====================================
        FRONT-END ENQUEUE FUNCTIONS
    ====================================
*/

function premium_load_scripts() {

    wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), '3.3.7', 'all' );
    wp_enqueue_style( 'premium', get_template_directory_uri() . '/css/premium.css', array(), '1.0.0', 'all' );
    wp_enqueue_style( 'raleway', 'https://fonts.googleapis.com/css?family=Raleway:200,300,500' );
    wp_enqueue_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );

    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.js', false, '1.11.3', true );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), '3.3.7', true );
    wp_enqueue_script( 'premium', get_template_directory_uri() . '/js/premium.js', array('jquery'), '1.0.0', true );

}
add_action('wp_enqueue_scripts', 'premium_load_scripts' );