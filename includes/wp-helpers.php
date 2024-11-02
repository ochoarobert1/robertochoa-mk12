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
