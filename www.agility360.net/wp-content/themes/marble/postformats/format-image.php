<?php 
	$images = array(
		get_post_meta( $post->ID, '_cmb_image1', true ), 
		get_post_meta( $post->ID, '_cmb_image2', true ),
		get_post_meta( $post->ID, '_cmb_image3', true ), 
		get_post_meta( $post->ID, '_cmb_image4', true ),
		get_post_meta( $post->ID, '_cmb_image5', true ), 
		get_post_meta( $post->ID, '_cmb_image6', true ),
		get_post_meta( $post->ID, '_cmb_image7', true ), 
		get_post_meta( $post->ID, '_cmb_image8', true ),
		get_post_meta( $post->ID, '_cmb_image9', true ), 
		get_post_meta( $post->ID, '_cmb_image10', true )
	); 
	
	$images = array_filter(array_map(NULL, $images));
	
	if( get_post_type() == 'post' ) : 
	
		if(!( isset($images[1]) )) :
	?>
	
			<figure class="overlay media-wrapper cap-icon enlarge">
			    <a href="<?php echo $images[0]; ?>" class="view" rel="<?php the_ID(); ?>-gallery-post" title="<?php the_title(); ?>">
				    <img src="<?php echo $images[0]; ?>" alt="<?php the_title(); echo '-1'; ?>" />
				    <div></div>
			    </a>
			</figure>
			
	<?php	
		else :
	?>
		<div class="format-gallery">
			<div class="gallery-wrapper">
			    <div class="gallery">
			    
				    <?php 
				    	foreach ($images as $index => $image ) : 
				    	
					    	$resized = aq_resize($image, 440, 330, 1);
				    ?>
				    
				    	<div class="item">
				    	  <figure class="overlay media-wrapper cap-icon enlarge">
				    	      <a href="<?php echo $image; ?>" class="view" rel="<?php the_ID(); ?>-gallery-post" title="<?php the_title(); ?>">
				    		        <img src="<?php echo $resized; ?>" alt="<?php the_title(); echo '-' . $index; ?>" width="440" height="330" />
				    		        <div></div>
				    	      </a>
				    	  </figure>
				    	</div>
				    	
				    <?php 
				    	endforeach; 
				    ?>
		
			    </div>
			</div>
		</div>
	<?php 
		endif;
	
	else :

		foreach ($images as $index => $image ) : 
?>
		
		<figure class="media-wrapper portfolio">
			<img src="<?php echo $image; ?>" alt="<?php the_title(); echo '-' . $index; ?>" />
		</figure>
		
<?php 
	endforeach;
	endif;