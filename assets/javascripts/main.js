jQuery(document).ready(function () {
    swiper_sliders();
    //fancybox();
    mega_menu();
    // search_stock();
    listings();
    read_more();
    accordion();
    updateScrollStatus();
    dealer();
    ajax_details();
});


function dealer() {
    jQuery('body').on('click', '.btn-appointment a', function () {
        $originalText = jQuery('.request--appointment--dealer h5').text();
        $dealerName = jQuery(this).parents('.store--listing').find('h4').text();
        $new_text = $originalText.replace('[dealer_name]', $dealerName);

        jQuery('.request--appointment--dealer h5').text($new_text);

    });
}

function ajax_details() {
    const bsOffcanvas = new bootstrap.Offcanvas('#offCanvas25765');
    jQuery('body').on('click', '.btn-stock a', function () {
        var $this = jQuery(this);
        var post_id = $this.parents('.store--listing').attr('data-store-id');
        $this.addClass('loading');
        console.log(post_id);
        jQuery.ajax({
            url: ajax_params.ajax_url,
            type: 'POST',
            data: {
                action: 'dealer_details_ajax',
                post_id: post_id,
            },
            success: function (response) {
                jQuery('#listing--details--results').html(response);
                bsOffcanvas.show();
                $this.removeClass('loading');

            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    });

    const myOffcanvas = document.getElementById('offCanvas25765')

    myOffcanvas.addEventListener('hidden.bs.offcanvas', event => {
        jQuery('#listing--details--results').html('');
    })
}

function updateScrollStatus() {
    if (jQuery(window).scrollTop() === 0) {
        jQuery('body').removeClass('sticky--header');
    } else {
        jQuery('body').addClass('sticky--header');
    }
}

// Attach the updateScrollStatus function to the window's scroll event
jQuery(window).on('scroll', function () {
    updateScrollStatus();
});

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
        jQuery('.listings--inner--js').not(this).removeClass('active');
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


    jQuery('.no--submenu .nav-link').each(function (index, element) {
        jQuery(this).removeAttr('data-bs-toggle');
        jQuery(this).removeAttr('data-bs-target');
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