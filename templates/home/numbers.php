<?php $arr_numbers = ro_meta_value('ro_home_numbers_group'); ?>
<?php if (!empty($arr_numbers)) : ?>
<section class="main-numbers-container">
    <div class="main-numbers-content">
    <?php foreach ($arr_numbers as $item) { ?>
        <article class="main-numbers-item">
            <?php echo wp_kses_post(wp_get_attachment_image($item['icon_id'], 'full', false, array('class' => 'response-class', 'itemprop' => 'image', 'loading' => 'lazy'))); ?>
            <span class="number"><?php echo esc_html($item['number']) ?></span>
            <?php echo wp_kses_post(apply_filters('the_content', $item['desc'])); ?>
        </article>
    <?php } ?>
    </div>
</section>
<?php endif; ?>