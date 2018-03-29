<div class="blog no-sidebar">

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
  
  	<h1 class="post-title">
  		<?php 
  			_e('Your Search For: ','marble'); 
  			the_search_query(); 
  		?>
  		<br />
  		<?php 
  			_e( 'Returned: ', 'marble' ); 
  			echo $total_results; 
  			( $total_results == '1' ) ? _e(' Item','marble') : _e(' Items','marble'); 
  		?>
  	</h1>
  
<?php 
	/**
	 * ebor_close_wrapper hook
	 * All actions contained in /ebor_framework/theme_actions.php
	 *
	 * @hooked ebor_close_wrapper_markup - 10
	 */
	do_action('ebor_close_wrapper');
	
	$i = 0; 
	if ( have_posts() ) : while ( have_posts() ) : the_post(); 
	$i++;
	
	if(!( $i % 2 == 0 )) echo '<div class="dark-wrapper">';
	
	/**
	 * ebor_open_wrapper hook
	 * All actions contained in /ebor_framework/theme_actions.php
	 *
	 * @hooked ebor_open_wrapper_markup - 10
	 */
	do_action('ebor_open_wrapper'); 
?>
      
    <div <?php post_class('centered'); ?>>
      
      <?php 
      	do_action('ebor_post_title');
        do_action('ebor_post_format');
      	the_excerpt(); 
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
	
	if(!( $i % 2 == 0 )) echo '</div>'; 
	
	endwhile; else: 
?>
      
      <p><?php _e('Sorry, no posts matched your criteria.','marble'); ?></p>
      
<?php 
	endif;
	if( kriesi_pagination() ) : 
?>

    <div class="dark-wrapper">
      <?php 
      	/**
      	 * ebor_open_wrapper hook
      	 * All actions contained in /ebor_framework/theme_actions.php
      	 *
      	 * @hooked ebor_open_wrapper_markup - 10
      	 */
      	do_action('ebor_open_wrapper');
      	
      	echo function_exists('kriesi_pagination') ? kriesi_pagination() : posts_nav_link();
      	
      	/**
      	 * ebor_close_wrapper hook
      	 * All actions contained in /ebor_framework/theme_actions.php
      	 *
      	 * @hooked ebor_close_wrapper_markup - 10
      	 */
      	do_action('ebor_close_wrapper'); 
      ?>
    </div>
    
<?php 
	endif; 
?>
    
</div>