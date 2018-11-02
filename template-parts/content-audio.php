<?php 
/*
@package premiumtheme
-- Audio Post Format
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'premium-format-audio' ); ?>>

    <header class="entry-header">

        <?php the_title( '<h1 class="entry-title"><a href="'. esc_url( get_permalink() ) . '" rel="bookmark">', '</h1>') ?>

        <div class="entry-meta">
            <?php echo premium_posted_meta(); ?>
        </div>
        
    </header>

    <div class="entry-content">        

        <?php echo premium_get_embedded_media( array( 'audio', 'iframe' ) ); ?>
                
    </div>

    <footer class="entry-footer">

        <?php echo premium_posted_footer() ?>

    </footer>

</article>