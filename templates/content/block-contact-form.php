<?php

/**
 * Content: Contact Form Template Part
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<form id="contactForm" class="contact-form-container">
    <fieldset class="form-group">
        <label for="formName"><?php esc_html_e('Nombre y Apellido', 'robertochoa'); ?></label>
        <input id="formName" name="form_name" autocomplete="name" type="text" class="form-control" tabindex="1" placeholder="<?php esc_attr_e('Ingresa tu nombre y apellido', 'robertochoa'); ?>" required />
        <small id="errorName" class="error hidden"></small>
    </fieldset>
    <fieldset class="form-group">
        <label for="formEmail"><?php esc_html_e('Correo Electrónico', 'robertochoa'); ?></label>
        <input id="formEmail" name="form_email" autocomplete="email" type="email" class="form-control" tabindex="2" placeholder="<?php esc_attr_e('Ingresa tu correo electrónico', 'robertochoa'); ?>" required />
        <small id="errorEmail" class="error hidden"></small>
    </fieldset>
    <fieldset class="form-group">
        <label for="formPhone"><?php esc_html_e('Teléfono', 'robertochoa'); ?></label>
        <input id="formPhone" name="form_phone" type="text" class="form-control" tabindex="3" placeholder="<?php esc_attr_e('Ingresa tu número telefónico', 'robertochoa'); ?>" required />
        <small id="errorPhone" class="error hidden"></small>
    </fieldset>
    <fieldset class="form-group">
        <label for="formMessage"><?php esc_html_e('Mensaje', 'robertochoa'); ?></label>
        <textarea name="form_message" id="formMessage" class="form-control form-control-textarea" cols="30" rows="10" tabindex="4" placeholder="<?php esc_attr_e('Describeme tu idea aqui, intenta ser descriptivo', 'robertochoa'); ?>" required></textarea>
        <small id="errorMessage" class="error hidden"></small>
    </fieldset>
    <div class="form-group form-group-submit">
        <div class="recaptcha"></div>
        <button id="submitForm" type="submit" tabindex="5" class="btn-submit" title="<?php esc_attr_e('Haz click aquí para enviar tu mensaje y empecemos a trabajar', 'robertochoa'); ?>"><?php esc_html_e('Envía tu mensaje', 'robertochoa'); ?></button>
        <div class="loader-css hidden"></div>
        <div id="formResponse" class="response-field"></div>
    </div>
</form>