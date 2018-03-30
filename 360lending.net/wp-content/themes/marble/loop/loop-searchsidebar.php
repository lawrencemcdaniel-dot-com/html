<?php 
	/**
	 * Declare total_results as global so we can access the counted posts from search.php
	 */ 
	global $total_results;
	
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
	  
	  	<h1 class="post-title">
	  		<?php 
	  			_e('Your Search For: ','marble'); 
	  			the_search_query(); 
	  			_e( ' Returned: ', 'marble' ); 
	  			echo $total_results; 
	  			( $total_results == '1' ) ? _e(' Item','marble') : _e(' Items','marble'); 
	  		?>
	  	</h1>
	  	<hr />
	  	<div class="divide50"></div>
	  
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
	          	
	          	the_excerpt();
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