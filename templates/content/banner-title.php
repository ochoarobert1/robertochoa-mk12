<?php

/**
 * Content: Banner Title Template Part
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (!defined('ABSPATH')) {
	exit;
}
?>
<section class="banner-title-container">
	<div class="banner-title-wrapper">
		<h1 class="banner-title">
			<?php if (is_archive() || is_home()) : ?>
				<?php echo wp_kses_post(get_the_archive_title()); ?>
			<?php else : ?>
				<?php the_title(); ?>
			<?php endif; ?>
		</h1>
		<div class="banner-subtitle">
			<?php if (is_single('post')) : ?>
				<?php echo wp_kses_post(get_the_excerpt()); ?>
			<?php else : ?>
				<?php echo wp_kses_post(get_the_archive_description()); ?>
			<?php endif; ?>
		</div>
	</div>

</section>
