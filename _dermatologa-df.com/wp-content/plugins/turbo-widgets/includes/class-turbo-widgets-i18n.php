<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://datamad.co.uk
 * @since      1.0.0
 *
 * @package    Turbo_Widgets
 * @subpackage Turbo_Widgets/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Turbo_Widgets
 * @subpackage Turbo_Widgets/includes
 * @author     DataMad Ltd, Todd Halfpenny <support@datamad.co.uk>
 */
class Turbo_Widgets_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'turbo-widgets',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
