<?php

use Carbon_Fields\Container;
use Carbon_Fields\Complex_Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;

Container::make('post_meta', __('Page Settings'))
    ->where('post_type', '=', 'page')
    ->set_context('side')
    ->add_fields(array(
        Field::make('select', 'header_style', __('Header Style'))
            ->set_options(array(
                'header-default' => 'Default',
                'header-transparent' => 'Transparent',
            )),
    ));
Container::make('post_meta', __('Caravan Properties'))
    ->where('post_type', '=', 'caravan')
    ->or_where('post_type', '=', 'motorhome')
    ->add_fields(array(
        Field::make('select', 'berths', __('Berths'))
            ->set_options(array(
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
            )),
        Field::make('text', 'length', __('Length')),
        Field::make('oembed', '360_walkthrough', __('360° Walkthrough'))->set_width(50),
        Field::make('oembed', 'video', __('Video tour'))->set_width(50),
    ));

Container::make('post_meta', __('Brochure Settings'))
    ->where('post_type', '=', 'downloads')
    ->add_fields(array(
        Field::make('file', 'file', __('File'))
            ->set_type(array('application/pdf'))
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
                'flex-row' => 'Horizontal',
                'flex-column' => 'Vertical',
            )),
        Field::make('select', 'style', __('Style'))
            ->set_options(array(
                '' => 'Default',
                'style-1' => 'Style 1',
                'style-2' => 'Style 2',
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
            $class1 = 'swiper swiper-nav-tabs-swiper nav-tabs-swiper';
            $class2 = 'swiper-wrapper nav nav-tabs';
        } else {
            $class1 = 'nav-tabs-holder';
            $class2 = 'nav nav-tabs gap-1';
        }
        ?>
        <div class="<?= $class1 ?> overflow-visible sm-margin-bottom nav-tabs-swiper-js">
            <ul class="<?= $class2 ?>  <?= $fields['direction'] ?> <?= $fields['style'] ?>" id="<?= $fields['tab_id'] ?>" role="tablist">
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
        Field::make('text', 'swiper_id', __('Swiper ID')),
        Field::make('complex', 'swiper_options')
            ->add_fields('autoplay', array(
                Field::make('text', 'delay', __('delay'))->set_attribute('type', 'number'),
                Field::make('checkbox', 'disableoninteraction', __('disableOnInteraction')),
            ))
            ->add_fields('spacebetween', array(
                Field::make('text', 'spacebetween', __('spaceBetween'))->set_attribute('type', 'number'),
            ))
            ->add_fields('slidesperview', array(
                Field::make('text', 'slidesperview', __('slidesPerView')),
            ))
            ->add_fields('pagination_navigation', array(
                Field::make('checkbox', 'has_pagination', __('Has Pagination')),
                Field::make('checkbox', 'has_navigation', __('Has Navigation')),
                Field::make('select', 'style', __('Pagination & Navigation Style'))
                    ->set_options(array(
                        '' => 'Default',
                        'style-2' => 'Style 2',
                    )),
            ))
            ->set_duplicate_groups_allowed(false)
            ->set_collapsed(true)
    ))
    ->set_inner_blocks(true)
    ->set_inner_blocks_position('below')
    ->set_allowed_inner_blocks(array(
        'carbon-fields/swiper-wrapper',
    ))
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
        $atts = [];
        $swiper_id = $fields['swiper_id'];
        $swiper_options = $fields['swiper_options'];
        $style = '';
        foreach ($swiper_options as $swiper_option) {
            $type = $swiper_option['_type'];
            switch ($type) {
                case 'autoplay':
                    $delay = isset($swiper_option['delay']) ? $swiper_option['delay'] : 3000;
                    $disableoninteraction = isset($swiper_option['disableoninteraction']) ? 'true' : 'false';
                    $atts['autoplay'] = array(
                        'delay' => $delay,
                        'disableOnInteraction' => $disableoninteraction,
                    );
                    break;
                case 'spacebetween':
                    $atts['spaceBetween'] = $swiper_option['spacebetween'];
                    break;
                case 'slidesperview':
                    $atts['slidesPerView'] = $swiper_option['slidesperview'] ? $swiper_option['slidesperview'] : 1;
                    break;
                case 'pagination_navigation':
                    $style = isset($swiper_option['style']) ? $swiper_option['style'] : '';
                    if ($swiper_option['has_pagination']) {
                        $atts['pagination'] = array(
                            'el' => '#' . $swiper_id . ' .swiper-pagination',
                            'clickable' => 'true',
                        );
                    }
                    if ($swiper_option['has_navigation']) {
                        $atts['navigation'] = array(
                            'nextEl' => '#' . $swiper_id . ' .swiper-button-next',
                            'prevEl' => '#' . $swiper_id . ' .swiper-button-prev',
                        );
                    }
                    break;
            }
        }
        $atts_json = json_encode($atts);
