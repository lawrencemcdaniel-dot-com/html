<?php

class AQ_Blog_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Blog Feed',
			'size' => 'span12',
			'resizable' => 0,
			'block_description' => 'Add a feed of<br />blog posts to the page.'
		);
		parent::__construct('aq_blog_block', $block_options);
	}//end construct
	
	function form($instance) {
		$defaults = array(
			'pppage' => '6',
			'filter' => 'all',
			'type' => 'blogsidebar'
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		$args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'category'
		); 
			
		$filter_options = get_categories( $args );
		
		$blog_types = array(
			'blogsidebar' => 'Sidebar Blog',
			'blognosidebar' => 'No Sidebar Blog',
			'blogshowcase' => 'Showcase (full screen grid) blog'
		);
	?>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('type') ?>">
				Blog Style
				<?php echo aq_field_select('type', $block_id, $blog_types, $type) ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('pppage') ?>">
				Posts Per Page
				<?php echo aq_field_input('pppage', $block_id, $pppage, $size = 'full', $type = 'number') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('filter') ?>">
				Show posts from a specific category? (Leave as "All" if using the showcase layout)<br />
				<?php echo ebor_portfolio_field_select('filter', $block_id, $filter_options, $filter) ?>
			</label>
		</p>
		
	<?php
	}//end form
	
	function block($instance) {
		extract($instance);
		
		// Fix for pagination
		if( is_front_page() ) { 
			$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1; 
		} else { 
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; 
		}
		
		/**
		 * Setup post query
		 */
		$query_args = array(
			'post_type' => 'post',
			'posts_per_page' => $pppage,
			'paged' => $paged
		);
		
		/**
		 * Set up category query if needed
		 */
		if (!( $filter == 'all' )) {
			if( function_exists( 'icl_object_id' ) ){
				$filter = (int)icl_object_id( $filter, 'category', true);
			}
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field' => 'id',
					'terms' => $filter
				)
			);
		}
	
		$blog_query = new WP_Query( $query_args );
	?>
	
		<?php if( $type == 'blogsidebar' ) : ?>
		
			<?php 
				/**
				 * ebor_open_wrapper hook
				 * All actions contained in /ebor_framework/theme_actions.php
				 *
				 * @hooked ebor_open_wrapper_markup - 10
				 */
				do_action('ebor_open_wrapper'); 
			?>
			  
				<div class="row blog">
				  <div class="span8 posts">
				  
				      <?php if ( $blog_query->have_posts() ) : while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
				      
				        <div <?php post_class(); ?>>
				          <?php 
				          	/**
				          	 * ebor_post_title hook
				          	 * All actions contained in /ebor_framework/theme_actions.php
				          	 *
				          	 * @hooked ebor_post_title_markup - 10
				          	 */
				          	do_action('ebor_post_title');
				          	
				          	/**
				          	 * ebor_post_format hook
				          	 * All actions contained in /ebor_framework/theme_actions.php
				          	 *
				          	 * @hooked ebor_post_format_markup - 10
				          	 */
				          	do_action('ebor_post_format');
				          	
				          	the_content( get_option('blog_continue', 'Continue Reading &rarr;') );
				          ?>
				        </div>
				        <hr />
				        <div class="divide60"></div>
				          
				        <?php 
				        	endwhile; 
				        	else:
				        	
				        		get_template_part('loop/loop','none');
				        	
				        	endif; 
				        	
				        	echo function_exists('kriesi_pagination') ? kriesi_pagination($blog_query->max_num_pages) : posts_nav_link(); 
				        ?>
				    
				  </div>
				  
				  <?php get_sidebar(); ?>
				
				</div>
			
			<?php
				/**
				 * ebor_close_wrapper hook
				 * All actions contained in /ebor_framework/theme_actions.php
				 *
				 * @hooked ebor_close_wrapper_markup - 10
				 */ 
				do_action('ebor_close_wrapper');
			?>
		
		<?php elseif( $type == 'blognosidebar' ) : ?>
		
			<div class="blog no-sidebar">
			  
			<?php 
				$i = 0; 
				if ( $blog_query->have_posts() ) : while ( $blog_query->have_posts() ) : $blog_query->the_post(); 
				$i++;
				
				echo (!( $i % 2 == 0 )) ? '<div class="dark-wrapper">' : '<div class="light-wrapper">';
				
				/**
				 * ebor_open_wrapper hook
				 * All actions contained in /ebor_framework/theme_actions.php
				 *
				 * @hooked ebor_open_wrapper_markup - 10
				 */
				do_action('ebor_open_wrapper'); 
			?>
			      
			    <div <?php post_class(); ?>>
			      
			      <?php 
			      	/**
			      	 * ebor_post_title hook
			      	 * All actions contained in /ebor_framework/theme_actions.php
			      	 *
			      	 * @hooked ebor_post_title_markup - 10
			      	 */
			      	do_action('ebor_post_title');
			      	
			      	/**
			      	 * ebor_post_format hook
			      	 * All actions contained in /ebor_framework/theme_actions.php
			      	 *
			      	 * @hooked ebor_post_format_markup - 10
			      	 */
			      	do_action('ebor_post_format');
			      	
			      	the_content( get_option('blog_continue', 'Continue Reading &rarr;') );
			      ?>
			      
			    </div>
			
			<?php 
				/**
				 * ebor_close_wrapper hook
				 * All actions contained in /ebor_framework/theme_actions.php
				 *
				 * @hooked ebor_close_wrapper_markup - 10
				 */
				do_action('ebor_close_wrapper'); 
				
				if(!( $i % 2 == 0 )) echo '</div>';
				
				endwhile; 
				else:
				
					get_template_part('loop/loop','none');
				
				endif;
				
				if( kriesi_pagination() ) : 
			?>
			
			    <div class="dark-wrapper">
			      <?php 
			      	/**
			      	 * ebor_open_wrapper hook
			      	 * All actions contained in /ebor_framework/theme_actions.php
			      	 *
			      	 * @hooked ebor_open_wrapper_markup - 10
			      	 */
			      	do_action('ebor_open_wrapper');
			      	
			      	echo function_exists('kriesi_pagination') ? kriesi_pagination($blog_query->max_num_pages) : posts_nav_link();
			      	
			      	/**
			      	 * ebor_close_wrapper hook
			      	 * All actions contained in /ebor_framework/theme_actions.php
			      	 *
			      	 * @hooked ebor_close_wrapper_markup - 10
			      	 */
			      	do_action('ebor_close_wrapper'); 
			      ?>
			    </div>
				    
			<?php 
				endif; 
			?>
			    
			</div>
			
		<?php elseif( $type == 'blogshowcase' ) : ?>
			
			<div class="full-portfolio">
			
				<ul class="items">
				    
				    <?php if ( $blog_query->have_posts() ) : while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
				    
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
				
				<?php ebor_blog_load_more(); ?>
			
			</div>
			
		<?php endif; ?>
			
	<?php	
	}//end block
	
}//end class