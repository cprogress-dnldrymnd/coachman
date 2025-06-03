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



Block::make(__('Swiper'))
    ->add_fields(array(
        Field::make('html', 'html_1')->set_html("<div $style>Swiper</div>"),
    ))
    ->set_inner_blocks(true)
    ->set_inner_blocks_position('below')
    ->set_allowed_inner_blocks(array(
        'carbon-fields/swiper-wrapper',
    ))
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
?>
    <?= var_dump($attributes) ?>
    <div class="swiper-slider-holder" <?= $attributes['className'] ?>>
        <div class="swiper swiper-slider-block">
            <?= $inner_blocks ?>
        </div>
    </div>
<?php
    });


Block::make(__('Swiper Wrapper'))
    ->add_fields(array(
        Field::make('html', 'html_1')->set_html("<div $style>Swipper Wrapper</div>"),
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
        Field::make('html', 'html_1')->set_html("<div $style>Swipper Pagination</div>")->set_width(50),
        Field::make('text', 'tab_item_id', __(''))->set_width(50)->set_classes('crb-field-style-1')
            ->set_attribute('placeholder', 'Tab Item ID')
    ))
    ->set_parent('carbon-fields/swiper')
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
?>
    <div class="swiper-pagination"> </div>
<?php
    });


Block::make(__('Swiper Slide'))
    ->add_fields(array(
        Field::make('html', 'html_1')->set_html("<div $style>Swiper Slide</div>"),
    ))
    ->set_parent('carbon-fields/swiper-wrapper')
    ->set_inner_blocks(true)
    ->set_inner_blocks_position('below')
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
?>
    <div class="swiper-slide">
        <?= $inner_blocks ?>
    </div>

<?php
    });
