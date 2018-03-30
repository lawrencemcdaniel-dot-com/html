<?php

// Declare WooComerce Support
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

// Load local WooCommerce Styles
function ebor_woocommerce_load_scripts() {
	wp_enqueue_style( 'woocommerce', get_template_directory_uri() . '/style/css/woocommerce.css' );
	wp_deregister_script( 'prettyPhoto' );
	wp_deregister_script( 'prettyPhoto-init' );
	wp_deregister_style( 'woocommerce_prettyPhoto_css' );
	wp_dequeue_script( 'prettyPhoto' );
	wp_dequeue_script( 'prettyPhoto-init' );
	wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
}
add_action('wp_enqueue_scripts', 'ebor_woocommerce_load_scripts', 100);

//Open Page Wrapper
add_action('woocommerce_before_main_content', 'ebor_open_dark_wrapper_markup', 5);

add_action( 'ebor_single_product_title', 'woocommerce_template_single_title', 50 );
add_action( 'ebor_single_product_title', 'woocommerce_template_single_price', 55 );
//add_action( 'ebor_single_product_title', 'ebor_single_cart', 60 );
add_action( 'woocommerce_after_shop_loop_item_title', 'ebor_divider', 5 );
add_action( 'woocommerce_single_product_summary', 'ebor_divider', 25 );
add_action( 'woocommerce_single_product_summary', 'ebor_divider', 35 );
add_action( 'woocommerce_share', 'ebor_social_sharing_markup');

//Close Page Wrapper
add_action('ebor_wrapper', 'ebor_close_dark_wrapper_markup', 5);

//Open Page Wrapper
add_action('ebor_wrapper', 'ebor_open_wrapper_markup', 10);

//Close Page Wrapper
add_action('woocommerce_after_main_content', 'ebor_close_wrapper_markup', 5);

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper' );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end' );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price' );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price' );

// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}

// Redefine woocommerce_output_related_products()
function woocommerce_output_related_products() {
woocommerce_related_products( array(4,4) ); // Display 3 products in rows of 3
}

function ebor_single_cart(){
	global $woocommerce;
	echo '<a class="cart-contents" href="'.$woocommerce->cart->get_cart_url().'" title="'. __('View your shopping cart', 'marble').'"><i class="icon-basket-1"></i>'.sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'marble'), $woocommerce->cart->cart_contents_count).' - '.$woocommerce->cart->get_cart_total().'</a>';
}

function ebor_divider(){
	echo '<div class="divide20"></div><hr /><div class="divide20"></div>';
}

function woocommerce_template_loop_product_thumbnail(){
	global $post;
	$details = get_option('shop_catalog_image_size');
	$url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
	$resized_image = aq_resize($url[0], $details['width'], $details['height'], $details['crop']);
	echo '<a href="' . get_permalink() . '"><img src="' . $resized_image . '" alt="' . get_the_title() . '" /></a>';
}

//add cart to menu 
function ebor_add_cart($items, $args) {
	if( get_option('shop_dropdown','1') == 0 )
		return $items;
      
    if($args->theme_location == 'primary'){
          
        $items .= ebor_dropdown();
  
        return $items;
    }
    else
        return $items;
}
add_filter( 'wp_nav_menu_items', 'ebor_add_cart', 200, 2 );


// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	
	ob_start();
	
	?>
	<ul class="cart_list">
	
	<?php $i = 0;					
		foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) :
			
			$i++;
			( $i % 2 == 0 ) ? $rowclass = ' class="dark_wrapper"' : $rowclass = '';
			$_product = $cart_item['data'];
			
			if ($_product->exists() && $cart_item['quantity']>0) :
				echo '<li'.$rowclass.'><div class="dropdowncartimage">';
				echo '<a href="'.get_permalink($cart_item['product_id']).'">';				
				if (has_post_thumbnail($cart_item['product_id'])) :					
					echo get_the_post_thumbnail($cart_item['product_id'], 'shop_thumbnail'); 
				else :					 
					echo '<img src="'.$woocommerce->plugin_url(). '/assets/images/placeholder.png" alt="Placeholder" width="'.$woocommerce->get_image_size('shop_thumbnail_image_width').'" height="'.$woocommerce->get_image_size('shop_thumbnail_image_height').'" />'; 				
				endif;				
				echo '</a>';
				echo '</div>';
				
				echo '<div class="dropdowncartproduct">';
				echo '<a href="'.get_permalink($cart_item['product_id']).'">';				
				echo apply_filters('woocommerce_cart_widget_product_title', $_product->get_title(), $_product);				
				if ($_product instanceof woocommerce_product_variation && is_array($cart_item['variation'])) :
					echo woocommerce_get_formatted_variation( $cart_item['variation'] );
					endif;
				echo '<span class="quantity">' .$cart_item['quantity'].' &times; '.woocommerce_price($_product->get_price()).'</span>
					  </a></div><div class="clear"></div></li>';
				
			endif;
		endforeach; ?>
		
		</ul>
	<?php
	
	$fragments['ul.cart_list'] = ob_get_clean();
	
	return $fragments;
	
}

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment_total');
function woocommerce_header_add_to_cart_fragment_total( $fragments ) {
	global $woocommerce;
	
	ob_start();
	
	?>
	<p class="total"><strong>
	
	<?php	
	if (get_option('js_prices_include_tax')=='yes') :
		_e('Total', 'marble');
	else :
		_e('Subtotal', 'marble');
	endif;
	
	echo ':</strong><span class="contents">'.$woocommerce->cart->get_cart_total().'</span></p>';
	
	$fragments['p.total'] = ob_get_clean();
	
	return $fragments;
	
}

function ebor_dropdown() {
	global $woocommerce; if (is_cart()) return;
	
	echo '<div id="dropdowncart">
		  <a href="'.$woocommerce->cart->get_cart_url().'" class="dropdowncarttrigger"><i class="icon-basket-1"></i></a>';
		  
	if (sizeof($woocommerce->cart->cart_contents)>0) : 
	
	echo '
	<div class="dropdowncartcontents">
	<ul class="cart_list">';
	
		$i = 0;					
		foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) :
			
			$i++;
			( $i % 2 == 0 ) ? $rowclass = ' class="dark_wrapper"' : $rowclass = '';
			$_product = $cart_item['data'];
			
			if ($_product->exists() && $cart_item['quantity']>0) :
				echo '<li'.$rowclass.'><div class="dropdowncartimage">';
				echo '<a href="'.get_permalink($cart_item['product_id']).'">';				
				if (has_post_thumbnail($cart_item['product_id'])) :					
					echo get_the_post_thumbnail($cart_item['product_id'], 'shop_thumbnail'); 
				else :					 
					echo '<img src="'.$woocommerce->plugin_url(). '/assets/images/placeholder.png" alt="Placeholder" width="'.$woocommerce->get_image_size('shop_thumbnail_image_width').'" height="'.$woocommerce->get_image_size('shop_thumbnail_image_height').'" />'; 				
				endif;				
				echo '</a>';
				echo '</div>';
				
				echo '<div class="dropdowncartproduct">';
				echo '<a href="'.get_permalink($cart_item['product_id']).'">';				
				echo apply_filters('woocommerce_cart_widget_product_title', $_product->get_title(), $_product);				
				if ($_product instanceof woocommerce_product_variation && is_array($cart_item['variation'])) :
					echo woocommerce_get_formatted_variation( $cart_item['variation'] );
					endif;
				echo '<span class="quantity">' .$cart_item['quantity'].' &times; '.woocommerce_price($_product->get_price()).'</span>
					  </a></div><div class="clear"></div></li>';
				
			endif;
		endforeach;
		
		echo '</ul>';
	
	endif;
	
	if (sizeof($woocommerce->cart->cart_contents)>0) :
	
	echo '<p class="total"><strong>';
		
	if (get_option('js_prices_include_tax')=='yes') :
		_e('Total', 'marble');
	else :
		_e('Subtotal', 'marble');
	endif;
	
	echo ':</strong><span class="contents">'.$woocommerce->cart->get_cart_total().'</span></p>';
		
	do_action( 'woocommerce_widget_shopping_cart_before_buttons' );
		
	echo '<p class="buttons">
		  <a href="'.$woocommerce->cart->get_cart_url().'" class="btn">'.__('View Cart &rarr;', 'marble').'</a> 
		  <a href="'.$woocommerce->cart->get_checkout_url().'" class="btn checkout">'.__('Checkout &rarr;', 'marble').'</a>
		  </p></div>';
	endif;
	
	echo '</div>';
		
}