<?php

/**
 * WP Helpers
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (! defined('ABSPATH')) {
    exit;
}

/**
 * Method phoneFormatter
 *
 * @param $phone [string]
 *
 * @return [string]
 */
function phoneFormatter($phone)
{
    $formatted_number = preg_replace("[^0-9]", "", $phone);
    $formatted_number = substr($formatted_number, 0, 3) . '-' . substr($formatted_number, 3, 3) . '-' . substr($formatted_number, 6);
    return $formatted_number;
}

/**
 * Method emailFormatter
 *
 * @param $email [string]
 *
 * @return [string]
 */
function emailFormatter($email)
{
    $formatted_email = str_replace('@', '[at]', $email);
    return $formatted_email;
}

/**
 * Method ro_meta_value
 *
 * @param $meta_name [string]
 *
 * @return [string|array]
 */
function ro_meta_value($meta_name)
{
    $result = get_post_meta(get_the_ID(), $meta_name, true);
    return $result;
}

/**
 * Method get_small_description
 *
 * @param $post_id $post_id [explicite description]
 *
 * @return void
 */
function get_small_description($post_id)
{
    $post = get_post($post_id);
    $excerpt = $post->post_excerpt;

    if (empty($excerpt)) {
        $excerpt = strip_tags($post->post_content);
        $excerpt = strip_shortcodes($excerpt);
        $excerpt = preg_replace('/\s+/', ' ', $excerpt);
        $excerpt = substr($excerpt, 0, 160);
        $excerpt = trim($excerpt);

        if (strlen($excerpt) > 157) {
            $excerpt = substr($excerpt, 0, 157) . '...';
        }
    }

    return $excerpt;
}

/**
 * Method get_all_social_yoast
 *
 * @return void
 */
function get_all_social_yoast()
{
    $yoast_social = get_option('wpseo_social');
    $social_links = [];

    if (isset($yoast_social['facebook_site_url']) && !empty($yoast_social['facebook_site_url'])) {
        $social_links[] = esc_url($yoast_social['facebook_site_url']);
    }

    if (isset($yoast_social['twitter_site']) && !empty($yoast_social['twitter_site'])) {
        $username = ltrim($yoast_social['twitter_site'], '@');
        $social_links[] = 'https://x.com/' . esc_attr($username);
    }

    if (isset($yoast_social['instagram_url']) && !empty($yoast_social['instagram_url'])) {
        $social_links[] = esc_url($yoast_social['instagram_url']);
    }

    if (isset($yoast_social['linkedin_url']) && !empty($yoast_social['linkedin_url'])) {
        $social_links[] = esc_url($yoast_social['linkedin_url']);
    }

    if (isset($yoast_social['pinterest_url']) && !empty($yoast_social['pinterest_url'])) {
        $social_links[] = esc_url($yoast_social['pinterest_url']);
    }

    if (isset($yoast_social['youtube_url']) && !empty($yoast_social['youtube_url'])) {
        $social_links[] = esc_url($yoast_social['youtube_url']);
    }

    return $social_links;
}
