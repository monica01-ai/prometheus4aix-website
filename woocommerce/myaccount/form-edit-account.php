<?php
/**
 * Edit account form - Figma Design v2
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_edit_account_form' ); ?>

<div class="edit-account-form-container">

    <form class="woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >

        <?php do_action( 'woocommerce_edit_account_form_start' ); ?>

        <div class="form-row-group">
            
            <!-- Email & Username -->
            <div class="form-row form-row-wide">
                <label for="account_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                <input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" />
            </div>

            <div class="form-row form-row-wide">
                <label for="account_display_name"><?php esc_html_e( 'Username', 'woocommerce' ); ?></label>
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_display_name" id="account_display_name" value="<?php echo esc_attr( $user->display_name ); ?>" />
                <div class="form-note">
                    <a href="#" class="change-password-link">Change password</a>
                </div>
            </div>

            <!-- Name Fields -->
            <div class="form-row-double">
                <div class="form-row form-row-first">
                    <label for="account_first_name"><?php esc_html_e( 'First name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>" />
                </div>
                <div class="form-row form-row-last">
                    <label for="account_last_name"><?php esc_html_e( 'Last name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>" />
                </div>
            </div>

            <!-- Company -->
            <div class="form-row form-row-wide">
                <label for="billing_company"><?php esc_html_e( 'Company', 'woocommerce' ); ?></label>
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="billing_company" id="billing_company" value="<?php echo esc_attr( get_user_meta( $user->ID, 'billing_company', true ) ); ?>" />
            </div>

            <!-- Country -->
            <div class="form-row form-row-wide">
                <label for="billing_country"><?php esc_html_e( 'Country', 'woocommerce' ); ?></label>
                <select name="billing_country" id="billing_country" class="country-select">
                    <option value="">Select country...</option>
                    <?php
                    $countries = WC()->countries->get_countries();
                    $selected_country = get_user_meta( $user->ID, 'billing_country', true );
                    foreach ( $countries as $code => $country ) {
                        echo '<option value="' . esc_attr( $code ) . '"' . selected( $selected_country, $code, false ) . '>' . esc_html( $country ) . '</option>';
                    }
                    ?>
                </select>
            </div>

            <!-- Billing Address Section -->
            <div class="billing-address-section">
                <h3 class="section-title">Billing Address</h3>
                
                <div class="form-row form-row-wide">
                    <label for="billing_address_1"><?php esc_html_e( 'Address', 'woocommerce' ); ?></label>
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="billing_address_1" id="billing_address_1" value="<?php echo esc_attr( get_user_meta( $user->ID, 'billing_address_1', true ) ); ?>" />
                </div>

                <div class="form-row form-row-wide">
                    <label for="billing_address_2"><?php esc_html_e( 'Apartment, suite, etc.', 'woocommerce' ); ?></label>
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="billing_address_2" id="billing_address_2" value="<?php echo esc_attr( get_user_meta( $user->ID, 'billing_address_2', true ) ); ?>" />
                </div>

                <div class="form-row-double">
                    <div class="form-row form-row-first">
                        <label for="billing_postcode"><?php esc_html_e( 'Postal / ZIP Code', 'woocommerce' ); ?></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="billing_postcode" id="billing_postcode" value="<?php echo esc_attr( get_user_meta( $user->ID, 'billing_postcode', true ) ); ?>" />
                    </div>
                    <div class="form-row form-row-last">
                        <label for="billing_city"><?php esc_html_e( 'City', 'woocommerce' ); ?></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="billing_city" id="billing_city" value="<?php echo esc_attr( get_user_meta( $user->ID, 'billing_city', true ) ); ?>" />
                    </div>
                </div>

                <div class="form-row form-row-wide">
                    <label for="billing_phone"><?php esc_html_e( 'Phone', 'woocommerce' ); ?></label>
                    <input type="tel" class="woocommerce-Input woocommerce-Input--phone input-text" name="billing_phone" id="billing_phone" value="<?php echo esc_attr( get_user_meta( $user->ID, 'billing_phone', true ) ); ?>" />
                </div>
            </div>

            <!-- Password Change Fields (hidden by default) -->
            <div class="password-change-section" style="display: none;">
                <div class="form-row form-row-wide">
                    <label for="password_current"><?php esc_html_e( 'Current password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
                    <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" autocomplete="off" />
                </div>
                <div class="form-row form-row-wide">
                    <label for="password_1"><?php esc_html_e( 'New password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
                    <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" autocomplete="off" />
                </div>
                <div class="form-row form-row-wide">
                    <label for="password_2"><?php esc_html_e( 'Confirm new password', 'woocommerce' ); ?></label>
                    <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" autocomplete="off" />
                </div>
            </div>

        </div>

        <?php do_action( 'woocommerce_edit_account_form' ); ?>

        <div class="form-actions">
            <?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
            <button type="submit" class="btn-save-account" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>">
                <?php esc_html_e( 'Save changes', 'woocommerce' ); ?>
            </button>
            <input type="hidden" name="action" value="save_account_details" />
        </div>

        <?php do_action( 'woocommerce_edit_account_form_end' ); ?>

    </form>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const changePasswordLink = document.querySelector('.change-password-link');
    const passwordSection = document.querySelector('.password-change-section');
    
    if (changePasswordLink && passwordSection) {
        changePasswordLink.addEventListener('click', function(e) {
            e.preventDefault();
            passwordSection.style.display = passwordSection.style.display === 'none' ? 'block' : 'none';
        });
    }
});
</script>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>