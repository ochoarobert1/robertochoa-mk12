<section class="main-contact-section">
	<header class="main-contact-title">
		<?php $title = ro_meta_value('ro_home_contact_title'); ?>
		<?php $description = ro_meta_value('ro_home_contact_desc'); ?>
		<h2><?php echo esc_html($title); ?></h2>
		<?php echo wp_kses_post(apply_filters('the_content', $description)); ?>
	</header>
	<div class="main-contact-content">
		<?php echo get_template_part('templates/content/block-contact-data'); ?>
		<?php echo get_template_part('templates/content/block-contact-form'); ?>
	</div>
</section>