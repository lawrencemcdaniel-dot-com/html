<?php
	/*
	Template Name: Blog No Sidebar
	*/
	get_header(); 
?>
  
<div class="blog no-sidebar">
  
	<?php 
		$i = 0;
		$paged = (get_query_var('page')) ? get_query_var('page') : 1;
		$blog_query = new WP_Query('post_type=post&paged=' . $paged);
		if( $blog_query->have_posts() ) : while( $blog_query->have_posts() ) : $blog_query->the_post(); 
		global $post; 
		$i++; 
		
		echo (!( $i % 2 == 0 )) ? '<div class="dark-wrapper">' : '<div class="light-wrapper">';
	
		/**
		 * ebor_open_wrapper hook
		 * All actions contained in /ebor_framework/theme_actions.php
		 *
		 * @hooked ebor_open_wrapper_markup - 10
		 */
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
		/**
		 * ebor_close_wrapper hook
		 * All actions contained in /ebor_framework/theme_actions.php
		 *
		 * @hooked ebor_close_wrapper_markup - 10
		 */
		do_action('ebor_close_wrapper'); 
	?>
      
</div>
    
    <?php endwhile; else: ?>
      
      	<p><?php _e('Sorry, no posts matched your criteria.','marble'); ?></p>
      
    <?php endif; ?>
	
	<?php if( kriesi_pagination() ) : ?>
	    <div class="dark-wrapper">
	      <?php do_action('ebor_open_wrapper'); ?>
	      
	        <?php echo function_exists('kriesi_pagination') ? kriesi_pagination($blog_query->max_num_pages) : posts_nav_link(); ?>
	        
	      <?php do_action('ebor_close_wrapper'); ?>
	    </div>
    <?php endif; ?>
    
    <?php wp_reset_query(); ?>
    
</div>
  
<?php get_footer();