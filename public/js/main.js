/*Theme Scripts */

(function($){ "use strict";
             
    $(window).on('load', function() {
        $('body').addClass('loaded');
    });
             
/*=========================================================================
	Header
=========================================================================*/
    var primaryHeader = $('.primary-header'),
        headerClone = primaryHeader.clone();
    $('.header').after('<div class="sticky-header"></div>');
    $('.sticky-header').html(headerClone);
    var headerSelector = document.querySelector(".sticky-header");
    var headroom = new Headroom(headerSelector, {
        offset: 100
    });

    headroom.init();

    if ($('.primary-header').length) {
        $('.header .primary-header .burger-menu').on("click", function () {
            $(this).toggleClass('menu-open');
            $('.header .header-menu-wrap').slideToggle(300);
        });
        $('.sticky-header .primary-header .burger-menu').on("click", function () {
            $(this).toggleClass('menu-open');
            $('.sticky-header .header-menu-wrap').slideToggle(300);
        });
    }

    $('.header-menu-wrap ul li:has(ul)').each(function () {
        $(this).append('<span class="dropdown-plus"></span>');
        $(this).addClass('dropdown_menu');
    });

    $('.header-menu-wrap .dropdown-plus').on("click", function () {
        $(this).prev('ul').slideToggle(300);
        $(this).toggleClass('dropdown-open');
    });
    $('.header-menu-wrap .dropdown_menu a').append('<span></span>');

    // Responsive Classes
    function responsiveClasses() {
        var body = $('body');
        if ($(window).width() < 992) {
            body.removeClass('viewport-lg');
            body.addClass('viewport-sm');
        } else {
            body.removeClass('viewport-sm');
            body.addClass('viewport-lg');
        }
    }

    // Transparent Header
    function transparentHeader(){
        var header = $('.header.header-three'),
            headerHeight = header.height(),
            pageHeader = $('.page-header');
            pageHeader.css('padding-top', headerHeight + 'px');
    }

    //responsiveClasses();
    $(window).on("resize", function () {
        responsiveClasses();
        transparentHeader();
    }).resize();

    // Odometer JS
    $('.odometer').waypoint(
        function() {
            var odo = $(".odometer");
            odo.each(function() {
                var countNumber = $(this).attr("data-count");
                $(this).html(countNumber);
            });
        },
        {
            offset: "80%",
            triggerOnce: true
        }
    );

/*=========================================================================
	Main Slider
=========================================================================*/ 
    $(document).ready(function () {

        $('#main-slider').on('init', function(e, slick) {
            var $firstAnimatingElements = $('div.single-slide:first-child').find('[data-animation]');
            doAnimations($firstAnimatingElements);    
        });
        $('#main-slider').on('beforeChange', function(e, slick, currentSlide, nextSlide) {
                  var $animatingElements = $('div.single-slide[data-slick-index="' + nextSlide + '"]').find('[data-animation]');
                  doAnimations($animatingElements);    
        });
        $('#main-slider').slick({
           autoplay: true,
           autoplaySpeed: 10000,
           dots: true,
           fade: true,
           prevArrow: '<div class="slick-prev"><i class="fa fa-chevron-left"></i></div>',
                nextArrow: '<div class="slick-next"><i class="fa fa-chevron-right"></i></div>'
        });
        function doAnimations(elements) {
            var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
            elements.each(function() {
                var $this = $(this);
                var $animationDelay = $this.data('delay');
                var $animationType = 'animated ' + $this.data('animation');
                $this.css({
                    'animation-delay': $animationDelay,
                    '-webkit-animation-delay': $animationDelay
                });
                $this.addClass($animationType).one(animationEndEvents, function() {
                    $this.removeClass($animationType);
                });
            });
        }
    });
             
/*=========================================================================
    Service Carousel
=========================================================================*/
    $('#service-carousel').owlCarousel({
        loop: true,
        margin: 0,
        autoplay: false,
        smartSpeed: 800,
        nav: true,
        navText: ['<i class="fa fa-caret-left"></i>', '<i class="fa fa-caret-right"></i>'],
        dots: false,
        responsive : {
            0 : {
                items: 1
            },
            480 : {
                items: 1,
            },
            768 : {
                items: 2,
            },
            992 : {
                items: 4,
            }
        }
    });

/*=========================================================================
    Projects Carousel
=========================================================================*/
    $('#projects-carousel').owlCarousel({
        loop: true,
        margin: 0,
        autoplay: false,
        smartSpeed: 500,
        nav: true,
        navText: ['<i class="fa fa-caret-left"></i>', '<i class="fa fa-caret-right"></i>'],
        dots: false,
        responsive : {
            0 : {
                items: 1
            },
            580 : {
                items: 2,
            },
            768 : {
                items: 2,
            },
            992 : {
                items: 4,
            }
        }
    });

/*=========================================================================
    Project Single Carousel
=========================================================================*/
    $('#project-single-carousel').owlCarousel({
        loop: true,
        margin: 5,
        autoplay: true,
        smartSpeed: 500,
        nav: false,
        navText: ['<i class="fa fa-caret-left"></i>', '<i class="fa fa-caret-right"></i>'],
        dots: true,
        responsive : {
            0 : {
                items: 1
            },
            480 : {
                items: 1,
            },
            768 : {
                items: 1,
            },
            992 : {
                items: 1,
            }
        }
    }); 

/*=========================================================================
    Testimonial Carousel
=========================================================================*/
    $('#testimonial-carousel').owlCarousel({
        loop: true,
        margin: 10,
        center: false,
        autoplay: true,
        smartSpeed: 500,
        nav: false,
        navText: ['<i class="fa fa-caret-left"></i>', '<i class="fa fa-caret-right"></i>'],
        dots: true,
        responsive : {
            0 : {
                items: 1
            },
            480 : {
                items: 1,
            },
            768 : {
                items: 1,
            },
            992 : {
                items: 2,
            }
        }
    });

/*=========================================================================
    Sponsor Carousel
=========================================================================*/
    $('#sponsor-carousel').owlCarousel({
        loop: true,
        margin: 5,
        center: false,
        autoplay: true,
        smartSpeed: 500,
        nav: false,
        navText: ['<i class="fa fa-caret-left"></i>', '<i class="fa fa-caret-right"></i>'],
        dots: false,
        responsive : {
            0 : {
                items: 2
            },
            480 : {
                items: 3,
            },
            768 : {
                items: 3,
            },
            992 : {
                items: 6,
            }
        }
    });
             
/*=========================================================================
	Initialize smoothscroll plugin
=========================================================================*/
	smoothScroll.init({
		offset: 60
	});
	 
/*=========================================================================
	Scroll To Top
=========================================================================*/ 
    $(window).on( 'scroll', function () {
        if ($(this).scrollTop() > 100) {
            $('#scroll-to-top').fadeIn();
        } else {
            $('#scroll-to-top').fadeOut();
        }
    });

/*=========================================================================
	WOW Active
=========================================================================*/ 
   new WOW().init();

/*=========================================================================
    Active venobox
=========================================================================*/
    $('.img-popup').venobox({
        numeratio: true,
        infinigall: true
    });
             
/*=========================================================================
	MAILCHIMP
=========================================================================*/ 

    if ($('.subscribe_form').length>0) {
        /*  MAILCHIMP  */
        $('.subscribe_form').ajaxChimp({
            language: 'es',
            callback: mailchimpCallback,
            url: "//alexatheme.us14.list-manage.com/subscribe/post?u=48e55a88ece7641124b31a029&amp;id=361ec5b369" 
        });
    }

    function mailchimpCallback(resp) {
        if (resp.result === 'success') {
            $('#subscribe-result').addClass('subs-result');
            $('.subscription-success').text(resp.msg).fadeIn();
            $('.subscription-error').fadeOut();

        } else if(resp.result === 'error') {
            $('#subscribe-result').addClass('subs-result');
            $('.subscription-error').text(resp.msg).fadeIn();
        }
    }
    $.ajaxChimp.translations.es = {
        'submit': 'Submitting...',
        0: 'We have sent you a confirmation email',
        1: 'Please enter your email',
        2: 'An email address must contain a single @',
        3: 'The domain portion of the email address is invalid (the portion after the @: )',
        4: 'The username portion of the email address is invalid (the portion before the @: )',
        5: 'This email address looks fake or invalid. Please enter a real email address'
    };

/*=========================================================================
    Google Map Settings
=========================================================================*/
    if($("body").hasClass("contact-page")){
        google.maps.event.addDomListener(window, 'load', init);

        function init() {

            var mapOptions = {
                zoom: 11,
                center: new google.maps.LatLng(40.6700, -73.9400), 
                scrollwheel: false,
                navigationControl: false,
                mapTypeControl: false,
                scaleControl: false,
                draggable: false,
                styles: [{"featureType":"administrative","elementType":"all","stylers":[{"saturation":"-100"}]},{"featureType":"administrative.province","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","elementType":"all","stylers":[{"saturation":-100},{"lightness":"50"},{"visibility":"simplified"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":"-100"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"lightness":"30"}]},{"featureType":"road.local","elementType":"all","stylers":[{"lightness":"40"}]},{"featureType":"transit","elementType":"all","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]},{"featureType":"water","elementType":"labels","stylers":[{"lightness":-25},{"saturation":-100}]}]
            };

            var mapElement = document.getElementById('google-map');

            var map = new google.maps.Map(mapElement, mapOptions);

            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(40.6700, -73.9400),
                map: map,
                title: 'Location!'
            });
        }
    }
    

})(jQuery);


