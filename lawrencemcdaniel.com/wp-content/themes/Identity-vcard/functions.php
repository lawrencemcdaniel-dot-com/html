<?php


/*------------------------------------------------------*/
/* Identity functions.php Started */
/*------------------------------------------------------*/


/*------------------------------------------------------
Identity, After Theme Setup - Started
-------------------------------------------------------*/

add_action('after_setup_theme', 'identity_setup');

function identity_setup(){

	/* Add theme-supported features here. */
	add_theme_support( 'post-thumbnails' ); 	
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-header');
	add_theme_support( 'post-formats', array('video','gallery','audio' ) );
	
	
	/* Add theme-supported to Portfolio. */
	add_post_type_support( 'portfolio', 'post-formats' );
	
	/* Add custom actions here. */
	add_action('wp_enqueue_scripts', 'identity_load_theme_fonts', 30);
	add_action('wp_enqueue_scripts', 'identity_load_theme_scripts' );
	add_action('wp_enqueue_scripts', 'identity_load_theme_styles');	
	add_action('init', 'identity_register_menus' );
	add_action( 'add_meta_boxes', 'identity_add_sidebar_metabox' );  
	add_action( 'save_post', 'identity_save_sidebar_postdata' );  
	add_action( 'tgmpa_register', 'identity_register_required_plugins' );	
	
	
	/* Add custom filters here. */	
	add_filter('wp_list_categories','categories_postcount_filter');
	add_filter( 'get_search_form', 'identity_search_form' );
	add_filter( 'wp_generate_attachment_metadata', 'identity_retina_support_attachment_meta', 10, 2 );
	add_filter( 'delete_attachment', 'identity_delete_retina_support_images' );
	add_filter( 'request', 'identity_request_filter' );
	add_filter( 'excerpt_length', 'identity_custom_excerpt_length', 999 );
	add_filter('excerpt_more', 'identity_excerpt_more_string');
	add_filter('widget_text', 'do_shortcode');
	add_filter('pre_get_posts', 'limit_posts_per_archive_page');
	
	/* Add ceditor Styles here. */	
	add_editor_style();
	
	/* Add Identity Content Width. */
	if ( ! isset( $content_width ) ){ $content_width = 1200;}	

	/* Add Custom Background. */
	add_theme_support( 'custom-background');
	
	/* Load Text Domain. */
	load_theme_textdomain('sentient', get_template_directory() . '/languages');
	
}

/*------------------------------------------------------
Identity, After Theme Setup - End
-------------------------------------------------------*/



/*------------------------------------------------------*/
/* TGM_Plugin_Activation class Started*/
/*------------------------------------------------------*/

require_once ('admin/tgm/class-tgm-plugin-activation.php');

function identity_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	 
	$identity_layerslider_path = get_template_directory() . '/admin/lib/plugins/layersliderwp.zip';
	$identity_vc_path = get_template_directory() . '/admin/lib/plugins/visual-composer.zip';
	$identity_revslider_path = get_template_directory() . '/admin/lib/plugins/revslider.zip';
	$identity_posts_path = get_template_directory() . '/admin/lib/plugins/ProfTeamExtensions.zip';
	$identity_envato_updater = get_template_directory() . '/admin/lib/plugins/envato-wordpress-toolkit-master.zip';
	
	
	
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme	
		array(
			'name'     				=> 'Layerslider', // The plugin name
			'slug'     				=> 'LayerSlider', // The plugin slug (typically the folder name)
			'source'   				=> $identity_layerslider_path, // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '4.6.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'Visual Composer', // The plugin name
			'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
			'source'   				=> $identity_vc_path, // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '3.6.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'Revolution Slider', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> $identity_revslider_path, // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '4.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),		
		
		array(
			'name'     				=> 'ProfTeam Extensions', // The plugin name
			'slug'     				=> 'ProfTeamExtensions', // The plugin slug (typically the folder name)
			'source'   				=> $identity_posts_path, // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),		

		array(
			'name'     				=> 'Envato WordPress Toolkit', // The plugin name
			'slug'     				=> 'envato-wordpress-toolkit-master', // The plugin slug (typically the folder name)
			'source'   				=> $identity_envato_updater, // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.7.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),		
				
        array(
            'name'      => 'contact-form-7',
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),
			
	);
	
	
	$theme_text_domain = 'sentient';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       // Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', 'sentient'),
			'menu_title'                       			=> __( 'Install Plugins', 'sentient' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'sentient' ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'sentient' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', 'sentient' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'sentient' ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'sentient' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}

/**************************************/
/*TGM_Plugin_Activation class End*/
/**************************************/



/***************************************************/
/*Set Visual Composer as Theme Function - Started*/
/***************************************************/

if(function_exists('vc_set_as_theme')) vc_set_as_theme();

/***************************************************/
/*Set Visual Composer as Theme Function - End*/
/***************************************************/



/***************************************************/
/*Load Identity Fonts - Started*/
/***************************************************/
function identity_load_theme_fonts() {

	global $prof_default;
	$Protocol = is_ssl() ? 'https' : 'http';	
	
	if(of_get_option('select_font',$prof_default) == 'Open+Sans'){
		wp_enqueue_style( 'siteFont', "$Protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800,bold");		
	} elseif(of_get_option('select_font',$prof_default) == 'Merriweather+Sans') {
		wp_enqueue_style( 'siteFont', "$Protocol://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,300italic,400italic,700,700italic,800,800italic");			
	} elseif(of_get_option('select_font',$prof_default) == 'Source+Sans+Pro') {	
		wp_enqueue_style( 'siteFont', "$Protocol://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic");				
	} else {
		wp_enqueue_style( 'siteFont', "$Protocol://fonts.googleapis.com/css?family=" . of_get_option('select_font',$prof_default));		
	}
	
	if(of_get_option('menu_font',$prof_default) == 'Open+Sans'){
		wp_enqueue_style( 'menuFont', "$Protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800,bold");		
	} elseif(of_get_option('menu_font',$prof_default) == 'Merriweather+Sans') {
		wp_enqueue_style( 'menuFont', "$Protocol://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,300italic,400italic,700,700italic,800,800italic");			
	} elseif(of_get_option('menu_font',$prof_default) == 'Source+Sans+Pro') {	
		wp_enqueue_style( 'menuFont', "$Protocol://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic");					
	} else {
		wp_enqueue_style( 'menuFont', "$Protocol://fonts.googleapis.com/css?family=" . of_get_option('menuFont',$prof_default));		
	}
	
	if(of_get_option('h1_font',$prof_default) == 'Open+Sans'){
		wp_enqueue_style( 'headingOneFont', "$Protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800,bold");		
	} elseif(of_get_option('h1_font',$prof_default) == 'Merriweather+Sans') {
		wp_enqueue_style( 'headingOneFont', "$Protocol://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,300italic,400italic,700,700italic,800,800italic");			
	} elseif(of_get_option('h1_font',$prof_default) == 'Source+Sans+Pro') {	
		wp_enqueue_style( 'headingOneFont', "$Protocol://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic");					
	} elseif(of_get_option('h1_font',$prof_default) == 'Oswald'){	
		wp_enqueue_style( 'headingOneFont', "$Protocol://fonts.googleapis.com/css?family=Oswald:400,300,700&subset=latin,latin-ext");							
	} else {
		wp_enqueue_style( 'headingOneFont', "$Protocol://fonts.googleapis.com/css?family=" . of_get_option('h1_font',$prof_default));		
	}
	
	if(of_get_option('h2_font',$prof_default) == 'Open+Sans'){
		wp_enqueue_style( 'headingTwoFont', "$Protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800,bold");		
	} elseif(of_get_option('h2_font',$prof_default) == 'Merriweather+Sans') {
		wp_enqueue_style( 'headingTwoFont', "$Protocol://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,300italic,400italic,700,700italic,800,800italic");			
	} elseif(of_get_option('h2_font',$prof_default) == 'Source+Sans+Pro') {	
		wp_enqueue_style( 'headingTwoFont', "$Protocol://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic");					
	} elseif(of_get_option('h2_font',$prof_default) == 'Oswald'){	
		wp_enqueue_style( 'headingTwoFont', "$Protocol://fonts.googleapis.com/css?family=Oswald:400,300,700&subset=latin,latin-ext");							
	}else {
		wp_enqueue_style( 'headingTwoFont', "$Protocol://fonts.googleapis.com/css?family=" . of_get_option('h2_font',$prof_default));		
	}	
	
	if(of_get_option('h3_font',$prof_default) == 'Open+Sans'){
		wp_enqueue_style( 'headingThreeFont', "$Protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800,bold");		
	} elseif(of_get_option('h3_font',$prof_default) == 'Merriweather+Sans') {
		wp_enqueue_style( 'headingThreeFont', "$Protocol://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,300italic,400italic,700,700italic,800,800italic");			
	} elseif(of_get_option('h3_font',$prof_default) == 'Source+Sans+Pro') {	
		wp_enqueue_style( 'headingThreeFont', "$Protocol://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic");					
	} elseif(of_get_option('h3_font',$prof_default) == 'Oswald'){	
		wp_enqueue_style( 'headingThreeFont', "$Protocol://fonts.googleapis.com/css?family=Oswald:400,300,700&subset=latin,latin-ext");							
	} else {
		wp_enqueue_style( 'headingThreeFont', "$Protocol://fonts.googleapis.com/css?family=" . of_get_option('h3_font',$prof_default));		
	}	
	
	if(of_get_option('h4_font',$prof_default) == 'Open+Sans'){
		wp_enqueue_style( 'headingFourFont', "$Protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800,bold");		
	} elseif(of_get_option('h4_font',$prof_default) == 'Merriweather+Sans') {
		wp_enqueue_style( 'headingFourFont', "$Protocol://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,300italic,400italic,700,700italic,800,800italic");			
	} elseif(of_get_option('h4_font',$prof_default) == 'Source+Sans+Pro') {	
		wp_enqueue_style( 'headingFourFont', "$Protocol://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic");					
	} elseif(of_get_option('h4_font',$prof_default) == 'Oswald'){	
		wp_enqueue_style( 'headingFourFont', "$Protocol://fonts.googleapis.com/css?family=Oswald:400,300,700&subset=latin,latin-ext");							
	} else {
		wp_enqueue_style( 'headingFourFont', "$Protocol://fonts.googleapis.com/css?family=" . of_get_option('h4_font',$prof_default));		
	}		
	
	if(of_get_option('h5_font',$prof_default) == 'Open+Sans'){
		wp_enqueue_style( 'headingFiveFont', "$Protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800,bold");		
	} elseif(of_get_option('h5_font',$prof_default) == 'Merriweather+Sans') {
		wp_enqueue_style( 'headingFiveFont', "$Protocol://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,300italic,400italic,700,700italic,800,800italic");			
	} elseif(of_get_option('h5_font',$prof_default) == 'Source+Sans+Pro') {	
		wp_enqueue_style( 'headingFiveFont', "$Protocol://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic");					
	} elseif(of_get_option('h5_font',$prof_default) == 'Oswald'){	
		wp_enqueue_style( 'headingFiveFont', "$Protocol://fonts.googleapis.com/css?family=Oswald:400,300,700&subset=latin,latin-ext");							
	} else {
		wp_enqueue_style( 'headingFiveFont', "$Protocol://fonts.googleapis.com/css?family=" . of_get_option('h5_font',$prof_default));		
	}		
	
	if(of_get_option('h6_font',$prof_default) == 'Open+Sans'){
		wp_enqueue_style( 'headingSixFont', "$Protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800,bold");		
	} elseif(of_get_option('h6_font',$prof_default) == 'Merriweather+Sans') {
		wp_enqueue_style( 'headingSixFont', "$Protocol://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,300italic,400italic,700,700italic,800,800italic");			
	} elseif(of_get_option('h6_font',$prof_default) == 'Source+Sans+Pro') {	
		wp_enqueue_style( 'headingSixFont', "$Protocol://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic");					
	} elseif(of_get_option('h6_font',$prof_default) == 'Oswald'){	
		wp_enqueue_style( 'headingSixFont', "$Protocol://fonts.googleapis.com/css?family=Oswald:400,300,700&subset=latin,latin-ext");							
	} else {
		wp_enqueue_style( 'headingSixFont', "$Protocol://fonts.googleapis.com/css?family=" . of_get_option('h6_font',$prof_default));		
	}	
	
}

/***************************************************/
/*Load Identity Fonts - End*/
/***************************************************/



/***************************************************/
/*Load Identity Styles - Started*/
/***************************************************/
function identity_load_theme_styles() {

	global $prof_default;

	wp_register_style('identity-usage', get_template_directory_uri().'/styles/identity-usage.css');
	wp_register_style('identity-icons', get_template_directory_uri().'/styles/identity-icons.css');	
	
	
	wp_register_style('identity-custom', get_template_directory_uri().'/identity-styles.css');
	
	
	wp_register_style('plugins', get_template_directory_uri().'/styles/identity/plugins.css');	
	wp_register_style('bootstrap', get_template_directory_uri().'/styles/identity/bootstrap.min.css');
	wp_register_style('identity-style', get_template_directory_uri().'/styles/identity/style.css');
	wp_register_style('style-responsive', get_template_directory_uri().'/styles/identity/style-responsive.css');

	
	wp_register_style('style', get_stylesheet_uri());
	
	
	wp_enqueue_style( 'style');	
	wp_enqueue_style( 'identity-icons');	
	wp_enqueue_style( 'identity-usage');
	
	wp_enqueue_style('plugins');	
	wp_enqueue_style('bootstrap');
	wp_enqueue_style('identity-style');
	wp_enqueue_style('style-responsive');	
	
	wp_enqueue_style( 'identity-custom');	
}

/***************************************************/
/*Load Identity Styles - End*/
/***************************************************/



/***************************************************/
/*Load Identity Scripts - Started*/
/***************************************************/
function identity_load_theme_scripts() {
	global $is_IE;

	
	wp_enqueue_script('jquery.visible', get_template_directory_uri().'/js/jquery.visible.js',false,false,true);	
	
	wp_enqueue_script('prof.common', get_template_directory_uri().'/js/prof.common.js',false,false,true);		
	wp_enqueue_script('retina', get_template_directory_uri().'/js/retina.js', '', '', true);		
	
		
		
	wp_enqueue_script('scripts-top', get_template_directory_uri().'/js/identity/scripts-top.js', '', '', true);
	
	wp_enqueue_script('scripts-bottom', get_template_directory_uri().'/js/identity/scripts-bottom.js', '', '', true);
	wp_enqueue_script('bootstrap.min', get_template_directory_uri().'/js/identity/bootstrap.min.js', '', '', true);
	wp_enqueue_script('jquery.isotope.min', get_template_directory_uri().'/js/identity/jquery.isotope.min.js', '', '', true);
	wp_enqueue_script('jquery.sticky', get_template_directory_uri().'/js/identity/jquery.sticky.js', '', '', true);
	wp_enqueue_script('jquery.nicescroll.min', get_template_directory_uri().'/js/identity/jquery.nicescroll.min.js', '', '', true);
	wp_enqueue_script('jquery.flexslider.min', get_template_directory_uri().'/js/identity/jquery.flexslider.min.js', '', '', true);
	wp_enqueue_script('jquery.validate.min', get_template_directory_uri().'/js/identity/jquery.validate.min.js', '', '', true);
	wp_enqueue_script('mapsgoogle', '//maps.googleapis.com/maps/api/js?sensor=false', '', '', true);
	wp_enqueue_script('gmap-settings', get_template_directory_uri().'/js/identity/gmap-settings.js', '', '', true);	
	wp_enqueue_script('script', get_template_directory_uri().'/js/identity/script.js', '', '', true);		
		
	
 	wp_enqueue_script('numinate', get_template_directory_uri().'/js/numinate.js', '', '', true);  
      
   
	if ( $is_IE ) {
		wp_enqueue_script('html5','http://html5shim.googlecode.com/svn/trunk/html5.js',false,false,true);
	}

}

/***************************************************/
/*Load Identity Scripts - End*/
/***************************************************/



/***************************************************/
/*Identity Retina Functions - Started*/
/***************************************************/

/**
* Retina images
*
* This function is attached to the 'wp_generate_attachment_metadata' filter hook.
*/

function identity_retina_support_attachment_meta( $metadata, $attachment_id ) {
	foreach ( $metadata as $key => $value ) {
		if ( is_array( $value ) ) {
			foreach ( $value as $image => $attr ) {
				if ( is_array( $attr ) )
					identity_retina_support_create_images( get_attached_file( $attachment_id ), $attr['width'], $attr['height'], true );
			}
		}
	}

	return $metadata;
}


/**
 * Create retina-ready images
 *
 * Referenced via retina_support_attachment_meta().
 */
function identity_retina_support_create_images( $file, $width, $height, $crop = false ) {
    if ( $width || $height ) {
        $resized_file = wp_get_image_editor( $file );
        if ( ! is_wp_error( $resized_file ) ) {
            $filename = $resized_file->generate_filename( $width . 'x' . $height . '@2x' );
 
            $resized_file->resize( $width * 2, $height * 2, $crop );
            $resized_file->save( $filename );
 
            $info = $resized_file->get_size();
 
            return array(
                'file' => wp_basename( $filename ),
                'width' => $info['width'],
                'height' => $info['height'],
            );
        }
    }
    return false;
}

/**
 * Delete retina-ready images
 *
 * This function is attached to the 'delete_attachment' filter hook.
 */
function identity_delete_retina_support_images( $attachment_id ) {
    $meta = wp_get_attachment_metadata( $attachment_id );
    $upload_dir = wp_upload_dir();
	
	if(is_array($meta)){	
		$path = pathinfo( $meta['file'] );

		foreach ( $meta as $key => $value ) {
			if ( 'sizes' === $key ) {
				foreach ( $value as $sizes => $size ) {
					$original_filename = $upload_dir['basedir'] . '/' . $path['dirname'] . '/' . $size['file'];
					$retina_filename = substr_replace( $original_filename, '@2x.', strrpos( $original_filename, '.' ), strlen( '.' ) );
					if ( file_exists( $retina_filename ) )
						unlink( $retina_filename );
				}
			}
		}
	}
}
/***************************************************/
/*Identity Retina Functions - End*/
/***************************************************/



/***************************************************/
/*Identity General Array's that will be used - Started*/
/***************************************************/
$identity_yes_no_arr = array(__("No", "sentient") => "no", __("Yes", "sentient") => "yes");
$identity_circle_icon_arr = array(__("Circle", "sentient") => "circle", __("Box", "sentient") => "box");
$identity_social_arr = array(__("github", "sentient") => "github-square", __("facebook", "sentient") => "facebook-square", __("twitter", "sentient") => "twitter-square", __("google-plus", "sentient") => "google-plus-square", __("pinterest", "sentient") => "pinterest-square", __("linkedin", "sentient") => "linkedin-square", __("vimeo", "sentient") => "vimeo-square", __("Instagram", "sentient") => "instagram",  __("YouTube", "sentient") => "youtube-square", __("Behance", "sentient") => "behance-square");
$identity_animation_arr = array( __("Top", "sentient") => "item_top", __("Bottom", "sentient") => "item_bottom", __("Left", "sentient") => "item_left", __("Right", "sentient") => "item_right", __("Fade In", "sentient") => "item_fade_in" , __("None", "sentient") => "item_do_nothing");
$identity_icon_arr = array(
__("Align Left", "sentient") => "align-left",
__("Align Center", "sentient") => "align-center",
__("Align Right", "sentient") => "align-right",
__("Align Justify", "sentient") => "align-justify",
__("Arrows", "sentient") => "arrows",
__("Arrow Left", "sentient") => "arrow-left",
__("Arrow Right", "sentient") => "arrow-right",
__("Arrow Up", "sentient") => "arrow-up",
__("Arrow Down", "sentient") => "arrow-down",
__("Asterisk", "sentient") => "asterisk",
__("Arrows V", "sentient") => "arrows-v",
__("Arrows H", "sentient") => "arrows-h",
__("Arrow Circle Left", "sentient") => "arrow-circle-left",
__("Arrow Circle Right", "sentient") => "arrow-circle-right",
__("Arrow Circle Up", "sentient") => "arrow-circle-up",
__("Arrow Circle Down", "sentient") => "arrow-circle-down",
__("Arrows Alt", "sentient") => "arrows-alt",
__("Ambulance", "sentient") => "ambulance",
__("Adn", "sentient") => "adn",
__("Angle Double Left", "sentient") => "angle-double-left",
__("Angle Double Right", "sentient") => "angle-double-right",
__("Angle Double Up", "sentient") => "angle-double-up",
__("Angle Double Down", "sentient") => "angle-double-down",
__("Angle Left", "sentient") => "angle-left",
__("Angle Right", "sentient") => "angle-right",
__("Angle Up", "sentient") => "angle-up",
__("Angle Down", "sentient") => "angle-down",
__("Anchor", "sentient") => "anchor",
__("Android", "sentient") => "android",
__("Apple", "sentient") => "apple",
__("Archive", "sentient") => "archive",
__("Automobile", "sentient") => "automobile",
__("Bars", "sentient") => "bars",
__("Backward", "sentient") => "backward",
__("Ban", "sentient") => "ban",
__("Bar Code", "sentient") => "barcode",
__("Bank", "sentient") => "bank",
__("Bell", "sentient") => "bell",
__("Book", "sentient") => "book",
__("Bookmark", "sentient") => "bookmark",
__("Bold", "sentient") => "bold",
__("Bullhorn", "sentient") => "bullhorn",
__("Briefcase", "sentient") => "briefcase",
__("Bolt", "sentient") => "bolt",
__("Beer", "sentient") => "beer",
__("Behance", "sentient") => "behance",
__("Behance Square", "sentient") => "behance-square",
__("Bitcoin", "sentient") => "bitcoin",
__("Bitbucket", "sentient") => "bitbucket",
__("Bitbucket-square", "sentient") => "bitbucket-square",
__("Bomb", "sentient") => "bomb",
__("BTC", "sentient") => "glass",
__("Bullseye", "sentient") => "bullseye",
__("Bug", "sentient") => "bug",
__("Building", "sentient") => "building",
__("Check", "sentient") => "check",
__("Cog", "sentient") => "cog",
__("Camera", "sentient") => "camera",
__("Chevron Left", "sentient") => "chevron-left",
__("Chevron Right", "sentient") => "chevron-right",
__("Check Circle", "sentient") => "check-circle",
__("Cross Hairs", "sentient") => "crosshairs",
__("Compress", "sentient") => "compress",
__("Calendar", "sentient") => "calendar",
__("Comment", "sentient") => "comment",
__("Chevron Up", "sentient") => "hevron-up",
__("Chevron Down", "sentient") => "chevron-down",
__("Camera Retro", "sentient") => "camera-retro",
__("Cogs", "sentient") => "cogs",
__("Comments", "sentient") => "comments",
__("Credit Card", "sentient") => "credit-card",
__("Certificate", "sentient") => "certificate",
__("Chain", "sentient") => "chain",
__("Cloud", "sentient") => "cloud",
__("Cut", "sentient") => "cut",
__("Copy", "sentient") => "copy",
__("Caret Down", "sentient") => "caret-down",
__("Caret Up", "sentient") => "caret-up",
__("Caret Left", "sentient") => "caret-left",
__("Caret Right", "sentient") => "caret-right",
__("Columns", "sentient") => "columns",
__("Clipboard", "sentient") => "clipboard",
__("Cloud Download", "sentient") => "cloud-download",
__("Cloud Upload", "sentient") => "cloud-upload",
__("Coffee", "sentient") => "coffee",
__("Cutlery", "sentient") => "cutlery",
__("Car", "sentient") => "car",
__("Cab", "sentient") => "cab",
__("Chevron Circle Left", "sentient") => "chevron-circle-left",
__("Chevron Circle Right", "sentient") => "chevron-circle-right",
__("Chevron Circle Up", "sentient") => "chevron-circle-up",
__("Chevron Circle Down", "sentient") => "chevron-circle-down",
__("Check Square", "sentient") => "check-square",
__("Child", "sentient") => "child",
__("Chain Broken", "sentient") => "chain-broken",
__("Circle", "sentient") => "circle",
__("Circle Thin", "sentient") => "circle-thin",
__("CNY", "sentient") => "cny",
__("Code", "sentient") => "code",
__("Compass", "sentient") => "compass",
__("Code Pen", "sentient") => "codepen",
__("css3", "sentient") => "css3",
__("Cube", "sentient") => "cube",
__("Cubes", "sentient") => "cubes",
__("Download", "sentient") => "download",
__("Dedent", "sentient") => "dedent",
__("Dashboard", "sentient") => "dashboard",
__("Database", "sentient") => "database",
__("Deviantart", "deviantart") => "glass",
__("Desktop", "sentient") => "desktop",
__("Delicious", "sentient") => "delicious",
__("Drupal", "sentient") => "drupal",
__("Dribbble", "sentient") => "dribbble",
__("Dropbox", "sentient") => "dropbox",
__("Dollar", "sentient") => "dollar",
__("Digg", "sentient") => "digg",
__("Exchange", "sentient") => "exchange",
__("Eject", "sentient") => "eject",
__("Expand", "sentient") => "expand",
__("Exclamation Circle", "sentient") => "exclamation-circle",
__("Eye", "sentient") => "eye",
__("Eye Slash", "sentient") => "eye-slash",
__("Exclamation Triangle", "sentient") => "exclamation-triangle",
__("External Link", "sentient") => "external-link",
__("Envelope", "sentient") => "envelope",
__("Empire", "sentient") => "empire",
__("Envelope Square", "sentient") => "envelope-square",
__("External Link Square", "sentient") => "external-link-square",
__("Eraser", "sentient") => "eraser",
__("Exclamation", "sentient") => "exclamation",
__("Ellipsis Horizontal", "sentient") => "ellipsis-h",
__("Ellipsis Vertical", "sentient") => "ellipsis-v",
__("Euro", "sentient") => "euro",
__("Eur", "sentient") => "eur",
__("Flash", "sentient") => "flash",
__("Fighter Jet", "sentient") => "fighter-jet",
__("Film", "sentient") => "film",
__("Flag", "sentient") => "flag",
__("Font", "sentient") => "font",
__("Fast Backward", "sentient") => "fast-backward",
__("Forward", "sentient") => "forward",
__("Fast Forward", "sentient") => "fast-forward",
__("Fire", "sentient") => "fire",
__("folder", "sentient") => "folder",
__("Folder Open", "sentient") => "folder-open",
__("Facebook Square", "sentient") => "facebook-square",
__("Facebook", "sentient") => "facebook",
__("Filter", "sentient") => "filter",
__("Flask", "sentient") => "flask",
__("Fax", "sentient") => "fax",
__("Female", "sentient") => "female",
__("Foursquare", "sentient") => "foursquare",
__("Fire Extinguisher", "sentient") => "fire-extinguisher",
__("Flag Checkered", "sentient") => "flag-checkered",
__("Folder Open", "sentient") => "folder-open-o",
__("File", "sentient") => "file",
__("File Text", "sentient") => "file-text",
__("Flickr", "sentient") => "flickr",
__("Google Plus Square", "google-plus-square") => "glass",
__("Google Plus", "sentient") => "google-plus",
__("Gavel", "sentient") => "gavel",
__("Glass", "sentient") => "glass",
__("Gear", "sentient") => "gear",
__("Gift", "sentient") => "gift",
__("Gears", "sentient") => "gears",
__("Github-Square", "sentient") => "github-square",
__("Github", "sentient") => "github",
__("Globe", "sentient") => "globe",
__("Group", "sentient") => "group",
__("Git Square", "sentient") => "git-square",
__("GE", "sentient") => "ge",
__("Google", "sentient") => "google",
__("Graduation Cap", "sentient") => "graduation-cap",
__("Git Tip", "sentient") => "gittip",
__("GBP", "sentient") => "gbp",
__("Gamepad", "sentient") => "gamepad",
__("Github Alt", "sentient") => "github-alt",
__("Git", "sentient") => "git",
__("Heart", "sentient") => "heart",
__("Home", "sentient") => "home",
__("Headphones", "sentient") => "headphones",
__("Header", "sentient") => "header",
__("History", "sentient") => "history",
__("hacker-news", "sentient") => "hacker-news",
__("html5", "sentient") => "html5",
__("H Square", "sentient") => "h-square",
__("Italic", "sentient") => "italic",
__("Indent", "sentient") => "indent",
__("image", "sentient") => "image",
__("Info Circle", "sentient") => "info-circle",
__("Inverse", "sentient") => "inverse",
__("Inbox", "sentient") => "inbox",
__("Institution", "sentient") => "institution",
__("Instagram", "sentient") => "instagram",
__("INR", "sentient") => "inr",
__("Info", "sentient") => "info",
__("JS Fiddle", "sentient") => "jsfiddle",
__("Joomla", "sentient") => "joomla",
__("JPY", "sentient") => "jpy",
__("Key", "sentient") => "key",
__("KRW", "sentient") => "krw",
__("Linkedin Square", "sentient") => "linkedin-square",
__("Link", "sentient") => "link",
__("List ul", "sentient") => "list-ul",
__("List ol", "sentient") => "list-ol",
__("Linkedin", "sentient") => "linkedin",
__("Legal", "sentient") => "legal",
__("List", "sentient") => "list-alt",
__("Lock", "sentient") => "lock",
__("List", "sentient") => "list",
__("Leaf", "sentient") => "leaf",
__("Life Bouy", "sentient") => "life-bouy",
__("Life Saver", "sentient") => "life-saver",
__("Language", "sentient") => "language",
__("Laptop", "sentient") => "laptop",
__("Level Up", "sentient") => "level-up",
__("Level Down", "sentient") => "level-down",
__("Long Arrow Down", "sentient") => "long-arrow-down",
__("Long Arrow Up", "sentient") => "long-arrow-up",
__("Long Arrow Left", "sentient") => "long-arrow-left",
__("Long Arrow Right", "sentient") => "long-arrow-right",
__("Linux", "sentient") => "linux",
__("Life Ring", "sentient") => "life-ring",
__("Magnet", "sentient") => "magnet",
__("Magic", "sentient") => "magic",
__("Money", "sentient") => "money",
__("Medkit", "sentient") => "medkit",
__("Music", "sentient") => "music",
__("Minus Circle", "sentient") => "minus-circle",
__("Mail Forward", "sentient") => "mail-forward",
__("Minus", "sentient") => "minus",
__("Mortar Board", "sentient") => "mortar-board",
__("Male", "sentient") => "male",
__("Minus Square", "sentient") => "minus-square",
__("Maxcdn", "sentient") => "maxcdn",
__("Mobile Phone", "sentient") => "mobile-phone",
__("mobile", "sentient") => "mobile",
__("Mail Reply", "sentient") => "mail-reply",
__("Microphone", "sentient") => "microphone",
__("Microphone Slash", "sentient") => "microphone-slash",
__("Navicon", "sentient") => "navicon",
__("Open Comment", "sentient") => "comment-o",
__("Open comments", "sentient") => "comments-o",
__("Open Lightbulb", "sentient") => "lightbulb-o",
__("Open Bell", "sentient") => "bell-o",
__("Open File Text", "sentient") => "file-text-o",
__("Open Building", "sentient") => "building-o",
__("Open Hospital", "sentient") => "hospital-o",
__("Open Envelope", "sentient") => "envelope-o",
__("Open Star", "sentient") => "star-o",
__("Open Trash", "sentient") => "trash-o",
__("Open File", "sentient") => "file-o",
__("Open Clock", "sentient") => "clock-o",
__("Open Arrow Circle Down", "sentient") => "arrow-circle-o-down",
__("Open Arrow Circle Up", "sentient") => "arrow-circle-o-up",
__("Open Play Circle", "sentient") => "play-circle-o",
__("Outdent", "sentient") => "outdent",
__("Open Picture", "sentient") => "picture-o",
__("Open Pencil Square", "sentient") => "pencil-square-o",
__("Open Share Square", "sentient") => "share-square-o",
__("Open Check Square", "sentient") => "check-square-o",
__("Open Times Circle", "sentient") => "times-circle-o",
__("Open Check Circle", "sentient") => "check-circle-o",
__("Open Bar Chart", "sentient") => "bar-chart-o",
__("Open Thumbs Up", "sentient") => "thumbs-o-up",
__("Open Thumbs Down", "sentient") => "thumbs-o-down",
__("Open Heart", "sentient") => "heart-o",
__("Open Lemon", "sentient") => "lemon-o",
__("Open Square", "sentient") => "square",
__("Open Bookmark", "sentient") => "bookmark-o",
__("Open hdd", "sentient") => "hdd-o",
__("Open Hand Right", "sentient") => "hand-o-right",
__("Open Hand Left", "sentient") => "hand-o-left",
__("Open Hand Up", "sentient") => "hand-o-up",
__("Open Hand Down", "sentient") => "hand-o-down",
__("Open Files", "sentient") => "files-o",
__("Open Floppy", "sentient") => "floppy-o",
__("Open Circle", "sentient") => "circle-o",
__("Open Folder", "sentient") => "folder-o",
__("Open Smile", "sentient") => "smile-o",
__("Open Frown", "sentient") => "frown-o",
__("Open Meh", "sentient") => "meh-o",
__("Open Keyboard", "sentient") => "keyboard-o",
__("Open Flag", "sentient") => "flag-o",
__("Open Calendar", "sentient") => "calendar-o",
__("Open Minus Square", "sentient") => "minus-square-o",
__("Open Caret Square Down", "sentient") => "caret-square-o-down",
__("Open Caret Square Up", "sentient") => "caret-square-o-up",
__("Open Caret Square Right", "sentient") => "caret-square-o-right",
__("Open Sun", "sentient") => "sun-o",
__("Open Moon", "sentient") => "moon-o",
__("Open Arrow Circle Right", "sentient") => "arrow-circle-o-right",
__("Open Arrow Circle Left", "sentient") => "arrow-circle-o-left",
__("Open Caret Square Left", "sentient") => "caret-square-o-left",
__("Open Dot Circle", "sentient") => "dot-circle-o",
__("Open Plus Square", "sentient") => "plus-square-o",
__("Open ID", "sentient") => "openid",
__("Open File pdf", "sentient") => "file-pdf-o",
__("Open File Word", "sentient") => "file-word-o",
__("Open File Eexcel", "sentient") => "file-excel-o",
__("Open File Powerpoint", "sentient") => "file-powerpoint-o",
__("Open File Photo", "sentient") => "file-photo-o",
__("Open File Picture", "sentient") => "file-picture-o",
__("Open File Image", "sentient") => "file-image-o",
__("Open File Zip", "sentient") => "file-zip-o",
__("Open File Archive", "sentient") => "file-archive-o",
__("Open File Sound", "sentient") => "file-sound-o",
__("Open File Audio", "sentient") => "file-audio-o",
__("Open File Movie", "sentient") => "file-movie-o",
__("Open File Video", "sentient") => "file-video-o",
__("Open File Code", "sentient") => "file-code-o",
__("Open Circle Notch", "sentient") => "circle-o-notch",
__("Open Send", "sentient") => "send-o",
__("Open Paper Plane", "sentient") => "paper-plane-o",
__("Pinterest", "sentient") => "pinterest",
__("Pinterest Square", "sentient") => "pinterest-square",
__("Paste", "sentient") => "paste",
__("Power Off", "sentient") => "power-off",
__("Print", "sentient") => "print",
__("Photo", "sentient") => "photo",
__("Play", "sentient") => "play",
__("Pause", "sentient") => "pause",
__("Plus Circle", "sentient") => "plus-circle",
__("Plus", "sentient") => "plus",
__("Plane", "sentient") => "plane",
__("Phone", "sentient") => "phone",
__("phone-square", "sentient") => "Phone Square",
__("Paper Clip", "sentient") => "paperclip",
__("Puzzle Piece", "sentient") => "puzzle-piece",
__("Play Circle", "sentient") => "play-circle",
__("Pencil Square", "sentient") => "pencil-square",
__("Page Lines", "sentient") => "pagelines",
__("Pied Piper Square", "sentient") => "pied-piper-square",
__("Pied Piper", "sentient") => "pied-piper",
__("Pied Piper Alt", "sentient") => "pied-piper-alt",
__("Paw", "sentient") => "paw",
__("Paper Plane", "sentient") => "paper-plane",
__("Paragraph", "sentient") => "paragraph",
__("Plus Square", "sentient") => "plus-square",
__("QR Code", "sentient") => "qrcode",
__("Question Circle", "sentient") => "question-circle",
__("Question", "sentient") => "question",
__("QQ", "sentient") => "qq",
__("Quote Left", "sentient") => "quote-left",
__("Quote Right", "sentient") => "quote-right",
__("Random", "sentient") => "random",
__("Retweet", "sentient") => "retweet",
__("Rss", "sentient") => "rss",
__("Reorder", "sentient") => "reorder",
__("Rotate Left", "sentient") => "rotate-left",
__("Road", "sentient") => "road",
__("Rotate Right", "sentient") => "rotate-right",
__("Repeat", "sentient") => "repeat",
__("Refresh", "sentient") => "refresh",
__("Reply", "sentient") => "reply",
__("Rocket", "sentient") => "rocket",
__("Rss Square", "sentient") => "rss-square",
__("Rupee", "sentient") => "rupee",
__("RMB", "sentient") => "rmb",
__("Ruble", "sentient") => "ruble",
__("Rouble", "sentient") => "rouble",
__("Rub", "sentient") => "rub",
__("Renren", "sentient") => "renren",
__("Reddit", "sentient") => "reddit",
__("Reddit Square", "sentient") => "reddit-square",
__("Recycle", "sentient") => "recycle",
__("RA", "sentient") => "ra",
__("Rebel", "sentient") => "rebel",
__("Step Backward", "sentient") => "step-backward",
__("Stop", "sentient") => "stop",
__("Step Forward", "sentient") => "step-forward",
__("Share", "sentient") => "share",
__("Shopping Cart", "sentient") => "shopping-cart",
__("Star Half", "sentient") => "star-half",
__("Sign Out", "sentient") => "sign-out",
__("Sign In", "sentient") => "sign-in",
__("Scissors", "sentient") => "scissors",
__("Save", "sentient") => "save",
__("Square", "sentient") => "square",
__("Strikethrough", "sentient") => "strikethrough",
__("Sort", "sentient") => "sort",
__("Sort Down", "sentient") => "sort-down",
__("Sort Desc", "sentient") => "sort-desc",
__("Sort Up", "sentient") => "sort-up",
__("Sort Asc", "sentient") => "sort-asc",
__("Sitemap", "sentient") => "sitemap",
__("Search", "sentient") => "search",
__("Star", "sentient") => "star",
__("Stethoscope", "sentient") => "stethoscope",
__("Suitcase", "sentient") => "suitcase",
__("Search Plus", "sentient") => "search-plus",
__("Search Minus", "sentient") => "search-minus",
__("Signal", "sentient") => "signal",
__("Spinner", "sentient") => "Spinner",
__("Superscript", "sentient") => "superscript",
__("Subscript", "sentient") => "subscript",
__("Shield", "sentient") => "shield",
__("Share Square", "sentient") => "share-square",
__("Sort Alpha Asc", "sentient") => "sort-alpha-asc",
__("Sort Alpha Desc", "sentient") => "sort-alpha-desc",
__("Sort Amount ASC", "sentient") => "sort-amount-asc",
__("Sort Amount Desc", "sentient") => "sort-amount-desc",
__("Sort Numeric Asc", "sentient") => "sort-numeric-asc",
__("Sort Numeric Desc", "sentient") => "sort-numeric-desc",
__("Stack Overflow", "sentient") => "stack-overflow",
__("Skype", "sentient") => "skype",
__("Stack Exchange", "sentient") => "stack-exchange",
__("Space Shuttle", "sentient") => "space-shuttle",
__("Slack", "sentient") => "Slack",
__("Stumbleupon Circle", "sentient") => "stumbleupon-circle",
__("Stumbleupon", "sentient") => "stumbleupon",
__("Spoon", "sentient") => "spoon",
__("Steam", "sentient") => "steam",
__("Steam Square", "sentient") => "steam-square",
__("Spotify", "sentient") => "spotify",
__("Sound Cloud", "sentient") => "soundcloud",
__("Support", "sentient") => "support",
__("Send", "sentient") => "send",
__("Sliders", "sentient") => "sliders",
__("Share Alt", "sentient") => "share-alt",
__("Share Alt Square", "sentient") => "share-alt-square",
__("Tag", "sentient") => "tag",
__("Tags", "sentient") => "tags",
__("Text Height", "sentient") => "text-height",
__("Text Width", "sentient") => "text-width",
__("Times Circle", "sentient") => "times-circle",
__("Twitter Square", "sentient") => "twitter-square",
__("Thumb Tack", "sentient") => "thumb-tack",
__("Trophy", "sentient") => "trophy",
__("Twitter", "sentient") => "twitter",
__("Tasks", "sentient") => "tasks",
__("Truck", "sentient") => "truck",
__("Tachometer", "sentient") => "tachometer",
__("Thumbnail Large", "sentient") => "th-large",
__("Thumbnail", "sentient") => "th",
__("Thumbnail List", "sentient") => "th-list",
__("Times", "sentient") => "times",
__("Ticket", "sentient") => "ticket",
__("Toggle Down", "sentient") => "toggle-down",
__("Toggle Up", "sentient") => "toggle-up",
__("Toggle Right", "sentient") => "toggle-right",
__("Thumbs Up", "sentient") => "thumbs-up",
__("Thumbs Down", "sentient") => "thumbs-down",
__("Tumblr", "sentient") => "tumblr",
__("Tumblr Square", "sentient") => "tumblr-square",
__("Trello", "sentient") => "trello",
__("Toggle Left", "sentient") => "toggle-left",
__("Turkish Lira", "sentient") => "turkish-lira",
__("Try", "sentient") => "try",
__("Taxi", "sentient") => "taxi",
__("Tree", "sentient") => "tree",
__("Tencent Weibo", "sentient") => "tencent-weibo",
__("Tablet", "sentient") => "tablet",
__("Terminal", "sentient") => "terminal",
__("Upload", "sentient") => "upload",
__("Unlock", "sentient") => "unlock",
__("Users", "sentient") => "users",
__("Underline", "sentient") => "underline",
__("Unsorted", "sentient") => "unsorted",
__("Undo", "sentient") => "undo",
__("User md", "sentient") => "user-md",
__("Umbrella", "sentient") => "umbrella",
__("User", "sentient") => "user",
__("Unlock Alt", "sentient") => "unlock-alt",
__("USD", "sentient") => "usd",
__("University", "sentient") => "university",
__("Unlink", "sentient") => "unlink",
__("Volume Off", "sentient") => "volume-off",
__("Volume Down", "sentient") => "volume-down",
__("Volume Up", "sentient") => "volume-up",
__("Video Camera", "sentient") => "video-camera",
__("VK", "sentient") => "vk",
__("Vimeo Square", "sentient") => "vimeo-square",
__("Vine", "sentient") => "vine",
__("Warning", "sentient") => "warning",
__("Wrench", "sentient") => "wrench",
__("Won", "sentient") => "won",
__("Windows", "sentient") => "windows",
__("Weibo", "sentient") => "weibo",
__("Wheel Chair", "sentient") => "wheelchair",
__("WordPress", "sentient") => "wordpress",
__("We Chat", "sentient") => "wechat",
__("Weixin", "sentient") => "weixin",
__("Xing", "sentient") => "xing",
__("Xing Square", "sentient") => "xing-square",
__("YEN", "sentient") => "yen",
__("Youtube Square", "sentient") => "youtube-square",
__("Youtube", "sentient") => "youtube",
__("Youtube Play", "sentient") => "youtube-play",
__("Yahoo", "sentient") => "yahoo",
);


$identity_alert_arr = array(
__("Warning", "sentient") => "warning",
__("Information", "sentient") => "info",
__("Success", "sentient") => "success",
__("Danger ", "sentient") => "danger "
);

$identity_list_arr = array(
__("Default", "sentient") => "default",
__("Check", "sentient") => "check",
__("Arrow Right", "sentient") => "chevron-right",
__("Heart", "sentient") => "heart",
__("Star ", "sentient") => "star "
);

$identity_dropcaps_arr = array(
__("Boxed", "sentient") => "dropcap1",
__("Transparent", "sentient") => "dropcap2",
__("Italic", "sentient") => "dropcap3"
);
/***************************************************/
/*Identity General Array's that will be used - End*/
/***************************************************/




/***************************************************/
/*Identity Search Query Function - Started*/
/***************************************************/
if(!is_admin()){
    add_action('init', 'identity_search_query_fix');
    function identity_search_query_fix(){
        if(isset($_GET['s']) && $_GET['s']==''){
            $_GET['s']=' ';
        }
    }
}


function identity_request_filter( $query_vars ) {
    if( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
        $query_vars['s'] = " ";
    }
    return $query_vars;
}
/***************************************************/
/*Identity Search Query Function - End*/
/***************************************************/



/***************************************************/
/*Identity Add Post Thumbnails size - Started*/
/***************************************************/
	
	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 220, 220, true );
		set_post_thumbnail_size( 280, 190, true );
	}

	if ( function_exists( 'add_image_size' ) ) { 
		add_image_size( 'identity-team', 220, 220, true ); //(cropped)
		add_image_size( 'identity-portfolio-image', 280, 190, true ); //(cropped)
	}

/***************************************************/
/*Identity Add Post Thumbnails sizes - End*/
/***************************************************/



/***************************************************/
/*Identity Menu Options - Started */
/***************************************************/

function identity_register_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' , 'sentient')
    )
  );
}

