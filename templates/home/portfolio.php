<section class="main-success-container">
    <header class="main-success-title">
        <?php $portfolio_title = ro_meta_value('ro_home_portfolio_title'); ?>
        <h2><?php echo esc_html($portfolio_title); ?></h2>
    </header>
    <?php $arr_portfolio = new WP_Query([
        'post_type' => 'casos',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        'tax_query' => [[
            'taxonomy' => 'categoria-casos',
            'field' => 'slug',
            'terms' => ['destacado']
        ]]
    ]); ?>
    <?php if ($arr_portfolio->have_posts()) : ?>
    <div class="main-success-portfolio-container">
        <?php while ($arr_portfolio->have_posts()) :
            $arr_portfolio->the_post(); ?>
        <article id="<?php the_ID() ?>" class="main-success-portfolio-item">
            <picture>
                <?php the_post_thumbnail('full', ['class' => 'response-class']); ?>
            </picture>
            <header>
                <h3><?php the_title(); ?></h3>
                <div class="category-list">
                    <?php $terms = get_the_terms(get_the_ID(), 'categoria-casos'); ?>
                    <?php if ($terms) : ?>
                        <?php foreach ($terms as $item) : ?>
                            <?php if ($item->name !== 'Destacado') : ?>
                                <?php $item_link = (get_term_link($item) !== '') ? get_term_link($item) : ''; ?>
                                <?php if ($item_link !== '') : ?>
                                    <a href="<?php echo esc_url($item_link); ?>" class="category-item"><?php echo esc_html($item->name); ?></a>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <a href="<?php the_permalink(); ?>" class="btn-portfolio"><?php esc_html_e('Ver Caso de Éxito', 'robertochoa'); ?></a>
            </header>
        </article>
        <?php endwhile; ?>
    </div>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
    <div class="main-success-content-button" itemprop="potentialAction" itemscope itemtype="http://schema.org/CommunicateAction">
        <?php $btn_link = ro_meta_value('ro_home_portfolio_btn_link'); ?>
        <?php $btn_text = ro_meta_value('ro_home_portfolio_btn_text'); ?>
        <a href="<?php echo esc_url($btn_link); ?>" class="btn" title="<?php echo esc_attr($btn_text);  ?>" itemprop="target"><span itemprop="name"><?php echo esc_html($btn_text); ?></span></a>
    </div>
</section>