(function($) {
    'use strict'; // Start of use strict

    $(window).on("load scroll", function() {

        /*------------------------------------------------------------------
        Loader
        ------------------------------------------------------------------*/
        $("#loader").fadeOut("fast");
      
         /*----------------------------------------------------
          Start Change Menu Bg
         ----------------------------------------------------*/
        $(window).on('scroll', function() {
            if ($(window).scrollTop() > 200) {
                $('.header-top-area').addClass('menu-bg');
            } else {
                $('.header-top-area').removeClass('menu-bg');
            }
        });
       /*------------------------------------------------------------------
        Animation Numbers
        ------------------------------------------------------------------*/
        $('.animateNumber').each(function() {
            var num = $(this).attr('data-num');

            var top = $(document).scrollTop() + ($(window).height());
            var pos_top = $(this).offset().top;
            if (top > pos_top && !$(this).hasClass('active')) {
                $(this).addClass('active').animateNumber({
                    number: num
                }, 2000);
            }
        });
        $('.animateProcent').each(function() {
            var num = $(this).attr('data-num');
            var percent_number_step = jQuery.animateNumber.numberStepFactories.append('%');
            var top = $(document).scrollTop() + ($(window).height());
            var pos_top = $(this).offset().top;
            if (top > pos_top && !$(this).hasClass('active')) {
                $(this).addClass('active').animateNumber({
                    number: num,
                    numberStep: percent_number_step
                }, 2000);
                $(this).css('width', num + '%');
            }
        });
    });

    /*------------------------------------------------------------------
     Scroll Top
     ------------------------------------------------------------------*/
/*        if($('.scrollUp'){
        scrollText: '<i class="fa fa-chevron-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    }); */
    /*----------------------------------------------------
                  Portfolio Isotope
   ----------------------------------------------------*/
    var body_s = $('body'),
        window_s = $(window);

    //======= ISOTOP FILTERING JS  ========//
    window_s.on('load', function() {
        var grid_container = $('.portfolio-container'),
            grid_item = $('.work');


/*        grid_container.imagesLoaded(function() {
            grid_container.isotope({
                itemSelector: '.work',
                layoutMode: 'masonry'
            });
        });*/

        $('.portfolio-filter').find('li').on('click', function(e) {
            $('.portfolio-filter li.active').removeClass('active');
            $(this).addClass('active');
            var selector = $(this).attr('data-filter');
            grid_container.isotope({
                filter: selector
            });
            return false;
            e.preventDefault();
        });
    });


    /*------------------------------------------------------------------
        Accordian Box
        ------------------------------------------------------------------*/
    
    //Accordion Box
    if($('.accordion-box').length){
        $(".accordion-box").on('click', '.acc-btn', function() {
            var targetParent = $(this).parents('.accordion-box');
            var target = $(this).parents('.accordion');
            if($(this).hasClass('active')!==true){
            $(targetParent).find('.accordion .acc-btn').removeClass('active');
            }
            if ($(this).next('.acc-content').is(':visible')){
                return false;
            }else{
                $(this).addClass('active');
                $(targetParent).find('.accordion').removeClass('active-block');
                $(targetParent).find('.accordion .acc-content').slideUp(300);
                target.addClass('active-block');
                $(this).next('.acc-content').slideDown(300);
            }
        }); 
    }
            
        /*------------------------------------------------------------------
           Client slider
        ------------------------------------------------------------------*/
      var owl = $("#client-slider");

    owl.owlCarousel({

        itemsCustom: [
            [0, 2],
            [450, 3],
            [600, 3],
            [700, 4],
            [1000, 5],
            [1200, 5],
            [1400, 5],
            [1600, 5]
        ],
        pagination: false,
       autoPlay: 3000, //Set AutoPlay to 3 seconds

    });
     
     /*------------------------------------------------------------------
        Mobile Nav
        ------------------------------------------------------------------*/
     
/*     $('.navbar-nav').slicknav({
            prependTo:".mobile-nav",
        });*/
     
     /*------------------------------------------------------------------
         Service Tab
        ------------------------------------------------------------------*/
      
      $(".services").on("click", "li", function(){

        var myID = $(this).attr("id");

        $(this).addClass("active").siblings().removeClass("active");

        $(".services .item").hide();

        $("#" + myID + "-content").fadeIn();

    });
      
      /*------------------------------------------------------------------
          About tab
        ------------------------------------------------------------------*/
       
       if($('.tabs-box').length){
        $('.tabs-box .tab-buttons .tab-btn').on('click', function(e) {
            e.preventDefault();
            var target = $($(this).attr('data-tab'));
            
            if ($(target).is(':visible')){
                return false;
            }else{
                target.parents('.tabs-box').find('.tab-buttons').find('.tab-btn').removeClass('active-btn');
                $(this).addClass('active-btn');
                target.parents('.tabs-box').find('.tabs-content').find('.tab').fadeOut(0);
                target.parents('.tabs-box').find('.tabs-content').find('.tab').removeClass('active-tab');
                $(target).fadeIn(300);
                $(target).addClass('active-tab');
            }
        });
    }
    //======= MAGNIFIC POPUP ========//
/*    $('.work a').magnificPopup({
        type: 'inline'
    });*/
    /*------------------------------------------------------------------
    Navigation Hover effect
    ------------------------------------------------------------------*/
    // jQuery for page scrolling feature - requires jQuery Easing plugin

    $('.smoth-scroll').on('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });
    // Highlight the top nav as scrolling occurs

    $('body').scrollspy({
        target: '.navbar-default',
        offset: 70
    });
    // Closes the Responsive Menu on Menu Item Click

    $('.navbar-collapse ul li a:not(.dropdown-toggle)').on('click', function() {
        $('.navbar-toggle:visible').click();
    });

    /*------------------------------------------------------------------
     Scrollup opacity downarrow 
     ------------------------------------------------------------------*/
    var bottom_arrow = $('.bottom_row, .banner-content');
    $(window).on('scroll', function() {
        var st = $(this).scrollTop();
        bottom_arrow.css({
            'opacity': (1 - (st / 350))
        });
    });
    
    new WOW().init();
    

        /* ============= Percentage Slider ============= */

    if ($('#skills').length) {

        var skillsDiv = $('#skills');

        $(window).on('scroll', function() {
            var winT = $(window).scrollTop(),
                winH = $(window).height(),
                skillsT = skillsDiv.offset().top;
            if (winT + winH > skillsT) {
                $('.skillbar').each(function() {
                    $(this).find('.skillbar-bar').animate({
                        width: $(this).attr('data-percent')
                    }, 2000);
                });
            }
        });

    } 

})(jQuery);