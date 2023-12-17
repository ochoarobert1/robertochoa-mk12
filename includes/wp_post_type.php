<?php

if (!defined('ABSPATH')) {
    die('Invalid request.');
}

class RobertCustomPostMeta
{
    /**
     * Method __construct
     *
     * @return void
     */
    public function __construct()
    {
        add_action('init', [$this, 'custom_post_type'], 0);
        add_action('init', [$this, 'custom_casos_category_taxonomy'], 0);
        add_action('init', [$this, 'custom_casos_technology_taxonomy'], 0);
        add_action('init', [$this, 'custom_services_cpt'], 0);
        add_action('init', [$this, 'custom_certificates_cpt'], 0);
        add_action('restrict_manage_posts', [$this, 'add_admin_filters'], 10, 1);
        add_filter('manage_casos_posts_columns', [$this, 'add_custom_columns']);
        add_action('manage_casos_posts_custom_column', [$this, 'custom_columns_data'], 10, 2);
        add_filter('manage_certificados_posts_columns', [$this, 'add_cert_custom_columns']);
        add_action('manage_certificados_posts_custom_column', [$this, 'custom_cert_columns_data'], 10, 2);
    }

    /**
     * Method add_cert_custom_columns
     *
     * @param $columns $columns [explicite description]
     *
     * @return void
     */
    public function add_cert_custom_columns($columns)
    {

        unset($columns['date']);
        $columns['ro_cert_id'] = __('ID del Certificado', 'robertochoa');
        $columns['ro_cert_emisor'] = __('Emisor', 'robertochoa');
        $columns['ro_cert_date'] = __('Fecha de Emisión', 'robertochoa');
        $columns['date'] = __('Date', 'wordpress');

        return $columns;
    }

    public function custom_cert_columns_data($column, $post_id)
    {
        if ($column == 'ro_cert_id') {
            $id = get_post_meta($post_id, 'ro_cert_id', true);
            echo wp_kses_post(sprintf('<code>%s</code>', strtoupper($id)));
        }

        if ($column == 'ro_cert_emisor') {
            $emisor = get_post_meta($post_id, 'ro_cert_emisor', true);
            echo wp_kses_post(sprintf('<span>%s</span>', $emisor));
        }

        if ($column == 'ro_cert_date') {
            $cert_date = get_post_meta($post_id, 'ro_cert_date', true);
            $date = DateTime::createFromFormat("d/m/Y", $cert_date);
            echo wp_kses_post(sprintf('<span>%s / %s</span>', $date->format("M"), $date->format("Y")));
        }
    }

    /**
     * Method add_custom_columns
     *
     * @param $columns [explicite description]
     *
     * @return void
     */
    public function add_custom_columns($columns)
    {

        unset($columns['date']);
        $columns['thumbnail'] = __('Thumbnail', 'robertochoa');
        $columns['date'] = __('Date', 'wordpress');

        return $columns;
    }

    /**
     * Method custom_columns_data
     *
     * @param $column [explicite description]
     * @param $post_id [explicite description]
     *
     * @return void
     */
    public function custom_columns_data($column, $post_id)
    {
        if ($column == 'thumbnail') {
            $image = (get_the_post_thumbnail_url($post_id, 'thumbnail') != '') ? get_the_post_thumbnail_url($post_id, 'thumbnail') : 'http://placehold.it/70x70';
            echo wp_kses_post(sprintf('<img src="%s" width="70" height="70" />', $image));
        }
    }

    /**
     * Method add_admin_filters
     *
     * @param $post_type $post_type [explicite description]
     *
     * @return void
     */
    public function add_admin_filters($post_type)
    {
        if ('casos' !== $post_type) {
            return;
        }
        $taxonomies_slugs = array(
            'categoria-casos',
            'tecnologia-casos'
        );
        // loop through the taxonomy filters array
        foreach ($taxonomies_slugs as $slug) {
            $taxonomy = get_taxonomy($slug);
            $selected = '';
            // if the current page is already filtered, get the selected term slug
            $selected = isset($_REQUEST[$slug]) ? $_REQUEST[$slug] : '';
            // render a dropdown for this taxonomy's terms
            wp_dropdown_categories(array(
                'show_option_all' =>  $taxonomy->labels->all_items,
                'taxonomy'        =>  $slug,
                'name'            =>  $slug,
                'orderby'         =>  'name',
                'value_field'     =>  'slug',
                'selected'        =>  $selected,
                'hierarchical'    =>  true,
            ));
        }
    }

