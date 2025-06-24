<?php

/**
 * Single Post
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (!defined('ABSPATH')) {
	exit;
}

get_header();
get_template_part('templates/content/banner-title');
?>
<main id="mainRow" class="article-post-container">
	<article class="main-post-wrapper">
		<?php the_content(); ?>

		<?php if (comments_open() || get_comments_number()) {
			comments_template();
		} ?>

	</article>
	<aside id="main-sidebar" class="main-post-aside">
		<?php get_template_part('templates/content/sidebar', 'sidebar'); ?>
	</aside>
	<div class="related-articles">
		<?php get_template_part('templates/content/related-articles'); ?>
	</div>
</main>


<?php get_footer();
