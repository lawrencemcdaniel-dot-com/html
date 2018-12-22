<?php
add_action( 'tgmpa_register', 'dttheme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function dttheme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin from the WordPress Plugin Repository

		array(
			'name'     				=> __('DesignThemes Core  Shortcode Plugins','dt_themes'), // The plugin name
			'slug'     				=> 'designthemes-core-features', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/framework/plugins/designthemes-core-features.zip', // The plugin source
			'version' 				=> '1.1',
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		),

		array(
			'name'     				=> __('Visual Composer','dt_themes'),
			'slug'     				=> 'js_composer',
			'source'   				=> 'https://s3.amazonaws.com/wedesignthemes/premium/js_composer.zip',
			'version' 				=> '4.12',
		),
		
		array(
			'name'     				=> __('Layer Slider','dt_themes'),
			'slug'     				=> 'LayerSlider',
			'source'   				=> esc_url('https://s3.amazonaws.com/wedesignthemes/plugins/layer-slider/6.4.0/LayerSlider.zip'),
		),

		array(
			'name'     				=> __('Revolution Slider','dt_themes'),
			'slug'     				=> 'revslider',
			'source'   				=> esc_url('https://s3.amazonaws.com/wedesignthemes/plugins/revolution-slider/5.4.1/revslider.zip'),
		),

		array(
			'name'     				=> __('Responsive Google Maps','dt_themes'),
			'slug'     				=> 'responsive-maps-plugin',
			'source'   				=> 'https://s3.amazonaws.com/wedesignthemes/premium/responsive-maps-plugin.zip',
		),

		array(
			'name' 		=> __('Envato Market','dt_themes'),
			'slug' 		=> 'envato-market',
			'source'	=> 'http://envato.github.io/wp-envato-market/dist/envato-market.zip',
			'required' 	=> false,
		),
		

		array(
			'name' 		=> __('Contact Form 7','dt_themes'),
			'slug' 		=> 'contact-form-7',
			'required' 	=> false,
		),

		array(
			'name' 		=> __('Like This','dt_themes'),
			'slug' 		=> 'roses-like-this',
			'required' 	=> false,
		),

		array(
			'name' 		=> __('The Event Calender ( Modern Tribe )','dt_themes'),
			'slug' 		=> 'the-events-calendar',
			'required' 	=> false,
		),

		array(
			'name'		=>	__('WooCommerce - excelling eCommerce','dt_themes'),
			'slug'		=>	'woocommerce',
			'required'	=>	false
		),

		array(
			'name'		=>	__('YITH WooCommerce Wishlist','dt_themes'),
			'slug'		=>	'yith-woocommerce-wishlist',
			'required'	=>	false
		),

		array(
			'name' 					=> __('Unyson', 'dt_themes'),
			'slug' 					=> 'unyson',
			'required' 				=> false,
		)		
		
	);

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
		'id'           => 'dt_themes',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
    );

    tgmpa( $plugins, $config );
}?>