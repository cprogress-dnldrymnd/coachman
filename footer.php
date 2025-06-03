<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package orca
 */


?>
<footer class="main-footer">
    <?php echo do_shortcode('[template template_id=136]'); ?>
</footer>

<footer id="site-footer" class="site-footer background-primary py-3 d-none">

    <div class="container">
        <div class="row gy-3">
            <div class="col-12 color-white">
                <?= do_shortcode('[breadcrumbs hide_title="true"]') ?>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-12">
                <div class="row gy-3">
                    <?php if (is_active_sidebar('footer_left')) { ?>
                        <div class="col-lg-4">
                            <div class="footer-left-holder footer-widget">
                                <?php dynamic_sidebar('footer_left') ?>
                            </div>
                        </div>
                        <div class="col-12 d-block d-lg-none">
                            <hr>
                        </div>
                    <?php } ?>
                    <div class="col-lg-8">
                        <div class="row gy-3">
                            <?php if (is_active_sidebar('footer_column_1')) { ?>
                                <div class="col-md-4">
                                    <div class="footer-right-holder footer-widget">
                                        <?php dynamic_sidebar('footer_column_1') ?>
                                    </div>
                                </div>
                                <div class="col-12 d-block d-lg-none">
                                    <hr>
                                </div>
                            <?php } ?>
                            <?php if (is_active_sidebar('footer_column_2')) { ?>
                                <div class="col-md-4">
                                    <div class="footer-right-holder footer-widget">
                                        <?php dynamic_sidebar('footer_column_2') ?>
                                    </div>
                                </div>
                                <div class="col-12 d-block d-lg-none">
                                    <hr>
                                </div>
                            <?php } ?>
                            <?php if (is_active_sidebar('footer_column_3')) { ?>
                                <div class="col-md-4">
                                    <div class="footer-right-holder footer-widget">
                                        <?php dynamic_sidebar('footer_column_3') ?>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>
                            <?php } ?>

                            <div class="col-12">
                                <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'footer-menu',
                                    'container'      => false,
                                    'menu_class'     => '',
                                    'fallback_cb'    => '__return_false',
                                    'items_wrap'     => '<ul id="%1$s" class="menu" >%3$s</ul>',
                                    'depth'          => 2,
                                ));
                                ?>


                            </div>

                            <div class="col-12">
                                <hr>
                            </div>

                            <?php if (is_active_sidebar('footer_bottom')) { ?>
                                <div class="col-12">
                                    <div class="footer-bottom-holder">
                                        <?php dynamic_sidebar('footer_bottom') ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</footer>
<div class="backdrop"></div>
<div class="d-none">
    <?= do_shortcode('[template template_id=1719]') ?>
    <?= do_shortcode('[template template_id=1602]') ?>
    <?= do_shortcode('[template template_id=1618]') ?>
</div>
</div><!-- #page -->

<?php wp_footer(); ?>

<?php
get_template_part('template-parts/offcanvas/finance-calculator');
get_template_part('template-parts/offcanvas/reserve-form');
?>

<script>
    jQuery(document).ready(function() {
        if (window.innerWidth > 991) {
            jQuery('#Motorhomes-Submenu').appendTo('.Motorhomes-Submenu');
            jQuery('#Caravans-Submenu').appendTo('.Caravans-Submenu');
            jQuery('#Export-Submenu').appendTo('.Export-Submenu');
        }
    });
</script>
</body>

</html>