/***************************************************/
/*Identity Menu Options - End */
/***************************************************/



/***************************************************/
/*Identity Menu Fall Back Function - Started */
/***************************************************/
function identity_menu_fall_back(){
	
	echo '<ul class="nav" >';
	wp_list_pages(
      array(
        'title_li'  => '',
      	'sort_column'=> 'menu_order',
      )
    );
    echo '</ul>';

}
/***************************************************/
/*Identity Menu Fall Back Function - End */
/***************************************************/



/***************************************************/
/*Identity excerpt string function - Started */
/***************************************************/

function identity_excerpt_more_string( $more ) {
	return '...';
}

/***************************************************/
/*Identity excerpt string function - End */
/***************************************************/



/***************************************************/
/*Identity excerpt length Function - Started */
/***************************************************/

function identity_custom_excerpt_length( $length ) {
	return 80;
}

/***************************************************/
/*Identity excerpt length Function - End */
/***************************************************/



/***************************************************/
/*Identity , Add Shortcodes to Visual Composer - Started */
/***************************************************/

/* Here we will check if the Visual Composer is activated */

if(function_exists('vc_map')){


	/*------------------------------------------------------
	Identity Section Title - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Identity Section Title" , "sentient"),
	   "base" => "identity_section_title",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Choose Title Icon" , "sentient"),
			 "param_name" => "icon",
			 "value" => $identity_icon_arr,
			 "description" => __("Choose Icon for your Title." , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter normal text" , "sentient"),
			 "param_name" => "normaltext",
			 "value" => "Normal",
			 "description" => __("Enter a normal text" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter highlighted text" , "sentient"),
			 "param_name" => "highlightedtext",
			 "value" => "Highlight",
			 "description" => __("Enter a highlighted text" , "sentient")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon Background Color" , "sentient"),
			 "param_name" => "iconbackgroundcolor",
			 "value" => "#CCCCCC",
			 "description" => __("Please Choose Background color for your Icon" , "sentient")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon Color" , "sentient"),
			 "param_name" => "iconcolor",
			 "value" => "#FFFFFF",
			 "description" => __("Please Choose a color for your Icon" , "sentient")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Normal Text Color" , "sentient"),
			 "param_name" => "textcolor",
			 "value" => "#666666",
			 "description" => __("Please Choose Your Normal Text Color" , "sentient")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Highlighted Text Background Color" , "sentient"),
			 "param_name" => "highlightedcolor",
			 "value" => "#666666",
			 "description" => __("Please Choose Your Highlighted Text Background Color" , "sentient")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please choose animation type" , "sentient"),
			 "param_name" => "animationtype",
			 "value" => $identity_animation_arr,
			 "description" => __("Choose animation type" , "sentient")
		  )		  
	   )
	) );
	


	/*------------------------------------------------------
	Identity Homepage Row Start - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Identity Row Begin" , "sentient"),
	   "base" => "homepage_container",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background Color?" , "sentient"),
			 "param_name" => "type",
			 "value" => $identity_yes_no_arr,
			 "description" => __("If you choose No it will put the background image." , "sentient")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background color" , "sentient"),
			 "param_name" => "color",
			 "value" => "#FFFFFF",
			 "description" => __("Please Choose Background color for your Row" , "sentient")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Font color" , "sentient"),
			 "param_name" => "font",
			 "value" => "#787878",
			 "description" => __("Please Choose Font color for your Row" , "sentient")
		  ),
		  array(
			 "type" => "attach_image",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background Image" , "sentient"),
			 "param_name" => "background",
			 "value" => "",
			 "description" => __("Please Choose Background Image for your Row" , "sentient")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Do you want the background image to be parallax?" , "sentient"),
			 "param_name" => "parallax",
			 "value" => $identity_yes_no_arr,
			 "description" => __("If you choose Yes it will make the background parallax." , "sentient")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background Image Repeat" , "sentient"),
			 "param_name" => "repeat",
			 "value" => $identity_yes_no_arr,
			 "description" => __("Do you want to Repeat Background Image?" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Padding from Top" , "sentient"),
			 "param_name" => "paddingtop",
			 "value" => "40px",
			 "description" => __("Distance between row and content from top side" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Padding from Bottom" , "sentient"),
			 "param_name" => "paddingbottom",
			 "value" => "40px",
			 "description" => __("Distance between row and content from bottom side" , "sentient")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Border Top" , "sentient"),
			 "param_name" => "bordertop",
			 "value" => $identity_yes_no_arr,
			 "description" => __("Do you want to display border on the top of the row" , "sentient")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Border Bottom" , "sentient"),
			 "param_name" => "borderbottom",
			 "value" => $identity_yes_no_arr,
			 "description" => __("Do you want to display border on the bottom of the row" , "sentient")
		  )
	   )
	) );

		
	
	
	
	/*------------------------------------------------------
	Identity White Title Title - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Identity White Title" , "sentient"),
	   "base" => "identity_white_title",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter normal text" , "sentient"),
			 "param_name" => "titletext",
			 "value" => "White Title",
			 "description" => __("Enter a normal text title" , "sentient")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please choose animation type" , "sentient"),
			 "param_name" => "animationtype",
			 "value" => $identity_animation_arr,
			 "description" => __("Choose animation type" , "sentient")
		  )		
	   )
	) );


	/*------------------------------------------------------
	Identity Image Inside Mac - Shortcode
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Identity slider" , "sentient"),
	   "base" => "identity_img_inside_mac",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(
		  array(
			 "type" => "attach_images",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Mac Image" , "sentient"),
			 "param_name" => "background",
			 "value" => "",
			 "description" => __("Please Choose Image to be displayed inside Mac Air" , "sentient")
		  ),
	   )
	) );



	/*------------------------------------------------------
	Identity Icons Style 1 Section Start - VC
	-------------------------------------------------------*/
	   vc_map( array(
	   "name" => __("Identity Icons Style 1" , "sentient"),
	   "base" => "identity_homepage_icons_section",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please choose icon" , "sentient"),
			 "param_name" => "icon",
			 "value" => $identity_icon_arr,
			 "description" => __("Choose any of the available icons" , "sentient")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please choose Style" , "sentient"),
			 "param_name" => "circle",
			 "value" => $identity_circle_icon_arr,
			 "description" => __("Choose from Circle or Boxed Style" , "sentient")
		  ),		  		  		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please choose icon animation type" , "sentient"),
			 "param_name" => "animationtype",
			 "value" => $identity_animation_arr,
			 "description" => __("Choose icons animation type" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter a Title here" , "sentient"),
			 "param_name" => "title",
			 "value" => "Title goes here",
			 "description" => __("The Title of the icon container" , "sentient")
		  ),
		  array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter Content here" , "sentient"),
			 "param_name" => "text",
			 "value" => "Content goes here",
			 "description" => __("The content of the icon container" , "sentient")
		  )
	   )
	) );


	/*------------------------------------------------------
	Identity Icons Style 2 Section Start - VC
	-------------------------------------------------------*/
	   vc_map( array(
	   "name" => __("Identity Icons Style 2" , "sentient"),
	   "base" => "identity_homepage_iconsstyle2_section",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please choose icon" , "sentient"),
			 "param_name" => "icon",
			 "value" => $identity_icon_arr,
			 "description" => __("Choose any of the available icons" , "sentient")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon color" , "sentient"),
			 "param_name" => "color",
			 "value" => "#666666",
			 "description" => __("Please Choose your icon color" , "sentient")
		  ),		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Do you want a border for the chosen icon?" , "sentient"),
			 "param_name" => "iconborder",
			 "value" => $identity_yes_no_arr,
			 "description" => __("If you choose Yes it will make a border around the icon." , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter a Title here" , "sentient"),
			 "param_name" => "title",
			 "value" => "Title goes here",
			 "description" => __("The Title of the icon container" , "sentient")
		  ),
		  array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter Content here" , "sentient"),
			 "param_name" => "text",
			 "value" => "Content goes here",
			 "description" => __("The content of the icon container" , "sentient")
		  ),array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please choose icon animation type" , "sentient"),
			 "param_name" => "animationtype",
			 "value" => $identity_animation_arr,
			 "description" => __("Choose icons animation type" , "sentient")
		  )
	   )
	) );


	/*------------------------------------------------------
	Identity Icons Style 3 Section Start - VC
	-------------------------------------------------------*/
	   vc_map( array(
	   "name" => __("Identity Icons Style 3" , "sentient"),
	   "base" => "identity_iconsstyle3_section",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please choose icon" , "sentient"),
			 "param_name" => "icon",
			 "value" => $identity_icon_arr,
			 "description" => __("Choose any of the available icons" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter a Title here" , "sentient"),
			 "param_name" => "title",
			 "value" => "Title goes here",
			 "description" => __("The Title of the icon container" , "sentient")
		  ),
		  array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter Content here" , "sentient"),
			 "param_name" => "text",
			 "value" => "Content goes here",
			 "description" => __("The content of the icon container" , "sentient")
		  )
	   )
	) );


	/*------------------------------------------------------
	Identity Left Slider - Shortcode
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Identity Slider Style 2" , "sentient"),
	   "base" => "identity_left_Slider_Section",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(
		  array(
			 "type" => "attach_images",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Left Slider" , "sentient"),
			 "param_name" => "background",
			 "value" => "",
			 "description" => __("Please Choose Image to be displayed in Identity Left Slider" , "sentient")
		  ),
	   )
	) );

	
	/*------------------------------------------------------
	Identity Animated Numbers - VC
	-------------------------------------------------------*/
	
	vc_map( array(
	   "name" => __("Identity Animated Number" , "sentient"),
	   "base" => "identity_animated_numbers",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please choose icon" , "sentient"),
			 "param_name" => "icon",
			 "value" => $identity_icon_arr,
			 "description" => __("Choose any of the available icons" , "sentient")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icons color" , "sentient"),
			 "param_name" => "iconscolor",
			 "value" => "#ffffff",
			 "description" => __("Please Choose your icon color" , "sentient")
		  ),		  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Number to Animate" , "sentient"),
			 "param_name" => "number",
			 "value" => "1000",
			 "description" => __("Enter Number to Animate" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Description" , "sentient"),
			 "param_name" => "text",
			 "value" => "Description goes here",
			 "description" => __("Enter Number Description" , "sentient")
		  )	  
	   )
	) );

	
	/*------------------------------------------------------
	Identity Animated Numbers Style 2 - VC
	-------------------------------------------------------*/
	
	vc_map( array(
	   "name" => __("Identity Animated Number Style 2" , "sentient"),
	   "base" => "identity_animated_numbers_style2",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Number to Animate" , "sentient"),
			 "param_name" => "number",
			 "value" => "1000",
			 "description" => __("Enter Number to Animate" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title" , "sentient"),
			 "param_name" => "title",
			 "value" => "Title goes here",
			 "description" => __("Enter the Title here" , "sentient")
		  ),	
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Description" , "sentient"),
			 "param_name" => "text",
			 "value" => "Description goes here",
			 "description" => __("Enter Number Description" , "sentient")
		  )	  
	   )
	) );

	/*------------------------------------------------------
	Identity Clients Slider - Shortcode
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Identity Clients Slider Section" , "sentient"),
	   "base" => "identity_clients_Slider_Section",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(
		  array(
			 "type" => "attach_images",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Clients Slider" , "sentient"),
			 "param_name" => "background",
			 "value" => "",
			 "description" => __("Please Choose Images to be displayed in Identity Clients Slider" , "sentient")
		  ),
	   )
	) );
	


	/*------------------------------------------------------
	Identity Button - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Identity Button" , "sentient"),
	   "base" => "identity_button",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(
	     array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Button border color" , "sentient"),
			 "param_name" => "bordercolor",
			 "value" => "#474d5d",
			 "description" => __("Please Choose a border color for your Button" , "sentient")
		  ),
		 array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Button color" , "sentient"),
			 "param_name" => "buttoncolor",
			 "value" => "#FFFFFF",
			 "description" => __("Please Choose a background color for your Button" , "sentient")
		  ),
		 array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Button Font color" , "sentient"),
			 "param_name" => "fontcolor",
			 "value" => "#000",
			 "description" => __("Please Choose Font color for your Button" , "sentient")
		  ),	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter Button Title" , "sentient"),
			 "param_name" => "buttontext",
			 "value" => "Button",
			 "description" => __("The Title of your Button" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter Button Link" , "sentient"),
			 "param_name" => "link",
			 "value" => "link",
			 "description" => __("The Link of your Button" , "sentient")
		  )	  		  
	   )
	) );
	
	/*------------------------------------------------------
	Identity Download Button - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Identity Download Button" , "sentient"),
	   "base" => "identity_download_button",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(
	     array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Button border color" , "sentient"),
			 "param_name" => "bordercolor",
			 "value" => "#474d5d",
			 "description" => __("Please Choose a border color for your Button" , "sentient")
		  ),
		 array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Button color" , "sentient"),
			 "param_name" => "buttoncolor",
			 "value" => "#FFFFFF",
			 "description" => __("Please Choose a background color for your Button" , "sentient")
		  ),
		 array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Button Font color" , "sentient"),
			 "param_name" => "fontcolor",
			 "value" => "#000",
			 "description" => __("Please Choose Font color for your Button" , "sentient")
		  ),	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter Button Title" , "sentient"),
			 "param_name" => "buttontext",
			 "value" => "Button",
			 "description" => __("The Title of your Button" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter Button Link" , "sentient"),
			 "param_name" => "link",
			 "value" => "link",
			 "description" => __("The Link of your Button" , "sentient")
		  )	  		  
	   )
	) );
	

	/*------------------------------------------------------
	Identity Homepage Row Wide Start - VC
	-------------------------------------------------------*/

	vc_map( array(
	   "name" => __("Identity Row Wide Begin" , "sentient"),
	   "base" => "homepage_container_wide",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background Color?" , "sentient"),
			 "param_name" => "type",
			 "value" => $identity_yes_no_arr,
			 "description" => __("If you choose No it will put the background image." , "sentient")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background color" , "sentient"),
			 "param_name" => "color",
			 "value" => "#FFFFFF",
			 "description" => __("Please Choose Background color for your Row" , "sentient")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Font color" , "sentient"),
			 "param_name" => "font",
			 "value" => "#787878",
			 "description" => __("Please Choose Font color for your Row" , "sentient")
		  ),
		  array(
			 "type" => "attach_image",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background Image" , "sentient"),
			 "param_name" => "background",
			 "value" => "",
			 "description" => __("Please Choose Background Image for your Row" , "sentient")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background Image Repeat" , "sentient"),
			 "param_name" => "repeat",
			 "value" => $identity_yes_no_arr,
			 "description" => __("Do you want to Repeat Background Image?" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Padding from Top" , "sentient"),
			 "param_name" => "paddingtop",
			 "value" => "40px",
			 "description" => __("Distance between row and content from top side" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Padding from Bottom" , "sentient"),
			 "param_name" => "paddingbottom",
			 "value" => "40px",
			 "description" => __("Distance between row and content from bottom side" , "sentient")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Border Top" , "sentient"),
			 "param_name" => "bordertop",
			 "value" => $identity_yes_no_arr,
			 "description" => __("Do you want to display border on the top of the row" , "sentient")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Border Bottom" , "sentient"),
			 "param_name" => "borderbottom",
			 "value" => $identity_yes_no_arr,
			 "description" => __("Do you want to display border on the bottom of the row" , "sentient")
		  )
	   )
	) );

	
	
	/*------------------------------------------------------
	Identity Homepage Row Start - VC
	-------------------------------------------------------*/

	vc_map( array(
	   "name" => __("Identity Video Row Begin" , "sentient"),
	   "base" => "identity_homepage_video_container",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Video URL" , "sentient"),
			 "param_name" => "video",
			 "value" => "",
			 "description" => __("Suggest to upload videos to your Server and paste here the path" , "sentient")
		  ),
		  array(
			 "type" => "attach_image",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background Image" , "sentient"),
			 "param_name" => "background",
			 "value" => "",
			 "description" => __("Please Choose Background Image for your Row" , "sentient")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Font color" , "sentient"),
			 "param_name" => "font",
			 "value" => "#787878",
			 "description" => __("Please Choose Font color for your Row" , "sentient")
		  ),	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Padding from Top" , "sentient"),
			 "param_name" => "paddingtop",
			 "value" => "40px",
			 "description" => __("Distance between row and content from top side" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Padding from Bottom" , "sentient"),
			 "param_name" => "paddingbottom",
			 "value" => "40px",
			 "description" => __("Distance between row and content from bottom side" , "sentient")
		  )
		  )
	   )
	);
	

	
	/*------------------------------------------------------
	Identity Homepage Row End - VC
	-------------------------------------------------------*/
	
	vc_map( array(
	   "name" => __("Identity Row End" , "sentient"),
	   "base" => "homepage_container_end",
	   "class" => "",
	   "show_settings_on_create" => false,   
	   "category" => __('Content' , "sentient"),
	) );


	/*------------------------------------------------------
	Identity Process - VC
	-------------------------------------------------------*/
	
	vc_map( array(
	   "name" => __("Identity Process" , "sentient"),
	   "base" => "identity_process",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter the number of processes you want to display" , "sentient"),
			 "param_name" => "noofprocesses",
			 "value" => "7",
			 "description" => __("The number of processes" , "sentient")
		  )
	   )
	) );

	/*------------------------------------------------------
	Identity Team Members - Four per Row - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Identity Team Members" , "sentient"),
	   "base" => "identity_team_members",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter No.# of Team Members to display" , "sentient"),
			 "param_name" => "noofposts",
			 "value" => "4",
			 "description" => __("Number of Team Members to display" , "sentient")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Do you want to display a Read More link for each team member?" , "sentient"),
			 "param_name" => "read",
			 "value" => $identity_yes_no_arr,
			 "description" => __("If you choose YES then a Read More link will be displayed" , "sentient")
		  )		  
	   )
	) );

	/*------------------------------------------------------
	Identity Portfolio - Four per Row - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Identity Portfolio" , "sentient"),
	   "base" => "identity_portfolio",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter No.# of portfolio items you want to display" , "sentient"),
			 "param_name" => "noofposts",
			 "value" => "12",
			 "description" => __("Number of Portfolio Items to display" , "sentient")
		  )
	   )
	) );

	/*------------------------------------------------------
	Identity Testimonial - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Identity Testimonial" , "sentient"),
	   "base" => "identity_testimonial",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter No.# of Testimonials" , "sentient"),
			 "param_name" => "noofposts",
			 "value" => "3",
			 "description" => __("Number of Testimonials to display" , "sentient")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Testimonial text color color" , "sentient"),
			 "param_name" => "fontcolor",
			 "value" => "#ffffff",
			 "description" => __("Please Choose testimonial text color" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter slider speed" , "sentient"),
			 "param_name" => "speed",
			 "value" => "5000",
			 "description" => __("Slider Speed in Milliseconds" , "sentient")
		  ),		
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Do you want to display full text?" , "sentient"),
			 "param_name" => "length",
			 "value" => $identity_yes_no_arr,
			 "description" => __("If yes then all the text will be displayed, else only a brief text will be displayed" , "sentient")
		  ),  		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please choose animation type" , "sentient"),
			 "param_name" => "animationtype",
			 "value" => $identity_animation_arr,
			 "description" => __("Choose animation type" , "sentient")
		  )		  
	   )
	) );

	/*------------------------------------------------------
	Identity Map - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Identity Map" , "sentient"),
	   "base" => "identity_map",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Location Main Title" , "sentient"),
			 "param_name" => "loctitle",
			 "value" => "ProfTeamSolutions",
			 "description" => __("Please Enter Location Main title" , "sentient")
		  ),
		  array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Location Description" , "sentient"),
			 "param_name" => "locdesc",
			 "value" => "12, Segun Bagicha, 10th floor, Dhaka, Bangladesh. Lorem ipsum dolor sit amet incididunt ut labore et dolore psum dolor magna aliqua.",
			 "description" => __("Please Enter Location Description" , "sentient")
		  ),		  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Map Latitude" , "sentient"),
			 "param_name" => "latitude",
			 "value" => "-37.809674",
			 "description" => __("Please Enter Map Latitude Value" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Map embed Longitude" , "sentient"),
			 "param_name" => "longitude",
			 "value" => "144.954718",
			 "description" => __("Please Enter Map Longitude Value" , "sentient")
		  )	  
	   )
	) );

	/*------------------------------------------------------
	Identity Blog - Four per Row - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Identity Blog" , "sentient"),
	   "base" => "identity_blog",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter No.# of Blog items you want to display" , "sentient"),
			 "param_name" => "noofposts",
			 "value" => "4",
			 "description" => __("Number of Blog Items to display" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter Blog page URL" , "sentient"),
			 "param_name" => "link",
			 "value" => "#",
			 "description" => __("Please enter Blog page URL, or keep it empty to hide the 'View All' button." , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter button label" , "sentient"),
			 "param_name" => "title",
			 "value" => "VIEW ALL",
			 "description" => __("Please enter button label" , "sentient")
		  )
	   )
	) );

	

	/*------------------------------------------------------
	Identity Resume - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Identity Resume" , "sentient"),
	   "base" => "identity_resume",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter No.# of Present items you want to display" , "sentient"),
			 "param_name" => "noofpresent",
			 "value" => "4",
			 "description" => __("Number of Present Items to display" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter No.# of Education items you want to display" , "sentient"),
			 "param_name" => "noofeducation",
			 "value" => "2",
			 "description" => __("Number of Education Items to display" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter Present Items Label" , "sentient"),
			 "param_name" => "presenttext",
			 "value" => "PRESENT",
			 "description" => __("Please enter Present Items Label" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter Education Items Label" , "sentient"),
			 "param_name" => "educationtext",
			 "value" => "Education",
			 "description" => __("Please enter Education Items Label" , "sentient")
		  )		  
	   )
	) );	
	
	
	/*------------------------------------------------------
	Identity Page Section - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Identity Page Section" , "sentient"),
	   "base" => "identity_page_section",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter a unique ID" , "sentient"),
			 "param_name" => "id",
			 "value" => "",
			 "description" => __("This ID must be unique and should not be duplicated in this page" , "sentient")
		  )
	   )
	) );	


	/*------------------------------------------------------
	Identity Packages - Four per Row - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Identity Packages" , "sentient"),
	   "base" => "identity_packages",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter No.# of Packages items you want to display (MAX 4)" , "sentient"),
			 "param_name" => "noofposts",
			 "value" => "3",
			 "description" => __("Number of Package Items to display" , "sentient")
		  )
	   )
	) );

	/*------------------------------------------------------
	Identity Contact Details - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Identity Contact Details" , "sentient"),
	   "base" => "identity_contact_details",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Font color" , "sentient"),
			 "param_name" => "color",
			 "value" => "#333",
			 "description" => __("Please Choose Font color for your Contact Details" , "sentient")
		  ),	   
		  array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Address Line 1" , "sentient"),
			 "param_name" => "add1",
			 "value" => "12 Segun Bagicha, 10th Floor",
			 "description" => __("Please Enter Address Line 1" , "sentient")
		  ),
		  array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Address Line 2" , "sentient"),
			 "param_name" => "add2",
			 "value" => "Melbourne, Australia",
			 "description" => __("Please Enter Address Line 2" , "sentient")
		  ),			  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Phone Number 1" , "sentient"),
			 "param_name" => "phone1",
			 "value" => "+1 343-234-4343",
			 "description" => __("Please Enter Phone Number 1" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Phone Number 2" , "sentient"),
			 "param_name" => "phone2",
			 "value" => "+0 243-243-4243",
			 "description" => __("Please Enter Phone Number 2" , "sentient")
		  )	  
	   )
	) );


	/*------------------------------------------------------
	Identity Social Icons - VC  
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Identity Social Icons" , "sentient"),
	   "base" => "identity_social_icon",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please choose social icon" , "sentient"),
			 "param_name" => "socialicon",
			 "value" => $identity_social_arr,
			 "description" => __("Choose social icon" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter your social icon URL here" , "sentient"),
			 "param_name" => "link",
			 "value" => "URL goes here",
			 "description" => __("The URL of the chosen social icon" , "sentient")
		  )	
	   )
	) );

	/*------------------------------------------------------
	Identity Alert Box - VC
	-------------------------------------------------------*/
	
	vc_map( array(
	   "name" => __("Identity Alert Box" , "sentient"),
	   "base" => "identity_alert_box",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(	  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please select a Type" , "sentient"),
			 "param_name" => "type",
			 "value" => $identity_alert_arr,
			 "description" => __("The Type of the Alert Box" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Alert Text" , "sentient"),
			 "param_name" => "text",
			 "value" => "Normal Message! Your Message Here",
			 "description" => __("Enter Alert Text" , "sentient")
		  )
	   )
	) );	

	/*------------------------------------------------------
	Identity List Item - VC
	-------------------------------------------------------*/
	
	vc_map( array(
	   "name" => __("Identity List Item" , "sentient"),
	   "base" => "identity_list_item",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("List Item color" , "sentient"),
			 "param_name" => "color",
			 "value" => "#333",
			 "description" => __("Please Choose a color for your List Item" , "sentient")
		  ),		   
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please select icon for the list item" , "sentient"),
			 "param_name" => "type",
			 "value" => $identity_list_arr,
			 "description" => __("The Icon of your list" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("List Item Text" , "sentient"),
			 "param_name" => "text",
			 "value" => "List Item",
			 "description" => __("Enter List Item Text" , "sentient")
		  )
	   )
	) );		

	/*------------------------------------------------------
	Identity Video - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Identity Video" , "sentient"),
	   "base" => "identity_video",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(		   
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Video URL" , "sentient"),
			 "param_name" => "url",
			 "value" => "http://www.example.com",
			 "description" => __("Enter Video URL" , "sentient")
		  )
	   )
	) );	

	
	/*------------------------------------------------------
	Identity Dropcaps - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Identity Dropcaps" , "sentient"),
	   "base" => "identity_dropcaps",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(	
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please select Dropcaps Type" , "sentient"),
			 "param_name" => "type",
			 "value" => $identity_dropcaps_arr,
			 "description" => __("The Type of your Dropcaps" , "sentient")
		  ),	   
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Dropcaps Character" , "sentient"),
			 "param_name" => "character",
			 "value" => "L",
			 "description" => __("Enter Dropcaps Character" , "sentient")
		  ),	   
		  array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Dropcaps Remaining Text" , "sentient"),
			 "param_name" => "text",
			 "value" => "earn how to do awesome dropcaps with identity",
			 "description" => __("Enter Dropcaps Remaining Text" , "sentient")
		  )
	   )
	) );
	
	 /*------------------------------------------------------
	 Identity About Me Personal Image - VC
	 -------------------------------------------------------*/
	 
	 vc_map( array(
		"name" => __("About Me Personal Image" , "sentient"),
		"base" => "identity_about_me_image",
		"class" => "",
		"category" => __('Content' , "sentient"),
		   "params" => array(
		      array(
				  "type" => "colorpicker",
				  "holder" => "div",
				  "class" => "",
				  "heading" => __("Name text color" , "sentient"),
				  "param_name" => "color",
				  "value" => "#ffffff",
				  "description" => __("Please Choose the text color" , "sentient")
				  ),	
			  array(
				  "type" => "colorpicker",
				  "holder" => "div",
				  "class" => "",
				  "heading" => __("Position text color" , "sentient"),
				  "param_name" => "color2",
				  "value" => "#ffffff",
				  "description" => __("Please Choose the text color" , "sentient")
				  ),	
		      array(
				  "type" => "colorpicker",
				  "holder" => "div",
				  "class" => "",
				  "heading" => __("Text Background color" , "sentient"),
				  "param_name" => "bgcolor",
				  "value" => "rgba(59, 63, 80, 0.8)",
				  "description" => __("Please Choose the text background color" , "sentient")
				  ),				  
			  array(
				  "type" => "attach_image",
				  "holder" => "div",
				  "class" => "",
				  "heading" => __("Upload Your Photo" , "sentient"),
				  "param_name" => "personalimg",
				  "value" => "",
				  "description" => __("Please Choose a Personal Image" , "sentient")
				  ),
				  array(
				  "type" => "textfield",
				  "holder" => "div",
				  "class" => "",
				  "heading" => __("Please enter your name here" , "sentient"),
				  "param_name" => "personalname",
				  "value" => "Title goes here",
				  "description" => __("The personal name goes here" , "sentient")
				  ),
				  array(
				  "type" => "textfield",
				  "holder" => "div",
				  "class" => "",
				  "heading" => __("Please enter your Designation" , "sentient"),
				  "param_name" => "designation",
				  "value" => "Designation goes here",
				  "description" => __("Designation" , "sentient")
				  ) 				  
	   )	
    ));
 
	/*------------------------------------------------------
	Identity Contact Details - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Identity Personal Details" , "sentient"),
	   "base" => "identity_personal_details",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Font color" , "sentient"),
			 "param_name" => "color",
			 "value" => "#333",
			 "description" => __("Please Choose Font color for your Personal Details" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Birthdate title" , "sentient"),
			 "param_name" => "birthdatetitle",
			 "value" => "Birthdate",
			 "description" => __("Please enter your birth date title" , "sentient")
		  ),		  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Birthdate" , "sentient"),
			 "param_name" => "birthdate",
			 "value" => "02/09/1982",
			 "description" => __("Please enter your birth date" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Phone title" , "sentient"),
			 "param_name" => "phonetitle",
			 "value" => "Phone",
			 "description" => __("Please enter your Phone title" , "sentient")
		  ),			  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Phone" , "sentient"),
			 "param_name" => "phone",
			 "value" => "+1 343-234-4343",
			 "description" => __("Please Enter your phone number" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Email title" , "sentient"),
			 "param_name" => "emailtitle",
			 "value" => "Email",
			 "description" => __("Please enter your Email title" , "sentient")
		  ),			  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Email" , "sentient"),
			 "param_name" => "email",
			 "value" => "john@example.com",
			 "description" => __("Please enter your email address" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Website title" , "sentient"),
			 "param_name" => "websitetitle",
			 "value" => "Website",
			 "description" => __("Please enter your Website title" , "sentient")
		  ),			  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Website" , "sentient"),
			 "param_name" => "website",
			 "value" => "www.example.com",
			 "description" => __("Please enter your website" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Facebook title" , "sentient"),
			 "param_name" => "facebooktitle",
			 "value" => "Facebook",
			 "description" => __("Please enter your Facebook title" , "sentient")
		  ),			  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Facebook" , "sentient"),
			 "param_name" => "facebook",
			 "value" => "",
			 "description" => __("Please enter your Facebook URL" , "sentient")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("LinkedIn title" , "sentient"),
			 "param_name" => "linkedintitle",
			 "value" => "Linkedin",
			 "description" => __("Please enter your LinkedIn title" , "sentient")
		  ),			  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("LinkedIn" , "sentient"),
			 "param_name" => "linkedin",
			 "value" => "",
			 "description" => __("Please enter your LinkedIn URL" , "sentient")
		  ),		  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Twitter title" , "sentient"),
			 "param_name" => "twittertitle",
			 "value" => "Twitter",
			 "description" => __("Please enter your Twitter title" , "sentient")
		  ),			  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Twitter" , "sentient"),
			 "param_name" => "twitter",
			 "value" => "",
			 "description" => __("Please enter your Twitter URL" , "sentient")
		  ),	
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Address title" , "sentient"),
			 "param_name" => "addresstitle",
			 "value" => "Address",
			 "description" => __("Please enter your Address title" , "sentient")
		  ),		  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Address" , "sentient"),
			 "param_name" => "address",
			 "value" => "12 Segun Bagicha, 10th Floor, Dhaka 1000, Bangladesh.",
			 "description" => __("Please enter your address" , "sentient")
		  )			  
	   )
	) );

	 /*------------------------------------------------------
	 Identity Skills Bar - VC
	 -------------------------------------------------------*/
	 
	 vc_map( array(
		"name" => __("Identity Skills Bar" , "sentient"),
		"base" => "identity_skills_bar",
		"class" => "",
		"category" => __('Content' , "sentient"),
		"params" => array(	
				 array(
				 "type" => "colorpicker",
				 "holder" => "div",
				 "class" => "",
				 "heading" => __("Font color" , "sentient"),
				 "param_name" => "color",
				 "value" => "#333",
				 "description" => __("Please Choose Font color for your Personal Details" , "sentient")
				  ),
				  array(
				  "type" => "textfield",
				  "holder" => "div",
				  "class" => "",
				  "heading" => __("Please enter your skill name here" , "sentient"),
				  "param_name" => "skillname",
				  "value" => "Skill Name",
				  "description" => __("The skill name goes here" , "sentient")
				  ),
				  array(
				  "type" => "textfield",
				  "holder" => "div",
				  "class" => "",
				  "heading" => __("Please enter your skill percentage" , "sentient"),
				  "param_name" => "skillpercentage",
				  "value" => "Skill percentage goes here",
				  "description" => __("Skill percentage" , "sentient")
				  ) 				  
	   )	
    ));
 
	/*------------------------------------------------------
	Identity H1 - VC
	-------------------------------------------------------*/
	
	vc_map( array(
	   "name" => __("Identity H1" , "sentient"),
	   "base" => "identity_heading_one",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Title" , "sentient"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => __("Enter Heading Title" , "sentient")
		  )
	   )
	) );		

	/*------------------------------------------------------
	Identity H2 - VC
	-------------------------------------------------------*/
	
	vc_map( array(
	   "name" => __("Identity H2" , "sentient"),
	   "base" => "identity_heading_two",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Title" , "sentient"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => __("Enter Heading Title" , "sentient")
		  )
	   )
	) );		

	/*------------------------------------------------------
	Identity H3 - VC
	-------------------------------------------------------*/
	
	vc_map( array(
	   "name" => __("Identity H3" , "sentient"),
	   "base" => "identity_heading_three",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Title" , "sentient"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => __("Enter Heading Title" , "sentient")
		  )
	   )
	) );	

	
	/*------------------------------------------------------
	Identity H4 - VC
	-------------------------------------------------------*/
	
	vc_map( array(
	   "name" => __("Identity H4" , "sentient"),
	   "base" => "identity_heading_four",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Title" , "sentient"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => __("Enter Heading Title" , "sentient")
		  )
	   )
	) );

	/*------------------------------------------------------
	Identity H5 - VC
	-------------------------------------------------------*/
	
	vc_map( array(
	   "name" => __("Identity H5" , "sentient"),
	   "base" => "identity_heading_five",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Title" , "sentient"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => __("Enter Heading Title" , "sentient")
		  )
	   )
	) );	
	

	/*------------------------------------------------------
	Identity H6 - VC
	-------------------------------------------------------*/
	
	vc_map( array(
	   "name" => __("Identity H6" , "sentient"),
	   "base" => "identity_heading_six",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Title" , "sentient"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => __("Enter Heading Title" , "sentient")
		  )
	   )
	) );	


}



