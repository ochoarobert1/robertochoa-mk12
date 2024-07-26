<header id="mainHeader" class="main-header-container">
    <div class="header-phone none mobile">
        <a href="tel:+584141300819" title="<?php esc_attr_e('Haz click aquí para empezar a conversar', 'robertochoa'); ?>">
            <i class="fas fa-phone-alt"></i>
        </a>
    </div>
    <div class="header-logo" itemscope itemtype="https://schema.org/Organization">
        <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php esc_attr_e('Volver al Inicio', 'robertochoa'); ?>" itemprop="url">
            <?php if (has_custom_logo()) : ?>
                <?php $custom_logo_id = get_theme_mod('custom_logo'); ?>
                <?php $image = wp_get_attachment_image_src($custom_logo_id, 'full', false); ?>
                <?php $logo = $image[0];?>
            <?php else : ?>
                <?php $logo = esc_url(get_template_directory_uri()) . '/images/logo.svg'; ?>
            <?php endif; ?>
            <img src="<?php echo esc_url($logo); ?>" width="70" height="57" alt="Robert Ochoa" class="img-logo response-class" itemprop="logo" rel="logo" loading="lazy" />
        </a>
    </div>
    <div class="header-mobile-button none mobile">
        <a href="#" id="hamburger" title="<?php esc_attr_e('Haz click aqui para ver el menú de navegación', 'robertochoa'); ?>">
            <span></span>
            <span></span>
            <span></span>
        </a>
    </div>
    <nav id="menuCnt" class="header-menu" itemscope itemtype="http://schema.org/SiteNavigationElement">
        <?php wp_nav_menu(array( 'theme_location' => 'header_menu', 'depth' => 2, 'container' => 'div', 'walker' => new bigrush_Walker_Nav_Menu() )); ?>
    </nav>
</header>
