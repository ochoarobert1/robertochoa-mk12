<?php

/**
 * Categories Custom Metaboxes
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('customMetaboxesCategories')) {
    class customMetaboxesCategories extends customMetaboxesClass
    {
        /**
         * Main Constructor.
         */
        public function __construct()
        {
            add_action('cmb2_admin_init', array($this, 'robertochoa_register_custom_metabox'));
        }

        /**
         * Method robertochoa_register_custom_metabox
         *
         * @return void
         */
        public function robertochoa_register_custom_metabox()
        {
            $cmb_cats = new_cmb2_box(array(
                'id'            => parent::PREFIX . 'cat_metabox',
                'title'         => esc_html__('Información Extra', 'robertochoa'),
                'object_types'  => array( 'term' ),
                'taxonomies'    => array( 'category'),
                'context'    => 'normal',
                'priority'   => 'high',
                'classes'    => 'extra-cmb2-class'
            ));

            $cmb_cats->add_field(array(
                'name'    => __('Ícono de Categoría', 'robertochoa'),
                'desc'    => __('Cargar un ícono para la categoria', 'robertochoa'),
                'id'      => parent::PREFIX . 'category_icon',
                'type'    => 'file',
                'options' => array(
                    'url' => false,
                ),
                'text'    => array(
                    'add_upload_file_text' => __('Add File', 'robertochoa'),
                ),
                'preview_size' => 'thumbnail',
            ));
        }
    }

    new customMetaboxesCategories();
}
