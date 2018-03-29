<?php
/**
 * Template Name: Portfolio
 *
 * @package doodle
 */

get_header();

$animated_filter = get_post_meta(get_the_ID(), '_doodle_portfolio_animated_filter', true);
$hide_title = get_post_meta(get_the_ID(), '_doodle_portfolio_hide_title', true);
$hide_excerpt = get_post_meta(get_the_ID(), '_doodle_portfolio_hide_excerpt', true);
$hide_tags = get_post_meta(get_the_ID(), '_doodle_portfolio_hide_tags', true);

$number_of_items = get_post_meta(get_the_ID(), '_doodle_portfolio_number_of_items', true);
$number_of_items = ( is_numeric($number_of_items) ) ? intval( $number_of_items ) : -1;
if ($animated_filter) {$number_of_items = -1;}

$number_of_columns = get_post_meta(get_the_ID(), '_doodle_portfolio_number_of_columns', true);
$number_of_columns = ( is_numeric($number_of_columns) ) ? intval( $number_of_columns ) : 3;
$i = 0;
switch ($number_of_columns) {
	case 2:
		$col_class = "col-sm-6";
		break;
	case 4:
		$col_class = "col-sm-3";
		break;
	case 6:
		$col_class = "col-sm-2";
		break;
	default:
		$col_class = "col-sm-4";
		break;
}

$thumbnail_format = get_post_meta(get_the_ID(), '_doodle_portfolio_thumbnail_format', true);
$thumbnail_format = ($thumbnail_format) ? $thumbnail_format : 'doodle-thumb';

$category_slug = get_post_meta(get_the_ID(), '_doodle_portfolio_category_slug', true);
$tax_query = array();
if ( !empty($category_slug) ) {
	$tax_query1 = array(
		'taxonomy' => 'portfolio_category',
		'field'    => 'slug',
		'terms'    => sanitize_title_with_dashes($category_slug),
	);
	$tax_query[] = $tax_query1;
}
?>

    <div class="col-md-12">
	  <div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<header class="page-header">
					<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
					<div class="page-description"><?php the_content(); ?></div>
				</header><!-- .entry-header -->

			<?php endwhile; ?>

			<?php if ( $animated_filter ) {
				get_template_part( 'partials/portfolio', 'filters' );
			} ?>

			<?php
			// List portfolio items
			$args = array(
				'post_type' => 'portfolio',
				'post_status' => 'publish',
				'paged' => $paged,
				'posts_per_page'=>$number_of_items,
				'tax_query'=>$tax_query,
			);
			$temp = $wp_query; // assign ordinal query to temp variable for later use
			$wp_query = new WP_Query( $args ); ?>

			<div <?php if($animated_filter): ?>id="portfolio-grid"<?php endif; ?> class="row">

			<?php if( $wp_query->have_posts() && post_type_exists( 'portfolio' ) ) : while( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

				<?php if( !$animated_filter && $i>0 && $i%$number_of_columns==0): ?>
					</div><div class="row">
				<?php endif; $i++; ?>

				<?php 
				$terms = wp_get_post_terms($post->ID,'portfolio_category');
				$terms_count = count($terms);
				$data_groups = array('shuffle-all');
				if ( $terms_count > 0 ){
					foreach ( $terms as $term ) {
						$data_groups[] = $term->slug;
					}
				}
				?>

				<div class="<?php echo $col_class; ?> grid-item" data-groups='<?php echo json_encode($data_groups); ?>'>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php doodle_post_thumbnail($thumbnail_format); ?>

						<?php
							if ( !$hide_title ) {
								the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );
							}
						?>
						<?php
							if ( !$hide_tags ) {
								$terms = wp_get_post_terms($post->ID,'portfolio_tag');
								$terms_count = count($terms);
								if ( $terms_count > 0 ){
									echo '<div class="cat-links">';
								    foreach ( $terms as $term ) {
								    	echo '<span><a href="'.get_term_link($term->slug, 'portfolio_tag').'">'. $term->name . "</a></span>";
									}
									echo '</div>';
								}
							}
						?>
						<?php
							/* translators: %s: Name of current post */
							/*
							the_content( sprintf(
								__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'doodle' ),
								the_title( '<span class="screen-reader-text">"', '"</span>', false )
							) );
							*/
							if ( !$hide_excerpt ) {
								echo '<p>';
								doodle_excerpt_max_length(85);
								echo '</p>';
							}
						?>

					</article><!-- #post-## -->
				</div>

			<?php endwhile; ?>

			</div>

			<?php doodle_numeric_paging_nav(); ?>

			<?php endif;

			$wp_query = $temp;

			// Reset the global $the_post as this query will have stomped on it
        	wp_reset_postdata(); ?>

		</main><!-- #main -->
	  </div><!-- #primary -->
	</div><!-- .col-md-12 -->

<?php get_footer(); ?>