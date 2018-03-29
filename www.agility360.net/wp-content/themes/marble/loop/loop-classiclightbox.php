<?php 
	/**
	 * ebor_open_wrapper hook
	 * All actions contained in /ebor_framework/theme_actions.php
	 *
	 * @hooked ebor_open_wrapper_markup - 10
	 */
	do_action('ebor_open_wrapper'); 
?>

	<div class="fix-portfolio">
	    
	  <?php 
	  		if(!( is_tax() )) 
	  			do_action('ebor_portfolio_filters'); 
	  		
	  		if( is_tax() && get_categories('taxonomy=portfolio-category&child_of='.get_queried_object()->term_id) ){	
	  			echo '<ul class="filter"><li><a class="active" href="#" data-filter="*">'.__('All','marble').'</a></li>';
	  			echo '<li><a href="#" data-filter=".'.get_queried_object()->slug.'">'.get_queried_object()->name.'</a></li>';
	  			
	  			$categories = get_categories('taxonomy=portfolio-category&child_of='.get_queried_object()->term_id);
	  			foreach ($categories as $category){
	  				echo '<li><a href="#" data-filter=".' . $category->slug . '">' . $category->name . '</a></li>';
	  			}
	  			
	  			echo '</ul>';
	  		}
	  ?>
	  
	  <ul class="items thumbs">
	  
	      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	      
	        <?php get_template_part('content/content','classiclightbox'); ?>
	        
	      <?php endwhile; else: ?>
	        
	        	<p><?php _e('Sorry, no posts matched your criteria.','marble'); ?></p>
	        
	      <?php endif; ?>
	
	  </ul>
	  
	   <?php ebor_load_more(); ?>
	
	</div>
	
<?php 
	/**
	 * ebor_close_wrapper hook
	 * All actions contained in /ebor_framework/theme_actions.php
	 *
	 * @hooked ebor_close_wrapper_markup - 10
	 */
	do_action('ebor_close_wrapper');