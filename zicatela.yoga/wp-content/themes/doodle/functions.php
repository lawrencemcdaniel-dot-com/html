<?php
/**
 * doodle functions and definitions
 *
 * @package doodle
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'doodle_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function doodle_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on doodle, use a find and replace
	 * to change 'doodle' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'doodle', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'doodle-thumb', 640, 360, true ); //(cropped)
	add_image_size( 'doodle-thumb-portrait', 360, 480, true ); //(cropped)
	add_image_size( 'doodle-thumb-square', 480, 480, true ); //(cropped)

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'doodle' ),
		'secondary' => __( 'Secondary Menu', 'doodle' ),
	) );

	// Register Custom Navigation Walker
	require_once(get_template_directory() . '/inc/wp_bootstrap_navwalker.php');

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'gallery', 'image', 'video',
	) );

	// Enable support for custom header
	add_theme_support( 'custom-header', array('width'=>1440,'height'=>900,'flex-width'=>true,'flex-height'=>true,'header-text' => false,) );

	// Enable support for custom background
	add_theme_support( 'custom-background' );

}
endif; // doodle_setup
add_action( 'after_setup_theme', 'doodle_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function doodle_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'doodle' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Shop Sidebar', 'doodle' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 1', 'doodle' ),
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 2', 'doodle' ),
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 3', 'doodle' ),
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 4', 'doodle' ),
		'id'            => 'footer-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Site Colophon', 'doodle' ),
		'id'            => 'site-colophon',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'doodle_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function doodle_scripts() {
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'jollyicons-style', get_template_directory_uri() . '/css/jollyicons.css' );
	wp_enqueue_style( 'slick-style', get_template_directory_uri() . '/css/slick.css' );
	wp_enqueue_style( 'ytplayer-style', get_template_directory_uri() . '/css/ytplayer/YTPlayer.css' );
	wp_enqueue_style( 'doodle-style', get_stylesheet_uri(), array(), '1.2.3' );

	wp_enqueue_script( 'google-maps', 'https://maps.google.com/maps/api/js?sensor=false', array('jquery'), '20150417', true );
	wp_enqueue_script( 'bootstrap-script', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '20150417', true );
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array('jquery'), '20150725', true );
	wp_enqueue_script( 'jquery-shuffle', get_template_directory_uri() . '/js/jquery.shuffle.min.js', array('jquery'), '20150725', true );
	wp_enqueue_script( 'jquery-match-height', get_template_directory_uri() . '/js/jquery.matchHeight-min.js', array('jquery'), '20150725', true );
	wp_enqueue_script( 'scrollreveal-script', get_template_directory_uri() . '/js/scrollReveal.min.js', array('jquery'), '20150417', true );
	wp_enqueue_script( 'countdown-script', get_template_directory_uri() . '/js/jquery.countdown.min.js', array('jquery'), '20150417', true );
	wp_enqueue_script( 'slick-script', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), '20150417', true );
	wp_enqueue_script( 'jquery-ytplayer-script', get_template_directory_uri() . '/js/jquery.mb.YTPlayer.js', array('jquery'), '20150417', true );
	wp_enqueue_script( 'jquery-fitvids-script', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), '20150417', true );
	wp_enqueue_script( 'doodle-script', get_template_directory_uri() . '/js/main.js', array('jquery'), '20150417', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'doodle_scripts' );

function doodle_add_google_fonts() {
	wp_register_style('google-font-heading1', 'https://fonts.googleapis.com/css?family=Grand+Hotel:400');
	wp_enqueue_style('google-font-heading1');
	wp_register_style('google-font-headings', 'https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:300,400,700');
	wp_enqueue_style('google-font-headings');
	wp_register_style('google-font-body', 'https://fonts.googleapis.com/css?family=Lato:300,400,700');
	wp_enqueue_style('google-font-body');
}
add_action('wp_enqueue_scripts', 'doodle_add_google_fonts');

function doodle_add_ie_html5_shim () {
    echo '<!--[if lt IE 9]>' . "\n";
    echo '<script src="' . get_template_directory_uri() . '/js/html5shiv.js"></script>' . "\n";
    echo '<script src="' . get_template_directory_uri() . '/js/respond.min.js"></script>' . "\n";
    echo '<![endif]-->' . "\n";
}
add_action('wp_head', 'doodle_add_ie_html5_shim');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load TinyMCE extra buttons.
 */
