<?php 
	get_header();
	
	get_template_part('loop/loop', get_option('portfolio_layout','classic') );
 	
 	get_footer(); 