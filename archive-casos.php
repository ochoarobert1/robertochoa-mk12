<?php

/**
 * Archive Casos de Exito
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (!defined('ABSPATH')) {
	exit;
}

?>
<?php get_header(); ?>
<main class="main-contain">
	<div id="mainRow" class="custom-row">
		<?php get_template_part('templates/content/banner-title'); ?>
		<section class="archive-grid-container">
			<div class="archive-grid-content">
				<div class="archive-filter">
					<a href="#all" data-filter="all" class="filter-pill"><?php echo esc_html_e('Todos', 'robertochoa'); ?></a>
					<?php $arr_cat_casos = get_terms(['taxonomy' => 'categoria-casos', 'hide_empty' => false, 'orderby' => 'date', 'order' => 'DESC']); ?>
					<?php if (!empty($arr_cat_casos)) : ?>
						<?php foreach ($arr_cat_casos as $cat_caso) : ?>
							<a href="#<?php echo esc_html($cat_caso->slug); ?>" data-filter="<?php echo esc_html($cat_caso->slug); ?>" class="filter-pill"><?php echo esc_html($cat_caso->name); ?></a>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<div id="archiveGrid" class="archive-grid">
					<?php if (have_posts()) :
						while (have_posts()) :
							the_post(); ?>
							<?php get_template_part('templates/content/loop-casos-item'); ?>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
				<div class="archive-pagination">
					<?php the_posts_pagination(array(
						'mid_size'  => 2,
						'prev_text' => '&lsaquo;',
						'next_text' => '&rsaquo;'
					)); ?>
				</div>
		</section>
	</div>
</main>
<?php get_footer(); ?>