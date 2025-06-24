<?php

/**
 * Content: Related Articles Template Part
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (!defined('ABSPATH')) {
	exit;
}
$current_id = get_the_ID();
?>
<section id="blog" class="main-blog-section" itemscope itemtype="https://schema.org/Blog">
	<header class="main-blog-title">
		<h2 itemprop="name"><?php echo esc_html_e('Articulos Relacionados', 'robertochoa'); ?></h2>
	</header>
	<div class="main-blog-content">
		<?php $arr_blog = new WP_Query([
			'post_type' => 'post',
			'posts_per_page' => 3,
			'order' => 'DESC',
			'orderby' => 'date',
			'post__not_in' => [$current_id]
		]); ?>
		<?php if ($arr_blog->have_posts()) : ?>
			<?php while ($arr_blog->have_posts()) :
				$arr_blog->the_post(); ?>
				<?php get_template_part('templates/content/loop-blog-item'); ?>
			<?php endwhile; ?>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
	</div>
	<footer class="main-blog-footer">
		<?php $btn_text = ro_meta_value('ro_home_blog_btn_text'); ?>
		<?php $btn_link = ro_meta_value('ro_home_blog_btn_url'); ?>
		<?php if ('' !== $btn_link) : ?>
			<a href="<?php echo esc_url($btn_link); ?>" class="btn-blog" title="<?php echo esc_attr($btn_text); ?>"><?php echo esc_html($btn_text); ?></a>
		<?php endif; ?>
	</footer>
</section>
