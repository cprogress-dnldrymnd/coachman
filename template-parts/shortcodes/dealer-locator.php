<?php
$dealer_cat = get_terms(array(
    'taxonomy' => 'wpsl_store_category',
    'hide_empty' => false,
));
?>
<div class="swiper swiper-nav-tabs-swiper nav-tabs-swiper overflow-visible sm-margin-bottom nav-tabs-swiper-js">
    <ul class="swiper-wrapper nav nav-tabs  flex-row " id="Dealers-Navigation" role="tablist" aria-live="polite">
        <?php foreach ($dealer_cat as $dealer) { ?>
            <li class="swiper-slide nav-item">
                <a class="nav-link" href="?category=<?= $dealer->slug ?>">
                    <p><?= $dealer->name ?></p>
                </a>
            </li>
        <?php } ?>
    </ul>
</div>