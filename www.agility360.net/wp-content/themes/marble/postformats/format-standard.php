<?php 
	if( has_post_thumbnail() ) :
		if( is_single() ) : 
?>

		<figure class="overlay media-wrapper cap-icon more">
				<?php the_post_thumbnail('index-large'); ?>
		</figure>
		
	<?php 
		else : 
	?>
	
		<figure class="overlay media-wrapper cap-icon more">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('index-large'); ?>
				<div></div>
			</a>
		</figure>
		
<?php 
		endif;
	endif;