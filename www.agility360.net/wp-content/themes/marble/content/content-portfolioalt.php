<div class="row">
      
	<div class="span8">
	  <?php
	  	/**
	  	 * ebor_post_format hook
	  	 * All actions contained in /ebor_framework/theme_actions.php
	  	 *
	  	 * @hooked ebor_post_format_markup - 10
	  	 */
	  	do_action('ebor_post_format');
	  ?>
	</div>
	
	<div class="span4 lp20">
	
	  <h2 class="post-title"><?php the_title(); ?></h2>
	  
	  <div class="divide5"></div>
	  	<?php 
	  		the_content(); 
	  		wp_link_pages();
	  	?>
	  <div class="divide5"></div>
	  
	  <?php 
	  if( get_post_meta( $post->ID, '_cmb_portfolio_post_meta', true ) !=='on' ){
	  	/**
	  	 * ebor_portfolio_meta hook
	  	 * All actions contained in /ebor_framework/theme_actions.php
	  	 *
	  	 * @hooked ebor_portfolio_meta_markup - 10
	  	 */
	  	do_action('ebor_portfolio_meta'); 
	  	
	  	/**
	  	 * ebor_social_sharing hook
	  	 * All actions contained in /ebor_framework/theme_actions.php
	  	 *
	  	 * @hooked ebor_social_sharing_markup - 10
	  	 */
	  	do_action('ebor_social_sharing'); 
	  }
	  ?>
	  
	</div>
	
</div>