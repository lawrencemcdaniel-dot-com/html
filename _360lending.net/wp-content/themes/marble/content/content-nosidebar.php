<div class="blog no-sidebar">
  <div class="dark-wrapper">
    <div class="container inner">
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
        	
        	the_content();
        	wp_link_pages();
        	
        	the_tags( '<div class="meta tags">', ', ', '</div>'); 
        	
        	/**
        	 * ebor_social_sharing hook
        	 * All actions contained in /ebor_framework/theme_actions.php
        	 *
        	 * @hooked ebor_social_sharing_markup - 10
        	 */
        	 if( get_option('blog_social','1') == 1 )
        		do_action('ebor_social_sharing');  
        	
    		if( get_option('blog_author','1') == 1 )
    			get_template_part('content/content','author'); 
        ?>
        
      </div>
      
    </div>
  </div>
  
	<?php 
		if( comments_open() ){
	  		echo '<div class="light-wrapper"><div class="container inner">';
			comments_template();
		}
	?>
  
</div>