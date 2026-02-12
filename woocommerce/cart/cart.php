<?php
/**
 * Cart Page - Prometheus4AIX (Figma aligned)
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<div class="prom-cart">

    <h1 class="prom-cart__title">CART</h1>
    <p class="prom-cart__count"><?php echo WC()->cart->get_cart_contents_count(); ?> ITEM<?php echo WC()->cart->get_cart_contents_count() > 1 ? 'S' : ''; ?></p>

    <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

        <div class="prom-cart__layout">

            <!-- Items -->
            <div class="prom-cart__items">
                <?php do_action( 'woocommerce_before_cart_contents' ); ?>

                <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                    $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                    $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                        $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                        ?>
                        <div class="prom-cart-item">
                            <div class="prom-cart-item__image">
                                <?php
                                $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                                echo $product_permalink ? sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ) : $thumbnail;
                                ?>
                            </div>
                            <div class="prom-cart-item__info">
                                <h3 class="prom-cart-item__name">
                                    <?php
                                    $name = $_product->get_name();
                                    echo $product_permalink ? sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $name ) : $name;
                                    ?>
                                </h3>
                                <?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
                            </div>
                            <div class="prom-cart-item__price">
                                <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
                            </div>
                            <div class="prom-cart-item__quantity">
                                <?php
                                $product_quantity = woocommerce_quantity_input( array(
                                    'input_name'  => "cart[{$cart_item_key}][qty]",
                                    'input_value' => $cart_item['quantity'],
                                    'max_value'   => $_product->get_max_purchase_quantity(),
                                    'min_value'   => 0,
                                    'product_name' => $_product->get_name(),
                                ), $_product, false );
                                echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
                                ?>
                            </div>
                            <div class="prom-cart-item__remove">
                                <?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                                    '<a href="%s" class="prom-remove-link" aria-label="%s" data-product_id="%s">Remove</a>',
                                    esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                    esc_html__( 'Remove this item', 'woocommerce' ),
                                    esc_attr( $product_id )
                                ), $cart_item_key ); ?>
                            </div>
                        </div>
                        <?php
                    }
                } ?>

                <?php do_action( 'woocommerce_cart_contents' ); ?>

                <div class="prom-cart__update">
                    <button type="submit" class="prom-btn prom-btn--outline" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
                    <?php do_action( 'woocommerce_cart_actions' ); ?>
                    <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                </div>

                <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                <?php do_action( 'woocommerce_after_cart_table' ); ?>
            </div>

            <!-- Summary -->
            <div class="prom-cart__summary">
                <h2 class="prom-cart__summary-title">SUMMARY</h2>

                <?php if ( wc_coupons_enabled() ) : ?>
                    <div class="prom-cart__coupon">
                        <input type="text" name="coupon_code" class="prom-input" id="coupon_code" placeholder="Discount code" />
                        <button type="submit" class="prom-btn prom-btn--primary" name="apply_coupon" value="<?php esc_attr_e( 'Apply', 'woocommerce' ); ?>">Apply</button>
                        <?php do_action( 'woocommerce_cart_coupon' ); ?>
                    </div>
                <?php endif; ?>

                <div class="prom-cart__total">
                    <span class="prom-cart__total-label">Total</span>
                    <span class="prom-cart__total-value"><?php wc_cart_totals_order_total_html(); ?></span>
                </div>

                <div class="prom-cart__checkout">
                    <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="prom-btn prom-btn--accent prom-btn--full">CHECK OUT</a>
                </div>

                <?php do_action( 'woocommerce_after_cart' ); ?>
            </div>

        </div>

    </form>

    <!-- You may also like -->
    <?php
    $related_products = wc_get_products( array(
        'limit'   => 2,
        'orderby' => 'rand',
        'status'  => 'publish',
    ) );

    if ( ! empty( $related_products ) ) : ?>
        <div class="prom-cart__also-like">
            <h2 class="prom-cart__also-title">YOU MAY ALSO LIKE</h2>
            <div class="catalog-grid">
                <?php foreach ( $related_products as $product ) :
                    $post_object = get_post( $product->get_id() );
                    setup_postdata( $GLOBALS['post'] = $post_object );
                ?>
                    <div class="catalog-card">
                        <div class="catalog-card__image">
                            <a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>">
                                <?php echo $product->get_image( 'large' ); ?>
                            </a>
                        </div>
                        <div class="catalog-card__content">
                            <h3 class="catalog-card__title">
                                <a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>"><?php echo esc_html( $product->get_name() ); ?></a>
                            </h3>
                            <div class="catalog-card__description">
                                <?php echo wpautop( $product->get_short_description() ); ?>
                            </div>
                            <div class="catalog-card__price">
                                <?php echo $product->get_price_html(); ?>
                            </div>
                            <div class="catalog-card__actions">
                                <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="catalog-card__btn catalog-card__btn--plan"><?php echo esc_html( $product->add_to_cart_text() ); ?></a>
                                <a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>?free-trial=1" class="catalog-card__btn catalog-card__btn--trial">Free trial</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; wp_reset_postdata(); ?>
            </div>
        </div>
    <?php endif; ?>

</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
