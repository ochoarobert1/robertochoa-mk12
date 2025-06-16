<?php

/**
 * WP Ajax Handlers
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * ROAjaxHandlers Class
 */
class ROAjaxHandlers
{
    /**
     * Constructor
     */
    public function __construct()
    {
        add_action('wp_ajax_send_message', [$this, 'send_message_callback']);
        add_action('wp_ajax_nopriv_send_message', [$this, 'send_message_callback']);
    }

    /**
     * Send message callback
     */
    public function send_message_callback()
    {
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
        }

        $email = $_POST['form_email'];
        $name = $_POST['form_name'];
        $phone = $_POST['form_phone'];
        $message = $_POST['form_message'];


        ob_start();
        $logo = get_template_directory_uri() . '/images/logo.png';
        require_once get_theme_file_path('/templates/template-contact-email.php');
        $body = ob_get_clean();
        $body = str_replace([
            '{name}',
            '{email}',
            '{phone}',
            '{message}',
            '{logo}'
        ], [
            $name,
            $email,
            $phone,
            $message,
            $logo
        ], $body);

        $to = get_option('admin_email');
        $subject = esc_html__('Robert Ochoa: Nuevo Mensaje', 'robertochoa');
        $headers[] = 'Content-Type: text/html; charset=UTF-8';
        $headers[] = 'From: ' . esc_html(get_bloginfo('name')) . ' <noreply@' . strtolower($_SERVER['SERVER_NAME']) . '>';

        $sent = wp_mail($to, $subject, $body, $headers);

        if ($sent !== true) {
            wp_send_json_success(esc_html__("Ha ocurrido un error, por favor intente mas tarde.", 'robertochoa'), 200);
        } else {
            wp_send_json_success(esc_html__("Gracias por enviar su mensaje, en breve nos pondremos en contacto.", 'robertochoa'), 200);
        }
        wp_die();
    }

    /**
     * Validate reCAPTCHA
     * 
     * @param string $token reCAPTCHA token
     * @return bool
     */
    private function recaptcha_validate($token)
    {
        $google_settings = get_option('ro_google_settings');
        if (!isset($token)) {
            return false;
        }
        $siteverify = 'https://www.google.com/recaptcha/api/siteverify';
        $secret = $google_settings['secret_key'];
        $response = file_get_contents($siteverify . '?secret=' . $secret . '&response=' . $token);
        $response = json_decode($response, true);

        return $response['success'];
    }
}

// Initialize the class
new ROAjaxHandlers();
