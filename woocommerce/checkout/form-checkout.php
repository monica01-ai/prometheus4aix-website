<?php
/**
 * Checkout Form Template
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_checkout_form', $checkout );

if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
    echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
    return;
}
?>

<div class="checkout-page">
    <h1 class="checkout-title">Checkout</h1>

    <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

        <div class="checkout-layout">
            
            <div class="checkout-fields">
                
                <?php if ( $checkout->get_checkout_fields() ) : ?>

                    <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                    <div class="checkout-section" id="customer_details">
                        <div class="checkout-billing">
                            <h2 class="checkout-section__title">Billing Details</h2>
                            <?php do_action( 'woocommerce_checkout_billing' ); ?>
                        </div>

                        <div class="checkout-shipping">
                            <h2 class="checkout-section__title">Shipping Details</h2>
                            <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                        </div>
                    </div>

                    <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

                <?php endif; ?>

                <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>

                <div class="checkout-section checkout-additional">
                    <h2 class="checkout-section__title">Additional Information</h2>
                    <?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>

                    <?php if ( apply_filters( 'woocommerce_enable_order_notes_field', 'yes' === get_option( 'woocommerce_enable_order_comments', 'yes' ) ) ) : ?>
                        <div class="woocommerce-additional-fields__field-wrapper">
                            <?php foreach ( $checkout->get_checkout_fields( 'order' ) as $key => $field ) : ?>
                                <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>
                </div>
            </div>

            <div class="checkout-sidebar">
                <div class="checkout-order-review">
                    <h2 class="checkout-section__title">Your Order</h2>

                    <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

                    <div id="order_review" class="woocommerce-checkout-review-order">
                        <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                    </div>

                    <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
                </div>
            </div>

        </div>

    </form>
</div>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
