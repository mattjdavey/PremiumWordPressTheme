<?php

/*

@package premiumtheme
 ====================================
        THEME CUSTOM POST TYPES
====================================

*/

$contact = get_option( 'activate_contact' );
if ( @$contact == 1 ) {

    add_action( 'init', 'sunset_contact_custom_post_type' );

    add_filter( 'manage_premium-contact_posts_columns', 'premium_set_contact_columns' );
    add_action( 'manage_premium-contact_posts_custom_column', 'premium_contact_custom_column', 10, 2 );
}

/* CONTACT CPT */
function sunset_contact_custom_post_type() {
    $labels = array(
        'name'              => 'Messages',
        'singular_name'     => 'Message',
        'menu_name'         => 'Messages',
        'name_admin_bar'    => 'Message'
    );

    $args = array(
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'capability_type'   => 'post',
        'heirarchical'      => false,
        'menu_position'     => 26,
        'menu_icon'         => 'dashicons-email-alt',
        'supports'          => array( 'title', 'editor', 'author' )
    );

    register_post_type( 'premium-contact', $args );
}

function premium_set_contact_columns( $columns ) {

    $newColumns = array();
    $newColumns['title'] = 'Full Name';
    $newColumns['message'] = 'Message';
    $newColumns['email'] = 'Email';
    $newColumns['date'] = 'Date';    

    return $newColumns;

}

function premium_contact_custom_column( $column, $post_id ) {

    switch( $column ) {
        
        case 'message' :
            echo get_the_excerpt();
            break;
        case 'email' :
            echo 'email address';
            break;

    }

}