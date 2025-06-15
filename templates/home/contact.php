<?php

/**
 * Home: Contact Template Part
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<section class="main-contact-section">
    <header class="main-contact-title">
        <?php $contact_title = ro_meta_value('ro_home_contact_title'); ?>
        <?php $description = ro_meta_value('ro_home_contact_desc'); ?>
        <h2><?php echo esc_html($contact_title); ?></h2>
        <?php echo wp_kses_post(apply_filters('the_content', $description)); ?>
    </header>
    <div class="main-contact-content">
        <?php get_template_part('templates/content/block-contact-data'); ?>
        <?php get_template_part('templates/content/block-contact-form'); ?>
    </div>
</section>