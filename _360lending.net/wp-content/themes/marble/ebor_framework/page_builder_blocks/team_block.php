<?php

class AQ_Team_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Team',
			'size' => 'span12',
			'resizable' => 0
		);
		
		//create the block
		parent::__construct('aq_team_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array();

		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>
		<p class="description note">
			<?php _e('This block will output all of your Team Member posts.', 'marble') ?>
		</p>
		<?php
		
	}
	
	function block($instance) {
		extract($instance);
	
		$i = 0;	
		
		$team_query = new WP_Query('post_type=team&posts_per_page=-1'); 
		if( $team_query->have_posts() ) : while( $team_query->have_posts() ) : $team_query->the_post(); 
		global $post; 
		
		($i == 0 || $i % 3 == 0 ) ? $first = 'aq-first' : $first = '';
		$i++;
	?>
		<div <?php post_class('aq_span4 ' . $first); ?>>
		
		  <?php if( has_post_thumbnail() ) : ?>
		    <figure class="media-wrapper">
		    	<?php the_post_thumbnail('team'); ?>
		    </figure>
		  <?php endif; ?>
		  
		  <div class="details">
		  	<?php if( get_option('team_link','0') == 1 ) : ?>
		    	<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span><?php echo get_post_meta( $post->ID, '_cmb_the_job_title', true ); ?></span></h4>
		    <?php else : ?>
		    	<h4><?php the_title(); ?> <span><?php echo get_post_meta( $post->ID, '_cmb_the_job_title', true ); ?></span></h4>
		    <?php endif; ?>
		    
		    <?php 
		    	$custom_excerpt = get_post_meta( $post->ID, '_cmb_team_intro_text', true );
		    	if(!empty($custom_excerpt) && isset($custom_excerpt)) {
		    		echo '<p>'.$custom_excerpt.'</p>';
		    	} else {
		    		the_excerpt();
		    	}		    	
		    	get_template_part('loop/loop', 'social');	
		    ?>
		    
		  </div>
		</div>
		
	<?php 
		if($i % 3 == 0) echo '<div class="clear"></div>';	
			
		endwhile; 
		endif; 
		wp_reset_query();
		
	}
	
}