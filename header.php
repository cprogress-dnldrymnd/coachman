<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 *
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>
        <?php bloginfo('name'); // show the blog name, from settings 
        ?> |
        <?php is_front_page() ? bloginfo('description') : wp_title(''); // if we're on the home page, show the description, from the site's settings - otherwise, show the title of the post or page 
        ?>
    </title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php
    $header_style = get__post_meta('header_style');
    $header_style_val =  $header_style ? $header_style : 'header-default';
    ?>
    <header id="masthead" class="site-header <?= $header_style_val ?>" role="banner">
        <?php
        echo do_shortcode('[template template_id=395]');
        ?>
    </header>
    <main id="main" class="main-content" role="main">