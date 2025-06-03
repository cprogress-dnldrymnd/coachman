<?php

use Carbon_Fields\Container;
use Carbon_Fields\Complex_Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;

Container::make('post_meta', __('Caravan Properties'))
    ->where('post_type', '=', 'caravan')
    ->add_fields(array(
        Field::make('media_gallery', 'gallery', __('Gallery')),
        Field::make('image', 'floor_plan', __('Floor Plan')),
        Field::make('text', 'listing_url', __('Listing URL'))->set_attribute('type', 'url'),
        Field::make('text', 'rrp', __('RRP (£)'))->set_attribute('type', 'number')->set_attribute('step', '1')->set_width(33),
        Field::make('text', 'our_price', __('Our Price (£)'))->set_attribute('type', 'number')->set_attribute('step', '1')->set_width(33),
        Field::make('text', 'savings', __('Savings (£)'))->set_attribute('type', 'number')->set_attribute('step', '1')->set_width(33),

        Field::make('select', 'berths', __('Berths'))
            ->set_options(array(
                'all' => 'All',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
            )),
        Field::make('select', 'axle', __('Axle'))
            ->set_options(array(
                'Single Axle' => 'Single Axle',
                'Twin Axle' => 'Twin Axle',
            )),
        Field::make('text', 'year', __('Year')),
        Field::make('text', 'warranty', __('Warranty')),
        Field::make('text', 'weight', __('Weight')),
        Field::make('text', 'awning_size', __('Awning Size')),
        Field::make('checkbox', 'now_on_display', __('Now On Display')),
    ));

$style = 'style="font-weight: bold;  background-color: #45c324; color: #fff; padding: 15px; border-radius: 5px; font-family: Pennypacker; text-transform: uppercase; letter-spacing: 1px; font-size: 20px;"';

Block::make(__('Icon'))
    ->add_fields(array(
        Field::make('html', 'html_start')->set_html("<div $style>Icon</div>"),
        Field::make('color', 'icon_color', __('Color')),
        Field::make('select', 'icon_alignment', __('Alignment'))->set_options(array(
            '' => 'Default',
            'text-center' => 'Center',
            'text-start' => 'Left',
            'text-end' => 'Right',
        ))->set_width(33),
        Field::make('text', 'icon_width', __('Width'))->set_width(33),
        Field::make('text', 'icon_height', __('Height'))->set_width(33),
        Field::make('image', 'icon', __('Icon')),

    ))
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
        $icon = $fields['icon'];
        $icon_color = $fields['icon_color'];
        $icon_width = $fields['icon_width'];
        $icon_height = $fields['icon_height'];
        $icon_alignment = $fields['icon_alignment'];
?>

    <div class="svg-box <?= $icon_alignment ?> <?= $attributes['className'] ?>" style="color: <?= $icon_color ?>; --svg-width: <?= $icon_width ?>; --svg-height: <?= $icon_height ?>">
        <?= get__media_libray_icons($icon) ?>
    </div>
<?php
    });

Block::make(__('Video Gallery'))
    ->add_fields(array(
        Field::make('html', 'html_start')->set_html("<div $style>Video Gallery Block</div>"),
        Field::make('html', 'html_end')->set_html("<div style='text-align: center'><a class='components-button is-primary target='_blank' href='/wp-admin/edit.php?post_type=videos'>Manage Videos</a></div>"),
    ))
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
        $args = array(
            'post_type' => 'videos',
            'posts_per_page' => -1,
        );
        $query = new WP_Query($args);
?>

    <div class="video-gallery-box <?= $attributes['className'] ?>">
        <div class="row g-4">
            <?php while ($query->have_posts()) { ?>
                <?php $query->the_post() ?>
                <div class="col-sm-6 col-lg-4">
                    <div class="video-box rounded overflow-hidden position-relative">
                        <?php the_content() ?>
                    </div>
                </div>
            <?php } ?>
            <?php wp_reset_postdata() ?>
        </div>
    </div>
<?php
    });


