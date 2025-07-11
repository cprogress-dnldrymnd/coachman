<?php
/*-----------------------------------------------------------------------------------*/
/* Define the version so we can easily replace it throughout the theme
/*-----------------------------------------------------------------------------------*/
define('version', 1);
define('theme_dir', get_template_directory_uri() . '/');
define('assets_dir', theme_dir . 'assets/');
define('image_dir', assets_dir . 'images/');
define('vendor_dir', assets_dir . 'vendors/');

/*-----------------------------------------------------------------------------------*/
/* After Theme Setup
/*-----------------------------------------------------------------------------------*/

function action_after_setup_theme()
{
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'action_after_setup_theme');

function action_wp_enqueue_scripts()
{
    wp_enqueue_style('fancybox', vendor_dir . 'fancybox/css/fancybox.css');
    wp_enqueue_style('style', theme_dir . 'style.css');

    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap', vendor_dir . 'bootstrap/dist/js/bootstrap.min.js');
    wp_enqueue_script('swiper', vendor_dir . 'swiper/js/swiper-bundle.min.js');
    wp_enqueue_script('fancybox', vendor_dir . 'fancybox/js/fancybox.umd.js');
    wp_enqueue_script('main', assets_dir . 'javascripts/main.js');
}
add_action('wp_enqueue_scripts', 'action_wp_enqueue_scripts', 20);

/*-----------------------------------------------------------------------------------*/
/* Register Carbofields
/*-----------------------------------------------------------------------------------*/
add_action('carbon_fields_register_fields', 'tissue_paper_register_custom_fields');
function tissue_paper_register_custom_fields()
{
    require_once('includes/post-meta.php');
}
function get__post_meta($value)
{
    return get_post_meta(get_the_ID(), '_' . $value, true);
}

function get__term_meta($term_id, $value)
{
    return get_term_meta($term_id, '_' . $value, true);
}

function get__post_meta_by_id($id, $value)
{
    return get_post_meta($id, '_' . $value, true);
}
function get__theme_option($value)
{
    return get_option('_' . $value);
}

function arrayKeyStartsWith($array, $prefix)
{
    $matchingKeys = [];
    foreach ($array as $key => $value) {
        if (strpos($key, $prefix) === 0) {
            $matchingKeys[$key] = $value;
        }
    }
    return $matchingKeys;
}

require_once('includes/bootstrap-navwalker.php');
require_once('includes/customizer.php');
require_once('includes/menus.php');
require_once('includes/theme-widgets.php');
require_once('includes/post-types.php');
require_once('includes/shortcodes.php');
require_once('includes/custom-functions.php');
require_once('includes/listing-functions.php');
require_once('includes/hooks.php');


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

/**
 * WordPress CSV to Custom Post Type Importer
 *
 * This script reads a CSV file, creates new posts of the 'downloads' post type,
 * assigns 'downloads_category' taxonomy terms, uploads PDF files from URLs,
 * and sets the uploaded PDF's attachment ID as a post meta field '_file'.
 *
 * IMPORTANT: Always back up your WordPress database and files before running this script.
 *
 * To run this script:
 * 1. Place this code in your theme's functions.php file or a custom plugin.
 * 2. Update the $csv_file_path variable to your CSV file's actual location.
 * 3. Temporarily add an action hook to trigger the function (e.g., add_action('admin_init', 'import_downloads_from_csv');).
 * 4. Visit any page in your WordPress admin area to execute the import.
 * 5. REMOVE or COMMENT OUT the action hook after the import is complete.
 */

