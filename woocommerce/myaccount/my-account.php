<?php
/**
 * My Account Page Template - Figma Design v2
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="account-page">
    
    <div class="account-container container">
        
        <!-- Breadcrumb -->
        <div class="account-breadcrumb">
            <span class="breadcrumb-text">MY ACCOUNT / Edit Profile</span>
        </div>
        
        <div class="account-layout">
            <!-- Custom Sidebar Navigation -->
            <div class="account-sidebar">
                <?php 
                $current_user = wp_get_current_user();
                ?>
                
                <!-- User Avatar & Name -->
                <div class="account-user-profile">
                    <div class="user-avatar">
                        <?php echo get_avatar( $current_user->ID, 60 ); ?>
                    </div>
                    <div class="user-name">
                        <?php echo esc_html( $current_user->display_name ? $current_user->display_name : $current_user->user_login ); ?>
                    </div>
                </div>
                
                <!-- Custom Navigation -->
                <nav class="account-sidebar-nav">
                    <ul class="sidebar-nav-list">
                        <li class="nav-item <?php echo is_wc_endpoint_url( 'edit-account' ) || is_account_page() ? 'active' : ''; ?>">
                            <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>">
                                <span class="nav-icon">👤</span>
                                <span class="nav-label">Edit profile</span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_wc_endpoint_url( 'orders' ) ? 'active' : ''; ?>">
                            <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>">
                                <span class="nav-icon">📋</span>
                                <span class="nav-label">Orders</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'licenses' ) ); ?>">
                                <span class="nav-icon">🔑</span>
                                <span class="nav-label">Licenses</span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_wc_endpoint_url( 'downloads' ) ? 'active' : ''; ?>">
                            <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'downloads' ) ); ?>">
                                <span class="nav-icon">⬇️</span>
                                <span class="nav-label">Downloads</span>
                            </a>
                        </li>
                        <li class="nav-item logout">
                            <a href="<?php echo esc_url( wp_logout_url( wc_get_page_permalink( 'shop' ) ) ); ?>">
                                <span class="nav-icon">🚪</span>
                                <span class="nav-label">Logout</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Main Content Area -->
            <div class="account-content-main">
                <?php do_action( 'woocommerce_account_content' ); ?>
            </div>
        </div>

    </div>

</div>
