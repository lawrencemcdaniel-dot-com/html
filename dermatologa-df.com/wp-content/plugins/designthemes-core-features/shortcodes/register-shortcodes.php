<?php
if (! class_exists ( 'DTCoreShortcodes' )) {
	
	/**
	 * Used to "Loades Core Shortcodes & Add button to tinymce"
	 *
	 * @author iamdesigning11
	 */
	class DTCoreShortcodes {
		
		/**
		 * Constructor for DTCoreShortcodes
		 */
		function __construct() {
			define ( 'DESIGNTHEMES_TINYMCE_URL', plugin_dir_url ( __FILE__ ) . 'tinymce' );
			define ( 'DESIGNTHEMES_TINYMCE_PATH', plugin_dir_path ( __FILE__ ) . 'tinymce' );
			
			require_once plugin_dir_path ( __FILE__ ) . 'shortcodes.php';
			
			// Add Hook into the 'init()' action
			add_action ( 'init', array (
					$this,
					'dt_init' 
			) );
			
			// Add Hook into the 'admin_init()' action
			add_action ( 'admin_init', array (
					$this,
					'dt_admin_init' 
			) );
			
			add_filter ( 'the_content', array (
					$this,
					'dt_the_content_filter' 
			) );
		}
		
		/**
		 * A function hook that the WordPress core launches at 'init' points
		 */
		function dt_init() {
			
			/* Front End CSS & jQuery */
			if (! is_admin ()) {
				wp_enqueue_style ( 'dt-sc-css', plugin_dir_url ( __FILE__ ) . 'css/shortcodes.css' );
				
				wp_enqueue_script ( 'jquery' );
				wp_enqueue_script ( 'dt-sc-inview-script', plugin_dir_url ( __FILE__ ) . 'js/inview.js', array (), false, true );
				wp_enqueue_script ( 'dt-sc-tabs-script', plugin_dir_url ( __FILE__ ) . 'js/jquery.tabs.min.js', array (), false, true );
				wp_enqueue_script ( 'dt-sc-viewport-script', plugin_dir_url ( __FILE__ ) . 'js/jquery.viewport.js', array (), false, true );
				wp_enqueue_script ( 'dt-sc-carouFredSel-script', plugin_dir_url ( __FILE__ ) . 'js/jquery.carouFredSel-6.2.1-packed.js', array (), false, true );
				wp_enqueue_script ( 'dt-sc-tipTip-script', plugin_dir_url ( __FILE__ ) . 'js/jquery.tipTip.minified.js', array (), false, true );
				wp_enqueue_script ( 'dt-sc-donutchart-script', plugin_dir_url ( __FILE__ ) . 'js/jquery.donutchart.js', array (), false, true );
				wp_enqueue_script ( 'dt-sc-script', plugin_dir_url ( __FILE__ ) . 'js/shortcodes.js', array (), false, true );
			}
			
			if (! current_user_can ( 'edit_posts' ) && ! current_user_can ( 'edit_pages' )) {
				return;
			}
			
			if ("true" === get_user_option ( 'rich_editing' )) {
				add_filter ( 'mce_buttons', array (
						$this,
						'dt_register_rich_buttons' 
				) );
				
				add_filter ( 'mce_external_plugins', array (
						$this,
						'dt_add_external_plugins' 
				) );
			}
		}
		
		/**
		 * A function hook that the WordPress core launches at 'admin_init' points
		 */
		function dt_admin_init() {
			wp_enqueue_style ( 'wp-color-picker' );
			wp_enqueue_script ( 'wp-color-picker' );
			
			// css
			wp_enqueue_style ( 'DTCorePlugin-sc-dialog', DESIGNTHEMES_TINYMCE_URL . '/css/styles.css', false, '1.0', 'all' );
			
			wp_localize_script ( 'jquery', 'DTCorePlugin', array (
					'plugin_folder' => WP_PLUGIN_URL . '/designthemes-core-features',
					'tinymce_folder' => DESIGNTHEMES_TINYMCE_URL 
			) );
		}
		
		/**
		 * A function hook that used to filter the content - to remove unwanted codes
		 *
		 * @param string $content        	
		 * @return string
		 */
		function dt_the_content_filter($content) {
			$array = array (
					'<p>[' => '[',
					']</p>' => ']',
					']<br />' => ']',
					'<p> </p>' => '' 
			);
			$content = strtr ( $content, $array );
			return $content;
		}
		
		/**
		 * Adds DesignThemes custom shortcode rich buttons to TinyMCE
		 *
		 * @param unknown $buttons        	
		 * @return unknown
		 */
		function dt_register_rich_buttons($buttons) {
			array_push ( $buttons, "|", "designthemes_sc_button" );
			return $buttons;
		}
		
		/**
		 * Adds DesignThemes javascript to TinyMCE
		 *
		 * @param unknown $plugins        	
		 * @return unknown
		 */
		function dt_add_external_plugins($plugins) {
			global $wp_version;
			
			if(  version_compare( $wp_version, '3.9' , '<') ) {
				$url = DESIGNTHEMES_TINYMCE_URL . '/plugin-wp-3.8.js';
			} else {
				$url = DESIGNTHEMES_TINYMCE_URL . '/plugin-wp-3.9.js';
			}
			
			$plugins ['DTCoreShortcodePlugin'] = $url;
			return $plugins;
		}
	}
}
?>