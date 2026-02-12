<?php
/**
 * Cart Page Template - Figma Design v2
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<div class="cart-page">
    <div class="container">
        <!-- Page header -->
        <div class="cart-header">
            <h1 class="cart-title">CART</h1>
            <div class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?> ITEM<?php echo (WC()->cart->get_cart_contents_count() > 1) ? 'S' : ''; ?></div>
        </div>

        <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
            <div class="cart-layout">
                
                <!-- Left Column: Cart Items -->
                <div class="cart-items-section">
                    <?php do_action( 'woocommerce_before_cart_table' ); ?>

                    <?php if ( !WC()->cart->is_empty() ) : ?>
                        
                        <?php 
                        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                ?>
                                <div class="cart-item-card">
                                    <div class="cart-item__image">
                                        <?php
                                        $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                                        if ( ! $product_permalink ) {
                                            echo $thumbnail;
                                        } else {
                                            printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
                                        }
                                        ?>
                                    </div>
                                    
                                    <div class="cart-item__details">
                                        <h3 class="cart-item__name">
                                            <?php
                                            if ( ! $product_permalink ) {
                                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) );
                                            } else {
                                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                            }
                                            ?>
                                        </h3>
                                        
                                        <div class="cart-item__price">
                                            <?php 
                                            $regular_price = $_product->get_regular_price();
                                            $sale_price = $_product->get_sale_price();
                                            if ($sale_price && $sale_price < $regular_price) {
                                                echo '<span class="price-current">' . wc_price($sale_price) . '</span> ';
                                                echo '<span class="price-crossed">' . wc_price($regular_price) . '</span>';
                                            } else {
                                                echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                                            }
                                            ?>
                                        </div>
                                        
                                        <div class="cart-item__controls">
                                            <div class="quantity-selector">
                                                <label>Pack</label>
                                                <select name="cart[<?php echo $cart_item_key; ?>][qty]" class="qty-select">
                                                    <?php for($i = 1; $i <= 10; $i++) : ?>
                                                        <option value="<?php echo $i; ?>" <?php selected($cart_item['quantity'], $i); ?>>x<?php echo $i; ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                            
                                            <a href="<?php echo esc_url( wc_get_cart_remove_url( $cart_item_key ) ); ?>" 
                                               class="remove-link" 
                                               aria-label="<?php esc_html_e( 'Remove this item', 'woocommerce' ); ?>">
                                                Remove
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>

                    <?php endif; ?>

                    <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                </div>

                <!-- Right Column: Cart Summary -->
                <div class="cart-summary-section">
                    <div class="cart-summary">
                        
                        <!-- Discount Code -->
                        <?php if ( wc_coupons_enabled() ) { ?>
                            <div class="discount-section">
                                <label for="coupon_code">Discount code</label>
                                <div class="discount-input">
                                    <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Enter code" />
                                    <button type="submit" class="btn-apply" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>">Apply</button>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- Cart Totals -->
                        <div class="cart-totals">
                            <?php 
                            $cart_total = WC()->cart->get_total();
                            $cart_subtotal = WC()->cart->get_subtotal();
                            ?>
                            
                            <div class="total-line">
                                <span>Subtotal</span>
                                <span><?php echo wc_price($cart_subtotal); ?></span>
                            </div>
                            
                            <?php if (WC()->cart->get_discount_total() > 0) : ?>
                                <div class="total-line discount">
                                    <span>Discount</span>
                                    <span>-<?php echo wc_price(WC()->cart->get_discount_total()); ?></span>
                                </div>
                            <?php endif; ?>
                            
                            <div class="total-line total-final">
                                <span>Total</span>
                                <span><?php echo $cart_total; ?></span>
                            </div>
                        </div>

                        <!-- Checkout Button -->
                        <div class="checkout-section">
                            <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn-checkout">
                                CHECK OUT
                            </a>
                        </div>

                    </div>
                </div>

            </div>

            <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
        </form>

        <!-- You May Also Like Section -->
        <div class="you-may-like">
            <h2 class="section-title">YOU MAY ALSO LIKE</h2>
            <div class="product-cards-grid">
                <?php
                // Get related/recommended products
                $cross_sells = WC()->cart->get_cross_sells();
                if ( $cross_sells ) {
                    foreach ( $cross_sells as $cross_sell_id ) {
                        $cross_sell_product = wc_get_product( $cross_sell_id );
                        if ( $cross_sell_product ) {
                            ?>
                            <div class="product-card">
                                <div class="product-card__image">
                                    <a href="<?php echo get_permalink( $cross_sell_id ); ?>">
                                        <?php echo $cross_sell_product->get_image(); ?>
                                    </a>
                                </div>
                                <div class="product-card__content">
                                    <h3 class="product-card__title">
                                        <a href="<?php echo get_permalink( $cross_sell_id ); ?>">
                                            <?php echo strtoupper( $cross_sell_product->get_name() ); ?>
                                        </a>
                                    </h3>
                                    <div class="product-card__description">
                                        <?php echo wp_trim_words( $cross_sell_product->get_short_description(), 15, '...' ); ?>
                                    </div>
                                    <div class="product-card__actions">
                                        <a href="<?php echo get_permalink( $cross_sell_id ); ?>" class="btn btn-outline">CHOOSE PLAN</a>
                                        <a href="<?php echo get_permalink( $cross_sell_id ); ?>" class="btn-text-link">Free trial</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
            </div>
        </div>

    </div>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
