<section class="main-blog-section">
	<header class="main-blog-title">
		<?php $title = ro_meta_value('ro_home_blog_title'); ?>
		<?php $description = ro_meta_value('ro_home_blog_desc'); ?>
		<h2><?php echo esc_html($title); ?></h2>
		<?php echo wp_kses_post(apply_filters('the_content', $description)); ?>
	</header>
	<div class="main-blog-content">
		<?php $arr_blog = new WP_Query([
            'post_type' => 'post',
            'posts_per_page' => 3,
            'order' => 'DESC',
            'orderby' => 'date'
        ]); ?>
		<?php if ($arr_blog->have_posts()) : ?>
			<?php while ($arr_blog->have_posts()) : $arr_blog->the_post(); ?>
				<?php get_template_part('templates/content/loop-blog-item'); ?>
			<?php endwhile; ?>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
	</div>
	<footer class="main-blog-footer">
		<?php $btn_text = ro_meta_value('ro_home_blog_btn_text'); ?>
		<?php $btn_link = ro_meta_value('ro_home_blog_btn_link'); ?>
		<a href="<?php echo esc_url($btn_link); ?>" class="btn-blog" title="<?php echo esc_attr($btn_text); ?>"><?php echo esc_html($btn_text); ?></a>
	</footer>
</section>