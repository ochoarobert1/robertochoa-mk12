<?php

/**
 * Archive
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

?>
<?php get_header(); ?>
<main class="main-contain">
	<div id="mainRow" class="custom-row">
		<?php get_template_part('templates/home/banner'); ?>
		<?php get_template_part('templates/content/blog-articles'); ?>
		<div class="archive-pagination">
			<?php the_posts_pagination(array(
				'mid_size'  => 2,
				'prev_text' => '&lsaquo;',
				'next_text' => '&rsaquo;'
			)); ?>
		</div>
	</div>
</main>
<?php get_footer(); ?>