require get_template_directory() . '/inc/tinymce.php';

/**
 * Load Portfolio Post Type Customizations.
 */
require get_template_directory() . '/inc/portfolio-post-type.php';

/**
 * Override gallery shortcode
 */
require get_template_directory() . '/inc/doodle-slider.php';

/**
 * Register Custom Metaboxes and Fields
 */
require_once(get_template_directory() . '/inc/cmb2.php');

/**
 * Include the TGM_Plugin_Activation class
 */
require_once(get_template_directory() . '/inc/class-tgm-plugin-activation.php');
add_action( 'tgmpa_register', 'doodle_register_required_plugins' );
function doodle_register_required_plugins() {
	$plugins = array(
		array(
			'name'      => __('Portfolio Post Type', 'doodle'),
			'slug'      => 'portfolio-post-type',
			'required'  => false,
		),
		array(
			'name'      => __('Shortcake (Shortcode UI)', 'doodle'),
			'slug'      => 'shortcode-ui',
			'required'  => false,
		),
		array(
			'name'      => __('Page Builder by SiteOrigin', 'doodle'),
			'slug'      => 'siteorigin-panels',
			'required'  => false,
		),
		array(
			'name'      => __('Black Studio TinyMCE Widget', 'doodle'),
			'slug'      => 'black-studio-tinymce-widget',
			'required'  => false,
		),
		array(
			'name'      => __('CMB2', 'doodle'),
			'slug'      => 'cmb2',
			'required'           => true,
			'force_activation'   => false,
			'force_deactivation' => false,
		),
		array(
			'name'      => __('CMB2 Field Type: Google Maps', 'doodle'),
			'slug'      => 'cmb-field-map',
			'source'    => 'https://github.com/mustardBees/cmb_field_map/archive/master.zip',
			'required'           => true,
			'force_activation'   => false,
			'force_deactivation' => false,
		),
		array(
			'name'               => __('Doodle Shortcodes', 'doodle'),
			'slug'               => 'doodle-shortcodes',
			'source'             => get_stylesheet_directory() . '/plugins/doodle-shortcodes.zip',
			'required'           => true,
			'force_activation'   => false,
			'force_deactivation' => false,
			'version' => '1.1',
		),
	);
	$config = array(
		'id'           => 'doodle_tgmpa',          // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'doodle-tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );

}

/**
 * Add editor style.
 */
function doodle_add_editor_styles() {
    add_editor_style( 'css/custom-editor-style.css' );
}
add_action( 'admin_init', 'doodle_add_editor_styles' );

/**
 * Change default tagcloud
 */
function doodle_tag_cloud_widget($args) {
	$args['largest'] = 24; //largest tag
	$args['smallest'] = 12; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'doodle_tag_cloud_widget' );

/**
 * Change comment layout
 */
function doodle_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="row">
	<?php if ( $args['avatar_size'] != 0 && $img_avatar = get_avatar($comment, $args['avatar_size']) ) echo '<div class="col-md-3 text-right"><div class="comment-avatar frame-'.rand(1,4).'">' . $img_avatar . '</div></div>'; ?>
	<div class="col-md-9">

	<div class="comment-author vcard">
	<?php echo get_comment_author_link(); ?>
	</div>
	<?php if ( $comment->comment_approved == '0' ) : ?>
		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'doodle' ); ?></em>
		<br />
	<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
		<?php
			/* translators: 1: date, 2: time */
			printf( __('%1$s at %2$s', 'doodle'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'doodle' ), '  ', '' );
		?>
		&nbsp;|&nbsp;
		<span class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</span>
	</div>

	<?php comment_text(); ?>

	</div>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}

/**
 * Woocommerce compatibility
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
}
if ( is_woocommerce_activated() ) {
	require get_template_directory() . '/inc/woocommerce.php';
}