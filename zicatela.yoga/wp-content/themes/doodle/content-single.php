<?php
/**
 * @package doodle
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="row">
		<div class="col-sm-3 entry-meta-wrapper">
			<div class="entry-meta">
			<div class="posted-on"><?php echo get_the_date(); ?></div>
			<div class="byline"><?php doodle_entry_byline(); ?></div>
			<?php doodle_entry_cats_and_tags(); ?>
			<div class="entry-comments-link"><?php doodle_entry_comments(); ?></div>
			</div>
		</div>

		<div class="col-sm-9">
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header>
			<div class="entry-content">
				<?php the_content(); ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'doodle' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
		</div>
	</div>

</article><!-- #post-## -->
