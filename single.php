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
	<article class="main-post-wrapper" itemscope itemtype="https://schema.org/BlogPosting">
		<meta itemprop="headline" content="<?php echo wp_kses_post(get_the_title()); ?>" />
		<link itemprop="mainEntityOfPage" href="<?php echo esc_url(get_permalink()); ?>" />
		<meta itemprop="image" content="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" />
		<meta itemprop="description" content="<?php echo wp_kses_post(get_the_excerpt()); ?>" />

		<div itemprop="author" itemscope itemtype="https://schema.org/Person">
			<link itemprop="url" href="<?php echo esc_url(home_url('/sobre-mi/')); ?>" />
			<meta itemprop="name" content="<?php echo esc_attr(get_bloginfo('name')); ?>" />
		</div>

		<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
			<meta itemprop="name" content="<?php echo esc_attr(get_bloginfo('name')); ?>" />
			<link itemprop="url" href="<?php echo esc_url(home_url('/')); ?>" />
			<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
				<?php if (has_custom_logo()) : ?>
					<?php $custom_logo_id = get_theme_mod('custom_logo'); ?>
					<?php $image = wp_get_attachment_image_src($custom_logo_id, 'full', false); ?>
					<?php $logo = $image[0]; ?>
				<?php else : ?>
					<?php $logo = esc_url(get_template_directory_uri()) . '/images/logo.svg'; ?>
				<?php endif; ?>
				<link itemprop="url" href="<?php echo esc_url($logo); ?>" />
				<meta itemprop="width" content="70" />
				<meta itemprop="height" content="58" />
			</div>
		</div>

		<?php $arr_tags = get_the_tags(); ?>
		<?php if (!empty($arr_tags) && !is_wp_error($arr_tags)) : ?>
			<?php foreach ($arr_tags as $item_term) : ?>
				<?php $term_array[] = $item_term->name; ?>
			<?php endforeach; ?>
			<meta itemprop="keywords" content="<?php echo esc_attr(implode(',', $term_array)); ?>" />
		<?php endif; ?>

		<div class="main-post-meta-wrapper">
			<div class="main-post-meta-item main-post-meta-category">
				<img src="<?php echo esc_url(get_template_directory_uri() . '/images/category-min.svg') ?>" alt="<?php esc_attr_e('Fecha', 'robertochoa'); ?>" />
				<?php $arr_categories = get_the_category(); ?>
				<?php if (!empty($arr_categories) && !is_wp_error($arr_categories)) : ?>
					<?php $category = $arr_categories[0]; ?>
					<?php if (!empty($category)) : ?>
						<a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="main-post-meta-category-link">
							<?php echo esc_html($category->name);
							?>
						</a>
					<?php endif; ?>
				<?php endif; ?>
			</div>
			<div class="main-post-meta-item main-post-meta-date">
				<img src="<?php echo esc_url(get_template_directory_uri() . '/images/calendar-min.svg') ?>" alt="<?php esc_attr_e('Fecha', 'robertochoa'); ?>" />
				<time itemprop="datePublished" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
					<?php echo esc_html(get_the_date('m/d/Y')); ?>
				</time>
				<meta itemprop="dateModified" content="<?php echo esc_attr(get_the_date('c')); ?>" />
			</div>
		</div>

		<div class="main-post-content" itemprop="articleBody">
			<?php the_content(); ?>
		</div>

		<?php if (comments_open() || get_comments_number()) {
			comments_template();
		} ?>

	</article>
	<aside id="main-sidebar" class="main-post-aside">
		<div class="main-post-image-wrapper">
			<h3><?php echo esc_html_e('Estas leyendo:', 'robertochoa'); ?></h3>
			<?php the_post_thumbnail('full', ['loading' => 'lazy', 'class' => 'hidden w-full lg:block']); ?>
		</div>
		<div id="sidebarWrapper" class="main-post-sidebar-wrapper">
			<?php get_template_part('templates/content/sidebar', 'sidebar'); ?>
		</div>
	</aside>
	<div class="related-articles">
		<?php get_template_part('templates/content/related-articles'); ?>
	</div>
</main>
<?php get_footer(); ?>
