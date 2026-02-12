<?php
/**
 * Search Form Template
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="search-form__wrapper">
        <input type="search" class="search-form__input" placeholder="<?php esc_attr_e( 'Search products…', 'prometheus4aix' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
        <input type="hidden" name="post_type" value="product" />
        <button type="submit" class="search-form__submit">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                <path d="M10.9998 10.9103C8.57234 13.3377 5.42721 13.3377 2.99977 10.9103C0.572341 8.48285 0.572341 5.33772 2.99977 2.91029C5.42721 0.482854 8.57234 0.482854 10.9998 2.91029C13.4272 5.33772 13.4272 8.48285 10.9998 10.9103ZM10.9998 10.9103L16.9998 16.9103" stroke="currentColor" stroke-linecap="round"/>
            </svg>
        </button>
    </div>
</form>
