<?php 
	get_header();
	global $wp_query;
	$total_results = $wp_query->found_posts;
	
	( is_active_sidebar('primary') && get_option('blog_layout','blogsidebar') == 'blogsidebar' ) ? $layout  = 'searchsidebar' : $layout = 'searchnosidebar';
	
	get_template_part('loop/loop', $layout );
	
	get_footer();