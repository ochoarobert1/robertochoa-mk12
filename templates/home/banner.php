<?php

/**
 * Home: Banner Template Part
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<section class="main-hero-container" style="background-color: #FFF;">
    <article class="main-hero-content">
        <?php the_content(); ?>
        <div class="main-hero-content-button" itemprop="potentialAction" itemscope itemtype="http://schema.org/CommunicateAction">
            <a href="#" class="btn" title="<?php esc_attr_e('Hablemos de como comenzar tu negocio', 'robertochoa'); ?>" itemprop="target"><span itemprop="name"><?php esc_html_e('Hablemos', 'robertochoa'); ?></span></a>
        </div>
    </article>
    <picture class="main-hero-image" style="z-index: 99;">
        <lottie-player src="<?php echo esc_url(get_template_directory_uri() . '/dist/animation.json'); ?>" background="rgba(0, 0, 0, 0)" speed="1" style="z-index: -1; width: 70%; height: auto; margin: 2rem auto;" loop autoplay></lottie-player>
    </picture>
</section>