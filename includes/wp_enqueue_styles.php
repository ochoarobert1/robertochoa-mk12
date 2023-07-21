<?php

if (!defined('ABSPATH')) {
    die('Invalid request.');
}

function robertochoa_load_styles()
{
    $version_remove = null;
    if (!is_admin()) {
        if ($_SERVER['REMOTE_ADDR'] == '::1') {

            /*- ANIMATE CSS ON LOCAL -*/
            //wp_register_style('animate-css', get_template_directory_uri() . '/css/animate.min.css', false, '4.1.1', 'all');
            //wp_enqueue_style('animate-css');

            /*- FONT AWESOME ON LOCAL -*/
            //wp_register_style('fontawesome-css', get_template_directory_uri() . '/css/font-awesome.min.css', false, '4.7.0', 'media');
            //wp_enqueue_style('fontawesome-css');

            /*- AOS ON LOCAL -*/
            //wp_register_style('aos-css', get_template_directory_uri() . '/css/aos.css', false, '3.0.0', 'all');
            //wp_enqueue_style('aos-css');
        } else {

            /*- ANIMATE CSS -*/
            //wp_register_style('animate-css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css', false, '4.1.1', 'all');
            //wp_enqueue_style('animate-css');

            /*- FONT AWESOME -*/
            //wp_register_style('fontawesome-css', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', false, '4.7.0', 'all');
            //wp_enqueue_style('fontawesome-css');

            /*- AOS -*/
            //wp_register_style('aos-css', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css', false, '2.3.4', 'all');
            //wp_enqueue_style('aos-css');
        }
      

        /*- SWIPER JS -*/
        if (is_front_page()) {
            //wp_register_style('swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css', false, '7.0.5', 'all');
            //wp_enqueue_style('swiper-css');
        }

        /*- GOOGLE FONTS -*/
        wp_register_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap', false, $version_remove, 'all');
        wp_enqueue_style('google-fonts');

        /*- MAIN STYLE -*/
        wp_register_style('main-style', get_template_directory_uri() . '/css/robertochoa-style.css', false, $version_remove, 'all');
        wp_enqueue_style('main-style');

        /*- MAIN MEDIAQUERIES -*/
        wp_register_style('main-mediaqueries', get_template_directory_uri() . '/css/robertochoa-mediaqueries.css',false, $version_remove, 'all');
        wp_enqueue_style('main-mediaqueries');

        /*- WORDPRESS STYLE -*/
        //wp_register_style('wp-initial-style', get_template_directory_uri() . '/style.css', false, $version_remove, 'all');
        //wp_enqueue_style('wp-initial-style');
    }
}

add_action('wp_enqueue_scripts', 'robertochoa_load_styles', 1);