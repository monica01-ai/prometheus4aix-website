<?php
/**
 * WooCommerce wrapper template
 * Routes to specific templates or falls back to default
 */

// Shop/archive pages use our custom wide-card layout
if ( is_shop() || is_product_category() || is_product_tag() ) {
    get_template_part( 'archive-product' );
    return;
}

get_header(); ?>

<main class="woocommerce-page">
    <div class="woocommerce-container container">
        <?php woocommerce_content(); ?>
    </div>
</main>

<?php get_footer(); ?>
