<?php

/**
 * Content: Social Icons Template Part
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (!defined('ABSPATH')) {
    exit;
}

$social_icons = get_option('ro_social_networks'); ?>
<div class="social-icons-container">
    <?php if (is_array($social_icons)) : ?>
        <?php foreach ($social_icons as $key => $value) : ?>
            <a href="<?php echo esc_url($value); ?>" target="_blank" class="social-icon">
                <img
                    src="<?php echo esc_url(get_template_directory_uri()); ?>/images/<?php echo esc_attr($key); ?>.svg"
                    width="30"
                    height="30"
                    alt="<?php echo esc_attr($key); ?>" />
            </a>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
