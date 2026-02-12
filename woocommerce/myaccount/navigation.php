<?php
/**
 * My Account Navigation - Prometheus4AIX (Figma aligned)
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_account_navigation' );
?>

<nav class="prom-account-nav">
    <?php
    $current_user = wp_get_current_user();
    $avatar = get_avatar( $current_user->ID, 64 );
    ?>
    <div class="prom-account-nav__user">
        <div class="prom-account-nav__avatar"><?php echo $avatar; ?></div>
        <div class="prom-account-nav__name"><?php echo esc_html( $current_user->display_name ); ?></div>
        <div class="prom-account-nav__email"><?php echo esc_html( $current_user->user_email ); ?></div>
    </div>

    <ul class="prom-account-nav__list">
        <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
            <li class="prom-account-nav__item <?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
                <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
