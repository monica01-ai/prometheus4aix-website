<?php
/**
 * Shop/Catalog Page - Prometheus4AIX
 * Wide cards layout (image left + content right)
 */

get_header(); ?>

<main class="shop-page">
    <div class="shop-container container">

        <?php if ( woocommerce_product_loop() ) : ?>

            <div class="catalog-grid">
                <?php while ( have_posts() ) : the_post();
                    global $product;
                ?>
                    <div class="catalog-card">
                        <div class="catalog-card__image">
                            <a href="<?php the_permalink(); ?>">
                                <?php echo has_post_thumbnail() ? the_post_thumbnail( 'large' ) : wc_placeholder_img( 'large' ); ?>
                            </a>
                        </div>
                        <div class="catalog-card__content">
                            <h2 class="catalog-card__title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <div class="catalog-card__description">
                                <?php echo wpautop( $product->get_short_description() ); ?>
                            </div>
                            <div class="catalog-card__actions">
                                <a href="<?php the_permalink(); ?>" class="catalog-card__btn catalog-card__btn--plan">Choose Plan</a>
                                <a href="<?php the_permalink(); ?>" class="catalog-card__btn catalog-card__btn--trial">Free trial</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <?php woocommerce_pagination(); ?>

        <?php else : ?>
            <?php do_action( 'woocommerce_no_products_found' ); ?>
        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>
