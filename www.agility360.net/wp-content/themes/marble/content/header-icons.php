<div class="container">
	  <p class="pull-left">
	  	<?php if( get_option('header_email') ) : ?>
	  			<i class="icon-mail"></i>
	  			<a href="mailto:<?php echo get_option('header_email','email@example.com'); ?>" class="email-link"><?php echo get_option('header_email','email@example.com'); ?></a>
	  	<?php 
	  		endif;
	  		if( get_option('header_phone','+00 (123) 456 78 90') ) : 
	  	?>
	  		<i class="icon-phone-1"></i><a href="tel:<?php echo get_option('header_phone','+00 (123) 456 78 90'); ?>"><?php echo get_option('header_phone','+00 (123) 456 78 90'); ?></a>
	  	<?php endif; ?>
	  </p>
	  
	  <?php if(!( get_option('footer_social') == '0' )) : ?>
	      <ul class="social pull-right">
	      
	      	<?php 
	      		$i = 1; 
	      		while( $i < 11 ){
		  			if( get_option("footer_social_link_$i") ) {
		  	        		echo '<li><a href="' . esc_url(get_option("footer_social_link_$i")) . '" target="_blank"><i class="icon-s-' . get_option("footer_social_$i") . '"></i></a></li>';
		        	}
	        	$i++;
	        	} 
	        ?>
	            
	      </ul>
	  <?php endif; ?>
	  <div class="clear"></div>
	  <hr />
	  <div class="divide20"></div>
	  
</div>