<?php

/**
 * Content: Item Casos de Exito
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (!defined('ABSPATH')) {
    exit;
}

$filter_terms = [];
$arr_terms = get_the_terms(get_the_ID(), 'categoria-casos');
$arr_techs = get_the_terms(get_the_ID(), 'tecnología');

if (!empty($arr_terms)) :
    foreach ($arr_terms as $item_terms) :
        $filter_terms[] = $item_terms->slug;
        $filter_tags[] = $item_terms->name;
    endforeach;
endif;

if (!empty($arr_techs)) :
    foreach ($arr_techs as $item_tech) :
        $filter_tech_tags[] = $item_tech->name;
    endforeach;
endif;

?>
<article class="loop-casos-item <?php echo esc_attr(implode(' ', $filter_terms)); ?>" itemscope itemtype="https://schema.org/Service">
    <div class="loop-casos-item__img">
        <a href="<?php the_permalink(); ?>" itemprop="url">
            <?php
            $large_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large-thumb');
            $mobile_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'mobile-thumb');
            ?>
            <picture>
                <source media="(min-width: 768px)" srcset="<?php echo esc_url($large_image[0]); ?>" />
                <source media="(max-width: 767px)" srcset="<?php echo esc_url($mobile_image[0]); ?>" />
                <img src="<?php echo esc_url($large_image[0]); ?>"
                    alt="<?php the_title_attribute(); ?>"
                    class="wp-post-image" />
            </picture>
        </a>
    </div>
    <div class="loop-casos-item__content">
        <h2 class="loop-casos-item__title" itemprop="name url"><?php the_title(); ?></h2>
        <meta itemprop="description" content="<?php echo wp_kses_post(get_small_description(get_the_ID())); ?>" />
        <meta itemprop="serviceType" content="<?php echo esc_attr(implode(' ', $filter_tags)); ?> <?php echo esc_attr(implode(' ', $filter_tech_tags)); ?>" />
        <meta itemprop="image" content="<?php echo esc_url($large_image[0]); ?>" />
        <meta itemprop="url" content="<?php echo esc_url(get_the_permalink()); ?>" />
        <div itemprop="provider" itemscope itemtype="https://schema.org/Person">
            <meta itemprop="name" content="Robert Ochoa" />
            <meta itemprop="url" content="https://robertochoaweb.com" />
        </div>
        <div itemprop="areaServed" itemscope itemtype="https://schema.org/Place">
            <meta itemprop="name" content="Worldwide" />
        </div>
        <?php if (!empty($arr_terms)) : ?>
            <div class="loop-casos-item__terms">
                <?php foreach ($arr_terms as $item_terms) : ?>
                    <?php if ($item_terms->parent == 0) : ?>
                        <?php $term_link = get_term_link($item_terms->term_id); ?>
                        <?php if (!is_wp_error($term_link)) : ?>
                            <a href="<?php echo esc_url($term_link); ?>" class="loop-casos-item__category"><?php echo wp_kses_post($item_terms->name); ?></a>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="loop-casos-item__buttons">
            <a href="<?php the_permalink(); ?>" class="loop-casos-item__link"><?php echo esc_html_e('Ver Caso de Éxito', 'robertochoa'); ?></a>
            <a href="<?php echo esc_url(get_post_meta(get_the_ID(), 'ro_caso_url', true)); ?>" class="loop-casos-item__external"><?php echo esc_html_e('Ver Página Web', 'robertochoa'); ?></a>
        </div>
    </div>
</article>