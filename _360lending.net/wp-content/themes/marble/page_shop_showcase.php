<?php
	/*
	Template Name: Shop Showcase
	*/
	get_header('shop');
?>

<div class="full-portfolio">

	<ul class="items">
	    
	    <?php 
	    	$shop_query = new WP_Query('post_type=product&posts_per_page=' . get_option('portfolio_posts_per_page','20') . '&paged=' . $paged);
	    	if ( $shop_query->have_posts() ) : while ( $shop_query->have_posts() ) : $shop_query->the_post(); 
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
	
	<?php wp_reset_query(); ?>

</div>

<?php
	get_footer('shop');