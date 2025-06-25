<?php

/**
 * Template Name: Page w/ Title
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
<?php the_post(); ?>
<main class="main-contain">
	<div id="mainRow" class="custom-row">
		<?php get_template_part('templates/content/banner-title'); ?>
		<?php the_content(); ?>
	</div>
</main>
<?php get_footer(); ?>
