<?php
/*-----------------------------------------------------------------------------------*/
/* Template Name: Listing Inner Page 
/*-----------------------------------------------------------------------------------*/
?>
<?php get_header() ?>
<?php
global $listing_fields;
?>
<div class="site-content listing-inner md-padding-bottom">
  <div class="md-padding-top d-none d-lg-block"></div>
  <section class="listing-inner--main-details overflow-hidden">
    <div class="container">
      <div class="listing-inner-holder md-margin-bottom">
        <div class="row g-4">
          <div class="col-lg-9">
            <div class="listing-inner--left">
              <div class="listing-inner--details d-none d-lg-block mb-4">
                <div class="row g-3 justify-content-between align-items-center mb-1">
                  <div class="col-md-6">
                    <div class="image-box brand">
                      <?= wp_get_attachment_image(190, 'medium') ?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <?= listing__action() ?>
                  </div>
                </div>
                <div class="row g-3 justify-content-between align-items-center">
                  <div class="col-auto">
                    <h1 class="h3">Swift Sprite Quattro FB 2024</h1>
                  </div>
                  <div class="col-auto">
                    <div class="available-now fs-18">Available to view</div>
                  </div>
                </div>

                <div class="row g-3 justify-content-between align-items-center">
                  <div class="col-lg-8">
                    <?php echo listing__price(); ?>
                  </div>
                  <div class="col-lg-4">
                    <?php
                    echo listing__features(true);
                    ?>
                  </div>
                </div>
              </div>
              <div class="listing-inner--tabs xs-margin-bottom border-bottom pb-20">
                <div class="tab-content mb-3" id="listingInner--Tab">
                  <div class="tab-pane fade show active" id="gallery-tab-pane" role="tabpanel"
                    aria-labelledby="gallery-tab" tabindex="0">
                    <div class="row g-xs flex-column-reverse flex-lg-row gallery-row">
                      <div class="col-lg-2">
                        <div class="swiper-gallery-thumbnails">
                          <?php echo listing__gallery('gallery-1', true); ?>
                        </div>
                      </div>
                      <div class="col-lg-10">
                        <div class="listing-inner--gallery-grid-holder position-relative rounded overflow-hidden">
                          <?php echo listing__gallery('gallery-1'); ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="three-sixty-tab-pane" role="tabpanel" aria-labelledby="three-sixty-tab"
                    tabindex="0">
                    <iframe class="w-100" height="500" src="https://www.glossopcaravans.co.uk/images360/shop/" frameborder="0"></iframe>
                  </div>
                  <div class="tab-pane fade" id="video-tab-pane" role="tabpanel" aria-labelledby="video-tab"
                    tabindex="0">
                    <iframe class="rounded overflow-hidden" title="YouTube video player" src="https://www.youtube.com/embed/u6yCMPWOt4Q?autoplay=1&amp;mute=1&amp;loop=1" width="100%" height="600" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
                  </div>
                </div>

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <button class="nav-link active" id="gallery-tab" data-bs-toggle="tab"
                    data-bs-target="#gallery-tab-pane" type="button" role="tab" aria-controls="gallery-tab-pane"
                    aria-selected="true">
                    <span class="icon"><?= get__theme_icons('gallery.svg') ?></span> Gallery
                  </button>
                  <button class="nav-link" id="three-sixty-tab" data-bs-toggle="tab"
                    data-bs-target="#three-sixty-tab-pane" type="button" role="tab"
                    aria-controls="three-sixty-tab-pane" aria-selected="false">
                    <span class="icon"><?= get__theme_icons('360.svg') ?></span> 360° TOUR
                  </button>
                  <button class="nav-link" id="video-tab" data-bs-toggle="tab" data-bs-target="#video-tab-pane"
                    type="button" role="tab" aria-controls="video-tab-pane" aria-selected="false">
                    <span class="icon"><?= get__theme_icons('video.svg') ?></span> Video
                  </button>
                </ul>
              </div>
              <div class="listing--details-mobile d-block d-lg-none">
                <div class="image-box brand mb-3">
                  <?= wp_get_attachment_image(190, 'medium') ?>
                </div>
                <h2 class="heading mb-0">Swift Sprite Quattro FB 2024</h2>
              </div>
              <div class="listing-key--info">
                <h4 class="fs-35 heading mb-3 mb-lg-4">Key Information</h4>
                <?php
                echo listing__key_information_v2();
                ?>
                <div class="awning-image image-box border-bottom xs-margin-bottom">
                  <span class="fw-semibold">Floor Plan</span>
                  <?= wp_get_attachment_image(189, 'large') ?>
                </div>
              </div>
              <div class="listing-inner--description xs-margin-bottom">
                <h4 class="fs-35 heading mb-3 mb-lg-4">Description</h4>
                <div class="desc">
                  <p>The Swift Challenger 530 2008 is a practical and family-friendly caravan, offering a flexible
                    4-berth
                    layout and a spacious separate end washroom. Designed with comfort and functionality in mind, it's
                    ideal for couples or small families who value a well-organised living space.</p>
                  <p><a href="#" class="fw-semibold read-more-button">Read more</a></p>
                  <div class="d-none read-more-content">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas quibusdam, consequatur nihil mollitia eum sint adipisci esse recusandae nulla, quidem, porro placeat accusantium voluptatibus maxime praesentium earum in? Beatae, sint!</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas quibusdam, consequatur nihil mollitia eum sint adipisci esse recusandae nulla, quidem, porro placeat accusantium voluptatibus maxime praesentium earum in? Beatae, sint!</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas quibusdam, consequatur nihil mollitia eum sint adipisci esse recusandae nulla, quidem, porro placeat accusantium voluptatibus maxime praesentium earum in? Beatae, sint!</p>
                  </div>
                </div>
              </div>
              <div class="listing-inner--specifications md-margin-bottom">
                <h4 class="fs-35 headingmb-3 mb-lg-4">Specification and Features</h4>
                <div class="listing-filter accordion-style-1">
                  <div class="accordion rounded border overflow-hidden" id="accordionSpecs">
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                          data-bs-target="#collapseInterior" aria-expanded="false" aria-controls="collapseInterior">
                          <span class="accordion-button-inner">
                            <span class="icon-text">
                              <span class="icon"><?= get__theme_icons('berths.svg') ?></span>
                              Interior Features
                            </span>
                          </span>
                        </button>
                      </h2>
                      <div id="collapseInterior" class="accordion-collapse collapse" data-bs-parent="#accordionSpecs">
                        <div class="accordion-body">
                          <ul>
                            <li>Ut velit odio totam illo</li>
                            <li>Ut velit odio totam illo</li>
                            <li>Ut velit odio totam illo</li>
                            <li>Ut velit odio totam illo</li>
                            <li>Ut velit odio totam illo</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                          data-bs-target="#collapseExterior" aria-expanded="false" aria-controls="collapseExterior">
                          <span class="accordion-button-inner">
                            <span class="icon-text">
                              <span class="icon"><?= get__theme_icons('caravan.svg') ?></span>
                              Exterior Features
                            </span>
                          </span>
                        </button>
                      </h2>
                      <div id="collapseExterior" class="accordion-collapse collapse" data-bs-parent="#accordionSpecs">
                        <div class="accordion-body">
                          <ul>
                            <li>Ut velit odio totam illo</li>
                            <li>Ut velit odio totam illo</li>
                            <li>Ut velit odio totam illo</li>
                            <li>Ut velit odio totam illo</li>
                            <li>Ut velit odio totam illo</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                          data-bs-target="#collapseWarranty" aria-expanded="false" aria-controls="collapseWarranty">
                          <span class="accordion-button-inner">
                            <span class="icon-text">
                              <span class="icon"><?= get__theme_icons('warranty.svg') ?></span>
                              Warranty
                            </span>
                          </span>
                        </button>
                      </h2>
                      <div id="collapseWarranty" class="accordion-collapse collapse" data-bs-parent="#accordionSpecs">
                        <div class="accordion-body">
                          <ul>
                            <li>Ut velit odio totam illo</li>
                            <li>Ut velit odio totam illo</li>
                            <li>Ut velit odio totam illo</li>
                            <li>Ut velit odio totam illo</li>
                            <li>Ut velit odio totam illo</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="calculator-form">
                <div class="calculator-form-inner background-lightgray-3 p-5 rounded">
                  <h3>What can I tow?</h3>
                  <div class="desc mb-5">
                    <p>Use our calculator to find out your maximum towing capacity.</p>
                  </div>
                  <form action="">
                    <div class="row g-3 align-items-end">
                      <div class="col-lg-9">
                        <?php
                        echo form_control(array(
                          'type'        => 'text',
                          'name'        => 'registration',
                          'id'          => 'registration',
                          'label'       => 'Enter registration number',
                          'class'       => 'form-control-lg',
                          'placeholder' => 'E.G. PN24 MVS'
                        ));
                        ?>
                      </div>
                      <div class="col-lg-3">
                        <div class="button-box">
                          <button type="submit" class="btn btn-secondary btn-lg w-100">Calculate</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 d-none d-lg-block">
            <div class="listing-inner--right sticky-element">
              <div class="cta cta--finance-calculator mb-4">
                <div class="cta--iner p-20 rounded box-shadow">
                  <h3 class="fs-32">Finance calculator</h3>
                  <div class="desc mb-20">
                    <p>7.9% available, calculate the cost of your caravan or motorhome</p>
                  </div>
                  <div class="button-box mb-20">
                    <a class="btn btn-yellow w-100" data-bs-toggle="offcanvas" href="#offcanvasFinanceCalculator" role="button" aria-controls="offcanvasFinanceCalculator">View calculator</a>
                  </div>
                  <div class="button-box mb-20">
                    <a class="btn btn-primary w-100" data-bs-toggle="offcanvas" href="#offcanvasFinanceCalculator" role="button" aria-controls="offcanvasFinanceCalculator">Apply for Finance</a>
                  </div>
                  <div class="image-box">
                    <?= wp_get_attachment_image(194, 'medium') ?>
                  </div>
                </div>
              </div>

              <div class="cta cta--reserve mb-4">
                <div class="cta--iner p-20 rounded box-shadow">
                  <h3 class="fs-32">Reserve online</h3>
                  <div class="desc mb-20">
                    <p>Interested in this caravan? Reserve online and temporarily remove from sale</p>
                  </div>
                  <div class="button-box">
                    <a class="btn btn-primary w-100" data-bs-toggle="offcanvas" href="#offcanvasReserveForm" role="button" aria-controls="offcanvasReserveForm">Reserve now</a>
                  </div>
                </div>
              </div>

              <div class="cta cta--contact-information">
                <div class="cta--iner p-20 rounded box-shadow">
                  <h3 class="fs-32">Contact information</h3>
                  <ul class="icon-list mb-0 icon-list-v3 d-flex flex-column list-inline  flex-wrap">
                    <li>
                      <?= get__theme_icons(file_name: 'phone.svg') ?>
                      <span><a href="tel:01457 868 011">01457 868 011</a></span>
                    </li>
                    <li>
                      <?= get__theme_icons('whatsapp.svg') ?>
                      <span><a href="tel:07525 491 913">07525 491 913</a></span>
                    </li>
                    <li>
                      <?= get__theme_icons('location.svg') ?>
                      <span><a href="#">Location</a></span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="listing-inner--mobile-sticky d-block d-lg-none position-sticky bottom-0 background-white p-20">
    <div class="container">
      <div class="row g-xs align-items-center">
        <div class="col-7">
          <?= listing__price(false) ?>
        </div>
        <div class="col-5">
          <a class="btn btn-primary w-100" data-bs-toggle="offcanvas" href="#offcanvasReserveForm" role="button" aria-controls="offcanvasReserveForm">Reserve now</a>
        </div>
      </div>
    </div>
  </section>

  <section class="listine-inner--related overflow-hidden pt-5 p5-lg-0">
    <div class="container">
      <h2 class="sm-margin-bottom">You may also like</h2>
      <div class="swiper-holder">
        <div class="swiper swiper-listing">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <?= do_shortcode('[listing_grid image_id="195" style="style-2"]') ?>
            </div>
            <div class="swiper-slide">
              <?= do_shortcode('[listing_grid image_id="195" style="style-2"]') ?>
            </div>
            <div class="swiper-slide">
              <?= do_shortcode('[listing_grid image_id="195" style="style-2"]') ?>
            </div>
            <div class="swiper-slide">
              <?= do_shortcode('[listing_grid image_id="195" style="style-2"]') ?>
            </div>
            <div class="swiper-slide">
              <?= do_shortcode('[listing_grid image_id="195" style="style-2"]') ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>

<?php get_footer() ?>