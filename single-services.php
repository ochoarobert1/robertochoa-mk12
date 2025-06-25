<?php

/**
 * Single Service
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (!defined('ABSPATH')) {
	exit;
}

get_header();
?>
<main id="mainRow" class="service-post-container" itemscope itemtype="https://schema.org/Service">
	<article class="main-post-wrapper service-post-wrapper">
		<meta itemprop="name" content="<?php echo wp_kses_post(get_the_title()); ?>" />
		<link itemprop="mainEntityOfPage" href="<?php echo esc_url(get_permalink()); ?>" />
		<meta itemprop="image" content="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" />
		<meta itemprop="description" content="<?php echo wp_kses_post(get_the_excerpt()); ?>" />
		<div itemprop="areaServed" itemscope itemtype="https://schema.org/Place">
			<meta itemprop="name" content="WorldWide">
		</div>
		<meta itemprop="serviceType" content="<?php echo wp_kses_post(get_the_title()); ?>">
		<div itemprop="provider" itemscope itemtype="https://schema.org/Person">
			<link itemprop="url" href="<?php echo esc_url(home_url('/sobre-mi/')); ?>" />
			<meta itemprop="name" content="<?php echo esc_attr(get_bloginfo('name')); ?>" />
		</div>

		<div class="service-post-content" itemprop="description">
			<?php the_content(); ?>
		</div>
	</article>
</main>
<?php get_footer(); ?>
