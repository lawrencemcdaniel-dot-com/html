<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://datamad.co.uk
 * @since             1.0.0
 * @package           Turbo_Widgets
 *
 * @wordpress-plugin
 * Plugin Name:       Turbo Widgets
 * Plugin URI:        http://turbowidgets.net
 * Description: The easiest way to add Widgets or Sidebars to Posts and Pages through the WYSIWYG, or shortcodes. Or add them to your theme through template tags.
 * Version:           2.0.0
 * Author:            DataMad Ltd, Todd Halfpenny
 * Author URI:        https://datamad.co.uk
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       turbo-widgets
 * Domain Path:       /languages
 */
/**
	Copyright 2015  DATAMAD LTD  (email : sales@turbowidgets.net)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( !function_exists( 'tw_fs' ) ) {
    /**
     * Freemius Stuff.
     * Create a helper function for easy SDK access.
     */
    function tw_fs()
    {
        global  $tw_fs ;
        
        if ( !isset( $tw_fs ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $tw_fs = fs_dynamic_init( array(
                'id'             => '1389',
                'slug'           => 'turbo-widgets',
                'type'           => 'plugin',
                'public_key'     => 'pk_d4c18d58a3fb75501808b44d62c81',
                'is_premium'     => false,
                'has_addons'     => false,
                'has_paid_plans' => true,
                'menu'           => array(
                'first-path' => 'plugins.php',
                'contact'    => false,
                'support'    => false,
            ),
                'is_live'        => true,
            ) );
        }
        
        return $tw_fs;
    }
    
    // Init Freemius.
    tw_fs();
    // Signal that SDK was initiated.
    do_action( 'tw_fs_loaded' );
    // If this file is called directly, abort.
    if ( !defined( 'WPINC' ) ) {
        die;
    }
    if ( !defined( 'TURBOWIDGETS_PLUGIN_VERSION' ) ) {
        define( 'TURBOWIDGETS_PLUGIN_VERSION', '2.0.0' );
    }
    /**
     * The code that runs during plugin activation.
     * This action is documented in includes/class-turbo-widgets-activator.php
     *
     * @param strgin $turbo_widgets_plugin_version Version of our plugin.
     */
    function activate_turbo_widgets( $turbo_widgets_plugin_version )
    {
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-turbo-widgets-activator.php';
        Turbo_Widgets_Activator::activate( $turbo_widgets_plugin_version );
    }
    
    /**
     * The code that runs during plugin deactivation.
     * This action is documented in includes/class-turbo-widgets-deactivator.php
     */
    function deactivate_turbo_widgets()
    {
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-turbo-widgets-deactivator.php';
        Turbo_Widgets_Deactivator::deactivate();
    }
    
    register_activation_hook( __FILE__, 'activate_turbo_widgets' );
    register_deactivation_hook( __FILE__, 'deactivate_turbo_widgets' );
    /**
     * Also check if we have updated - note activation hook not fired upon updates
     */
    function turbo_widgets_plugin_check_version()
    {
        if ( TURBOWIDGETS_PLUGIN_VERSION !== get_option( 'turbo_widgets_plugin_version' ) ) {
            activate_turbo_widgets( TURBOWIDGETS_PLUGIN_VERSION );
        }
    }
    
    // TODO - Not sure we need this for each release
    // add_action( 'plugins_loaded', 'turbo_widgets_plugin_check_version' );
    /**
     * The core plugin class that is used to define internationalization,
     * admin-specific hooks, and public-facing site hooks.
     */
    require plugin_dir_path( __FILE__ ) . 'includes/class-turbo-widgets.php';
    /**
     * Begins execution of the plugin.
     *
     * Since everything within the plugin is registered via hooks,
     * then kicking off the plugin from this point in the file does
     * not affect the page life cycle.
     *
     * @since    2.0.0
     */
    function run_turbo_widgets()
    {
        $plugin = new Turbo_Widgets( TURBOWIDGETS_PLUGIN_VERSION );
        $plugin->run();
    }
    
    run_turbo_widgets();
}