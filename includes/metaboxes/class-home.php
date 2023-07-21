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

if (!class_exists('customMetaboxesHome')) {
    class customMetaboxesHome extends customMetaboxesClass
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
            $cmb_home_numbers = new_cmb2_box(array(
                'id'            => parent::PREFIX . 'home_numbers_metabox',
                'title'         => esc_html__('Números luego del Hero', 'robertochoa'),
                'object_types'  => array('page'),
                'show_on'       => array('key' => 'page-template', 'value' => 'templates/page-home.php'),
                'context'    => 'normal',
                'priority'   => 'high',
                'classes'    => 'extra-cmb2-class'
            ));

            $group_field_id = $cmb_home_numbers->add_field(array(
                'id'            => parent::PREFIX . 'home_numbers_group',
                'name'          => esc_html__('Grupo de Números', 'robertochoa'),
                'description'   => __('Números dentro de la Sección', 'robertochoa'),
                'type'          => 'group',
                'options'       => array(
                    'group_title'       => __('Número {#}', 'robertochoa'),
                    'add_button'        => __('Agregar otro Número', 'robertochoa'),
                    'remove_button'     => __('Borrar Número', 'robertochoa'),
                    'sortable'          => true,
                    'closed'            => true,
                    'remove_confirm'    => esc_html__('¿Estas seguro de borrar este Número?', 'robertochoa')
                )
            ));

            $cmb_home_numbers->add_group_field($group_field_id, array(
                'id'        => 'icon',
                'name'      => esc_html__('Ícono del Número', 'robertochoa'),
                'desc'      => esc_html__('Carga un ícono alusivo al número a colocar', 'robertochoa'),
                'type'      => 'file',
                'options'   => array(
                    'url'   => false
                ),
                'text'      => array(
                    'add_upload_file_text' => esc_html__('Cargar Ícono', 'robertochoa'),
                ),
                'query_args' => array(
                    'type'  => array(
                        'image/gif',
                        'image/jpeg',
                        'image/png',
                        'image/webp',
                        'image/svg',
                    )
                ),
                'preview_size' => 'thumbnail'
            ));

            $cmb_home_numbers->add_group_field($group_field_id, array(
                'id'        => 'number',
                'name'      => esc_html__('Número', 'robertochoa'),
                'desc'      => esc_html__('Ingresa el npumero de este item', 'robertochoa'),
                'type'      => 'text',
                'attributes' => array('type' => 'number')
            ));

            $cmb_home_numbers->add_group_field($group_field_id, array(
                'id'        => 'desc',
                'name'      => esc_html__('Descripción', 'robertochoa'),
                'desc'      => esc_html__('Ingresa la descripción de este número', 'robertochoa'),
                'type'      => 'text'
            ));

            /* ABOUT */
            $cmb_home_about = new_cmb2_box(array(
                'id'            => parent::PREFIX . 'home_about_metabox',
                'title'         => esc_html__('Acerca de Mi', 'robertochoa'),
                'object_types'  => array('page'),
                'show_on'       => array('key' => 'page-template', 'value' => 'templates/page-home.php'),
                'context'    => 'normal',
                'priority'   => 'high',
                'classes'    => 'extra-cmb2-class'
            ));

            $cmb_home_about->add_field(array(
                'id'            => parent::PREFIX . 'home_about_image',
                'name'       => __('Imagen', 'robertochoa'),
                'desc'      => esc_html__('Carga una imagen para el "Acerca de mi"', 'robertochoa'),
                'type'      => 'file',
                'options'   => array(
                    'url'   => false
                ),
                'text'      => array(
                    'add_upload_file_text' => esc_html__('Cargar Imagen', 'robertochoa'),
                ),
                'query_args' => array(
                    'type'  => array(
                        'image/gif',
                        'image/jpeg',
                        'image/png',
                        'image/webp',
                        'image/svg',
                    )
                ),
                'preview_size' => 'thumbnail'
            ));

            $cmb_home_about->add_field(array(
                'id'            => parent::PREFIX . 'home_about_desc',
                'name'       => __('Descripción de la sección', 'robertochoa'),
                'desc'       => __('Ingrese la descripcion de la seccion', 'robertochoa'),
                'type'       => 'wysiwyg',
                'options' => array(
                    'wpautop' => true,
                    'media_buttons' => true,
                    'textarea_rows' => get_option('default_post_edit_rows', 4),
                    'teeny' => true,
                    'dfw' => false,
                    'tinymce' => true,
                    'quicktags' => true
                )
            ));

            $cmb_home_about->add_field(array(
                'id'            => parent::PREFIX . 'home_about_btn_text',
                'name'       => __('Texto del Boton en About', 'robertochoa'),
                'desc'       => __('Ingrese el Texto del Boton en About', 'robertochoa'),
                'type'       => 'text'
            ));

            $cmb_home_about->add_field(array(
                'id'            => parent::PREFIX . 'home_about_btn_url',
                'name'       => __('URL del Boton en About', 'robertochoa'),
                'desc'       => __('Ingrese la dirección URL del Boton en About', 'robertochoa'),
                'type'       => 'text_url'
            ));


            /* TOOLS */
            $cmb_home_tools = new_cmb2_box(array(
                'id'            => parent::PREFIX . 'home_tools_metabox',
                'title'         => esc_html__('Herrramientas', 'robertochoa'),
                'object_types'  => array('page'),
                'show_on'       => array('key' => 'page-template', 'value' => 'templates/page-home.php'),
                'context'    => 'normal',
                'priority'   => 'high',
                'classes'    => 'extra-cmb2-class'
            ));

            $cmb_home_tools->add_field(array(
                'id'         => parent::PREFIX . 'home_tools_title',
                'name'       => __('Título de la sección', 'robertochoa'),
                'desc'       => __('Ingrese el Título de la sección', 'robertochoa'),
                'type'       => 'text'
            ));

            $cmb_home_tools->add_field(array(
                'id'   => parent::PREFIX . 'home_tools_icons',
                'name' => __('Íconos de la sección', 'robertochoa'),
                'desc' => __('Seleccione los íconos que desee para la sección de Herramientas', 'robertochoa'),
                'type' => 'file_list',
                'preview_size' => array(100, 100),
                'query_args' => array('type' => 'image'),
                'text' => array(
                    'add_upload_files_text' => __('Agregar o Cargar Íconos', 'robertochoa'),
                    'remove_image_text' => __('Remover Ícono', 'robertochoa'),
                    'file_text' => __('Ícono', 'robertochoa'),
                    'file_download_text' => __('Descargar Ícono', 'robertochoa'),
                    'remove_text' => __('Remover Ícono', 'robertochoa'),
                ),
            ));

            /* SERVICES */
            $cmb_home_services = new_cmb2_box(array(
                'id'            => parent::PREFIX . 'home_services_metabox',
                'title'         => esc_html__('Servicios', 'robertochoa'),
                'object_types'  => array('page'),
                'show_on'       => array('key' => 'page-template', 'value' => 'templates/page-home.php'),
                'context'    => 'normal',
                'priority'   => 'high',
                'classes'    => 'extra-cmb2-class'
            ));

            $cmb_home_services->add_field(array(
                'id'         => parent::PREFIX . 'home_services_title',
                'name'       => __('Título de la sección', 'robertochoa'),
                'desc'       => __('Ingrese el Título de la sección', 'robertochoa'),
                'type'       => 'text'
            ));

            $cmb_home_services->add_field(array(
                'id'            => parent::PREFIX . 'home_services_desc',
                'name'       => __('Descripción de la sección', 'robertochoa'),
                'desc'       => __('Ingrese la descripcion de la seccion', 'robertochoa'),
                'type'       => 'wysiwyg',
                'options' => array(
                    'wpautop' => true,
                    'media_buttons' => true,
                    'textarea_rows' => get_option('default_post_edit_rows', 4),
                    'teeny' => true,
                    'dfw' => false,
                    'tinymce' => true,
                    'quicktags' => true
                )
            ));

            $cmb_home_services->add_field(array(
                'id'            => parent::PREFIX . 'home_services_btn_text',
                'name'       => __('Texto del Boton en Servicios', 'robertochoa'),
                'desc'       => __('Ingrese el Texto del Boton en Servicios', 'robertochoa'),
                'type'       => 'text'
            ));

            $cmb_home_services->add_field(array(
                'id'            => parent::PREFIX . 'home_services_btn_url',
                'name'       => __('URL del Boton en Servicios', 'robertochoa'),
                'desc'       => __('Ingrese la dirección URL del Boton en Servicios', 'robertochoa'),
                'type'       => 'text_url'
            ));

            /* PORTFOLIO */
            $cmb_home_portfolio = new_cmb2_box(array(
                'id'            => parent::PREFIX . 'home_portfolio_metabox',
                'title'         => esc_html__('Portafolio', 'robertochoa'),
                'object_types'  => array('page'),
                'show_on'       => array('key' => 'page-template', 'value' => 'templates/page-home.php'),
                'context'    => 'normal',
                'priority'   => 'high',
                'classes'    => 'extra-cmb2-class'
            ));

            $cmb_home_portfolio->add_field(array(
                'id'         => parent::PREFIX . 'home_portfolio_title',
                'name'       => __('Título de la sección', 'robertochoa'),
                'desc'       => __('Ingrese el Título de la sección', 'robertochoa'),
                'type'       => 'text'
            ));

            $cmb_home_portfolio->add_field(array(
                'id'            => parent::PREFIX . 'home_portfolio_btn_text',
                'name'       => __('Texto del Boton en Portafolio', 'robertochoa'),
                'desc'       => __('Ingrese el Texto del Boton en Portafolio', 'robertochoa'),
                'type'       => 'text'
            ));

            $cmb_home_portfolio->add_field(array(
                'id'            => parent::PREFIX . 'home_portfolio_btn_url',
                'name'       => __('URL del Boton en Portafolio', 'robertochoa'),
                'desc'       => __('Ingrese la dirección URL del Boton en Portafolio', 'robertochoa'),
                'type'       => 'text_url'
            ));
        }
    }

    new customMetaboxesHome;
}
