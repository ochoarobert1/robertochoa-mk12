<?php

/**
 * WP Enqueue Styles
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (!defined('ABSPATH')) {
	die('Invalid request.');
}

if (!class_exists('RO_Enqueue_Styles')) {
	/**
	 * RO_Enqueue_Styles
	 */
	class RO_Enqueue_Styles
	{
		/**
		 * Method __construct
		 *
		 * @return void
		 */
		public function __construct()
		{
			add_action('wp_enqueue_scripts', [$this, 'load_frontend_styles'], 1);
			add_action('enqueue_block_editor_assets', [$this, 'load_admin_styles']);
		}

		/**
		 * Method load_frontend_styles
		 *
		 * @return void
		 */
		public function load_frontend_styles()
		{
			if (!is_admin()) {
				wp_enqueue_style('robertochoa-style', get_template_directory_uri() . '/dist/styles.css', [], null, 'all');
			}
		}

		/**
		 * Method load_admin_styles
		 *
		 * @return void
		 */
		public function load_admin_styles()
		{
			wp_enqueue_style('gutenberg-style', get_template_directory_uri() . '/dist/admin.css', [], null, 'all');
		}
	}

	new RO_Enqueue_Styles();
}
