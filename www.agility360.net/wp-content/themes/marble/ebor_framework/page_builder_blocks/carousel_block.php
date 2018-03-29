<?php

class AQ_Carousel_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Carousel',
			'size' => 'span12',
			//'resizable' => 0,
		);
		
		//create the block
		parent::__construct('aq_carousel_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'type' => 'grid',
			'post_type' => 'portfolio',
			'filter' => 'all',
			'blog_filter' => 'all',
			'lightbox' => 0
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		$args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'portfolio-category'
			); 
			
		$filter_options = get_categories( $args );
		
		$blog_args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'category'
			); 
			
		$blog_filter_options = get_categories( $blog_args );
		
		$post_type_options = array(
			'portfolio' => 'Portfolio',
			'post' => 'Blog'
		);
		
	?>
		
		<p class="description note">
			<?php _e('Use this block to add a carousel of posts to your page.', 'marble') ?>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title (optional)
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description fourth">
			<label for="<?php echo $this->get_field_id('post_type') ?>">
				Choose a Post Type<br/>
				<?php echo aq_field_select('post_type', $block_id, $post_type_options, $post_type, $block_id); ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('lightbox') ?>">
				Disable Lightbox? (Only used for Portfolio)<br/>
				<?php echo aq_field_checkbox('lightbox', $block_id, $lightbox) ?>
			</label>
		</p>
		
		<div class="cf"></div>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('filter') ?>">
				<?php _e('Show a specific portfolio category? ONLY USED IF PORTFOLIO POST TYPE IS CHOSEN', 'marble'); ?><br/>
				<?php echo ebor_portfolio_field_select('filter', $block_id, $filter_options, $filter) ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('blog_filter') ?>">
				<?php _e('Show a specific blog category? ONLY USED IF BLOG POST TYPE IS CHOSEN', 'marble'); ?><br/>
				<?php echo ebor_portfolio_field_select('blog_filter', $block_id, $blog_filter_options, $blog_filter) ?>
			</label>
		</p>

		<?php
	}
	
	function block($instance) {
		extract($instance);
		
		(isset($filter)) ? '' : $filter = 'all';
		(isset($blog_filter)) ? '' : $blog_filter = 'all';
		(isset($lightbox)) ? '' : $lightbox = 0;
		
		$unique = wp_rand(0,10000);
		
		$portfolio_query = new WP_Query('post_type='.$post_type.'&posts_per_page=6');
		
		if ( $post_type == 'portfolio' && !($filter == 'all') ) {
			$portfolio_query = '';
			$portfolio_query = new WP_Query( 
				array( 
					'post_type' => 'portfolio', 'posts_per_page' => 6, 'tax_query' => array(
						array(
							'taxonomy' => 'portfolio-category',
							'field' => 'id',
							'terms' => $filter
						)
					) 
				) 
			);
		} elseif ( $post_type == 'post' && !($blog_filter == 'all') ) {
			$portfolio_query = '';
			$portfolio_query = new WP_Query( 
				array( 
					'post_type' => 'post', 'posts_per_page' => 6, 'tax_query' => array(
						array(
							'taxonomy' => 'category',
							'field' => 'id',
							'terms' => $blog_filter
						)
					) 
				) 
			);
		}
		
		if($title) echo '<h4 class="section-title">'.$title.'</h4>'; 
	?>
		
		<div class="showbiz-container posts" id="carousel_<?php echo $unique; ?>">
		
		  <div class="showbiz-navigation"> 
		  	<a id="showbiz_left_<?php echo $unique; ?>" class="sb-navigation-left btn"></a> 
		  	<a id="showbiz_right_<?php echo $unique; ?>" class="sb-navigation-right btn rm0"></a>
		    <div class="sbclear"></div>
		  </div>
		  
		  <div class="showbiz portfolio" data-left="#showbiz_left_<?php echo $unique; ?>" data-right="#showbiz_right_<?php echo $unique; ?>">
		    <div class="overflowholder">
		      <ul>
		      
		      <?php 
		      	if ( $portfolio_query->have_posts() ) : while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post(); 
		      	global $post;
		      	
		      	$url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
		      ?>
		      
		      <?php 
		      	/**
		      	 * If post type is portfolio
		      	 */
		      	if( $post_type == 'portfolio' ) : 
		      ?>
		      
		        <li class="post">
		          <div class="mediaholder">
		            	
		            	<?php if( $lightbox == 0 ) : ?>	
		            		<div class="mediaholder_innerwrap overlay cap-icon enlarge">
		            		<a href="<?php echo $url[0]; ?>" class="view" data-rel="lightbox" title="<?php the_title(); ?>">
		            	<?php else : ?>
		            		<div class="mediaholder_innerwrap overlay cap-icon more">
		            		<a href="<?php the_permalink(); ?>">
		            	<?php endif; ?>
		            	
		            		<?php the_post_thumbnail('portfolio-index'); ?>
		              		<div></div>
		                </a>
		            </div>
		          </div>
		          <div class="detailholder">
		            <h4 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		            <div class="meta">
		            	<?php 
		            		echo ebor_the_simple_terms_links();
		            		if( get_post_meta( $post->ID, '_cmb_the_client', true ))
		            			echo ' / ' . __('Client: ','marble') . get_post_meta( $post->ID, '_cmb_the_client', true ); 
		            	?>
		            </div>
		            <?php the_excerpt(); ?>
		          </div>
		        </li>
		        
		      <?php 
		      	/**
		      	 * Otherwise (if post type is post)
		      	 */
		      	else : 
		      ?>
		      
		        <li class="post">
		          <div class="mediaholder">
		            <div class="mediaholder_innerwrap overlay cap-icon more">
		            	<a href="<?php the_permalink(); ?>">
		            		<?php the_post_thumbnail('portfolio-index'); ?>
		              		<div></div>
		                </a>
		            </div>
		          </div>
		          <div class="detailholder">
		            <h4 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		            <div class="meta">
		            	<span class="date"><?php the_time(get_option('date_format')); ?></span> 
		            	<span class="sep">/</span> 
		            	<span class="comments"><a href="<?php comments_link(); ?>"><?php comments_number( __('0 Comments','marble'), __('1 Comment','marble'), __('% Comments','marble') ); ?></a></span>
		            	<?php if( function_exists('zilla_likes') ) : ?> 
			            	<span class="sep">/</span> 
			            	<span class="likes"><?php zilla_likes(); ?></span>
		            	<?php endif; ?>
		            </div>
		            <?php the_excerpt(); ?>
		          </div>
		        </li>
		        
		      <?php endif; ?>
		        
		      <?php 
		      	endwhile; 
		      	endif; 
		      	wp_reset_query(); 
		      ?>

		      </ul>
		      <div class="clearfix"></div>
		    </div>
		    
		    <div class="clearfix"></div>
		  </div>
		</div>
		
		<script type="text/javascript">
			/*-----------------------------------------------------------------------------------*/
			/*	SHOWBIZ POSTS
			/*-----------------------------------------------------------------------------------*/
			jQuery(window).load(function($) {
			  jQuery('#carousel_<?php echo $unique; ?>').showbizpro({
			    dragAndScroll:"off",
			    visibleElementsArray:[3,3,3,1],
			    mediaMaxHeight:[0,0,0,0],
			    carousel:"off",
			    heightOffsetBottom:0,
			    rewindFromEnd:"off",
			    autoPlay:"off",
			    delay:2000,
			    speed:250
			  });
			});
		</script>

	<?php }
	
}