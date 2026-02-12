<?php
/**
 * Single Product Content
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( post_password_required() ) {
    echo get_the_password_form();
    return;
}
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'single-product', $product ); ?>>

    <!-- Product Main Section -->
    <div class="product-main container">
        
        <!-- Product Gallery -->
        <div class="product-gallery">
            <?php
            $image_ids = $product->get_gallery_image_ids();
            $main_image = $product->get_image_id();
            
            if ( $main_image ) {
                array_unshift( $image_ids, $main_image );
            }
            
            if ( ! empty( $image_ids ) ) :
            ?>
                <div class="product-gallery__grid">
                    <?php foreach ( $image_ids as $index => $image_id ) : 
                        $image_url = wp_get_attachment_image_url( $image_id, 'large' );
                        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                    ?>
                        <div class="product-gallery__item <?php echo $index === 0 ? 'product-gallery__item--main' : ''; ?>">
                            <img src="<?php echo esc_url( $image_url ); ?>" 
                                 alt="<?php echo esc_attr( $image_alt ); ?>" 
                                 class="product-gallery__image" />
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="product-gallery__placeholder">
                    <?php echo wc_placeholder_img( 'large' ); ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Product Info -->
        <div class="product-info">
            
            <h1 class="product-info__title"><?php the_title(); ?></h1>
            
            <div class="product-info__rating">
                <?php 
                if ( wc_review_ratings_enabled() ) {
                    $rating_count = $product->get_rating_count();
                    $average = $product->get_average_rating();
                    echo wc_get_rating_html( $average, $rating_count );
                    if ( $rating_count > 0 ) {
                        echo '<span class="rating-count">(' . $rating_count . ' reviews)</span>';
                    }
                }
                ?>
            </div>

            <div class="product-info__price">
                <?php echo $product->get_price_html(); ?>
            </div>

            <div class="product-info__description">
                <?php echo wpautop( $product->get_short_description() ); ?>
            </div>

            <div class="product-info__add-to-cart">
                <?php woocommerce_template_single_add_to_cart(); ?>
            </div>

            <div class="product-info__meta">
                <?php if ( $product->get_sku() ) : ?>
                    <div class="meta-item">
                        <span class="meta-label">SKU:</span>
                        <span class="meta-value"><?php echo esc_html( $product->get_sku() ); ?></span>
                    </div>
                <?php endif; ?>
                
                <?php 
                $categories = wc_get_product_category_list( $product->get_id(), ', ' );
                if ( $categories ) : 
                ?>
                    <div class="meta-item">
                        <span class="meta-label">Category:</span>
                        <span class="meta-value"><?php echo $categories; ?></span>
                    </div>
                <?php endif; ?>
                
                <?php 
                $tags = wc_get_product_tag_list( $product->get_id(), ', ' );
                if ( $tags ) : 
                ?>
                    <div class="meta-item">
                        <span class="meta-label">Tags:</span>
                        <span class="meta-value"><?php echo $tags; ?></span>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <!-- Product Tabs (Reviews & Specifications) -->
    <div class="product-tabs container">
        <?php woocommerce_output_product_data_tabs(); ?>
    </div>

    <!-- Related Products -->
    <div class="related-products container">
        <?php woocommerce_output_related_products(); ?>
    </div>

</div>
