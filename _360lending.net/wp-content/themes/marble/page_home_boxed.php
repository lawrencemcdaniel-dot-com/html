<?php
	/*
	Template Name: Homepage
	*/
	get_header();
	the_post();
	
	/**
	 * ebor_open_wrapper hook
	 * All actions contained in /ebor_framework/theme_actions.php
	 *
	 * @hooked ebor_open_wrapper_markup - 10
	 */
	do_action('ebor_open_wrapper');
	
	the_content();
	
	/**
	 * ebor_close_wrapper hook
	 * All actions contained in /ebor_framework/theme_actions.php
	 *
	 * @hooked ebor_close_wrapper_markup - 10
	 */
	do_action('ebor_close_wrapper');
	
	get_template_part('loop/loop','childpages');
	get_footer();