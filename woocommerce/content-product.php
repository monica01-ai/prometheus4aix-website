<?php
/**
 * Product card template for shop/archive pages
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}
?>

<div <?php wc_product_class( 'product-card', $product ); ?>>
    
    <div class="product-card__image">
        <a href="<?php the_permalink(); ?>">
            <?php 
            if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'woocommerce_thumbnail' );
            } else {
                echo wc_placeholder_img( 'woocommerce_thumbnail' );
            }
            ?>
        </a>
        
        <?php if ( $product->is_on_sale() ) : ?>
            <span class="product-card__badge product-card__badge--sale">Sale</span>
        <?php endif; ?>
    </div>

    <div class="product-card__content">
        <h3 class="product-card__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        
        <div class="product-card__price">
            <?php echo $product->get_price_html(); ?>
        </div>

        <div class="product-card__rating">
            <?php 
            if ( wc_review_ratings_enabled() ) {
                echo wc_get_rating_html( $product->get_average_rating() );
            }
            ?>
        </div>

        <div class="product-card__actions">
            <?php woocommerce_template_loop_add_to_cart(); ?>
        </div>
    </div>

</div>