?>
    <div class="swiper-slider-holder swiper-nav-<?= $style ?>" <?= $attributes['className'] ?> swiper_atts='<?= $atts_json ?>'>
        <div class="swiper swiper-slider-block" id="<?= $swiper_id ?>">
            <?= $inner_blocks ?>

            <?php if ($style == 'style-2') { ?>
                <div class="swiper-pagination-navigation-style-2">

                </div>
            <?php } ?>
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

Block::make(__('Swiper Navigation'))
    ->add_fields(array(
        Field::make('html', 'html_1')->set_html("<div $style>-Swipper Navigation</div>"),
    ))
    ->set_parent('carbon-fields/swiper')
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
?>
    <div class="swiper-navigation-holder">
        <div class="container">
            <div class="swiper-button-prev"> </div>
            <div class="swiper-button-next"> </div>
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


Block::make(__('Caravan/Motohomes Models'))
    ->add_fields(array(
        Field::make('html', 'html_1')->set_html("<div $style>Caravan/Motohomes Models</div>"),
        Field::make('checkbox', 'is_swiper', __('Is Swiper')),
        Field::make('checkbox', 'display_model_layouts', __('Display Model Layouts')),
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

        if ($fields['is_swiper']) {
            $class1 = 'swiper swiper-listings-taxonomy';
            $class2 = 'swiper-wrapper';
            $class3 = 'swiper-slide h-auto';
        } else {
            $class1 = 'listings-taxonomy-holder';
            $class2 = 'listings-taxonomy-wrapper row g-3';
            $class3 = 'col-lg-12';
        }
?>

    <div class="listings listings-style-1" style="--padding: 50% 0; --fit: contain;">
        <div class="container">
            <div class="<?= $class1 ?>">
                <div class="<?= $class2 ?>">
                    <?php foreach ($fields['posts'] as $post) { ?>
                        <?php foreach ($post['model'] as $key => $model) { ?>
                            <?php
                            $logo = get__term_meta($model, 'logo', true);
                            $image = get__term_meta($model, 'image', true);
                            $page = carbon_get_term_meta($model, 'page');


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
                            <div class="<?= $class3 ?> ">
                                <div class="listings--inner h-100 p-4  <?= $fields['display_model_layouts'] ? 'listings--inner--js has-model-layout' : '' ?>" listing-target="#listings--posts-<?= $key ?>-<?= $post['_type'] ?>-<?= $model ?>">
                                    <?php if ($page) { ?>
                                        <a href="<?= get_the_permalink($page[0]['id']) ?>" class="listing--model-link"></a>
                                    <?php } ?>
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
    <?php if ($fields['display_model_layouts']) { ?>
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
                    $page = carbon_get_term_meta($model, 'page');

                ?>
                <div class="listings--posts bg-lightgray-2" id="listings--posts-<?= $key ?>-<?= $post['_type'] ?>-<?= $model ?>">
                    <div class="container  py-5">
                        <div class="row g-3">
                            <?php foreach ($posts_listings as $posts_listing) { ?>

                                <div class="col-lg-3">
                                    <div class="listings--posts--grid bg-white p-4">
                                        <h3 class="fs-24"><?= __listing_title($posts_listing->ID) ?></h3>
                                        <div class="image-box image-style image-style-2 mb-3" style="--fit: contain">
                                            <?= get_the_post_thumbnail($posts_listing->ID, 'medium') ?>
                                        </div>
                                        <?= __listing_features($posts_listing->ID) ?>
                                        <?php if ($page) { ?>
                                            <div class="listing--buttons mt-2">
                                                <ul class="d-flex gap-3 m-0 fs-15 p-0 w-100 justify-content-between align-items-center list-inline">
                                                    <li>
                                                        <a class="py-2 px-0 text-decoration-none" href="<?= get_the_permalink($page[0]['id']) ?>">
                                                            Explore
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        <?php } ?>

                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    <?php } ?>

<?php
    });
Block::make(__('Listing Title'))
    ->add_fields(array(
        Field::make('html', 'html_1')->set_html("<div $style>Listing Title</div>"),
    ))
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
?>
    <?= __listing_title(get_the_ID(), 'h3', 'fs-24 fw-semibold mb-0') ?>
<?php
    });

Block::make(__('Listing Feature'))
    ->add_fields(array(
        Field::make('html', 'html_1')->set_html("<div $style>Listing Feature</div>"),
    ))
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
?>
    <?= __listing_features(get_the_ID()) ?>
<?php
    });

