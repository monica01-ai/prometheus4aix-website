<?php
/**
 * My Account Page Template
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="account-page">
    
    <div class="account-container container">
        
        <div class="account-navigation">
            <?php do_action( 'woocommerce_account_navigation' ); ?>
        </div>

        <div class="account-content">
            <?php do_action( 'woocommerce_account_content' ); ?>
        </div>

    </div>

</div>
