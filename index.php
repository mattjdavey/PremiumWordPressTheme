<?php 
/*
@package premiumtheme
*/

get_header(); ?>

    <div id="primary" class="content-area">

        <main id="main" class="site-main" role="main">

            <?php if( is_paged() ): ?>
            <div class="container text-center container-load-previous">
                <a class="btn-premium-load premium-load-more" data-prev="1" data-page="<?php echo premium_check_paged(1) ?>" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
                    <span class="fa fa-spinner"></span> 
                    <span class="text">Load Previous</span>                    
                </a>
            </div>
            <?php endif; ?>


            <div class="container premium-posts-container">

                <?php

                    if ( have_posts() ) :

                        echo '<div class="page-limit" data-page="/'. premium_check_paged() .'">';

                        while ( have_posts() ) : the_post();
                            
                            //$class = 'reveal';
                            //set_query_var( 'post-class', $class );
                            get_template_part( 'template-parts/content', get_post_format() );

                        endwhile;

                        echo '</div>';

                    endif;

                ?>
                    
            </div>

            <div class="container text-center">
                <a class="btn-premium-load premium-load-more" data-page="<?php echo premium_check_paged(1) ?>" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
                    <span class="fa fa-spinner"></span> 
                    <span class="text">Load More</span>                    
                </a>
            </div>

        </main>

    </div>


<?php get_footer(); ?>