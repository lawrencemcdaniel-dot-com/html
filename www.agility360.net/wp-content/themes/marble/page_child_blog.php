<?php
	/*
	Template Name: Child Blog
	*/
	
	get_header();
	the_post();
	the_content(); 
	echo '<div class="clear"></div>';
	get_template_part('loop/loop','childpagesalt');
	get_footer();