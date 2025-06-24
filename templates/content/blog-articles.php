<?php

/**
 * Content: Blog Articles Part
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (!defined('ABSPATH')) {
	exit;
}
?>
<section id="blog" class="main-blog-section" itemscope itemtype="https://schema.org/Blog">
	<div class="main-blog-content">
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) :
				the_post(); ?>
				<?php get_template_part('templates/content/loop-blog-item'); ?>
			<?php endwhile; ?>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
	</div>
</section>
