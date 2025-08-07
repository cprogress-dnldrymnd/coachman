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
    <?php echo do_shortcode('[template template_id=25506]'); ?>
</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

<?php
get_template_part('template-parts/offcanvas/menu');
?>

</body>

</html>