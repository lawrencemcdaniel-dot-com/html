<?php

//ENQUEUE JQUERY & CUSTOM SCRIPTS
function ebor_load_scripts() {
	$protocol = is_ssl() ? 'https' : 'http';
	
	/**
	 * Enqueue google fonts
	 */
	wp_enqueue_style( 'ebor-marble-roboto-font', "$protocol://fonts.googleapis.com/css?family=Roboto:400,400italic,500,500italic,700italic,700,900,900italic,300italic,300,100italic,100" );
	wp_enqueue_style( 'ebor-marble-roboto-condensed-font', "$protocol://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,700,300" );
	wp_enqueue_style( 'ebor-marble-roboto-slab-font', "$protocol://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300,100" );
	
	/**
	 * Enqueue styles
	 */
	wp_enqueue_style( 'ebor-bootstrap', get_template_directory_uri() . '/style/css/bootstrap.css' );
	wp_enqueue_style( 'ebor-prettify', get_template_directory_uri() . '/style/js/google-code-prettify/prettify.css' );
	wp_enqueue_style( 'ebor-style', get_stylesheet_uri() );
	wp_enqueue_style( 'ebor-fontello', get_template_directory_uri() . '/style/type/fontello.css' );
	wp_enqueue_style( 'ebor-custom', get_template_directory_uri() . '/custom.css' );
	
	/**
	 * Deregister styles
	 */
	wp_dequeue_style('aqpb-view-css');
	wp_deregister_style('aqpb-view-css');
	wp_dequeue_style('woocommerce-general');
	wp_deregister_style('woocommerce-general');
	wp_dequeue_style('woocommerce-layout');
	wp_deregister_style('woocommerce-layout');
	wp_dequeue_style('woocommerce-smallscreen');
	wp_deregister_style('woocommerce-smallscreen');
	
	/**
	 * Enqueue scripts
	 */
	$sslPrefix = ( is_ssl() ) ? 'https://maps-api-ssl.google.com' : 'http://maps.googleapis.com';
 	$key = ( get_option('ebor_gmap_api') ) ? '?key=' . get_option('ebor_gmap_api') : false;
	wp_enqueue_script('googlemapsapi', $sslPrefix . '/maps/api/js' . $key, array( 'jquery' ), false, true);
	wp_enqueue_script( 'themepunchtools', get_template_directory_uri() . '/style/js/jquery.themepunch.plugins.min.js', array('jquery'), false, true  );
	wp_enqueue_script( 'ebor-plugins', get_template_directory_uri() . '/style/js/plugins.js', array('jquery'), false, true  );
	wp_enqueue_script( 'ebor-view', get_template_directory_uri() . '/style/js/view.min.js?auto', array('jquery'), false, true  );
	wp_enqueue_script( 'ebor-scripts', get_template_directory_uri() . '/style/js/scripts.js', array('jquery'), false, true  );
	
	if( is_page_template('page_onepage_home.php') ){
		wp_enqueue_script( 'ebor-anchor-scroll', get_template_directory_uri() . '/style/js/anchorscroll.js', array('jquery'), false, true  );
		$scroll_offset = array( 
			'scroll_offset' => get_option('scroll_offset', '50')
		);
		wp_localize_script( 'ebor-anchor-scroll', 'script_data', $scroll_offset );
	}
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	/**
	 * Deregister scripts
	 */
	wp_dequeue_script('aqpb-view-js');
	wp_deregister_script('aqpb-view-js');
	
	/**
	 * localize script
	 */
	$script_data = array( 
		'image_path' => get_template_directory_uri() . '/style/images/',
		'logo_height' => get_option('logo_min_height','18'),
		'resize_header' => get_option('resize_header','1'),
		'gallery_height' => get_option('gallery_height', '600'),
		'nav_base_link' => get_option('nav_base_link', '0'),
		'ajax_back_text' => get_option('ajax_back_text','Back'),
		'ajax_prev_text' => get_option('ajax_prev_text','Prev'),
		'ajax_next_text' => get_option('ajax_next_text','Next'),
	);
	wp_localize_script( 'ebor-scripts', 'image_path', $script_data );
}
add_action('wp_enqueue_scripts', 'ebor_load_scripts');

function ebor_load_non_standard_scripts() {
	echo '<!--[if IE 8]><link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . 'style/css/ie8.css" media="all" /><![endif]-->
		  <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->';
}
add_action('wp_head', 'ebor_load_non_standard_scripts', 95);