<?php

use Carbon_Fields\Container;
use Carbon_Fields\Complex_Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;

Container::make('term_meta', __('Manufacturer Properties'))
    ->where('term_taxonomy', '=', 'manufacturer')
    ->add_fields(array(
        Field::make('image', 'main_logo', __('Logo')),
    ));

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

/*
Block::make(__('Grid Items'))
    ->add_fields(array(
        Field::make('complex', 'grid', __('Grid Items'))
            ->add_fields(array(
                Field::make('color', 'bg_color', __('Background Color')),
                Field::make('text', 'title', __('Grid Title')),
                Field::make('image', 'image', __('Grid Image')),
                Field::make('textarea', 'description', __('Grid Description')),
                Field::make('text', 'grid_tag', __('Grid Tag')),
                Field::make('text', 'grid_link', __('Grid Link')),
            ))
            ->set_layout('tabbed-horizontal')
            ->set_header_template('<%- title %>')
    ))
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
        $grid = $fields['grid'];
?>

    <div class="grid-section">
        <div class="row g-4">
            <?php foreach ($grid as $item) : ?>
                <div class="col-lg-4">
                    <a href="<?php echo esc_html($item['grid_link']); ?>" class="grid-inner h-100 d-flex flex-column justif-content-between" style="background-color: <?php echo esc_attr($item['bg_color']); ?>;">
                        <div class="grid-item__image">
                            <?php echo wp_get_attachment_image($item['image'], 'full'); ?>
                            <h3><?php echo esc_html($item['title']); ?></h3>
                            <span class="tag"><?php echo esc_html($item['grid_tag']); ?></span>
                        </div><!-- /.grid-item__image -->
                        <div class="grid-item__content">
                            <p><?php echo esc_html($item['description']); ?></p>
                        </div><!-- /.grid-item__content -->
                    </a>
                </div><!-- /.grid-item -->
            <?php endforeach; ?>
        </div>
    </div>
<?php
    });*/

$style = 'style="font-weight: bold;  background-color: #45c324; color: #fff; padding: 15px; border-radius: 5px; font-family: Proxima Nova; text-transform: uppercase; letter-spacing: 1px; font-size: 20px;"';

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


Block::make(__('Accordion'))
    ->add_fields(array(
        Field::make('html', 'html_start')->set_html("<div $style>Accordion Block</div>"),
        Field::make('complex', 'accordion', __('Accordion'))
            ->add_fields(array(
                Field::make('text', 'title', __('Accordion Title')),
                Field::make('rich_text', 'description', __('Accordion Description')),
            ))
            ->set_header_template('<%- title %>')
            ->set_collapsed(true)
    ))
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
        $accordion_items = $fields['accordion'];
?>

    <div class="accordion-box accordion-style-1">
        <div class="accordion-box--iner">
            <div class="accordion rounded border overflow-hidden" id="accordionBlocks-">
                <?php foreach ($accordion_items as $key => $accordion_item) { ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button orange-color collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse<?= $key ?>" aria-expanded="false" aria-controls="collapse<?= $key ?>">
                                <span class="orange-color-inner">
                                    <span class="icon-text">
                                        <?= $accordion_item['title'] ?>
                                    </span>
                                </span>
                            </button>
                        </h2>
                        <div id="collapse<?= $key ?>" class="accordion-collapse collapse" data-bs-parent="#accordionBlocks-">
                            <div class="accordion-body">
                                <?= $accordion_item['description'] ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    <?php
    });

Block::make(__('Listing Feature'))
    ->add_fields(array(
        Field::make('html', 'html_1')->set_html("<div $style>Listing Feature</div>"),
        Field::make('checkbox', 'berths', __('Berths'))->set_width(33),
        Field::make('checkbox', 'year', __('Year'))->set_width(33),
        Field::make('checkbox', 'axle', __('Axle'))->set_width(33),
        Field::make('checkbox', 'warranty', __('Warannty'))->set_width(33),
        Field::make('checkbox', 'weight', __('Weight'))->set_width(33),
        Field::make('checkbox', 'awning_size', __('Awning Size'))->set_width(33),
    ))
    ->set_category('listing')
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
        if ($fields['berths']) {
            $berths = get__post_meta_by_id(get_the_ID(), 'berths');
        }
        if ($fields['year']) {
            $year = get__post_meta_by_id(get_the_ID(), 'year');
        }
        if ($fields['axle']) {
            $axle = get__post_meta_by_id(get_the_ID(), 'axle');
        }
        echo listing__key_information_simple($berths, $year, $axle);
    });


