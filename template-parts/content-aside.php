<?php 
/*
@package premiumtheme
-- Standard Post Format
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'premium-format-aside' ); ?>>
    <div class="aside-container">
        <div class="row">
            <div class="col-xs-12 col-sm-3 col-md-2 text-center">
                <?php if (premium_get_attachment() ) : ?>            
                <div class="aside-featured background-image" style="background-image: url(<?php echo premium_get_attachment(); ?>"></div>                                            
                <?php endif; ?>
            </div>
            <div class="col-xs-12 col-sm-9 col-md-10">
                <header class="entry-header">        

                <div class="entry-meta">
                    <?php echo premium_posted_meta(); ?>
                </div>

                </header>

                <div class="entry-content">        

                <div class="entry-excerpt">
                    <?php the_content(); ?>
                </div>

                </div>
            </div>
        </div>
        

        <footer class="entry-footer">
            <div class="row">
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
                    <?php echo premium_posted_footer() ?>
                </div>
            </div>
        </footer>
        
    </div>

</article>