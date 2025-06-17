<?php

/**
 * Custom Post Type Class
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (!defined('ABSPATH')) {
    die('Invalid request.');
}

/**
 * ROCustomPostType
 */
class ROCustomPostType
{
    /**
     * Method __construct
     *
     * @return void
     */
    public function __construct()
    {
        add_action('init', [$this, 'custom_casos_cpt'], 0);
        add_action('init', [$this, 'custom_casos_category_taxonomy'], 0);
        add_action('init', [$this, 'custom_casos_technology_taxonomy'], 0);
        add_action('init', [$this, 'custom_services_cpt'], 0);
        add_action('init', [$this, 'custom_certificates_cpt'], 0);
        add_action('restrict_manage_posts', [$this, 'add_admin_filters'], 10, 1);
        add_filter('manage_casos_posts_columns', [$this, 'add_custom_columns']);
        add_action('manage_casos_posts_custom_column', [$this, 'custom_columns_data'], 10, 2);
        add_filter('manage_certificados_posts_columns', [$this, 'add_cert_custom_columns']);
        add_action('manage_certificados_posts_custom_column', [$this, 'custom_cert_columns_data'], 10, 2);
        add_action('quick_edit_custom_box', [$this, 'add_quick_edit_field'], 10, 2);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_quick_edit_script']);
        add_action('save_post', [$this, 'save_quick_edit_data']);
        add_action('bulk_edit_custom_box', [$this, 'add_bulk_edit_field'], 10, 2);
        add_action('wp_ajax_save_bulk_edit_featured', [$this, 'save_bulk_edit_featured']);
    }

    /**
     * Method add_cert_custom_columns
     *
     * @param $columns [array]
     *
     * @return [array]
     */
    public function add_cert_custom_columns($columns)
    {

        unset($columns['date']);
        $columns['ro_cert_id'] = esc_html__('ID del Certificado', 'robertochoa');
        $columns['ro_cert_emisor'] = esc_html__('Emisor', 'robertochoa');
        $columns['ro_cert_date'] = esc_html__('Fecha de Emisión', 'robertochoa');
        $columns['ro_cert_url'] = esc_html__('URL', 'robertochoa');
        $columns['date'] = esc_html__('Date', 'wordpress');

        return $columns;
    }

