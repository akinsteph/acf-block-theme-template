(function ($) {
    "use strict";

    let abttJs = {};

    abttJs.elements = {
        backToTop: $('#back-to-top-btn'),
    }

    abttJs.backToTopHandler = function () {
        $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('#back-to-top-btn').fadeIn();
            } else {
                $('#back-to-top-btn').fadeOut();
            }
        });

        $('#back-to-top-btn').click(function(){
            $('html, body').animate({scrollTop : 0},800);
            return false;
        });
    }

    abttJs.init = function () {

        if (abttJs.elements.backToTop.length) {
            abttJs.backToTopHandler();
        }
    }

    $(window).on('load', abttJs.init);
})(jQuery);
