<div class="full-portfolio">

	<ul class="items">
	    
	    <?php 
	    	if ( have_posts() ) : while ( have_posts() ) : the_post(); 
	    	global $product;
	    ?>
	    
	      <li <?php post_class( 'item overlay thumb' ); ?>>
	          <a href="<?php the_permalink(); ?>">
	          	<?php the_post_thumbnail('portfolio-index'); ?>
	          	<div>
	          		<h5>
	      	    		<?php 
	      	    			the_title();
	      	    			if ( $price_html = $product->get_price_html() )
	      	    				echo $price_html;
	      	    		?>
	          		</h5>
	          	</div>
	          </a>
	      </li>
	      
	    <?php endwhile; else: ?>
	      
	      	<p><?php _e('Sorry, no posts matched your criteria.','marble'); ?></p>
	      
	    <?php endif; ?>
	
	</ul>
	
	<?php ebor_load_more_shop(); ?>

</div>