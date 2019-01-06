<?php 
	get_header(); 
	the_post();
?>

<div class="pcw">

<?php	
	( is_active_sidebar('primary') && get_post_meta( $post->ID, '_cmb_disable_sidebar', true ) !=='on' ) ? get_template_part('content/content','sidebar') : get_template_part('content/content','nosidebar');
?>

</div>

<?php	  
	get_footer();