    /**
     * Method custom_services_cpt
     * Register Custom Post Type
     *
     * @return void
     */
    public function custom_services_cpt()
    {

        $labels = array(
            'name'                  => _x('Servicios', 'Post Type General Name', 'robertochoa'),
            'singular_name'         => _x('Servicio', 'Post Type Singular Name', 'robertochoa'),
            'menu_name'             => __('Servicios', 'robertochoa'),
            'name_admin_bar'        => __('Servicios', 'robertochoa'),
            'archives'              => __('Archivo de Servicios', 'robertochoa'),
            'attributes'            => __('Atrributos de Servicio', 'robertochoa'),
            'parent_item_colon'     => __('Servicio Padre:', 'robertochoa'),
            'all_items'             => __('Todos los Servicios', 'robertochoa'),
            'add_new_item'          => __('Agregar Nuevo Servicio', 'robertochoa'),
            'add_new'               => __('Agregar Nuevo', 'robertochoa'),
            'new_item'              => __('Nuevo Servicio', 'robertochoa'),
            'edit_item'             => __('Editar Servicio', 'robertochoa'),
            'update_item'           => __('Actualizar Servicio', 'robertochoa'),
            'view_item'             => __('Ver Servicio', 'robertochoa'),
            'view_items'            => __('Ver Servicios', 'robertochoa'),
            'search_items'          => __('Buscar Servicio', 'robertochoa'),
            'not_found'             => __('No hay resultados', 'robertochoa'),
            'not_found_in_trash'    => __('No hay resultados en Papelera', 'robertochoa'),
            'featured_image'        => __('Imagen del Servicio', 'robertochoa'),
            'set_featured_image'    => __('Colocar Imagen del Servicio', 'robertochoa'),
            'remove_featured_image' => __('Remover imagen del Servicio', 'robertochoa'),
            'use_featured_image'    => __('Usar como imagen del Servicio', 'robertochoa'),
            'insert_into_item'      => __('Insertar en Servicio', 'robertochoa'),
            'uploaded_to_this_item' => __('Cargado a este Servicio', 'robertochoa'),
            'items_list'            => __('Listado de Servicios', 'robertochoa'),
            'items_list_navigation' => __('Nav. del Listado de Servicios', 'robertochoa'),
            'filter_items_list'     => __('Filtro del Listado de Servicios', 'robertochoa'),
        );
        $args = array(
            'label'                 => __('Servicio', 'robertochoa'),
            'description'           => __('Servicios', 'robertochoa'),
            'labels'                => $labels,
            'supports'              => array('title', 'editor', 'thumbnail'),
            'taxonomies'            => array('tipo-servicio'),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-money-alt',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
        );
        register_post_type('services', $args);
    }

