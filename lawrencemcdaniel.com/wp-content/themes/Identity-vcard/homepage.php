<?php
/*
Template Name: Template - Homepage
*/
?>



<!-- Get Page Header
================================================== -->
<?php get_header(); ?>

<?php
	global $prof_default;
	
	$string = get_the_title();
	$pieces = explode(' ', $string);
	$last_word = array_pop($pieces);
	
	$string = str_replace($last_word, "", $string);	
?>

<?php if(!is_home() && !is_front_page()) { ?>
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
<?php } ?>



<!-- Page Begin
================================================== -->
<div class="main-container">
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>				
	<div class="main-page-column-data main-page-column-data-full">
		<div class="get-column-container">			
			<div class="page-content">
				<?php the_content(); ?>			
			</div>				
		</div>
	</div>
	<?php endwhile; endif; ?>			
</div>


<!-- Get Page Header
================================================== -->
<?php get_footer(); ?>