<?php
/**
 * Template Name: Shop
 *
 * @package doodle
 */

get_header(); ?>

<?php
$shop_sidebar = get_theme_mod('doodle_wc_sidebar', 'left');
switch ($shop_sidebar) {
	case 'right':
      $container_class = "col-md-9 col-lg-8";
      break;
    case 'none':
      $container_class = "col-md-12";
      break;
    default:
      $container_class = "col-md-9 col-md-push-3 col-lg-8 col-lg-push-4";
      break;
}
?>

    <div class="<?php echo $container_class; ?>">
	  <div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	  </div><!-- #primary -->
	</div><!-- .col-md-8 -->

	<?php if ($shop_sidebar != "none") { get_sidebar('shop'); } ?>

<?php get_footer(); ?>
