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
			<?php
				$terms = wp_get_post_terms($post->ID,'portfolio_tag');
				$terms_count = count($terms);
				if ( $terms_count > 0 ){
					echo '<div class="cat-links">';
				    foreach ( $terms as $term ) {
				    	echo '<span><a href="'.get_term_link($term->slug, 'portfolio_tag').'">'. $term->name . "</a></span>";
					}
					echo '</div>';
				} ?>
			<div class="entry-comments-link"><?php doodle_entry_comments(); ?></div>
			</div>

		</div>
		<div class="col-sm-9">
			<header class="entry-header">
				<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
			</header>
			<div class="entry-content">
				<?php doodle_post_thumbnail(); ?>
				<?php
					/* translators: %s: Name of current post */
					/*
					the_content( sprintf(
						__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'doodle' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );
					*/
					the_excerpt();
				?>

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
