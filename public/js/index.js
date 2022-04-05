;(function($, undefined) {

    $(document).scroll(function() {
        if ($(document).width() < 1024) {
            return false;
        }
        
        if ($(document).scrollTop() > $('.full-page').height() / 2) {
            $('.header').addClass('fixed');
        } else {
            $('.header').removeClass('fixed');
        }
    });

    $('.up-btn').on('click', function() {
        $('html, body').animate({
            scrollTop: 0
        }, 'slow');
    });

    $('.show-menu').on('click',  function() {
        $('.hidden-menu').animate({
            "right": 0
        }, 500);
    });

    $('.hidden-menu > .close').on('click', function() {
        $('.hidden-menu').animate({
            "right": "-300px"
        }, 200);
    });

    $(document).ready(function() {
        $('.slider').slick({
            dots: false,
            prevArrow: '<div class="arrow-prev"><i class="i fas fa-arrow-left"></i></div>',
            nextArrow: '<div class="arrow-next"><i class="i fas fa-arrow-right"></i></div>',
            infinite: true,
            slidesToShow: 3
            // slidesToScroll: 2
        });
    });

})(jQuery);