<?php
//**/newww */


function get_taxonomy_terms_wpdb($taxonomy)
{
    global $wpdb; // Access the global WordPress database object.

    $terms_array = array(); // Initialize an empty array to store the results.

    // Prepare the SQL query to fetch term_id and name.
    // We join wp_terms with wp_term_taxonomy to filter by the specified taxonomy.
    // wp_terms stores the term details (id, name, slug).
    // wp_term_taxonomy links terms to taxonomies and stores count, description, parent.
    // Using $wpdb->prepare for security to prevent SQL injection.
    $query = $wpdb->prepare(
        "SELECT t.term_id, t.name
         FROM {$wpdb->terms} AS t
         INNER JOIN {$wpdb->term_taxonomy} AS tt
         ON t.term_id = tt.term_id
         WHERE tt.taxonomy = %s
         ORDER BY t.name ASC", // Order by term name for better readability.
        $taxonomy
    );

    // Execute the query and get results as an array of objects.
    // Each object will have properties 'term_id' and 'name'.
    $results = $wpdb->get_results($query);

    // Check if any results were returned.
    $terms_array[''] = 'Select model';
    if (! empty($results)) {
        // Loop through the results and populate the terms_array.
        foreach ($results as $term) {
            // Assign the term name as the value and term_id as the key.
            $terms_array[$term->term_id] = $term->name;
        }
    }

    return $terms_array; // Return the formatted array of terms.
}


function __listing_title($post_id, $tag = false, $class = '')
{
    ob_start();
    $post_type = get_post_type($post_id);
    $title = get_the_title($post_id);
    $model = get_the_terms($post_id, $post_type . '_model')[0];
    if ($model) {
        $logo = get__term_meta($model->term_id, 'logo', true);
        $final_title = str_replace($model->name, ' ', $title);
    } else {
        $final_title = $title;
    }
?>
    <div class="title-box d-flex gap-3 align-items-center">
        <?= wp_get_attachment_image($logo, 'medium') ?>
        <?= $tag ? "<$tag class='$class'>" : '' ?>
        <?= $final_title ?>
        <?= $tag ? "</$tag>" : '' ?>
    </div>
<?php
    return ob_get_clean();
}

function __listing_features($post_id)
{
    ob_start();
    $berths = get__post_meta_by_id($post_id, 'berths');
    $length = get__post_meta_by_id($post_id, 'length');
?>
    <div class="listing--features">
        <ul class="d-flex flex-column gap-3 m-0 fs-14 p-0">
            <?php if ($berths) { ?>
                <li class="d-flex align-items-center justify-content-between py-2">
                    <span>Berths</span>
                    <span><?= $berths ?></span>
                </li>
            <?php } ?>
            <?php if ($length) { ?>
                <li class="d-flex gap-3 align-items-center justify-content-between py-2">
                    <span>Length</span>
                    <span><?= $length ?></span>
                </li>
            <?php } ?>
        </ul>
    </div>
<?php
    return ob_get_clean();
}


function __listing_buttons($post_id)
{
    ob_start();
    $_360_walkthrough = get__post_meta_by_id($post_id, '360_walkthrough');
    $video = get__post_meta_by_id($post_id, 'video');
?>
    <div class="listing--buttons mt-2">
        <ul class="d-flex gap-3 m-0 fs-15 p-0 w-100 justify-content-between align-items-center list-inline">
            <?php if ($_360_walkthrough) { ?>
                <li>
                    <button class="py-2 px-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvas360-<?= $post_id ?>" aria-controls="offCanvas360-<?= $post_id ?>">
                        360° Walkthrough
                    </button>
                </li>
            <?php } ?>
            <?php if ($video) { ?>
                <li>
                    <button class="py-2 px-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvasVideo-<?= $post_id ?>" aria-controls="offCanvasVideo-<?= $post_id ?>">
                        Video Tour
                    </button>
                </li>
            <?php } ?>
            <li>
                <button class="py-2 px-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvasSpecification-<?= $post_id ?>" aria-controls="offCanvasSpecification-<?= $post_id ?>">
                    Specification
                </button>
            </li>
        </ul>
    </div>
    <div class="offcanvas offcanvas--layouts offcanvas-end" tabindex="-1" id="offCanvas360-<?= $post_id ?>" aria-labelledby="offCanvas360-<?= $post_id ?>Label" aria-modal="true" role="dialog">
        <div class="offcanvas-body p-0 ">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"></path>
                </svg>
            </button>
            <div class="offcanvas-body--inner background-white rounded overflow-hidden p-3 p-lg-5">
                <h2 class="fs-24"><?= __listing_title(get_the_ID()) ?></h2>
                <p class="fs-22">360° Walkthrough</p>
                <div class="embed-holder position-relative mb-5">
                    <iframe src="<?= $_360_walkthrough ?>" frameborder="0"></iframe>
                </div>
                <?= do_shortcode('[template template_id=26276]'); ?>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas--layouts offcanvas-end" tabindex="-1" id="offCanvasVideo-<?= $post_id ?>" aria-labelledby="offCanvasVideo-<?= $post_id ?>Label" aria-modal="true" role="dialog">
        <div class="offcanvas-body p-0">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"></path>
                </svg>
            </button>
            <div class="offcanvas-body--inner background-white rounded overflow-hidden p-3 p-lg-5">
                <h2 class="fs-24"><?= __listing_title(get_the_ID()) ?></h2>
                <p class="fs-22">Range Tour</p>
                <div class="embed-holder position-relative mb-5">
                    <iframe src="<?= getYoutubeEmbedUrl($video) ?>" frameborder="0"></iframe>
                </div>
                <?= do_shortcode('[template template_id=26276]'); ?>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas--layouts offcanvas-end" tabindex="-1" id="offCanvasSpecification-<?= $post_id ?>" aria-labelledby="offCanvasSpecification-<?= $post_id ?>Label" aria-modal="true" role="dialog">
        <div class="offcanvas-body p-0">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"></path>
                </svg>
            </button>
            <div class="offcanvas-body--inner background-white rounded overflow-hidden p-3 p-lg-5">
                <h2 class="fs-24"><?= __listing_title(get_the_ID()) ?></h2>
                <p class="fs-22">Specification</p>
                <?= specifications($post_id) ?>
                <?= do_shortcode('[template template_id=26276]'); ?>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
}


