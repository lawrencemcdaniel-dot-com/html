<?php if( get_option('show_filters', '0') == 1 ) : ?>

	<div class="fix-portfolio ebor-showcase-filters">
		 <?php 
		 	do_action('ebor_open_wrapper');
			do_action('ebor_portfolio_filters'); 
			do_action('ebor_close_wrapper');
		 ?>
	</div>

<?php endif; ?>

<div class="full-portfolio">

	<ul class="items">
	    
	    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	    
	      <?php get_template_part('content/content','showcaselightbox'); ?>
	      
	    <?php 
	    	endwhile; 
	    	else: 
	    ?>
	      
	      	<p><?php _e('Sorry, no posts matched your criteria.','marble'); ?></p>
	      
	    <?php endif; ?>
	
	</ul>
	
	<?php ebor_load_more(); ?>

</div>