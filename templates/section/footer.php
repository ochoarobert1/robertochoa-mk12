<footer id="mainFooter" class="footer-section">
    <div class="footer-wrapper">
        <div class="footer-item">
            <div class="header-logo" itemscope itemtype="https://schema.org/Organization">
                <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php esc_attr_e('Volver al Inicio', 'robertochoa'); ?>" itemprop="url">
                    <?php $logo_white = get_theme_mod('white_logo'); ?>
                    <?php if ($logo_white != '') : ?>
                        <img src="<?php echo esc_url($logo_white); ?>" width="70" height="57" alt="Robert Ochoa" class="img-logo response-class" itemprop="logo" loading="lazy" />
                    <?php else : ?>
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo-white.svg" width="70" height="57" alt="Robert Ochoa" class="img-logo response-class" itemprop="logo" loading="lazy" />
                    <?php endif; ?>
                </a>
            </div>
            <?php if (is_active_sidebar('footer-sidebar')) : ?>
                <div id="footerSidebar1">
                    <?php dynamic_sidebar('footer-sidebar'); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="footer-item">
            <?php if (is_active_sidebar('footer-sidebar-2')) : ?>
                <div id="footerSidebar2">
                    <?php dynamic_sidebar('footer-sidebar-2'); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="footer-item">
            <?php if (is_active_sidebar('footer-sidebar-3')) : ?>
                <div id="footerSidebar3">
                    <?php dynamic_sidebar('footer-sidebar-3'); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="footer-item">
            <?php if (is_active_sidebar('footer-sidebar-4')) : ?>
                <div id="footerSidebar4">
                    <?php dynamic_sidebar('footer-sidebar-4'); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="footer-item">
            <?php if (is_active_sidebar('footer-sidebar-5')) : ?>
                <div id="footerSidebar5">
                    <?php dynamic_sidebar('footer-sidebar-5'); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="footer-item footer-wide">
            <?php $footer_copy = get_theme_mod('footer_copyright'); ?>
            <h6><?php echo esc_html($footer_copy); ?></h6>
        </div>
    </div>
</footer>
