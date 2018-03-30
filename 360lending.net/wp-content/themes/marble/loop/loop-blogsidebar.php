<?php 
	/**
	 * ebor_open_wrapper hook
	 * All actions contained in /ebor_framework/theme_actions.php
	 *
	 * @hooked ebor_open_wrapper_markup - 10
	 */
	do_action('ebor_open_wrapper'); 
?>
  
	<div class="row blog">
	  <div class="span8 posts">
	  
	      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	      
	        <div <?php post_class(); ?>>
	          <?php 
	          	/**
	          	 * ebor_post_title hook
	          	 * All actions contained in /ebor_framework/theme_actions.php
	          	 *
	          	 * @hooked ebor_post_title_markup - 10
	          	 */
	          	do_action('ebor_post_title');
	          	
	          	/**
	          	 * ebor_post_format hook
	          	 * All actions contained in /ebor_framework/theme_actions.php
	          	 *
	          	 * @hooked ebor_post_format_markup - 10
	          	 */
	          	do_action('ebor_post_format');
	          	
	          	the_content( get_option('blog_continue', 'Continue Reading &rarr;') );
	          ?>
	        </div>
	        <hr />
	        <div class="divide60"></div>
	          
	        <?php 
	        	endwhile; 
	        	else:
	        	
	        		get_template_part('loop/loop','none');
	        	
	        	endif; 
	        	
	        	echo function_exists('kriesi_pagination') ? kriesi_pagination() : posts_nav_link(); 
	        ?>
	    
	  </div>
	  
	  <?php get_sidebar(); ?>
	
	</div>

<?php
	/**
	 * ebor_close_wrapper hook
	 * All actions contained in /ebor_framework/theme_actions.php
	 *
	 * @hooked ebor_close_wrapper_markup - 10
	 */ 
	do_action('ebor_close_wrapper');