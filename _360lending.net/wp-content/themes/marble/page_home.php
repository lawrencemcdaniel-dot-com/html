<?php
	/*
	Template Name: Homepage Full-Width
	*/
	get_header();
	the_post();
	the_content(); 
?>

	<div class="clear"></div>
	
<?php
	get_template_part('loop/loop','childpagesalt');
	get_footer();