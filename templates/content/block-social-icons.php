<?php

$social_icons = get_option('ro_social_networks'); ?>
<div class="social-icons-container">
  <?php if (is_array($social_icons)) : ?>
        <?php foreach ($social_icons as $key => $value) : ?>
      <a href="<?php echo esc_url($value); ?>" target="_blank" class="social-icon">
        <img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo esc_attr($key); ?>.svg" width="30" height="30" alt="<?php echo esc_attr($key); ?>">
      </a>
        <?php endforeach;
  endif; ?>
</div>
