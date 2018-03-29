<?php
/**
 * TinyMCE extra buttons
 *
 * @package doodle
 */

/**
 * Add the buttons to the editor
 * 
 */
function doodle_mce_add_buttons( $plugin_array ) {
    $plugin_array['doodleicons'] = get_template_directory_uri() . '/js/tinymce-doodleicons-plugin.js';
    return $plugin_array;
}
function doodle_mce_register_buttons( $buttons ) {
    array_push( $buttons, 'doodleicons' ); 
    return $buttons;
}
function doodle_mce_buttons() {
	if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
	    add_filter( "mce_external_plugins", "doodle_mce_add_buttons", 99999 );
	    add_filter( 'mce_buttons', 'doodle_mce_register_buttons' );
	}
}
add_action( 'init', 'doodle_mce_buttons' );

/**
 * Add Jollyicons to mce CSS files
 * 
 */
function doodle_mce_css($wp) {
	$wp .= ',' . get_template_directory_uri() . '/css/jollyicons.css';
	return $wp;
}
add_filter( 'mce_css', 'doodle_mce_css' );

function admin_css() {
	echo '<link rel="stylesheet" type="text/css" href="'. get_template_directory_uri() . '/css/admin.css' .'">';
	echo '<link rel="stylesheet" type="text/css" href="'. get_template_directory_uri() . '/css/jollyicons.css' .'">';
}
add_action( 'admin_head', 'admin_css' );
