<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
 // Adding a block opinion-stage for below elements 
add_filter( 'block_categories', function( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'opinion-stage',
				'title' => __( 'Interactive Content by OpinionStage', 'opinion-stage' ),
			),
		)
	);
}, 10, 2 );	


/**
 * BLOCK: Poll.
 */
require( plugin_dir_path( __FILE__ ).'poll/src/init.php' );
/**
 * BLOCK: Trivia.
 */
require( plugin_dir_path( __FILE__ ).'trivia/src/init.php' );
/**
 * BLOCK: Personality.
 */
require( plugin_dir_path( __FILE__ ).'personality/src/init.php' );
/**
 * BLOCK: Survey.
 */
require( plugin_dir_path( __FILE__ ).'survey/src/init.php' );
/**
 * BLOCK: Slideshow.
 */
require( plugin_dir_path( __FILE__ ).'slideshow/src/init.php' );
/**
 * BLOCK: Form.
 */
require( plugin_dir_path( __FILE__ ).'form/src/init.php' );


function oswp_gutenberg_enqueue_scripts() {
  // Fetching options for opinionstage connection
		$os_options =(array) get_option(OPINIONSTAGE_OPTIONS_KEY);
		$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 

		// get admin url for opinionstage plugin
		$adminUrlForOs = admin_url( 'admin.php?page=opinionstage-content-login-callback-page&return_path=', $protocol );

		// opinionstage plugin version
		$OswpPluginVersion = OPINIONSTAGE_WIDGET_VERSION;

		// Fetch Url For Ajax Call Opinion Stage
		$FetchUrlOS = 'https://www.opinionstage.com/api/wp/v1/my/widgets';

		// Url For Creating New Content OR Template On Opinion Stage
		$getUrlFormAction = 'https://www.opinionstage.com/integrations/wordpress/new';

		// Opninionstge logo image link
		$logoImagelinkOs = plugin_dir_url( __FILE__ ) . 'image/gutenberg-os.png';

		// Data to pass to gutenberg editor
	    $dataToPass = array(
	        'isOsConnected'         => (isset($os_options['uid']) && $os_options['uid'] != '') ? true : false,
	        'onCreateButtonClickOs' => 'https://www.opinionstage.com/api/wp/redirects/widgets/new',
	        'callbackUrlOs'         => $adminUrlForOs.urlencode($url),
	        'OswpPluginVersion'     => $OswpPluginVersion,
	        'OswpClientToken'       => opinionstage_user_access_token(),
	        'OswpFetchDataUrl'      => $FetchUrlOS,
	        'getActionUrlOS'        => $getUrlFormAction,
	        'getLogoImageLink'		=> $logoImagelinkOs,
	    );
    	wp_localize_script( 'opinionStage_poll_oswp_block_js_set', 'osGutenData', $dataToPass );
}
add_action( 'enqueue_block_editor_assets', 'oswp_gutenberg_enqueue_scripts' );
?>