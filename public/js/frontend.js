/**
 * Hide mobile nav
 */
function hideMobileMenu() {  
    $(".mobile-nav-toggle").removeClass("active");
    $(".mobile-nav").removeClass("active");
    $(".mobile-nav-overlay").removeClass("active");
    $("body").removeClass("mobile-nav-active");
}

/**
 * Hide mobile search
 */
function hideMobileSearch() {  
    $(".mobile-search").removeClass("active");
    $(".mobile-search-overlay").removeClass("active");
    $("body").removeClass("mobile-search-active");
}

!(function($) 
{
    "use strict";

    var scrollNavStorage = localStorage.getItem('on-scroll-nav') || 0;
    var scrollOnTop = $(window).scrollTop();

    $(window).scroll(function () {
        var scrollTop = $(window).scrollTop();
        scrollNavStorage = localStorage.setItem('on-scroll-nav', scrollTop);

        (scrollTop > 20)
            ? $('.nav-top').addClass('nav-top-hide')
            : $('.nav-top').removeClass('nav-top-hide');
    });

    if (scrollNavStorage > 20) $('.nav-top').addClass('nav-top-hide');
    if (scrollOnTop === 0) $('.nav-top').removeClass('nav-top-hide');

    $(".mobile-nav-toggle").click(function () {
        $(".mobile-nav-toggle").toggleClass("active");
        $(".mobile-nav").toggleClass("active");
        $(".mobile-nav-overlay").toggleClass("active");
        $("body").toggleClass("mobile-nav-active");
    });

    $(".mobile-nav-overlay, .btn-buat-diskusi, .close-mobile-nav").click(function () {
        hideMobileMenu();
    });

    $("#btn-search").on("click", function() {
        hideMobileMenu();

        $("body").addClass("mobile-search-active");
        $(".mobile-search-overlay").addClass("active");
        $(".mobile-search").addClass("active");

        setTimeout(function() {
            var val = $(".mobile-search-input").val();
            $(".mobile-search-input").val("");
            $(".mobile-search-input").focus();
            $(".mobile-search-input").val(val);
        }, 50);
    });

    $(".close-search").on("click", function() {
        hideMobileSearch();
    });

    $(window).resize(function () {
        if ($(window).width() > 991.98) hideMobileMenu();
        if ($(window).width() > 768.98) hideMobileSearch();
    });

})(jQuery);