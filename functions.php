<?php

/**
 * Main Functions and class for theme
 *
 * @package    robertochoa-mk12-theme
 * @subpackage robertochoa-mk12-theme
 * @author     Robert Ochoa <ochoa.robert1@gmail.com>
 */

if (!defined('ABSPATH')) {
    exit;
}
class RobertMainThemeClass
{
    /**
     * Method __construct
     *
     * @return void
     */
    public function __construct()
    {
        add_action('init', [$this, 'mainFunctions']);
        add_action('do_feed', [$this, 'disableFeed'], 1);
        add_action('do_feed_rdf', [$this, 'disableFeed'], 1);
        add_action('do_feed_rss', [$this, 'disableFeed'], 1);
        add_action('do_feed_rss2', [$this, 'disableFeed'], 1);
        add_action('do_feed_atom', [$this, 'disableFeed'], 1);
        add_filter('upload_mimes', [$this, 'addMimeTypes']);

        if (!is_admin()) {
            add_action('wp_enqueue_scripts', [$this, 'enqueueJquery']);
        }
    }

    /**
     * Method main_functions
     *
     * @return void
     */
    public function mainFunctions()
    {
        load_theme_textdomain('robertochoa', get_template_directory() . '/languages');
        add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio'));
        add_theme_support('post-thumbnails');
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('menus');
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support(
            'custom-background',
            array(
                'default-image' => '',
                'default-color' => 'ffffff',
                'wp-head-callback' => '_custom_background_cb',
                'admin-head-callback' => '',
                'admin-preview-callback' => ''
            )
        );

        add_theme_support('custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ));

        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        register_nav_menus(array(
            'header_menu' => esc_attr__('Menu Header', 'robertochoa'),
            'footer_menu' => esc_attr__('Menu Footer', 'robertochoa'),
        ));
    }

    /**
     * Method disableFeed
     * DISABLE WORDPRESS RSS FEEDS
     *
     * @return void
     */
    public function disableFeed()
    {
        wp_die(esc_html__('No hay RSS Feeds disponibles', 'robertochoa'));
    }

    /**
     * Method enqueueJquery
     *
     * @return void
     */
    public function enqueueJquery()
    {
        if (!is_user_logged_in()) {
            wp_deregister_script('jquery');
            wp_deregister_script('jquery-migrate');
        }
        wp_deregister_script('wp-embed');
        wp_deregister_script('wp-emoji');
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        wp_dequeue_style('wp-block-library');
        remove_action('wp_print_styles', 'print_emoji_styles');
    }

    /**
     * Method addMimeTypes
     *
     * @param $mimes $mimes [array]
     *
     * @return void
     */
    public function addMimeTypes($mimes)
    {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }
}

new RobertMainThemeClass();

/**
 * Method phone_formatter
 *
 * @param $phone $phone [string]
 *
 * @return void
 */
function phoneFormatter($phone)
{
    $formatted_number = preg_replace("[^0-9]", "", $phone);
    $formatted_number = substr($formatted_number, 0, 3) . '-' . substr($formatted_number, 3, 3) . '-' . substr($formatted_number, 6);
    return $formatted_number;
}

/**
 * Method email_formatter
 *
 * @param $email $email [string]
 *
 * @return void
 */
function emailFormatter($email)
{
    $formatted_email = str_replace('@', '[at]', $email);
    return $formatted_email;
}

require_once('includes/wp-enqueue-scripts.php');
require_once('includes/wp-enqueue-styles.php');
require_once('includes/wp-metabox-class.php');
require_once('includes/wp-post-type.php');
require_once('includes/wp-nav-walker.php');
require_once('includes/wp-customizer-class.php');
