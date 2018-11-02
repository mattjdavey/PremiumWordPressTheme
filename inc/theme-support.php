<?php

/*

@package premiumtheme
    ====================================
        THEME SUPPORT OPTIONS
    ====================================

*/

$options = get_option( 'post_formats' );
$formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
$output = array();
foreach ( $formats as $format ) {
    $output[] = ( @$options[$format] == 1 ? $format : '' );   
}
if ( !empty ($options) ) {
    add_theme_support('post-formats', $output);
}

$header = get_option( 'custom_header' );
if ( @$header == 1 ) {
    add_theme_support('custom-header');
}

$background = get_option( 'custom_background' );
if ( @$background == 1 ) {
    add_theme_support('custom-background');
}

add_theme_support( 'post-thumbnails' );

/* Activate Nav Menu Option */
function premium_register_nav_menu() {
    register_nav_menu( 'primary', 'Header Navigation Menu');
}
add_action( 'after_setup_theme', 'premium_register_nav_menu' );

/* 
    ====================================
        BLOG LOOP CUSTOM FUNCTION
    ====================================
*/
function premium_posted_meta() {
    
    $posted_on = human_time_diff( get_the_time('U'), current_time( 'timestamp') );
    
    $categories = get_the_category();
    $separator = ', ';
    $output = '';
    $i = 1;

    if ( !empty($categories) ):
    
        foreach( $categories as $category ):
            if ( $i > 1 ): $output .= $separator; endif; 

            $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( 'View all posts in%s', $category->name) . '">' . esc_html( $category->name) . '</a>';
            $i++;
        endforeach;
    endif;
    
    return '<span class="posted-on">Posted <a href="' . esc_url( get_the_permalink() ) . '">' . $posted_on . ' ago</span> / <span class="posted-in">' . $output . '</span>';
}

function premium_posted_footer() {

    $comments_num = get_comments_number();
    if ( comments_open() ) {
        if( $comments_num == 0 ) {
            $comments = __('No comments');            
        } elseif ( $comments_num > 1 ) {
            $comments = $comments_num . __(' Comments');
        } else {
            $comments = __('1 Comment');
        }
        $comments = '<a class="comments-link" href="'. get_comments_link() .'">' . $comments . ' <span class="premium-icon fa fa-comments"></span></a>';
    } else {
        $comments = __('Comments are closed');
    }

    return '<div class="post-footer-container"><div class="row"><div class="col-xs-12 col-sm-6">'. get_the_tag_list( '<div class="tags-list"><span class="premium-icon fa fa-tags"></span> ', ' ', '</div>') .'</div><div class="col-xs-12 col-sm-6 text-right">'. $comments .'</div></div></div>';
}

function premium_get_attachment() {
    $output = '';
    if (has_post_thumbnail() ) :
        $output = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
    else:            
        $attachments = get_posts( array(
            'post_type'     => 'attachment',
            'posts_per_page'   => 1,
            'post_parent'  => get_the_ID()
        ));
    
        if( $attachments ):
            foreach ( $attachments as $attachment ):
                $output = wp_get_attachment_url( $attachment->ID );
            endforeach;    
        endif;

        wp_reset_postdata();
    endif;
    return $output;
}

function premium_get_embedded_media( $type = array() ) {

    $content = do_shortcode( apply_filters('the_content', get_the_content() ) );
    $embed = get_media_embedded_in_content( $content, $type);

    if ( in_array( 'audio', $type ) ):
        $output = str_replace( '?visual=true', '?visual=false', $embed[0]); 
    else:
        $output = $embed[0];
    endif;
    return $output;


}
    