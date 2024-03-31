<?php

if (!defined('ABSPATH')) {
    exit;
}

$contact_data = get_option('ro_contact_data');
$description = ro_meta_value('ro_home_contact_data_desc');

if (!empty($contact_data)) : ?>
<div class="contact-data-container">
	<h3><?php esc_html_e('Información de Contacto', 'robertochoa'); ?></h3>
	<?php echo apply_filters('the_content', $description); ?>
	<div class="contact-data">
		<?php $contact_phones = explode(',', $contact_data['phone']); ?>
		<?php if (is_array($contact_phones)) : ?>
		<div class="contact-data-item">
			<h4><?php esc_html_e('Teléfono:', 'robertochoa'); ?></h4>
			<?php foreach ($contact_phones as $phone) : ?>
			<div class="contact-data-phone-item">
				<div class="contact-data-item-icon">
					<img src="<?php echo esc_url(get_template_directory_uri()) . '/images/phone.svg'; ?>" height="25" width="25" alt="Phone Icon" />
				</div>
				<div class="contact-data-item-content">
					<a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html(phoneFormatter(trim($phone))); ?></a>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
		<div class="contact-data-item">
			<h4><?php esc_html_e('Correo Electrónico:', 'robertochoa'); ?></h4>
			<div class="contact-data-item-icon">
			<img src="<?php echo esc_url(get_template_directory_uri()) . '/images/email.svg'; ?>" height="25" width="25" alt="Phone Icon" />
			</div>
			<div class="contact-data-item-content">
				<a href="<?php echo esc_attr($contact_data['email']); ?>"><?php echo esc_html(emailFormatter($contact_data['email'])); ?></a>
			</div>
		</div>
		<div class="contact-data-item">
			<h4><?php esc_html_e('Dirección:', 'robertochoa'); ?></h4>
			<div class="contact-data-item-icon">
			<img src="<?php echo esc_url(get_template_directory_uri()) . '/images/map.svg'; ?>" height="25" width="25" alt="Phone Icon" />
			</div>
			<div class="contact-data-item-content">
				<p><?php echo esc_html($contact_data['address']); ?></p>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>