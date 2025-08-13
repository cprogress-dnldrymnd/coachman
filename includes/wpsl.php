<?php
add_filter('wpsl_templates', 'custom_templates');

function custom_templates($templates)
{

    /**
     * The 'id' is for internal use and must be unique ( since 2.0 ).
     * The 'name' is used in the template dropdown on the settings page.
     * The 'path' points to the location of the custom template,
     * in this case the folder of your active theme.
     */
    $templates[] = array(
        'id'   => 'custom',
        'name' => 'Custom template',
        'path' => get_stylesheet_directory() . '/wpsl-templates/custom.php',
    );

    return $templates;
}

add_filter('wpsl_listing_template', 'custom_listing_template');

function custom_listing_template()
{

    global $wpsl_settings;

    $listing_template = '<li  data-store-id="<%= id %>">' . "\r\n";
    $listing_template .= "\t\t" . '<div>' . "\r\n";
    $listing_template .= "\t\t\t" . '<p><%= thumb %>' . "\r\n";
    $listing_template .= "\t\t\t\t" . '<h4>' . wpsl_store_header_template('listing') . '</h4>' . "\r\n";
    $listing_template .= "\t\t\t\t" . '<span class="wpsl-street"><%= address %></span>' . "\r\n";
    $listing_template .= "\t\t\t\t" . '<% if ( address2 ) { %>' . "\r\n";
    $listing_template .= "\t\t\t\t" . '<span class="wpsl-street"><%= address2 %></span>' . "\r\n";
    $listing_template .= "\t\t\t\t" . '<% } %>' . "\r\n";
    $listing_template .= "\t\t\t\t" . '<span>' . wpsl_address_format_placeholders() . '</span>' . "\r\n";
    $listing_template .= "\t\t\t\t" . '<span class="wpsl-country"><%= country %></span>' . "\r\n";
    $listing_template .= "\t\t\t" . '</p>' . "\r\n";


    $listing_template .= "\t\t" . '</div>' . "\r\n";

    // Check if we need to show the distance.
    if (!$wpsl_settings['hide_distance']) {
        $listing_template .= "\t\t" . '<div class="distance"><svg xmlns="http://www.w3.org/2000/svg" width="31.226" height="41.617" viewBox="0 0 31.226 41.617"> <path id="pin-coachman" d="M4,15.606A15.421,15.421,0,0,1,11.785,2.123,15.76,15.76,0,0,1,19.609,0a14.689,14.689,0,0,1,7.824,2.122,16.149,16.149,0,0,1,5.7,5.66,15,15,0,0,1,2.081,7.824,12.29,12.29,0,0,1-.874,4.162,34.891,34.891,0,0,1-2.206,4.786Q30.8,26.967,29.1,29.464t-3.329,4.661q-1.623,2.164-3.038,3.829t-2.247,2.705l-.874.957q-.333-.333-.874-1T16.53,38q-1.665-1.956-3.08-3.912t-3.288-4.578a39.468,39.468,0,0,1-3.08-4.994q-1.207-2.372-2.206-4.7A9.223,9.223,0,0,1,4,15.606Zm5.2,0a10.031,10.031,0,0,0,3.038,7.366,10.031,10.031,0,0,0,7.366,3.038,10.031,10.031,0,0,0,7.366-3.038,10.031,10.031,0,0,0,3.038-7.366,9.894,9.894,0,0,0-3.038-7.324A10.4,10.4,0,0,0,19.609,5.2a9.562,9.562,0,0,0-7.366,3.08A10.255,10.255,0,0,0,9.205,15.606Z" transform="translate(-3.989 0.001)" fill="currentColor"/> </svg> <%= distance %> ' . esc_html($wpsl_settings['distance_unit']) . '</div>' . "\r\n";
    }
    $listing_template .= "<div class='listing--buttons'>";
    $listing_template .= "<div class='btn btn-appointment'><a>Request Appointment</a></div>";
    $listing_template .= "\t\t" . '<div class="btn btn-direction"><%= createDirectionUrl() %></div>' . "\r\n";
    $listing_template .= "<div class='btn btn-stock'><a>View Stock</a></div>";
    $listing_template .= "</div>";

    $listing_template .= "\t" . '</li>' . "\r\n";

    return $listing_template;
}
