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

    $listing_template = '<li xxx data-store-id="<%= id %>">' . "\r\n";
    $listing_template .= "\t\t" . '<div>' . "\r\n";
    $listing_template .= "\t\t\t" . '<p><%= thumb %>' . "\r\n";
    $listing_template .= "\t\t\t\t" . wpsl_store_header_template('listing') . "\r\n";
    $listing_template .= "\t\t\t\t" . '<span class="wpsl-street"><%= address %></span>' . "\r\n";
    $listing_template .= "\t\t\t\t" . '<% if ( address2 ) { %>' . "\r\n";
    $listing_template .= "\t\t\t\t" . '<span class="wpsl-street"><%= address2 %></span>' . "\r\n";
    $listing_template .= "\t\t\t\t" . '<% } %>' . "\r\n";
    $listing_template .= "\t\t\t\t" . '<span>' . wpsl_address_format_placeholders() . '</span>' . "\r\n";
    $listing_template .= "\t\t\t\t" . '<span class="wpsl-country"><%= country %></span>' . "\r\n";
    $listing_template .= "\t\t\t" . '</p>' . "\r\n";

    // Check if the 'appointment_url' contains data before including it.
    $listing_template .= "\t\t\t" . '<% if ( appointment_url ) { %>' . "\r\n";
    $listing_template .= "\t\t\t" . '<p><a href="<%= appointment_url %>">' . __('Make an Appointment', 'wpsl') . '</a></p>' . "\r\n";
    $listing_template .= "\t\t\t" . '<% } %>' . "\r\n";

    $listing_template .= "\t\t" . '</div>' . "\r\n";

    // Check if we need to show the distance.
    if (!$wpsl_settings['hide_distance']) {
        $listing_template .= "\t\t" . '<%= distance %> ' . esc_html($wpsl_settings['distance_unit']) . '' . "\r\n";
    }

    $listing_template .= "\t\t" . '<%= createDirectionUrl() %>' . "\r\n";
    $listing_template .= "\t" . '</li>' . "\r\n";

    return $listing_template;
}
