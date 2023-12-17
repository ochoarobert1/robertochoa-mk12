<?php

/**
 * Certificates Custom Metaboxes
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (!defined('ABSPATH')) {
	exit;
}

if (!class_exists('customMetaboxesCert')) {
	class customMetaboxesCert extends customMetaboxesClass
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
			$cmb_cert = new_cmb2_box(array(
				'id'            => parent::PREFIX . 'cert_metabox',
				'title'         => esc_html__('Información Extra', 'robertochoa'),
				'object_types'  => array('certificados'),
				'context'    => 'normal',
				'priority'   => 'high',
				'classes'    => 'extra-cmb2-class'
			));

			$cmb_cert->add_field(array(
				'id'            => parent::PREFIX . 'cert_id',
				'name'       => __('ID del Certificado', 'robertochoa'),
				'desc'       => __('Ingrese el ID del certificado', 'robertochoa'),
				'type'       => 'text'
			));

			$cmb_cert->add_field(array(
				'id'            => parent::PREFIX . 'cert_emisor',
				'name'       => __('Emisor del Certificado', 'robertochoa'),
				'desc'       => __('Ingrese el Emisor del certificado', 'robertochoa'),
				'type'       => 'text'
			));

			$cmb_cert->add_field(array(
				'id'            => parent::PREFIX . 'cert_date',
				'name'       => __('Fecha de Finalización', 'robertochoa'),
				'desc'       => __('Ingrese la fecha de finalización del curso', 'robertochoa'),
				'type'       => 'text_date'
			));

			$cmb_cert->add_field(array(
				'id'            => parent::PREFIX . 'cert_url',
				'name'       => __('URL del certificado', 'robertochoa'),
				'desc'       => __('Ingrese la dirección URL actual del certificado', 'robertochoa'),
				'type'       => 'text_url'
			));	
		}
	}

	new customMetaboxesCert;
}
