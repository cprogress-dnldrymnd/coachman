<?php
/*-----------------------------------------------------------------------------------*/
/* Template Name: Listing Page 
/*-----------------------------------------------------------------------------------*/
?>
<?php get_header() ?>
<?php
global $listing_fields;
?>
<div class="site-content listings background-lightgray">
    <div class="container md-padding-top md-padding-bottom">
        <div class="listings-holder">
            <h2 class="mb-5">We found <span class="text-orange">59</span> caravans for you</h2>

            <div class="filter--mobile d-block d-lg-none fw-semibold">
                <div class="row g-xxs">
                    <div class="col-6">
                        <button class="btn-with-icon btn btn-primary w-100" type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvasFilter" aria-controls="offCanvasFilter">
                            <?= get__theme_icons('filter.svg') ?>

                            Filter
                        </button>
                    </div>
                    <div class="col-6">
                        <button class="btn-with-icon btn btn-light w-100 border">
                            <?= get__theme_icons('sort-by.svg') ?>
                            Sort
                        </button>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-3 position-relative" style="z-index: 3">
                    <div class="listing-filter sticky-element accordion-style-1">
                        <div class="offcanvas offcanvas-end offcanvas-visible-desktop" tabindex="-1" id="offCanvasFilter" aria-labelledby="offCanvasFilterLabel">
                            <div class="offcanvas-body">
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                <div class="accordion rounded overflow-hidden" id="accordionFilter">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseSort-by" aria-expanded="false"
                                                aria-controls="collapseSort-by">
                                                <span class="accordion-button-inner">
                                                    <span class="icon-text">
                                                        <span class="icon"><?= get__theme_images('sort-by.svg') ?></span>
                                                        Sort by
                                                    </span>
                                                    <span class="selected fs-14 fw-bold">Price: low to high</span>
                                                </span>
                                            </button>
                                        </h2>
                                        <div id="collapseSort-by" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFilter">
                                            <div class="accordion-body">
                                                <?= $listing_fields['sortby'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseNew-Used" aria-expanded="false"
                                                aria-controls="collapseNew-Used">
                                                <span class="accordion-button-inner">
                                                    <span class="icon-text">
                                                        <span class="icon"><?= get__theme_images('new-used.svg') ?></span>
                                                        New-Used
                                                    </span>
                                                    <span class="selected fs-14 fw-bold">Value</span>
                                                </span>
                                            </button>
                                        </h2>
                                        <div id="collapseNew-Used" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFilter">
                                            <div class="accordion-body">
                                                <?= $listing_fields['type'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseBerths" aria-expanded="false"
                                                aria-controls="collapseBerths">
                                                <span class="accordion-button-inner">
                                                    <span class="icon-text">
                                                        <span class="icon"><?= get__theme_images('berths.svg') ?></span> Berths
                                                    </span>
                                                    <span class="selected fs-14 fw-bold">Value</span>
                                                </span>
                                            </button>
                                        </h2>
                                        <div id="collapseBerths" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFilter">
                                            <div class="accordion-body">
                                                <?= $listing_fields['berths'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseMake" aria-expanded="false"
                                                aria-controls="collapseMake">
                                                <span class="accordion-button-inner">
                                                    <span class="icon-text">
                                                        <span class="icon"><?= get__theme_images('make.svg') ?></span> Make
                                                    </span>
                                                    <span class="selected fs-14 fw-bold">Value</span>
                                                </span>
                                            </button>
                                        </h2>
                                        <div id="collapseMake" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFilter">
                                            <div class="accordion-body">
                                                <?= $listing_fields['make'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseModel" aria-expanded="false"
                                                aria-controls="collapseModel">
                                                <span class="accordion-button-inner">
                                                    <span class="icon-text">
                                                        <span class="icon"><?= get__theme_images('model.svg') ?></span> Model
                                                    </span>
                                                    <span class="selected fs-14 fw-bold">Value</span>
                                                </span>
                                            </button>
                                        </h2>
                                        <div id="collapseModel" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFilter">
                                            <div class="accordion-body">
                                                <?= $listing_fields['model'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapsePrice" aria-expanded="false"
                                                aria-controls="collapsePrice">
                                                <span class="accordion-button-inner">
                                                    <span class="icon-text">
                                                        <span class="icon"><?= get__theme_images('price.svg') ?></span> Price
                                                    </span>
                                                    <span class="selected fs-14 fw-bold">Value</span>
                                                </span>
                                            </button>
                                        </h2>
                                        <div id="collapsePrice" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFilter">
                                            <div class="accordion-body">
                                                <?= $listing_fields['type'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseYear" aria-expanded="false"
                                                aria-controls="collapseYear">
                                                <span class="accordion-button-inner">
                                                    <span class="icon-text">
                                                        <span class="icon"><?= get__theme_images('year.svg') ?></span> Year
                                                    </span>
                                                    <span class="selected fs-14 fw-bold">Value</span>
                                                </span>
                                            </button>
                                        </h2>
                                        <div id="collapseYear" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFilter">
                                            <div class="accordion-body">
                                                <?= $listing_fields['type'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseLayout-type" aria-expanded="false"
                                                aria-controls="collapseLayout-type">
                                                <span class="accordion-button-inner">
                                                    <span class="icon-text">
                                                        <span class="icon"><?= get__theme_images('layout-type.svg') ?></span>
                                                        Layout-type
                                                    </span>
                                                    <span class="selected fs-14 fw-bold">Value</span>
                                                </span>
                                            </button>
                                        </h2>
                                        <div id="collapseLayout-type" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFilter">
                                            <div class="accordion-body">
                                                <?= $listing_fields['type'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseWidth" aria-expanded="false"
                                                aria-controls="collapseWidth">
                                                <span class="accordion-button-inner">
                                                    <span class="icon-text">
                                                        <span class="icon"><?= get__theme_images('width.svg') ?></span> Width
                                                    </span>
                                                    <span class="selected fs-14 fw-bold">Value</span>
                                                </span>
                                            </button>
                                        </h2>
                                        <div id="collapseWidth" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFilter">
                                            <div class="accordion-body">
                                                <?= $listing_fields['type'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseAxles" aria-expanded="false"
                                                aria-controls="collapseAxles">
                                                <span class="accordion-button-inner">
                                                    <span class="icon-text">
                                                        <span class="icon"><?= get__theme_images('axles.svg') ?></span> Axles
                                                    </span>
                                                    <span class="selected fs-14 fw-bold">Value</span>
                                                </span>
                                            </button>
                                        </h2>
                                        <div id="collapseAxles" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFilter">
                                            <div class="accordion-body">
                                                <?= $listing_fields['type'] ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="banner mb-20">
                        <?= wp_get_attachment_image(188, 'full') ?>
                    </div>
                    <div class="listings d-flex flex-column" style="--padding: 37%">
                        <div class="listing-item" id="swiper-gallery-1">
                            <?= do_shortcode('[listing_grid_full_details id="gallery-1"]') ?>
                        </div>
                        <div class="listing-item" id="swiper-gallery-2">
                            <?= do_shortcode('[listing_grid_full_details id="gallery-2" style="style-2"]') ?>
                        </div>
                        <div class="listing-item" id="swiper-gallery-3">
                            <?= do_shortcode('[listing_grid_full_details id="gallery-3" style="style-3"]') ?>
                        </div>
                        <div class="listing-item" id="swiper-gallery-4">
                            <?= do_shortcode('[listing_grid_full_details id="gallery-4"]') ?>
                        </div>
                        <div class="listing-item" id="swiper-gallery-5">
                            <?= do_shortcode('[listing_grid_full_details id="gallery-4"]') ?>
                        </div>
                    </div>
                    <div class="banner mt-20">
                        <?= wp_get_attachment_image(191, 'full') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer() ?>