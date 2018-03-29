<?php get_header();
	  $portfolio_settings = get_post_meta ( $post->ID, '_portfolio_settings', TRUE );
	  $portfolio_settings = is_array ( $portfolio_settings ) ? $portfolio_settings : array ();
	  
	  $layout = isset( $portfolio_settings['layout'] ) ? $portfolio_settings['layout'] : 'single-portfloio-layout-one';
	  $container_start =  $container_middle =  $container_end = "";
	  $show_dummy_image = true;
	  if( $layout === "single-portfloio-layout-two" ) {
		  $container_start	 =	'<div class="column dt-sc-two-third first">';
		  $container_middle	 =	'</div>';
		  $container_middle  .=	'<div class="column dt-sc-one-third last">'; 
		  $container_end	 =	'</div>';
		  
	  }elseif( $layout === "single-portfloio-layout-three" ){
		  $container_start	 =	'<div class="column dt-sc-two-third right-gallery first">';
		  $container_middle	 =	'</div>';
		  $container_middle  .=	'<div class="column dt-sc-one-third last">'; 
		  $container_end	 =	'</div>';
	  }?>
      <!-- **Primary Section** -->
      <section id="primary" class="content-full-width"><?php
	  	if( have_posts() ):
			while( have_posts() ):
				the_post();?>
                <!-- #post-<?php the_ID()?> starts -->
                <article id="post-<?php the_ID(); ?>" <?php post_class('portfolio-single'); ?>><?php 
				echo $container_start; ?>
                	<ul class="portfolio-slider"><?php
						if( has_post_thumbnail() ):
							$show_dummy_image = false;
							$id = get_post_thumbnail_id($post->ID);
							$image = wp_get_attachment_url( $id , 'full',true);
							echo "<li> <img src='".esc_url($image)."' alt='' title='' /></li>";
						endif;
						
						if( array_key_exists("items_name",$portfolio_settings) ) {
							$show_dummy_image = false;
							foreach( $portfolio_settings["items_name"] as $key => $item ){
								$current_item = $portfolio_settings["items"][$key];
								
								if( "video" === $item ) {
									$width = 1060;
									$height = 800; 	
									
									if ( $layout === "single-portfloio-layout-two"):
										$width = 700;
										$height = 528;
									endif;
									
									if ( strpos($current_item,"vimeo") ) : #For Vimeo
										$url = substr( strrchr($current_item,"/"),1);
										$url = "http://player.vimeo.com/video/".$url;
										echo "<li><iframe src='".esc_url($url)."' width='".esc_attr($width)."' height='".esc_attr($height)."' frameborder='0'></iframe></li>";
										
									elseif( strpos($current_item,"?v=") ): #For Youtube
										$url = substr( strrchr($current_item,"="),1);
										$url = 'http://www.youtube.com/embed/'.$url.'?wmode=opaque';

										echo "<li><iframe src='".esc_url($url)."' width='".esc_attr($width)."' height='".esc_attr($height)."' frameborder='0'></iframe></li>";
									endif;
								} else {
									echo "<li> <img src='".esc_url($current_item)."' alt='' title='' /></li>";
								}
							}
						}
						
						if( $show_dummy_image ) 
							echo "<li> <img src='http://placehold.it/1060x713&text=Portfolio' alt='' title=''/></li>";?></ul>
          <?php echo $container_middle;
		  
		  		the_title( '<h3>', '</h3>' );
				
				if( array_key_exists("sub-title",$portfolio_settings) ):
					$subtitle = esc_html( $portfolio_settings['sub-title'] );
					echo "<h6>{$subtitle}</h6>";
				endif;
				
				the_terms($post->ID,'portfolio_entries','<p class="tags"> <span class="fa fa-tags"> </span> ',', ','</p>');
				
				the_content();
				
				if(array_key_exists("show-social-share",$portfolio_settings)):
					echo '<div class="portfolio-share">';
					dttheme_social_bookmarks('sb-portfolio');
					echo '</div>';
				endif;
				
				edit_post_link( __( 'Edit','dt_themes'));
				
				echo $container_end; ?>
                
                <!-- **Post Nav** -->
                <div class="post-nav-container">
                	<div class="post-prev-link"><?php previous_post_link('%link','<i class="fa fa-arrow-circle-left"> </i> %title<span> ('.__('Prev Entry','dt_themes').')</span>');?> </div>
                    <div class="post-next-link"><?php next_post_link('%link','<span> ('.__('Next Entry','dt_themes').')</span> %title <i class="fa fa-arrow-circle-right"> </i>');?></div>
                </div><!-- **Post Nav - End** -->
                
          </article><!-- #post-<?php the_ID()?> Ends -->
     <?php  endwhile;
		endif;?>
     <?php if(array_key_exists("show-related-items",$portfolio_settings)): ?>
     <!-- Related Posts Start-->
     	<div class="clear"> </div>
	    <div class="dt-sc-hr-invisible"> </div>
    	<h3><?php esc_html_e('Related Projects','dt_themes');?></h3><?php 
			$category_ids = array();
			
			$input  = wp_get_object_terms( $post->ID, 'portfolio_entries');
			
			foreach($input as $category) $category_ids[] = $category->term_id;
			
			$args = array(	'orderby' => 'rand',
					'showposts' => '3' ,
					'post__not_in' => array($post->ID),
					'tax_query' => array( array( 'taxonomy'=>'portfolio_entries', 'field'=>'id', 'operator'=>'IN', 'terms'=>$category_ids )));
					
			query_posts($args);
			if( have_posts() ):
				$count = 1;
				while( have_posts() ):
					the_post();
					$the_id = get_the_ID();
					
					$portfolio_item_meta = get_post_meta($the_id,'_portfolio_settings',TRUE);
					$portfolio_item_meta = is_array($portfolio_item_meta) ? $portfolio_item_meta  : array();
					
					$first = ( $count === 1 ) ? " first" : "";?>
                    <div class="portfolio column dt-sc-one-third <?php echo $first;?>">
						<div class="portfolio-thumb"><?php
					
						if( array_key_exists("items_name",$portfolio_item_meta) ):
							$item =  $portfolio_item_meta['items_name'][0];
							$image = $popup = "";	
							
							if( "video" === $item ):
								$image = "http://placehold.it/1060x713&text=Video%20Portfolio";
								$popup = $portfolio_item_meta['items'][0];
							else:
								$image = $popup = $portfolio_item_meta['items'][0];
							endif;
							
						else:
							$image = "http://placehold.it/1060x713&text=Add%20Image%20/%20Video%20%20to%20Portfolio";
						endif;?>
                        
                        	<img src="<?php echo esc_url( $image );?>" title="<?php printf( esc_attr__('%s'), the_title_attribute('echo=0'));?>" alt="<?php printf( esc_attr__('%s'), the_title_attribute('echo=0'));?>"/>
                            
                            <div class="image-overlay">
                            	<a href="<?php echo esc_url( $popup );?>" data-gal="prettyPhoto[gallery]" title="" class="zoom"> <span class="fa fa-arrows-alt"></span> </a>
                                <a href="<?php the_permalink();?>" title="<?php printf( esc_attr__('%s'), the_title_attribute('echo=0'));?>" class="link">  <span class="fa fa-external-link"> </span> </a>
                            </div>
                       </div> <!-- . portfolio-image -->
                       
                       <div class="portfolio-detail"><?php
					   	if(dttheme_is_plugin_active('roses-like-this/likethis.php')): ?>
                        	<div class="views">
                            	<i class="fa fa-heart"> </i><?php printLikes($post->ID); ?> </div><?php
						endif;?>
                        
                        <h5><a href="<?php the_permalink();?>" title="<?php printf( esc_attr__('%s'), the_title_attribute('echo=0'));?>"><?php the_title();?></a></h5><?php
							if( array_key_exists("sub-title",$portfolio_item_meta) ):
								$subtitle = esc_html( $portfolio_settings['sub-title'] );
								echo "<p>{$subtitle}</p>";
							endif;?>
                       </div><!-- .Portfolio-details -->
                    </div>
<?php 			$count++;
				endwhile;
			endif;?>
     <!-- Related Posts End-->
     <?php endif;?>   
        </section><!-- **Primary Section** -->
<?php get_footer();?>