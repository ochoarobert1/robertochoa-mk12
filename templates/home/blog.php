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
				<article class="main-blog-article">
					<picture class="main-blog-picture-thumb">
						<?php $terms = get_the_category(); ?>
						<?php if ($terms) : ?>
							<?php foreach ($terms as $term) : ?>
							<a href="<?php echo get_category_link($term); ?>" class="category-icon">
								<?php $term_icon = get_term_meta($term->term_id, 'ro_category_icon', true); ?>
								<img src="<?php echo esc_url($term_icon);  ?>" alt="<?php echo esc_attr($term->name); ?>">
							</a>
							<?php endforeach; ?>
						<?php endif; ?>
						<?php the_post_thumbnail('full', ['class' => 'response-class']); ?>
					</picture>
					<header class="main-blog-article-header">
						<h3><?php the_title(); ?></h3>
					</header>
					<div class="main-blog-article-content">
						<p><?php the_excerpt(); ?></p>
					</div>
					<footer class="main-blog-article-footer">
						<a href="<?php the_permalink(); ?>"><?php esc_html_e('Leer Más', 'robertochoa'); ?></a>
					</footer>
				</article>
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