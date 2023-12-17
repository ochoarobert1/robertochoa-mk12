<?php

/**
 * Template Name: Page Home
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */
?>
<?php get_header(); ?>
<?php the_post(); ?>
<main class="main-contain">
    <div id="mainRow" class="custom-row">
        <section class="main-hero-container" style="background-color: #FFF;">
            <article class="main-hero-content">
                <?php the_content(); ?>
                <div class="main-hero-content-button" itemprop="potentialAction" itemscope itemtype="http://schema.org/CommunicateAction">
                    <a href="#" class="btn" title="<?php _e('Hablemos de como comenzar tu negocio', 'robertochoa') ?>" itemprop="target"><span itemprop="name"><?php _e('Hablemos', 'robertochoa'); ?></span></a>
                </div>
            </article>
            <picture class="main-hero-image" style="z-index: 99;">
                <lottie-player src="<?php echo get_template_directory_uri(); ?>/js/animation.json" background="rgba(0, 0, 0, 0)" speed="1" style="z-index: -1; width: 70%; height: auto; margin: 2rem auto;" loop autoplay></lottie-player>
                <?php //the_post_thumbnail('full', array('class' => 'response-class', 'itemprop' => 'image', 'loading' => 'lazy'));
                ?>
            </picture>
        </section>
        <?php $arr_numbers = ro_meta_value('ro_home_numbers_group'); ?>
        <?php if (!empty($arr_numbers)) : ?>
            <section class="main-numbers-container">
                <div class="main-numbers-content">
                    <?php foreach ($arr_numbers as $item) { ?>
                        <article class="main-numbers-item">
                            <?php echo wp_kses_post(wp_get_attachment_image($item['icon_id'], 'full', false, array('class' => 'response-class', 'itemprop' => 'image', 'loading' => 'lazy'))); ?>
                            <span class="number"><?php echo esc_html($item['number']) ?></span>
                            <?php echo wp_kses_post(apply_filters('the_content', $item['desc'])); ?>
                        </article>
                    <?php } ?>
                </div>
            </section>
        <?php endif; ?>
        <section class="main-about-container" style="z-index: 3;">
            <div class="main-about-content">
                <picture class="main-about-image">
                    <?php $image_about = ro_meta_value('ro_home_about_image_id'); ?>
                    <?php echo wp_kses_post(wp_get_attachment_image($image_about, 'full', false, array('class' => 'response-class', 'itemprop' => 'image', 'loading' => 'lazy'))); ?>
                </picture>
                <article class="main-about-info">
                    <?php $desc_about = ro_meta_value('ro_home_about_desc'); ?>
                    <?php echo wp_kses_post(apply_filters('the_content', $desc_about)); ?>
                    <div class="main-hero-content-button" itemprop="potentialAction" itemscope itemtype="http://schema.org/CommunicateAction">
                        <?php $btn_link = ro_meta_value('ro_home_about_btn_link'); ?>
                        <?php $btn_text = ro_meta_value('ro_home_about_btn_text'); ?>
                        <a href="<?php echo esc_url($btn_link); ?>" class="btn" title="<?php echo esc_attr($btn_text);  ?>" itemprop="target"><span itemprop="name"><?php echo $btn_text; ?></span></a>
                    </div>
                </article>
            </div>
        </section>
        <section class="main-tools-container">
            <?php $tools_title = ro_meta_value('ro_home_tools_title'); ?>
            <h2><?php echo esc_html($tools_title); ?></h2>
            <div class="main-tools-content">
                <?php $tools_icons = ro_meta_value('ro_home_tools_icons'); ?>
                <?php if ($tools_icons != '') : ?>
                    <?php foreach ($tools_icons as $key => $value) { ?>
                        <?php $image_alt = get_post_meta($key, '_wp_attachment_image_alt', true); ?>
                        <picture class="main-tools-item">
                            <img src=<?php echo esc_url($value); ?> alt="<?php echo esc_attr($image_alt); ?>" class="response-class" loading="lazy" width="200" height="47" />
                        </picture>
                    <?php } ?>
                <?php endif; ?>
            </div>
        </section>
        <section class="main-services-container">
            <header class="main-services-title">
                <?php $service_title = ro_meta_value('ro_home_services_title'); ?>
                <?php $service_desc = ro_meta_value('ro_home_services_desc'); ?>
                <h2><?php echo esc_html($service_title);  ?></h2>
                <?php echo wp_kses_post(apply_filters('the_content', $service_desc)); ?>
            </header>
            <div class="main-services-content">
                <?php $array_services = new WP_Query(['post_type' => 'services', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC']); ?>
                <?php if ($array_services->have_posts()) : ?>
                    <?php while ($array_services->have_posts()) : $array_services->the_post(); ?>
                        <article class="main-services-item">
                            <picture>
                                <?php echo the_post_thumbnail('full', array('class' => 'response-class', 'itemprop' => 'image', 'loading' => 'lazy')); ?>
                            </picture>
                            <h3><?php echo esc_html(get_the_title()); ?></h3>
                        </article>
                    <?php endwhile; ?>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
            </div>
            <div class="main-services-content-button" itemprop="potentialAction" itemscope itemtype="http://schema.org/CommunicateAction">
                <?php $btn_link = ro_meta_value('ro_home_services_btn_link'); ?>
                <?php $btn_text = ro_meta_value('ro_home_services_btn_text'); ?>
                <a href="<?php echo esc_url($btn_link); ?>" class="btn" title="<?php echo esc_attr($btn_text);  ?>" itemprop="target"><span itemprop="name"><?php echo esc_html($btn_text); ?></span></a>
            </div>
        </section>
        <section class="main-success-container">
            <header class="main-success-title">
                <?php $portfolio_title = ro_meta_value('ro_home_portfolio_title'); ?>
                <h2><?php echo esc_html($portfolio_title); ?></h2>
            </header>
            <?php $arr_portfolio = new WP_Query([
                    'post_type' => 'casos',
                    'posts_per_page' => -1,
                    'orderby' => 'title',
                    'order' => 'ASC',
                    'tax_query' => [[
                        'taxonomy' => 'categoria-casos',
                        'field' => 'slug',
                        'terms' => ['destacado']
                    ]]
                ]); ?>
            <?php if ($arr_portfolio->have_posts()) : ?>
            <div class="main-success-portfolio-container">
                <?php while ($arr_portfolio->have_posts()) : $arr_portfolio->the_post(); ?>
                <article id="<?php the_ID() ?>" class="main-success-portfolio-item">
                    <picture>
                        <?php the_post_thumbnail('full', ['class' => 'response-class']); ?>
                    </picture>
                    <header>
                        <h3><?php the_title(); ?></h3>
                        <div class="category-list">
                            <?php $terms = get_the_terms(get_the_ID(), 'categoria-casos'); ?>
                            <?php if ($terms) : ?>
                                <?php foreach ($terms as $term) : ?>
                                    <?php if ($term->name !== 'Destacado') : ?>
                                        <a href="<?php echo esc_url(get_term_link($term)); ?>" class="category-item"><?php echo esc_html($term->name); ?></a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="btn-portfolio"><?php _e('Ver Caso de Éxito', 'robertochoa'); ?></a>
                    </header>
                </article>
                <?php endwhile; ?>
            </div>
            <?php endif; ?>
            <?php wp_reset_query(); ?>
            <div class="main-success-content-button" itemprop="potentialAction" itemscope itemtype="http://schema.org/CommunicateAction">
                <?php $btn_link = ro_meta_value('ro_home_portfolio_btn_link'); ?>
                <?php $btn_text = ro_meta_value('ro_home_portfolio_btn_text'); ?>
                <a href="<?php echo esc_url($btn_link); ?>" class="btn" title="<?php echo esc_attr($btn_text);  ?>" itemprop="target"><span itemprop="name"><?php echo esc_html($btn_text); ?></span></a>
            </div>
        </section>
    </div>
</main>
<?php get_footer(); ?>