jQuery(document).ready( function($) {

    var carousel = '.premium-carousel-thumb';

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



});