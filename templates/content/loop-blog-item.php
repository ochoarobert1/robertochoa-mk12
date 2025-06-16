<?php

/**
 * Content: Articles Template Part
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (!defined('ABSPATH')) {
    exit;
}
if (has_custom_logo()) :
    $custom_logo_id = get_theme_mod('custom_logo');
    $image = wp_get_attachment_image_src($custom_logo_id, 'full', false);
    $logo = $image[0];
else :
    $logo = esc_url(get_template_directory_uri()) . '/images/logo.svg';
endif;
?>
<article class="main-blog-article" itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
    <picture class="main-blog-picture-thumb">
        <?php $terms = get_the_category(); ?>
        <?php if ($terms) : ?>
            <?php foreach ($terms as $item) : ?>
                <a href="<?php echo esc_url(get_category_link($item)); ?>" class="category-icon">
                    <?php $term_icon = get_term_meta($item->term_id, 'ro_category_icon', true); ?>
                    <img src="<?php echo esc_url($term_icon);  ?>" alt="<?php echo esc_attr($item->name); ?>">
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php the_post_thumbnail('full', ['class' => 'response-class', 'itemprop' => 'image']); ?>
    </picture>
    <header class="main-blog-article-header">
        <h3 itemprop="name headline"><?php the_title(); ?></h3>
    </header>
    <div class="main-blog-article-content">
        <p itemprop="description"><?php the_excerpt(); ?></p>
    </div>
    <footer class="main-blog-article-footer">
        <a href="<?php the_permalink(); ?>" itemprop="url"><?php esc_html_e('Leer Más', 'robertochoa'); ?></a>
    </footer>
    <div itemprop="author" itemscope itemtype="https://schema.org/Person">
        <meta itemprop="name" content="Robert Ochoa" />
        <link itemprop="url" href="<?php echo esc_url(home_url('/')); ?>" />
    </div>
    <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
        <meta itemprop="name" content="Robert Ochoa Web">
        <link itemprop="url" href="<?php echo esc_url(home_url('/')); ?>" />
        <link itemprop="logo" href="<?php esc_url($logo); ?>" />
    </div>
    <meta itemprop="datePublished" content="<?php echo esc_attr(get_the_date('Y-m-d')); ?>" />
    <meta itemprop="dateModified" content="<?php echo esc_attr(get_the_date('Y-m-d')); ?>" />
</article>