<!DOCTYPE html>
<html <?php language_attributes() ?>>

<head>
    <?php /* MAIN STUFF */ ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset') ?>" />
    <meta name="robots" content="NOODP, INDEX, FOLLOW" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="MobileOptimized" content="320" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="pingback" href="<?php echo esc_url(get_bloginfo('pingback_url')); ?>" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="dns-prefetch" href="//facebook.com" crossorigin />
    <link rel="dns-prefetch" href="//connect.facebook.net" crossorigin />
    <link rel="dns-prefetch" href="//ajax.googleapis.com" crossorigin />
    <link rel="dns-prefetch" href="//google-analytics.com" crossorigin />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php /* FAVICONS */ ?>
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png" />
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/images/win8-tile-icon.png" />
    <?php /* THEME NAVBAR COLOR */ ?>
    <meta name="msapplication-TileColor" content="#454545" />
    <meta name="theme-color" content="#454545" />
    <?php /* AUTHOR INFORMATION */ ?>
    <meta name="language" content="<?php echo get_bloginfo('language'); ?>" />
    <?php /* MAIN TITLE - CALL HEADER MAIN FUNCTIONS */ ?>
    <?php wp_title('|', false, 'right'); ?>
    <?php wp_head() ?>
</head>

<body class="the-main-body <?php echo join(' ', get_body_class()); ?>" itemscope itemtype="http://schema.org/WebPage">
    <?php wp_body_open(); ?>
    <header id="mainHeader" class="main-header-container">
        <div class="header-phone none mobile">
            <a href="tel:+584141300819" title="<?php _e('Haz click aquí para empezar a conversar', 'robertochoa'); ?>">
                <i class="fas fa-phone-alt"></i>
            </a>
        </div>
        <div class="header-logo" itemscope itemtype="https://schema.org/Organization">
            <a href="<?php echo home_url('/'); ?>" title="<?php _e('Volver al Inicio', 'robertochoa'); ?>" itemprop="url">
                <img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" width="70" height="57" alt="Robert Ochoa" class="img-logo response-class" itemprop="logo" loading="lazy" />
            </a>
        </div>
        <div class="header-mobile-button none mobile">
            <a href="#" id="hamburger" title="<?php _e('Haz click aqui para ver el menú de navegación', 'robertochoa'); ?>">
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div>
        <nav id="menuCnt" class="header-menu" itemscope itemtype="http://schema.org/SiteNavigationElement">
            <?php wp_nav_menu(array( 'theme_location' => 'header_menu', 'depth' => 2, 'container' => 'div', 'walker' => new bigrush_Walker_Nav_Menu() )); ?>
        </nav>
    </header>