function import_downloads_from_csv() {
    // Check if the current user has capabilities to manage options (e.g., Administrator)
    // This prevents unauthorized execution of the import script.
    if ( ! current_user_can( 'manage_options' ) ) {
        error_log( 'CSV Import: User does not have sufficient permissions to run the import.' );
        return;
    }

    // Define the path to your CSV file.
    // IMPORTANT: Change this to the actual path of your CSV file on the server.
    // Example: ABSPATH . 'wp-content/uploads/downloads.csv'
    // Example: get_template_directory() . '/downloads.csv'
    $csv_file_path = '/path/to/your/downloads.csv'; // <<<--- UPDATE THIS PATH

    // Check if the CSV file exists
    if ( ! file_exists( $csv_file_path ) ) {
        error_log( 'CSV Import Error: CSV file not found at ' . $csv_file_path );
        echo '<div class="notice notice-error"><p>CSV Import Error: CSV file not found. Please check the path.</p></div>';
        return;
    }

    // Include WordPress necessary files for media handling
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    require_once( ABSPATH . 'wp-admin/includes/media.php' );
    require_once( ABSPATH . 'wp-admin/includes/image.php' );

    // Open the CSV file for reading
    $handle = fopen( $csv_file_path, 'r' );

    if ( $handle === FALSE ) {
        error_log( 'CSV Import Error: Could not open CSV file for reading.' );
        echo '<div class="notice notice-error"><p>CSV Import Error: Could not open CSV file.</p></div>';
        return;
    }

    // Initialize a counter for imported posts
    $imported_count = 0;
    $skipped_count = 0;
    $row_number = 0;

    // Loop through each row in the CSV file
    while ( ( $data = fgetcsv( $handle, 1000, ',' ) ) !== FALSE ) {
        $row_number++;

        // Skip the header row if your CSV has one (assuming first row is header)
        if ( $row_number === 1 ) {
            continue;
        }

        // Ensure we have at least 3 columns (Title, Category, PDF Link)
        if ( count( $data ) < 3 ) {
            error_log( "CSV Import Warning: Skipping row $row_number due to insufficient columns. Data: " . implode( ',', $data ) );
            $skipped_count++;
            continue;
        }

        // Extract data from CSV columns
        $post_title     = sanitize_text_field( $data[0] ); // First column: Post Title
        $taxonomy_terms = sanitize_text_field( $data[1] ); // Second column: Taxonomy Terms (comma-separated)
        $pdf_url        = esc_url_raw( $data[2] );         // Third column: PDF Link

        // --- 1. Validate extracted data ---
        if ( empty( $post_title ) ) {
            error_log( "CSV Import Warning: Skipping row $row_number due to empty post title. Data: " . implode( ',', $data ) );
            $skipped_count++;
            continue;
        }

        // Check if a post with this title already exists to prevent duplicates
        $existing_post = get_page_by_title( $post_title, OBJECT, 'downloads' );
        if ( $existing_post ) {
            error_log( "CSV Import Warning: Skipping row $row_number. Post with title '{$post_title}' already exists (ID: {$existing_post->ID})." );
            $skipped_count++;
            continue;
        }

        // --- 2. Upload PDF file ---
        $pdf_attachment_id = 0;
        if ( ! empty( $pdf_url ) ) {
            // Set a temporary filename for the downloaded file
            $filename = basename( parse_url( $pdf_url, PHP_URL_PATH ) );
            if ( empty( $filename ) || ! preg_match( '/\.pdf$/i', $filename ) ) {
                $filename = sanitize_title( $post_title ) . '.pdf';
            }

            // Prepare the file array for media_handle_sideload
            $file_array = array(
                'name'     => $filename,
                'tmp_name' => download_url( $pdf_url ) // Download the file to a temporary location
            );

            // Check for download errors
            if ( is_wp_error( $file_array['tmp_name'] ) ) {
                error_log( "CSV Import Error: Failed to download PDF from URL '{$pdf_url}' for post '{$post_title}'. Error: " . $file_array['tmp_name']->get_error_message() );
                // Continue without PDF, but create the post
                $file_array['tmp_name'] = ''; // Clear tmp_name to prevent errors in media_handle_sideload
            }

            // Sideload the image into the WordPress media library
            if ( ! empty( $file_array['tmp_name'] ) ) {
                $pdf_attachment_id = media_handle_sideload( $file_array, 0, $post_title ); // 0 for post_id as it's not attached to a post yet

                // Check for media sideload errors
                if ( is_wp_error( $pdf_attachment_id ) ) {
                    error_log( "CSV Import Error: Failed to sideload PDF '{$filename}' for post '{$post_title}'. Error: " . $pdf_attachment_id->get_error_message() );
                    $pdf_attachment_id = 0; // Reset ID if error
                } else {
                    error_log( "CSV Import Success: PDF '{$filename}' uploaded with ID: {$pdf_attachment_id} for post '{$post_title}'." );
                }
            }
        } else {
            error_log( "CSV Import Warning: No PDF URL provided for post '{$post_title}' in row $row_number." );
        }

        // --- 3. Create the 'downloads' post ---
        $post_data = array(
            'post_title'    => $post_title,
            'post_status'   => 'publish', // Or 'draft' if you want to review them first
            'post_type'     => 'downloads', // Your custom post type name
            'post_author'   => get_current_user_id(), // Assign to the current user
        );

        // Insert the post into the database
        $post_id = wp_insert_post( $post_data );

        if ( is_wp_error( $post_id ) ) {
            error_log( "CSV Import Error: Failed to create post '{$post_title}'. Error: " . $post_id->get_error_message() );
            $skipped_count++;
            continue;
        } elseif ( $post_id === 0 ) {
            error_log( "CSV Import Error: wp_insert_post returned 0 for post '{$post_title}'." );
            $skipped_count++;
            continue;
        } else {
            $imported_count++;
            error_log( "CSV Import Success: Post '{$post_title}' created with ID: {$post_id}." );
        }

        // --- 4. Assign Taxonomy Terms ---
        if ( ! empty( $taxonomy_terms ) ) {
            $terms_array = explode( ',', $taxonomy_terms );
            $terms_array = array_map( 'trim', $terms_array ); // Trim whitespace from terms

            // Set the terms for the 'downloads_category' taxonomy
            $set_terms_result = wp_set_object_terms( $post_id, $terms_array, 'downloads_category', false ); // false = append terms, true = replace terms

            if ( is_wp_error( $set_terms_result ) ) {
                error_log( "CSV Import Error: Failed to set terms '{$taxonomy_terms}' for post ID {$post_id}. Error: " . $set_terms_result->get_error_message() );
            } else {
                error_log( "CSV Import Success: Terms '{$taxonomy_terms}' assigned to post ID {$post_id}." );
            }
        } else {
            error_log( "CSV Import Warning: No taxonomy terms provided for post ID {$post_id}." );
        }

        // --- 5. Set Post Meta for PDF ID ---
        if ( $pdf_attachment_id > 0 ) {
            $update_meta_result = update_post_meta( $post_id, '_file', $pdf_attachment_id );

            if ( $update_meta_result === false ) {
                error_log( "CSV Import Error: Failed to set post meta '_file' for post ID {$post_id} with attachment ID {$pdf_attachment_id}." );
            } else {
                error_log( "CSV Import Success: Post meta '_file' set for post ID {$post_id} with attachment ID {$pdf_attachment_id}." );
            }
        }
    }

    // Close the CSV file
    fclose( $handle );

    // Provide a summary message
    $message = "CSV Import Finished: Successfully imported {$imported_count} downloads. Skipped {$skipped_count} rows.";
    error_log( $message );
    echo '<div class="notice notice-success"><p>' . $message . '</p></div>';
}

// Example of how to trigger this function (for one-time execution):
// add_action('admin_init', 'import_downloads_from_csv');
// REMEMBER TO REMOVE OR COMMENT OUT THE LINE ABOVE AFTER THE IMPORT IS COMPLETE!
