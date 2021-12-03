jQuery(document).ready(function ($) {
    jQuery(window).scroll(function () {

        var footerSelector = '.site-footer';
        var socialBarSelector = '.nm-sidbar-table';

        var bottomViewPort = $(window).scrollTop() + $(window).height();
        var footerTop = $(footerSelector).offset().top;

        if (bottomViewPort >= footerTop) {
            $(socialBarSelector).fadeOut();
            //$('.nm-sidbar-table').css('position', 'inherit')
        } else {
            $(socialBarSelector).fadeIn();
        }
    });
});