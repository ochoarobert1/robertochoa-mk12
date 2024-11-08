<?php

/**
 * CMB2 Custom Metaboxes
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (! defined('ABSPATH')) {
    exit;
}

if (!class_exists('ROMetaboxesClass')) {
    class ROMetaboxesClass
    {
        const PREFIX = 'ro_';

        /**
         * Main Constructor.
         */
        public function __construct()
        {
            add_filter('cmb2_show_on', [$this, 'ed_metabox_include_front_page'], 10, 2);
            add_filter('cmb2_show_on', [$this, 'be_metabox_show_on_slug'], 10, 2);
        }

        /**
         * Include custom 'show_on' for Front Page
         */
        public function ed_metabox_include_front_page($display, $meta_box)
        {
            // phpcs:disable WordPress.Security.NonceVerification.Missing
            if (!isset($meta_box['show_on']['key'])) {
                return $display;
            }

            if ('front-page' !== $meta_box['show_on']['key']) {
                return $display;
            }

            $post_id = 0;

            // If we're showing it based on ID, get the current ID
            if (isset($_GET['post'])) {
                $post_id = $_GET['post'];
            } elseif (isset($_POST['post_ID'])) {
                $post_id = $_POST['post_ID'];
            }

            if (!$post_id) {
                return false;
            }

            // Get ID of page set as front page, 0 if there isn't one
            $front_page = get_option('page_on_front');

            // there is a front page set and we're on it!
            return $post_id == $front_page;
            // phpcs:enable WordPress.Security.NonceVerification.Missing
        }

        /**
         * Include custom 'show_on' for Page Slug
         */
        public function be_metabox_show_on_slug($display, $meta_box)
        {
            // phpcs:disable WordPress.Security.NonceVerification.Missing
            if (!isset($meta_box['show_on']['key'], $meta_box['show_on']['value'])) {
                return $display;
            }

            if ('slug' !== $meta_box['show_on']['key']) {
                return $display;
            }

            $post_id = 0;

            // If we're showing it based on ID, get the current ID
            if (isset($_GET['post'])) {
                $post_id = $_GET['post'];
            } elseif (isset($_POST['post_ID'])) {
                $post_id = $_POST['post_ID'];
            }

            if (!$post_id) {
                return $display;
            }

            $slug = get_post($post_id)->post_name;

            // See if there's a match
            return in_array($slug, (array) $meta_box['show_on']['value']);
            // phpcs:enable WordPress.Security.NonceVerification.Missing
        }
    }
}

new ROMetaboxesClass();

/**
 * Method cmb2_autoload_class
 * Autoloader of Metabox Child Classes
 *
 * @param string $directory
 *
 * @return void
 */
function cmb2_autoload_class($directory)
{
    $scan = scandir($directory);
    unset($scan[0], $scan[1]);
    foreach ($scan as $file) {
        if (is_dir($directory . "/" . $file)) {
            cmb2_autoload_class($directory . "/" . $file);
        } else {
            if (strpos($file, '.php') !== false) {
                require_once($directory . "/" . $file);
            }
        }
    }
}

cmb2_autoload_class(dirname(__FILE__) . '/metaboxes');
