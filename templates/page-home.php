<?php

/**
 * Template Name: Page Home
 *
 * @package RobertOchoa
 * @subpackage robertochoa-mk12-theme
 * @since Mk.12
 */
?>
<?php get_header(); ?>
<?php the_post(); ?>
<main class="main-contain">
    <div id="mainRow" class="custom-row">
       <?php get_template_part('templates/home/banner'); ?>
       <?php get_template_part('templates/home/numbers'); ?>
       <?php get_template_part('templates/home/about'); ?>
       <?php get_template_part('templates/home/tools'); ?>
       <?php get_template_part('templates/home/services'); ?>
       <?php get_template_part('templates/home/portfolio'); ?>
       <?php get_template_part('templates/home/blog'); ?>
       <?php get_template_part('templates/home/contact'); ?>
    </div>
</main>
<?php get_footer(); ?>