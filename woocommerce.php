<?php
/**
 * WooCommerce wrapper template
 * Used as fallback for WooCommerce pages without specific templates
 */

get_header(); ?>

<main class="woocommerce-page">
    <div class="woocommerce-container container">
        <?php woocommerce_content(); ?>
    </div>
</main>

<?php get_footer(); ?>
