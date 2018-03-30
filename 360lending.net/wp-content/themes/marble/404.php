<?php
	get_header();
	
	/**
	 * ebor_open_wrapper hook
	 * All actions contained in /ebor_framework/theme_actions.php
	 *
	 * @hooked ebor_open_wrapper_markup - 10
	 */
	do_action('ebor_open_wrapper');
?>

<div class="whoopsie-daisy-wrapper">
	<h1 class="whoopsie-daisy"><small><?php _e('Uh, Oh.','marble'); ?></small><?php _e('404','marble'); ?></h1>
	<a href="<?php echo home_url(); ?>"><?php _e('&larr; Head Home','marble'); ?></a>
</div>

<?php
	/**
	 * ebor_close_wrapper hook
	 * All actions contained in /ebor_framework/theme_actions.php
	 *
	 * @hooked ebor_close_wrapper_markup - 10
	 */
	do_action('ebor_close_wrapper');
	
	get_footer();