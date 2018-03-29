<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package doodle
 */
?>

    </div><!-- .row -->
  </div><!-- .container -->
</div><!-- #content -->


	<!-- FOOTER -->
    <section id="footer-section" class="site-footer inverse">
      <div class="container">
        <div class="row">
          <div class="col-sm-3 footer-1">
              <?php dynamic_sidebar( 'footer-1' ); ?>
          </div>
          <div class="col-sm-3 footer-2">
              <?php dynamic_sidebar( 'footer-2' ); ?>
          </div>
          <div class="col-sm-3 footer-3">
              <?php dynamic_sidebar( 'footer-3' ); ?>
          </div>
          <div class="col-sm-3 footer-4">
              <?php dynamic_sidebar( 'footer-4' ); ?>
          </div>
        </div>

        <div class="row">
        	<div class="col-xs-12 site-colophon">
            <?php if( is_active_sidebar('site-colophon') ) : ?>
                <?php dynamic_sidebar( 'site-colophon' ); ?>
            <?php else : ?>
              <h4>
              <span class="text-uppercase"><?php bloginfo( 'name' ); ?></span> <?php echo date( 'Y' ); ?> &middot; <?php _e( 'All rights reserved ', 'doodle' ); ?> 
              </h4>
            <?php endif; ?>
		Design by <a href="http://lawrencemcdaniel.com" target="_blank">Lawrence McDaniel</a>
        	</div>
        </div>

      </div>
    </section>
    <!-- /FOOTER -->

<?php wp_footer(); ?>

</body>
</html>