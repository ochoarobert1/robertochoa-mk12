<?php

/**
 * Home: Services Template Part
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<section id="services" class="main-services-container" itemscope itemtype="https://schema.org/ServiceChannel">
    <header class="main-services-title">
        <?php $service_title = ro_meta_value('ro_home_services_title'); ?>
        <?php $service_desc = ro_meta_value('ro_home_services_desc'); ?>
        <h2 itemprop="name"><?php echo esc_html($service_title);  ?></h2>
        <div itemprop="description">
            <?php echo wp_kses_post(apply_filters('the_content', $service_desc)); ?>
        </div>
    </header>
    <div class="main-services-content" itemprop="providesService" itemscope itemtype="https://schema.org/Service">
        <?php $array_services = new WP_Query(['post_type' => 'services', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC']); ?>
        <?php if ($array_services->have_posts()) : ?>
            <?php while ($array_services->have_posts()) :
                $array_services->the_post(); ?>
                <article class="main-services-item">
                    <picture>
                        <?php echo esc_html(the_post_thumbnail('full', array('class' => 'response-class', 'itemprop' => 'image', 'loading' => 'lazy'))); ?>
                    </picture>
                    <h3 itemprop="name"><?php echo esc_html(get_the_title()); ?></h3>
                    <meta itemprop="serviceType" content="<?php echo esc_attr(get_the_title()); ?>" />
                    <meta itemprop="description" content="<?php echo wp_kses_post(get_small_description(get_the_ID())); ?>" />
                </article>
            <?php endwhile; ?>
        <?php endif; ?>
        <?php wp_reset_query(); ?>
    </div>
    <div class="main-services-content-button" itemprop="potentialAction" itemscope itemtype="http://schema.org/CommunicateAction">
        <?php $btn_link = ro_meta_value('ro_home_services_btn_url'); ?>
        <?php $btn_text = ro_meta_value('ro_home_services_btn_text'); ?>
        <?php if ('' !== $btn_link) : ?>
            <a href="<?php echo esc_url($btn_link); ?>" class="btn" title="<?php echo esc_attr($btn_text);  ?>" itemprop="target"><span itemprop="name"><?php echo esc_html($btn_text); ?></span></a>
            <meta itemprop="actionStatus" content="https://schema.org/PotentialActionStatus" />
        <?php endif; ?>
    </div>
</section>