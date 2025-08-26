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
        </ul>
    </div>
    <div class="offcanvas offcanvas--layouts offcanvas-end" tabindex="-1" id="offCanvas360-<?= $post_id ?>" aria-labelledby="offCanvas360-<?= $post_id ?>Label" aria-modal="true" role="dialog">
        <div class="offcanvas-body p-0 overflow-hidden">
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
                <?= do_shortcode('[template template_id=426]'); ?>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas--layouts offcanvas-end" tabindex="-1" id="offCanvasVideo-<?= $post_id ?>" aria-labelledby="offCanvasVideo-<?= $post_id ?>Label" aria-modal="true" role="dialog">
        <div class="offcanvas-body p-0 overflow-hidden">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"></path>
                </svg>
            </button>
            <div class="offcanvas-body--inner background-white rounded overflow-hidden p-3 p-lg-5">
                <h2 class="fs-24"><?= __listing_title(get_the_ID()) ?></h2>
                <p class="fs-22">Range Tour</p>
                <div class="embed-holder position-relative mb-5">
                    <iframe src="<?= $video ?>" frameborder="0"></iframe>
                </div>
                <?= do_shortcode('[template template_id=426]'); ?>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
}
