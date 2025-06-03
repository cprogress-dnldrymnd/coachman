jQuery(document).ready(function () {
    swiper_sliders();
    //fancybox();
    // mega_menu();
    // search_stock();
    listings();
    read_more();
});

function read_more() {
    jQuery('.read-more-button').click(function (e) {
        jQuery('.read-more-content').removeClass('d-none');
        jQuery(this).addClass('d-none');
        e.preventDefault();

    });
}

function listings() {
    if (jQuery('.nav-tabs-swiper-js').length > 0) {
        jQuery('.nav-tabs-swiper-js .nav-item:first-child .nav-link').click();
    }

    jQuery('.listings--posts > div').each(function (index, element) {
        $height = jQuery(this).outerHeight();
        jQuery(this).parent().css('--height', $height + 'px');

    });

    jQuery('.listings--inner--js').click(function (e) {
        jQuery('.listings--inner--js').removeClass('active');
        jQuery('.listings--posts').removeClass('active');
        jQuery(this).toggle('active');
        $target = jQuery(this).attr('listing-target');
        jQuery($target).toggle('active');
        e.preventDefault();

    });
}
function search_stock() {
    jQuery('.edit-stock-filter').click(function (e) {
        jQuery(this).parents('.search-stock-mobile').toggleClass('filter--active');
        e.preventDefault();

    });
}
function mega_menu() {
    $height = jQuery('#masthead').outerHeight();
    $admin_bar = jQuery('#wpadminbar').outerHeight();
    jQuery('body').css('--header-height', $height + 'px');
    if (jQuery('#wpadminbar').length > 0) {
        jQuery('body').css('--admin-bar-height', $admin_bar + 'px');

    }
    jQuery('.has-custom-submenu').hover(function () {
        jQuery('body').addClass('mega-menu-active');
    }, function () {
        jQuery('body').removeClass('mega-menu-active');
    });
}

function fancybox() {
    Fancybox.bind("[data-fancybox]", {
        // Your custom options
    });

    jQuery('.zoom').click(function (e) {
        jQuery(this).next().find('.swiper-slide-active a').addClass('sdsdss');
        jQuery(this).next().find('.swiper-slide-active a').trigger('click');
        console.log('mama mo');
        e.preventDefault();
    });
}

function swiper_sliders() {
    var swiper_on_mobile = new Swiper('.swiper-nav-tabs-swiper', {
        slidesPerView: 'auto',
        spaceBetween: 20,
        freeMode: true,
    });
    var swiper_slider_block = new Swiper(".swiper-slider-block", {
        breakpoints: {
            slidesPerView: 1,
            spaceBetween: 40,
        },
        pagination: {
            el: ".swiper-pagination",
        },
    });
    var swiper_listing_taxonomy = new Swiper(".swiper-listings-taxonomy", {
        slidesPerView: 'auto',
        spaceBetween: 40,

    });



}