<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  </head>

  <body <?php body_class(); ?>>

    <header class="page-header page-header--nojs">
      <div class="page-header__container container">
        <a class="page-header__logo" href="<?php  echo esc_url( home_url( '/' ) ); ?>">
          <picture>
            <source media="(min-width: 1440px)" srcset="<?php echo get_stylesheet_directory_uri()?>/images/logo-1440.svg">
            <source media="(max-width: 1440px)" srcset="<?php echo get_stylesheet_directory_uri()?>/images/logo-1440.svg">
            <source media="(max-width: 960px)" srcset="<?php echo get_stylesheet_directory_uri()?>/images/logo-480.svg">
            <source media="(max-width: 480px)" srcset="<?php echo get_stylesheet_directory_uri()?>/images/logo-480.svg">
            <img class="page-header__logo-image" src="<?php echo get_stylesheet_directory_uri()?>/images/logo-footer-768.svg" width="244px" height="67px" alt="Logo">
          </picture>
        </a>

        <nav class="main-nav">
          <button class="main-nav__toggle main-nav__toggle--opened" type="button">
            <span class="visually-hidden">menu</span>
          </button>

          <?php //wp_nav_menu( array( 'header-menu' => 'header-menu' ) ); ?>

          <ul class="main-nav__list">
            <li class="main-nav__item main-nav__item--contacts">
              <a class="main-nav__item-link main-nav__item-link--contacts" href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>">Contacts</a>
            </li>
            <li class="main-nav__item main-nav__item--shop">
              <a class="main-nav__item-link main-nav__item-link--shop" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">Shop</a>
            </li>
            <li class="main-nav__item main-nav__item--howto">
              <a class="main-nav__item-link main-nav__item-link--howto" href="<?php echo esc_url( home_url( '/how-to/' ) ); ?>">How to</a>
            </li>

            <li class="main-nav__item main-nav__item--search">
              <a class="main-nav__item-link main-nav__item-link--search" href="<?php echo esc_url( home_url( '/?s=' ) ); ?>"><span>Search</span>
                <svg class="main-nav__item-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                  <path d="M10.9998 10.9103C8.57234 13.3377 5.42721 13.3377 2.99977 10.9103C0.572341 8.48285 0.572341 5.33772 2.99977 2.91029C5.42721 0.482854 8.57234 0.482854 10.9998 2.91029C13.4272 5.33772 13.4272 8.48285 10.9998 10.9103ZM10.9998 10.9103L16.9998 16.9103" stroke="#563075" stroke-linecap="round"/>
                </svg>
              </a>
            </li>

            <li class="main-nav__item main-nav__item--account">
              <a class="main-nav__item-link main-nav__item-link--profile" href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>"><span>My page</span>
                <svg class="main-nav__item-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                  <path d="M1 16.5C1 11.1667 17 11.1667 17 16.5M14 5.5C14 8.44552 11.7614 11.5 9 11.5C6.23858 11.5 4 8.44552 4 5.5C4 2.55448 6.23858 0.5 9 0.5C11.7614 0.5 14 2.55448 14 5.5Z" stroke="#563075" stroke-linecap="round"/>
                </svg>
              </a>
            </li>

            <li class="main-nav__item main-nav__item--cart mini-cart-wrapper">
              <a class="main-nav__item-link main-nav__item-link--cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>"><span>Cart</span><?php if ( function_exists( 'WC' ) && WC()->cart->get_cart_contents_count() > 0 ) : ?><span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span><?php endif; ?>
                <svg class="main-nav__item-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                  <path d="M4 4.5H16M4 4.5L7 12.5H16V4.5M4 4.5L3 0.5H1M16 4.5V2.5M9 15.5C9 16.1627 8.66274 16.5 8 16.5C7.33726 16.5 7 16.1627 7 15.5C7 14.8373 7.33726 14.5 8 14.5C8.66274 14.5 9 14.8373 9 15.5ZM17 15.5C17 16.1627 16.6627 16.5 16 16.5C15.3373 16.5 15 16.1627 15 15.5C15 14.8373 15.3373 14.5 16 14.5C16.6627 14.5 17 14.8373 17 15.5Z" stroke="#563075" stroke-linecap="round"/>
                </svg>
              </a>
              <div class="mini-cart-dropdown">
                <?php if ( function_exists( 'WC' ) ) { woocommerce_mini_cart(); } ?>
              </div>
            </li>
          </ul>

        </nav>

      </div>
    </header>
    <script src="<?php echo get_stylesheet_directory_uri()?>/js/menu.js"></script>
