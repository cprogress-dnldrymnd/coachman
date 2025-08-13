<?php

function latest_deals()
{
    ob_start();
    get_template_part('template-parts/shortcodes/latest-deals');
    return ob_get_clean();
}

add_shortcode('latest_deals', 'latest_deals');


function listing_grid($atts)
{
    ob_start();
    extract(
        shortcode_atts(
            array(
                'style' => 'style-1',
                'image_id' => 47
            ),
            $atts
        )
    );
    $args['style'] = $style;
    $args['image_id'] = $image_id;
    get_template_part('template-parts/shortcodes/listing-grid', NULL, $args);
    return ob_get_clean();
}

add_shortcode('listing_grid', 'listing_grid');


function listing_grid_full_details($atts)
{
    ob_start();
    extract(
        shortcode_atts(
            array(
                'style' => 'style-1',
                'id'    => 'id'
            ),
            $atts
        )
    );
    $args['style'] = $style;
    $args['id'] = $id;
    get_template_part('template-parts/shortcodes/listing-grid-full-details', NULL, $args);
    return ob_get_clean();
}

add_shortcode('listing_grid_full_details', 'listing_grid_full_details');


function dealer_locator() {
    ob_start();
    get_template_part('template-parts/shortcodes/dealer-locator');
    return ob_get_clean();
}

add_shortcode('dealer_locator', 'dealer_locator');