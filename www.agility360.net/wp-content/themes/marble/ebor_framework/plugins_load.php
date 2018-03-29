<?php 

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
add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
function my_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name'     				=> 'Revolution Slider',
			'slug'     				=> 'revslider',
			'source'   				=> 'http://www.madeinebor.com/plugin-downloads/revslider.zip',
			'required' 				=> false,
			'external_url' 			=> 'http://www.madeinebor.com/plugin-downloads/revslider.zip',
			'version'               => '1.0.0'
		),
		array(
			'name'     				=> 'Zilla Likes', // The plugin name
			'slug'     				=> 'zilla-likes', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/ebor_framework/plugins/zilla-likes.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Ebor CPT', // The plugin name
			'slug'     				=> 'ebor-cpt-master', // The plugin slug (typically the folder name)
			'source'   				=> 'https://github.com/tommusrhodus/ebor-cpt/archive/master.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> 'https://github.com/tommusrhodus/ebor-cpt/archive/master.zip', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Ebor Shortcodes', // The plugin name
			'slug'     				=> 'Ebor-Shortcodes-master', // The plugin slug (typically the folder name)
			'source'   				=> 'https://github.com/tommusrhodus/Ebor-Shortcodes/archive/master.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> 'https://github.com/tommusrhodus/Ebor-Shortcodes/archive/master.zip', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Ebor Popular Posts Widget', // The plugin name
			'slug'     				=> 'Ebor-Popular-Posts-master', // The plugin slug (typically the folder name)
			'source'   				=> 'https://github.com/tommusrhodus/Ebor-Popular-Posts/archive/master.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> 'https://github.com/tommusrhodus/Ebor-Popular-Posts/archive/master.zip', // If set, overrides default API URL and points to an external URL
		),
		array(
		    'name'      => 'Contact Form 7',
		    'slug'      => 'contact-form-7',
		    'required'  => false,
		),
		array(
		    'name'      => 'Aqua Page Builder',
		    'slug'      => 'aqua-page-builder',
		    'required'  => true,
		),

	);

	$config = array(
		'is_automatic' => true,
	);
	tgmpa( $plugins, $config );

}