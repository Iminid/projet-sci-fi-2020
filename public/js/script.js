$(function () {
    'use strict';
    // --------------------------------------------------------------------
    // PreLoader
    // --------------------------------------------------------------------
    (function () {
        $('#preloader').delay(200).fadeOut('slow');
    }());
    // --------------------------------------------------------------------
    // One Page Navigation
    // --------------------------------------------------------------------
    (function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() >= 50) {
                $('nav.navbar').addClass('sticky-nav');
            }
            else {
                $('nav.navbar').removeClass('sticky-nav');
            }
        });
    }());
    // --------------------------------------------------------------------
    // jQuery for page scrolling feature - requires jQuery Easing plugin
    // --------------------------------------------------------------------
    (function () {
        $('a.page-scroll').on('click', function (e) {
            e.preventDefault();
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top
            }, 1500, 'easeInOutExpo');
        });
    }());
    // -------------------------------------------------------------
    // mobile menu
    // -------------------------------------------------------------
    (function () {
        $('button.navbar-toggle').ucOffCanvasMenu({
            documentWrapper: '#main-wrapper'
            , contentWrapper: '.content-wrapper'
            , position: 'uc-offcanvas-left', // class name
            // opener         : 'st-menu-open',            // class name
            effect: 'slide-along', // class name
            closeButton: '#uc-mobile-menu-close-btn'
            , menuWrapper: '.uc-mobile-menu', // class name below-pusher
            documentPusher: '.uc-mobile-menu-pusher'
        });
    }());
    // -------------------------------------------------------------
    // top scrolling
    // -------------------------------------------------------------
    (function () {
        var offset = 220;
        var duration = 500;
        jQuery(window).scroll(function () {
            if (jQuery(this).scrollTop() > offset) {
                jQuery('.crunchify-top').fadeIn(duration);
            }
            else {
                jQuery('.crunchify-top').fadeOut(duration);
            }
        });
        jQuery('.crunchify-top').click(function (event) {
            event.preventDefault();
            jQuery('html, body').animate({
                scrollTop: 0
            }, duration);
            return false;
        });
    }());
    // --------------------------------------------------------------------
    // Search
    // --------------------------------------------------------------------
    $("#search-button, #search-icon").click(function (e) {
        e.preventDefault();
        $("#search-button, #search-form").toggle();
    });
    // --------------------------------------------------------------------
    // Carousel slider for blog page
    // --------------------------------------------------------------------
    $("#feature-news-carousel").owlCarousel({
        loop: true
        , dots: false
        , items: 1
        , autoplay: true
        , singleItem: true
            // "singleItem:true" is a shortcut for:
            // items : 1,
            // itemsDesktop : false,
            // itemsDesktopSmall : false,
            // itemsTablet: false,
            // itemsMobile : false
    });
});
// JQuery end
$(document).on('click', '.m-menu .dropdown-menu', function (e) {
    e.stopPropagation()
})

/*SIGN UP FORM*/

$(document).ready(function () {
    $('.forgot-pass').click(function(event) {
      $(".pr-wrap").toggleClass("show-pass-reset");
    }); 
    
    $('.pass-reset-submit').click(function(event) {
      $(".pr-wrap").removeClass("show-pass-reset");
    }); 
});

/*ADMIN SUGN UP*/
/*$(document).ready(function(){
    //Handles menu drop down
    $('.dropdown-menu').find('form').click(function (e) {
        e.stopPropagation();
    });
});*/

/*Formulaires*/
$('#add-person, #add-editor').click(function(){
    const index = +$('#widget-count').val();
    const tmpl = $('#film_persons, #serie_persons, #book_editors').data('prototype').replace(/__name__/g, index);
    $('#film_persons, #serie_persons, #book_editors').append(tmpl);
    $('#widget-count').val(index +1);
    DeleteButtons();
});

$('#add-autor, #add-writer').click(function(){
    const index = +$('#widget-count').val();
    const tmpl = $('#film_autors, #serie_autors, #book_writers').data('prototype').replace(/__name__/g, index);
    $('#film_autors, #serie_autors, #book_writers').append(tmpl);
    $('#widget-count').val(index +1);
    DeleteButtons();
});

$('#add-actor').click(function(){
    const index = +$('#widget-count').val();
    const tmpl = $('#film_actors, #serie_actors').data('prototype').replace(/__name__/g, index);
    $('#film_actors, #serie_actors').append(tmpl);
    $('#widget-count').val(index +1);
    DeleteButtons();
});

$('#add-country').click(function(){
    const index = +$('#widget-count').val();
    const tmpl = $('#film_country, #serie_country').data('prototype').replace(/__name__/g, index);
    $('#film_country, #serie_country').append(tmpl);
    $('#widget-count').val(index +1);
    DeleteButtons();
});

$('#add-year').click(function(){
    const index = +$('#widget-count').val();
    const tmpl = $('#film_years, #serie_years, #book_years').data('prototype').replace(/__name__/g, index);
    $('#film_years, #serie_years, #book_years').append(tmpl);
    $('#widget-count').val(index +1);
    DeleteButtons();
});

function DeleteButtons(){
    $('button[data-action="delete"]').click(function(){
        const target = this.dataset.target;
        $(target).remove();
    });
}
function countUpdate(){
    const count = +$('#film_persons div.form-group, #serie_persons div.form-groupe, #book_editors div.form-group, #book_writers div.form-group').length;
    $('#widget-count').val(count);
}
countUpdate();
DeleteButtons();