Block::make(__('Tabs Navigation'))
    ->add_fields(array(
        Field::make('html', 'html_1')->set_html("<div $style>Tabs Navigation</div>")->set_width(50),
        Field::make('text', 'tab_id', '')->set_width(50)->set_classes('crb-field-style-1')
            ->set_attribute('placeholder', 'Tab ID'),
        Field::make('checkbox', 'is_swiper', __('Is Swiper')),
        Field::make('select', 'direction', __('Direction'))
            ->set_options(array(
                '' => 'Default',
                'horizontal' => 'Horizontal',
                'vertical' => 'Vertical',
                '4' => '4',
                '5' => '5',
                '6' => '6',
            )),
    ))
    ->set_inner_blocks(true)
    ->set_inner_blocks_position('below')
    ->set_allowed_inner_blocks(array(
        'carbon-fields/tabs-navigation-item',
    ))
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
?>
    <div class="container">
        <?php
        if ($fields['is_swiper']) {
            $class1 = 'swiper swiper-nav-tabs-swiper nav-tabs-swiper nav-tabs-swiper-js ';
            $class2 = 'swiper-wrapper nav nav-tabs';
        } else {
            $class1 = 'nav-tabs-holder';
            $class2 = 'nav nav-tabs';
        }
        ?>
        <div class="<?= $class1 ?> overflow-visible sm-margin-bottom">
            <ul class="<?= $class2 ?> swiper-wrapper nav nav-tabs" id="<?= $fields['tab_id'] ?>" role="tablist">
                <?= $inner_blocks ?>
            </ul>
        </div>
    </div>
<?php
    });

Block::make(__('Tabs Navigation Item'))
    ->add_fields(array(
        Field::make('html', 'html_1')->set_html("<div $style>Tab Navigation Item</div>")->set_width(50),
        Field::make('text', 'tab_item_id', __(''))->set_width(50)->set_classes('crb-field-style-1')
            ->set_attribute('placeholder', 'Tab Item ID')
    ))
    ->set_parent('carbon-fields/tabs-navigation')
    ->set_inner_blocks(true)
    ->set_inner_blocks_position('below')
    ->set_allowed_inner_blocks(array(
        'core/paragraph',
        'core/image'
    ))
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
?>
    <li class="swiper-slide nav-item" role="presentation">
        <button class="nav-link" id="<?= $fields['tab_item_id'] ?>" data-bs-toggle="tab" data-bs-target="#<?= $fields['tab_item_id'] ?>-pane" type="button" role="tab" aria-controls="<?= $fields['tab_item_title'] ?>-pane">
            <?= $inner_blocks ?>
        </button>
    </li>

<?php
    });



Block::make(__('Tabs Content'))
    ->add_fields(array(
        Field::make('html', 'html_1')->set_html("<div $style>Tabs Content</div>")->set_width(50),
        Field::make('text', 'tab_id', '')->set_width(50)->set_classes('crb-field-style-1')
            ->set_attribute('placeholder', 'Tab ID')


    ))
    ->set_inner_blocks(true)
    ->set_inner_blocks_position('below')
    ->set_allowed_inner_blocks(array(
        'carbon-fields/tabs-content-item',
    ))
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
?>
    <div class="tab-content" id="<?= $fields['tab_id'] ?>">
        <?= $inner_blocks ?>
    </div>
<?php
    });


Block::make(__('Tabs Content Item'))
    ->add_fields(array(
        Field::make('html', 'html_1')->set_html("<div $style>Tabs Content Item</div>")->set_width(50),
        Field::make('text', 'tab_content_id', '')->set_width(50)->set_classes('crb-field-style-1')
            ->set_attribute('placeholder', 'Tab ID')

    ))
    ->set_inner_blocks(true)
    ->set_inner_blocks_position('below')
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
?>
    <div class="tab-pane fade" id="<?= $fields['tab_content_id'] ?>-pane">
        <?= $inner_blocks ?>
    </div>
<?php
    });



Block::make(__('Swiper'))
    ->add_fields(array(
        Field::make('html', 'html_1')->set_html("<div $style>Swiper</div>"),
        Field::make('complex', 'swiper_options')
            ->add_fields('autoplay', array(
                Field::make('text', 'delay', __('delay'))->set_attribute('type', 'number'),
                Field::make('checkbox', 'disableoninteraction', __('disableOnInteraction')),
            ))
            ->add_fields('spacebetween', array(
                Field::make('text', 'spacebetween', __('spaceBetween'))->set_attribute('type', 'number'),
            ))
    ))
    ->set_inner_blocks(true)
    ->set_inner_blocks_position('below')
    ->set_allowed_inner_blocks(array(
        'carbon-fields/swiper-wrapper',
    ))
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
?>
    <div class="swiper-slider-holder" <?= $attributes['className'] ?>>
        <div class="swiper swiper-slider-block">
            <?= $inner_blocks ?>
        </div>
    </div>
<?php
    });


Block::make(__('Swiper Wrapper'))
    ->add_fields(array(
        Field::make('html', 'html_1')->set_html("<div $style>-Swipper Wrapper</div>"),
    ))
    ->set_parent('carbon-fields/swiper')
    ->set_inner_blocks(true)
    ->set_inner_blocks_position('below')
    ->set_allowed_inner_blocks(array(
        'carbon-fields/swiper-slide',
    ))
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
?>
    <div class="swiper-wrapper">
        <?= $inner_blocks ?>
    </div>

