/**
 * Hide mobile nav
 */
function hideMobile() {  
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

/**
 * Validate image type
 */
function validateImageType(image, gif = false) {
    var valid_images = ['image/jpeg', 'image/png', 'image/jpg'];
    if (gif) valid_images.push('image/gif');
    return valid_images.includes(image.type);
}

/**
 * Validate image size
 */
function validateImageSize(image, size = 1) {
    var max_size = size * 1024 * 1024; // 1 MB
    return image.size <= max_size;
}

/**
 * Alertify log
 * 
 * @param {string} type
 * @param {string} message
 * @param {function} callback
 */
function alertifyLog(type, message, callback = null) 
{
    $('body').css('overflow', 'hidden');
    alertify.alert(message, callback);
    $(document).find(".alertify .msg").addClass(`text-${type}`);
}

/**
 * Alertify error
 */
function alertError(message) {  
    alertify.delay(3000).error(message);
}

!(function($) {
    "use strict";
    
    moment.locale('id');

    $(".modal").on('shown.bs.modal', function () {
        $(this).find("input:visible:first").focus();
    });

    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover'
    }).on('click', function () {
        $(this).tooltip('hide');
    });
    
    $(window).scroll(function () {
        var scrollTop = $(window).scrollTop();

        (scrollTop > 20)
            ? $('.nav-top').addClass('nav-top-hide')
            : $('.nav-top').removeClass('nav-top-hide');
    });

    $(".mobile-nav-toggle").click(function () {
        $(".mobile-nav-toggle").toggleClass("active");
        $(".mobile-nav").toggleClass("active");
        $(".mobile-nav-overlay").toggleClass("active");
        $("body").toggleClass("mobile-nav-active");
    });

    $(".mobile-nav-overlay").click(function () {
        hideMobile();
    });

    $("#btn-search").on("click", function() {
        hideMobile();

        $("body").addClass("mobile-search-active");
        $(".mobile-search-overlay").addClass("active");
        $(".mobile-search").addClass("active");

        setTimeout(function() {
            $(".mobile-search-input").focus();
        }, 50);
    });

    $(".close-search").on("click", function() {
        hideMobileSearch();
    });

    $(window).resize(function () {
        if ($(window).width() > 991.98) hideMobile();
        if ($(window).width() > 768.98) hideMobileSearch();
    });

})(jQuery);