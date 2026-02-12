<?php
/**
 * Search Results Template
 */

get_header(); ?>

<main class="search-results-page">
    <div class="container">
        
        <header class="search-results__header">
            <h1 class="search-results__title">
                <?php printf( __( 'Search results for: "%s"', 'prometheus4aix' ), get_search_query() ); ?>
            </h1>
            <div class="search-results__count">
                <?php printf( _n( '%d result found', '%d results found', $wp_query->found_posts, 'prometheus4aix' ), $wp_query->found_posts ); ?>
            </div>
        </header>

        <?php get_search_form(); ?>

        <?php if ( have_posts() ) : ?>
            <div class="search-results__grid products">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php if ( 'product' === get_post_type() ) : ?>
                        <?php wc_get_template_part( 'content', 'product' ); ?>
                    <?php else : ?>
                        <article class="search-result-item">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="search-result-item__excerpt"><?php the_excerpt(); ?></div>
                        </article>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>

            <?php the_posts_pagination( array(
                'prev_text' => '&laquo;',
                'next_text' => '&raquo;',
            ) ); ?>
        <?php else : ?>
            <div class="search-results__empty">
                <p><?php _e( 'Sorry, no results were found. Try a different search.', 'prometheus4aix' ); ?></p>
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>
