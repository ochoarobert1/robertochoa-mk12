<?php

/**
 * WP Enqueue Styles
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (!defined('ABSPATH')) {
    die('Invalid request.');
}

/**
 * Method ro_load_styles
 *
 * @return void
 */
function ro_load_styles()
{
    $version_remove = null;
    if (!is_admin()) {
        //wp_register_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap', false, $version_remove, 'all');
        //wp_enqueue_style('google-fonts');

        wp_register_style('tw-style', get_template_directory_uri() . '/dist/styles.css', false, $version_remove, 'all');
        wp_enqueue_style('tw-style');
        /*
        wp_register_style('main-style', get_template_directory_uri() . '/css/robertochoa-style.css', false, $version_remove, 'all');
        wp_enqueue_style('main-style');

        wp_register_style('main-mediaqueries', get_template_directory_uri() . '/css/robertochoa-mediaqueries.css', false, $version_remove, 'all');
        wp_enqueue_style('main-mediaqueries');
*/
        //wp_register_style('wp-initial-style', get_template_directory_uri() . '/style.css', false, $version_remove, 'all');
        //wp_enqueue_style('wp-initial-style');
    }
}

add_action('wp_enqueue_scripts', 'ro_load_styles', 1);
