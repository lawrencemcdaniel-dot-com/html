<?php 

/**
 * Queue up framework
 */
	
//MENUS & WIDGETS
	require_once ( "ebor_framework/mandw.php");
	
//STYLES & SCRIPTS
	require_once ( "ebor_framework/styles_scripts.php");
	
//THEME FUNCTIONS
	require_once ( "ebor_framework/theme_functions.php");
	
//THEME OPTIONS
	require_once ( "ebor_framework/theme_options.php");
	
//THEME SUPPORT
	require_once ( "ebor_framework/theme_support.php");
	
//THEME CUSTOM FILTERS
	require_once ( "ebor_framework/theme_filters.php");
	
//THEME ACTIONS
	require_once ('ebor_framework/theme_actions.php');
	
//METABOXES
	require_once ( "ebor_framework/metaboxes.php");
	
//IMAGE RESIZER
	require_once('ebor_framework/aq_resizer.php');
	
//REQUIRED PLUGINS
	require_once ('ebor_framework/class-tgm-plugin-activation.php');
	
//PLUGINS LOAD
	require_once ('ebor_framework/plugins_load.php');
	
//COLOURS
	require_once ('ebor_framework/custom_colours.php');
	
//PAGE BUILDER ADDITIONAL BLOCKS
	require_once ('ebor_framework/page_builder.php');

//WOOCOMMERCE
if( class_exists('Woocommerce') )
	require_once ('ebor_framework/woocommerce_support.php');
	

function ebor_admin_notice() {
	global $current_user;
    
    $user_id = $current_user->ID;

	if ( ! get_user_meta($user_id, 'ebor_ignore_notice') ) {
        echo '<div class="updated"><p>'; 
        printf(__('<b>Hey there! A Note About Marble 1.2.1+</b><br />
        In this update I added a height independent slider for your portfolio items, but what does this mean for you?<br />
        <ol>
       	<li>First things first, clear ALL caches, browser, site, server etc.</li>
       	<li>You will notice the gallery height theme option is now gone, this is because;</li>
       	<li>The slider in your portfolio and blog posts will now adapt to the height of the images you add in it automatically.</li>
       	<li>Lastly, if you do not want this (almost all users will) just downgrade back to v1.2.0, I added this to your theme download package also.</li> 
       </ol>
       Most importantly, you should notice almost no change to your slider operation because of this.<br />Cheers - Tom<br /><br />
        <a href="%1$s">Hide This Notice</a>', 'slowave'), '?ebor_nag_ignore=0');
        echo "</p></div>";
	}
}
add_action('admin_notices', 'ebor_admin_notice');

function ebor_nag_ignore() {
	global $current_user;
        $user_id = $current_user->ID;
        /* If user clicks to ignore the notice, add that to their user meta */
        if ( isset($_GET['ebor_nag_ignore']) && '0' == $_GET['ebor_nag_ignore'] ) {
             add_user_meta($user_id, 'ebor_ignore_notice', 'true', true);
	}
}
add_action('admin_init', 'ebor_nag_ignore');

		
/////////////////////////////////////////////

/**
 * Please use a child theme if you need to modify any aspect of the theme, if you need to, you can add code
 * below here if you need to add extra functionality.
 * Be warned! Any code added here will be overwritten on theme update!
 * Add & modify code at your own risk & always use a child theme instead for this!
 */