<?php 
	get_header(); 
	the_post(); 
?>
  
  <div class="pcw">
    <div class="container inner">
      <div class="navigation">
      
      	<?php 
      		$displays = get_option('ebor_cpt_display_options');
      		( $displays['portfolio_slug'] ) ? $slug = $displays['portfolio_slug'] : $slug = 'portfolio';
      	?>
      		
       	<a href="<?php echo home_url( $slug ); ?>" class="btn pull-left back"><?php _e('Back','marble'); ?></a>
       	
       	<?php 
       		previous_post_link('%link', __('Next','marble'), TRUE, '', 'portfolio-category' );
       		next_post_link('%link', __('Prev','marble'), TRUE, '', 'portfolio-category' ); 
       	?>
       	
      </div>
      
      <?php 
      	( get_post_meta( $post->ID, '_cmb_layout_checkbox', true ) !=='on' ) ? get_template_part('content/content','portfolio') : get_template_part('content/content','portfolioalt'); 
		
		if( get_option('portfolio_related','0') == 1 )
			get_template_part('loop/loop','related'); 
		
      	if( comments_open() && get_option('portfolio_comments','0') == 1 )
      		comments_template(); 
      ?>
      
    </div>
  </div>
  
<?php 
	get_footer();