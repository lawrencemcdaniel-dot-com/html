<?php 
	get_header();
	
	if( category_description() ) :  
	
		/**
		 * ebor_open_wrapper hook
		 * All actions contained in /ebor_framework/theme_actions.php
		 *
		 * @hooked ebor_open_wrapper_markup - 10
		 */
		do_action('ebor_open_wrapper'); 
	
	    echo do_shortcode( category_description() );
	    
		/**
		 * ebor_close_wrapper hook
		 * All actions contained in /ebor_framework/theme_actions.php
		 *
		 * @hooked ebor_close_wrapper_markup - 10
		 */
		do_action('ebor_close_wrapper');
		
		if( get_option('blog_layout', 'blogsidebar') == 'blogsidebar' ) echo '<div class="neg-margin"></div>';

	endif;
	  
	get_template_part('loop/loop', get_option('blog_layout','blogsidebar') );
	  
	get_footer();