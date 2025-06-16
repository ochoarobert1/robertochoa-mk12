<?php

/**
 * Content: Contact Data Template Part
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */


if (!defined('ABSPATH')) {
    exit;
}

$contact_data = get_option('ro_contact_data');
$description = ro_meta_value('ro_home_contact_data_desc');

if (!empty($contact_data)) : ?>
    <div class="contact-data-container">
        <h3><?php esc_html_e('Información de Contacto', 'robertochoa'); ?></h3>
        <?php echo wp_kses_post(apply_filters('the_content', $description)); ?>
        <div class="contact-data">
            <?php $contact_phones = explode(',', $contact_data['phone']); ?>
            <?php if (is_array($contact_phones)) : ?>
                <div class="contact-data-item" itemprop="contactPoint" itemscope itemtype="https://schema.org/ContactPoint">
                    <h4><?php esc_html_e('Teléfono:', 'robertochoa'); ?></h4>
                    <meta itemprop="contactType" content="customer service" />
                    <?php foreach ($contact_phones as $phone) : ?>
                        <div class="contact-data-phone-item">
                            <div class="contact-data-item-icon">
                                <img src="<?php echo esc_url(get_template_directory_uri()) . '/images/phone.svg'; ?>" height="25" width="25" alt="Phone Icon" />
                            </div>
                            <div class="contact-data-item-content">
                                <a href="<?php echo esc_url('tel:' . esc_attr($phone)); ?>" itemprop="telephone"><?php echo esc_html(phoneFormatter(trim($phone))); ?></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <meta itemprop="areaServed" content="Global" />
                    <meta itemprop="availableLanguage" content="es, en" />
                </div>
            <?php endif; ?>
            <div class="contact-data-item" itemprop="contactPoint" itemscope itemtype="https://schema.org/ContactPoint">
                <h4><?php esc_html_e('Correo Electrónico:', 'robertochoa'); ?></h4>
                <meta itemprop="contactType" content="customer service" />
                <div class="contact-data-item-icon">
                    <img src="<?php echo esc_url(get_template_directory_uri()) . '/images/email.svg'; ?>" height="25" width="25" alt="Phone Icon" />
                </div>
                <div class="contact-data-item-content">
                    <a href="<?php echo esc_url('mailto:' . $contact_data['email']); ?>" itemprop="email"><?php echo esc_html(emailFormatter($contact_data['email'])); ?></a>
                </div>
                <meta itemprop="areaServed" content="Global" />
                <meta itemprop="availableLanguage" content="es, en" />
            </div>
            <div class="contact-data-item" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                <h4><?php esc_html_e('Dirección:', 'robertochoa'); ?></h4>
                <div class="contact-data-item-icon">
                    <img src="<?php echo esc_url(get_template_directory_uri()) . '/images/map.svg'; ?>" height="25" width="25" alt="Phone Icon" />
                </div>
                <div class="contact-data-item-content">
                    <p><?php echo esc_html($contact_data['address']); ?></p>
                    <meta itemprop="addressLocality" content="Los Teques" />
                    <meta itemprop="addressRegion" content="Miranda" />
                    <meta itemprop="addressCountry" content="Venezuela" />
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>