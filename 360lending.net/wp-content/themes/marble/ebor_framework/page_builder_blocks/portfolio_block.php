<?php

class AQ_Portfolio_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Portfolio',
			'size' => 'span12',
			//'resizable' => 0,
		);
		
		//create the block
		parent::__construct('aq_portfolio_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'type' => 'grid',
			'filters' => 0,
			'isotope_filters' => 1,
			'disable_ajax' => 0,
			'disable_ajax_isotope' => 1,
			'lightbox' => 0,
			'filter' => 'all'
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
		
		$type_options = array(
			'grid' => 'Full Width Grid',
			'isotope' => 'Portfolio w/Filters'
		);
		
	?>
		
		<p class="description note">
			<?php _e('Use this block to add a portfolio to your page. Note: The "Full-Width Grid" option is best used in pages which support full width content.', 'marble') ?>
		</p>
		
		<p class="description half">
			<label for="<?php echo $this->get_field_id('type') ?>">
				Portfolio Display Type<br/>
				<?php echo aq_field_select('type', $block_id, $type_options, $type) ?>
			</label>
		</p>
		
		<div class="cf"></div>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('filters') ?>">
				<?php _e('Show Filters on Full Width Grid?', 'marble'); ?><br/>
				<?php echo aq_field_checkbox('filters', $block_id, $filters) ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('isotope_filters') ?>">
				<?php _e('Show Filters on Portfolio w/Filters?', 'marble'); ?><br/>
				<?php echo aq_field_checkbox('isotope_filters', $block_id, $isotope_filters) ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('disable_ajax') ?>">
				<?php _e('Disable AJAX Post Loading in Full With Grid (Showcase)?', 'marble'); ?><br/>
				<?php echo aq_field_checkbox('disable_ajax', $block_id, $disable_ajax) ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('disable_ajax_isotope') ?>">
				<?php _e('Disable AJAX Post Loading in Portfolio W/Filters?', 'marble'); ?><br/>
				<?php echo aq_field_checkbox('disable_ajax_isotope', $block_id, $disable_ajax_isotope) ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('lightbox') ?>">
				<?php _e('Use a lightbox for all posts? This option will load a larger, uncropped version of "The Featured Image" into a lightbox when clicking on the posts instead of loading the post itself. This option will also disable the "Load More" button and force load all portfolio posts.', 'marble'); ?><br/>
				<?php echo aq_field_checkbox('lightbox', $block_id, $lightbox) ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('filter') ?>">
				<?php _e('Show a specific portfolio category?', 'marble'); ?><br/>
				<?php echo ebor_portfolio_field_select('filter', $block_id, $filter_options, $filter) ?>
			</label>
		</p>

		<?php
	}
	
	function block($instance) {
		extract($instance);
		
		$paged = (get_query_var('page')) ? get_query_var('page') : 1;
		
		(isset($filter)) ? '' : $filter = 'all';
		(isset($filters)) ? '' : $filters = 0;
		(isset($isotope_filters)) ? '' : $isotope_filters = 1;
		(isset($disable_ajax)) ? '' : $disable_ajax = 0;
		(isset($disable_ajax_isotope)) ? '' : $disable_ajax_isotope = 1;
		($disable_ajax == 0) ? $ajax = 'content-slider' : $ajax = ''; 
		($disable_ajax_isotope == 0) ? $ajax_isotope = 'content-slider' : $ajax_isotope = ''; 
		if(isset($lightbox) && $lightbox == 1){
			$lightbox = 'lightbox';
			$ajax = '';
			$portfolio_query = new WP_Query('post_type=portfolio&posts_per_page=-1');
		} else { 
			$lightbox = '';
			$portfolio_query = new WP_Query('post_type=portfolio&posts_per_page='.get_option('portfolio_posts_per_page','20').'&paged='.$paged);
		}
		
		if ( !($filter == 'all') ) {
			if( function_exists( 'icl_object_id' ) ){
				$filter = (int)icl_object_id( $filter, 'portfolio-category', true);
			}
			$portfolio_query = '';
			$portfolio_query = new WP_Query( 
				array( 
					'post_type' => 'portfolio', 'posts_per_page' => -1, 'tax_query' => array(
						array(
							'taxonomy' => 'portfolio-category',
							'field' => 'id',
							'terms' => $filter
						)
					) 
				) 
			);
		}
		
		switch($type) :
			case('grid'):
		 	
		 	if( $filters == 1 ) : 
		 ?>
			 <div class="fix-portfolio ebor-showcase-filters">
				 <?php 
				 	do_action('ebor_open_wrapper');
				 	
				 	if($filter == 'all'){
				 	
						do_action('ebor_portfolio_filters'); 
						
					} else {
					
						$term = get_term( $filter, 'portfolio-category' );
						
						echo '<ul class="filter"><li><a class="active" href="#" data-filter="*">'.__('All','marble').'</a></li>';
						echo '<li><a href="#" data-filter=".'.$term->slug.'">'.$term->name.'</a></li>';
						
						$categories = get_categories('taxonomy=portfolio-category&child_of='.$filter);
						foreach ($categories as $category){
							echo '<li><a href="#" data-filter=".' . $category->slug . '">' . $category->name . '</a></li>';
						}
						
						echo '</ul>';

					}
					
					do_action('ebor_close_wrapper');
				 ?>
			 </div>
		 <?php 
		 	endif; 
		 ?>
		
		<div class="full-portfolio">
		
			<ul class="<?php echo $ajax; ?> items">
			    
			    <?php if ( $portfolio_query->have_posts() ) : while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post(); ?>
			    
			      <?php get_template_part('content/content','showcase' . $lightbox); ?>
			      
			    <?php endwhile; else: ?>
			      
			      	<p><?php _e('Sorry, no posts matched your criteria.','marble'); ?></p>
			      
			    <?php endif; ?>
			
			</ul>
			
			<?php 
				ebor_load_more($portfolio_query->max_num_pages); 
				wp_reset_query(); 
			?>
		
		</div>
		
		<?php
			break;
			case('isotope') : 
		?>
		
		    <div class="fix-portfolio">
		    
		    <?php 
		    	if( $isotope_filters == 1 ){
		    		
		    		if($filter == 'all'){
		    						 	
						do_action('ebor_portfolio_filters'); 
						
					} else {
					
						$term = get_term( $filter, 'portfolio-category' );
						
						echo '<ul class="filter"><li><a class="active" href="#" data-filter="*">'.__('All','marble').'</a></li>';
						echo '<li><a href="#" data-filter=".'.$term->slug.'">'.$term->name.'</a></li>';
						
						$categories = get_categories('taxonomy=portfolio-category&child_of='.$filter);
						foreach ($categories as $category){
							echo '<li><a href="#" data-filter=".' . $category->slug . '">' . $category->name . '</a></li>';
						}
						
						echo '</ul>';

					}
		    							
		    	}
		    ?>
		      
		      <ul class="<?php echo $ajax_isotope; ?> items thumbs">
		      
			      <?php if ( $portfolio_query->have_posts() ) : while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post(); ?>
			      
			        <?php get_template_part('content/content','classic' . $lightbox); ?>
			        
			      <?php endwhile; else: ?>
			        
			        	<p><?php _e('Sorry, no posts matched your criteria.','marble'); ?></p>
			        
			      <?php endif; ?>
		
		      </ul>
		      
		      <?php 
		      	ebor_load_more($portfolio_query->max_num_pages); 
		      	wp_reset_query(); 
		      ?>
		
		    </div>
		
		<?php 
			break; 
			endswitch;
	}
	
}