<?php
/**
 * Single Product Content - Prometheus4AIX (Figma aligned)
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( post_password_required() ) {
    echo get_the_password_form();
    return;
}
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'prom-product', $product ); ?>>

    <div class="prom-product__main container">

        <!-- Gallery 2x2 grid -->
        <div class="prom-product__gallery">
            <?php
            $image_ids = $product->get_gallery_image_ids();
            $main_image = $product->get_image_id();
            if ( $main_image ) array_unshift( $image_ids, $main_image );

            if ( ! empty( $image_ids ) ) :
            ?>
                <div class="prom-gallery-grid">
                    <?php foreach ( array_slice( $image_ids, 0, 4 ) as $image_id ) :
                        $url = wp_get_attachment_image_url( $image_id, 'large' );
                        $full = wp_get_attachment_image_url( $image_id, 'full' );
                        $alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                    ?>
                        <div class="prom-gallery-grid__item">
                            <a href="<?php echo esc_url( $full ); ?>" class="product-gallery__link">
                                <img src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_attr( $alt ); ?>" />
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="prom-gallery-grid__placeholder">
                    <svg width="200" height="200" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="200" height="200" rx="8" fill="#E8E8E8"/>
                        <path d="M60 140L90 100L110 125L130 95L150 140H60Z" fill="#C4C4C4"/>
                        <circle cx="80" cy="75" r="15" fill="#C4C4C4"/>
                    </svg>
                </div>
            <?php endif; ?>
        </div>

        <!-- Product Info -->
        <div class="prom-product__info">

            <h1 class="prom-product__title"><?php the_title(); ?></h1>

            <?php if ( $product->get_meta( '_subtitle' ) ) : ?>
                <p class="prom-product__subtitle"><?php echo esc_html( $product->get_meta( '_subtitle' ) ); ?></p>
            <?php endif; ?>

            <!-- Rating -->
            <div class="prom-product__rating">
                <?php
                if ( wc_review_ratings_enabled() ) {
                    $rating = $product->get_average_rating();
                    $count = $product->get_rating_count();
                    // Show 5 stars
                    for ( $i = 1; $i <= 5; $i++ ) {
                        echo $i <= round( $rating ) ? '<span class="prom-star prom-star--filled">★</span>' : '<span class="prom-star">★</span>';
                    }
                    if ( $count ) echo '<span class="prom-rating-count">(' . $count . ')</span>';
                }
                ?>
            </div>

            <!-- Short description / features -->
            <div class="prom-product__features">
                <?php echo wpautop( $product->get_short_description() ); ?>
            </div>

            <!-- Free trial link -->
            <p class="prom-product__trial-link">
                <a href="<?php the_permalink(); ?>?free-trial=1">Click here for 30 days free trial of <?php the_title(); ?></a>
            </p>

            <!-- Price -->
            <div class="prom-product__price">
                <?php echo $product->get_price_html(); ?>
            </div>

            <!-- Description line -->
            <?php if ( $product->get_meta( '_license_info' ) ) : ?>
                <p class="prom-product__license-info"><?php echo esc_html( $product->get_meta( '_license_info' ) ); ?></p>
            <?php else : ?>
                <p class="prom-product__license-info">One lifetime license for one AIX 7.x box.</p>
            <?php endif; ?>

            <!-- Quantity / Pack selector -->
            <div class="prom-product__pack">
                <?php woocommerce_template_single_add_to_cart(); ?>
            </div>

            <!-- Upsell: Buy with Loki -->
            <?php
            $upsells = $product->get_upsell_ids();
            if ( ! empty( $upsells ) ) :
                $upsell_product = wc_get_product( $upsells[0] );
                if ( $upsell_product ) :
            ?>
                <div class="prom-product__upsell">
                    <p class="prom-product__upsell-label">Buy with <?php echo esc_html( $upsell_product->get_name() ); ?></p>
                    <div class="prom-upsell-card">
                        <div class="prom-upsell-card__image">
                            <?php echo $upsell_product->get_image( 'thumbnail' ); ?>
                        </div>
                        <div class="prom-upsell-card__info">
                            <h4 class="prom-upsell-card__name"><?php echo esc_html( $upsell_product->get_name() ); ?></h4>
                            <div class="prom-upsell-card__price"><?php echo $upsell_product->get_price_html(); ?></div>
                        </div>
                    </div>
                </div>
            <?php endif; endif; ?>

        </div>
    </div>

    <!-- Tabs: Description | Specifications | Reviews -->
    <div class="prom-product__tabs container">
        <?php woocommerce_output_product_data_tabs(); ?>
    </div>

    <!-- Related Products -->
    <div class="prom-product__related container">
        <?php woocommerce_output_related_products(); ?>
    </div>

</div>
