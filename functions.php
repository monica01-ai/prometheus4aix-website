<?php
/**
 * Prometheus4AIX Theme Functions
 * 
 * @package Prometheus4AIX
 * @version 2.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Disable WooCommerce default styles (theme provides all CSS)
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Theme Setup
 */
function prometheus_theme_setup() {
    // Add WooCommerce support
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    
    // Add title tag support
    add_theme_support( 'title-tag' );
    
    // Add post thumbnails support
    add_theme_support( 'post-thumbnails' );
    
    // Add custom logo support
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    
    // Register navigation menus
    register_nav_menus( array(
        'header-menu' => __( 'Header Menu', 'prometheus4aix' ),
        'footer-menu' => __( 'Footer Menu', 'prometheus4aix' ),
    ) );
    
    // Add HTML5 support
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );
}
add_action( 'after_setup_theme', 'prometheus_theme_setup' );

/**
 * Enqueue scripts and styles
 */
function prometheus_enqueue_scripts() {
    // Main stylesheet
    wp_enqueue_style( 
        'prometheus-style', 
        get_stylesheet_uri(), 
        array(), 
        '2.0.0' 
    );
    
    // Menu script
    wp_enqueue_script( 
        'prometheus-menu', 
        get_template_directory_uri() . '/js/menu.js', 
        array( 'jquery' ), 
        '2.0.0', 
        true 
    );
    
    // Product gallery script
    if ( is_product() ) {
        wp_enqueue_script( 
            'prometheus-gallery', 
            get_template_directory_uri() . '/js/gallery.js', 
            array( 'jquery' ), 
            '2.0.0', 
            true 
        );
    }
}
add_action( 'wp_enqueue_scripts', 'prometheus_enqueue_scripts' );

/**
 * WooCommerce - Remove default product images and add custom gallery
 */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

// Remove default tabs and related products from hooks (we place them manually in template)
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

/**
 * WooCommerce - Custom product image gallery
 */
function prometheus_product_gallery() {
    global $product;
    
    $image_ids = $product->get_gallery_image_ids();
    $main_image = $product->get_image_id();
    
    if ( $main_image ) {
        array_unshift( $image_ids, $main_image );
    }
    
    if ( empty( $image_ids ) ) {
        echo '<div class="product-gallery__placeholder">';
        echo wc_placeholder_img( 'large' );
        echo '</div>';
        return;
    }
    
    echo '<div class="product-gallery">';
    echo '<div class="product-gallery__grid">';
    
    foreach ( $image_ids as $index => $image_id ) {
        $image_url = wp_get_attachment_image_url( $image_id, 'large' );
        $image_full = wp_get_attachment_image_url( $image_id, 'full' );
        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
        
        $main_class = $index === 0 ? 'product-gallery__item--main' : '';
        
        echo '<div class="product-gallery__item ' . esc_attr( $main_class ) . '">';
        echo '<a href="' . esc_url( $image_full ) . '" class="product-gallery__link" data-lightbox="product-gallery">';
        echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $image_alt ) . '" class="product-gallery__image" />';
        echo '</a>';
        echo '</div>';
    }
    
    echo '</div>';
    echo '</div>';
}
add_action( 'woocommerce_before_single_product_summary', 'prometheus_product_gallery', 20 );

/**
 * WooCommerce - Modify product tabs
 */
function prometheus_product_tabs( $tabs ) {
    // Rename tabs
    if ( isset( $tabs['description'] ) ) {
        $tabs['description']['title'] = __( 'Description', 'prometheus4aix' );
        $tabs['description']['priority'] = 10;
    }
    
    if ( isset( $tabs['additional_information'] ) ) {
        $tabs['additional_information']['title'] = __( 'Specifications', 'prometheus4aix' );
        $tabs['additional_information']['priority'] = 20;
    }
    
    if ( isset( $tabs['reviews'] ) ) {
        $tabs['reviews']['title'] = __( 'Reviews', 'prometheus4aix' );
        $tabs['reviews']['priority'] = 30;
    }
    
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'prometheus_product_tabs' );

/**
 * WooCommerce - Products per page
 */
function prometheus_products_per_page( $cols ) {
    return 12;
}
add_filter( 'loop_shop_per_page', 'prometheus_products_per_page' );

/**
 * WooCommerce - Products per row
 */
function prometheus_loop_columns() {
    return 3;
}
add_filter( 'loop_shop_columns', 'prometheus_loop_columns' );

/**
 * WooCommerce - Related products count
 */
function prometheus_related_products_args( $args ) {
    $args['posts_per_page'] = 4;
    $args['columns'] = 4;
    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'prometheus_related_products_args' );

/**
 * WooCommerce - Add custom body classes
 */
