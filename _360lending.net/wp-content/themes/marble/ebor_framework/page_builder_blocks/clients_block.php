<?php

class AQ_Clients_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Clients',
			'size' => 'span12',
			'resizable' => 0
		);
		
		//create the block
		parent::__construct('aq_clients_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array();

		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>
		<p class="description note">
			<?php _e('This block will output all of your Client logos.', 'marble') ?>
		</p>
		<?php
		
	}
	
	function block($instance) {
		extract($instance);
	
			$clients_query = new WP_Query('post_type=client&posts_per_page=-1');
			if ( $clients_query->have_posts() ) : ?>
			
			
				<div class="showbiz-container clients">
				  <div class="showbiz" data-left="#showbiz_left_2" data-right="#showbiz_right_2" data-play="#showbiz_play_2">
				    <div class="overflowholder">
				      <ul>
				      
					      <?php while ( $clients_query->have_posts() ) : $clients_query->the_post(); global $post; ?>
					        <li>
					          <div class="mediaholder">
					            <div class="mediaholder_innerwrap">
					            	<?php 
					            		if( get_post_meta( $post->ID, '_cmb_client_url', true ) )
					            				echo '<a href="'.esc_url( get_post_meta( $post->ID, '_cmb_client_url', true ) ).'" target="_blank">';
					            				
					            		the_post_thumbnail('full');
					            		
					            		if( get_post_meta( $post->ID, '_cmb_client_url', true ) ) 
					            			echo '</a>'; 
					            	?>
					            </div>
					          </div>
					        </li>
					      <?php endwhile; ?> 
				       
				      </ul>
				      <div class="clearfix"></div>
				    </div>
				    
				    <div class="clearfix"></div>
				  </div>
				  
				  <div class="showbiz-navigation"><a id="showbiz_left_2" class="sb-navigation-left"></a> <a id="showbiz_play_2" class="sb-navigation-play"></a> <a id="showbiz_right_2" class="sb-navigation-right"></a>
				    <div class="sbclear"></div>
				  </div>
				  
				</div>
			
			
			<?php else: ?>
			  
			  	<p><?php _e('Sorry, no posts matched your criteria.','marble'); ?></p>
			  
			<?php endif; wp_reset_query();
		
	}
	
}