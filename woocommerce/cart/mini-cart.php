<?php
/**
 * Mini-cart - displayed in header dropdown
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>

<div class="mini-cart">
    <?php if ( ! WC()->cart->is_empty() ) : ?>
        
        <ul class="mini-cart__items">
            <?php
            do_action( 'woocommerce_before_mini_cart_contents' );

            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                    $product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                    $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'thumbnail' ), $cart_item, $cart_item_key );
                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                    ?>
                    <li class="mini-cart__item">
                        <div class="mini-cart__item-image">
                            <?php echo $thumbnail; ?>
                        </div>
                        <div class="mini-cart__item-info">
                            <a href="<?php echo esc_url( $product_permalink ); ?>" class="mini-cart__item-name">
                                <?php echo wp_kses_post( $product_name ); ?>
                            </a>
                            <span class="mini-cart__item-qty">
                                <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], WC()->cart->get_product_price( $_product ) ) . '</span>', $cart_item, $cart_item_key ); ?>
                            </span>
                        </div>
                        <div class="mini-cart__item-remove">
                            <?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                                '<a href="%s" class="remove-mini" aria-label="%s" data-product_id="%s" data-cart_item_key="%s">&times;</a>',
                                esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                esc_attr__( 'Remove this item', 'woocommerce' ),
                                esc_attr( $product_id ),
                                esc_attr( $cart_item_key )
                            ), $cart_item_key ); ?>
                        </div>
                    </li>
                    <?php
                }
            }

            do_action( 'woocommerce_mini_cart_contents' );
            ?>
        </ul>

        <div class="mini-cart__total">
            <strong><?php _e( 'Subtotal', 'woocommerce' ); ?>:</strong>
            <?php echo WC()->cart->get_cart_subtotal(); ?>
        </div>

        <div class="mini-cart__buttons">
            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="mini-cart__btn mini-cart__btn--cart">
                <?php _e( 'View Cart', 'woocommerce' ); ?>
            </a>
            <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="mini-cart__btn mini-cart__btn--checkout">
                <?php _e( 'Checkout', 'woocommerce' ); ?>
            </a>
        </div>

    <?php else : ?>
        <p class="mini-cart__empty"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></p>
    <?php endif; ?>
</div>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
