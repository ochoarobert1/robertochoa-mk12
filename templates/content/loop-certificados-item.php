<?php

/**
 * Content: Item de Certificados
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */

if (!defined('ABSPATH')) {
    exit;
}

// TODO: Agregar informacion comentada
$certificate_id = ro_meta_value('ro_cert_id');
$certificate_issuer = ro_meta_value('ro_cert_emisor');
$certificate_date = ro_meta_value('ro_cert_date');
$formatted_date = date_i18n('M Y', strtotime($certificate_date));
$certificate_url = ro_meta_value('ro_cert_url');
?>
<article class="loop-certificate-item" itemscope itemtype="https://schema.org/EducationalOccupationalCredential">
    <header>
        <div class="loop-certificate-item__id"><?php echo esc_html($certificate_id); ?></div>
        <h2 itemprop="name"><?php the_title(); ?></h2>
    </header>
    <div class="loop-certificate-item__content">
        <div class="issuer" itemprop="recognizedBy" itemscope itemtype="https://schema.org/EducationalOrganization">
            <meta itemprop="name" content="<?php echo esc_attr($certificate_issuer); ?>">
            <?php /* <link itemprop="url" href="https://www.eduonix.com/"> */ ?>
            <?php echo esc_html($certificate_issuer); ?>
        </div>
        <div class="date">
            <?php echo esc_html($formatted_date); ?>
        </div>
        <?php /*
        <meta itemprop="description" content="Certificado de finalización del bootcamp de CSS de Eduonix, cubriendo CSS Grid y CSS Flexbox.">
        <meta itemprop="competencyRequired" content="Dominio de CSS, CSS Grid, CSS Flexbox, Diseño Web Responsivo">
        */ ?>
        <div itemprop="credentialCategory" content="Course Completion Certificate"></div>
        <div itemprop="educationalLevel" content="Advanced"></div>
    </div>
    <footer class="loop-certificate-item__button">
        <?php if ($certificate_url) : ?>
            <a href="<?php echo esc_url($certificate_url); ?>" target="_blank" class="btn btn-primary" itemprop="url"><?php echo esc_html_e('Ver certificado', 'robertochoa'); ?></a>
        <?php endif; ?>
    </footer>
</article>