    /**
     * Method custom_cert_columns_data
     *
     * @param $column [array]
     * @param $post_id [string]
     *
     * @return void
     */
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
            $date = DateTime::createFromFormat("Y-m-d", $cert_date);
            echo wp_kses_post(sprintf('<span>%s / %s</span>', $date->format("M"), $date->format("Y")));
        }

        if ($column == 'ro_cert_url') {
            $cert_url = get_post_meta($post_id, 'ro_cert_url', true);
            echo wp_kses_post(sprintf('<a href="%s" target="_blank">%s</a>', $cert_url, $cert_url));
        }
    }

    /**
     * Method add_custom_columns
     *
     * @param $columns [array]
     *
     * @return [array]
     */
    public function add_custom_columns($columns)
    {
        unset($columns['date']);
        $columns['thumbnail'] = esc_html__('Thumbnail', 'robertochoa');
        $columns['featured'] = esc_html__('Featured', 'robertochoa');
        $columns['date'] = esc_html__('Date', domain: 'robertochoa');

        return $columns;
    }

    /**
     * Method custom_columns_data
     *
     * @param $column [array]
     * @param $post_id [string]
     *
     * @return void
     */
    public function custom_columns_data($column, $post_id)
    {
        if ($column == 'thumbnail') {
            $image = (get_the_post_thumbnail_url($post_id, 'thumbnail') != '') ? get_the_post_thumbnail_url($post_id, 'thumbnail') : '';
            if ($image !== '') {
                echo wp_kses_post(sprintf('<img src="%s" width="70" height="70" />', $image));
            }
        }

        if ($column == 'featured') {
            $featured = get_post_meta($post_id, 'ro_featured', true);
            if ($featured == '1') {
                echo wp_kses_post(sprintf('<span class="dashicons dashicons-yes"></span>'));
            } else {
                echo wp_kses_post(sprintf('<span class="dashicons dashicons-no"></span>'));
            }
        }
    }

    /**
     * Method add_admin_filters
     *
     * @param $post_type [string]
     *
     * @return void
     */
    public function add_admin_filters($post_type)
    {
        if ('casos' !== $post_type) {
            return;
        }

        $taxonomies_slugs = [
            'categoria-casos',
            'tecnologia-casos'
        ];

        foreach ($taxonomies_slugs as $slug) {
            $taxonomy = get_taxonomy($slug);
            $selected = '';
            $selected = isset($_REQUEST[$slug]) ? $_REQUEST[$slug] : '';
            wp_dropdown_categories([
                'show_option_all' =>  $taxonomy->labels->all_items,
                'taxonomy'        =>  $slug,
                'name'            =>  $slug,
                'orderby'         =>  'name',
                'value_field'     =>  'slug',
                'selected'        =>  $selected,
                'hierarchical'    =>  true,
            ]);
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

        $labels = [
            'name'                  => esc_html_x('Servicios', 'Post Type General Name', 'robertochoa'),
            'singular_name'         => esc_html_x('Servicio', 'Post Type Singular Name', 'robertochoa'),
            'menu_name'             => esc_html__('Servicios', 'robertochoa'),
            'name_admin_bar'        => esc_html__('Servicios', 'robertochoa'),
            'archives'              => esc_html__('Archivo de Servicios', 'robertochoa'),
            'attributes'            => esc_html__('Atrributos de Servicio', 'robertochoa'),
            'parent_item_colon'     => esc_html__('Servicio Padre:', 'robertochoa'),
            'all_items'             => esc_html__('Todos los Servicios', 'robertochoa'),
            'add_new_item'          => esc_html__('Agregar Nuevo Servicio', 'robertochoa'),
            'add_new'               => esc_html__('Agregar Nuevo', 'robertochoa'),
            'new_item'              => esc_html__('Nuevo Servicio', 'robertochoa'),
            'edit_item'             => esc_html__('Editar Servicio', 'robertochoa'),
            'update_item'           => esc_html__('Actualizar Servicio', 'robertochoa'),
            'view_item'             => esc_html__('Ver Servicio', 'robertochoa'),
            'view_items'            => esc_html__('Ver Servicios', 'robertochoa'),
            'search_items'          => esc_html__('Buscar Servicio', 'robertochoa'),
            'not_found'             => esc_html__('No hay resultados', 'robertochoa'),
            'not_found_in_trash'    => esc_html__('No hay resultados en Papelera', 'robertochoa'),
            'featured_image'        => esc_html__('Imagen del Servicio', 'robertochoa'),
            'set_featured_image'    => esc_html__('Colocar Imagen del Servicio', 'robertochoa'),
            'remove_featured_image' => esc_html__('Remover imagen del Servicio', 'robertochoa'),
            'use_featured_image'    => esc_html__('Usar como imagen del Servicio', 'robertochoa'),
            'insert_into_item'      => esc_html__('Insertar en Servicio', 'robertochoa'),
            'uploaded_to_this_item' => esc_html__('Cargado a este Servicio', 'robertochoa'),
            'items_list'            => esc_html__('Listado de Servicios', 'robertochoa'),
            'items_list_navigation' => esc_html__('Nav. del Listado de Servicios', 'robertochoa'),
            'filter_items_list'     => esc_html__('Filtro del Listado de Servicios', 'robertochoa'),
        ];
        $args = [
            'label'                 => esc_html__('Servicio', 'robertochoa'),
            'description'           => esc_html__('Servicios', 'robertochoa'),
            'labels'                => $labels,
            'supports'              => ['title', 'editor', 'thumbnail'],
            'taxonomies'            => ['tipo-servicio'],
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
        ];
        register_post_type('services', $args);
    }

    /**
     * Method custom_certificates_cpt
     *
     * @return void
     */
    public function custom_certificates_cpt()
    {

        $labels = [
            'name'                  => esc_html_x('Certificados y Educación', 'Post Type General Name', 'robertochoa'),
            'singular_name'         => esc_html_x('Certificado', 'Post Type Singular Name', 'robertochoa'),
            'menu_name'             => esc_html__('Certificados', 'robertochoa'),
            'name_admin_bar'        => esc_html__('Certificado', 'robertochoa'),
            'archives'              => esc_html__('Archivo de Certificados', 'robertochoa'),
            'attributes'            => esc_html__('Atrributos de Certificado', 'robertochoa'),
            'parent_item_colon'     => esc_html__('Certificado Padre:', 'robertochoa'),
            'all_items'             => esc_html__('Todos los Certificados', 'robertochoa'),
            'add_new_item'          => esc_html__('Agregar Nuevo Certificado', 'robertochoa'),
            'add_new'               => esc_html__('Agregar Nuevo', 'robertochoa'),
            'new_item'              => esc_html__('Nuevo Certificado', 'robertochoa'),
            'edit_item'             => esc_html__('Editar Certificado', 'robertochoa'),
            'update_item'           => esc_html__('Actualizar Certificado', 'robertochoa'),
            'view_item'             => esc_html__('Ver Certificado', 'robertochoa'),
            'view_items'            => esc_html__('Ver Certificados', 'robertochoa'),
            'search_items'          => esc_html__('Buscar Certificado', 'robertochoa'),
            'not_found'             => esc_html__('No hay resultados', 'robertochoa'),
            'not_found_in_trash'    => esc_html__('No hay resultados en Papelera', 'robertochoa'),
            'featured_image'        => esc_html__('Imagen del Certificado', 'robertochoa'),
            'set_featured_image'    => esc_html__('Colocar Imagen del Certificado', 'robertochoa'),
            'remove_featured_image' => esc_html__('Remover imagen del Certificado', 'robertochoa'),
            'use_featured_image'    => esc_html__('Usar como imagen del Certificado', 'robertochoa'),
            'insert_into_item'      => esc_html__('Insertar en Certificado', 'robertochoa'),
            'uploaded_to_this_item' => esc_html__('Cargado a este Certificado', 'robertochoa'),
            'items_list'            => esc_html__('Listado de Certificado', 'robertochoa'),
            'items_list_navigation' => esc_html__('Nav. del Listado de Servicios', 'robertochoa'),
            'filter_items_list'     => esc_html__('Filtro del Listado de Certificado', 'robertochoa'),
        ];
        $args = [
            'label'                 => esc_html__('Certificados y Educación', 'robertochoa'),
            'description'           => esc_html__('Explora los certificados y mi formación académica en cuanto al desarrollo web. Descubre cursos completados, diplomas y habilidades técnicas que poseo para impulsan tu negocio digital', 'robertochoa'),
            'labels'                => $labels,
            'supports'              => ['title'],
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
        ];
        register_post_type('certificados', $args);
    }

    /**
     * Method custom_casos_cpt
     *
     * @return void
     */
    public function custom_casos_cpt()
    {

        $labels = [
            'name'                  => esc_html_x('Casos de Éxito', 'Post Type General Name', 'robertochoa'),
            'singular_name'         => esc_html_x('Caso de Éxito', 'Post Type Singular Name', 'robertochoa'),
            'menu_name'             => esc_html__('Casos de Éxito', 'robertochoa'),
            'name_admin_bar'        => esc_html__('Casos de Éxito', 'robertochoa'),
            'archives'              => esc_html__('Archivo de Casos', 'robertochoa'),
            'attributes'            => esc_html__('Atributos de Caso', 'robertochoa'),
            'parent_item_colon'     => esc_html__('Caso Padre:', 'robertochoa'),
            'all_items'             => esc_html__('Todos los Casos', 'robertochoa'),
            'add_new_item'          => esc_html__('Agregar Nuevo Caso', 'robertochoa'),
            'add_new'               => esc_html__('Agregar Nuevo', 'robertochoa'),
            'new_item'              => esc_html__('Nuevo Caso', 'robertochoa'),
            'edit_item'             => esc_html__('Editar Caso', 'robertochoa'),
            'update_item'           => esc_html__('Actualizar Caso', 'robertochoa'),
            'view_item'             => esc_html__('Ver Caso', 'robertochoa'),
            'view_items'            => esc_html__('Ver Casos de Éxito', 'robertochoa'),
            'search_items'          => esc_html__('Buscar Casos', 'robertochoa'),
            'not_found'             => esc_html__('No hay resultados', 'robertochoa'),
            'not_found_in_trash'    => esc_html__('No hay resultados en Papelera', 'robertochoa'),
            'featured_image'        => esc_html__('Imagen Destacada', 'robertochoa'),
            'set_featured_image'    => esc_html__('Colocar Imagen Destacada', 'robertochoa'),
            'remove_featured_image' => esc_html__('Remover Imagen Destacada', 'robertochoa'),
            'use_featured_image'    => esc_html__('Usar como Imagen Destacada', 'robertochoa'),
            'insert_into_item'      => esc_html__('Insertar en Caso', 'robertochoa'),
            'uploaded_to_this_item' => esc_html__('Cargado a este Caso', 'robertochoa'),
            'items_list'            => esc_html__('Listado de Casos', 'robertochoa'),
            'items_list_navigation' => esc_html__('Nav. del Listado de Casos', 'robertochoa'),
            'filter_items_list'     => esc_html__('Filtro del Listado de Casos', 'robertochoa'),
        ];
        $args = [
            'label'                 => esc_html__('Caso de Éxito', 'robertochoa'),
            'description'           => esc_html__('Descubre mis Casos de Éxito e historias de mis clientes: Tiendas online con WooCommerce, sitios web corporativos y sistemas a medida en WordPress para clientes en todo el mundo.', 'robertochoa'),
            'labels'                => $labels,
            'supports'              => ['title', 'editor', 'thumbnail'],
            'taxonomies'            => ['categoria-casos'],
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
        ];
        register_post_type('casos', $args);
    }

    /**
     * Method custom_taxonomy
     *
     * @return void
     */
    public function custom_casos_category_taxonomy()
    {

        $labels = [
            'name'                       => esc_html_x('Categorías', 'Taxonomy General Name', 'robertochoa'),
            'singular_name'              => esc_html_x('Categoría', 'Taxonomy Singular Name', 'robertochoa'),
            'menu_name'                  => esc_html__('Categorias', 'robertochoa'),
            'all_items'                  => esc_html__('Todas las Categorias', 'robertochoa'),
            'parent_item'                => esc_html__('Categoría Padre', 'robertochoa'),
            'parent_item_colon'          => esc_html__('Categoría Padre:', 'robertochoa'),
            'new_item_name'              => esc_html__('Nueva Categoría', 'robertochoa'),
            'add_new_item'               => esc_html__('Agregar Nueva Categoría', 'robertochoa'),
            'edit_item'                  => esc_html__('Editar Categoría', 'robertochoa'),
            'update_item'                => esc_html__('Actualizar Categoría', 'robertochoa'),
            'view_item'                  => esc_html__('Ver Categoría', 'robertochoa'),
            'separate_items_with_commas' => esc_html__('Separar categorias por comas', 'robertochoa'),
            'add_or_remove_items'        => esc_html__('Agregar o Remover Categorias', 'robertochoa'),
            'choose_from_most_used'      => esc_html__('Escoger de los más usados', 'robertochoa'),
            'popular_items'              => esc_html__('Categorias Populares', 'robertochoa'),
            'search_items'               => esc_html__('Buscar Categorias', 'robertochoa'),
            'not_found'                  => esc_html__('No hay resultados', 'robertochoa'),
            'no_terms'                   => esc_html__('No hay Categorias', 'robertochoa'),
            'items_list'                 => esc_html__('Listado de Categorias', 'robertochoa'),
            'items_list_navigation'      => esc_html__('Nav. del Listado de Categorias', 'robertochoa'),
        ];
        $args = [
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
            'show_in_rest'               => true,
        ];
        register_taxonomy('categoria-casos', ['casos'], $args);
    }

    /**
     * Method custom_taxonomy
     *
     * @return void
     */
    public function custom_casos_technology_taxonomy()
    {

        $labels = [
            'name'                       => esc_html_x('Tecnología', 'Taxonomy General Name', 'robertochoa'),
            'singular_name'              => esc_html_x('Tecnología', 'Taxonomy Singular Name', 'robertochoa'),
            'menu_name'                  => esc_html__('Tecnologias', 'robertochoa'),
            'all_items'                  => esc_html__('Todas las Tecnologias', 'robertochoa'),
            'parent_item'                => esc_html__('Tecnología Padre', 'robertochoa'),
            'parent_item_colon'          => esc_html__('Tecnología Padre:', 'robertochoa'),
            'new_item_name'              => esc_html__('Nueva Tecnología', 'robertochoa'),
            'add_new_item'               => esc_html__('Agregar Nueva Tecnología', 'robertochoa'),
            'edit_item'                  => esc_html__('Editar Tecnología', 'robertochoa'),
            'update_item'                => esc_html__('Actualizar Tecnología', 'robertochoa'),
            'view_item'                  => esc_html__('Ver Tecnología', 'robertochoa'),
            'separate_items_with_commas' => esc_html__('Separar Tecnologias por comas', 'robertochoa'),
            'add_or_remove_items'        => esc_html__('Agregar o Remover Tecnologias', 'robertochoa'),
            'choose_from_most_used'      => esc_html__('Escoger de los más usados', 'robertochoa'),
            'popular_items'              => esc_html__('Tecnologias Populares', 'robertochoa'),
            'search_items'               => esc_html__('Buscar Tecnologias', 'robertochoa'),
            'not_found'                  => esc_html__('No hay resultados', 'robertochoa'),
            'no_terms'                   => esc_html__('No hay Tecnologias', 'robertochoa'),
            'items_list'                 => esc_html__('Listado de Tecnologias', 'robertochoa'),
            'items_list_navigation'      => esc_html__('Nav. del Listado de Tecnologias', 'robertochoa'),
        ];
        $args = [
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
            'show_in_rest'               => true,
        ];
        register_taxonomy('tecnologia-casos', ['casos'], $args);
    }

    /**
     * Add custom field to Quick Edit
     *
     * @param string $column_name Column name
     * @param string $post_type Post type
     * @return void
     */
    public function add_quick_edit_field($column_name, $post_type)
    {
        if ($post_type !== 'casos' || $column_name !== 'featured') {
            return;
        }
?>
        <fieldset class="inline-edit-col-right">
            <div class="inline-edit-col">
                <label class="inline-edit-group">
                    <span class="title"><?php esc_html_e('Featured', 'robertochoa'); ?></span>
                    <input type="checkbox" name="ro_featured" value="1" />
                </label>
            </div>
        </fieldset>
    <?php
    }

    /**
     * Enqueue JavaScript for Quick Edit
     *
     * @param string $hook Current admin page
     * @return void
     */
    public function enqueue_quick_edit_script($hook)
    {
        if ('edit.php' !== $hook || !isset($_GET['post_type']) || $_GET['post_type'] !== 'casos') {
            return;
        }

        wp_enqueue_script(
            'ro-quick-edit',
            get_template_directory_uri() . '/js/quick-edit.js',
            ['jquery'],
            '1.0.0',
            true
        );
    }

    /**
     * Save Quick Edit data
     *
     * @param int $post_id Post ID
     * @return void
     */
    public function save_quick_edit_data($post_id)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        if (get_post_type($post_id) !== 'casos') {
            return;
        }

        // Update ro_featured meta
        if (isset($_POST['ro_featured'])) {
            update_post_meta($post_id, 'ro_featured', '1');
        } else {
            update_post_meta($post_id, 'ro_featured', '0');
        }
    }

    /**
     * Add custom field to Bulk Edit
     *
     * @param string $column_name Column name
     * @param string $post_type Post type
     * @return void
     */
    public function add_bulk_edit_field($column_name, $post_type)
    {
        if ($post_type !== 'casos' || $column_name !== 'featured') {
            return;
        }
    ?>
        <fieldset class="inline-edit-col-right">
            <div class="inline-edit-col">
                <label class="alignleft">
                    <span class="title"><?php esc_html_e('Featured', 'robertochoa'); ?></span>
                    <select name="ro_featured_bulk">
                        <option value="-1"><?php esc_html_e('— No Change —', 'robertochoa'); ?></option>
                        <option value="1"><?php esc_html_e('Yes', 'robertochoa'); ?></option>
                        <option value="0"><?php esc_html_e('No', 'robertochoa'); ?></option>
                    </select>
                </label>
            </div>
        </fieldset>
<?php
    }
    // TODO: Needs Revision
    /**
     * Save bulk edit data via AJAX
     */
    public function save_bulk_edit_featured()
    {
        // Security check - no need for nonce verification as we're using admin-ajax
        if (!current_user_can('edit_posts')) {
            wp_die('Permission denied');
        }

        // Get the post IDs
        $post_ids = isset($_POST['post_ids']) ? $_POST['post_ids'] : false;
        $featured_value = isset($_POST['featured_value']) ? $_POST['featured_value'] : '-1';

        if (!$post_ids || $featured_value === '-1') {
            wp_die('No posts or value specified');
        }

        // Convert to array
        $post_ids = explode(',', $post_ids);

        // Update each post
        foreach ($post_ids as $post_id) {
            $post_id = (int) $post_id;
            if ($post_id > 0) {
                update_post_meta($post_id, 'ro_featured', $featured_value);
            }
        }

        echo 'success';
        wp_die();
    }
}

new ROCustomPostType();
