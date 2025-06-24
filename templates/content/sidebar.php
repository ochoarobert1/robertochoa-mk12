<?php

/**
 * Content: Main Sidebar Template Part
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (!defined('ABSPATH')) {
	exit;
}

if (is_active_sidebar('sidebar')) :
	dynamic_sidebar('sidebar');
endif;
