<?php
/**
 * Single Product Content - Figma Design v2
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( post_password_required() ) {
    echo get_the_password_form();
    return;
}
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'single-product-page', $product ); ?>>

    <!-- Product Main Section -->
    <div class="product-main container">
        
        <!-- Product Gallery - 2x2 Grid -->
        <div class="product-gallery-2x2">
            <?php
            $image_ids = $product->get_gallery_image_ids();
            $main_image = $product->get_image_id();
            
            if ( $main_image ) {
                array_unshift( $image_ids, $main_image );
            }
            
            // Limit to 4 images for 2x2 grid
            $display_images = array_slice( $image_ids, 0, 4 );
            
            if ( ! empty( $display_images ) ) :
            ?>
                <div class="gallery-grid-2x2">
                    <?php foreach ( $display_images as $index => $image_id ) : 
                        $image_url = wp_get_attachment_image_url( $image_id, 'large' );
                        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                    ?>
                        <div class="gallery-item">
                            <img src="<?php echo esc_url( $image_url ); ?>" 
                                 alt="<?php echo esc_attr( $image_alt ); ?>" />
                        </div>
                    <?php endforeach; ?>
                    
                    <?php 
                    // Fill remaining slots if less than 4 images
                    for ( $i = count($display_images); $i < 4; $i++ ) : 
                    ?>
                        <div class="gallery-item gallery-placeholder">
                            <?php echo wc_placeholder_img( 'medium' ); ?>
                        </div>
                    <?php endfor; ?>
                </div>
            <?php else : ?>
                <div class="gallery-grid-2x2">
                    <?php for ( $i = 0; $i < 4; $i++ ) : ?>
                        <div class="gallery-item gallery-placeholder">
                            <?php echo wc_placeholder_img( 'medium' ); ?>
                        </div>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Product Info -->
        <div class="product-info-detailed">
            
            <!-- Product Name (Purple, Uppercase) -->
            <h1 class="product-title-main"><?php echo strtoupper( get_the_title() ); ?></h1>
            
            <!-- Tagline/Subtitle -->
            <?php if ( $product->get_short_description() ) : ?>
                <div class="product-tagline"><?php echo $product->get_short_description(); ?></div>
            <?php endif; ?>
            
            <!-- 5 Stars Rating -->
            <div class="product-rating-display">
                <div class="stars-5">
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                </div>
                <?php 
                $rating_count = $product->get_rating_count();
                if ( $rating_count > 0 ) {
                    echo '<span class="rating-text">(' . $rating_count . ' reviews)</span>';
                }
                ?>
            </div>

            <!-- Feature Bullets -->
            <div class="product-features">
                <?php 
                $features = get_post_meta( get_the_ID(), '_product_features', true );
                if ( !$features ) {
                    // Default features if not set
                    $features = [
                        'Advanced monitoring capabilities',
                        'Real-time alerting system', 
                        'Enterprise-grade security',
                        'Comprehensive reporting tools'
                    ];
                }
                if ( is_array( $features ) ) :
                ?>
                    <ul class="features-list">
                        <?php foreach ( $features as $feature ) : ?>
                            <li class="feature-item">• <?php echo esc_html( $feature ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <!-- Free Trial Link -->
            <div class="free-trial-section">
                <a href="#" class="free-trial-link">Click here for 30 days free trial</a>
            </div>

            <!-- Pricing -->
            <div class="product-pricing">
                <?php 
                $regular_price = $product->get_regular_price();
                $sale_price = $product->get_sale_price();
                
                if ( $sale_price && $sale_price < $regular_price ) :
                ?>
                    <div class="price-display">
                        <span class="price-current"><?php echo wc_price( $sale_price ); ?></span>
                        <span class="price-crossed"><?php echo wc_price( $regular_price ); ?></span>
                        <span class="msrp-label">MSRP</span>
                    </div>
                <?php else : ?>
                    <div class="price-display">
                        <span class="price-current"><?php echo wc_price( $regular_price ); ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <!-- License Description -->
            <div class="license-description">
                <p>One lifetime license for unlimited installations and premium support.</p>
            </div>

            <!-- Pack Selector -->
            <div class="pack-selector">
                <label for="quantity">Pack</label>
                <select id="quantity" name="quantity" class="qty-select">
                    <option value="1">x1</option>
                    <option value="2">x2</option>
                    <option value="3">x3</option>
                    <option value="5">x5</option>
                    <option value="10">x10</option>
                </select>
            </div>

            <!-- Buy with Loki Upsell -->
            <div class="upsell-section">
                <h4>Buy with Loki</h4>
                <div class="upsell-product-mini">
                    <div class="mini-product-image">
                        <!-- Mini product image placeholder -->
                        <img src="/placeholder-loki.jpg" alt="Loki Product" />
                    </div>
                    <div class="mini-product-info">
                        <h5>LOKI MONITORING</h5>
                        <p>Enhanced monitoring suite</p>
                        <span class="mini-price">+25€</span>
                    </div>
                </div>
            </div>

            <!-- Add to Cart Button -->
            <div class="add-to-cart-section">
                <?php 
                $current_price = $sale_price ? $sale_price : $regular_price;
                ?>
                <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" 
                        class="btn-add-to-cart">
                    ADD TO CART <?php echo wc_price( $current_price ); ?>
                </button>
            </div>

        </div>
    </div>

    <!-- Product Tabs -->
    <div class="product-tabs-section container">
        <div class="tabs-header">
            <button class="tab-btn active" data-tab="description">Description</button>
            <button class="tab-btn" data-tab="specifications">Specifications</button>
            <button class="tab-btn" data-tab="reviews">Reviews</button>
        </div>
        
        <div class="tabs-content">
            <div id="description" class="tab-panel active">
                <div class="tab-content">
                    <?php echo wpautop( $product->get_description() ); ?>
                </div>
            </div>
            
            <div id="specifications" class="tab-panel">
                <div class="tab-content">
                    <?php 
                    // Display product attributes as specifications
                    $attributes = $product->get_attributes();
                    if ( ! empty( $attributes ) ) :
                    ?>
                        <table class="specs-table">
                            <?php foreach ( $attributes as $attribute ) : ?>
                                <tr>
                                    <td class="spec-label"><?php echo wc_attribute_label( $attribute->get_name() ); ?></td>
                                    <td class="spec-value">
                                        <?php
                                        if ( $attribute->is_taxonomy() ) {
                                            echo wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'names' ) );
                                        } else {
                                            echo wp_kses_post( $attribute->get_options()[0] );
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php else : ?>
                        <p>No specifications available.</p>
                    <?php endif; ?>
                </div>
            </div>
            
            <div id="reviews" class="tab-panel">
                <div class="tab-content">
                    <?php comments_template( 'woocommerce/single-product-reviews.php' ); ?>
                </div>
            </div>
        </div>
    </div>

</div>
