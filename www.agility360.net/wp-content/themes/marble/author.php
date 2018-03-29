<?php 
	get_header();
	the_post();
	
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
	  	
	  	<h1><?php printf( __( 'All posts by %s', 'marble' ), get_the_author() ); ?></h1>
	  	<div class="divide20"></div>
	  	
	  	<div class="author-details">
	  		<div class="overlay alignleft">
	  			<?php 
	  				if( get_the_author_meta('user_url') )
	  					echo '<a href="'. esc_url(get_the_author_meta('user_url')) .'">';
	  					
	  				echo get_avatar( get_the_author_meta('email'), 70 ); 
	  				
	  				if( get_the_author_meta('user_url') )
	  					echo '</a>';
	  			?>
	  		</div>
	  		
	  		<div class="post-content">
	  			<h2><?php echo get_the_author(); ?></h2>
	  			<?php echo wpautop( get_the_author_meta( 'description' )); ?>
	  		</div>
	  	</div>
	  	<div class="clear"></div>
	  	<hr />
	  	<div class="divide60"></div>
	  	
	      <?php 
	      	rewind_posts();
	      	if ( have_posts() ) : while ( have_posts() ) : the_post(); 
	      ?>
	      
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

	/**
	 * ebor_close_wrapper hook
	 * All actions contained in /ebor_framework/theme_actions.php
	 *
	 * @hooked ebor_close_wrapper_markup - 10
	 */ 
	do_action('ebor_close_wrapper');
	  
	get_footer();