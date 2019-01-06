<?php
	/**
	 * The Template for displaying product archives, including the main shop page which is a post type archive.
	 *
	 * @author 		TommusRhodus
	 * @package 	Marble/WP Theme
	 * @version     9.9.9
	 */
	
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
	get_header('shop');
	get_template_part('loop/loop', get_option('shop_layout','shopstandard') );
	get_footer('shop');