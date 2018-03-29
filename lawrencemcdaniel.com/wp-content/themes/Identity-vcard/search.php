<?php
/* Search Page */
?>


<!-- Get Page Header
================================================== -->	
<?php get_header(); ?>


<!-- Page Variables and Query
================================================== -->	
<?php

	global $query_string;

	$query_args = explode("&", $query_string);
	$search_query = array();

	foreach($query_args as $key => $string) {
		$query_split = explode("=", $string);
		$search_query[$query_split[0]] = urldecode($query_split[1]);
	}

	$search = new WP_Query($search_query);

?>


<!-- Page Title Section
================================================== -->	
<?php
	global $prof_default;
	
	$all = __(' Comments', 'sentient');
	$one = __(' Comment', 'sentient');	
	
	$displayedCat = '';
	
	$string = get_the_title();
	$pieces = explode(' ', $string);
	$last_word = array_pop($pieces);
	
	$string = str_replace($last_word, "", $string);	
?>

<div id="single" class="fullwidth-section bg-callout title-section">
	<div class="container">
		<div class="col-md-12 item_bottom">
			<!-- Section title -->
			<div class="section-title item_bottom text-center">
				<div style="background-color:<?php echo of_get_option('top_title_icon_color',$prof_default); ?>;">
					<span class="fa fa-search fa-2x"></span>
				</div>
				<h1 class="white page-title">
				<?php _e("Search for ", "sentient"); ?> <span style="background-color:<?php echo of_get_option('top_title_icon_word',$prof_default); ?>;"><?php echo get_search_query(); ?></span>
				</h1>
			</div>
			<!-- End Section title -->
		</div>
	</div>
</div>



<!-- Page Search Body Start
================================================== -->		
	
<section class="new-line new-line-archive" id="blog-page">
	<div class="container">
		<div class="row">
			<!-- ============ START CONTENT =========== -->
			<div class="col-md-8 col-sm-8" id="primary">
				<div class="blog-item search-page">
				<!-- Loop Started
				================================================== -->				
				<?php 
							
				if (have_posts() ) { ?>			 
					<?php while ( have_posts() ) : the_post();?>
						<article <?php post_class('post'); ?>>
							<h3 class="post-title"><a href="<?php echo esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h3>
							<div class="post-meta">
								<span class="author"><i class="fa fa-user"></i><?php esc_attr(the_author_meta( 'display_name' )); ?></span>
								<span class="time"><i class="fa fa-clock-o"></i><?php echo get_the_time('M') . ' ' . get_the_time('j') . ', ' . get_the_time('Y'); ?></span>
								<span class="category"><i class="fa fa-folder"></i>
									<?php 
										$categories = get_the_category(get_the_ID());
										$output = '';
										foreach ( $categories as $category ) {
											$output .= '<a href="' . esc_url(get_category_link( $category->term_id )) . '" >' . esc_attr($category->name) . '</a>' . ', ';
										}
										
										$displayedCat = trim($output, ', ');
										
										 echo wp_kses( $displayedCat, array(
												'a' => array(
													'href' => array(),
													'class' => array()									
												)
											) );
									?>								
								
								</span>
								<span class="comment pull-right"><i class="fa fa-comment"></i><?php comments_number( '0 ' . $all, '1 ' . $one, '% ' . $all); ?></span>
							</div>
							<div class="post-excerpt clearfix">
								<p><?php echo strip_shortcodes(wp_trim_words( get_the_content(), 60 )); ?></p>
								<a class="btn btn-default pull-left" href="<?php echo esc_url(the_permalink()); ?>"><?php _e("Read More" , "sentient"); ?></a>
							</div>							
						</article>
						
					<?php endwhile; ?>
					
					<!-- Pagination Started
					================================================== -->						
					<div class="pagination">
						<div class="pages">
							<?php
								global $wp_query;

								$big = 999999999;

								echo paginate_links( array(
									'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
									'format' => '?paged=%#%',
									'current' => max( 1, get_query_var('paged') ),
									'total' => $wp_query->max_num_pages,														
									'prev_text'    => __('<i class="fa fa-chevron-left"></i> Previous'),
									'next_text'    => __('Next <i class="fa fa-chevron-right"></i>')						
								) );
							?>
						</div>
					</div>
					<!-- Pagination End
					================================================== -->		
					
				<?php } else { ?>
				<div id="post-0" class="post no-results not-found">
					<h2 class="entry-title"><?php _e( 'Nothing Found', 'sentient' ) ?></h2>
					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'sentient' ); ?></p>                    
					</div>
				</div>
				<?php } ?>  			
				</div>
			</div>
			
			<!-- Sidebar
			================================================== -->				
			<div class="col-md-4 col-sm-4" id="secondary">
				<?php get_sidebar(); ?>
			</div>				
		</div>
	</div>
</section>



<!-- Get Page Footer
================================================== -->	
<?php get_footer(); ?>											