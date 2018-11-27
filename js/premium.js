jQuery(document).ready( function($) {

    /* init functions */
    revealPosts();

    /* variable declarations */
    var carousel = '.premium-carousel-thumb';
    var last_scroll = 0;

    /* carousel functions */
    premium_get_bs_thumbs( carousel );

    $('.premium-carousel-thumb').on('slid.bs.carousel', function() {
        premium_get_bs_thumbs( carousel );
    });

    function premium_get_bs_thumbs( carousel ) {
        var nextThumb = $('.item.active').find('.next-image-preview').data('image');            
        var prevThumb = $('.item.active').find('.previous-image-preview').data('image');  

        $(carousel).find('.carousel-control.right').find('.thumbnail-container').css({ 'background-image' : 'url(' + nextThumb + ')' });
        $(carousel).find('.carousel-control.left').find('.thumbnail-container').css({ 'background-image' : 'url(' + prevThumb + ')' });
    }

    /* Ajax functions */
    $(document).on('click', '.premium-load-more:not(.loading)', function() {

        var that = $(this);
        var page = that.data('page');
        var newPage = page+1;
        var ajaxurl = that.data('url');
        var prev = that.data('prev');

        if( typeof(prev) === 'undefined' ) {
            prev = 0;
        }

        that.addClass('loading').find('.text').slideUp(320);
        that.find('.fa-spinner').addClass('spin');
        
        $.ajax({
            url     : ajaxurl,
            type    : 'post',
            data    : {
                page    : page,
                prev    : prev,
                action  : 'premium_load_more' 
            },
            error   : function( response ){
                console.log(response.error + "something went wrong.");
            },
            success : function( response ) {     
                
                if( response == 0 ) {

                    $('.premium-posts-container').append( '<div class="text-center"><h3>You reached the end of the line!</h3><p>No more posts to load.</p></div>' );

                    that.slideUp(320);

                }
                else {

                    setTimeout( function() {                                        

                        if( prev == 1 ) 
                        {                        
                            $('.premium-posts-container').prepend( response );
                            newPage = page - 1;
                        } else {
                            $('.premium-posts-container').append( response );
                        }

                        if( newPage == 1 ) {
                            that.slideUp(320);
                        } else {
                            that.data('page', newPage);
                            that.removeClass('loading').find('.text').slideDown(320);
                            that.find('.fa-spinner').removeClass('spin');                                    
                        }

                        revealPosts();

                    }, 1000 );

                }   
            }
        });

    });

    /* scroll functions */
    $(window).scroll( function() {

        var scroll = $(window).scrollTop();
        
        if( Math.abs( scroll - last_scroll ) > $(window).height()*0.1 ) {
            last_scroll = scroll;

            $('.page-limit').each(function( index ) {
                
                if ( isVisible( $(this) ) ) {
                    
                    history.replaceState( null, null, "/premium" + $(this).attr("data-page") );
                    return false;

                }

            });
        }

    });

    /* helper functions */
    function revealPosts(){

        var posts = $('article:not(.reveal)');
        var i = 0;        

        setInterval(function() {

            if( i >= posts.length ) return false;

            var el = posts[i];
            $(el).addClass('reveal').find('.premium-carousel-thumb').carousel();

            i++;

        }, 200);

    }

    function isVisible( element ) {

        var scroll_pos = $(window).scrollTop();
        var window_height = $(window).height();
        var el_top = $(element).offset().top;
        var el_height = $(element).height();
        var el_bottom = el_top + el_height;
        return ( ( el_bottom - el_height*0.25 > scroll_pos ) && (el_top < ( scroll_pos+0.5*window_height ) ) );

    }

});