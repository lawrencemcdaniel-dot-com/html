<?php get_header();

	$page_layout  = dttheme_option( 'specialty', 'category-archives-layout' );
	$page_layout  = !empty( $page_layout ) ? $page_layout : "content-full-width";
	$post_layout = dttheme_option( 'specialty', 'category-archives-post-layout' );
	$post_layout  = !empty( $post_layout ) ? $post_layout : "one-column";
	
	$show_sidebar = false;
	$sidebar_class = "";
	$post_class = "";
	$columns = NULL;
	$image_size = "";
	  
	#TO SET PAGE LAYOUT
	switch($page_layout):
		case 'with-left-sidebar':
			$page_class = $page_layout;
			$show_sidebar = true;
			$sidebar_class = "with-sidebar left-sidebar";
		break;

		case 'with-right-sidebar':
			$show_sidebar = true;
			$sidebar_class = "with-sidebar right-sidebar";
		break;
	endswitch;
	
	#TO SET POST LAYOUT
	switch($post_layout):
		case 'one-column':
			$post_class = " column dt-sc-one-column ";
			$image_size = $show_sidebar ? "dt-blog-one-column-with-sidebar" : "dt-blog-one-column";
		break;
		
		case 'one-half-column';
			$post_class = " column dt-sc-one-half";
			$image_size = $show_sidebar ? "dt-blog" : "dt-blog-two-column";
			$columns = 2;
		break;
		
		case 'one-third-column':
			$post_class = " column dt-sc-one-third ";
			$columns = 3;
			$image_size = "dt-blog";
		break;
	endswitch;?>
      <!-- **Primary Section** -->
      <section id="primary" class="<?php echo esc_attr($page_layout);?>"><?php	
      	if( have_posts() ):
			$i = 1;
			while( have_posts() ):
				the_post();
				
				$temp_class = "";
				if($i == 1) $temp_class = $post_class." first"; else $temp_class = $post_class;
				if($i == $columns) $i = 1; else $i = $i + 1;

				$post_meta = get_post_meta(get_the_id() ,'_dt_post_settings',TRUE);
				$post_meta = is_array($post_meta) ? $post_meta : array();
				
				$format = get_post_format(get_the_id());?>
				
                
                <div class="<?php echo esc_attr( $temp_class );?>">
                	<!-- #post-<?php the_ID()?> starts -->
                    <article id="post-<?php the_ID(); ?>" <?php post_class('blog-entry'); ?>>
                    	<!-- .blog-entry-inner -->
                        <div class="blog-entry-inner">
                        
                        	<!-- .entry-meta -->
                            <div class="entry-meta">
                            	<a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>" class="entry_format"> </a>
                                
                                <div class="date">
                                	<p> <?php echo get_the_date('M').' '.get_the_date('d');?> <span> <?php echo get_the_date('Y'); ?> </span> </p>
                                </div>
                                
                                <?php comments_popup_link(
										__('<span class="fa fa-comments"> </span> 0','dt_themes'),
										__('<span class="fa fa-comments"> </span> 1','dt_themes'),
										' <span class="fa fa-comments"> </span> % ',"comments" ,__('<span class="fa fa-comments-o"> </span>','dt_themes'));?>
                            </div><!-- .entry-meta -->

                            <!-- .entry-thumb -->
                            <div class="entry-thumb"><?php
								#Image Format
								if( $format === "image" || empty($format) ):?>
									<a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>"><?php
									if( has_post_thumbnail() ):
										the_post_thumbnail($image_size);
									else:?>
										<img src="//placehold.it/1060x636&text=Image" alt="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>" 
											 title="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>" /><?php
									endif;?></a><?php
									
								#Gallery Format	
								elseif( $format === "gallery" ):
									
									echo "<ul class='entry-gallery-post-slider'>";
									if( has_post_thumbnail() ):
										$id = get_post_thumbnail_id($post->ID);
										$img = wp_get_attachment_image_src($id,$image_size);
										echo "<li><img src='".esc_url($img[0])."' width='".esc_attr($img[1])."' height='".esc_attr($img[2])."' alt='' /></li>";
									endif;
									
									if( array_key_exists("items", $post_meta) ):
										$items_id_exists = array_key_exists('items_id',$post_meta) ? true : false;
										foreach ( $post_meta['items'] as $k => $item ) { 
											if( $items_id_exists ) {
												$id = $post_meta['items_id'][$k];
												$img = wp_get_attachment_image_src($id,$image_size);
												echo "<li><img src='".esc_url($img[0])."' width='".esc_attr($img[1])."' height='".esc_attr($img[2])."' alt='' /></li>";
											} else {
												echo "<li><img src='".esc_attr($item)."'/></li>";
											}
										}
									endif;
									echo "</ul>";
									
								#Video Format
								elseif( $format == "video" ):
									if( array_key_exists('oembed-url', $post_meta) || array_key_exists('self-hosted-url', $post_meta) ):
										if( array_key_exists('oembed-url', $post_meta) ):
											echo "<div class='dt-video-wrap'>".wp_oembed_get($post_meta['oembed-url']).'</div>';
										elseif( array_key_exists('self-hosted-url', $post_meta) ):
											echo "<div class='dt-video-wrap'>".apply_filters( 'the_content', $post_meta['self-hosted-url'] ).'</div>';
										endif;
									endif;
									
								#Audio Format
								elseif( $format == "video" ):
									if( array_key_exists('oembed-url', $post_meta) || array_key_exists('self-hosted-url', $post_meta) ):
										if( array_key_exists('oembed-url', $post_meta) ):
											echo wp_oembed_get($post_meta['oembed-url']);
										elseif( array_key_exists('self-hosted-url', $post_meta) ):
											echo apply_filters( 'the_content', $post_meta['self-hosted-url'] );
										endif;
									endif;
								else:?>
									<a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>"><?php
										if( has_post_thumbnail() ):
											the_post_thumbnail($image_size);
										else:?>
											<img src="//placehold.it/1060x636&text=Image" alt="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>" 
												title="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>" /><?php
										endif;?></a><?php
								endif;?>
                            </div><!-- .entry-thumb -->
                            
                            <!-- .entry-details -->
                            <div class="entry-details">
                            	<?php if(is_sticky()): ?>
                                		<div class="featured-post"> <span class="fa fa-trophy"> </span> <?php _e('Featured','dt_themes');?></div>
                                <?php endif;?>
                                
                                <!-- .entry-title -->
                                <div class="entry-title">
                                	<h4><a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>"><?php the_title();?></a></h4>
                                </div><!-- .entry-title -->
                                
                                <div class="entry-metadata">
                                	<p class="author">
                                    	<span class='fa fa-user'> </span>
                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" title="<?php _e('View all posts by ','dt_themes').get_the_author();?>">
										<?php echo get_the_author();?></a>
                                        <?php the_tags("<p class='tags'><span class='fa fa-tags'> </span> ",', ','</p>');?>
                                        <p class="categories"><span class='fa fa-folder-open'> </span><?php the_category(', '); ?></p>
                                    </p>
                                </div><!-- .entry-metadata -->
                                
                                <div class="entry-body"><?php echo dttheme_excerpt(15);?></div>
                                
                                <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('%s'), the_title_attribute('echo=0'));?>" class="dt-sc-button small read-more">
	                                             	<?php _e('Read More','dt_themes');?> <span class="fa fa-angle-double-right"> </span></a>
                                
                            
                            </div><!-- .entry-details -->
                            
                        </div><!-- .blog-entry-inner -->
                    </article><!-- #post-<?php the_ID()?> Ends -->
                </div>
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
      <section id="secondary" class="<?php echo esc_attr($sidebar_class); ?>">
<?php 	get_sidebar();?>      
      </section><!-- **Secondary Section - End** -->
<?php endif; ?>
          
<?php get_footer();?>