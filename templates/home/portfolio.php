<section class="main-success-container">
    <header class="main-success-title">
        <?php $portfolio_title = ro_meta_value('ro_home_portfolio_title'); ?>
        <h2><?php echo esc_html($portfolio_title); ?></h2>
    </header>
    <?php $i = 0; ?>
    <?php $arr_boxes = ro_meta_value('ro_home_portfolio_boxes'); ?>
    <?php $arr_portfolio = ro_meta_value('ro_home_portfolio_selected'); ?>
    <?php if (is_array($arr_portfolio)) : ?>
        <div class="main-success-portfolio-container">
            <?php foreach ($arr_portfolio as $portfolio) : ?>
                <?php setup_postdata($portfolio); ?>
                <article id="<?php echo esc_attr(get_the_ID()); ?>" class="main-success-portfolio-item">
                    <picture>
                        <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php esc_attr_e('Ver más acerca de este caso de éxito', 'robertochoa'); ?>">
                            <?php the_post_thumbnail('full', ['class' => 'response-class']);
                            ?>
                        </a>
                    </picture>
                </article>
                <article class="main-success-portfolio-item main-success-portfolio-item-text">
                    <div class="portfolio-item-text-wrapper">
                        <h3><?php echo esc_html($arr_boxes[$i]['title']); ?></h3>
                        <div class="percentage"><?php echo esc_html($arr_boxes[$i]['number']); ?></div>
                    </div>
                </article>
                <?php $i++;
            endforeach; ?>
        </div>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
    <div class="main-success-content-button" itemprop="potentialAction" itemscope itemtype="http://schema.org/CommunicateAction">
        <?php $btn_link = ro_meta_value('ro_home_portfolio_btn_link'); ?>
        <?php $btn_text = ro_meta_value('ro_home_portfolio_btn_text'); ?>
        <a href="<?php echo esc_url($btn_link); ?>" class="btn" title="<?php echo esc_attr($btn_text);  ?>" itemprop="target"><span itemprop="name"><?php echo esc_html($btn_text); ?></span></a>
    </div>
</section>
