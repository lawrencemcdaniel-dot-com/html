<?php 

	$ebor_pages = get_pages( 
		array( 'child_of' => $post->ID,
		   'sort_column' => 'menu_order',
		   'sort_order' => 'asc' 
		)
	);
	
	foreach( $ebor_pages as $index => $page ) : 
	$index = $index + 1;
	
	if( get_post_meta( $page->ID, '_wp_page_template', true ) == 'page_onepage_child_fullwidth.php' ) : 
?>
		
		<section id="<?php echo sanitize_title($page->post_title); ?>" class="<?php if($index % 2 == 0) echo 'dark-wrapper'; ?>">
				
				<?php	
					$ebor_content = $page->post_content;
					$ebor_content = apply_filters( 'the_content', $ebor_content );
					echo $ebor_content;
				?>
				
				<div class="clear"></div>
			
		</section>

<?php 
	else :
?>

		<section id="<?php echo sanitize_title($page->post_title); ?>" class="<?php if($index % 2 == 0) echo 'dark-wrapper'; ?>">
			<div class="container inner">
				
				<?php	
					$ebor_content = $page->post_content;
					$ebor_content = apply_filters( 'the_content', $ebor_content );
					echo $ebor_content;
				?>
				
				<div class="clear"></div>
			
			</div>	
		</section>

<?php
	endif;
	
	endforeach;