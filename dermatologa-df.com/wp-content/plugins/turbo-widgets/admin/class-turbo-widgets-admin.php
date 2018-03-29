<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://datamad.co.uk
 * @since      2.0.0
 *
 * @package    Turbo_Widgets
 * @subpackage Turbo_Widgets/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Turbo_Widgets
 * @subpackage Turbo_Widgets/admin
 * @author     DataMad Ltd, Todd Halfpenny <support@datamad.co.uk>
 */
class Turbo_Widgets_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    2.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}


	/**
	 * Add filters for our TinyMCE plugin.
	 *
	 * @since    2.0.0
	 */
	public function turbo_addbuttons() {
		if ( is_admin() ) {
			if ( get_user_option( 'rich_editing' ) ) {
				add_filter( 'mce_external_plugins', array( $this, 'add_turbo_tinymce_plugin' ) );
				add_filter( 'mce_buttons', array( $this, 'register_turbo_tinymce_button' ) );
			}
		}
	}


	/**
	 * Load the TinyMCE plugincode.
	 *
	 * @since    2.0.0
	 */
	public function add_turbo_tinymce_plugin( $plugin_array ) {
		$plugin_url = plugin_dir_url( __FILE__ ) . 'js/turbo_editor_plugin.js';
		$plugin_array['turboplugin'] = $plugin_url;
		return $plugin_array;
	}


	/**
	 * Add our lovely TinyMCE button.
	 *
	 * @since    2.0.0
	 */
	public function register_turbo_tinymce_button( $buttons ) {
		array_push( $buttons, 'separator', 'turboplugin' );
		return $buttons;
	}

	/**
	 * Include our TinyMCE PHP code.
	 *
	 * @since    2.0.0
	 */
	public function turbo_editor_dialog() {
		$tw_attrs = isset( $_GET['tw_attrs'] ) ? $_GET['tw_attrs'] : '';
		require_once( 'turbo-editor-dialog.php' );
		die;
	}


	/**
	 * Our Turbo Sidebar metaboxes (shortcode and template tags).
	 * TODO: Copy JS for shortcode.
	 *
	 * @since    2.0.0
	 */
	public function turbo_sidebar_post_tags_meta_box( $object, $box ) {
		?>
		<?php wp_nonce_field( basename( __FILE__ ), 'turbo_sidebar_post_tags_nonce' ); ?>
		<h2>Shortcode Tag</h2>
		<p>
			<label for='turbo-sidebar-tags'><?php esc_html_e( 'Copy the following shortcode tag and paste it into your content where you would like this to appear', 'turbo-widgets' ); ?></label>
			<br />
			<input class="widefat" type="text" name="smashing-post-class" id="turbo-sidebar-post-class" value="[turbo_sidebar p=<?php echo esc_attr( $object->ID ); ?>]" size="30" disabled />
		</p>
		<h2>Template Tag</h2>
		<p>
			<label for='turbo-sidebar-tags'><?php esc_html_e( 'Copy the following PHP template tag and paste it into your theme files where you would like this to appear', 'turbo-widgets' ); ?></label>
			<br />
			<input class="widefat" type="text" name="smashing-post-class" id="turbo-sidebar-post-class" value="turbo_sidebar_tt(['p'=><?php echo esc_attr( $object->ID ); ?>]);" size="30" disabled />
		</p>
	<?php }


	/**
	 * Our Turbo Sidebar metaboxes.
	 *
	 * @since    2.0.0
	 */
	public function turbo_sidebar_add_post_meta_boxes() {
		add_meta_box(
			'turbo-sidebar-tag',      // Unique ID.
			esc_html__( 'Turbo tags', 'turbo-widgets' ),    // Title.
			array( $this, 'turbo_sidebar_post_tags_meta_box' ),   // Callback function.
			'turbo_sidebar_cpt',         // Admin page (or post type).
			'side',         // Context.
			'default'         // Priority.
		);
	}


	/**
	 * Creates a new Turbo Sidebars custom post type
	 *
	 * @since 	2.0.0
	 * @uses 	register_post_type()
	 */
	public static function tw_cpt_turbo_sidebars() {
		$cap_type 	= 'post';
		$plural 	= 'Turbo Sidebars';
		$single 	= 'Widget Area';
		$cpt_name 	= 'turbo_sidebar_cpt';

		$opts['can_export']								= true;
		$opts['capability_type']						= $cap_type;
		$opts['description']							= '';
		$opts['exclude_from_search']					= true;
		$opts['has_archive']							= false;
		$opts['hierarchical']							= false;
		$opts['map_meta_cap']							= true;
		$opts['menu_icon']								= 'dashicons-welcome-widgets-menus';
		$opts['menu_position']							= 60;
		$opts['public']									= false;
		$opts['publicly_querable']						= false;
		$opts['query_var']								= true;
		$opts['register_meta_box_cb']					= '';
		$opts['rewrite']								= false;
		$opts['show_in_admin_bar']						= false;
		// $opts['show_in_menu']							= 'admin.php?page=turbo-widgets';
		$opts['show_in_menu']							= 'themes.php';
		$opts['show_in_nav_menu']						= false;
		$opts['show_ui']								= true;
		// $opts['supports']								= array( 'title', 'excerpt' );
		$opts['taxonomies']								= array();
		$opts['capabilities']['delete_others_posts']	= "delete_others_{$cap_type}s";
		$opts['capabilities']['delete_post']			= "delete_{$cap_type}";
		$opts['capabilities']['delete_posts']			= "delete_{$cap_type}s";
		$opts['capabilities']['delete_private_posts']	= "delete_private_{$cap_type}s";
		$opts['capabilities']['delete_published_posts']	= "delete_published_{$cap_type}s";
		$opts['capabilities']['edit_others_posts']		= "edit_others_{$cap_type}s";
		$opts['capabilities']['edit_post']				= "edit_{$cap_type}";
		$opts['capabilities']['edit_posts']				= "edit_{$cap_type}s";
		$opts['capabilities']['edit_private_posts']		= "edit_private_{$cap_type}s";
		$opts['capabilities']['edit_published_posts']	= "edit_published_{$cap_type}s";
		$opts['capabilities']['publish_posts']			= "publish_{$cap_type}s";
		$opts['capabilities']['read_post']				= "read_{$cap_type}";
		$opts['capabilities']['read_private_posts']		= "read_private_{$cap_type}s";
		$opts['labels']['add_new']						= esc_html__( "Add New {$single}", 'now-turbo-widgets' );
		$opts['labels']['add_new_item']					= esc_html__( "Add New {$single}", 'turbo-widgets' );
		$opts['labels']['all_items']					= esc_html__( $plural, 'turbo-widgets' );
		$opts['labels']['edit_item']					= esc_html__( "Edit {$single}" , 'turbo-widgets' );
		$opts['labels']['menu_name']					= esc_html__( $plural, 'turbo-widgets' );
		$opts['labels']['name']							= esc_html__( $plural, 'turbo-widgets' );
		$opts['labels']['name_admin_bar']				= esc_html__( $single, 'turbo-widgets' );
		$opts['labels']['new_item']						= esc_html__( "New {$single}", 'turbo-widgets' );
		$opts['labels']['not_found']					= esc_html__( "No {$plural} Found", 'turbo-widgets' );
		$opts['labels']['not_found_in_trash']			= esc_html__( "No {$plural} Found in Trash", 'turbo-widgets' );
		$opts['labels']['parent_item_colon']			= esc_html__( "Parent {$plural} :", 'turbo-widgets' );
		$opts['labels']['search_items']					= esc_html__( "Search {$plural}", 'turbo-widgets' );
		$opts['labels']['singular_name']				= esc_html__( $single, 'turbo-widgets' );
		$opts['labels']['view_item']					= esc_html__( "View {$single}", 'turbo-widgets' );

		$opts['rewrite']['ep_mask']						= EP_PERMALINK;
		$opts['rewrite']['feeds']						= false;
		$opts['rewrite']['pages']						= true;
		$opts['rewrite']['slug']						= esc_html__( strtolower( $plural ), 'turbo-widgets' );
		$opts['rewrite']['with_front']					= false;
		$opts = apply_filters( 'turbo-sidebars-cpt-options', $opts );

		register_post_type( strtolower( $cpt_name ), $opts );
	}


	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Turbo_Widgets_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Turbo_Widgets_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/turbo-widgets-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Turbo_Widgets_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Turbo_Widgets_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/turbo-widgets-admin.js', array( 'jquery' ), $this->version, false );
	}
}
