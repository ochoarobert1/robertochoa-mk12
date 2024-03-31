<?php

if (!defined('ABSPATH')) {
    die('Invalid request.');
}

function robertochoa_load_styles()
{
    $version_remove = null;
    if (!is_admin()) {
        /*- GOOGLE FONTS -*/
        wp_register_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap', false, $version_remove, 'all');
        wp_enqueue_style('google-fonts');

        /*- MAIN STYLE -*/
        wp_register_style('main-style', get_template_directory_uri() . '/css/robertochoa-style.css', false, $version_remove, 'all');
        wp_enqueue_style('main-style');

        /*- MAIN MEDIAQUERIES -*/
        wp_register_style('main-mediaqueries', get_template_directory_uri() . '/css/robertochoa-mediaqueries.css', false, $version_remove, 'all');
        wp_enqueue_style('main-mediaqueries');

        /*- WORDPRESS STYLE -*/
        //wp_register_style('wp-initial-style', get_template_directory_uri() . '/style.css', false, $version_remove, 'all');
        //wp_enqueue_style('wp-initial-style');
    }
}

add_action('wp_enqueue_scripts', 'robertochoa_load_styles', 1);