function specifications($post_id)
{
    ob_start();
?>
    <div class="specifications">
        <?= specification($post_id, 'price', 'Price') ?>
        <?= specification($post_id, 'layout', 'Layout') ?>
        <?= specification($post_id, 'axles', 'Axles') ?>
        <?= specification($post_id, 'berths', 'Berths') ?>
        <?= specification($post_id, 'interior_length', 'Interior Length') ?>
        <?= specification($post_id, 'overall_length', 'Overall Length') ?>
        <?= specification($post_id, 'overall_width', 'Overall Width') ?>
        <?= specification($post_id, 'overall_height_incl_tv', 'Overall Height (including T.V Aerial)') ?>
        <?= specification($post_id, 'overall_height_incl_aircon', 'Overall Height (including Air Conditioning)') ?>
        <?= specification($post_id, 'maximum_headroom', 'Maximum Headroom') ?>
        <?= specification($post_id, 'wheel_rim', 'Wheel Rim') ?>
        <?= specification($post_id, 'tyre_size', 'Tyre Size') ?>
        <?= specification($post_id, 'tyre_pressure', 'Tyre Pressure (bar / psi at quoted MTPLM)') ?>
        <?= specification($post_id, 'bed_sizes', 'Bed Sizes') ?>
        <?= specification($post_id, 'mtplm', 'MTPLM') ?>
        <?= specification($post_id, 'mass', 'Mass in Running Order') ?>
        <?= specification($post_id, 'personal_payload', 'Personal Payload') ?>
        <?= specification($post_id, 'max_payload', 'Total / Maximum User Payload') ?>
        <?= specification($post_id, 'max_hitch_weight', 'Maximum Hitch Weight') ?>
        <?= specification($post_id, 'awning_size', 'Awning Size (Approx. for reference only)') ?>
        <?= specification($post_id, 'upper_mtplm', 'Upper MTPLM (Optional weight plate upgrade') ?>
        <?= specification($post_id, 'berths', 'Berhs') ?>
    </div>
<?php
    return ob_get_clean();
}

function specification($post_id, $meta_key, $label)
{
    $meta = get__post_meta_by_id($post_id, $meta_key);
    $currency = '';
    if ($meta) {
        $meta = wpautop($meta);
        if ($meta_key == 'price') {
            $currency = '£';
        }
        return "<div class='specification'><div class='meta-label'><strong>$label</strong></div><div class='meta-value'>$currency $meta</div></div>";
    }
}
/**
 * Gets the YouTube embed URL from any type of YouTube link.
 *
 * This function handles common YouTube URL formats including:
 * - https://www.youtube.com/watch?v=dQw4w9WgXcQ
 * - https://youtu.be/dQw4w9WgXcQ
 * - https://www.youtube.com/embed/dQw4w9WgXcQ
 *
 * It uses a regular expression to extract the unique video ID and then
 * constructs the standard embed URL.
 *
 * @param string $url The YouTube video URL.
 * @return string|false The embed URL or false if the URL is not a valid YouTube link.
 */
function getYoutubeEmbedUrl($url)
{
    // A regular expression to match and capture the video ID from various YouTube URL formats.
    // The pattern looks for 'v=', '/embed/', or '.be/' followed by an 11-character video ID.
    $pattern = '/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:watch|embed)\/|v\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';

    // Use preg_match to find the pattern in the provided URL.
    if (preg_match($pattern, $url, $matches)) {
        // If a match is found, the video ID is in the second element of the $matches array.
        $videoId = $matches[1];

        // Construct the standard embed URL using the extracted video ID.
        return 'https://www.youtube.com/embed/' . $videoId;
    }

    // If no match is found, the URL is not a valid YouTube video link.
    return false;
}
