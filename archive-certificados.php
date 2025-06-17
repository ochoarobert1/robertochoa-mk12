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
				<div id="archiveGrid" class="archive-grid">
					<?php if (have_posts()) :
						while (have_posts()) :
							the_post(); ?>
							<?php get_template_part('templates/content/loop-certificados-item'); ?>
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