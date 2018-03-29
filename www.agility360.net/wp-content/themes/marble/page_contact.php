<?php
	/*
	Template Name: Contact
	*/
	get_header(); 
	the_post(); 
	
	if( get_post_meta( $post->ID, '_cmb_map_address', true ) ) echo'<div class="map"></div>'; 
?>
  
  <div class="container inner">
    
    <?php the_content(); ?>
    
  </div>
  
<?php 
	if( get_post_meta( $post->ID, '_cmb_map_address', true ) ) : 
?>
		<script type="text/javascript">
			/*-----------------------------------------------------------------------------------*/
			/*	MAP
			/*-----------------------------------------------------------------------------------*/
			jQuery(document).ready(function($){
			'use strict';
			
				<?php $url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); $url = $url[0]; ?>
				jQuery('.map').goMap({ address: '<?php echo get_post_meta( $post->ID, '_cmb_map_address', true ); ?>',
				  zoom: 14,
				  mapTypeControl: false,
			      draggable: false,
			      scrollwheel: false,
			      streetViewControl: false,
			      maptype: 'ROADMAP',
		    	  markers: [
		    		{ 'address' : '<?php echo get_post_meta( $post->ID, '_cmb_map_address', true ); ?>' }
		    	  ],
				  icon: '<?php echo $url; ?>', 
					  addMarker: false
			});
			
			});
		</script>
<?php 
	endif; 
	
	get_footer();