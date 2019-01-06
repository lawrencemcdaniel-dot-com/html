<?php
	$protocols = array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet', 'skype'); 
?>

<footer class="black-wrapper">
	<div class="container inner">
	
	  <div class="row">
	  
	  	<?php get_template_part('footer/footer', get_option('footer_columns', 'three')); ?>
	  	<div class="clear"></div>
	
	  </div>
	
	  
	  <hr />
	  <p class="pull-left"><?php echo get_option('copyright', 'Configure this message in "appearance" => "customize"'); ?></p>
	  
	  <?php if(!( get_option('footer_social') == '0' )) : ?>
	      <ul class="social pull-right">
	      
	      	<?php 
	      		$i = 1; 
	      		while( $i < 11 ){
	      			if( get_option("footer_social_link_$i") ) {
	      	    		echo '<li><a href="' . esc_url(get_option("footer_social_link_$i"), $protocols) . '" target="_blank"><i class="icon-s-' . get_option("footer_social_$i") . '"></i></a></li>';
	      			}
	      			$i++;
	      		} 
	      	?>
	            
	      </ul>
	  <?php endif; ?>
      
	</div>
</footer>

</div>

<?php wp_footer(); ?>
</body>
</html>