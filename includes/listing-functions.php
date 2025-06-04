<?php

function listings_fields()
{
    global $listing_fields;

    $listing_fields['sortby'] = form_control(array(
        'type'    => 'select',
        'name'    => 'Type',
        'id'      => 'Type',
        'label'   => 'Type',
        'class'   => 'form-control-lg',
        'options' => array(
            ''         => 'Sort 1',
            'Option 1' => 'Option 1',
            'Option 2' => 'Option 2',
            'Option 3' => 'Option 3',
            'Option 4' => 'Option 4',
            'Option 5' => 'Option 5',
            'Option 6' => ' Option6',
        ),
    ));
    $listing_fields['type'] = form_control(array(
        'type'    => 'select',
        'name'    => 'Type',
        'id'      => 'Type',
        'label'   => 'Type',
        'class'   => 'form-control-lg',
        'options' => array(
            ''     => 'New or Used?',
            'New'  => 'New',
            'Used' => 'Used',
            'Both' => 'Both',
        ),
    ));

    $listing_fields['berths'] = form_control(array(
        'type'    => 'select',
        'name'    => 'Berths',
        'id'      => 'Berths',
        'label'   => 'Berths',
        'class'   => 'form-control-lg',
        'options' => array(
            ''    => 'How many berths?',
            'All' => 'All',
            '2'   => '2',
            '3'   => '3',
            '4'   => '4',
            '5'   => '5',
            '6'   => '6',
        ),
    ));
    $listing_fields['make'] = form_control(array(
        'type'    => 'select',
        'name'    => 'Make',
        'id'      => 'Make',
        'label'   => 'Make',
        'class'   => 'form-control-lg',
        'options' => array(
            ''         => 'Select Make',
            'Option 1' => 'Option 1',
            'Option 2' => 'Option 2',
            'Option 3' => 'Option 3',
            'Option 4' => 'Option 4',
            'Option 5' => 'Option 5',
            'Option 6' => ' Option6',
        ),
    ));
    $listing_fields['model'] = form_control(array(
        'type'    => 'select',
        'name'    => 'Model',
        'id'      => 'Model',
        'label'   => 'Model',
        'class'   => 'form-control-lg',
        'options' => array(
            ''         => 'Select Model',
            'Option 1' => 'Option 1',
            'Option 2' => 'Option 2',
            'Option 3' => 'Option 3',
            'Option 4' => 'Option 4',
            'Option 5' => 'Option 5',
            'Option 6' => ' Option6',
        ),
    ));
    $listing_fields['price_min'] = form_control(array(
        'type'    => 'select',
        'name'    => 'Price-Min',
        'id'      => 'Price-Min',
        'label'   => 'Price(min.)',
        'class'   => 'form-control-lg',
        'options' => array(
            '' => 'Any',
        ),
    ));
    $listing_fields['price_max'] = form_control(array(
        'type'    => 'select',
        'name'    => 'Price-Max',
        'id'      => 'Price-Max',
        'label'   => 'Price(max.)',
        'class'   => 'form-control-lg',
        'options' => array(
            '' => 'Any',
        ),
    ));
}
add_action('after_setup_theme', 'listings_fields');

