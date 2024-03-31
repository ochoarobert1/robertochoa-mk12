<?php

if (!defined('ABSPATH')) {
    die('Invalid request.');
}

function robertochoa_load_scripts()
{
    $version_remove = null;
    if (!is_admin()) {
        /*- MAIN FUNCTIONS -*/
        wp_register_script('main-functions', get_template_directory_uri() . '/js/functions.min.js', array('swiper-js'), $version_remove, true);
        wp_enqueue_script('main-functions');

        /*- MAIN FUNCTIONS -*/
        wp_register_script('lottie-functions', 'https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js', array(), $version_remove, true);
        wp_enqueue_script('lottie-functions');

        /* LOCALIZE MAIN SHORTCODE SCRIPT */
        wp_localize_script('main-functions', 'custom_admin_url', array(
            'ajax_url' => admin_url('admin-ajax.php')
        ));

        /*- WOOCOMMERCE OVERRIDES -*/
        if (class_exists('WooCommerce')) {
            wp_register_script('main-woocommerce-functions', get_template_directory_uri() . '/js/robertochoa-woocommerce.js', array('main-functions'), $version_remove, true);
            wp_enqueue_script('main-woocommerce-functions');
        }

        if (is_single('post') && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        } else {
            wp_deregister_script('comment-reply');
        }
    }
}

add_action('wp_enqueue_scripts', 'robertochoa_load_scripts', 1);