/*------------------------------------------------------
Identity Sidebar Functions - Started
-------------------------------------------------------*/

if ( function_exists('register_sidebar') ){
	function identity_widgets_init() {
		register_sidebar(array(
			'name' => 'Default Sidebar',
			'id' => 'default',			
			'description'   => 'This sidebar can be chosen for any page',	
			'before_widget' => '<aside id="%1$s" class="widget %2$s">' ,
			'after_widget' =>  '</aside>',
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3></div>',	
		));
		//************************	
		register_sidebar(array(
			'name' => 'Blog Right Sidebar',
			'id' => 'Blog-Right-Sidebar',
			'description'   => 'This sidebar can be chosen for Blog with right sidebar template or any other templates',	
			'before_widget' => '<aside id="%1$s" class="widget %2$s">' ,
			'after_widget' =>  '</aside>',
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3></div>',	
		));
		//************************
		register_sidebar(array('name'=>'Blog Left Sidebar',
			'id' => 'Blog-Left-Sidebar',
			'description'   => 'This sidebar can be chosen for Blog with left sidebar template or any other templates',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">' ,
			'after_widget' =>  '</aside>',
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3></div>',	
		));
		//************************
		register_sidebar(array('name'=>'Blog Single Sidebar',
			'id' => 'Blog-Single-Sidebar',
			'description'   => 'This sidebar can be chosen for single Blog page or any other templates',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">' ,
			'after_widget' =>  '</aside>',
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3></div>',	

		));
		//************************
		register_sidebar(array('name'=>'Page Right Sidebar',
			'id' => 'Page-Right-Sidebar',
			'description'   => 'This sidebar can be chosen for any Page with right sidebar or any other pages',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">' ,
			'after_widget' =>  '</aside>',
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3></div>',	
		));
		//************************
		register_sidebar(array('name'=>'Page Left Sidebar',
			'id' => 'Page-Left-Sidebar',	
			'description'   => 'This sidebar can be chosen for any Page with left sidebar or any other pages',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">' ,
			'after_widget' =>  '</aside>',
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3></div>',	

		));
		//************************
		register_sidebar(array('name'=>'Extra Sidebar I',
			'id' => 'Extra-Sidebar-I',
			'description'   => 'Extra sidebar that can be chosen for any Page/Post/Template',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">' ,
			'after_widget' =>  '</aside>',
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3></div>',	


		));
		//************************
		register_sidebar(array('name'=>'Extra Sidebar II',
			'id' => 'Extra-Sidebar-II',	
			'description'   => 'Extra sidebar that can be chosen for any Page/Post/Template',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">' ,
			'after_widget' =>  '</aside>',
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3></div>',	


		));
		//************************
		register_sidebar(array('name'=>'Extra Sidebar III',
			'id' => 'Extra-Sidebar-III',
			'description'   => 'Extra sidebar that can be chosen for any Page/Post/Template',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">' ,
			'after_widget' =>  '</aside>',
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3></div>',	
		));
	}
}
add_action( 'widgets_init', 'identity_widgets_init' );
/*------------------------------------------------------
Identity Sidebar Functions - End
-------------------------------------------------------*/



