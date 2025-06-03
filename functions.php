<?php
/*-----------------------------------------------------------------------------------*/
/* Define the version so we can easily replace it throughout the theme
/*-----------------------------------------------------------------------------------*/
define('version', 1);
define('theme_dir', get_template_directory_uri() . '/');
define('assets_dir', theme_dir . 'assets/');
define('image_dir', assets_dir . 'images/');
define('vendor_dir', assets_dir . 'vendors/');

/*-----------------------------------------------------------------------------------*/
/* After Theme Setup
/*-----------------------------------------------------------------------------------*/

function action_after_setup_theme()
{
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'action_after_setup_theme');

function action_wp_enqueue_scripts()
{
    wp_enqueue_style('fancybox', vendor_dir . 'fancybox/css/fancybox.css');
    wp_enqueue_style('style', theme_dir . 'style.css');

    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap', vendor_dir . 'bootstrap/dist/js/bootstrap.min.js');
    wp_enqueue_script('swiper', vendor_dir . 'swiper/js/swiper-bundle.min.js');
    wp_enqueue_script('fancybox', vendor_dir . 'fancybox/js/fancybox.umd.js');
    wp_enqueue_script('main', assets_dir . 'javascripts/main.js');
}
add_action('wp_enqueue_scripts', 'action_wp_enqueue_scripts', 20);

/*-----------------------------------------------------------------------------------*/
/* Register Carbofields
/*-----------------------------------------------------------------------------------*/
add_action('carbon_fields_register_fields', 'tissue_paper_register_custom_fields');
function tissue_paper_register_custom_fields()
{
    require_once('includes/post-meta.php');
}
function get__post_meta($value)
{
    return get_post_meta(get_the_ID(), '_' . $value, true);
}

function get__term_meta($term_id, $value)
{
    return get_term_meta($term_id, '_' . $value, true);
}

function get__post_meta_by_id($id, $value)
{
    return get_post_meta($id, '_' . $value, true);
}
function get__theme_option($value)
{
    return get_option('_' . $value);
}

function arrayKeyStartsWith($array, $prefix)
{
    $matchingKeys = [];
    foreach ($array as $key => $value) {
        if (strpos($key, $prefix) === 0) {
            $matchingKeys[$key] = $value;
        }
    }
    return $matchingKeys;
}

require_once('includes/bootstrap-navwalker.php');
require_once('includes/customizer.php');
require_once('includes/menus.php');
require_once('includes/theme-widgets.php');
require_once('includes/post-types.php');
require_once('includes/shortcodes.php');
require_once('includes/custom-functions.php');
require_once('includes/listing-functions.php');
require_once('includes/hooks.php');


function template($atts)
{
    extract(
        shortcode_atts(
            array(
                'template_id' => '',
            ),
            $atts
        )
    );

    $style = '<style type="text/css" data-type="vc_shortcodes-custom-css"> ' . get_post_meta($template_id, '_wpb_shortcodes_custom_css', true) . ' </style>';

    $content_post = get_post($template_id);
    $content = $content_post->post_content;
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);

    return $style . $content;
}

add_shortcode('template', 'template');
