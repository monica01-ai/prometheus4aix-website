<?php
/**
 * Single Product Template
 */

defined( 'ABSPATH' ) || exit;

get_header(); ?>

<main class="product-page">
    <?php while ( have_posts() ) : the_post(); ?>

        <?php wc_get_template_part( 'content', 'single-product' ); ?>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
