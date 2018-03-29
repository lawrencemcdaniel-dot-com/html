<?php
/**
 * The template for displaying all single posts.
 *
 * @package doodle
 */

get_header(); ?>

    <div class="col-lg-10 col-lg-offset-1">
	  <div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single-portfolio-full' ); ?>

			<div class="row">
			<div class="col-xs-12">
			<?php doodle_post_navigation(); ?>
			</div>
			</div>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	  </div><!-- #primary -->
    </div><!-- .col-lg-10 -->

<?php get_footer(); ?>
