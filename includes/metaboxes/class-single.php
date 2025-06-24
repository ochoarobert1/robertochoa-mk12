<?php

/**
 * Single Custom Metaboxes
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (!defined('ABSPATH')) {
	exit;
}

if (!class_exists('customMetaboxesSingle')) {
	class customMetaboxesSingle extends ROMetaboxesClass
	{
		/**
		 * Main Constructor.
		 */
		public function __construct()
		{
			add_action('cmb2_admin_init', array($this, 'robertochoa_register_custom_metabox'));
		}

		/**
		 * Register custom metaboxes.
		 */
		public function robertochoa_register_custom_metabox()
		{
			$cmb_single = new_cmb2_box(array(
				'id'            => parent::PREFIX . 'cmb_single',
				'title'         => esc_html__('Información Extra', 'robertochoa'),
				'object_types'  => array('post'),
				'context'    => 'side',
				'priority'   => 'high',
				'classes'    => 'extra-cmb2-class'
			));

			$cmb_single->add_field(array(
				'name' => esc_html__('Imagen Destacada (Cuadrada)', 'robertochoa'),
				'id'   => parent::PREFIX . 'thumb_box',
				'type'    => 'file',
				'options' => array(
					'url' => false,
				),
				'text'    => array(
					'add_upload_file_text' => esc_html__('Agregar Imagen', 'robertochoa'),
				),
				'preview_size' => 'large'
			));
		}
	}

	new customMetaboxesSingle();
}
