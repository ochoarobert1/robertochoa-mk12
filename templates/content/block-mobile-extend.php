<?php $contact_data = get_option('ro_contact_data'); ?>
<div class="mobile-extend contact-data">
  <?php $contact_phones = explode(',', $contact_data['phone']); ?>
  <?php if (is_array($contact_phones)) : ?>
  <div class="contact-data-item">
        <?php foreach ($contact_phones as $phone) : ?>
      <div class="contact-data-phone-item">
          <div class="contact-data-item-icon">
              <img src="<?php echo esc_url(get_template_directory_uri()) . '/images/phone.svg'; ?>" height="25" width="25" alt="Phone Icon" />
          </div>
          <div class="contact-data-item-content">
              <a href="<?php echo esc_url('tel:' . esc_attr($phone)); ?>"><?php echo esc_html(phoneFormatter(trim($phone))); ?></a>
          </div>
      </div>
        <?php endforeach; ?>
  </div>
  <?php endif; ?>
  <div class="contact-data-item">
      <div class="contact-data-item-icon">
      <img src="<?php echo esc_url(get_template_directory_uri()) . '/images/email.svg'; ?>" height="25" width="25" alt="Phone Icon" />
      </div>
      <div class="contact-data-item-content">
          <a href="<?php echo esc_url('mailto:' . $contact_data['email']); ?>"><?php echo esc_html(emailFormatter($contact_data['email'])); ?></a>
      </div>
  </div>
</div>
