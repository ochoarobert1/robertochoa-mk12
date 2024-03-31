<section class="main-tools-container">
    <?php $tools_title = ro_meta_value('ro_home_tools_title'); ?>
    <h2><?php echo esc_html($tools_title); ?></h2>
    <div class="main-tools-content">
        <?php $tools_icons = ro_meta_value('ro_home_tools_icons'); ?>
        <?php if ($tools_icons != '') : ?>
            <?php foreach ($tools_icons as $key => $value) { ?>
                <?php $image_alt = get_post_meta($key, '_wp_attachment_image_alt', true); ?>
            <picture class="main-tools-item">
                <img src=<?php echo esc_url($value); ?> alt="<?php echo esc_attr($image_alt); ?>" class="response-class" loading="lazy" width="200" height="47" />
            </picture>
            <?php } ?>
        <?php endif; ?>
    </div>
</section>