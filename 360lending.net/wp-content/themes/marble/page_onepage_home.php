<?php
	/*
	Template Name: Single Pager - Home
	*/
	get_header();
	the_post();
?>

<div id="home">
	<?php
		the_content(); 
	?>
	<div class="clear"></div>
</div>
	
<?php
	get_template_part('loop/loop','childpagessingle');
	get_footer();