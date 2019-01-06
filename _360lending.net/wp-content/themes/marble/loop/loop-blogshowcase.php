<?php 
	$cat = false;
	
	if( is_archive() )
		$cat = get_queried_object()
?>

<div class="full-portfolio">

	<ul class="items">
	    
	    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	    
	      <li <?php post_class( 'item overlay thumb ' . ebor_the_isotope_terms() ); ?>>
	          <a href="<?php the_permalink(); ?>">
	          	<?php the_post_thumbnail('portfolio-index'); ?>
	          	<div><h5><?php the_title(); ?></h5></div>
	          </a>
	      </li>
	      
	    <?php 
	    	endwhile; 
	    	else:
	    	
	    		get_template_part('loop/loop','none');
	    		
	    	endif; 
	    ?>
	
	</ul>
	
	<?php ebor_blog_load_more('', 2, $cat); ?>

</div>