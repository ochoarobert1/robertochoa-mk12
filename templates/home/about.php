<?php

/**
 * Home: About Template Part
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<section id="about" class="main-about-container" style="z-index: 3;">
    <div class="main-about-content">
        <picture class="main-about-image">
            <?php $image_about = ro_meta_value('ro_home_about_image_id'); ?>
            <?php echo wp_kses_post(wp_get_attachment_image($image_about, 'full', false, array('class' => 'response-class', 'itemprop' => 'image', 'loading' => 'lazy'))); ?>
        </picture>
        <article class="main-about-info">
            <?php $desc_about = ro_meta_value('ro_home_about_desc'); ?>
            <?php echo wp_kses_post(apply_filters('the_content', $desc_about)); ?>
            <div class="main-hero-content-button" itemprop="potentialAction" itemscope itemtype="http://schema.org/CommunicateAction">
                <?php $btn_link = ro_meta_value('ro_home_about_btn_url'); ?>
                <?php $btn_text = ro_meta_value('ro_home_about_btn_text'); ?>
                <?php if ('' !== $btn_link) : ?>
                <a href="<?php echo esc_url($btn_link); ?>" class="btn" title="<?php echo esc_attr($btn_text);  ?>" itemprop="target"><span itemprop="name"><?php echo esc_html($btn_text); ?></span></a>
                <?php endif; ?>
            </div>
        </article>
    </div>
</section>