<?php 
/*
@package premiumtheme
-- Standard Post Format
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'premium-format-link' ); ?>>

    <header class="entry-header text-center">

        <?php 
            $link = premium_grab_url();
            the_title( '<h1 class="entry-title"><a href="'. $link .'" target="_blank">', '<div class="link-icon"><span class="fa fa-link"></span></div></a></h1>') 
        ?>       
        
    </header>

</article>