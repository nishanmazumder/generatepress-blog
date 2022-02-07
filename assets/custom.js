jQuery(document).ready(function ($) {
    jQuery(window).scroll(function () {

        var footerSelector = '.site-footer';
        var sideBar = '.nm-sidbar-table';

        var scrollView = $(window).scrollTop() + $(window).height();
        var footerOffset = $(footerSelector).offset().top;

        if (scrollView >= footerOffset) {
            $(sideBar).fadeOut();
        } else {
            $(sideBar).fadeIn();
        }
    });
});