function prometheus_body_classes( $classes ) {
    if ( is_shop() || is_product_category() || is_product_tag() ) {
        $classes[] = 'prometheus-shop';
    }
    
    if ( is_product() ) {
        $classes[] = 'prometheus-product';
    }
    
    if ( is_cart() ) {
        $classes[] = 'prometheus-cart';
    }
    
    if ( is_checkout() ) {
        $classes[] = 'prometheus-checkout';
    }
    
    if ( is_account_page() ) {
        $classes[] = 'prometheus-account';
    }
    
    return $classes;
}
add_filter( 'body_class', 'prometheus_body_classes' );

/**
 * WooCommerce - Remove sidebar on product pages
 */
function prometheus_remove_sidebar() {
    if ( is_product() ) {
        remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
    }
}
add_action( 'wp', 'prometheus_remove_sidebar' );

/**
 * WooCommerce - Custom add to cart button text
 */
function prometheus_add_to_cart_text( $text, $product ) {
    if ( $product->is_type( 'simple' ) ) {
        return __( 'Add to Cart', 'prometheus4aix' );
    }
    return $text;
}
add_filter( 'woocommerce_product_add_to_cart_text', 'prometheus_add_to_cart_text', 10, 2 );

/**
 * Register widget areas
 */
function prometheus_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Shop Sidebar', 'prometheus4aix' ),
        'id'            => 'shop-sidebar',
        'description'   => __( 'Widgets for shop pages', 'prometheus4aix' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'prometheus_widgets_init' );

/**
 * AJAX add to cart for shop page
 */
function prometheus_ajax_add_to_cart() {
    add_filter( 'woocommerce_add_to_cart_fragments', 'prometheus_cart_count_fragments', 10, 1 );
}
add_action( 'init', 'prometheus_ajax_add_to_cart' );

function prometheus_cart_count_fragments( $fragments ) {
    $fragments['span.cart-count'] = '<span class="cart-count">' . WC()->cart->get_cart_contents_count() . '</span>';
    return $fragments;
}

/**
 * WooCommerce - Custom My Account menu items (Figma: Edit profile, Orders, Licenses, Downloads)
 */
function prometheus_account_menu_items( $items ) {
    $new_items = array(
        'edit-account' => __( 'Edit profile', 'prometheus4aix' ),
        'orders'       => __( 'Orders', 'prometheus4aix' ),
        'downloads'    => __( 'Downloads', 'prometheus4aix' ),
        'customer-logout' => __( 'Log out', 'prometheus4aix' ),
    );
    return $new_items;
}
add_filter( 'woocommerce_account_menu_items', 'prometheus_account_menu_items' );

/**
 * WooCommerce - Custom add to cart button with price
 */
function prometheus_single_add_to_cart_text( $text, $product ) {
    return 'ADD TO CART';
}
add_filter( 'woocommerce_product_single_add_to_cart_text', 'prometheus_single_add_to_cart_text', 10, 2 );

/**
 * Force classic Cart & Checkout (disable WooCommerce Blocks)
 * This ensures our custom cart.php template is used instead of the Block Cart.
 */
function prometheus_force_classic_cart_checkout( $use_block, $feature ) {
    if ( in_array( $feature, array( 'cart', 'checkout' ), true ) ) {
        return false;
    }
    return $use_block;
}
add_filter( 'woocommerce_should_load_cart_block', '__return_false' );
add_filter( 'woocommerce_should_load_mini_cart_block', '__return_false' );

// Disable Cart & Checkout blocks via BlockTypes registry
function prometheus_disable_wc_blocks() {
    // Replace block cart/checkout pages with shortcode versions if needed
    if ( class_exists( '\Automattic\WooCommerce\Blocks\BlockTypes\Cart' ) ) {
        // Force WooCommerce to use classic shortcode templates
        add_filter( 'woocommerce_cart_shortcode_tag', function() { return 'woocommerce_cart'; } );
    }
}
add_action( 'init', 'prometheus_disable_wc_blocks' );

/**
 * Disable WooCommerce block-based templates
 */
function prometheus_disable_wc_block_templates( $value, $option ) {
    if ( $option === 'woocommerce_cart_page_id' || $option === 'woocommerce_checkout_page_id' ) {
        return $value;
    }
    return $value;
}

/**
 * Remove WooCommerce Block styles that conflict with our theme
 */
function prometheus_dequeue_wc_block_styles() {
    wp_dequeue_style( 'wc-blocks-style' );
    wp_dequeue_style( 'wc-blocks-vendors-style' );
    wp_dequeue_style( 'wc-all-blocks-style' );
}
add_action( 'wp_enqueue_scripts', 'prometheus_dequeue_wc_block_styles', 100 );

/**
 * Remove default WooCommerce shop page title and result count
 */
add_filter( 'woocommerce_show_page_title', '__return_false' );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

/**
 * Remove breadcrumbs on WooCommerce pages (Figma has none)
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
