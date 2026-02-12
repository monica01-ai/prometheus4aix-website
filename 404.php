<?php
/**
 * 404 Template
 */

get_header(); ?>

<main class="error-404-page">
    <div class="container">
        <div class="error-404__content">
            <h1 class="error-404__title">404</h1>
            <p class="error-404__message">Page not found</p>
            <p class="error-404__desc">The page you're looking for doesn't exist or has been moved.</p>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="error-404__btn">Back to Home</a>
        </div>
    </div>
</main>

<?php get_footer(); ?>
