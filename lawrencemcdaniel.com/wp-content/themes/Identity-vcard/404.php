<?php
/**
 * 404 ( Not fount page )
 */
?>


<!-- Get Page Header
================================================== -->
<?php get_header(); ?>


<!-- Page Title Section
================================================== -->
<?php
	global $prof_default;
		
	$string = of_get_option('blank_page_title',$prof_default);
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
					<span class="fa fa-unlink fa-2x"></span>
				</div>
				<h1 class="white page-title">
					<?php echo esc_attr($string); ?> <span style="background-color:<?php echo of_get_option('top_title_icon_word',$prof_default); ?>;"><?php echo esc_attr($last_word); ?></span>
				</h1>
			</div>
			<!-- End Section title -->
		</div>
	</div>
</div>

<!-- 404 content Section -->
<section id="page" class="new-line">
	<div class="container">
		<div class="row">
		   <div class="col-md-6 col-md-offset-3 text-center">
			<p><?php echo esc_attr(of_get_option('blank_page_desc',$prof_default)); ?></p>
			<p><a href="<?php  echo esc_url(home_url()) ; ?>"><i class="fa fa-home fa-3x"></i></a></p>
		   </div>
		</div>
	</div>
</section>
<!-- End 404 Content Section -->


<!-- Footer Section
================================================== -->
<?php get_footer(); ?>
