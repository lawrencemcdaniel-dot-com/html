<?php  
/* Template Name: Template - Portfolio*/  
?>


<!-- Get Page Header
================================================== -->
<?php get_header(); ?>



<!-- Page Title Section
================================================== -->
<?php
	global $prof_default;
	
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
					<span class="fa fa-<?php echo esc_attr(get_post_meta(get_the_ID(), 'Icon', true)); ?> fa-2x"></span>
				</div>
				<h1 class="white page-title">
					<?php echo esc_attr($string); ?> <span style="background-color:<?php echo of_get_option('top_title_icon_word',$prof_default); ?>;"><?php echo esc_attr($last_word); ?></span>
				</h1>
			</div>
			<!-- End Section title -->
		</div>
	</div>
</div>


<?php
	if(of_get_option('portfolio_pagination_option',$prof_default) == 'On'){
		$portfolioTotal = '12';
	
	} else {
		$portfolioTotal = '-1';
	}
?>

<!-- Page Portfolio Body Start
================================================== -->		
<section class="new-line new-line-portfolio" id="blog-page">

	<?php
				$cat_string = '';
				$terms = get_terms("portfoliocategories");
				$count = count($terms);  
				$AllWord = __("ALL" , "sentient");
				if ( $count > 0 ){  
				  
					$cat_string .='<li>
								<a class="active" href="#" data-cat="*">' . esc_attr($AllWord)  . '</a>
								</li>';
					foreach ( $terms as $term ) {  
						if($term->name != 'Uncategorized' && $term->name != 'uncategorized'){
							$termname = strtolower($term->name);  
							$termname = str_replace(' ', '-', $termname);  
							$cat_string .= '<li>
								<a href="#" data-cat="' . esc_attr($termname) . '">' .  esc_attr($term->name) . '</a>
								</li>';  
						}
					}  
				}  			
	?>
	
	<!-- Page Portfolio Filter
	================================================== -->	
	<div id="portfolio-filter">
		<div class="row text-center">
			<div class="col-md-12">
				<ul class="portfolio-filter-list">
					<?php echo wp_kses( $cat_string, array(
								'a' => array(
									'href' => array(),
									'data-cat' => array(),
									'class' => array()									
								),
								'li' => array(),
							) );
					?>
				</ul>
			</div>
		</div>		
	</div>

	<!-- Page Portfolio Container
	================================================== -->	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div id="portfolio-items" class="portfolio-items item_fade_in">
				<?php
					$wp_query= null;
					$wp_query = new WP_Query();					
					$wp_query->query('post_type=portfolio&posts_per_page=' . $portfolioTotal . '&paged=' .$paged);
					
					$cat_count = 1;
					
					while ($wp_query->have_posts()) : $wp_query->the_post();
						$cat_count = 1;
						$terms = get_the_terms( get_the_ID() , 'portfoliocategories' );  
						$separator = ' / ';
						$output = '';
						$outputClass = '';
						if ( $terms && ! is_wp_error( $terms ) ) {   

							foreach ( $terms as $term )   
							{  
								$termname = strtolower($term->name);
								if($cat_count < 3){											
									$output .= $term->name . $separator;
								}
								$outputClass .= $termname . ' ';
								$cat_count = $cat_count + 1;
							} 
							
							$final_cat_string = trim($output, $separator);
							
						} else {   
						   $final_cat_string = '';
						   $outputClass = '';
						}			
					
					

						if ( get_post_format() == false) {									
							$porIcon = 'camera';
						}elseif ( has_post_format('video')) {
							$porIcon = 'film';
						}elseif ( has_post_format('gallery')) {
							$porIcon = 'image';
						}elseif ( has_post_format( 'audio' )) { 							
							$porIcon = 'music';
						}else { 
							$porIcon = 'camera';			
						} 		
				?>
				
				<article class="<?php echo esc_attr($outputClass); ?>">							
					<a class="" href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( get_the_ID() , 'full'  ); ?>
					<div class="overlay">
						<div class="item-info">
							<i class="fa fa-<?php echo esc_attr($porIcon); ?>"></i>
							<h3><?php the_title(); ?></h3>
							<span><?php echo esc_attr($final_cat_string); ?></span>
						</div>
					</div>
					</a>
				</article>

				<?php endwhile;?>
			
	
				</div>
				
				<!-- Pagination Begin
				================================================== -->
		
				<?php
					if(of_get_option('portfolio_pagination_option',$prof_default) == 'On'){
				?>

				<div class="pagination">
					<div class="pages">
						<?php
							global $wp_query;

							$big = 999999999;
							$modified = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
							$modified = str_replace( '#038;', '', $modified  );
							echo paginate_links( array(
								'base' => $modified,
								'format' => '?paged=%#%',
								'current' => max( 1, get_query_var('paged') ),
								'total' => $wp_query->max_num_pages,														
								'prev_text'    => __('<i class="fa fa-chevron-left"></i> Previous'),
								'next_text'    => __('Next <i class="fa fa-chevron-right"></i>')						
							) );
						?>
					</div>
				</div>
				<?php
					}
				?>				
				<!-- Pagination End
				================================================== -->						
			</div>
		</div>
	</div>
	
	
	
</section>


<!-- Get Page Footer
================================================== -->
<?php get_footer(); ?>