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
/**
 * RobertMainThemeClass
 */
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
        add_action('customize_register', [$this, 'customizeSection']);
        add_action('get_the_archive_title', [$this, 'remove_archive_tagtitle'], 1, 1);
        add_action('pre_get_posts', [$this, 'modify_casos_posts_per_page'], 1, 1);

        if (!is_admin()) {
            add_action('wp_enqueue_scripts', [$this, 'enqueueJquery']);
        }
    }

    /**
     * Method mainFunctions
     *
     * @return void
     */
    public function mainFunctions()
    {
        load_theme_textdomain('robertochoa', get_template_directory() . '/languages');
        add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio']);
        add_theme_support('post-thumbnails');
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('menus');
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support(
            'custom-background',
            [
                'default-image' => '',
                'default-color' => 'ffffff',
                'wp-head-callback' => '_custom_background_cb',
                'admin-head-callback' => '',
                'admin-preview-callback' => ''
            ]
        );

        add_theme_support('custom-logo', [
            'height'      => 70,
            'width'       => 57,
            'flex-width'  => false,
            'flex-height' => false,
            'header-text' => ['site-title', 'site-description'],
            'unlink-homepage-logo' => true,
            'class' => 'logo'
        ]);

        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ]);

        register_nav_menus([
            'header_menu' => esc_attr__('Menu Header', 'robertochoa'),
            'footer_menu' => esc_attr__('Menu Footer', 'robertochoa'),
        ]);

        register_sidebars(5, [
            'name'          => esc_attr__('Footer Sidebar %d', 'robertochoa'),
            'id'            => 'footer-sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ]);

        add_image_size('large-thumb', 500, 650, ['center', 'center']);
        add_image_size('mobile-thumb', 670, 380, ['center', 'center']);
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

    /**
     * Method customizeSection
     *
     * @param $wp_customize [object]
     *
     * @return void
     */
    public function customizeSection($wp_customize)
    {
        $wp_customize->add_setting('white_logo');
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'white_logo', [
            'label' => esc_html__('Logo Blanco', 'robertochoa'),
            'section' => 'title_tagline',
            'settings' => 'white_logo',
            'priority' => 8
        ]));

        $wp_customize->add_section('footer', [
            'title'    => esc_html__('Footer', 'robertochoa'),
            'priority' => 10,
        ]);

        $wp_customize->add_setting('footer_copyright');
        $wp_customize->add_control('footer_copyright', [
            'type'     => 'text',
            'label'    => esc_html__('Texto Copyright', 'robertochoa'),
            'section'  => 'footer',
            'settings' => 'footer_copyright'
        ]);
    }

    /**
     * Method remove_archive_tagtitle
     *
     * @param $title string
     *
     * @return void
     */
    public function remove_archive_tagtitle($title)
    {
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
    }

    /**
     * Method modify_casos_posts_per_page
     *
     * @param $query object
     *
     * @return void
     */
    public function modify_casos_posts_per_page($query)
    {
        if (!is_admin() && $query->is_main_query() && is_post_type_archive('casos')) {
            $query->set('posts_per_page', 20);
        }
    }
}

new RobertMainThemeClass();

require_once('includes/wp-helpers.php');
require_once('includes/wp-enqueue-scripts.php');
require_once('includes/wp-enqueue-styles.php');
require_once('includes/wp-metabox-class.php');
require_once('includes/wp-post-type.php');
require_once('includes/wp-nav-walker.php');
require_once('includes/wp-customizer-class.php');
