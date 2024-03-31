<?php

if (!defined('ABSPATH')) {
    die('Invalid request.');
}


if (!class_exists('RO_Customizer')) {

    class RO_Customizer
    {
        public function __construct()
        {
            add_action('customize_register', [$this, 'registerCustomizer']);
        }

        public function registerCustomizer($wp_customize)
        {
            $wp_customize->add_section(
                'ro_contact_data',
                [
                    'title' => esc_attr__('Datos de Contacto', 'robertochoa'),
                    'description' => esc_attr__('Datos de contacto para zonas de formulario', 'robertochoa'),
                    'priority' => 30
                ]
            );

            $wp_customize->add_setting(
                'ro_contact_data[email]',
                [
                    'default'        => '',
                    'capability'     => 'edit_theme_options',
                    'type'           => 'option',
                    'sanitize_callback' => 'sanitize_email',
                ]
            );

            $wp_customize->add_control(
                'email',
                [
                    'type'		 => 'email',
                    'label'      => esc_attr__('Correo Electrónico', 'robertochoa'),
                    'description' => esc_html__('Ingrese el correo electrónico a mostrar.', 'robertochoa'),
                    'section'    => 'ro_contact_data',
                    'settings'   => 'ro_contact_data[email]'
                ]
            );

            $wp_customize->add_setting(
                'ro_contact_data[phone]',
                [
                    'default'        => '',
                    'capability'     => 'edit_theme_options',
                    'type'           => 'option',
                    'sanitize_callback' => '',
                ]
            );

            $wp_customize->add_control(
                'phone',
                [
                    'type'		 => 'text',
                    'label'      => esc_attr__('Números Telefónicos', 'robertochoa'),
                    'description' => esc_html__('Ingrese los números telefónicos a mostrar, puede ingresarlos separados por comas.', 'robertochoa'),
                    'section'    => 'ro_contact_data',
                    'settings'   => 'ro_contact_data[phone]'
                ]
            );

            $wp_customize->add_setting(
                'ro_contact_data[address]',
                [
                    'default'        => '',
                    'capability'     => 'edit_theme_options',
                    'type'           => 'option',
                    'sanitize_callback' => 'sanitize_textarea_field',
                ]
            );

            $wp_customize->add_control(
                'address',
                [
                    'type' => 'textarea',
                    'label'      => esc_attr__('Dirección', 'robertochoa'),
                    'description' => esc_html__('Ingrese la dirección postal a mostrar.', 'robertochoa'),
                    'section'    => 'ro_contact_data',
                    'settings'   => 'ro_contact_data[address]'
                ]
            );
        }
    }

    new RO_Customizer();
}
