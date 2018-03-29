<?php $url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');  ?>

<li <?php post_class( 'item overlay thumb ' . ebor_the_isotope_terms() ); ?>>
    <a href="<?php echo $url[0]; ?>" class="view" rel="lightbox" title="<?php the_title(); ?>">
    	<?php the_post_thumbnail('portfolio-index'); ?>
    	<div>
    		<h5>
	    		<?php 
	    			the_title();
	    			
	    			if( get_option('portfolio_index_categories','1') == 1) 
	    				echo '<span>' . ebor_the_simple_terms() . '</span>'; 
	    				
	    			if( get_option('preview_name','0') == 1 )
	    				echo '<span>' . get_post_meta( $post->ID, '_cmb_the_client', true ) . '</span>';
	    		?>
    		</h5>
    	</div>
    </a>
</li>