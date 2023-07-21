<?php

/* --------------------------------------------------------------
    ADD THEME SUPPORT
-------------------------------------------------------------- */
class RobertMainThemeClass
{
    public function __construct()
    {
        add_action('init', [$this, 'main_functions']);
        add_action('do_feed', [$this, 'robertochoa_disable_feed'], 1);
        add_action('do_feed_rdf', [$this, 'robertochoa_disable_feed'], 1);
        add_action('do_feed_rss', [$this, 'robertochoa_disable_feed'], 1);
        add_action('do_feed_rss2', [$this, 'robertochoa_disable_feed'], 1);
        add_action('do_feed_atom', [$this, 'robertochoa_disable_feed'], 1);

        add_filter('upload_mimes', [$this, 'cc_mime_types']);

        if (!is_admin()) {
            add_action('wp_enqueue_scripts', [$this, 'robertochoa_enqueue_jquery']);
        }
    }

    public function main_functions()
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
            'header_menu' => __('Menu Header', 'robertochoa'),
            'footer_menu' => __('Menu Footer', 'robertochoa'),
        ));
    }

    /* DISABLE WORDPRESS RSS FEEDS */
    public function robertochoa_disable_feed()
    {
        wp_die(__('No hay RSS Feeds disponibles', 'robertochoa'));
    }

    public function robertochoa_enqueue_jquery()
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

    public function cc_mime_types($mimes)
    {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }
}

new RobertMainThemeClass;

require_once('includes/wp_enqueue_scripts.php');
require_once('includes/wp_enqueue_styles.php');
require_once('includes/wp_metabox_class.php');
require_once('includes/wp_post_type.php');
require_once('includes/wp_nav_walker.php');