/*------------------------------------------------------
Identity, Add Portfolio Thumbnail URL option - Started
-------------------------------------------------------*/

function identity_get_portfolio_thumbnail_url($pid){  
    $image_id = get_post_thumbnail_id($pid);  
    $image_url = wp_get_attachment_image_src($image_id,'screen-shot');  
    return  $image_url[0];  
}  

/*------------------------------------------------------
Identity, Add Portfolio Thumbnail URL option - End
-------------------------------------------------------*/



/*------------------------------------------------------
Identity, Adds a box to the side column on the Post and Page edit screens - Started
-------------------------------------------------------*/
function identity_add_sidebar_metabox()  
{  
    add_meta_box(  
        'custom_sidebar',  
        __( 'Custom Sidebar', 'proftheme' ),  
        'identity_custom_sidebar_callback',  
        'post',  
        'side'  
    );  
    add_meta_box(
        'custom_sidebar',  
        __( 'Custom Sidebar', 'proftheme' ),  
        'identity_custom_sidebar_callback',  
        'page',  
        'side'  
    );  
    add_meta_box(
        'custom_sidebar',  
        __( 'Custom Sidebar', 'proftheme' ),  
        'identity_custom_sidebar_callback',  
        'project',  
        'side'  
    );

} 



function identity_custom_sidebar_callback( $post )  
{  
    global $wp_registered_sidebars;  
      
    $custom = get_post_custom($post->ID);  
      
    if(isset($custom['custom_sidebar']))  
        $val = $custom['custom_sidebar'][0];  
    else  
        $val = "default";  
  
    // Use nonce for verification  
    wp_nonce_field( plugin_basename( __FILE__ ), 'custom_sidebar_nonce' );  
  
    // The actual fields for data entry  
    $output = '<p><label for="myplugin_new_field">'.__("Choose a sidebar to display", 'sentient' ).'</label></p>';  
    $output .= "<select name='custom_sidebar'>"; 
	
      
    // Fill the select element with all registered sidebars  
    foreach($wp_registered_sidebars as $sidebar_id => $sidebar)  
    {  
        $output .= "<option";  
        if($sidebar_id == $val)  
            $output .= " selected='selected'";  
        $output .= " value='". esc_attr($sidebar_id) ."'>". esc_attr($sidebar['name']) ."</option>";  
    }  
    
    $output .= "</select>";  
      
	  
	echo wp_kses( $output, array(
		'p' => array(),		
		'label' => array(
			'for' => array()			
		),
		'select' => array(
			'name' => array()			
		),
		'option' => array(
			'selected' => array(),
			'value' => array()			
		)
	) );	  

}

function identity_save_sidebar_postdata( $post_id )  
{  
    // verify if this is an auto save routine.   
    // If it is our form has not been submitted, so we dont want to do anything  
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )   
      return;  
  
    // verify this came from our screen and with proper authorization,  
    // because save_post can be triggered at other times  
  
	if(isset ($_POST['custom_sidebar_nonce'])){
		if ( !wp_verify_nonce( $_POST['custom_sidebar_nonce'], plugin_basename( __FILE__ ) ) )  
		  return; 
	}   
  
    if ( !current_user_can( 'edit_page', $post_id ) )  
        return;  
  
	if(isset ($_POST['custom_sidebar'])){
		$data = $_POST['custom_sidebar'];  
		update_post_meta($post_id, "custom_sidebar", $data);
	}     
}  
/*------------------------------------------------------
Identity, Adds a box to the side column on the Post and Page edit screens - End
-------------------------------------------------------*/


/*------------------------------------------------------
Archive No. of Posts - Started
-------------------------------------------------------*/
function limit_posts_per_archive_page() {


	/*set_query_var('posts_per_archive_page', 5);*/
}
/*------------------------------------------------------
Archive No. of Posts - Ended
-------------------------------------------------------*/


if(!function_exists('identity_backend_theme_activation'))
{
	/**
	 *  This function gets executed if the theme just got activated. It resets the global frontpage setting
	 *  and then redirects the user to the framework main options page
	 */
	function identity_backend_theme_activation()
	{
		global $pagenow;
		if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) )
		{

			#provide hook so themes can execute theme specific functions on activation
			do_action('identity_backend_theme_activation');

			#redirect to options page
			header( 'Location: '.admin_url().'themes.php?page=options-framework' ) ;
		}
	}

	add_action('admin_init','identity_backend_theme_activation');
}




/*------------------------------------------------------
Identity Walker_Nav_Menu - Started
-------------------------------------------------------*/
class identity_description_walker extends Walker_Nav_Menu
{
	
	  function start_lvl(&$output, $depth= 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"dropdown-menu clearfix\">\n";
	  }
	  function end_lvl(&$output, $depth= 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	  }

	  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
      {
           global $wp_query;

           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		   
		   $output .= '';
			
           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;
			
			/* Has children */
			$children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
			if (empty($children)) {
				$toggleClass = '';
			} else {
				$toggleClass = 'dropdown-toggle nav-toggle';
			}				
			
           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names . ' ' . $toggleClass ) . '"';
		   
           $output .= $indent . '<li ' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		   
		   
           $prepend = '';
           $append = '';
		   
           $description  = ! empty( $item->description ) ? '<span class="menu-item-description">'.esc_attr( $item->description ).'</span>' : '';

           if($depth != 0)
           {
                     $description = $append = $prepend = "";
           }

			
			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
			$item_output .= $description.$args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;
			
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
      }
}


class identity_inner_walker extends Walker_Nav_Menu
{
	
	  function start_lvl(&$output, $depth= 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"dropdown-menu clearfix\">\n";
	  }
	  function end_lvl(&$output, $depth= 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	  }

	  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
      {
           global $wp_query;

           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		   
		   $output .= '';
			
           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;
			
			/* Has children */
			$children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
			if (empty($children)) {
				$toggleClass = '';
			} else {
				$toggleClass = 'dropdown-toggle nav-toggle';
			}				
			
           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names . ' ' . $toggleClass ) . '"';
		   
			if (substr($item->url, 0, 1) === '#') {
				$itemURL = home_url() . $item->url;
			} else {
				$itemURL = $item->url;
			}

		   
           $output .= $indent . '<li ' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $itemURL        ) .'"' : '';
		   
		   
           $prepend = '';
           $append = '';
		   
           $description  = ! empty( $item->description ) ? '<span class="menu-item-description">'.esc_attr( $item->description ).'</span>' : '';

           if($depth != 0)
           {
                     $description = $append = $prepend = "";
           }

			
			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
			$item_output .= $description.$args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;
			
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
      }
}
/*------------------------------------------------------
Identity Walker_Nav_Menu - End
-------------------------------------------------------*/



/*------------------------------------------------------
Identity , Add Custom Fields to the Post Formats (add_action) - Started
-------------------------------------------------------*/
add_action( 'admin_menu', 'identity_team_post_format_member_position' );
add_action( 'save_post', 'identity_save_team_post_format_member_position', 10, 2 );

add_action( 'admin_menu', 'identity_testimonial_company_field' );
add_action( 'save_post', 'identity_save_testimonial_company_field', 10, 2 );

add_action( 'admin_menu', 'identity_portfolio_post_format_client_link' );
add_action( 'save_post', 'identity_save_portfolio_post_format_client_link', 10, 2 );

add_action( 'admin_menu', 'identity_testimonial_post_format_company_link' );
add_action( 'save_post', 'identity_save_testimonial_post_format_company_link', 10, 2 );

add_action( 'admin_menu', 'identity_testimonial_post_format_person_position' );
add_action( 'save_post', 'identity_save_testimonial_post_format_person_position', 10, 2 );

add_action( 'admin_menu', 'identity_portfolio_post_format_client_name' );
add_action( 'save_post', 'identity_save_portfolio_post_format_client_name', 10, 2 );

add_action( 'admin_menu', 'identity_post_format_facebook_field' );
add_action( 'save_post', 'identity_save_post_format_facebook_field', 10, 2 );

add_action( 'admin_menu', 'identity_post_format_twitter_field' );
add_action( 'save_post', 'identity_save_post_format_twitter_field', 10, 2 );

add_action( 'admin_menu', 'identity_post_format_flickr_field' );
add_action( 'save_post', 'identity_save_post_format_flickr_field', 10, 2 );

add_action( 'admin_menu', 'identity_post_format_linkedin_field' );
add_action( 'save_post', 'identity_save_post_format_linkedin_field', 10, 2 );

add_action( 'admin_menu', 'identity_post_format_google_field' );
add_action( 'save_post', 'identity_save_post_format_google_field', 10, 2 );

add_action( 'admin_menu', 'identity_post_format_pinterest_field' );
add_action( 'save_post', 'identity_save_post_format_pinterest_field', 10, 2 );

add_action( 'admin_menu', 'identity_video_post_format_URL_field' );
add_action( 'save_post', 'identity_save_video_post_format_URL_field', 10, 2 );

add_action( 'admin_menu', 'identity_audio_post_format_URL_field' );
add_action( 'save_post', 'identity_save_audio_post_format_URL_field', 10, 2 );

add_action( 'admin_menu', 'identity_gallery_post_format_URL_field' );
add_action( 'save_post', 'identity_save_gallery_post_format_URL_field', 10, 2 );

add_action( 'admin_menu', 'post_icons_list' );
add_action( 'save_post', 'post_save_icons_list', 10, 2 );

add_action( 'admin_menu', 'team_skilltitleone_field' );
add_action( 'save_post', 'team_save_skilltitleone_field', 10, 2 );

add_action( 'admin_menu', 'team_skillpercentageone_field' );
add_action( 'save_post', 'team_save_skillpercentageone_field', 10, 2 );

add_action( 'admin_menu', 'team_skilltitletwo_field' );
add_action( 'save_post', 'team_save_skilltitletwo_field', 10, 2 );

add_action( 'admin_menu', 'team_skillpercentagetwo_field' );
add_action( 'save_post', 'team_save_skillpercentagetwo_field', 10, 2 );

add_action( 'admin_menu', 'team_skilltitlethree_field' );
add_action( 'save_post', 'team_save_skilltitlethree_field', 10, 2 );

add_action( 'admin_menu', 'team_skillpercentagethree_field' );
add_action( 'save_post', 'team_save_skillpercentagethree_field', 10, 2 );

add_action( 'admin_menu', 'packages_price_field' );
add_action( 'save_post', 'packages_save_price_field', 10, 2 );

add_action( 'admin_menu', 'packages_currency_field' );
add_action( 'save_post', 'packages_save_currency_field', 10, 2 );

add_action( 'admin_menu', 'packages_period_field' );
add_action( 'save_post', 'packages_save_period_field', 10, 2 );

add_action( 'admin_menu', 'packages_minidesc_field' );
add_action( 'save_post', 'packages_save_minidesc_field', 10, 2 );

add_action( 'admin_menu', 'packages_active_field' );
add_action( 'save_post', 'packages_save_active_field', 10, 2 );

add_action( 'admin_menu', 'packages_animation_field' );
add_action( 'save_post', 'packages_save_animation_field', 10, 2 );

add_action( 'admin_menu', 'identity_portfolio_layout_field' );
add_action( 'save_post', 'identity_save_portfolio_layout_field', 10, 2 );

add_action( 'admin_menu', 'identity_team_socialone_field' );
add_action( 'save_post', 'identity_team_save_socialone_field', 10, 2 );

add_action( 'admin_menu', 'identity_team_socialone_link' );
add_action( 'save_post', 'identity_team_save_socialone_link', 10, 2 );

add_action( 'admin_menu', 'identity_team_socialtwo_field' );
add_action( 'save_post', 'identity_team_save_socialtwo_field', 10, 2 );

add_action( 'admin_menu', 'identity_team_socialtwo_link' );
add_action( 'save_post', 'identity_team_save_socialtwo_link', 10, 2 );

add_action( 'admin_menu', 'identity_team_socialthree_field' );
add_action( 'save_post', 'identity_team_save_socialthree_field', 10, 2 );

add_action( 'admin_menu', 'identity_team_socialthree_link' );
add_action( 'save_post', 'identity_team_save_socialthree_link', 10, 2 );

add_action( 'admin_menu', 'identity_present_position' );
add_action( 'save_post', 'identity_present_save_position', 10, 2 );

add_action( 'admin_menu', 'identity_present_period' );
add_action( 'save_post', 'identity_present_save_period', 10, 2 );

add_action( 'admin_menu', 'identity_education_university' );
add_action( 'save_post', 'identity_education_save_university', 10, 2 );
/*------------------------------------------------------
Identity , Add Custom Fields to the Post Formats (add_action) - End
-------------------------------------------------------*/



/*------------------------------------------------------
Identity , Add Custom Fields to the Post Formats (Create Fields) - Started
-------------------------------------------------------*/
function identity_testimonial_company_field() {
	add_meta_box( 'identity-testimonial_company-box', 'Testimonial Person Company Name', 'identity_create_testimonial_company_field', 'testimonial', 'normal', 'high' );
}
function identity_team_post_format_member_position() {
	add_meta_box( 'my-team-position-box', 'Team Member Position', 'identity_create_team_post_format_member_position', 'team', 'normal', 'high' );
}
function identity_portfolio_post_format_client_link() {
	add_meta_box( 'my-projectlink-box', 'Project URL', 'identity_create_portfolio_post_format_client_link', 'portfolio', 'normal', 'high' );
}
function identity_testimonial_post_format_company_link() {
	add_meta_box( 'identity-test-company-link', 'Company URL', 'identity_create_testimonial_post_format_company_link', 'testimonial', 'normal', 'high' );
}
function identity_testimonial_post_format_person_position() {
	add_meta_box( 'my-test-position-box', 'Person Position', 'identity_create_testimonial_post_format_person_position', 'testimonial', 'normal', 'high' );
}
function identity_portfolio_post_format_client_name() {
	add_meta_box( 'my-projectdescription-box', 'Project Client', 'identity_create_portfolio_post_format_client_name', 'portfolio', 'normal', 'high' );
}
function identity_post_format_facebook_field() {
	add_meta_box( 'my-facebook-box', 'Facebook URL', 'identity_create_post_format_facebook_field', 'post', 'normal', 'high' );
	add_meta_box( 'my-facebook-box', 'Facebook URL', 'identity_create_post_format_facebook_field', 'portfolio', 'normal', 'high' );
}
function identity_post_format_twitter_field() {
	add_meta_box( 'my-twitter-box', 'Twitter URL', 'identity_create_post_format_twitter_field', 'post', 'normal', 'high' );
	add_meta_box( 'my-twitter-box', 'Twitter URL', 'identity_create_post_format_twitter_field', 'portfolio', 'normal', 'high' );
}
function identity_post_format_flickr_field() {
	add_meta_box( 'my-flickr-box', 'Flickr URL', 'identity_create_post_format_flickr_field', 'portfolio', 'normal', 'high' );
	add_meta_box( 'my-flickr-box', 'Flickr URL', 'identity_create_post_format_flickr_field', 'post', 'normal', 'high' );
}
function identity_post_format_linkedin_field() {
	add_meta_box( 'my-linkedin-box', 'LinkedIn URL', 'identity_create_post_format_linkedin_field', 'post', 'normal', 'high' );
	add_meta_box( 'my-linkedin-box', 'LinkedIn URL', 'identity_create_post_format_linkedin_field', 'portfolio', 'normal', 'high' );
}
function identity_post_format_pinterest_field() {	
	add_meta_box( 'my-pinterest-box', 'Pinterest URL', 'identity_create_post_format_pinterest_field', 'post', 'normal', 'high' );
	add_meta_box( 'my-pinterest-box', 'Pinterest URL', 'identity_create_post_format_pinterest_field', 'portfolio', 'normal', 'high' );	
}
function identity_post_format_google_field() {
	add_meta_box( 'my-google-box', 'Google URL', 'identity_create_post_format_google_field', 'post', 'normal', 'high' );
	add_meta_box( 'my-google-box', 'Google URL', 'identity_create_post_format_google_field', 'portfolio', 'normal', 'high' );
}
function identity_video_post_format_URL_field() {
	add_meta_box( 'my-video-box', 'Video URL for post video format (only)', 'identity_create_video_post_format_URL_field', 'post', 'normal', 'high' );
	add_meta_box( 'my-video-box', 'Video URL for post video format (only)', 'identity_create_video_post_format_URL_field', 'portfolio', 'normal', 'high' );
}
function identity_audio_post_format_URL_field() {
	add_meta_box( 'my-audio-box', 'Audio Shortcode for post Audio format (only)', 'identity_create_audio_post_format_URL_field', 'post', 'normal', 'high' );
	add_meta_box( 'my-audio-box', 'Audio Shortcode for post Audio format (only)', 'identity_create_audio_post_format_URL_field', 'portfolio', 'normal', 'high' );
}
function identity_gallery_post_format_URL_field() {
	add_meta_box( 'my-gallery-box', 'Gallery Image IDs', 'identity_create_gallery_post_format_URL_field', 'post', 'normal', 'high' );
	add_meta_box( 'my-gallery-box', 'Gallery Image IDs', 'identity_create_gallery_post_format_URL_field', 'portfolio', 'normal', 'high' );
}
function post_icons_list() {
	add_meta_box( 'my-icon-box', 'Select Icon', 'create_post_icon_list', 'process', 'normal', 'high' );
	add_meta_box( 'my-icon-box', 'Select Icon', 'create_post_icon_list', 'page', 'normal', 'high' );
}