Block::make(__('Listing Prices'))
    ->add_fields(array(
        Field::make('html', 'html_1')->set_html("<div $style>Listing Prices</div>"),
        Field::make('checkbox', 'rrp', __('RRP'))->set_width(33),
        Field::make('checkbox', 'our_price', __('Our Price'))->set_width(33),
        Field::make('checkbox', 'savings', __('Savings'))->set_width(33),

    ))
    ->set_category('listing')
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {

        if ($fields['rrp']) {
            $rrp = get__post_meta_by_id(get_the_ID(), 'rrp');
        } else {
            $rrp = false;
        }
        if ($fields['our_price']) {
            $our_price = get__post_meta_by_id(get_the_ID(), 'our_price');
        }
        if ($fields['savings']) {
            $savings = get__post_meta_by_id(get_the_ID(), 'savings');
        }
        echo listing__price($rrp, $our_price, $savings);
    });


Block::make(__('Listing Floor Plan'))
    ->add_fields(array(
        Field::make('html', 'html_1')->set_html("<div $style>Floor Plan</div>"),

    ))
    ->set_category('listing')
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
        $floor_plan = get__post_meta_by_id(get_the_ID(), 'floor_plan');
        if ($floor_plan) {
            echo '<div class="floor-plan-box text-center ' . $attributes['className'] . '">';
            echo wp_get_attachment_image($floor_plan, 'medium', false, array('class' => 'w-100'));
            echo '</div>';
        }
    });


Block::make(__('Listing URL'))
    ->add_fields(array(
        Field::make('html', 'html_1')->set_html("<div $style>Listing URL </div>"),
    ))
    ->set_category('listing')
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
        $listing_url = get__post_meta_by_id(get_the_ID(), 'listing_url');
    ?>
        <?php if ($listing_url) { ?>
            <div class="listing-grid-item__button">
                <a href="https://newglossopacaravans.theprogressteam.co.uk/listing-inner" class="btn btn-primary w-100 btn-lg fw-semibold">
                    View Full Listing
                </a>
            </div>
        <?php } ?>
    <?php
    });


Block::make(__('Listing Now On Display'))
    ->add_fields(array(
        Field::make('html', 'html_1')->set_html("<div $style> Now On Display </div>"),
    ))
    ->set_category('listing')
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
        $now_on_display = get__post_meta_by_id(get_the_ID(), 'now_on_display');
    ?>
        <?php if ($now_on_display) { ?>
            <div class="now-on-display-box  background-orange-color-3 text-center fw-semibold fs-16 text-white <?= $attributes['className'] ?>">
                NOW ON DISPLAY
            </div>
        <?php } ?>
    <?php
    });


Block::make(__('Tabs Navigation'))
    ->add_fields(array(
        Field::make('html', 'html_1')->set_html("<div $style>Tabs Navigation</div>")->set_width(50),
        Field::make('text', 'tab_id', '')->set_width(50)->set_classes('crb-field-style-1')
            ->set_attribute('placeholder', 'Tab ID')


    ))
    ->set_inner_blocks(true)
    ->set_inner_blocks_position('below')
    ->set_allowed_inner_blocks(array(
        'carbon-fields/tabs-navigation-item',
    ))
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
    ?>
        <div class="nav-tabs-swiper nav-tabs-swiper-style-1 nav-tabs-swiper swiper overflow-visible">
            <ul class="swiper-wrapper nav nav-tabs nav-tabs-style-2 nav-tabs-style-3" id="<?= $fields['tab_id'] ?>" role="tablist">
                <?= $inner_blocks ?>
            </ul>
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


Block::make(__('Listing Action'))
    ->add_fields(array(
        Field::make('html', 'html_1')->set_html("<div $style> Listing Action </div>"),
    ))
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
        echo listing__action();
    });

Block::make(__('Listing Category Logo'))
    ->add_fields(array(
        Field::make('html', 'html_1')->set_html("<div $style> Listing Action </div>"),
    ))
    ->set_category('listing')
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
        $manufacturer = get_the_terms(get_the_ID(), 'manufacturer');
        $logo = get__term_meta($manufacturer[0]->term_id, 'main_logo');
        if ($logo) {
        ?>
            <div class="image-box brand">
                <?= wp_get_attachment_image($logo, 'medium') ?>
            </div>
    <?php
        }
    });

Block::make(__('Listing Gallery'))
    ->add_fields(array(
        Field::make('html', 'html_1')->set_html("<div $style> Listing Gallery </div>"),
    ))
    ->set_category('listing')
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
        $images = [get_post_thumbnail_id()];
        $gallery = carbon_get_the_post_meta('gallery');

        foreach ($gallery as $image) {
            $images[] = $image;
        }

        echo listing__gallery('gallery---' . get_the_ID(), false, $images, $attributes['className']);
    });
