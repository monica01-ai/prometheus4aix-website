<?php
/**
 * The Template for displaying product archives (Shop page) - Figma Design v2
 */

get_header(); ?>

<main class="shop-page">
    <div class="shop-container container">
        
        <header class="shop-header">
            <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                <h1 class="shop-title"><?php woocommerce_page_title(); ?></h1>
            <?php endif; ?>
            
            <?php do_action( 'woocommerce_archive_description' ); ?>
        </header>

        <div class="shop-content">
            <!-- Products in large card format -->
            <div class="products-area products-cards">

                <?php if ( woocommerce_product_loop() ) : ?>

                    <div class="product-cards-grid">

                        <?php while ( have_posts() ) : the_post(); ?>
                            <div class="product-card">
                                <div class="product-card__image">
                                    <?php echo woocommerce_get_product_thumbnail('large'); ?>
                                </div>
                                <div class="product-card__content">
                                    <h3 class="product-card__title">
                                        <a href="<?php echo get_permalink(); ?>"><?php echo strtoupper(get_the_title()); ?></a>
                                    </h3>
                                    <div class="product-card__description">
                                        <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                    </div>
                                    <div class="product-card__actions">
                                        <a href="<?php echo get_permalink(); ?>" class="btn btn-outline">CHOOSE PLAN</a>
                                        <a href="<?php echo get_permalink(); ?>" class="btn-text-link">Free trial</a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>

                    </div>

                    <?php woocommerce_pagination(); ?>

                <?php else : ?>
                    <div class="no-products">
                        <?php do_action( 'woocommerce_no_products_found' ); ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>

    </div>
</main>

<?php get_footer(); ?>