function listing__features($hide_per_month = false)
{
    ob_start();
?>
    <div class="listing-grid__feature-holder">
        <div class="listing-grid__feature fs-13 row g-xxs fw-semibold">
            <div class="listing-grid__feature-item col-auto listing-grid__feature-finance">
                <div class="grid__feature-inner rounded h-100 d-flex align-items-center justify-content-center text-center">
                    Finance available: 7.9% APR
                </div>
            </div>
            <?php if (!$hide_per_month) { ?>
                <div class="listing-grid__feature-item listing-grid__feature-per-month col-auto">
                    <div
                        class="grid__feature-inner rounded h-100 d-flex flex-column align-items-center justify-content-center text-center">
                        <span class="fs-7 fw-medium">Per month</span>
                        £565.50
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php
    return ob_get_clean();
}

function listing__price($rrp = '33795', $our_price = '42200', $savings = '1955')
{
    ob_start();
?>
    <div class="listing-grid-item__prices-holder">
        <div class="listing-grid-item__prices row g-xxs text-center">
            <?php if ($rrp) { ?>
                <div class="listing-grid-item__price col">
                    <div class="grid-item__price-inner rounded h-100">
                        <span class="fs-14">RRP</span>
                        <strong><?= price__format($rrp) ?></strong>
                    </div>
                </div>
            <?php } ?>

            <?php if ($our_price) { ?>

                <div class="listing-grid-item__price col">
                    <div class="grid-item__price-inner rounded h-100">
                        <span class="fs-14">Our price</span>
                        <strong><?= price__format($our_price) ?></strong>
                    </div>
                </div>
            <?php } ?>
            <?php if ($savings) { ?>
                <div class="listing-grid-item__price col">
                    <div class="grid-item__price-inner rounded h-100">
                        <span class="fs-14">Save</span>
                        <strong class="text-orange-3"><?= price__format($savings) ?></strong>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
<?php
    return ob_get_clean();
}
function price__format($value)
{
    return "£" . number_format($value, 2);
}
function listing__action($share = true, $save = true)
{
    ob_start();
?>
    <ul class="icon-list mb-0 d-flex list-inline align-items-center justify-content-end fw-semibold">
        <?php if ($share == true) { ?>
            <li><?= get__theme_images('share.svg') ?> Share</li>
        <?php } ?>
        <?php if ($save == true) { ?>
            <li><?= get__theme_images('save.svg') ?> Save</li>
        <?php } ?>

    </ul>
<?php
    return ob_get_clean();
}

function listing__gallery($id, $is_thumbnail = false, $images = 'default', $class = 'h-100')
{
    ob_start();
    if ($images == 'default') {
        $images = [53, 53, 53, 53, 53, 53];
    }
?>
    <div class="listing-grid--gallery <?= $class ?>">
        <div class="zoom d-none d-lg-flex">
            <?= get__theme_images('zoom.svg') ?>
        </div>
        <?php if (is_page(186)) { ?>
            <div class="listing-grid--feature--action  listing-grid--feature--action--style-2 d-flex d-lg-none">
                <div class="listing-grid__feature fs-13 row g-xxs fw-semibold">
                    <div class="listing-grid__feature-item col-auto">
                        <div
                            class="grid__feature-inner rounded h-100 d-flex align-items-center justify-content-center text-center">
                            Finance available: 7.9% APR
                        </div>
                    </div>
                    <div class="listing-grid__feature-item col-auto">
                        <div
                            class="grid__feature-inner rounded h-100 d-flex flex-column align-items-center justify-content-center text-center">
                            <span class="fs-7 fw-medium">Per month</span>
                            £565.50
                        </div>
                    </div>
                </div>
                <?php
                echo listing__action(false);
                ?>
            </div>
        <?php } ?>
        <div class="swiper <?= $is_thumbnail == false ? 'swiper-gallery h-100' : 'swiper-thumbnails' ?>">
            <div class="swiper-wrapper <?= $is_thumbnail == false ? 'h-100' : '' ?>">
                <?php foreach ($images as $image) { ?>
                    <div class="swiper-slide <?= $is_thumbnail == false ? 'h-100' : '' ?>">
                        <a href="<?= wp_get_attachment_image_url($image, 'full') ?>" <?= $is_thumbnail == false ? 'data-fancybox="' . $id . '"' : '' ?>
                            class="d-block image-box image-style <?= $is_thumbnail == false ? 'h-100' : '' ?>">
                            <?= wp_get_attachment_image($image, $is_thumbnail == false ? 'large' : 'medium') ?>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <?php if ($is_thumbnail == false) { ?>
                <div class="swiper-button-next swiper-gallery-next swiper-button"></div>
                <div class="swiper-button-prev swiper-gallery-prev swiper-button"></div>
                <div class="swiper-pagination swiper-gallery-pagination"></div>
            <?php } ?>
        </div>
    </div>
<?php
    return ob_get_clean();
}

function listing__key_information_simple($berths = 4, $year = 2024, $axle = false)
{
    ob_start();
?>
    <ul class="icon-list mb-0 icon-list-v4 d-flex list-inline align-items-center flex-wrap fs-18">
        <?php if ($berths) { ?>
            <li> <?= get__theme_images('berths.svg') ?> <?= $berths ?> Berth</li>
        <?php } ?>
        <?php if ($year) { ?>
            <li><?= get__theme_images('year.svg') ?> <?= $year ?> </li>
        <?php } ?>
        <?php if ($axle) { ?>
            <li>
                <?php if ($axle == 'Twin Axle') { ?>
                    <?= get__theme_images('axles.svg') ?>
                <?php } ?>
                <?= get__theme_images('axles.svg') ?>
                <?= $axle ?>
            </li>
        <?php } ?>
    </ul>
<?php
    return ob_get_clean();
}

function listing__key_information()
{
    ob_start();
?>
    <ul
        class="icon-list mb-0 icon-list-v2 d-flex list-inline align-items-center justify-content-end fw-semibold flex-wrap fs-18">
        <li> <?= get__theme_images('berths.svg') ?> 6 Berth</li>
        <li><?= get__theme_images('warranty.svg') ?> 3 year warranty</li>
        <li><?= get__theme_images('year.svg') ?> Year 2024</li>
        <li><span class="icons"><?= get__theme_images('tire.svg') ?><?= get__theme_images('tire.svg') ?></span>
            Twin axle</li>
        <li><?= get__theme_images('kg.svg') ?> MTPLM 1630kg</li>
        <li><?= get__theme_images('awning-size.svg') ?> 10.52m Awning Size</li>
    </ul>
<?php
    return ob_get_clean();
}


function listing__key_information_v2()
{
    ob_start();
?>
    <ul
        class="icon-list mb-0 icon-list-v2 d-flex list-inline align-items-center justify-content-end fw-semibold flex-wrap fs-18">
        <li class="border-bottom py-1 py-lg-3"> <?= get__theme_images('berths.svg') ?>
            <span class="col d-flex justify-content-between">
                <span>Berth</span>
                <span>6</span>
            </span>
        </li>
        <li class="border-bottom py-1 py-lg-3"><?= get__theme_images('year.svg') ?>
            <span class="col d-flex justify-content-between">
                <span>Unladen Weight</span>
                <span>1450kg</span>
            </span>
        </li>
        <li class="border-bottom py-1 py-lg-3"><?= get__theme_images('year.svg') ?>
            <span class="col d-flex justify-content-between">
                <span>Year</span>
                <span>2024</span>
            </span>
        </li>
        <li class="border-bottom py-1 py-lg-3"><?= get__theme_images('kg.svg') ?>
            <span class="col d-flex justify-content-between">
                <span>MTPLM</span>
                <span>1630kg</span>
            </span>
        </li>
        <li class="border-bottom py-1 py-lg-3"><?= get__theme_images('awning-size.svg') ?>
            <span class="col d-flex justify-content-between">
                <span>Awning Size</span>
                <span>10.52m</span>
            </span>
        </li>
        <li class="border-bottom py-1 py-lg-3"><?= get__theme_images('dimensions.svg') ?>
            <span class="col d-flex justify-content-between">
                <span>Dimensions</span>
                <span>L 7.98m x W 2.25m</span>
            </span>
        </li>
    </ul>
<?php
    return ob_get_clean();
}


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


function __listing_title($title, $term_id)
{
    ob_start();
    $logo = get__term_meta($term_id, 'logo', true);
?>
    <div class="title-box d-flex gap-3 align-items-center">
        <?= wp_get_attachment_image($logo, 'medium') ?>
        <?= $title ?>
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
    <div class="listing--buttons">
        <ul class="d-flex gap-3 m-0 fs-15 p-0 w-100 justify-content-between align-items-center list-inline">
            <?php if ($_360_walkthrough) { ?>
                <li>
                    <button class=" py-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvasLayout" aria-controls="offCanvasLayout-<?= $post_id ?>">
                        360° Walkthrough
                    </button>
                </li>
            <?php } ?>
            <?php if ($video) { ?>
                <li>
                    <button class="py-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvasLayout" aria-controls="offCanvasVideo-<?= $post_id ?>">
                        Video Tour
                    </button>
                </li>
            <?php } ?>
        </ul>
    </div>
<?php
    return ob_get_clean();
}
