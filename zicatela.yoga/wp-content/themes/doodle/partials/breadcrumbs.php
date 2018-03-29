<section class="site-section background-accent breadcrumbs-bar">
<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <?php if( !is_front_page() && get_theme_mod('doodle_display_breadcrumbs') ): ?>
          <?php
          if( function_exists('bcn_display') ) {
            echo '<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';
            bcn_display();
            echo '</div>';
          } elseif ( function_exists('yoast_breadcrumb') ) {
              yoast_breadcrumb('<p class="breadcrumbs">','</p>');
          } else {
              echo '<p class="breadcrumbs">' . __( 'Please install "Breadcrumb NavXT" or "WordPress SEO by Yoast" plugins', 'doodle' ) . '</p>';
          }
          ?>
      <?php endif; ?>
    </div>
    <div class="col-sm-6">
            <?php
                wp_nav_menu( array(
                    'menu'              => 'secondary',
                    'theme_location'    => 'secondary',
                    'depth'             => 2,
                    'menu_class'        => 'nav navbar-nav navbar-right secondary-nav',
                    'fallback_cb'       => false,
                    'walker'            => new wp_bootstrap_navwalker())
                );
            ?>      
    </div>
  </div>
</div>
</section>