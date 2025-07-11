jQuery(document).ready(function () {
    swiper_sliders();
    //fancybox();
    mega_menu();
    // search_stock();
    listings();
    read_more();
    accordion();
    updateScrollStatus();
});

function isScrollOnTop() {
    return jQuery(window).scrollTop() === 0;
}

function updateScrollStatus() {
    if (isScrollOnTop()) {
        // If at the top, update text and apply 'success' styling
        console.log('You are at the top!');
    } else {
        // If not at the top, update text and apply 'warning' styling
        console.log('You are at the top!');
    }
}

// Attach the updateScrollStatus function to the window's scroll event
jQuery(window).on('scroll', function () {
    updateScrollStatus();
});

// Call it once on load to set the initial status
updateScrollStatus();
function accordion() {
    if (jQuery('.accordion--custom').length > 0) {
        jQuery('.accordion--item').each(function (index, element) {
            var $this = jQuery(this);
            $accordion_button = $this.find('.accordion--button');
            $accordion_content = $this.find('.accordion--content');
            jQuery('<span class="plus-minus"></span>').appendTo($accordion_button);

            $accordion_button_height = $accordion_button.outerHeight();
            $accordion_content_height = $accordion_content.outerHeight();

            $this.css('--accordion_button_height', $accordion_button_height + 'px');
            $this.css('--accordion_content_height', $accordion_content_height + 'px');
            $this.addClass('initialized');
            $accordion_button.click(function (e) {
                $this.addClass('clicked');
                $this.parents('.accordion--custom').find('.accordion--item:not(.clicked)').removeClass('active');
                $this.toggleClass('active');
                $this.removeClass('clicked');
                e.preventDefault();
            });
        });
    }
}
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

    /*
    jQuery('.listings--posts > div').each(function (index, element) {
        $height = jQuery(this).outerHeight();
        jQuery(this).parent().css('--height', $height + 'px');

    });*/

    jQuery('.listings--inner--js').click(function (e) {
        jQuery('.listings--inner--js').removeClass('active');
        jQuery('.listings--posts').removeClass('active');
        jQuery(this).toggleClass('active');

        var $target = jQuery(this).attr('listing-target');
        jQuery($target).toggleClass('active');

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

    jQuery('.swiper-slider-holder').each(function (index, element) {
        $atts = jQuery(this).attr('swiper_atts');
        $atts = JSON.parse($atts);
        $id = '#' + jQuery(this).find('.swiper').attr('id');
        if (jQuery(this).hasClass('swiper-nav-style-2')) {
            jQuery(this).find('.swiper-button-prev').appendTo(jQuery(this).find('.swiper-pagination-navigation-style-2'));
            jQuery(this).find('.swiper-pagination').appendTo(jQuery(this).find('.swiper-pagination-navigation-style-2'));
            jQuery(this).find('.swiper-button-next').appendTo(jQuery(this).find('.swiper-pagination-navigation-style-2'));
        }
        var swiper_slider_block = new Swiper($id, $atts);
    });



    var swiper_listing_taxonomy = new Swiper(".swiper-listings-taxonomy", {
        slidesPerView: 'auto',
        spaceBetween: 40,

    });



}