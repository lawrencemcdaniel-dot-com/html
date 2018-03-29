<?php 
	get_header(); 
	the_post();
?>

<div class="container inner">
  <div class="row blog">
  
    <div class="span12 posts">
      <div <?php post_class(); ?>>
      
        <?php 
        	/**
        	 * ebor_post_format hook
        	 * All actions contained in /ebor_framework/theme_actions.php
        	 *
        	 * @hooked ebor_post_format_markup - 10
        	 */
        	do_action('ebor_post_format');
        	
        	/**
        	 * ebor_post_title hook
        	 * All actions contained in /ebor_framework/theme_actions.php
        	 *
        	 * @hooked ebor_post_title_markup - 10
        	 */
        	do_action('ebor_post_title'); 
        	
        	the_content();
        ?>
        
      </div>
    </div>
    
  </div>
</div>

<?php	  
	get_footer();