    /**
     * Method custom_certificates_cpt
     *
     * @return void
     */
    public function custom_certificates_cpt()
    {

        $labels = array(
            'name'                  => _x('Certificados', 'Post Type General Name', 'robertochoa'),
            'singular_name'         => _x('Certificado', 'Post Type Singular Name', 'robertochoa'),
            'menu_name'             => __('Certificados', 'robertochoa'),
            'name_admin_bar'        => __('Certificado', 'robertochoa'),
            'archives'              => __('Archivo de Certificados', 'robertochoa'),
            'attributes'            => __('Atrributos de Certificado', 'robertochoa'),
            'parent_item_colon'     => __('Certificado Padre:', 'robertochoa'),
            'all_items'             => __('Todos los Certificados', 'robertochoa'),
            'add_new_item'          => __('Agregar Nuevo Certificado', 'robertochoa'),
            'add_new'               => __('Agregar Nuevo', 'robertochoa'),
            'new_item'              => __('Nuevo Certificado', 'robertochoa'),
            'edit_item'             => __('Editar Certificado', 'robertochoa'),
            'update_item'           => __('Actualizar Certificado', 'robertochoa'),
            'view_item'             => __('Ver Certificado', 'robertochoa'),
            'view_items'            => __('Ver Certificados', 'robertochoa'),
            'search_items'          => __('Buscar Certificado', 'robertochoa'),
            'not_found'             => __('No hay resultados', 'robertochoa'),
            'not_found_in_trash'    => __('No hay resultados en Papelera', 'robertochoa'),
            'featured_image'        => __('Imagen del Certificado', 'robertochoa'),
            'set_featured_image'    => __('Colocar Imagen del Certificado', 'robertochoa'),
            'remove_featured_image' => __('Remover imagen del Certificado', 'robertochoa'),
            'use_featured_image'    => __('Usar como imagen del Certificado', 'robertochoa'),
            'insert_into_item'      => __('Insertar en Certificado', 'robertochoa'),
            'uploaded_to_this_item' => __('Cargado a este Certificado', 'robertochoa'),
            'items_list'            => __('Listado de Certificado', 'robertochoa'),
            'items_list_navigation' => __('Nav. del Listado de Servicios', 'robertochoa'),
            'filter_items_list'     => __('Filtro del Listado de Certificado', 'robertochoa'),
        );
        $args = array(
            'label'                 => __('Certificado', 'robertochoa'),
            'description'           => __('Certificados', 'robertochoa'),
            'labels'                => $labels,
            'supports'              => array('title'),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-welcome-learn-more',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
        );
        register_post_type('certificados', $args);
    }

    /**
     * Method custom_post_type
     *
     * @return void
     */
    public function custom_post_type()
    {

        $labels = array(
            'name'                  => _x('Casos', 'Post Type General Name', 'robertochoa'),
            'singular_name'         => _x('Caso', 'Post Type Singular Name', 'robertochoa'),
            'menu_name'             => __('Casos de Éxito', 'robertochoa'),
            'name_admin_bar'        => __('Casos de Éxito', 'robertochoa'),
            'archives'              => __('Archivo de Casos', 'robertochoa'),
            'attributes'            => __('Atributos de Caso', 'robertochoa'),
            'parent_item_colon'     => __('Caso Padre:', 'robertochoa'),
            'all_items'             => __('Todos los Casos', 'robertochoa'),
            'add_new_item'          => __('Agregar Nuevo Caso', 'robertochoa'),
            'add_new'               => __('Agregar Nuevo', 'robertochoa'),
            'new_item'              => __('Nuevo Caso', 'robertochoa'),
            'edit_item'             => __('Editar Caso', 'robertochoa'),
            'update_item'           => __('Actualizar Caso', 'robertochoa'),
            'view_item'             => __('Ver Caso', 'robertochoa'),
            'view_items'            => __('Ver Casos', 'robertochoa'),
            'search_items'          => __('Buscar Casos', 'robertochoa'),
            'not_found'             => __('No hay resultados', 'robertochoa'),
            'not_found_in_trash'    => __('No hay resultados en Papelera', 'robertochoa'),
            'featured_image'        => __('Imagen Destacada', 'robertochoa'),
            'set_featured_image'    => __('Colocar Imagen Destacada', 'robertochoa'),
            'remove_featured_image' => __('Remover Imagen Destacada', 'robertochoa'),
            'use_featured_image'    => __('Usar como Imagen Destacada', 'robertochoa'),
            'insert_into_item'      => __('Insertar en Caso', 'robertochoa'),
            'uploaded_to_this_item' => __('Cargado a este Caso', 'robertochoa'),
            'items_list'            => __('Listado de Casos', 'robertochoa'),
            'items_list_navigation' => __('Nav. del Listado de Casos', 'robertochoa'),
            'filter_items_list'     => __('Filtro del Listado de Casos', 'robertochoa'),
        );
        $args = array(
            'label'                 => __('Caso', 'robertochoa'),
            'description'           => __('Casos de Éxito', 'robertochoa'),
            'labels'                => $labels,
            'supports'              => array('title', 'editor', 'thumbnail'),
            'taxonomies'            => array('categoria-casos'),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-star-filled',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
            'show_in_rest'          => true,
        );
        register_post_type('casos', $args);
    }

