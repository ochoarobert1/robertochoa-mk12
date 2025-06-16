<?php

/**
 * WP Customize Class
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (!defined('ABSPATH')) {
    die('Invalid request.');
}

if (!class_exists('RO_Customizer')) {

    /**
     * RO_Customizer
     */
    class RO_Customizer
    {
        /**
         * Method __construct
         *
         * @return void
         */
        public function __construct()
        {
            add_action('customize_register', [$this, 'registerCustomizer']);
        }

        /**
         * Method registerCustomizer
         *
         * @param $wp_customize [object]
         *
         * @return void
         */
        public function registerCustomizer($wp_customize)
        {
            $wp_customize->add_section(
                'ro_webhook_data',
                [
                    'title' => esc_attr__('Webhooks & APIs', 'robertochoa'),
                    'description' => esc_attr__('Webhooks & API para Automatizaciones', 'robertochoa'),
                    'priority' => 30
                ]
            );

            $wp_customize->add_setting(
                'ro_webhook_data[discord_webhook]',
                [
                    'default'        => '',
                    'capability'     => 'edit_theme_options',
                    'type'           => 'option',
                    'sanitize_callback' => 'sanitize_url',
                ]
            );

            $wp_customize->add_control(
                'discord_webhook',
                [
                    'type'       => 'url',
                    'label'      => esc_attr__('Discord Webhook', 'robertochoa'),
                    'description' => esc_html__('Ingresa la Webhook URL para el Discord', 'robertochoa'),
                    'section'    => 'ro_webhook_data',
                    'settings'   => 'ro_webhook_data[discord_webhook]'
                ]
            );

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
                    'type'       => 'email',
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
                    'type'       => 'text',
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

            $wp_customize->add_section(
                'ro_social_networks',
                [
                    'title' => esc_attr__('Redes Sociales', 'robertochoa'),
                    'description' => esc_attr__('Enlaces a redes sociales', 'robertochoa'),
                    'priority' => 30
                ]
            );

            $wp_customize->add_setting(
                'ro_social_networks[facebook]',
                [
                    'default'        => '',
                    'capability'     => 'edit_theme_options',
                    'type'           => 'option',
                    'sanitize_callback' => 'sanitize_url',
                ]
            );

            $wp_customize->add_control(
                'facebook',
                [
                    'type'       => 'url',
                    'label'      => esc_attr__('Perfil de Facebook', 'robertochoa'),
                    'description' => esc_html__('Ingrese la url del perfil de Facebook.', 'robertochoa'),
                    'section'    => 'ro_social_networks',
                    'settings'   => 'ro_social_networks[facebook]'
                ]
            );

            $wp_customize->add_setting(
                'ro_social_networks[twitter]',
                [
                    'default'        => '',
                    'capability'     => 'edit_theme_options',
                    'type'           => 'option',
                    'sanitize_callback' => 'sanitize_url',
                ]
            );

            $wp_customize->add_control(
                'twitter',
                [
                    'type'       => 'url',
                    'label'      => esc_attr__('Perfil de Twitter', 'robertochoa'),
                    'description' => esc_html__('Ingrese la url del perfil de Twitter.', 'robertochoa'),
                    'section'    => 'ro_social_networks',
                    'settings'   => 'ro_social_networks[twitter]'
                ]
            );

            $wp_customize->add_setting(
                'ro_social_networks[instagram]',
                [
                    'default'        => '',
                    'capability'     => 'edit_theme_options',
                    'type'           => 'option',
                    'sanitize_callback' => 'sanitize_url',
                ]
            );

            $wp_customize->add_control(
                'instagram',
                [
                    'type'       => 'url',
                    'label'      => esc_attr__('Perfil de Instagram', 'robertochoa'),
                    'description' => esc_html__('Ingrese la url del perfil de Instagram.', 'robertochoa'),
                    'section'    => 'ro_social_networks',
                    'settings'   => 'ro_social_networks[instagram]'
                ]
            );

            $wp_customize->add_setting(
                'ro_social_networks[github]',
                [
                    'default'        => '',
                    'capability'     => 'edit_theme_options',
                    'type'           => 'option',
                    'sanitize_callback' => 'sanitize_url',
                ]
            );

            $wp_customize->add_control(
                'github',
                [
                    'type'       => 'url',
                    'label'      => esc_attr__('Perfil de Github', 'robertochoa'),
                    'description' => esc_html__('Ingrese la url del perfil de Github.', 'robertochoa'),
                    'section'    => 'ro_social_networks',
                    'settings'   => 'ro_social_networks[github]'
                ]
            );

            $wp_customize->add_setting(
                'ro_social_networks[linkedin]',
                [
                    'default'        => '',
                    'capability'     => 'edit_theme_options',
                    'type'           => 'option',
                    'sanitize_callback' => 'sanitize_url',
                ]
            );

            $wp_customize->add_control(
                'linkedin',
                [
                    'type'       => 'url',
                    'label'      => esc_attr__('Perfil de LinkedIn', 'robertochoa'),
                    'description' => esc_html__('Ingrese la url del perfil de LinkedIn.', 'robertochoa'),
                    'section'    => 'ro_social_networks',
                    'settings'   => 'ro_social_networks[linkedin]'
                ]
            );

            $wp_customize->add_setting(
                'ro_social_networks[bitbucket]',
                [
                    'default'        => '',
                    'capability'     => 'edit_theme_options',
                    'type'           => 'option',
                    'sanitize_callback' => 'sanitize_url',
                ]
            );

            $wp_customize->add_control(
                'bitbucket',
                [
                    'type'       => 'url',
                    'label'      => esc_attr__('Perfil de Bitbucket', 'robertochoa'),
                    'description' => esc_html__('Ingrese la url del perfil de Bitbucket.', 'robertochoa'),
                    'section'    => 'ro_social_networks',
                    'settings'   => 'ro_social_networks[bitbucket]'
                ]
            );

            $wp_customize->add_setting(
                'ro_social_networks[youtube]',
                [
                    'default'        => '',
                    'capability'     => 'edit_theme_options',
                    'type'           => 'option',
                    'sanitize_callback' => 'sanitize_url',
                ]
            );

            $wp_customize->add_control(
                'youtube',
                [
                    'type'       => 'url',
                    'label'      => esc_attr__('Perfil de YouTube', 'robertochoa'),
                    'description' => esc_html__('Ingrese la url del perfil de YouTube.', 'robertochoa'),
                    'section'    => 'ro_social_networks',
                    'settings'   => 'ro_social_networks[youtube]'
                ]
            );

            $wp_customize->add_setting(
                'ro_social_networks[twitch]',
                [
                    'default'        => '',
                    'capability'     => 'edit_theme_options',
                    'type'           => 'option',
                    'sanitize_callback' => 'sanitize_url',
                ]
            );

            $wp_customize->add_control(
                'twitch',
                [
                    'type'       => 'url',
                    'label'      => esc_attr__('Perfil de Twitch', 'robertochoa'),
                    'description' => esc_html__('Ingrese la url del perfil de Twitch.', 'robertochoa'),
                    'section'    => 'ro_social_networks',
                    'settings'   => 'ro_social_networks[twitch]'
                ]
            );
        }
    }

    new RO_Customizer();
}
