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

$footer = get__theme_option('footer');

?>
<footer class="main-footer">
    <?php echo do_shortcode('[template template_id=' . $footer . ']'); ?>
</footer>
<?php
if (is_page(564)) {
    echo do_shortcode('[modal id=25605]');
    echo do_shortcode('[modal id=25765]');
}




?>

</div><!-- #page -->

<?php wp_footer(); ?>

<?php
get_template_part('template-parts/offcanvas/menu');
?>

</body>

</html>