<?php
    });
Block::make(__('Swiper Pagination'))
    ->add_fields(array(
        Field::make('html', 'html_1')->set_html("<div $style>-Swipper Pagination</div>"),
    ))
    ->set_parent('carbon-fields/swiper')
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
?>
    <div class="swiper-pagination-holder">
        <div class="container">
            <div class="swiper-pagination"> </div>
        </div>
    </div>
<?php
    });


Block::make(__('Swiper Slide'))
    ->add_fields(array(
        Field::make('html', 'html_1')->set_html("<div $style>--Swiper Slide</div>"),
    ))
    ->set_parent('carbon-fields/swiper-wrapper')
    ->set_inner_blocks(true)
    ->set_inner_blocks_position('below')
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
?>
    <div class="swiper-slide">
        <div class="swiper-slide--inner">
            <?= $inner_blocks ?>
        </div>
    </div>

<?php
    });


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

Block::make(__('Caravan/Motohomes Models'))
    ->add_fields(array(
        Field::make('html', 'html_1')->set_html("<div $style>Caravan/Motohomes Models</div>"),
        Field::make('complex', 'posts')
            ->add_fields('caravan', array(
                Field::make('text', 'taxonomy', __('Caravan Model'))->set_default_value('caravan_model')->set_classes('hidden'),
                Field::make('multiselect', 'model', __('Caravan Model'))
                    ->add_options(get_taxonomy_terms_wpdb('caravan_model'))
            ))
            ->add_fields('motorhome', array(
                Field::make('text', 'taxonomy', __('Motorhome Model'))->set_default_value('motorhome_model')->set_classes('hidden'),
                Field::make('multiselect', 'model', __('Motorhome Model'))
                    ->add_options(get_taxonomy_terms_wpdb('motorhome_model'))
            ))
    ))
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
?>

    <div class="listings listings-style-1">
        <div class="container">
            <div class="swiper swiper-listings-taxonomy">
                <div class="swiper-wrapper">

                    <?php foreach ($fields['posts'] as $post) { ?>
                        <?php foreach ($post['model'] as $key => $model) { ?>
                            <?php
                            $logo = get__term_meta($model, 'logo', true);
                            $image = get__term_meta($model, 'image', true);
                            $args = array(
                                'post_type' => $post['_type'],
                                'numberposts' => -1,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => $post['taxonomy'],
                                        'field' => 'term_id',
                                        'terms' => $model,
                                    ),
                                ),
                            );
                            $posts_listings = get_posts($args);
                            ?>
                            <div class="swiper-slide h-auto">
                                <div class="listings--inner h-100 p-4 listings--inner--js" listing-target="#listings--posts-<?= $key ?>-<?= $post['_type'] ?>-<?= $model ?>">
                                    <?php if ($logo) { ?>
                                        <div class="logo-box">
                                            <?= wp_get_attachment_image($logo, 'medium') ?>
                                        </div>
                                    <?php } ?>
                                    <?php if ($image) { ?>
                                        <div class="image-box image-style">
                                            <?= wp_get_attachment_image($image, 'medium') ?>
                                        </div>
                                    <?php } ?>
                                    <div class="model-num d-flex gap-2 align-items-center justify-content-between fs-15">
                                        <span> <?= count($posts_listings) ?> Models</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <?php foreach ($fields['posts'] as $key => $post) { ?>
        <?php foreach ($post['model'] as $key => $model) { ?>
            <?php
                $args = array(
                    'post_type' => $post['_type'],
                    'numberposts' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => $post['taxonomy'],
                            'field' => 'term_id',
                            'terms' => $model,
                        ),
                    ),
                );
                $posts_listings = get_posts($args);
            ?>
            <div class="listings--posts bg-lightgray-2" id="listings--posts-<?= $key ?>-<?= $post['_type'] ?>-<?= $model ?>">
                <div class="container  py-5">
                    <div class="row g-3">
                        <?php foreach ($posts_listings as $posts_listing) { ?>
                            <div class="col-lg-3">
                                <div class="listings--posts--grid bg-white p-4">
                                    <h3 class="fs-24"><?= $posts_listing->post_title ?></h3>
                                    <div class="image-box image-style" style="--fit: contain">
                                        <?= get_the_post_thumbnail($posts_listing->ID, 'medium') ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>

<?php
    });

Container::make('term_meta', __('Model Properties'))
    ->where('term_taxonomy', '=', 'caravan_model')
    ->or_where('term_taxonomy', '=', 'motorhome_model')
    ->add_fields(array(
        Field::make('image', 'logo', __('Logo')),
        Field::make('image', 'image', __('Image')),
    ));
