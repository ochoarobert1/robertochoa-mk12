<?php

/**
 * Home Custom Metaboxes
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('customMetaboxesCasos')) {
    class customMetaboxesCasos extends ROMetaboxesClass
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
            $cmb_casos = new_cmb2_box(array(
                'id'            => parent::PREFIX . 'casos_metabox',
                'title'         => esc_html__('Información Extra', 'robertochoa'),
                'object_types'  => array('casos'),
                'context'    => 'normal',
                'priority'   => 'high',
                'classes'    => 'extra-cmb2-class'
            ));

            $cmb_casos->add_field(array(
                'id'            => parent::PREFIX . 'caso_date',
                'name'       => __('Fecha', 'robertochoa'),
                'desc'       => __('Ingrese la fecha de finalización del caso', 'robertochoa'),
                'type'       => 'text_date'
            ));

            $cmb_casos->add_field(array(
                'id'            => parent::PREFIX . 'caso_url',
                'name'       => __('URL actual del caso', 'robertochoa'),
                'desc'       => __('Ingrese la dirección URL actual del caso', 'robertochoa'),
                'type'       => 'text_url'
            ));

            $cmb_casos->add_field(array(
                'id'            => parent::PREFIX . 'caso_repo_url',
                'name'       => __('Repositorio del caso', 'robertochoa'),
                'desc'       => __('Ingrese la dirección del Repositorio en Github/Bitbucket del caso', 'robertochoa'),
                'type'       => 'text_url'
            ));

            $cmb_casos->add_field(array(
                'id'            => parent::PREFIX . 'caso_gallery',
                'name'       => __('Galería', 'robertochoa'),
                'desc'       => __('Seleccione las imágenes que corresponden al caso', 'robertochoa'),
                'type'       => 'file_list'
            ));
        }
    }

    new customMetaboxesCasos();
}
