<?php 
	$i=0; 
	while( $i < 5 ) :
		$i++;
		if ( get_post_meta( $post->ID, "_cmb_the_video_$i", true ) ) : 
?>

			<figure class="media-wrapper portfolio player">
			  <?php echo wp_oembed_get( get_post_meta( $post->ID, "_cmb_the_video_$i", true ) ); ?>
			</figure>
			
<?php 
		endif;
	endwhile;
