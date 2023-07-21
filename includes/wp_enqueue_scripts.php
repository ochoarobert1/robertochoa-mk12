<?php
if (!defined('ABSPATH')) {
    die('Invalid request.');
}

function robertochoa_load_scripts()
{
    $version_remove = NULL;
    if (!is_admin()) {
        if ($_SERVER['REMOTE_ADDR'] == '::1') {

            /*- BOOTSTRAP ON LOCAL  -*/
            //wp_register_script('bootstrap-bundle', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array('jquery'), '4.5.3', true);
            //wp_enqueue_script('bootstrap-bundle');

            /*- JQUERY STICKY ON LOCAL  -*/
            //wp_register_script('sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array('jquery'), '1.0.4', true);
            //wp_enqueue_script('sticky');

            /*- LETTERING  -*/
            //wp_register_script('lettering', get_template_directory_uri() . '/js/jquery.lettering.js', array('jquery'), '0.7.0', true);
            //wp_enqueue_script('lettering');

            /*- AOS ON LOCAL -*/
            //wp_register_script('aos-js', get_template_directory_uri() . '/js/aos.js', array('jquery'), '3.0.0', true);
            //wp_enqueue_script('aos-js');

        } else {

            /*- BOOTSTRAP -*/
            //wp_register_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js', array('jquery'), '4.5.3', true);
            //wp_enqueue_script('bootstrap');

            /*- JQUERY STICKY -*/
            //wp_register_script('sticky', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.min.js', array('jquery'), '1.0.4', true);
            //wp_enqueue_script('sticky');

            /*- LETTERING  -*/
            //wp_register_script('lettering', 'https://cdnjs.cloudflare.com/ajax/libs/lettering.js/0.7.0/jquery.lettering.min.js', array('jquery'), '0.7.0', true);
            //wp_enqueue_script('lettering');

            /*- AOS -*/
            //wp_register_script('aos-js', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js', array('jquery'), '2.3.4', true);
            //wp_enqueue_script('aos-js');

        }

        /*- SWIPER JS -*/
        wp_register_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js', array(), '10.0.4', true);
        wp_enqueue_script('swiper-js');

        /*- MAIN FUNCTIONS -*/
        //wp_register_script('fontawesome', 'https://kit.fontawesome.com/23f130f841.js', array(), $version_remove, true);
        //wp_enqueue_script('fontawesome');

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
