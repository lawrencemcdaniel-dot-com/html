<div class="blog no-sidebar">
  
	<?php 
	  	$i = 0;
	  	$paged = (get_query_var('page')) ? get_query_var('page') : 1;
	  	$blog_query = new WP_Query('post_type=post&paged=' . $paged);
	  	if( $blog_query->have_posts() ) : while( $blog_query->have_posts() ) : $blog_query->the_post(); 
	  	global $post; 
	  	$i++;
	  	
	  	if(!( $i % 2 == 0 )) echo '<div class="dark-wrapper">';
	  	
	  	do_action('ebor_open_wrapper'); 
	?>
	      
        <div <?php post_class(); ?>>
          
          <?php 
          	do_action('ebor_post_title');
          	
          	do_action('ebor_post_format');
          	
          	global $more; 
          	$more = 0;
          	
          	the_content( get_option('blog_continue', 'Continue Reading &rarr;') ); 
          ?>
          
        </div><!--/post-->
	
	<?php 
		do_action('ebor_close_wrapper');
		
		if(!( $i % 2 == 0 )) echo '</div>';
		
		endwhile; 
		else: 
	?>
	      
	      	<p><?php _e('Sorry, no posts matched your criteria.','marble'); ?></p>
	      
	<?php 
		endif;
		
		if( kriesi_pagination() ) : 
	?>
	
		    <div class="dark-wrapper">
		      <?php 
		      	do_action('ebor_open_wrapper');
		      	echo function_exists('kriesi_pagination') ? kriesi_pagination($blog_query->max_num_pages) : posts_nav_link();
		      	do_action('ebor_close_wrapper'); 
		      ?>
		    </div>
		    
	<?php 
		endif;
		wp_reset_query();
	?>
    
</div>