Block::make(__('Listing Buttons'))
    ->add_fields(array(
        Field::make('html', 'html_1')->set_html("<div $style>Listing Buttons</div>"),
    ))
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
?>
    <?= __listing_buttons(get_the_ID()) ?>
<?php
    });


Block::make(__('Model Technical Details'))
    ->add_fields(array(
        Field::make('html', 'html_1')->set_html("<div $style>Model Technical Details</div>"),
        Field::make('text', 'button_text', __('Button Text'))->set_default_value('View all technical details'),
        Field::make('complex', 'model')
            ->add_fields('caravan', array(
                Field::make('text', 'taxonomy', __('Caravan Model'))->set_default_value('caravan_model')->set_classes('hidden'),
                Field::make('select', 'model', __('Caravan Model'))
                    ->add_options(get_taxonomy_terms_wpdb('caravan_model'))
            ))
            ->add_fields('motorhome', array(
                Field::make('text', 'taxonomy', __('Motorhome Model'))->set_default_value('motorhome_model')->set_classes('hidden'),
                Field::make('select', 'model', __('Motorhome Model'))
                    ->add_options(get_taxonomy_terms_wpdb('motorhome_model'))
            ))
            ->set_max(1)
            ->set_duplicate_groups_allowed(false)
    ))
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
        $model_id = $fields['model'][0]['model'];
        $logo = get__term_meta($model_id, 'logo', true);
        $technical_details = carbon_get_term_meta($model_id, 'technical_details');


?>
    <div class="wp-block-button is-style-fill">
        <button class="wp-block-button__link w-auto has-white-theme-color has-maroon-background-color has-text-color has-background has-link-color wp-element-button" style="border-radius:0px" data-bs-toggle="offcanvas" data-bs-target="#offCanvasModelSpecs-<?= $model_id ?>" aria-controls="offCanvasModelSpecs-<?= $model_id ?>">
            <?= $fields['button_text'] ?>
        </button>
    </div>
    <div class="offcanvas offcanvas--technical-details offcanvas-end" tabindex="-1" id="offCanvasModelSpecs-<?= $model_id ?>" aria-labelledby="offCanvasModelSpecs-<?= $model_id ?>Label" aria-modal="true" role="dialog">
        <div class="offcanvas-body p-0 overflow-hidden">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"></path>
                </svg>
            </button>
            <div class="offcanvas-body--inner background-white rounded overflow-hidden p-3 p-lg-5 d-flex h-100 flex-column justify-content-between gap-3">
                <div class="top">
                    <div class="title-box d-flex gap-3 align-items-center">
                        <h2><?= wp_get_attachment_image($logo, 'medium') ?></h2>
                    </div>
                    <p class="fs-22 mb-4">Technical details</p>
                    <div class="accordion" id="accordionTechnicalDetails">
                        <?php foreach ($technical_details as $key => $technical_detail) { ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fs-17 fw-semibold <?= $key == 0 ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $key ?>" aria-expanded="<?= $key == 0 ? 'true' : 'false' ?>" aria-controls="collapse<?= $key ?>">
                                        <?= $technical_detail['heading'] ?>
                                    </button>
                                </h2>
                                <div id="collapse<?= $key ?>" class="accordion-collapse collapse <?= $key == 0 ? 'show' : '' ?>" data-bs-parent="#accordionTechnicalDetails">
                                    <div class="accordion-body checklists-holder bg-lightgray-2 fs-14">
                                        <?= wpautop($technical_detail['description']) ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="bottom">
                    <?= do_shortcode('[template template_id=426]'); ?>
                </div>
            </div>
        </div>
    </div>
<?php
    });


Container::make('term_meta', __('Model Properties'))
    ->where('term_taxonomy', '=', 'caravan_model')
    ->or_where('term_taxonomy', '=', 'motorhome_model')
    ->add_fields(array(
        Field::make('image', 'logo', __('Logo')),
        Field::make('image', 'image', __('Image')),
        Field::make('association', 'page', __('Page'))
            ->set_types(array(
                array(
                    'type'      => 'post',
                    'post_type' => 'page',
                )
            ))
            ->set_max(1),
        Field::make('complex', 'technical_details', 'Technical details')
            ->add_fields(array(
                Field::make('text', 'heading', __('Heading')),
                Field::make('rich_text', 'description', __('Description')),
            ))
            ->set_header_template('<%- heading %>')
    ));
