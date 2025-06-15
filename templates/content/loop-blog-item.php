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
?>
<article class="main-blog-article">
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
        <?php the_post_thumbnail('full', ['class' => 'response-class']); ?>
    </picture>
    <header class="main-blog-article-header">
        <h3><?php the_title(); ?></h3>
    </header>
    <div class="main-blog-article-content">
        <p><?php the_excerpt(); ?></p>
    </div>
    <footer class="main-blog-article-footer">
        <a href="<?php the_permalink(); ?>"><?php esc_html_e('Leer Más', 'robertochoa'); ?></a>
    </footer>
</article>