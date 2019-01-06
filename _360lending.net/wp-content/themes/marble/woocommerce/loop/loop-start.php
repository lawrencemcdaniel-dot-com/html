<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     9.9.9
 */
 $class = 'span12';
 
 if( is_archive() ) 
 	$class = 'span9';
 	
 if(!( is_active_sidebar('shop') ))
 	$class = 'span12';
?>
<ul class="products <?php echo $class; ?>">