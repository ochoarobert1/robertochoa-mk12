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
    $webhook_data = get_option('ro_webhook_data');
    $version_remove = null;
    if (!is_admin()) {
        wp_register_script('main-functions', get_template_directory_uri() . '/dist/functions.js', [], $version_remove, true);
        wp_enqueue_script('main-functions');

        wp_register_script('lottie-functions', 'https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js', [], $version_remove, true);
        wp_enqueue_script('lottie-functions');

        wp_localize_script('main-functions', 'custom_admin_url', array(
            'ajax_url'          => admin_url('admin-ajax.php'),
            'error_nombre'      => __('Error: El nombre no puede estar vacio.', 'balearic'),
            'invalid_nombre'    => __('Error: El nombre no es válido.', 'balearic'),
            'error_phone'       => __('Error: El teléfono no puede estar vacio.', 'balearic'),
            'invalid_phone'     => __('Error: El teléfono no es válido.', 'balearic'),
            'error_email'       => __('Error: El correo no puede estar vacio.', 'balearic'),
            'invalid_email'     => __('Error: El correo no es válido.', 'balearic'),
            'discord_webhook'   => esc_url($webhook_data['discord_webhook'])
        ));

        if (is_single('post') && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        } else {
            wp_deregister_script('comment-reply');
        }
    }
}

add_action('wp_enqueue_scripts', 'ro_load_scripts', 1);
