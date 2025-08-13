<?php

function template($atts)
{
    extract(
        shortcode_atts(
            array(
                'template_id' => '',
            ),
            $atts
        )
    );

    $style = '<style type="text/css" data-type="vc_shortcodes-custom-css"> ' . get_post_meta($template_id, '_wpb_shortcodes_custom_css', true) . ' </style>';

    $content_post = get_post($template_id);
    $content = $content_post->post_content;
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);

    return $style . $content;
}

add_shortcode('template', 'template');

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


function dealer_locator()
{
    ob_start();
    get_template_part('template-parts/shortcodes/dealer-locator');
    return ob_get_clean();
}

add_shortcode('dealer_locator', 'dealer_locator');


function modal($atts)
{
    ob_start();
    extract(
        shortcode_atts(
            array(
                'id'    => ''
            ),
            $atts
        )
    );
?>
    <div class="offcanvas offcanvas--technical-details offcanvas-end" tabindex="-1" id="offCanvas<?= $id ?>" aria-labelledby="offCanvas<?= $id ?>Label">
        <div class="offcanvas-body p-0 overflow-hidden">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"></path>
                </svg>
            </button>
            <div class="offcanvas-body--inner background-white rounded overflow-hidden p-3 p-lg-5 d-flex h-100 flex-column justify-content-between gap-3">
                <?= do_shortcode('[template template_id=25605]') ?>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
}

add_shortcode('modal', 'modal');
