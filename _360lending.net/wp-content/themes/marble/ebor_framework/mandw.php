<?php

//REGISTER CUSTOM MENUS
function register_ebor_menus() {
  register_nav_menus( array(
  	'primary' => __( 'Standard Navigation', 'marble' ),
  	'single' => __( 'Navigation For One-Page Version', 'marble' ),
  ) );
}
add_action( 'init', 'register_ebor_menus' );

//REGISTER SIDEBARS
function ebor_register_sidebars() {

	register_sidebar(
		array(
			'id' => 'primary',
			'name' => __( 'Blog Sidebar', 'marble' ),
			'description' => __( 'Widgets to be displayed in the blog sidebar.', 'marble' ),
			'before_widget' => '<div id="%1$s" class="sidebox widget clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="section-title widget-title">',
			'after_title' => '</h3>'
		)
	);
	
	register_sidebar(
		array(
			'id' => 'page',
			'name' => __( 'Page With Sidebar, Sidebar', 'marble' ),
			'description' => __( 'Widgets to be displayed in the page with sidebar, sidebar.', 'marble' ),
			'before_widget' => '<div id="%1$s" class="sidebox widget clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);
	
	register_sidebar(
		array(
			'id' => 'shop',
			'name' => __( 'Shop Sidebar', 'marble' ),
			'description' => __( 'Widgets to be displayed in the shop pages sidebar.', 'marble' ),
			'before_widget' => '<div id="%1$s" class="sidebox widget clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="section-title widget-title">',
			'after_title' => '</h3>'
		)
	);

	register_sidebar(
		array(
			'id' => 'footer1',
			'name' => __( 'Footer Column 1', 'marble' ),
			'description' => __( 'Set the amount of columns you need in "Footer Settings" in the theme-options. This will appear in 1,2,3 & 4 column settings.', 'marble' ),
			'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="section-title widget-title">',
			'after_title' => '</h3>'
		)
	);
	
	register_sidebar(
		array(
			'id' => 'footer2',
			'name' => __( 'Footer Column 2', 'marble' ),
			'description' => __( 'Set the amount of columns you need in "Footer Settings" in the theme-options. This will appear in 2,3 & 4 column settings.', 'marble' ),
			'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="section-title widget-title">',
			'after_title' => '</h3>'
		)
	);
	
	
	register_sidebar(
		array(
			'id' => 'footer3',
			'name' => __( 'Footer Column 3', 'marble' ),
			'description' => __( 'Set the amount of columns you need in "Footer Settings" in the theme-options. This will appear in 3 & 4 column settings.', 'marble' ),
			'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="section-title widget-title">',
			'after_title' => '</h3>'
		)
	);
	
	register_sidebar(
		array(
			'id' => 'footer4',
			'name' => __( 'Footer Column 4', 'marble' ),
			'description' => __( 'Set the amount of columns you need in "Footer Settings" in the theme-options. This will only appear in 4 column setting.', 'marble' ),
			'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="section-title widget-title">',
			'after_title' => '</h3>'
		)
	);
	

}
add_action( 'widgets_init', 'ebor_register_sidebars' );