function team_skilltitleone_field() {
	add_meta_box( 'my-skilltitleone-box', 'Team Skill One Title', 'create_team_skilltitleone_field', 'team', 'normal', 'high' );
}

function team_skillpercentageone_field() {
	add_meta_box( 'my-skillpercentageone-box', 'Team Skill One Percentage (Put Number Only)', 'create_team_skillpercentageone_field', 'team', 'normal', 'high' );
}

function team_skilltitletwo_field() {
	add_meta_box( 'my-skilltitletwo-box', 'Team Skill Two Title', 'create_team_skilltitletwo_field', 'team', 'normal', 'high' );
}

function team_skillpercentagetwo_field() {
	add_meta_box( 'my-skillpercentagetwo-box', 'Team Skill Two Percentage (Put Number Only)', 'create_team_skillpercentagetwo_field', 'team', 'normal', 'high' );
}

function team_skilltitlethree_field() {
	add_meta_box( 'my-skilltitlethree-box', 'Team Skill Three Title', 'create_team_skilltitlethree_field', 'team', 'normal', 'high' );
}

function team_skillpercentagethree_field() {
	add_meta_box( 'my-skillpercentagethree-box', 'Team Skill Three Percentage (Put Number Only)', 'create_team_skillpercentagethree_field', 'team', 'normal', 'high' );
}

function packages_price_field() {
	add_meta_box( 'my-packageprice-box', 'Package Price (Put Number Only)', 'create_package_price_field', 'packages', 'normal', 'high' );
}

function packages_currency_field() {
	add_meta_box( 'my-packagecurrency-box', 'Package Currency', 'create_package_currency_field', 'packages', 'normal', 'high' );
}

function packages_period_field() {
	add_meta_box( 'my-packageperiod-box', 'Package Period', 'create_package_period_field', 'packages', 'normal', 'high' );
}

function packages_minidesc_field() {
	add_meta_box( 'my-packageminidesc-box', 'Package Mini Description', 'create_package_minidesc_field', 'packages', 'normal', 'high' );
}

function packages_active_field() {
	add_meta_box( 'my-packageactive-box', 'Make This Package Active (You should choose one package only as active)', 'create_package_active_field', 'packages', 'normal', 'high' );
}

function packages_animation_field() {
	add_meta_box( 'my-packageanimation-box', 'Package Animation Effect', 'create_package_animation_field', 'packages', 'normal', 'high' );
}

function identity_portfolio_layout_field() {
	add_meta_box( 'my-portfoliolayout-box', 'Portfolio Layout', 'identity_create_post_portfolio_layout', 'portfolio', 'normal', 'high' );
}

function identity_team_socialone_field() {
	add_meta_box( 'team-socialone-box', 'Team Social One', 'identity_create_team_socialone', 'team', 'normal', 'high' );
}

function identity_team_socialone_link() {
	add_meta_box( 'team-socialonelink-box', 'Team Social One Link', 'identity_create_team_socialonelink', 'team', 'normal', 'high' );
}

function identity_team_socialtwo_field() {
	add_meta_box( 'team-socialtwo-box', 'Team Social Two', 'identity_create_team_socialtwo', 'team', 'normal', 'high' );
}

function identity_team_socialtwo_link() {
	add_meta_box( 'team-socialtwolink-box', 'Team Social Two Link', 'identity_create_team_socialtwolink', 'team', 'normal', 'high' );
}

function identity_team_socialthree_field() {
	add_meta_box( 'team-socialthree-box', 'Team Social Three', 'identity_create_team_socialthree', 'team', 'normal', 'high');
}

function identity_team_socialthree_link() {
	add_meta_box( 'team-socialthreelink-box', 'Team Social Three Link', 'identity_create_team_socialthreelink', 'team', 'normal', 'high' );
}

function identity_present_position() {
	add_meta_box( 'present-position-box', 'Present Position', 'identity_create_present_position', 'present', 'normal', 'high' );
}

function identity_present_period() {
	add_meta_box( 'present-period-box', 'Present Period', 'identity_create_present_period', 'present', 'normal', 'high' );
	add_meta_box( 'present-period-box', 'Present Period', 'identity_create_present_period', 'education', 'normal', 'high' );
}

function identity_education_university() {
	add_meta_box( 'education-university-box', 'University Name', 'identity_create_education_university', 'education', 'normal', 'high' );
}

/*------------------------------------------------------
Identity , Add Custom Fields to the Post Formats (Create Fields) - End
-------------------------------------------------------*/



/*------------------------------------------------------
Identity , Add Custom Fields to the Post Formats (Create Fields Layout) - Started
-------------------------------------------------------*/

function identity_create_testimonial_company_field( $object, $box ) { ?>
	<p>
		<label for="testimonialcompany-shortcode">Testimonial Person Company Name</label>
		<br />
		<input name="testimonialcompany-shortcode" id="testimonialcompany-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Testimonial Person Company Name', true )); ?>" />
		<input type="hidden" name="identity_meta_box_testcompany" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }



function identity_create_team_post_format_member_position( $object, $box ) { ?>
	<p>
		<label for="teampositionlink-shortcode">Person Position</label>
		<br />
		<input name="teampositionlink-shortcode" id="teampositionlink-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Team Member Position', true )); ?>" />
		<input type="hidden" name="sentient_meta_box_teamposition" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function identity_create_testimonial_post_format_company_link( $object, $box ) { ?>
	<p>
		<label for="testlink-shortcode">Company URL</label>
		<br />
		<input name="testlink-shortcode" id="testlink-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Company URL', true )); ?>" />
		<input type="hidden" name="sentient_meta_box_testname" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function identity_create_testimonial_post_format_person_position( $object, $box ) { ?>
	<p>
		<label for="testpositionlink-shortcode">Person Position</label>
		<br />
		<input name="testpositionlink-shortcode" id="testpositionlink-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Person Position', true )); ?>" />
		<input type="hidden" name="sentient_meta_box_testposition" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }



function identity_create_portfolio_post_format_client_link( $object, $box ) { ?>
	<p>
		<label for="projectlink-shortcode">Project URL</label>
		<br />
		<input name="projectlink-shortcode" id="projectlink-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Project URL', true )); ?>" />
		<input type="hidden" name="sentient_meta_box_projectlink" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }



function identity_create_portfolio_post_format_client_name( $object, $box ) { ?>
	<p>
		<label for="projectdescription-shortcode">Project Client</label>
		<br />
		<input name="projectdescription-shortcode" id="projectdescription-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Project Client', true )); ?>" />
		<input type="hidden" name="sentient_meta_box_projectdesc" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }



function identity_create_post_format_facebook_field( $object, $box ) { ?>
	<p>
		<label for="post-facebook">Facebook URL</label>
		<br />
		<input name="post-facebook" id="post-facebook" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Facebook URL', true ) ); ?>" />
		<input type="hidden" name="sentient_meta_box_facebook" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function identity_create_post_format_twitter_field( $object, $box ) { ?>
	<p>
		<label for="post-twitter">Twitter URL</label>
		<br />
		<input name="post-twitter" id="post-twitter" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Twitter URL', true ) ); ?>" />
		<input type="hidden" name="sentient_meta_box_twitter" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function identity_create_post_format_pinterest_field( $object, $box ) { ?>
	<p>
		<label for="post-pinterest">Pinterest URL</label>
		<br />
		<input name="post-pinterest" id="post-pinterest" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Pinterest URL', true ) ); ?>" />
		<input type="hidden" name="sentient_meta_box_pinterest" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function identity_create_post_format_linkedin_field( $object, $box ) { ?>
	<p>
		<label for="post-linkedin">LinkedIn URL</label>
		<br />
		<input name="post-linkedin" id="post-linkedin" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'LinkedIn URL', true ) ); ?>" />
		<input type="hidden" name="sentient_meta_box_linkedin" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }



function identity_create_post_format_google_field( $object, $box ) { ?>
	<p>
		<label for="post-google">Google URL</label>
		<br />
		<input name="post-google" id="post-google" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Google URL', true ) ); ?>" />
		<input type="hidden" name="sentient_meta_box_google" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function identity_create_post_format_flickr_field( $object, $box ) { ?>
	<p>
		<label for="post-flickr">Flickr URL</label>
		<br />
		<input name="post-flickr" id="post-flickr" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Flickr URL', true ) ); ?>" />
		<input type="hidden" name="sentient_meta_box_flickr" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function identity_create_video_post_format_URL_field( $object, $box ) { ?>
	<p>
		<label for="post-video">Post Video URL</label>
		<br />
		<input name="post-video" id="post-video" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Post Video URL', true ) ); ?>" />
		<input type="hidden" name="sentient_meta_box_video" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function identity_create_audio_post_format_URL_field( $object, $box ) { ?>
	<p>
		<label for="post-audio">Post Audio Shortcode</label>
		<br />
		<input name="post-audio" id="post-audio" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Post Audio Shortcode', true ) ); ?>" />
		<input type="hidden" name="sentient_meta_box_audio" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }

	
function identity_create_gallery_post_format_URL_field( $object, $box ) { ?>
<p>
	<label for="post-gallery">Post Gallery</label>
	<br />
	<input name="post-gallery" id="post-gallery" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Post Gallery', true ) ); ?>" />
	<input type="hidden" name="identity_meta_box_gallery" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }


function create_team_skilltitleone_field( $object, $box ) { ?>
<p>
	<label for="post-teamtitleone">Team Skill Title One</label>
	<br />
	<input name="post-teamtitleone" id="post-teamtitleone" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Team Skill Title One', true ) ); ?>" />
	<input type="hidden" name="identity_meta_box_teamtitleone" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }

function create_team_skillpercentageone_field( $object, $box ) { ?>
<p>
	<label for="post-teampercentageone">Team Skill Percentage One</label>
	<br />
	<input name="post-teampercentageone" id="post-teampercentageone" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Team Skill Percentage One', true ) ); ?>" />
	<input type="hidden" name="identity_meta_box_teampercentageone" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }

function create_team_skilltitletwo_field( $object, $box ) { ?>
<p>
	<label for="post-teamtitletwo">Team Skill Title Two</label>
	<br />
	<input name="post-teamtitletwo" id="post-teamtitletwo" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Team Skill Title Two', true ) ); ?>" />
	<input type="hidden" name="identity_meta_box_teamtitletwo" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }

function create_team_skillpercentagetwo_field( $object, $box ) { ?>
<p>
	<label for="post-teampercentagetwo">Team Skill Percentage Two</label>
	<br />
	<input name="post-teampercentagetwo" id="post-teampercentagetwo" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Team Skill Percentage Two', true ) ); ?>" />
	<input type="hidden" name="identity_meta_box_teampercentagetwo" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }

function create_team_skilltitlethree_field( $object, $box ) { ?>
<p>
	<label for="post-teamtitlethree">Team Skill Title Three</label>
	<br />
	<input name="post-teamtitlethree" id="post-teamtitlethree" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Team Skill Title Three', true ) ); ?>" />
	<input type="hidden" name="identity_meta_box_teamtitlethree" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }

function create_team_skillpercentagethree_field( $object, $box ) { ?>
<p>
	<label for="post-teampercentagethree">Team Skill Percentage Three</label>
	<br />
	<input name="post-teampercentagethree" id="post-teampercentagethree" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Team Skill Percentage Three', true ) ); ?>" />
	<input type="hidden" name="identity_meta_box_teampercentagethree" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }


function create_package_price_field( $object, $box ) { ?>
<p>
	<label for="post-packageprice">Package Price</label>
	<br />
	<input name="post-packageprice" id="post-packageprice" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Package Price', true ) ); ?>" />
	<input type="hidden" name="identity_meta_box_packageprice" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }


function create_package_currency_field( $object, $box ) { ?>
<p>
	<label for="post-packagecurrency">Package Currency</label>
	<br />
	<input name="post-packagecurrency" id="post-packagecurrency" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Package Currency', true ) ); ?>" />
	<input type="hidden" name="identity_meta_box_packagecurrency" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }


function create_package_period_field( $object, $box ) { ?>
<p>
	<label for="post-packageperiod">Package Period</label>
	<br />
	<input name="post-packageperiod" id="post-packageperiod" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Package Period', true ) ); ?>" />
	<input type="hidden" name="identity_meta_box_packageperiod" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }


function create_package_minidesc_field( $object, $box ) { ?>
<p>
	<label for="post-minidesc">Package Mini Description</label>
	<br />
	<input name="post-minidesc" id="post-minidesc" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Package Mini Description', true ) ); ?>" />
	<input type="hidden" name="identity_meta_box_minidesc" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }


function create_package_active_field( $object, $box ) { ?>
<p>
	<label for="post-active">Package Active</label>
	<br />
	<select name="post-active" id="post-active" cols="60" rows="4" tabindex="30" style="width: 97%;">
		<option value="no" <?php if(get_post_meta( $object->ID, 'Package Active', true ) == 'no'){ ?> selected="selected" <?php } ?>>No</option>	
		<option value="yes" <?php if(get_post_meta( $object->ID, 'Package Active', true ) == 'yes'){ ?> selected="selected" <?php } ?>>Yes</option>	
	</select>
	<input type="hidden" name="identity_meta_box_active" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }


function create_package_animation_field( $object, $box ) { ?>
<p>
	<label for="post-animation">Package Animation</label>
	<br />
	<select name="post-animation" id="post-animation" cols="60" rows="4" tabindex="30" style="width: 97%;">
		<option value="none" <?php if(get_post_meta( $object->ID, 'Package Animation', true ) == 'none'){ ?> selected="selected" <?php } ?>>None</option>	
		<option value="left" <?php if(get_post_meta( $object->ID, 'Package Animation', true ) == 'left'){ ?> selected="selected" <?php } ?>>Left</option>	
		<option value="right" <?php if(get_post_meta( $object->ID, 'Package Animation', true ) == 'right'){ ?> selected="selected" <?php } ?>>Right</option>	
		<option value="top" <?php if(get_post_meta( $object->ID, 'Package Animation', true ) == 'top'){ ?> selected="selected" <?php } ?>>Top</option>	
		<option value="bottom" <?php if(get_post_meta( $object->ID, 'Package Animation', true ) == 'bottom'){ ?> selected="selected" <?php } ?>>Bottom</option>	
	</select>
	<input type="hidden" name="identity_meta_box_animation" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }


function identity_create_post_portfolio_layout( $object, $box ) { ?>
	<p>
		<label for="portfoliolayout-shortcode">Portfolio Layout</label>
		<br />
		<select name="portfoliolayout-shortcode" id="portfoliolayout-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;">
			<option value="full" <?php if(get_post_meta( $object->ID, 'Portfolio Layout', true ) == 'full'){ ?> selected="selected" <?php } ?>>Full</option>	
			<option value="small" <?php if(get_post_meta( $object->ID, 'Portfolio Layout', true ) == 'small'){ ?> selected="selected" <?php } ?>>2/3</option>	
		</select>		
		<input type="hidden" name="identity_meta_box_portfoliolayout" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }

function identity_create_team_socialone( $object, $box ) { ?>
	<p>
		<label for="teamsocialone-shortcode">Team Social One</label>
		<br />
		<select name="teamsocialone-shortcode" id="teamsocialone-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;">
			<option value="facebook" <?php if(get_post_meta( $object->ID, 'Team Social One', true ) == 'facebook'){ ?> selected="selected" <?php } ?>>Facebook</option>	
			<option value="twitter" <?php if(get_post_meta( $object->ID, 'Team Social One', true ) == 'twitter'){ ?> selected="selected" <?php } ?>>Twitter</option>	
			<option value="linkedin" <?php if(get_post_meta( $object->ID, 'Team Social One', true ) == 'linkedin'){ ?> selected="selected" <?php } ?>>LinkedIn</option>	
			<option value="gplus" <?php if(get_post_meta( $object->ID, 'Team Social One', true ) == 'gplus'){ ?> selected="selected" <?php } ?>>Google+</option>	
			<option value="pinterest" <?php if(get_post_meta( $object->ID, 'Team Social One', true ) == 'pinterest'){ ?> selected="selected" <?php } ?>>Pinterest</option>	
			<option value="flickr" <?php if(get_post_meta( $object->ID, 'Team Social One', true ) == 'flickr'){ ?> selected="selected" <?php } ?>>Flickr</option>				
		</select>		
		<input type="hidden" name="identity_meta_box_teamsocialone" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function identity_create_team_socialonelink( $object, $box ) { ?>
<p>
	<label for="teamsocialonelink-shortcode">Team Social One Link</label>
	<br />
	<input name="teamsocialonelink-shortcode" id="teamsocialonelink-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Team Social One Link', true ) ); ?>" />
	<input type="hidden" name="identity_meta_box_teamsocialonelink" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }


function identity_create_team_socialtwo( $object, $box ) { ?>
	<p>
		<label for="teamsocialtwo-shortcode">Team Social Two</label>
		<br />
		<select name="teamsocialtwo-shortcode" id="teamsocialtwo-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;">
			<option value="facebook" <?php if(get_post_meta( $object->ID, 'Team Social Two', true ) == 'facebook'){ ?> selected="selected" <?php } ?>>Facebook</option>	
			<option value="twitter" <?php if(get_post_meta( $object->ID, 'Team Social Two', true ) == 'twitter'){ ?> selected="selected" <?php } ?>>Twitter</option>	
			<option value="linkedin" <?php if(get_post_meta( $object->ID, 'Team Social Two', true ) == 'linkedin'){ ?> selected="selected" <?php } ?>>LinkedIn</option>	
			<option value="gplus" <?php if(get_post_meta( $object->ID, 'Team Social Two', true ) == 'gplus'){ ?> selected="selected" <?php } ?>>Google+</option>	
			<option value="pinterest" <?php if(get_post_meta( $object->ID, 'Team Social Two', true ) == 'pinterest'){ ?> selected="selected" <?php } ?>>Pinterest</option>	
			<option value="flickr" <?php if(get_post_meta( $object->ID, 'Team Social Two', true ) == 'flickr'){ ?> selected="selected" <?php } ?>>Flickr</option>				
		</select>		
		<input type="hidden" name="identity_meta_box_teamsocialtwo" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function identity_create_team_socialtwolink( $object, $box ) { ?>
<p>
	<label for="teamsocialtwolink-shortcode">Team Social Two Link</label>
	<br />
	<input name="teamsocialtwolink-shortcode" id="teamsocialtwolink-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Team Social Two Link', true ) ); ?>" />
	<input type="hidden" name="identity_meta_box_teamsocialtwolink" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }


function identity_create_team_socialthree( $object, $box ) { ?>
	<p>
		<label for="teamsocialthree-shortcode">Team Social Three</label>
		<br />
		<select name="teamsocialthree-shortcode" id="teamsocialthree-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;">
			<option value="facebook" <?php if(get_post_meta( $object->ID, 'Team Social Three', true ) == 'facebook'){ ?> selected="selected" <?php } ?>>Facebook</option>	
			<option value="twitter" <?php if(get_post_meta( $object->ID, 'Team Social Three', true ) == 'twitter'){ ?> selected="selected" <?php } ?>>Twitter</option>	
			<option value="linkedin" <?php if(get_post_meta( $object->ID, 'Team Social Three', true ) == 'linkedin'){ ?> selected="selected" <?php } ?>>LinkedIn</option>	
			<option value="gplus" <?php if(get_post_meta( $object->ID, 'Team Social Three', true ) == 'gplus'){ ?> selected="selected" <?php } ?>>Google+</option>	
			<option value="pinterest" <?php if(get_post_meta( $object->ID, 'Team Social Three', true ) == 'pinterest'){ ?> selected="selected" <?php } ?>>Pinterest</option>	
			<option value="flickr" <?php if(get_post_meta( $object->ID, 'Team Social Three', true ) == 'flickr'){ ?> selected="selected" <?php } ?>>Flickr</option>				
		</select>		
		<input type="hidden" name="identity_meta_box_teamsocialthree" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function identity_create_team_socialthreelink( $object, $box ) { ?>
<p>
	<label for="teamsocialthreelink-shortcode">Team Social Three Link</label>
	<br />
	<input name="teamsocialthreelink-shortcode" id="teamsocialthreelink-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Team Social Three Link', true ) ); ?>" />
	<input type="hidden" name="identity_meta_box_teamsocialthreelink" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }



function identity_create_present_position( $object, $box ) { ?>
<p>
	<label for="presentposition-shortcode">Present Position</label>
	<br />
	<input name="presentposition-shortcode" id="presentposition-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Present Position', true ) ); ?>" />
	<input type="hidden" name="identity_meta_box_presentposition" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }


function identity_create_present_period( $object, $box ) { ?>
<p>
	<label for="presentperiod-shortcode">Present Period</label>
	<br />
	<input name="presentperiod-shortcode" id="presentperiod-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Present Period', true ) ); ?>" />
	<input type="hidden" name="identity_meta_box_presentperiod" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }


function identity_create_education_university( $object, $box ) { ?>
<p>
	<label for="educationuniversity-shortcode">Education University</label>
	<br />
	<input name="educationuniversity-shortcode" id="educationuniversity-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Education University', true ) ); ?>" />
	<input type="hidden" name="identity_meta_box_educationuniversity" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }


/*------------------------------------------------------
Identity , Add Custom Fields to the Post Formats (Create Fields Layout) - End
-------------------------------------------------------*/



/*------------------------------------------------------
Identity , Add Custom Fields to the Post Formats (Save Values) - Started
-------------------------------------------------------*/
function identity_save_testimonial_company_field( $post_id, $post ) {

	if(isset ($_POST['identity_meta_box_testcompany'])){
		if ( !wp_verify_nonce( $_POST['identity_meta_box_testcompany'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Member Position', true );
	
	if(isset ($_POST['testimonialcompany-shortcode'])){
		$new_meta_value = stripslashes($_POST['testimonialcompany-shortcode']);
	} else {
		$new_meta_value = '';
	}		
	
	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Testimonial Person Company Name', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Testimonial Person Company Name', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Testimonial Person Company Name', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Testimonial Person Company Name', $meta_value );*/
}

function identity_save_team_post_format_member_position( $post_id, $post ) {

	if(isset ($_POST['sentient_meta_box_teamposition'])){
		if ( !wp_verify_nonce( $_POST['sentient_meta_box_teamposition'], plugin_basename( __FILE__ ) ) )
			return $post_id;	
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Member Position', true );
	
	if(isset ($_POST['teampositionlink-shortcode'])){
		$new_meta_value = stripslashes($_POST['teampositionlink-shortcode']);
	} else {
		$new_meta_value = '';
	}			
	
	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Team Member Position', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Team Member Position', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Team Member Position', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Team Member Position', $meta_value );*/
}

function identity_save_testimonial_post_format_person_position( $post_id, $post ) {

	if(isset ($_POST['sentient_meta_box_testposition'])){
		if ( !wp_verify_nonce( $_POST['sentient_meta_box_testposition'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Person Position', true );
	
	if(isset ($_POST['testpositionlink-shortcode'])){
		$new_meta_value = stripslashes( $_POST['testpositionlink-shortcode'] );
	} else {
		$new_meta_value = '';
	}				

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Person Position', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Person Position', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Person Position', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Person Position', $meta_value );*/
}


function identity_save_testimonial_post_format_company_link( $post_id, $post ) {

	if(isset ($_POST['sentient_meta_box_testname'])){
		if ( !wp_verify_nonce( $_POST['sentient_meta_box_testname'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Company URL', true );
	
	if(isset ($_POST['testlink-shortcode'])){
		$new_meta_value = stripslashes( $_POST['testlink-shortcode'] );
	} else {
		$new_meta_value = '';
	}			

	$new_meta_value = esc_url_raw($new_meta_value);

	update_post_meta( $post_id, 'Company URL', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Company URL', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Company URL', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Company URL', $meta_value );*/
}


function identity_save_portfolio_post_format_client_link( $post_id, $post ) {

	if(isset ($_POST['sentient_meta_box_projectlink'])){
		if ( !wp_verify_nonce( $_POST['sentient_meta_box_projectlink'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Project URL', true );
	
	if(isset ($_POST['projectlink-shortcode'])){
		$new_meta_value = stripslashes( $_POST['projectlink-shortcode'] );
	} else {
		$new_meta_value = '';
	}				

	$new_meta_value = esc_url_raw($new_meta_value);
	
	update_post_meta( $post_id, 'Project URL', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Project URL', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Project URL', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Project URL', $meta_value );*/
}


function identity_save_portfolio_post_format_client_name( $post_id, $post ) {

	if(isset ($_POST['sentient_meta_box_projectdesc'])){
		if ( !wp_verify_nonce( $_POST['sentient_meta_box_projectdesc'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Project Client', true );
	
	if(isset ($_POST['projectdescription-shortcode'])){
		$new_meta_value = stripslashes( $_POST['projectdescription-shortcode'] );
	} else {
		$new_meta_value = '';
	}				

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Project Client', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Project Client', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Project Client', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Project Client', $meta_value );*/
}

function identity_save_post_format_facebook_field( $post_id, $post ) {

	if(isset ($_POST['sentient_meta_box_facebook'])){
		if ( !wp_verify_nonce( $_POST['sentient_meta_box_facebook'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Facebook URL', true );
	
	if(isset ($_POST['post-facebook'])){
		$new_meta_value = stripslashes( $_POST['post-facebook'] );
	} else {
		$new_meta_value = '';
	}			

	$new_meta_value = esc_url($new_meta_value);	
	
	update_post_meta( $post_id, 'Facebook URL', $new_meta_value );

	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Facebook URL', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Facebook URL', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Facebook URL', $meta_value );*/
}

function identity_save_post_format_twitter_field( $post_id, $post ) {

	if(isset ($_POST['sentient_meta_box_twitter'])){
		if ( !wp_verify_nonce( $_POST['sentient_meta_box_twitter'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Twitter URL', true );
	
	if(isset ($_POST['post-twitter'])){
		$new_meta_value = stripslashes( $_POST['post-twitter'] );
	} else {
		$new_meta_value = '';
	}			

	$new_meta_value = esc_url($new_meta_value);	

	update_post_meta( $post_id, 'Twitter URL', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Twitter URL', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Twitter URL', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Twitter URL', $meta_value );*/
}

function identity_save_post_format_linkedin_field( $post_id, $post ) {

	if(isset ($_POST['sentient_meta_box_linkedin'])){
		if ( !wp_verify_nonce( $_POST['sentient_meta_box_linkedin'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'LinkedIn URL', true );
	
	if(isset ($_POST['post-linkedin'])){
		$new_meta_value = stripslashes( $_POST['post-linkedin'] );
	} else {
		$new_meta_value = '';
	}							

	$new_meta_value = esc_url($new_meta_value);	
	
	update_post_meta( $post_id, 'LinkedIn URL', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'LinkedIn URL', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'LinkedIn URL', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'LinkedIn URL', $meta_value );*/
}

function identity_save_post_format_pinterest_field( $post_id, $post ) {

	if(isset ($_POST['sentient_meta_box_linkedin'])){
		if ( !wp_verify_nonce( $_POST['sentient_meta_box_pinterest'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Pinterest URL', true );
	
	if(isset ($_POST['post-pinterest'])){
		$new_meta_value = stripslashes( $_POST['post-pinterest'] );
	} else {
		$new_meta_value = '';
	}							

	$new_meta_value = esc_url($new_meta_value);	
	
	update_post_meta( $post_id, 'Pinterest URL', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Pinterest URL', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Pinterest URL', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Pinterest URL', $meta_value );*/
}

function identity_save_post_format_google_field( $post_id, $post ) {

	if(isset ($_POST['sentient_meta_box_google'])){
		if ( !wp_verify_nonce( $_POST['sentient_meta_box_google'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Google URL', true );
	
	if(isset ($_POST['post-google'])){
		$new_meta_value = stripslashes( $_POST['post-google'] );
	} else {
		$new_meta_value = '';
	}								

	$new_meta_value = esc_url($new_meta_value);	
	
	update_post_meta( $post_id, 'Google URL', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Google URL', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Google URL', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Google URL', $meta_value );*/
}


function identity_save_post_format_flickr_field( $post_id, $post ) {

	if(isset ($_POST['sentient_meta_box_flickr'])){
		if ( !wp_verify_nonce( $_POST['sentient_meta_box_flickr'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Flickr URL', true );
	
	if(isset ($_POST['post-flickr'])){
		$new_meta_value = stripslashes( $_POST['post-flickr'] );
	} else {
		$new_meta_value = '';
	}											

	$new_meta_value = esc_url($new_meta_value);	
	
	update_post_meta( $post_id, 'Flickr URL', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Flickr URL', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Flickr URL', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Flickr URL', $meta_value );*/
}


function identity_save_video_post_format_URL_field( $post_id, $post ) {

	if(isset ($_POST['sentient_meta_box_video'])){
		if ( !wp_verify_nonce( $_POST['sentient_meta_box_video'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Post Video URL', true );
	
	if(isset ($_POST['post-video'])){
		$new_meta_value = stripslashes( $_POST['post-video'] );
	} else {
		$new_meta_value = '';
	}	

	$new_meta_value = esc_url($new_meta_value);	

	update_post_meta( $post_id, 'Post Video URL', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Post Video URL', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Post Video URL', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Post Video URL', $meta_value );*/
}

function identity_save_audio_post_format_URL_field( $post_id, $post ) {

	if(isset ($_POST['sentient_meta_box_audio'])){
		if ( !wp_verify_nonce( $_POST['sentient_meta_box_audio'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Post Audio Shortcode', true );
	
	if(isset ($_POST['post-audio'])){
		$new_meta_value = stripslashes( $_POST['post-audio'] );
	} else {
		$new_meta_value = '';
	}		

	$new_meta_value = sanitize_text_field($new_meta_value);

	update_post_meta( $post_id, 'Post Audio Shortcode', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Post Audio Shortcode', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Post Audio Shortcode', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Post Audio Shortcode', $meta_value );*/
}


function identity_save_gallery_post_format_URL_field( $post_id, $post ) {

	if(isset ($_POST['identity_meta_box_gallery'])){
		if ( !wp_verify_nonce( $_POST['identity_meta_box_gallery'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Post Gallery', true );
	
	if(isset ($_POST['post-gallery'])){
		$new_meta_value = stripslashes( $_POST['post-gallery'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Post Gallery', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Post Gallery', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Post Gallery', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Post Gallery', $meta_value );*/
}



function team_save_skilltitleone_field( $post_id, $post ) {

	if(isset ($_POST['identity_meta_box_teamtitleone'])){
		if ( !wp_verify_nonce( $_POST['identity_meta_box_teamtitleone'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Skill Title One', true );
	
	if(isset ($_POST['post-teamtitleone'])){
		$new_meta_value = stripslashes( $_POST['post-teamtitleone'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Team Skill Title One', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Team Skill Title One', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Team Skill Title One', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Team Skill Title One', $meta_value );*/
}


function team_save_skillpercentageone_field( $post_id, $post ) {

	if(isset ($_POST['identity_meta_box_teampercentageone'])){
		if ( !wp_verify_nonce( $_POST['identity_meta_box_teampercentageone'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Skill Percentage One', true );
	
	if(isset ($_POST['post-teampercentageone'])){
		$new_meta_value = stripslashes( $_POST['post-teampercentageone'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Team Skill Percentage One', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Team Skill Percentage One', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Team Skill Percentage One', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Team Skill Percentage One', $meta_value );*/
}


function team_save_skilltitletwo_field( $post_id, $post ) {

	if(isset ($_POST['identity_meta_box_teamtitletwo'])){
		if ( !wp_verify_nonce( $_POST['identity_meta_box_teamtitletwo'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Skill Title Two', true );
	
	if(isset ($_POST['post-teamtitletwo'])){
		$new_meta_value = stripslashes( $_POST['post-teamtitletwo'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Team Skill Title Two', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Team Skill Title Two', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Team Skill Title Two', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Team Skill Title Two', $meta_value );*/
}

function team_save_skillpercentagetwo_field( $post_id, $post ) {

	if(isset ($_POST['identity_meta_box_teampercentagetwo'])){
		if ( !wp_verify_nonce( $_POST['identity_meta_box_teampercentagetwo'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Skill Percentage Two', true );
	
	if(isset ($_POST['post-teampercentagetwo'])){
		$new_meta_value = stripslashes( $_POST['post-teampercentagetwo'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Team Skill Percentage Two', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Team Skill Percentage Two', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Team Skill Percentage Two', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Team Skill Percentage Two', $meta_value );*/
}

function team_save_skilltitlethree_field( $post_id, $post ) {

	if(isset ($_POST['identity_meta_box_teamtitlethree'])){
		if ( !wp_verify_nonce( $_POST['identity_meta_box_teamtitlethree'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Skill Title Three', true );
	
	if(isset ($_POST['post-teamtitlethree'])){
		$new_meta_value = stripslashes( $_POST['post-teamtitlethree'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Team Skill Title Three', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Team Skill Title Three', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Team Skill Title Three', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Team Skill Title Three', $meta_value );*/
}

function team_save_skillpercentagethree_field( $post_id, $post ) {

	if(isset ($_POST['identity_meta_box_teampercentagethree'])){
		if ( !wp_verify_nonce( $_POST['identity_meta_box_teampercentagethree'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Skill Percentage Three', true );
	
	if(isset ($_POST['post-teampercentagethree'])){
		$new_meta_value = stripslashes( $_POST['post-teampercentagethree'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Team Skill Percentage Three', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Team Skill Percentage Three', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Team Skill Percentage Three', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Team Skill Percentage Three', $meta_value );*/
}


function packages_save_price_field( $post_id, $post ) {

	if(isset ($_POST['identity_meta_box_packageprice'])){
		if ( !wp_verify_nonce( $_POST['identity_meta_box_packageprice'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Package Price', true );
	
	if(isset ($_POST['post-packageprice'])){
		$new_meta_value = stripslashes( $_POST['post-packageprice'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Package Price', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Package Price', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Package Price', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Package Price', $meta_value );*/
}


function packages_save_currency_field( $post_id, $post ) {

	if(isset ($_POST['identity_meta_box_packagecurrency'])){
		if ( !wp_verify_nonce( $_POST['identity_meta_box_packagecurrency'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Package Currency', true );
	
	
	if(isset ($_POST['post-packagecurrency'])){
		$new_meta_value = stripslashes( $_POST['post-packagecurrency'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Package Currency', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Package Currency', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Package Currency', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Package Currency', $meta_value );*/
}



function packages_save_period_field( $post_id, $post ) {

	if(isset ($_POST['identity_meta_box_packageperiod'])){
		if ( !wp_verify_nonce( $_POST['identity_meta_box_packageperiod'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Package Period', true );
	
	if(isset ($_POST['post-packageperiod'])){
		$new_meta_value = stripslashes( $_POST['post-packageperiod'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Package Period', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Package Period', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Package Period', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Package Period', $meta_value );*/
}



function packages_save_minidesc_field( $post_id, $post ) {

	if(isset ($_POST['identity_meta_box_minidesc'])){
		if ( !wp_verify_nonce( $_POST['identity_meta_box_minidesc'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Package Mini Description', true );
	
	if(isset ($_POST['post-minidesc'])){
		$new_meta_value = stripslashes( $_POST['post-minidesc'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Package Mini Description', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Package Mini Description', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Package Mini Description', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Package Mini Description', $meta_value );*/
}


function packages_save_active_field( $post_id, $post ) {

	if(isset ($_POST['identity_meta_box_active'])){
		if ( !wp_verify_nonce( $_POST['identity_meta_box_active'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Package Active', true );
	
	if(isset ($_POST['post-active'])){
		$new_meta_value = stripslashes( $_POST['post-active'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Package Active', $new_meta_value );
		
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Package Active', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Package Active', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Package Active', $meta_value );*/
}

function packages_save_animation_field( $post_id, $post ) {

	if(isset ($_POST['identity_meta_box_animation'])){
		if ( !wp_verify_nonce( $_POST['identity_meta_box_animation'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Package Animation', true );
	
	if(isset ($_POST['post-animation'])){
		$new_meta_value = stripslashes( $_POST['post-animation'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Package Animation', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Package Animation', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Package Animation', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Package Animation', $meta_value );*/
}


function post_save_icons_list( $post_id, $post ) {

	if(isset ($_POST['meta_box_icon'])){
		if ( !wp_verify_nonce( $_POST['meta_box_icon'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Icon', true );
	
	if(isset ($_POST['post-icon'])){
		$new_meta_value = stripslashes( $_POST['post-icon'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Icon', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Icon', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Icon', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Icon', $meta_value );*/
}

function identity_save_portfolio_layout_field( $post_id, $post ) {

	if(isset ($_POST['identity_meta_box_portfoliolayout'])){
		if ( !wp_verify_nonce( $_POST['identity_meta_box_portfoliolayout'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	


	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Portfolio Layout', true );
	
	if(isset ($_POST['portfoliolayout-shortcode'])){
		$new_meta_value = stripslashes( $_POST['portfoliolayout-shortcode'] );
	} else {
		$new_meta_value = '';
	}

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Portfolio Layout', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Portfolio Layout', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Portfolio Layout', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Portfolio Layout', $meta_value );*/
}

function identity_team_save_socialone_field( $post_id, $post ) {

	if(isset ($_POST['identity_meta_box_teamsocialone'])){
		if ( !wp_verify_nonce( $_POST['identity_meta_box_teamsocialone'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	


	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Social One', true );
	
	if(isset ($_POST['teamsocialone-shortcode'])){
		$new_meta_value = stripslashes( $_POST['teamsocialone-shortcode'] );
	} else {
		$new_meta_value = '';
	}

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Team Social One', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Team Social One', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Team Social One', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Team Social One', $meta_value );*/
}


function identity_team_save_socialone_link( $post_id, $post ) {

	if(isset ($_POST['identity_meta_box_teamsocialonelink'])){
		if ( !wp_verify_nonce( $_POST['identity_meta_box_teamsocialonelink'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	


	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Social One Link', true );
	
	if(isset ($_POST['teamsocialonelink-shortcode'])){
		$new_meta_value = stripslashes( $_POST['teamsocialonelink-shortcode'] );
	} else {
		$new_meta_value = '';
	}

	$new_meta_value = esc_url($new_meta_value);	
	
	update_post_meta( $post_id, 'Team Social One Link', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Team Social One Link', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Team Social One Link', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Team Social One Link', $meta_value );*/
}

function identity_team_save_socialtwo_field( $post_id, $post ) {

	if(isset ($_POST['identity_meta_box_teamsocialtwo'])){
		if ( !wp_verify_nonce( $_POST['identity_meta_box_teamsocialtwo'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	


	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Social Two', true );
	
	if(isset ($_POST['teamsocialtwo-shortcode'])){
		$new_meta_value = stripslashes( $_POST['teamsocialtwo-shortcode'] );
	} else {
		$new_meta_value = '';
	}

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Team Social Two', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Team Social Two', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Team Social Two', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Team Social Two', $meta_value );*/
}

function identity_team_save_socialtwo_link( $post_id, $post ) {

	if(isset ($_POST['identity_meta_box_teamsocialtwolink'])){
		if ( !wp_verify_nonce( $_POST['identity_meta_box_teamsocialtwolink'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	


	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Social Two Link', true );
	
	if(isset ($_POST['teamsocialtwolink-shortcode'])){
		$new_meta_value = stripslashes( $_POST['teamsocialtwolink-shortcode'] );
	} else {
		$new_meta_value = '';
	}

	$new_meta_value = esc_url($new_meta_value);	
	
	update_post_meta( $post_id, 'Team Social Two Link', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Team Social Two Link', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Team Social Two Link', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Team Social Two Link', $meta_value );*/
}

function identity_team_save_socialthree_field( $post_id, $post ) {

	if(isset ($_POST['identity_meta_box_teamsocialthree'])){
		if ( !wp_verify_nonce( $_POST['identity_meta_box_teamsocialthree'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	


	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Social Three', true );
	
	if(isset ($_POST['teamsocialthree-shortcode'])){
		$new_meta_value = stripslashes( $_POST['teamsocialthree-shortcode'] );
	} else {
		$new_meta_value = '';
	}

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Team Social Three', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Team Social Three', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Team Social Three', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Team Social Three', $meta_value );*/
}


function identity_present_save_position( $post_id, $post ) {

	if(isset ($_POST['identity_meta_box_presentposition'])){
		if ( !wp_verify_nonce( $_POST['identity_meta_box_presentposition'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	


	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Present Position', true );
	
	if(isset ($_POST['presentposition-shortcode'])){
		$new_meta_value = stripslashes( $_POST['presentposition-shortcode'] );
	} else {
		$new_meta_value = '';
	}

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Present Position', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Present Position', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Present Position', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Present Position', $meta_value );*/
}



function identity_education_save_university( $post_id, $post ) {

	if(isset ($_POST['identity_meta_box_educationuniversity'])){
		if ( !wp_verify_nonce( $_POST['identity_meta_box_educationuniversity'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	


	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Education University', true );
	
	if(isset ($_POST['educationuniversity-shortcode'])){
		$new_meta_value = stripslashes( $_POST['educationuniversity-shortcode'] );
	} else {
		$new_meta_value = '';
	}

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Education University', $new_meta_value );
		
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Education University', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Education University', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Education University', $meta_value );*/
}


function identity_present_save_period( $post_id, $post ) {

	if(isset ($_POST['identity_meta_box_presentperiod'])){
		if ( !wp_verify_nonce( $_POST['identity_meta_box_presentperiod'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	


	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Present Period', true );
	
	if(isset ($_POST['presentperiod-shortcode'])){
		$new_meta_value = stripslashes( $_POST['presentperiod-shortcode'] );
	} else {
		$new_meta_value = '';
	}

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Present Period', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Present Period', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Present Period', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Present Period', $meta_value );*/
}




function identity_team_save_socialthree_link( $post_id, $post ) {

	if(isset ($_POST['identity_meta_box_teamsocialthreelink'])){
		if ( !wp_verify_nonce( $_POST['identity_meta_box_teamsocialthreelink'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	


	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Social Three Link', true );
	
	if(isset ($_POST['teamsocialthreelink-shortcode'])){
		$new_meta_value = stripslashes( $_POST['teamsocialthreelink-shortcode'] );
	} else {
		$new_meta_value = '';
	}

	$new_meta_value = esc_url($new_meta_value);	
	
	update_post_meta( $post_id, 'Team Social Three Link', $new_meta_value );
	
	/*if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Team Social Three Link', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Team Social Three Link', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Team Social Three Link', $meta_value );*/
}
/*------------------------------------------------------
identity , Add Custom Fields to the Post Formats (Save Values) - End
-------------------------------------------------------*/



/*------------------------------------------------------
identity Comments - Started
-------------------------------------------------------*/
function identity_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
	?>
	<<?php echo esc_attr($tag) ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-content">
	<?php endif; ?>
	<div class="avatar">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment,54 ); ?>
	</div>
	<div class="comment-box">
		<div class="comment-meta">
			<?php printf(__('%s'  , "sentient"), get_comment_author_link()); ?> , <?php _e("on" , "sentient"); ?> <?php echo get_comment_date('M' , $comment->comment_ID ) . ' ' . get_comment_date('j' , $comment->comment_ID ) . ', ' . get_comment_date('Y' , $comment->comment_ID ); ?> <?php _e("at" , "sentient"); ?> <?php echo comment_time('H:i'); ?>
			<span class="pull-right"><?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
		</div>
		<div class="comment-text">
			<?php comment_text() ?>
		</div>
	</div>
	
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
	<?php
}
/*------------------------------------------------------
identity Comments - End
-------------------------------------------------------*/



/*------------------------------------------------------
Identity Search - Started
-------------------------------------------------------*/
function identity_search_form( $form ) {

    $form = '
	<form role="search" method="get" class="search-form" id="search-form" action="' . home_url( '/' ) . '">
		<input type="text" placeholder="' . __("Search" , "sentient") . '" name="s" id="s" class="search-input form-control">
		<button type="submit" title="' . __("Search" , "sentient") . '" name="submit" class="submit"><i class="fa fa-search"></i></button>
	</form>	
	';

    return $form;
}

/*------------------------------------------------------
Identity Search - End
-------------------------------------------------------*/




/*------------------------------------------------------
Identity Category List - Started
-------------------------------------------------------*/
function categories_postcount_filter ($variable) {
   $variable = str_replace('(', '<span class="post_count"> ', $variable);
   $variable = str_replace(')', ' </span>', $variable);
   return $variable;
}
/*------------------------------------------------------
Identity Category List - End
-------------------------------------------------------*/



/*------------------------------------------------------
Identity Importer - Started
-------------------------------------------------------*/
require dirname( __FILE__ ) . '/importer/init.php';
/*------------------------------------------------------
Identity Importer - Started
-------------------------------------------------------*/



/*------------------------------------------------------
Identity Page Title - Started
-------------------------------------------------------*/
function identity_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;


	$title .= get_bloginfo( 'name' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";


	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'sentient' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'identity_wp_title', 10, 2 );

/*------------------------------------------------------
Identity Page Title - Started
-------------------------------------------------------*/




/*------------------------------------------------------
Identity Admin Panel - Started
-------------------------------------------------------*/
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri().'/admin/');
	require_once dirname( __FILE__ ) . '/admin/options-framework.php';
}
/*------------------------------------------------------
Identity Admin Panel - End
-------------------------------------------------------*/




/***************************************************/
/*Identity Import CSS Styles - Started*/
/***************************************************/
function identity_Import_CSS(){

	$file = get_template_directory() . '/identity-styles.css';
	
	// Append a new person to the file
	$current = Identity_Generate_CSS();
	
	// Write the contents back to the file
	file_put_contents($file, $current);

}
/***************************************************/
/*Identity Import CSS Styles - End*/
/***************************************************/



/***************************************************/
/*Identity Generate CSS Styles - Started*/
/***************************************************/

function Identity_Generate_CSS(){

	global $prof_default;

	$GetStyle = "";
	
	// Apply Dynamic CSS
	$GetStyle .= "";
	$getcorrectbodyfont = str_replace('+', ' ', of_get_option('select_font',$prof_default));
	
	$getcorrectheadingonefont = str_replace('+', ' ', of_get_option('h1_font',$prof_default));
	$getcorrectheadingtwofont = str_replace('+', ' ', of_get_option('h2_font',$prof_default));
	$getcorrectheadingthreefont = str_replace('+', ' ', of_get_option('h3_font',$prof_default));
	$getcorrectheadingfourfont = str_replace('+', ' ', of_get_option('h4_font',$prof_default));
	$getcorrectheadingfivefont = str_replace('+', ' ', of_get_option('h5_font',$prof_default));
	$getcorrectheadingSixfont = str_replace('+', ' ', of_get_option('h6_font',$prof_default));
	
	// HTML styles	
	$GetStyle .= "
		
		@font-face{font-family: entypo; src: url(" . get_template_directory_uri(). "/fonts/entypo.woff);}		
		@font-face{font-family: entyposocial; src: url(" . get_template_directory_uri(). "/fonts/entypo-social.woff);}
		@font-face{font-family: fontello; src: url(" . get_template_directory_uri(). "/fonts/fontello.woff);}
		@font-face{font-family: fontawesome; src: url(" . get_template_directory_uri(). "/fonts/fontawesome-webfont.woff);}				
		
		.header .heading,
		input, textarea,
		.wpb_wrapper, .wpb_wrapper p,
		.wpb_wrapper p span:not(.fa), .wpb_wrapper span:not(.fa),
		.wpb_wrapper span p, .ui-widget, body{
			font-family: " . $getcorrectbodyfont . " !important;
		}
		
		.wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a{
			font-family: " . $getcorrectbodyfont . " !important;
		}
		
		.wpb_accordion_content{
			font-family: " . $getcorrectbodyfont . " !important;
		}
		
		footer {background:" . of_get_option('foo_color',$prof_default) . ";}
		
		.header .box-heading,
		.number-counters strong {
			font-family: " . $getcorrectheadingtwofont . ";
		}
		
		.counters-item strong,
		.section-title h1:not(.layerslider-heading) span{
			font-family: " . $getcorrectheadingonefont . " !important;
		}
		
		h1:not(.layerslider-heading){color:" . of_get_option('h1_color',$prof_default) . "; font-family: " . $getcorrectheadingonefont . " !important; font-size: " . of_get_option('h1_font_size',$prof_default) . " !important; line-height: " . of_get_option('h1_line_height',$prof_default) . " !important;}
		h2:not(.layerslider-heading){color:" . of_get_option('h2_color',$prof_default) . "; font-family: " . $getcorrectheadingtwofont . " !important; font-size: " . of_get_option('h2_font_size',$prof_default) . " !important; line-height: " . of_get_option('h2_line_height',$prof_default) . " !important;}
		h3:not(.layerslider-heading){color:" . of_get_option('h3_color',$prof_default) . "; font-family: " . $getcorrectheadingthreefont . " !important; font-size: " . of_get_option('h3_font_size',$prof_default) . " !important; line-height: " . of_get_option('h3_line_height',$prof_default) . " !important;}
		h4:not(.layerslider-heading){color:" . of_get_option('h4_color',$prof_default) . "; font-family: " . $getcorrectheadingfourfont . " !important; font-size: " . of_get_option('h4_font_size',$prof_default) . " !important; line-height: " . of_get_option('h4_line_height',$prof_default) . " !important;}			
		h5:not(.layerslider-heading){color:" . of_get_option('h5_color',$prof_default) . ";font-family: " . $getcorrectheadingfivefont . " !important;font-size: " . of_get_option('h5_font_size',$prof_default) . " !important;line-height: " . of_get_option('h5_line_height',$prof_default) . " !important;}
		h6:not(.layerslider-heading){color:" . of_get_option('h6_color',$prof_default) . "; font-family: " . $getcorrectheadingSixfont . " !important; font-size: " . of_get_option('h6_font_size',$prof_default) . " !important; line-height: " . of_get_option('h6_line_height',$prof_default) . " !important;}			
		
		.wpb_toggle:not(.layerslider-heading), #content h4.wpb_toggle:not(.layerslider-heading){
			background-color: #f5f5f5 !important;
			border: 1px solid #dddddd !important;
			color: #333333 !important;
			padding:10px 15px !important;
			border-radius:3px !important;			
			font-size: 16px !important;
			line-height:1.5 !important;			
		}
		
		.wpb_toggle.wpb_toggle_title_active:not(.layerslider-heading){margin-bottom:-1px !important;}
		
		.wpb_toggle_content {
		  border: 1px solid #dddddd;
		  border-radius: 0 0 3px 3px;
		  margin-bottom: 5px !important;
		  padding: 15px !important;
		  margin-top:0 !important;
		}		
		
		.logo{margin-top:" . of_get_option('theme_site_logo_padding_top',$prof_default) . "; margin-bottom:" . of_get_option('theme_site_logo_padding_bottom',$prof_default) . "; margin-left:" . of_get_option('theme_site_logo_padding_left',$prof_default) . ";margin-right:" . of_get_option('theme_site_logo_padding_right',$prof_default) . ";}		

		.flickr_badge_image:hover{border-color:" . of_get_option('theme_color',$prof_default) . " !important;}
		
		.proftheme-widget ul li a.sentient-widget-recent-post-title:hover,{color:" . of_get_option('theme_color',$prof_default) . " !important;}
		
		.wpb_toggle:hover, #content h4.wpb_toggle:hover{color:" . of_get_option('theme_color',$prof_default) . " !important;}
		.wpb_toggle_title_active:hover, #content h4.wpb_toggle_title_active:hover{color:" . of_get_option('theme_color',$prof_default) . " !important;}
		
		.wpb_toggle, #content h4.wpb_toggle{background-color:#f5f5f5 !important; background-image:none !important; color:#333 !important;}
		.wpb_toggle_title_active, #content h4.wpb_toggle_title_active{background-color:#f5f5f5 !important; color:#333 !important; background-image:none !important;}
				
		.wpb_tabs_nav.ui-tabs-nav.clearfix.ui-helper-reset.ui-helper-clearfix.ui-widget-header.ui-corner-all li.ui-state-default.ui-corner-top.ui-tabs-active.ui-state-active,
		.portfolio-pagination span:hover, .portfolio-pagination a.page-numbers:hover ,
		.portfolio-pagination .page-numbers:hover, #wp-calendar #today,
		.contactform .contact-form-send-btn{
			background:" . of_get_option('theme_color',$prof_default) . " !important;
		}
		
		.identity-contact input[type='submit']:hover, .identity-contact input[type='submit']:focus {
			background-color: " . of_get_option('theme_color',$prof_default) . ";
			border-color: rgba(0, 0, 0, 0);
			color: #FFFFFF;
		}
		
		#recentcomments .sentient-comments-author a:hover{color:" . of_get_option('theme_color',$prof_default) . " !important;}

		.comment-edit-link,
		a:hover:not(.sentient-button),
		.Recent-post-list li:hover,
		Recent-post-list li a:hover,
		.comment-post-title,
		#recentcomments .recentcomments a,
		#comments #respond h3,
		.reply a.comment-reply-link:hover ,
		.reply:hover{
			color:" . of_get_option('theme_color',$prof_default) . " !important;
		}
		
		
		.post .blog-entry .entry-header h4 a:hover,	.sidebar .cat-item:hover a,
		.sidebar .cat-item:hover span, .comment-info span a,
		ul li.active .d-text-c-h, .d-text-c.active, .sidebar .widget .twitter_widget ul li a,
		.d-text-c-h.active, .d-text-c-h:hover, .our-team-section .team-member:hover h6,
		.d-text-c {
			color: " . of_get_option('theme_color',$prof_default) . " !important;
		}
		
		.d-bg-c.active, .d-bg-c-h:hover, .d-bg-c-h.active, .d-bg-c {
			background: " . of_get_option('theme_color',$prof_default) . " !important;
		}

		
		.div-top:hover{border:2px solid " . of_get_option('theme_color',$prof_default) . ";}
		.div-top:hover i{color:" . of_get_option('theme_color',$prof_default) . ";}
				
		a{color: " . of_get_option('theme_color',$prof_default) . ";}
		
		.feature-content:hover > .icon-box {
			color: " . of_get_option('icon_hover_color',$prof_default) . ";
		}
		
		.process-node.active {
			background: none repeat scroll 0 0 " . of_get_option('icon_process_color',$prof_default) . ";
		}
		
		footer p a{color:" . of_get_option('theme_color',$prof_default) . " !important;}
		

		.slider-section .ls-bottom-nav-wrapper  .ls-bottom-slidebuttons a:hover,
		.slider-section .ls-bottom-nav-wrapper  .ls-bottom-slidebuttons a.ls-nav-active{
			background:" . of_get_option('theme_color',$prof_default) . " !important;
			border:2px solid " . of_get_option('theme_color',$prof_default) . " !important;
		}		
		
		.bg-callout{background-color: " . of_get_option('top_title_color',$prof_default) . "; background-image: url('" . of_get_option('top_title_image',$prof_default) . "');}
		
		#secondary a.tag:hover,
		.skillBar li span,
		.bg3 {
			background-color: " . of_get_option('theme_color',$prof_default) . ";
		}

		.timeline .note:hover:after,
		.browserImage .browserTop,
		.timeline .note:hover:after,
		.package-active,
		.icon-circular:hover i.fa,
		.icon-box,
		.dropcap1 {
			background: " . of_get_option('theme_color',$prof_default) . ";
		}

		.package-active:after,
		.icon-box:after {
			border-top-color: " . of_get_option('theme_color',$prof_default) . ";
		}

		.icon-circular i.fa{
			border:2px solid " . of_get_option('theme_color',$prof_default) . ";
			color:" . of_get_option('theme_color',$prof_default) . ";
		}

		.icon-circular:hover i.fa{
			background:" . of_get_option('theme_color',$prof_default) . ";
			color:#fff;
		}		
		
		.packages {
			border: 1px solid " . of_get_option('theme_color',$prof_default) . ";
		}

		.bg3 .section-title div span {
			color: " . of_get_option('theme_color',$prof_default) . " !important;
		}

		.btn-dark {
			border: 2px solid " . of_get_option('theme_color',$prof_default) . ";
		}		

		.wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header{
			background: #CCC !important;
			color: #222;
			cursor: pointer;
			display: block;
			outline: 0 none !important;
			padding: 0 !important;
			text-decoration: none;
			margin: 0 !important;
		}
		
		.wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a:hover{
			color: #222 !important;
		}
		
		.social-icon a:hover {
			color: #707070 !important;
		}
		
		#navigation-sticky.trans-nav {
			background: " . identity_hex2rgb(of_get_option('menu_background_color',$prof_default) , of_get_option('menu_background_color_opacity',$prof_default)) . ";
		}
		
		.darken {
			background-color: " . identity_hex2rgb(of_get_option('sticky_menu_background_color',$prof_default) , of_get_option('menu_background_color_opacity_sticky',$prof_default)) . " !important;
		}

		.blog-audio-container{background:" . of_get_option('theme_color',$prof_default) . ";}
		.proftheme-widget #searchform i.icon-search:hover{color:" . of_get_option('theme_color',$prof_default) . " !important;}
		.tagcloud a:hover{background:" . of_get_option('theme_color',$prof_default) . " !important; color:#fff !important;}
		
		";			
		
	$GetStyle .= of_get_option('css_text',$prof_default);
	$GetStyle .= " 
	
	";
	$GetStyle .= "
	
	";
	
	return $GetStyle;
}

/***************************************************/
/*Identity Import CSS Styles - End*/
/***************************************************/



function identity_hex2rgb($hex , $opacity) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $opacity . ')';
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}



/***************************************************/
/*Identity Custom Field Icon List - End*/
/***************************************************/
function create_post_icon_list( $object, $box ) { ?>
	<p>
		<label for="post-icon">Icon</label>
		<br />
		<select name="post-icon" id="post-icon" cols="60" rows="4" tabindex="30" style="width: 97%;">
			<option value="align-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'align-left'){ ?> selected="selected" <?php } ?>>Align Left</option>
			<option value="align-center" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'align-center'){ ?> selected="selected" <?php } ?>>Align Center</option>
			<option value="align-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'align-right'){ ?> selected="selected" <?php } ?>>Align Right</option>
			<option value="align-justify" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'align-justify'){ ?> selected="selected" <?php } ?>>Align Justify</option>
			<option value="arrows" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrows'){ ?> selected="selected" <?php } ?>>Arrows</option>
			<option value="arrow-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-left'){ ?> selected="selected" <?php } ?>>Align Justify</option>
			<option value="arrow-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-right'){ ?> selected="selected" <?php } ?>>Arrow Left</option>
			<option value="arrow-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-up'){ ?> selected="selected" <?php } ?>>Arrow Up</option>
			<option value="arrow-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-down'){ ?> selected="selected" <?php } ?>>Arrow Down</option>
			<option value="asterisk" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'asterisk'){ ?> selected="selected" <?php } ?>>Asterisk</option>
			<option value="arrows-v" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrows-v'){ ?> selected="selected" <?php } ?>>Arrows V</option>
			<option value="arrows-h" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrows-h'){ ?> selected="selected" <?php } ?>>Arrows H</option>
			<option value="arrow-circle-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-circle-left'){ ?> selected="selected" <?php } ?>>Arrow Circle Left</option>
			<option value="arrow-circle-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-circle-right'){ ?> selected="selected" <?php } ?>>Arrow Circle Right</option>
			<option value="arrow-circle-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-circle-up'){ ?> selected="selected" <?php } ?>>Arrow Circle Up</option>
			<option value="arrow-circle-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-circle-down'){ ?> selected="selected" <?php } ?>>Arrow Circle Down</option>
			<option value="arrows-alt" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrows-alt'){ ?> selected="selected" <?php } ?>>Arrows Alt</option>
			<option value="ambulance" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'ambulance'){ ?> selected="selected" <?php } ?>>Ambulance</option>
			<option value="adn" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'adn'){ ?> selected="selected" <?php } ?>>Adn</option>
			<option value="angle-double-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-double-left'){ ?> selected="selected" <?php } ?>>Angle Double Left</option>
			<option value="angle-double-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-double-right'){ ?> selected="selected" <?php } ?>>Angle Double Right</option>
			<option value="angle-double-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-double-up'){ ?> selected="selected" <?php } ?>>Angle Double Up</option>
			<option value="angle-double-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-double-down'){ ?> selected="selected" <?php } ?>>Angle Double Down</option>
			<option value="angle-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-left'){ ?> selected="selected" <?php } ?>>Angle Left</option>
			<option value="angle-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-right'){ ?> selected="selected" <?php } ?>>Angle Right</option>
			<option value="angle-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-up'){ ?> selected="selected" <?php } ?>>Angle Up</option>
			<option value="angle-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-down'){ ?> selected="selected" <?php } ?>>Angle Down</option>
			<option value="anchor" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'anchor'){ ?> selected="selected" <?php } ?>>Anchor</option>
			<option value="android" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'android'){ ?> selected="selected" <?php } ?>>Android</option>
			<option value="apple" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'apple'){ ?> selected="selected" <?php } ?>>Apple</option>
			<option value="archive" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'archive'){ ?> selected="selected" <?php } ?>>Archive</option>
			<option value="automobile" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'automobile'){ ?> selected="selected" <?php } ?>>Archive</option>
			<option value="bars" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bars'){ ?> selected="selected" <?php } ?>>Bars</option>
			<option value="backward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'backward'){ ?> selected="selected" <?php } ?>>Backward</option>
			<option value="ban" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'ban'){ ?> selected="selected" <?php } ?>>Ban</option>
			<option value="barcode" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'barcode'){ ?> selected="selected" <?php } ?>>Barcode</option>
			<option value="bank" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bank'){ ?> selected="selected" <?php } ?>>Bank</option>
			<option value="bell" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bell'){ ?> selected="selected" <?php } ?>>Bell</option>
			<option value="book" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'book'){ ?> selected="selected" <?php } ?>>Book</option>
			<option value="bookmark" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bookmark'){ ?> selected="selected" <?php } ?>>Bookmark</option>
			<option value="bold" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bold'){ ?> selected="selected" <?php } ?>>Bold</option>
			<option value="bullhorn" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bullhorn'){ ?> selected="selected" <?php } ?>>Bullhorn</option>
			<option value="briefcase" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'briefcase'){ ?> selected="selected" <?php } ?>>Briefcase</option>
			<option value="bolt" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bolt'){ ?> selected="selected" <?php } ?>>Bolt</option>
			<option value="beer" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'beer'){ ?> selected="selected" <?php } ?>>Beer</option>
			<option value="behance" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'behance'){ ?> selected="selected" <?php } ?>>Behance</option>
			<option value="bitcoin" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bitcoin'){ ?> selected="selected" <?php } ?>>Bitcoin</option>
			<option value="bitbucket" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bitbucket'){ ?> selected="selected" <?php } ?>>Bitbucket</option>
			<option value="bomb" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bomb'){ ?> selected="selected" <?php } ?>>Bomb</option>
			<option value="glass" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'glass'){ ?> selected="selected" <?php } ?>>Glass</option>
			<option value="bullseye" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bullseye'){ ?> selected="selected" <?php } ?>>Bullseye</option>
			<option value="bug" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bug'){ ?> selected="selected" <?php } ?>>Bug</option>
			<option value="building" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'building'){ ?> selected="selected" <?php } ?>>Building</option>
			<option value="check" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'check'){ ?> selected="selected" <?php } ?>>Check</option>
			<option value="cog" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cog'){ ?> selected="selected" <?php } ?>>Cog</option>
			<option value="camera" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'camera'){ ?> selected="selected" <?php } ?>>Camera</option>
			<option value="crosshairs" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'crosshairs'){ ?> selected="selected" <?php } ?>>Cross Hairs</option>
			<option value="compress" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'compress'){ ?> selected="selected" <?php } ?>>Compress</option>
			<option value="calendar" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'calendar'){ ?> selected="selected" <?php } ?>>Calendar</option>
			<option value="comment" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'comment'){ ?> selected="selected" <?php } ?>>Comment</option>
			<option value="cogs" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cogs'){ ?> selected="selected" <?php } ?>>Cogs</option>
			<option value="comments" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'comments'){ ?> selected="selected" <?php } ?>>Comments</option>
			<option value="credit-card" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'credit-card'){ ?> selected="selected" <?php } ?>>Credit Card</option>
			<option value="certificate" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'certificate'){ ?> selected="selected" <?php } ?>>Certificate</option>
			<option value="chain" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'chain'){ ?> selected="selected" <?php } ?>>Chain</option>
			<option value="cloud" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cloud'){ ?> selected="selected" <?php } ?>>Cloud</option>
			<option value="cut" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cut'){ ?> selected="selected" <?php } ?>>Cut</option>
			<option value="copy" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'copy'){ ?> selected="selected" <?php } ?>>Copy</option>
			<option value="caret-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'caret-down'){ ?> selected="selected" <?php } ?>>Caret Down</option>
			<option value="caret-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'caret-up'){ ?> selected="selected" <?php } ?>>Caret Up</option>
			<option value="caret-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'caret-left'){ ?> selected="selected" <?php } ?>>Caret Left</option>
			<option value="caret-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'caret-right'){ ?> selected="selected" <?php } ?>>Caret Right</option>
			<option value="columns" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'columns'){ ?> selected="selected" <?php } ?>>Columns</option>
			<option value="clipboard" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'clipboard'){ ?> selected="selected" <?php } ?>>Clipboard</option>
			<option value="cloud-download" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cloud-download'){ ?> selected="selected" <?php } ?>>Cloud Download</option>
			<option value="cloud-upload" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cloud-upload'){ ?> selected="selected" <?php } ?>>Cloud Upload</option>
			<option value="coffee" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'coffee'){ ?> selected="selected" <?php } ?>>Coffee</option>
			<option value="cutlery" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cutlery'){ ?> selected="selected" <?php } ?>>Cutlery</option>
			<option value="car" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'car'){ ?> selected="selected" <?php } ?>>Car</option>
			<option value="cab" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cab'){ ?> selected="selected" <?php } ?>>Cab</option>
			<option value="chevron-circle-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'chevron-circle-left'){ ?> selected="selected" <?php } ?>>Chevron Circle Left</option>
			<option value="chevron-circle-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'chevron-circle-right'){ ?> selected="selected" <?php } ?>>Chevron Circle Right</option>
			<option value="chevron-circle-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'chevron-circle-up'){ ?> selected="selected" <?php } ?>>Chevron Circle Up</option>
			<option value="chevron-circle-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'chevron-circle-down'){ ?> selected="selected" <?php } ?>>Chevron Circle Down</option>
			<option value="check-square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'check-square'){ ?> selected="selected" <?php } ?>>Check Square</option>
			<option value="child" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'child'){ ?> selected="selected" <?php } ?>>Child</option>
			<option value="chain-broken" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'chain-broken'){ ?> selected="selected" <?php } ?>>Chain Broken</option>
			<option value="circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'circle'){ ?> selected="selected" <?php } ?>>Circle</option>
			<option value="circle-thin" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'circle-thin'){ ?> selected="selected" <?php } ?>>Circle Thin</option>
			<option value="cny" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cny'){ ?> selected="selected" <?php } ?>>CNY</option>
			<option value="code" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'code'){ ?> selected="selected" <?php } ?>>Code</option>
			<option value="compass" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'compass'){ ?> selected="selected" <?php } ?>>Compass</option>
			<option value="codepen" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'codepen'){ ?> selected="selected" <?php } ?>>Code Pen</option>
			<option value="css3" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'css3'){ ?> selected="selected" <?php } ?>>CSS3</option>
			<option value="cube" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cube'){ ?> selected="selected" <?php } ?>>Cube</option>
			<option value="cubes" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cubes'){ ?> selected="selected" <?php } ?>>Cubes</option>
			<option value="download" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'download'){ ?> selected="selected" <?php } ?>>Download</option>
			<option value="dedent" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'dedent'){ ?> selected="selected" <?php } ?>>Dedent</option>
			<option value="dashboard" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'dashboard'){ ?> selected="selected" <?php } ?>>Dashboard</option>
			<option value="database" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'database'){ ?> selected="selected" <?php } ?>>Database</option>
			<option value="glass" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'glass'){ ?> selected="selected" <?php } ?>>Glass</option>
			<option value="desktop" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'desktop'){ ?> selected="selected" <?php } ?>>Desktop</option>
			<option value="delicious" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'delicious'){ ?> selected="selected" <?php } ?>>Delicious</option>
			<option value="drupal" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'drupal'){ ?> selected="selected" <?php } ?>>Drupal</option>
			<option value="dribbble" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'dribbble'){ ?> selected="selected" <?php } ?>>Dribbble</option>
			<option value="dropbox" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'dropbox'){ ?> selected="selected" <?php } ?>>Dropbox</option>
			<option value="dollar" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'dollar'){ ?> selected="selected" <?php } ?>>Dollar</option>
			<option value="digg" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'digg'){ ?> selected="selected" <?php } ?>>Digg</option>
			<option value="exchange" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'exchange'){ ?> selected="selected" <?php } ?>>Exchange</option>
			<option value="eyedropper" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'eyedropper'){ ?> selected="selected" <?php } ?>>Eye Dropper</option>
			<option value="eject" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'eject'){ ?> selected="selected" <?php } ?>>Eject</option>
			<option value="expand" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'expand'){ ?> selected="selected" <?php } ?>>Expand</option>
			<option value="exclamation-circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'exclamation-circle'){ ?> selected="selected" <?php } ?>>Exclamation Circle</option>
			<option value="eye" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'eye'){ ?> selected="selected" <?php } ?>>Eye</option>
			<option value="eye-slash" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'eye-slash'){ ?> selected="selected" <?php } ?>>Eye Slash</option>
			<option value="exclamation-triangle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'exclamation-triangle'){ ?> selected="selected" <?php } ?>>Exclamation Triangle</option>
			<option value="external-link" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'external-link'){ ?> selected="selected" <?php } ?>>External Link</option>
			<option value="envelope" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'envelope'){ ?> selected="selected" <?php } ?>>Envelope</option>
			<option value="empire" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'empire'){ ?> selected="selected" <?php } ?>>Empire</option>
			<option value="eraser" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'eraser'){ ?> selected="selected" <?php } ?>>Eraser</option>
			<option value="exclamation" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'exclamation'){ ?> selected="selected" <?php } ?>>Exclamation</option>
			<option value="ellipsis-h" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'ellipsis-h'){ ?> selected="selected" <?php } ?>>Ellipsis H</option>
			<option value="ellipsis-v" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'ellipsis-v'){ ?> selected="selected" <?php } ?>>Ellipsis V</option>
			<option value="euro" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'euro'){ ?> selected="selected" <?php } ?>>Euro</option>
			<option value="eur" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'eur'){ ?> selected="selected" <?php } ?>>Eur</option>
			<option value="flash" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'flash'){ ?> selected="selected" <?php } ?>>Flash</option>
			<option value="fighter-jet" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'fighter-jet'){ ?> selected="selected" <?php } ?>>Fighter Jet</option>
			<option value="film" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'film'){ ?> selected="selected" <?php } ?>>Film</option>
			<option value="flag" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'flag'){ ?> selected="selected" <?php } ?>>Flag</option>
			<option value="font" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'font'){ ?> selected="selected" <?php } ?>>Font</option>
			<option value="fast-backward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'fast-backward'){ ?> selected="selected" <?php } ?>>Fast Backward</option>
			<option value="forward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'forward'){ ?> selected="selected" <?php } ?>>Forward</option>
			<option value="fast-forward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'fast-forward'){ ?> selected="selected" <?php } ?>>Fast Forward</option>
			<option value="fire" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'fire'){ ?> selected="selected" <?php } ?>>Fire</option>
			<option value="folder" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'folder'){ ?> selected="selected" <?php } ?>>Folder</option>
			<option value="folder-open" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'folder-open'){ ?> selected="selected" <?php } ?>>Folder Open</option>
			<option value="facebook" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'facebook'){ ?> selected="selected" <?php } ?>>Facebook</option>
			<option value="filter" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'filter'){ ?> selected="selected" <?php } ?>>Filter</option>
			<option value="fax" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'fax'){ ?> selected="selected" <?php } ?>>Fax</option>
			<option value="female" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'female'){ ?> selected="selected" <?php } ?>>Female</option>
			<option value="foursquare" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'foursquare'){ ?> selected="selected" <?php } ?>>foursquare</option>
			<option value="fire-extinguisher" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'fire-extinguisher'){ ?> selected="selected" <?php } ?>>Fire Extinguisher</option>
			<option value="flag-checkered" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'flag-checkered'){ ?> selected="selected" <?php } ?>>Flag Checkered</option>
			<option value="file" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'file'){ ?> selected="selected" <?php } ?>>File</option>
			<option value="file-text" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'file-text'){ ?> selected="selected" <?php } ?>>File Text</option>
			<option value="flickr" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'flickr'){ ?> selected="selected" <?php } ?>>flickr</option>
			<option value="google-plus" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'google-plus'){ ?> selected="selected" <?php } ?>>Google Plus</option>
			<option value="gavel" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gavel'){ ?> selected="selected" <?php } ?>>Gavel</option>
			<option value="glass" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'glass'){ ?> selected="selected" <?php } ?>>Glass</option>
			<option value="gear" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gear'){ ?> selected="selected" <?php } ?>>Gear</option>
			<option value="gift" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gift'){ ?> selected="selected" <?php } ?>>Gift</option>
			<option value="gears" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gears'){ ?> selected="selected" <?php } ?>>Gears</option>
			<option value="github" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'github'){ ?> selected="selected" <?php } ?>>Github</option>
			<option value="globe" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'globe'){ ?> selected="selected" <?php } ?>>Globe</option>
			<option value="group" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'group'){ ?> selected="selected" <?php } ?>>Group</option>
			<option value="google" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'google'){ ?> selected="selected" <?php } ?>>Google</option>
			<option value="graduation-cap" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'graduation-cap'){ ?> selected="selected" <?php } ?>>Graduation Cap</option>
			<option value="gittip" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gittip'){ ?> selected="selected" <?php } ?>>Gittip</option>
			<option value="gbp" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gbp'){ ?> selected="selected" <?php } ?>>GBP</option>
			<option value="gamepad" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gamepad'){ ?> selected="selected" <?php } ?>>Game Pad</option>
			<option value="git" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'git'){ ?> selected="selected" <?php } ?>>GIT</option>
			<option value="heart" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'heart'){ ?> selected="selected" <?php } ?>>Heart</option>
			<option value="home" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'home'){ ?> selected="selected" <?php } ?>>Home</option>
			<option value="headphones" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'headphones'){ ?> selected="selected" <?php } ?>>Headphones</option>
			<option value="header" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'header'){ ?> selected="selected" <?php } ?>>Header</option>
			<option value="history" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'history'){ ?> selected="selected" <?php } ?>>History</option>
			<option value="hacker-news" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hacker-news'){ ?> selected="selected" <?php } ?>>Hacker News</option>
			<option value="html5" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'html5'){ ?> selected="selected" <?php } ?>>HTML5</option>
			<option value="h-square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'h-square'){ ?> selected="selected" <?php } ?>>H Square</option>
			<option value="italic" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'italic'){ ?> selected="selected" <?php } ?>>Italic</option>
			<option value="indent" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'indent'){ ?> selected="selected" <?php } ?>>Indent</option>
			<option value="image" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'image'){ ?> selected="selected" <?php } ?>>Image</option>
			<option value="inverse" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'inverse'){ ?> selected="selected" <?php } ?>>Inverse</option>
			<option value="inbox" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'inbox'){ ?> selected="selected" <?php } ?>>Inbox</option>
			<option value="institution" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'institution'){ ?> selected="selected" <?php } ?>>Institution</option>
			<option value="instagram" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'instagram'){ ?> selected="selected" <?php } ?>>Instagram</option>
			<option value="inr" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'inr'){ ?> selected="selected" <?php } ?>>INR</option>
			<option value="info" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'info'){ ?> selected="selected" <?php } ?>>Info</option>
			<option value="jsfiddle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'jsfiddle'){ ?> selected="selected" <?php } ?>>JS Fiddle</option>
			<option value="joomla" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'joomla'){ ?> selected="selected" <?php } ?>>Joomla</option>
			<option value="jpy" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'jpy'){ ?> selected="selected" <?php } ?>>JPY</option>
			<option value="key" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'key'){ ?> selected="selected" <?php } ?>>Key</option>
			<option value="krw" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'krw'){ ?> selected="selected" <?php } ?>>KRW</option>
			<option value="link" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'link'){ ?> selected="selected" <?php } ?>>Link</option>
			<option value="list-ul" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'list-ul'){ ?> selected="selected" <?php } ?>>List Ul</option>
			<option value="list-ol" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'list-ol'){ ?> selected="selected" <?php } ?>>List OL</option>
			<option value="linkedin" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'linkedin'){ ?> selected="selected" <?php } ?>>LinkedIn</option>
			<option value="legal" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'legal'){ ?> selected="selected" <?php } ?>>Legal</option>
			<option value="list-alt" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'list-alt'){ ?> selected="selected" <?php } ?>>List Alt</option>
			<option value="lock" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'lock'){ ?> selected="selected" <?php } ?>>Lock</option>
			<option value="list" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'list'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="leaf" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'leaf'){ ?> selected="selected" <?php } ?>>Leaf</option>
			<option value="life-bouy" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'life-bouy'){ ?> selected="selected" <?php } ?>>Lifebouy</option>
			<option value="life-saver" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'life-saver'){ ?> selected="selected" <?php } ?>>Life Saver</option>
			<option value="language" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'language'){ ?> selected="selected" <?php } ?>>Language</option>
			<option value="laptop" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'laptop'){ ?> selected="selected" <?php } ?>>Laptop</option>
			<option value="level-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'level-up'){ ?> selected="selected" <?php } ?>>Level up</option>
			<option value="level-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'level-down'){ ?> selected="selected" <?php } ?>>Level Down</option>
			<option value="linux" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'linux'){ ?> selected="selected" <?php } ?>>Linux</option>
			<option value="life-ring" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'life-ring'){ ?> selected="selected" <?php } ?>>Life Ring</option>
			<option value="magnet" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'magnet'){ ?> selected="selected" <?php } ?>>Magnet</option>
			<option value="map-marker" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'map-marker'){ ?> selected="selected" <?php } ?>>Map Marker</option>
			<option value="magic" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'magic'){ ?> selected="selected" <?php } ?>>Magic</option>
			<option value="money" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'money'){ ?> selected="selected" <?php } ?>>Money</option>
			<option value="medkit" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'medkit'){ ?> selected="selected" <?php } ?>>Med kit</option>
			<option value="music" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'music'){ ?> selected="selected" <?php } ?>>Music</option>
			<option value="mail-forward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'mail-forward'){ ?> selected="selected" <?php } ?>>Mail Forward</option>
			<option value="minus" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'minus'){ ?> selected="selected" <?php } ?>>Minus</option>
			<option value="mortar-board" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'mortar-board'){ ?> selected="selected" <?php } ?>>Mortar Board</option>
			<option value="male" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'male'){ ?> selected="selected" <?php } ?>>Male</option>
			<option value="mobile-phone" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'mobile-phone'){ ?> selected="selected" <?php } ?>>Mobile Phone</option>
			<option value="mobile" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'mobile'){ ?> selected="selected" <?php } ?>>Mobile</option>
			<option value="mail-reply" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'mail-reply'){ ?> selected="selected" <?php } ?>>Mail Reply</option>
			<option value="microphone" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'microphone'){ ?> selected="selected" <?php } ?>>Microphone</option>
			<option value="microphone-slash" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'microphone-slash'){ ?> selected="selected" <?php } ?>>Microphone Slash</option>
			<option value="navicon" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'navicon'){ ?> selected="selected" <?php } ?>>Nav icon</option>
			<option value="lightbulb-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'lightbulb-o'){ ?> selected="selected" <?php } ?>>Open Lightbulb</option>
			<option value="bell-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bell-o'){ ?> selected="selected" <?php } ?>>Open Bell</option>
			<option value="building-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'building-o'){ ?> selected="selected" <?php } ?>>Open Building</option>
			<option value="hospital-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hospital-o'){ ?> selected="selected" <?php } ?>>Open Hospital</option>
			<option value="envelope-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'envelope-o'){ ?> selected="selected" <?php } ?>>Open Envelope</option>
			<option value="star-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'star-o'){ ?> selected="selected" <?php } ?>>Open Star</option>
			<option value="trash-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'trash-o'){ ?> selected="selected" <?php } ?>>Open Trash</option>
			<option value="file-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'file-o'){ ?> selected="selected" <?php } ?>>Open File</option>
			<option value="clock-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'clock-o'){ ?> selected="selected" <?php } ?>>Open Clock</option>
			<option value="outdent" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'outdent'){ ?> selected="selected" <?php } ?>>Outdent</option>
			<option value="picture-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'picture-o'){ ?> selected="selected" <?php } ?>>Open Picture</option>
			<option value="pencil-square-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pencil-square-o'){ ?> selected="selected" <?php } ?>>Open Pencil Square</option>
			<option value="bar-chart-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bar-chart-o'){ ?> selected="selected" <?php } ?>>Open Bar Chart</option>
			<option value="thumbs-o-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'thumbs-o-up'){ ?> selected="selected" <?php } ?>>Open Thumbs Up</option>
			<option value="thumbs-o-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'thumbs-o-down'){ ?> selected="selected" <?php } ?>>Open Thumbs Down</option>
			<option value="heart-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'heart-o'){ ?> selected="selected" <?php } ?>>Open Heart</option>
			<option value="lemon-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'lemon-o'){ ?> selected="selected" <?php } ?>>Open Lemon</option>
			<option value="square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'square'){ ?> selected="selected" <?php } ?>>Open Square</option>
			<option value="bookmark-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bookmark-o'){ ?> selected="selected" <?php } ?>>Open Bookmark</option>
			<option value="hdd-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hdd-o'){ ?> selected="selected" <?php } ?>>Open hdd</option>
			<option value="hand-o-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hand-o-right'){ ?> selected="selected" <?php } ?>>Open Hand Right</option>
			<option value="hand-o-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hand-o-left'){ ?> selected="selected" <?php } ?>>Open Hand Left</option>
			<option value="hand-o-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hand-o-up'){ ?> selected="selected" <?php } ?>>Open Hand Up</option>
			<option value="hand-o-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hand-o-down'){ ?> selected="selected" <?php } ?>>Open Hand Down</option>
			<option value="files-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'files-o'){ ?> selected="selected" <?php } ?>>Open Files</option>
			<option value="floppy-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'floppy-o'){ ?> selected="selected" <?php } ?>>Open Floppy</option>
			<option value="circle-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'circle-o'){ ?> selected="selected" <?php } ?>>Open Circle</option>
			<option value="folder-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'folder-o'){ ?> selected="selected" <?php } ?>>Open Folder</option>
			<option value="smile-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'smile-o'){ ?> selected="selected" <?php } ?>>Open Smile</option>
			<option value="pinterest" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pinterest'){ ?> selected="selected" <?php } ?>>Pinterest</option>
			<option value="paste" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'paste'){ ?> selected="selected" <?php } ?>>Paste</option>
			<option value="power-off" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'power-off'){ ?> selected="selected" <?php } ?>>Power Off</option>
			<option value="print" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'print'){ ?> selected="selected" <?php } ?>>Print</option>
			<option value="photo" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'photo'){ ?> selected="selected" <?php } ?>>Photo</option>
			<option value="play" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'play'){ ?> selected="selected" <?php } ?>>Play</option>
			<option value="pause" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pause'){ ?> selected="selected" <?php } ?>>Pause</option>
			<option value="plus-circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'plus-circle'){ ?> selected="selected" <?php } ?>>Plus Circle</option>
			<option value="plus" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'plus'){ ?> selected="selected" <?php } ?>>Plus</option>
			<option value="plane" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'plane'){ ?> selected="selected" <?php } ?>>Plane</option>
			<option value="phone" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'phone'){ ?> selected="selected" <?php } ?>>Phone</option>
			<option value="phone-square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'phone-square'){ ?> selected="selected" <?php } ?>>Phone Square</option>
			<option value="paperclip" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'paperclip'){ ?> selected="selected" <?php } ?>>Paper Clip</option>
			<option value="puzzle-piece" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'puzzle-piece'){ ?> selected="selected" <?php } ?>>Puzzle Piece</option>
			<option value="play-circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'play-circle'){ ?> selected="selected" <?php } ?>>Play Circle</option>
			<option value="pencil-square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pencil-square'){ ?> selected="selected" <?php } ?>>Pencil Square</option>
			<option value="pagelines" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pagelines'){ ?> selected="selected" <?php } ?>>Page Lines</option>
			<option value="pied-piper-square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pied-piper-square'){ ?> selected="selected" <?php } ?>>Pied Piper Square</option>
			<option value="pied-piper" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pied-piper'){ ?> selected="selected" <?php } ?>>Pied Piper</option>
			<option value="pied-piper-alt" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pied-piper-alt'){ ?> selected="selected" <?php } ?>>Pied Piper Alt</option>
			<option value="paw" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'paw'){ ?> selected="selected" <?php } ?>>Paw</option>
			<option value="paper-plane" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'paper-plane'){ ?> selected="selected" <?php } ?>>Paper Plane</option>
			<option value="paragraph" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'paragraph'){ ?> selected="selected" <?php } ?>>Paragraph</option>
			<option value="plus-square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'plus-square'){ ?> selected="selected" <?php } ?>>Plus Square</option>
			<option value="qrcode" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'qrcode'){ ?> selected="selected" <?php } ?>>QR Code</option>
			<option value="question-circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'question-circle'){ ?> selected="selected" <?php } ?>>Question Circle</option>
			<option value="question" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'question'){ ?> selected="selected" <?php } ?>>Question</option>
			<option value="qq" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'qq'){ ?> selected="selected" <?php } ?>>QQ</option>
			<option value="quote-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'quote-left'){ ?> selected="selected" <?php } ?>>Quote Left</option>
			<option value="quote-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'quote-right'){ ?> selected="selected" <?php } ?>>Quote Right</option>
			<option value="random" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'random'){ ?> selected="selected" <?php } ?>>Random</option>
			<option value="retweet" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'retweet'){ ?> selected="selected" <?php } ?>>Retweet</option>
			<option value="rss" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rss'){ ?> selected="selected" <?php } ?>>RSS</option>
			<option value="reorder" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'reorder'){ ?> selected="selected" <?php } ?>>Reorder</option>
			<option value="rotate-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rotate-left'){ ?> selected="selected" <?php } ?>>Rotate Left</option>
			<option value="rotate-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rotate-right'){ ?> selected="selected" <?php } ?>>Rotate Right</option>
			<option value="road" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'road'){ ?> selected="selected" <?php } ?>>Road</option>
			<option value="repeat" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'repeat'){ ?> selected="selected" <?php } ?>>Repeat</option>
			<option value="refresh" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'refresh'){ ?> selected="selected" <?php } ?>>Refresh</option>
			<option value="reply" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'reply'){ ?> selected="selected" <?php } ?>>Reply</option>
			<option value="rocket" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rocket'){ ?> selected="selected" <?php } ?>>Rocket</option>
			<option value="rupee" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rupee'){ ?> selected="selected" <?php } ?>>Rupee</option>
			<option value="rmb" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rmb'){ ?> selected="selected" <?php } ?>>RMB</option>
			<option value="ruble" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'ruble'){ ?> selected="selected" <?php } ?>>Ruble</option>
			<option value="rouble" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rouble'){ ?> selected="selected" <?php } ?>>Rouble</option>
			<option value="rub" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rub'){ ?> selected="selected" <?php } ?>>Rub</option>
			<option value="renren" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'renren'){ ?> selected="selected" <?php } ?>>Renren</option>
			<option value="reddit" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'reddit'){ ?> selected="selected" <?php } ?>>Reddit</option>
			<option value="recycle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'recycle'){ ?> selected="selected" <?php } ?>>Recycle</option>
			<option value="rebel" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rebel'){ ?> selected="selected" <?php } ?>>Rebel</option>
			<option value="step-backward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'step-backward'){ ?> selected="selected" <?php } ?>>Step Backward</option>
			<option value="stop" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'stop'){ ?> selected="selected" <?php } ?>>Stop</option>
			<option value="step-forward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'step-forward'){ ?> selected="selected" <?php } ?>>Step Forward</option>
			<option value="shopping-cart" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'shopping-cart'){ ?> selected="selected" <?php } ?>>Shopping Cart</option>
			<option value="star-half" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'star-half'){ ?> selected="selected" <?php } ?>>Star Half</option>
			<option value="sign-out" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'sign-out'){ ?> selected="selected" <?php } ?>>Sign Out</option>
			<option value="sign-in" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'sign-in'){ ?> selected="selected" <?php } ?>>Sign In</option>
			<option value="scissors" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'scissors'){ ?> selected="selected" <?php } ?>>Scissors</option>
			<option value="save" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'save'){ ?> selected="selected" <?php } ?>>Save</option>
			<option value="square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'square'){ ?> selected="selected" <?php } ?>>Square</option>
			<option value="strikethrough" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'strikethrough'){ ?> selected="selected" <?php } ?>>Strike Through</option>
			<option value="sort" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'sort'){ ?> selected="selected" <?php } ?>>Sort</option>
			<option value="sort-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'sort-down'){ ?> selected="selected" <?php } ?>>Sort Down</option>
			<option value="sitemap" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'sitemap'){ ?> selected="selected" <?php } ?>>Site map</option>
			<option value="search" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'search'){ ?> selected="selected" <?php } ?>>Search</option>
			<option value="star" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'star'){ ?> selected="selected" <?php } ?>>Star</option>
			<option value="stethoscope" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'stethoscope'){ ?> selected="selected" <?php } ?>>Stethoscope</option>
			<option value="suitcase" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'suitcase'){ ?> selected="selected" <?php } ?>>Suitcase</option>
			<option value="search-plus" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'search-plus'){ ?> selected="selected" <?php } ?>>Search Plus</option>
			<option value="search-minus" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'search-minus'){ ?> selected="selected" <?php } ?>>Search Minus</option>
			<option value="signal" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'signal'){ ?> selected="selected" <?php } ?>>Signal</option>
			<option value="spinner" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'spinner'){ ?> selected="selected" <?php } ?>>Spinner</option>
			<option value="superscript" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'superscript'){ ?> selected="selected" <?php } ?>>Superscript</option>
			<option value="subscript" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'subscript'){ ?> selected="selected" <?php } ?>>Subscript</option>
			<option value="shield" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'shield'){ ?> selected="selected" <?php } ?>>Shield</option>
			<option value="stack-overflow" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'stack-overflow'){ ?> selected="selected" <?php } ?>>Stack Overflow</option>
			<option value="skype" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'skype'){ ?> selected="selected" <?php } ?>>Skype</option>
			<option value="stack-exchange" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'stack-exchange'){ ?> selected="selected" <?php } ?>>Stack Exchange</option>
			<option value="space-shuttle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'space-shuttle'){ ?> selected="selected" <?php } ?>>Space Shuttle</option>
			<option value="slack" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'slack'){ ?> selected="selected" <?php } ?>>Slack</option>
			<option value="stumbleupon-circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'stumbleupon-circle'){ ?> selected="selected" <?php } ?>>Stumbleupon Circle</option>
			<option value="stumbleupon" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'stumbleupon'){ ?> selected="selected" <?php } ?>>Stumbleupon</option>
			<option value="spoon" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'spoon'){ ?> selected="selected" <?php } ?>>Spoon</option>
			<option value="steam" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'steam'){ ?> selected="selected" <?php } ?>>Steam</option>
			<option value="spotify" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'spotify'){ ?> selected="selected" <?php } ?>>Spotify</option>
			<option value="soundcloud" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'soundcloud'){ ?> selected="selected" <?php } ?>>Soundcloud</option>
			<option value="support" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'support'){ ?> selected="selected" <?php } ?>>Support</option>
			<option value="send" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'send'){ ?> selected="selected" <?php } ?>>Send</option>
			<option value="sliders" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'sliders'){ ?> selected="selected" <?php } ?>>Sliders</option>
			<option value="share-alt" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'share-alt'){ ?> selected="selected" <?php } ?>>Share Alt</option>
			<option value="tag" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tag'){ ?> selected="selected" <?php } ?>>Tag</option>
			<option value="tags" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tags'){ ?> selected="selected" <?php } ?>>Tags</option>
			<option value="text-height" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'text-height'){ ?> selected="selected" <?php } ?>>Text Height</option>
			<option value="text-width" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'text-width'){ ?> selected="selected" <?php } ?>>Text Width</option>
			<option value="times-circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'times-circle'){ ?> selected="selected" <?php } ?>>Times Circle</option>
			<option value="thumb-tack" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'thumb-tack'){ ?> selected="selected" <?php } ?>>Thumb Tack</option>
			<option value="trophy" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'trophy'){ ?> selected="selected" <?php } ?>>Trophy</option>
			<option value="twitter" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'twitter'){ ?> selected="selected" <?php } ?>>Twitter</option>
			<option value="tasks" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tasks'){ ?> selected="selected" <?php } ?>>Tasks</option>
			<option value="truck" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'truck'){ ?> selected="selected" <?php } ?>>Truck</option>
			<option value="tachometer" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tachometer'){ ?> selected="selected" <?php } ?>>Tachometer</option>
			<option value="th-large" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'th-large'){ ?> selected="selected" <?php } ?>>Thumbnail Large</option>
			<option value="th" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'th'){ ?> selected="selected" <?php } ?>>Thumbnail</option>
			<option value="th-list" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'th-list'){ ?> selected="selected" <?php } ?>>Thumbnail</option>
			<option value="th" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'th'){ ?> selected="selected" <?php } ?>>Thumbnail List</option>
			<option value="times" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'times'){ ?> selected="selected" <?php } ?>>Times</option>
			<option value="ticket" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'ticket'){ ?> selected="selected" <?php } ?>>Ticket</option>
			<option value="toggle-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'toggle-down'){ ?> selected="selected" <?php } ?>>Toggle Down</option>
			<option value="toggle-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'toggle-up'){ ?> selected="selected" <?php } ?>>Toggle Up</option>
			<option value="toggle-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'toggle-right'){ ?> selected="selected" <?php } ?>>Toggle Right</option>
			<option value="tumblr" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tumblr'){ ?> selected="selected" <?php } ?>>Tumblr</option>
			<option value="trello" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'trello'){ ?> selected="selected" <?php } ?>>Trello</option>
			<option value="toggle-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'toggle-left'){ ?> selected="selected" <?php } ?>>Toggle Left</option>
			<option value="turkish-lira" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'turkish-lira'){ ?> selected="selected" <?php } ?>>Turkish Lira</option>
			<option value="try" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'try'){ ?> selected="selected" <?php } ?>>Try</option>
			<option value="taxi" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'taxi'){ ?> selected="selected" <?php } ?>>Taxi</option>
			<option value="tree" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tree'){ ?> selected="selected" <?php } ?>>Tree</option>
			<option value="tencent-weibo" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tencent-weibo'){ ?> selected="selected" <?php } ?>>Tencent Weibo</option>
			<option value="tablet" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tablet'){ ?> selected="selected" <?php } ?>>Tablet</option>
			<option value="terminal" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'terminal'){ ?> selected="selected" <?php } ?>>Terminal</option>
			<option value="upload" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'upload'){ ?> selected="selected" <?php } ?>>Upload</option>
			<option value="unlock" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'unlock'){ ?> selected="selected" <?php } ?>>Unlock</option>
			<option value="users" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'users'){ ?> selected="selected" <?php } ?>>Users</option>
			<option value="underline" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'underline'){ ?> selected="selected" <?php } ?>>Underline</option>
			<option value="unsorted" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'unsorted'){ ?> selected="selected" <?php } ?>>Unsorted</option>
			<option value="undo" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'undo'){ ?> selected="selected" <?php } ?>>Undo</option>
			<option value="user-md" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'user-md'){ ?> selected="selected" <?php } ?>>User MD</option>
			<option value="umbrella" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'umbrella'){ ?> selected="selected" <?php } ?>>Umbrella</option>
			<option value="user" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'user'){ ?> selected="selected" <?php } ?>>User</option>
			<option value="unlock-alt" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'unlock-alt'){ ?> selected="selected" <?php } ?>>Unlock Alt</option>
			<option value="usd" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'usd'){ ?> selected="selected" <?php } ?>>USD</option>
			<option value="university" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'university'){ ?> selected="selected" <?php } ?>>University</option>
			<option value="unlink" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'unlink'){ ?> selected="selected" <?php } ?>>Unlink</option>
			<option value="volume-off" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'volume-off'){ ?> selected="selected" <?php } ?>>Volume Off</option>
			<option value="volume-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'volume-down'){ ?> selected="selected" <?php } ?>>Volume Down</option>
			<option value="volume-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'volume-up'){ ?> selected="selected" <?php } ?>>Volume Up</option>
			<option value="video-camera" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'video-camera'){ ?> selected="selected" <?php } ?>>Video Camera</option>
			<option value="vk" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'vk'){ ?> selected="selected" <?php } ?>>VK</option>
			<option value="vine" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'vine'){ ?> selected="selected" <?php } ?>>Vine</option>
			<option value="warning" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'warning'){ ?> selected="selected" <?php } ?>>Warning</option>
			<option value="wrench" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'wrench'){ ?> selected="selected" <?php } ?>>Wrench</option>
			<option value="won" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'won'){ ?> selected="selected" <?php } ?>>Won</option>
			<option value="windows" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'windows'){ ?> selected="selected" <?php } ?>>Windows</option>
			<option value="weibo" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'weibo'){ ?> selected="selected" <?php } ?>>Weibo</option>
			<option value="wheelchair" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'wheelchair'){ ?> selected="selected" <?php } ?>>Wheel Chair</option>
			<option value="wordpress" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'wordpress'){ ?> selected="selected" <?php } ?>>WordPress</option>
			<option value="wechat" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'wechat'){ ?> selected="selected" <?php } ?>>We Chat</option>
			<option value="weixin" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'weixin'){ ?> selected="selected" <?php } ?>>Weixin</option>
			<option value="xing" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'xing'){ ?> selected="selected" <?php } ?>>Xing</option>
			<option value="yen" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'yen'){ ?> selected="selected" <?php } ?>>Yen</option>
			<option value="youtube" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'youtube'){ ?> selected="selected" <?php } ?>>YouTube</option>
			<option value="yahoo" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'yahoo'){ ?> selected="selected" <?php } ?>>Yahoo</option>
		</select> 
		<input type="hidden" name="meta_box_icon" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }
/***************************************************/
/*Identity Custom Field Icon List - End*/
/***************************************************/

?>