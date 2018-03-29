<?php
/*
Template Name: Template - Page + Left Sidebar
*/
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


<!-- Page Blog Body Start
================================================== -->		
	
<section class="new-line" id="blog-page">
	<div class="container">
		<div class="row">

		<!-- START SIDEBAR -->
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>				
				<div class="col-md-4 col-sm-4" id="secondary">
					<?php get_sidebar(); ?>
				</div>
			<?php endwhile; endif; ?>	
			
			<!-- ============ START POSTS =========== -->
			<div class="col-md-8 col-sm-8" id="primary">
				<div class="blog-item">
					<?php if(have_posts()) : while(have_posts()) : the_post(); ?>				
						<!-- Content
						================================================== -->							
						<?php the_content(); ?>
						
						<!-- Blog Comments Section
						================================================== -->					
						<?php if(comments_open($post->ID )){?> 
						<div id="comment" class="comments">
								<?php comments_template('', true); ?>
						</div>															
						<?php } ?>
							
					<?php endwhile; endif; ?>						
				</div>
			</div>		
		</div>
	</div>
</section>


<!-- Get Page Footer
================================================== -->
<?php get_footer(); ?>