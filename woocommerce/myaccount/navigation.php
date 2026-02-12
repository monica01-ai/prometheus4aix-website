<?php
/**
 * My Account Navigation
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_account_navigation' );
?>

<nav class="woocommerce-MyAccount-navigation account-nav">
    <ul class="account-nav__list">
        <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
            <li class="account-nav__item <?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
                <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" class="account-nav__link">
                    <span class="account-nav__icon account-nav__icon--<?php echo esc_attr( $endpoint ); ?>"></span>
                    <span class="account-nav__label"><?php echo esc_html( $label ); ?></span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
