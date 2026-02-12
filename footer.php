    <footer class="footer">
      <div class="footer__container container">
        <div class="footer-links">
          <a href="<?php echo esc_url( get_privacy_policy_url() ); ?>">Privacy Policy</a>
          <a href="<?php echo esc_url( home_url( '/terms-conditions/' ) ); ?>">Terms & Conditions</a>
          <a href="<?php echo esc_url( home_url( '/refund-returns/' ) ); ?>">Refund & Returns</a>
        </div>
        <div class="footer-logo">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footer-logo.png" alt="<?php bloginfo( 'name' ); ?>" />
          </a>
        </div>
        <div class="copyright">
          &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All Rights Reserved.
        </div>
      </div>
    </footer>
    <?php wp_footer(); ?>
  </body>
</html>
