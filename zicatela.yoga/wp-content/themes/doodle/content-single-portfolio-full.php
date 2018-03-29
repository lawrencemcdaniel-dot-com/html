<?php
/**
 * @package doodle
 */
?>

<?php
$terms = wp_get_post_terms($post->ID,'portfolio_category');
$terms_count = count($terms);
$data_groups = array();
if ( $terms_count > 0 ){
	foreach ( $terms as $term ) {
		$data_groups[] = $term->slug;
	}
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="row">

		<div class="col-xs-12">

			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

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
				</div>
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
