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
        <label for="name"><?php esc_html_e('Nombre y Apellido', 'robertochoa'); ?></label>
        <input id="name" name="name" autocomplete="name" type="text" class="form-control" tabindex="1" placeholder="<?php esc_attr_e('Ingresa tu nombre y apellido', 'robertochoa'); ?>" required />
        <small class="error hidden"></small>
    </fieldset>
    <fieldset class="form-group">
        <label for="email"><?php esc_html_e('Correo Electrónico', 'robertochoa'); ?></label>
        <input id="email" name="email" autocomplete="email" type="email" class="form-control" tabindex="2" placeholder="<?php esc_attr_e('Ingresa tu correo electrónico', 'robertochoa'); ?>" required />
        <small class="error hidden"></small>
    </fieldset>
    <fieldset class="form-group">
        <label for="phone"><?php esc_html_e('Teléfono', 'robertochoa'); ?></label>
        <input id="phone" name="phone" type="text" class="form-control" tabindex="3" placeholder="<?php esc_attr_e('Ingresa tu número telefónico', 'robertochoa'); ?>" required />
        <small class="error hidden"></small>
    </fieldset>
    <fieldset class="form-group">
        <label for="message"><?php esc_html_e('Mensaje', 'robertochoa'); ?></label>
        <textarea name="message" id="message" class="form-control form-control-textarea" cols="30" rows="10" tabindex="4" placeholder="<?php esc_attr_e('Describeme tu idea aqui, intenta ser descriptivo', 'robertochoa'); ?>" required></textarea>
        <small class="error hidden"></small>
    </fieldset>
    <div class="form-group form-group-submit">
        <div class="recaptcha"></div>
        <button id="submitForm" type="submit" tabindex="5" class="btn-submit" title="<?php esc_attr_e('Haz click aquí para enviar tu mensaje y empecemos a trabajar', 'robertochoa'); ?>"><?php esc_html_e('Envía tu mensaje', 'robertochoa'); ?></button>
        <div id="responseForm" class="response-field"></div>
    </div>
</form>