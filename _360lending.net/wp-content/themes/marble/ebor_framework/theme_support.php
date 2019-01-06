<?php

/////////////////////////////////////////////
////////ADD THEME SUPPORT///////////////////
///////////////////////////////////////////

//ADD FEATURED IMAGES
add_theme_support( 'post-thumbnails' );

//STYLING & CUSTOM OPTIONS
$bgArgs = array( 'default-color' => 'f9f9f9' );
add_theme_support( 'custom-background', $bgArgs );

//IMAGE SIZES
set_post_thumbnail_size( 70, 70, true );
add_image_size( 'index', 270, 210, true);
add_image_size( 'index-large', 770, 9999, false);
add_image_size( 'portfolio-index', 440, 330, true);
add_image_size( 'team', 430, 300, true);
add_image_size( 'admin-list-thumb', 60, 60, true );

//FEED LINKS
add_theme_support( 'automatic-feed-links' );

add_theme_support( 'post-formats', array( 'gallery', 'video', 'image', 'chat', 'quote', 'audio' ) );

add_editor_style('editor-style.css');

add_theme_support('title-tag');

if ( ! isset( $content_width ) ) $content_width = 770;

add_action('after_setup_theme', 'new_setup');
function new_setup(){
	load_theme_textdomain('marble', get_template_directory() . '/languages');
}