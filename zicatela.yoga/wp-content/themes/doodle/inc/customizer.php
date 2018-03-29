<?php
/**
 * doodle Theme Customizer
 *
 * @package doodle
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function doodle_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->remove_control('background_color');

	/* TITLE & TAGLINE - Display tagline */
	$wp_customize->add_setting( 'doodle_display_tagline' , array(
		'type'				=> 'theme_mod',
		'transport'			=> 'postMessage',
		'default'			=> false,
		'sanitize_callback'	=> 'sanitize_checkbox',
	));
	$wp_customize->add_control( 'doodle_display_tagline',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'Display tagline', 'doodle' ),
			'section'	=> 'title_tagline',
	));
    /* LOGO */
    $wp_customize->add_section('doodle_logo', array(
        'title'			=> __('Logo','doodle'),
        'description'	=> __('Logo settings', 'doodle'),
    ));
    /* LOGO - Logo */
    $wp_customize->add_setting( 'doodle_logo' , array(
        'default'			=> '',
        'type'				=> 'theme_mod',
        'transport'			=> 'postMessage',
        'sanitize_callback'	=> 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'doodle_logo',
        array(
            'label'		=> __( 'Site Logo', 'doodle' ),
            'section'	=> 'doodle_logo',
        )));
    /* LOGO - Max logo height */
    $wp_customize->add_setting( 'doodle_max_logo_height' , array(
        'default'			=> '48',
        'type'				=> 'theme_mod',
        'transport'			=> 'postMessage',
        'sanitize_callback'	=> 'sanitize_integer',
    ));
    $wp_customize->add_control( 'doodle_max_logo_height', array(
        'label'		=> __( 'Max logo height (in pixels)', 'doodle' ),
        'section'	=> 'doodle_logo',
        'type'		=> 'text',
    ));
	/* COLORS - Color scheme */
	$wp_customize->add_setting( 'doodle_color_scheme' , array(
		'default'			=> 'brown',
		'type'				=> 'theme_mod',
		'transport'			=> 'postMessage',
		'sanitize_callback'	=> 'doodle_sanitize_choices',
	));
	$wp_customize->add_control( 'doodle_color_scheme', 
	array(
		'type'		=> 'radio',
		'label'		=> __( 'Color scheme', 'doodle' ),
		'section'	=> 'colors',
		'choices' => array(
			'blue' => __('blue','doodle'),
			'blue-brown' => __('blue-brown', 'doodle'),
			'blue-paleyellow' => __('blue-paleyellow', 'doodle'),
			'bluegray' => __('bluegray','doodle'),
			'bluegreen' => __('bluegreen', 'doodle'),
			'brown' => __('brown', 'doodle'),
			'brown-beige' => __('brown-beige', 'doodle'),
			'brown-blue' => __('brown-blue', 'doodle'),
			'cyan' => __('cyan','doodle'),
			'fuchsia-blue' => __('fuchsia-blue', 'doodle'),
			'gold' => __('gold', 'doodle'),
			'green' => __('green', 'doodle'),
			'green-grey' => __('green-grey', 'doodle'),
			'lightbrown' => __('lightbrown', 'doodle'),
			'ochre' => __('ochre', 'doodle'),
			'orange' => __('orange','doodle'),
			'pink' => __('pink','doodle'),
			'purple' => __('purple', 'doodle'),
			'purple-bluegray' => __('purple-bluegray', 'doodle'),
			'purple-green' => __('purple-green', 'doodle'),
			'red' => __('red','doodle'),
			'red-green' => __('red-green', 'doodle'),
			'red-paleyellow' => __('red-paleyellow', 'doodle'),
			'yellow-green' => __('yellow-green', 'doodle'),
			'yellow-orange' => __('yellow-orange', 'doodle'),
			'custom-color-scheme' => __( 'custom', 'doodle' ),
        ),
	));
	/* COLORS - Primary color */
	$wp_customize->add_setting( 'doodle_primary_color' , array(
		'default'			=> '#F8F8F8',
		'type'				=> 'theme_mod',
		'transport'			=> 'postMessage',
		'sanitize_callback'	=> 'sanitize_hex_color',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'doodle_primary_color',
		array(
			'label'		=> __( 'Primary Color', 'doodle' ),
			'section'	=> 'colors',
			'settings'	=> 'doodle_primary_color',
		)));
	/* COLORS - Secondary color */
    $wp_customize->add_setting( 'doodle_secondary_color' , array(
        'default'			=> '#EEEEEE',
        'type'				=> 'theme_mod',
        'transport'			=> 'postMessage',
        'sanitize_callback'	=> 'sanitize_hex_color',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'doodle_secondary_color',
        array(
            'label'		=> __( 'Secondary Color', 'doodle' ),
            'section'	=> 'colors',
            'settings'	=> 'doodle_secondary_color',
        )));
    /* COLORS - Tertiary color */
    $wp_customize->add_setting( 'doodle_tertiary_color' , array(
        'default'			=> '#333333',
        'type'				=> 'theme_mod',
        'transport'			=> 'postMessage',
        'sanitize_callback'	=> 'sanitize_hex_color',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'doodle_tertiary_color',
        array(
            'label'		=> __( 'Tertiary Color', 'doodle' ),
            'section'	=> 'colors',
            'settings'	=> 'doodle_tertiary_color',
        )));
	/* NAVBAR */
	$wp_customize->add_section('doodle_navbar', array(
		'title'			=> __('Navbar','doodle'),
		'description'	=> __('Navbar settings', 'doodle'),
	));
	/* NAVBAR - Fixed navbar */
	$wp_customize->add_setting( 'doodle_fixed_navbar' , array(
		'type'				=> 'theme_mod',
		'transport'			=> 'postMessage',
		'default'			=> false,
		'sanitize_callback'	=> 'sanitize_checkbox',
	));
	$wp_customize->add_control( 'doodle_fixed_navbar', 
	array(
		'type'		=> 'checkbox',
		'label'		=> __( 'Fixed Navbar', 'doodle' ),
		'section'	=> 'doodle_navbar',
	));

	/* NAVBAR - Display breadcrumbs */
	$wp_customize->add_setting( 'doodle_display_breadcrumbs' , array(
		'type'				=> 'theme_mod',
		'transport'			=> 'postMessage',
		'default'			=> false,
		'sanitize_callback'	=> 'sanitize_checkbox',
	));
	$wp_customize->add_control( 'doodle_display_breadcrumbs', 
	array(
		'type'		=> 'checkbox',
		'label'		=> __( 'Display breadcrumbs', 'doodle' ),
		'section'	=> 'doodle_navbar',
	));

	/* NAVBAR - Hide secondary navbar on homepage */
	$wp_customize->add_setting( 'doodle_hide_secondary_navbar_on_homepage' , array(
		'type'				=> 'theme_mod',
		'transport'			=> 'postMessage',
		'default'			=> false,
		'sanitize_callback'	=> 'sanitize_checkbox',
	));
	$wp_customize->add_control( 'doodle_hide_secondary_navbar_on_homepage', 
	array(
		'type'		=> 'checkbox',
		'label'		=> __( 'Hide secondary navbar on homepage', 'doodle' ),
		'section'	=> 'doodle_navbar',
	));

	/* HEADER */
	$wp_customize->add_section( 'doodle_header' , array(
		'title'			=> __('Header', 'doodle'),
		'description'	=> __('Header settings', 'doodle'),
		'priority'   => 40,
	));
	/* HEADER - Header type */
	$wp_customize->add_setting( 'doodle_header_type' , array(
		'default'			=> 'background_image',
		'type'				=> 'theme_mod',
		'transport'			=> 'postMessage',
		'sanitize_callback'	=> 'doodle_sanitize_choices',
	));
	$wp_customize->add_control( 'doodle_header_type', 
	array(
		'type'		=> 'radio',
		'label'		=> __( 'Default header', 'doodle' ),
		'section'	=> 'doodle_header',
		'choices' => array(
            'none' => __( 'None', 'doodle' ),
            'background_image' => __( 'Full-width background image', 'doodle' ),
        ),
	));

	/* LOADING */
	$wp_customize->add_section( 'doodle_loading' , array(
		'title'			=> __('Loading', 'doodle'),
		'description'	=> __('Loading settings', 'doodle'),
	));
	/* LOADING - Show loader */
	$wp_customize->add_setting( 'doodle_show_loader' , array(
		'default'			=> 'never',
		'type'				=> 'theme_mod',
		'transport'			=> 'postMessage',
		'sanitize_callback'	=> 'doodle_sanitize_choices',
	));
	$wp_customize->add_control( 'doodle_show_loader', 
	array(
		'type'		=> 'radio',
		'label'		=> __( 'Show loader', 'doodle' ),
		'section'	=> 'doodle_loading',
		'choices' => array(
            'never' => __( 'Never', 'doodle' ),
            'homepage' => __( 'On homepage', 'doodle' ),
            'always' => __( 'On all pages', 'doodle' ),
        ),
	));

	/* WOOCOMMERCE */
	$wp_customize->add_section( 'doodle_woocommerce' , array(
		'title'			=> __('WooCommerce', 'doodle'),
		'description'	=> __('WooCommerce settings', 'doodle'),
	));
	/* WOOCOMMERCE - Number of products per page */
    $wp_customize->add_setting( 'doodle_wc_products_per_page' , array(
        'default'			=> '9',
        'type'				=> 'theme_mod',
        'transport'			=> 'postMessage',
        'sanitize_callback'	=> 'sanitize_integer',
    ));
    $wp_customize->add_control( 'doodle_wc_products_per_page', array(
        'label'		=> __( 'Number of products per page', 'doodle' ),
        'section'	=> 'doodle_woocommerce',
        'type'		=> 'text',
    ));
    /* WOOCOMMERCE - Number of products per row */
    $wp_customize->add_setting( 'doodle_wc_products_per_row', array(
        'default' => '3',
        'type'				=> 'theme_mod',
        'transport'			=> 'postMessage',
        'sanitize_callback'	=> 'doodle_sanitize_choices',
    ));
	$wp_customize->add_control( 'doodle_wc_products_per_row', array(
        'type' => 'select',
        'label' => __( 'Number of products per row', 'doodle' ),
        'section' => 'doodle_woocommerce',
        'choices' => array(
            '1' => __( '1', 'doodle' ),
            '2' => __( '2', 'doodle' ),
            '3' => __( '3', 'doodle' ),
            '4' => __( '4', 'doodle' ),
            '5' => __( '5', 'doodle' ),
            '6' => __( '6', 'doodle' ),
        ),
    ));
    /* WOOCOMMERCE - Sidebar */
    $wp_customize->add_setting( 'doodle_wc_sidebar', array(
        'default' => 'left',
        'type'				=> 'theme_mod',
        'transport'			=> 'postMessage',
        'sanitize_callback'	=> 'doodle_sanitize_choices',
    ));
	$wp_customize->add_control( 'doodle_wc_sidebar', array(
        'type' => 'select',
        'label' => __( 'Shop Sidebar', 'doodle' ),
        'section' => 'doodle_woocommerce',
        'choices' => array(
            'left' => 'Left',
            'right' => 'Right',
            'none' => 'None',
        ),
    ));

}
add_action( 'customize_register', 'doodle_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function doodle_customize_preview_js() {
	wp_enqueue_script( 'doodle_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'doodle_customize_preview_js' );

/**
 * Sanitize integer.
 */
function sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}

/**
 * Sanitize choices.
 */
function doodle_sanitize_choices( $input, $setting ) {
    global $wp_customize;
 
    $control = $wp_customize->get_control( $setting->id );
 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

/**
 * Sanitize checkbox.
 */
function sanitize_checkbox( $input ) {
	return ( 1 == $input ) ? 1 : '';
}

/**
 * Print inline styles for custom color scheme
 */
function doodle_customize_colors() {

    if( get_theme_mod('doodle_color_scheme', 'cyan') != 'custom-color-scheme') {
        return;
    }

    $primary_color = get_theme_mod( 'doodle_primary_color', '#F8F8F8' );
    $secondary_color = get_theme_mod( 'doodle_secondary_color', '#EEEEEE' );
    $tertiary_color = get_theme_mod( 'doodle_tertiary_color', '#333333' );
    ?>
    <style>

        /* color scheme */
        body.custom-color-scheme, .custom-color-scheme .loading-modal, .custom-color-scheme .section-title h1 small i:before {
            background-color: <?php echo $primary_color; ?>;
        }

        .custom-color-scheme .feature-icon-container {
            box-shadow: inset -4px -2px 0px <?php echo $primary_color; ?>;
        }

        .custom-color-scheme .background-accent, .custom-color-scheme .background-accent .section-title h1 small i:before, .custom-color-scheme #wp-calendar caption, .custom-color-scheme .search-submit {
            background-color: <?php echo $secondary_color; ?>;
        }

        .custom-color-scheme .background-accent .feature-icon-container {
            box-shadow: inset -4px -2px 0px <?php echo $secondary_color; ?>;
        }

        .custom-color-scheme section.inverse {
            background-color: <?php echo $tertiary_color; ?>;
        }

        .custom-color-scheme .fullwidth-intro-text h1 {
            color: <?php echo $tertiary_color; ?>;
        }

    </style>

<?php }
add_action( 'wp_head', 'doodle_customize_colors' );

/**
 * Print inline styles for max logo height
 */
function doodle_customize_logo_height() {

	if( get_theme_mod('doodle_max_logo_height') == '48' ) {
		return;
	}

	$max_logo_height = get_theme_mod( 'doodle_max_logo_height', '48' );
    $navbar_margin_top = ( $max_logo_height > 48 ) ? $max_logo_height - 48 : 0;
	?>
	<style>

		.site-name img {
			max-height: <?php echo $max_logo_height; ?>px;
		}

        .site-header .navbar-nav.navbar-right {
            margin-top: <?php echo $navbar_margin_top; ?>px;
        }

	</style>

<?php }
add_action( 'wp_head', 'doodle_customize_logo_height' );

/**
 * Add site favicon
 */
function doodle_add_favicon() {

    if( !get_theme_mod('doodle_favicon') ) {
        return;
    }

    $favicon = get_theme_mod( 'doodle_favicon' );
    ?>
    <link rel="shortcut icon" href="<?php echo $favicon; ?>" />

<?php }
add_action( 'wp_head', 'doodle_add_favicon' );