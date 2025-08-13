<?php
$dealer_cat = get_terms(array(
    'taxonomy' => 'wpsl_store_category',
    'hide_empty' => false,
    'orderby' => 'ID',
));

$category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : 'caravan-dealers';
?>
<div class="dealer--locator--holder">
    <div class="container">
        <div class="swiper swiper-nav-tabs-swiper nav-tabs-swiper overflow-visible sm-margin-bottom nav-tabs-swiper-js">
            <ul class="swiper-wrapper nav nav-tabs  flex-row " id="Dealers-Navigation" role="tablist" aria-live="polite">
                <?php foreach ($dealer_cat as $dealer) { ?>
                    <li class="swiper-slide nav-item">
                        <a class="nav-link <?= $category == $dealer->slug ? 'active' : '' ?>" href="?category=<?= $dealer->slug ?>">
                            <p><?= $dealer->name ?></p>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <div class="dealer--locator">
        <?= do_shortcode('[wpsl template="default" category="' . $category . '"]') ?>
    </div>
</div>

<script>
    jQuery(document).ready(function() {
        jQuery('body').on('click', '.btn-appointment a', function() {
            $dealerName = jQuery(this).parents('.store--listing').find('h4').text();
            $new_text = 'Request an appointment with ' + $dealerName;


            jQuery('.request--appointment--dealer h5').text($new_text);


        });
    });
</script>