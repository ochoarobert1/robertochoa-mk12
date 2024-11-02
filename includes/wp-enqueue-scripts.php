<?php

/**
 * WP Enqueue Scripts
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (!defined('ABSPATH')) {
    die('Invalid request.');
}

/**
 * Method ro_load_scripts
 *
 * @return void
 */
function ro_load_scripts()
{
    $version_remove = null;
    if (!is_admin()) {
        wp_register_script('main-functions', get_template_directory_uri() . '/js/functions.js', [], $version_remove, true);
        wp_enqueue_script('main-functions');

        wp_register_script('lottie-functions', 'https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js', [], $version_remove, true);
        wp_enqueue_script('lottie-functions');

        wp_localize_script('main-functions', 'custom_admin_url', [
            'ajax_url' => admin_url('admin-ajax.php')
        ]);

        if (is_single('post') && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        } else {
            wp_deregister_script('comment-reply');
        }
    }
}

add_action('wp_enqueue_scripts', 'ro_load_scripts', 1);
