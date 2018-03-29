<?php 

$i = 0;

$ebor_pages = get_pages( 
	array( 'child_of' => $post->ID,
		   'sort_column' => 'menu_order',
		   'sort_order' => 'asc' 
	)
);

foreach( $ebor_pages as $page ){
	
	if( get_post_meta( $page->ID, '_wp_page_template', true ) == 'page_onepage_child_fullwidth.php' ){ 
	$i++;
?>
			
		<section id="<?php echo sanitize_title($page->post_title); ?>" class="<?php if($i % 2 == 0) echo 'dark-wrapper'; ?>">
				
				<?php	
					$ebor_content = $page->post_content;
					$ebor_content = apply_filters( 'the_content', $ebor_content );
					echo $ebor_content;
				?>
				
				<div class="clear"></div>
			
		</section>

<?php } elseif( get_post_meta( $page->ID, '_wp_page_template', true ) == 'page_sidebar.php' ){
	
	$i++; 
		if( $i % 2 == 0 ) echo '<div class="dark-wrapper">';
	
			do_action('ebor_open_wrapper');
		?>
		
			<div class="row blog">
			
			  <div class="span8 posts">
			    <div <?php post_class(); ?>>
			    
			      <?php 
			      	$ebor_content = $page->post_content;
			      	$ebor_content = apply_filters( 'the_content', $ebor_content );
			      	echo $ebor_content;
			      ?>
			      
			    </div>
			    
			  </div>
			  
			  <?php get_sidebar('page'); ?>
			  
			</div>

		<?php
			do_action('ebor_close_wrapper');
		
		if( $i % 2 == 0 ) echo '</div>';
		
} elseif( get_post_meta( $page->ID, '_wp_page_template', true ) == 'page_child_blog.php' ){
		
		get_template_part('loop/loop','childpageblog');
		
	} else {
		$i++; 
		if( $i % 2 == 0 ) echo '<div class="dark-wrapper">';
	
			do_action('ebor_open_wrapper');
				
				$ebor_content = $page->post_content;
				$ebor_content = apply_filters( 'the_content', $ebor_content );
				echo $ebor_content;
				
			do_action('ebor_close_wrapper');
		
		if( $i % 2 == 0 ) echo '</div>';
	}

}