    /**
     * Method custom_taxonomy
     *
     * @return void
     */
    public function custom_casos_category_taxonomy()
    {

        $labels = array(
            'name'                       => _x('Categorías', 'Taxonomy General Name', 'robertochoa'),
            'singular_name'              => _x('Categoría', 'Taxonomy Singular Name', 'robertochoa'),
            'menu_name'                  => __('Categorias', 'robertochoa'),
            'all_items'                  => __('Todas las Categorias', 'robertochoa'),
            'parent_item'                => __('Categoría Padre', 'robertochoa'),
            'parent_item_colon'          => __('Categoría Padre:', 'robertochoa'),
            'new_item_name'              => __('Nueva Categoría', 'robertochoa'),
            'add_new_item'               => __('Agregar Nueva Categoría', 'robertochoa'),
            'edit_item'                  => __('Editar Categoría', 'robertochoa'),
            'update_item'                => __('Actualizar Categoría', 'robertochoa'),
            'view_item'                  => __('Ver Categoría', 'robertochoa'),
            'separate_items_with_commas' => __('Separar categorias por comas', 'robertochoa'),
            'add_or_remove_items'        => __('Agregar o Remover Categorias', 'robertochoa'),
            'choose_from_most_used'      => __('Escoger de los más usados', 'robertochoa'),
            'popular_items'              => __('Categorias Populares', 'robertochoa'),
            'search_items'               => __('Buscar Categorias', 'robertochoa'),
            'not_found'                  => __('No hay resultados', 'robertochoa'),
            'no_terms'                   => __('No hay Categorias', 'robertochoa'),
            'items_list'                 => __('Listado de Categorias', 'robertochoa'),
            'items_list_navigation'      => __('Nav. del Listado de Categorias', 'robertochoa'),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
            'show_in_rest'               => true,
        );
        register_taxonomy('categoria-casos', array('casos'), $args);
    }

    /**
     * Method custom_taxonomy
     *
     * @return void
     */
    public function custom_casos_technology_taxonomy()
    {

        $labels = array(
            'name'                       => _x('Tecnología', 'Taxonomy General Name', 'robertochoa'),
            'singular_name'              => _x('Tecnología', 'Taxonomy Singular Name', 'robertochoa'),
            'menu_name'                  => __('Tecnologias', 'robertochoa'),
            'all_items'                  => __('Todas las Tecnologias', 'robertochoa'),
            'parent_item'                => __('Tecnología Padre', 'robertochoa'),
            'parent_item_colon'          => __('Tecnología Padre:', 'robertochoa'),
            'new_item_name'              => __('Nueva Tecnología', 'robertochoa'),
            'add_new_item'               => __('Agregar Nueva Tecnología', 'robertochoa'),
            'edit_item'                  => __('Editar Tecnología', 'robertochoa'),
            'update_item'                => __('Actualizar Tecnología', 'robertochoa'),
            'view_item'                  => __('Ver Tecnología', 'robertochoa'),
            'separate_items_with_commas' => __('Separar Tecnologias por comas', 'robertochoa'),
            'add_or_remove_items'        => __('Agregar o Remover Tecnologias', 'robertochoa'),
            'choose_from_most_used'      => __('Escoger de los más usados', 'robertochoa'),
            'popular_items'              => __('Tecnologias Populares', 'robertochoa'),
            'search_items'               => __('Buscar Tecnologias', 'robertochoa'),
            'not_found'                  => __('No hay resultados', 'robertochoa'),
            'no_terms'                   => __('No hay Tecnologias', 'robertochoa'),
            'items_list'                 => __('Listado de Tecnologias', 'robertochoa'),
            'items_list_navigation'      => __('Nav. del Listado de Tecnologias', 'robertochoa'),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
            'show_in_rest'               => true,
        );
        register_taxonomy('tecnologia-casos', array('casos'), $args);
    }
}

new RobertCustomPostMeta();
