<?php
	/*
	Template Name: Page With Sidebar
	*/
	get_header();
	the_post();
?>

	<div class="container inner">
	  <div class="row blog">
	  
	    <div class="span8 posts">
	      <div <?php post_class(); ?>>
	      
	        <?php 
	        	/**
	        	 * ebor_post_title hook
	        	 * All actions contained in /ebor_framework/theme_actions.php
	        	 *
	        	 * @hooked ebor_post_title_markup - 10
	        	 */
	        	do_action('ebor_post_title'); 
	        	
	        	the_content();
	        	wp_link_pages();
	        ?>
	        
	      </div>
	      
	    </div>
	    
	    <?php get_sidebar('page'); ?>
	    
	  </div>
	  
	</div>

<?php
	get_footer();