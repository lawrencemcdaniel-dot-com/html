<?php get_header();?>
<?php $page_layout 	= dttheme_option('specialty','archives-layout');
  	  $page_layout 	= !empty($page_layout) ? $page_layout : "content-full-width";
	  
	  $post_layout 	= dttheme_option('specialty','archives-post-layout'); 
	  $post_layout 	= !empty($post_layout) ? $post_layout : "one-column";
	  
	  $show_sidebar = false;
	  $sidebar_class = "";
	  $post_class = "";
	  $columns = NULL;
	  
	#TO SET PAGE LAYOUT
	switch($page_layout):
		case 'with-left-sidebar':
			$page_class = $page_layout;
			$show_sidebar = true;
			$sidebar_class = "left-sidebar";
			$page_layout .= " with-sidebar ";
		break;

		case 'with-right-sidebar':
			$show_sidebar = true;
			$sidebar_class = "right-sidebar";
			$page_layout .= " with-sidebar ";
		break;
	endswitch;
	
	#TO SET POST LAYOUT
	switch($post_layout):
		case 'one-column':
			$post_class = $show_sidebar ? " portfolio column dt-sc-one-column with-sidebar " : " portfolio column dt-sc-one-column ";
			$image_size = $show_sidebar ? "dt-portfolio-large-with-sidebar" : "dt-portfolio-large";
		break;
		
		case 'one-half-column';
			$post_class = $show_sidebar ? " portfolio column dt-sc-one-half with-sidebar " : " portfolio column dt-sc-one-half ";
			$image_size = $show_sidebar ? "dt-portfolio-small" : "dt-portfolio-medium";
			$columns = 2;
		break;
		
		case 'one-third-column':
			$post_class = $show_sidebar ? " portfolio column dt-sc-one-third with-sidebar " : " portfolio column dt-sc-one-third ";
			$image_size = "dt-portfolio-small";
			$columns = 3;
		break;
	endswitch;?>
    
      <!-- **Primary Section** -->
      <section id="primary" class="gallery <?php echo esc_attr( $page_layout );?>">
<?php	if( have_posts() ):
			$i = 1;
			while( have_posts() ):
				the_post();
				$the_id = get_the_ID();
				
				$portfolio_item_meta = get_post_meta($the_id,'_portfolio_settings',TRUE);
				$portfolio_item_meta = is_array($portfolio_item_meta) ? $portfolio_item_meta  : array();

				$items_id_exists = false;
				if(  array_key_exists('items_id',$portfolio_item_meta) ){
					$items_id_exists =  array_filter($portfolio_item_meta['items_id']);
					$items_id_exists = !empty( $items_id_exists ) ? true : false;
				}
				
				
				$temp_class = "";
				if($i == 1) $temp_class = $post_class." first"; else $temp_class = $post_class;
				if($i == $columns) $i = 1; else $i = $i + 1;?>
				
				<!-- Portfolio Item -->
				<div id="portfolio-<?php echo esc_attr($the_id);?>" class="<?php echo esc_attr( $temp_class );?>">
					<div class="portfolio-thumb"><?php
						if( has_post_thumbnail() ):
							the_post_thumbnail($image_size);
							$id = get_post_thumbnail_id($the_id);
							$popup = wp_get_attachment_url( $id , 'full',true);
						elseif( array_key_exists("items_name",$portfolio_item_meta) ):
							$item =  $portfolio_item_meta['items_name'][0];
							$popup = $portfolio_item_meta['items'][0];
							
							if( "video" === $item ) {
								$items = array_diff( $portfolio_item_meta['items_name'] , array("video") );
								if( !empty($items) ) {
									if( $items_id_exists ) {
										$id = $portfolio_item_meta['items_id'][key($items)];
										$img = wp_get_attachment_image_src($id,$image_size);
										echo "<li><img src='". esc_url($img[0])."' width='".esc_attr($img[1])."' height='".esc_attr($img[2])."' alt=''/></li>";
									 } else {
										echo "<img src='".esc_url( $portfolio_item_meta['items'][key($items)] )."' width='1060' height='795' alt='' />";
									 }
								} else {
									$popup = "http://placehold.it/1060x713&text=Add%20Image%20%20Portfolio";
									echo "<img src='".esc_url($popup)."'/>"; 
								}
							} else {
								if( $items_id_exists ) {
									$id = $portfolio_item_meta['items_id'][0];
									$img = wp_get_attachment_image_src($id,$image_size);
									echo "<li><img src='". esc_url($img[0])."' width='".esc_attr($img[1])."' height='".esc_attr($img[2])."' alt=''/></li>";
								} else {
									echo "<img src='".esc_url( $portfolio_item_meta['items'][0] )."' width='1060' height='795' alt=''/>";
								}
							}
						else:
							$popup = "http://placehold.it/1060x713&text=Add%20Image%20%20Portfolio";
							echo "<img src='".esc_url( $popup )."'/>"; 
						endif;?>
						<div class="image-overlay">
							<a href="<?php esc_url( $popup );?>" data-gal="prettyPhoto[gallery]" title="" class="zoom"> <span class="fa fa-arrows-alt"></span> </a>
							<a href="<?php the_permalink();?>" title="<?php printf( esc_attr__('%s'), the_title_attribute('echo=0'));?>" class="link">
                            	<span class="fa fa-external-link"> </span> </a>
						</div>
					  </div>
					  
					  <div class="portfolio-detail"><?php
						if(dttheme_is_plugin_active('roses-like-this/likethis.php')): ?>
							<div class="views">
								<i class="fa fa-heart"> </i><?php printLikes($post->ID); ?> </div><?php
						endif;?>
						
						<h5><a href="<?php the_permalink();?>" title="<?php printf( esc_attr__('%s'), the_title_attribute('echo=0'));?>"><?php the_title();?></a></h5>
						<?php if( array_key_exists("sub-title",$portfolio_item_meta) ):
								$subtitle = esc_html( $portfolio_settings['sub-title'] );
								echo "<p>{$subtitle}</p>";
							   endif;?>
					   </div>                
				</div><!-- Portfolio Item End-->
<?php		endwhile;
		endif;?>
                   
           <!-- **Pagination** -->
           <div class="pagination">
                <div class="prev-post"><?php previous_posts_link('<span class="fa fa-angle-double-left"></span> Prev');?></div>
                <?php echo dttheme_pagination();?>
                <div class="next-post"><?php next_posts_link('Next <span class="fa fa-angle-double-right"></span>');?></div>
           </div><!-- **Pagination - End** -->
      
      </section><!-- **Primary Section** -->
        
<?php if($show_sidebar): ?>
	  <!-- **Secondary Section ** -->
      <section id="secondary" class="<?php echo esc_attr( $sidebar_class ); ?>">
<?php 	get_sidebar();?>      
      </section><!-- **Secondary Section - End** -->
<?php endif; ?>
          
<?php get_footer();?>