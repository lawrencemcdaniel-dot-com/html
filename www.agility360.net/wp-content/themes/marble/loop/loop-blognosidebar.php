<div class="blog no-sidebar">
  
<?php 
	$i = 0; 
	if ( have_posts() ) : while ( have_posts() ) : the_post(); 
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

<?php 
	/**
	 * ebor_close_wrapper hook
	 * All actions contained in /ebor_framework/theme_actions.php
	 *
	 * @hooked ebor_close_wrapper_markup - 10
	 */
	do_action('ebor_close_wrapper'); 
	
	if(!( $i % 2 == 0 )) echo '</div>';
	
	endwhile; 
	else:
	
		get_template_part('loop/loop','none');
	
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