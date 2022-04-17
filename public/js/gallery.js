;(function($, undefined) {

    $(document).ready(function() {
        const widthScreen = window.screen.width;
        var prev = '';
        var next = '';
        if (widthScreen > 900) {
            prev = '<div class="arrow-prev"><i class="i fas fa-arrow-left"></i></div>';
            next = '<div class="arrow-next"><i class="i fas fa-arrow-right"></i></div>';
        }
        $('.slider').slick({
            dots: false,
            prevArrow: prev,
            nextArrow: next,
            infinite: true,
            slidesToShow: 1
            // slidesToScroll: 2
        });
    });

})(jQuery);