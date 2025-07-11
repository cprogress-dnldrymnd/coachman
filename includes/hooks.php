<?php
add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_tax()) { //for custom post types
        $title = sprintf(__('%1$s'), single_term_title('', false));
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    }
    return $title;
});


add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;

    if ($pagenow === 'edit-comments.php') {
        wp_safe_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});

function action_wp_enqueue_scripts_admin()
{
    wp_enqueue_style('style---admin', theme_dir . 'admin/admin.css');
}
add_action('admin_enqueue_scripts', 'action_wp_enqueue_scripts_admin', 20);




/**
 * Enqueue Editor assets.
 */
function example_enqueue_editor_assets()
{
    wp_enqueue_style('child-style', theme_dir . '/style.css');
}
add_action('enqueue_block_editor_assets', 'example_enqueue_editor_assets');



function custom_post_type_url_from_meta($permalink, $post, $leavename)
{
    // Define your custom post type slug and the meta key for the URL
    $custom_post_type = 'downloads'; // <-- IMPORTANT: Change this to your CPT slug

    // Check if it's our target custom post type
    if ($post->post_type == $custom_post_type) {
        // Get the custom URL from post meta
        $custom_url = wp_get_attachment_url(get__post_meta('file'));

        // If a custom URL exists and is not empty, use it
        if (! empty($custom_url)) {
            return esc_url_raw($custom_url);
        }
    }

    // If no custom URL, return the original permalink
    return $permalink;
}
add_filter('post_type_link', 'custom_post_type_url_from_meta', 10, 3);
