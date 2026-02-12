<?php
/**
 * The Template for displaying product archives (Shop page)
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
            
            <!-- Filters sidebar -->
            <aside class="shop-filters">
                <div class="filter-section">
                    <h3 class="filter-title">Categories</h3>
                    <?php 
                    $args = array(
                        'taxonomy' => 'product_cat',
                        'orderby' => 'name',
                        'show_count' => true,
                        'hierarchical' => true,
                        'title_li' => ''
                    );
                    ?>
                    <ul class="filter-list">
                        <?php wp_list_categories($args); ?>
                    </ul>
                </div>
                
                <div class="filter-section">
                    <h3 class="filter-title">Price Range</h3>
                    <?php the_widget( 'WC_Widget_Price_Filter' ); ?>
                </div>
            </aside>

            <!-- Products grid -->
            <div class="products-area">
                
                <div class="shop-toolbar">
                    <div class="result-count">
                        <?php woocommerce_result_count(); ?>
                    </div>
                    <div class="ordering">
                        <?php woocommerce_catalog_ordering(); ?>
                    </div>
                </div>

                <?php if ( woocommerce_product_loop() ) : ?>

                    <?php woocommerce_product_loop_start(); ?>

                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php wc_get_template_part( 'content', 'product' ); ?>
                    <?php endwhile; ?>

                    <?php woocommerce_product_loop_end(); ?>

                    <?php woocommerce_pagination(); ?>

                <?php else : ?>
                    <?php do_action( 'woocommerce_no_products_found' ); ?>
                <?php endif; ?>

            </div>
        </div>

    </div>
</main>

<?php get_footer(); ?>
