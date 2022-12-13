(function ($) {
    'use strict';

    var aplandWindow = $(window);

    // -----------------------------
    // :: 1.0 Preloader Active Code
    // -----------------------------
    aplandWindow.on('load', function () {
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });

    // -----------------------------
    // :: 2.0 Nav Active Code
    // -----------------------------
    if ($.fn.classyNav) {
        $('#aplandNav').classyNav();
    }

    if ($.fn.owlCarousel) {
        // ----------------------------------
        // :: 2.0 Welcome Slider Active Code
        // ----------------------------------
        var wel_slides = $('.hero-slides');
        wel_slides.owlCarousel({
            items: 1,
            loop: true,
            nav: true,
            navText: ['<i class="icofont-simple-left"></i>', '<i class="icofont-simple-right"></i>'],
            dots: false,
            dotsSpeed: 1000,
            autoplay: true,
            smartSpeed: 1000,
            autoplayHoverPause: false
        });

        wel_slides.on('translate.owl.carousel', function () {
            var layer = $("[data-animation]");
            layer.each(function () {
                var anim_name = $(this).data('animation');
                $(this).removeClass('animated ' + anim_name).css('opacity', '0');
            });
        });

        $("[data-delay]").each(function () {
            var anim_del = $(this).data('delay');
            $(this).css('animation-delay', anim_del);
        });

        $("[data-duration]").each(function () {
            var anim_dur = $(this).data('duration');
            $(this).css('animation-duration', anim_dur);
        });

        wel_slides.on('translated.owl.carousel', function () {
            var layer = wel_slides.find('.owl-item.active').find("[data-animation]");
            layer.each(function () {
                var anim_name = $(this).data('animation');
                $(this).addClass('animated ' + anim_name).css('opacity', '1');
            });
        });

        // ---------------------------------
        // :: 3.0 Testimonials Active Code
        // ---------------------------------
        $(".testimonials").owlCarousel({
            items: 1,
            margin: 0,
            loop: true,
            nav: false,
            dots: true,
            autoplay: true,
            smartSpeed: 800
        });

        // ------------------------------------
        // :: 4.0 App Screenshots Active Code
        // ------------------------------------
        $(".app_screenshots").owlCarousel({
            items: 5,
            margin: 0,
            loop: true,
            nav: false,
            center: true,
            dots: false,
            center: true,
            autoplay: true,
            autoplayTimeout: 3000,
            smartSpeed: 800,
            responsive: {
                0: {
                    items: 2
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                },
                1200: {
                    items: 5
                }
            }
        });
    }

    // -------------------------------
    // :: 5.0 ScrollDown Active Code
    // -------------------------------

    var downloadbtn = $("#downloadAppbtn");
    var contactbtn = $("#contactbtn");

    downloadbtn.click(function () {
        $('html, body').animate({
            scrollTop: $("#download").offset().top
        }, 1500);
    });
    contactbtn.click(function () {
        $('html, body').animate({
            scrollTop: $("#contact").offset().top
        }, 1500);
    });

    // --------------------------------
    // :: 6.0 Onepage Nav Active Code
    // --------------------------------
    if ($.fn.onePageNav) {
        $('#corenav').onePageNav({
            currentClass: 'active',
            easing: 'easeInOutQuart',
            scrollSpeed: 1440
        });
    }

    // -------------------------------
    // :: 7.0 niceScroll Active Code
    // -------------------------------
    if ($.fn.niceScroll) {
        $("textarea").niceScroll({
            cursorcolor: "#1a1a1a",
            cursorwidth: "5px",
            background: "transparent",
            cursorborder: "none",
            cursorborderradius: 0,
            zindex: "5000"
        });
    }

    // --------------------------
    // :: 8.0 Video Active Code
    // --------------------------
    if ($.fn.magnificPopup) {
        $('.video_btn').magnificPopup({
            type: 'iframe'
        });
    }

    // ----------------------------
    // :: 9.0 ScrollUp Active Code
    // ----------------------------
    if ($.fn.scrollUp) {
        $.scrollUp({
            scrollSpeed: 1500,
            easingType: 'easeInOutQuart',
            scrollText: ['<i class="icofont-rounded-up"></i>'],
            scrollImg: false
        });
    }

    // -----------------------------
    // :: 10.0 Tooltip Active Code
    // -----------------------------
    if ($.fn.tooltip) {
        $('[data-toggle="tooltip"]').tooltip()
    }

    // -------------------------------
    // :: 11.0 Counterup Active Code
    // -------------------------------
    if ($.fn.counterUp) {
        $('.counter').counterUp({
            delay: 10,
            time: 1500
        });
    }

    // -----------------------------
    // :: 12.0 Sticky Active Code
    // -----------------------------
    if ($.fn.sticky) {
        $(".main_header_area").sticky({
            topSpacing: 0
        });
    }

    // -------------------------
    // :: 13.0 wow Active Code
    // -------------------------
    if (aplandWindow.width() > 767) {
        new WOW().init();
    }

    // -----------------------------
    // :: 14.0 Jarallax Active Code
    // -----------------------------
    if ($.fn.jarallax) {
        $('.jarallax').jarallax({
            speed: 0.2
        });
    }

    // -------------------------------
    // :: 15.0 PreventDefault a Click
    // -------------------------------
    $("a[href='#']").on('click', function ($) {
        $.preventDefault();
    });

    // :: 16.0 Countdown Active Code
    $('#clock').countdown('2021/11/10', function (event) {
        $(this).html(event.strftime('<div>%D <span>Days</span></div> <div>%H <span>Hours</span></div> <div>%M <span>Minutes</span></div> <div>%S <span>Seconds</span></div>'));
    });

})(jQuery);