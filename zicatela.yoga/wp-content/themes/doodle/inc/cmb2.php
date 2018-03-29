<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @package  doodle
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Display only on contact page
 */
function doodle_show_if_contact_page( $field ) {
	if ( "page-templates/contact.php" == get_page_template_slug($field->object_id) ) {
		return true;
	}
	return false;
}

/**
 * Display always except on contact page
 */
function doodle_show_if_not_contact_page( $field ) {
	if ( "page-templates/contact.php" != get_page_template_slug($field->object_id) ) {
		return true;
	}
	return false;
}

/**
 * Display only on portfolio page
 */
function doodle_show_if_portfolio_page( $field ) {
	if ( "page-templates/portfolio.php" == get_page_template_slug($field->object_id) ) {
		return true;
	}
	return false;
}

add_action( 'cmb2_admin_init', 'doodle_register_header_metabox' );
/**
 * Hook in and add the header options metabox. Can only happen on the 'cmb2_admin_init' hook.
 */
function doodle_register_header_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_doodle_header_';

	/**
	 * Header Options metabox
	 */
	$cmb_header = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Header Options', 'doodle' ),
		'object_types'  => array( 'page', 'post', 'portfolio', 'product'), // Post type
		'show_on_cb' => 'doodle_show_if_not_contact_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

	$cmb_header->add_field( array(
		'name'    => __( 'Header Type', 'doodle' ),
		'desc'    => __( 'Choose what to display in the Jumbotron.', 'doodle' ),
		'id'      => $prefix . 'type',
		'type'    => 'radio',
		'show_option_none' => __( 'Default', 'doodle' ),
		'options' => array(
			'none' => __( 'None', 'doodle' ),
			'background_image' => __( 'Full-width background image', 'doodle' ),
			'background_slider' => __( 'Full-width background slider', 'doodle' ),
			'boxed_slider' => __( 'Boxed slider', 'doodle' ),
			'boxed_slider_show_next_and_prev' => __( 'Boxed slider (showing next and previous slides)', 'doodle' ),
			'background_video' => __( 'Full-width background video', 'doodle' ),
			'boxed_video' => __( 'Boxed video', 'doodle' ),
		),
	) );

	$cmb_header->add_field( array(
		'name'    => __( 'Header Overlay', 'doodle' ),
		'desc'    => __( 'Choose whether to add an overlay to the Jumbotron.', 'doodle' ),
		'id'      => $prefix . 'overlay',
		'type'    => 'radio',
		'show_option_none' => __( 'None', 'doodle' ),
		'options' => array(
			'semitransparent_overlay' => __( 'Semi-transparent Overlay', 'doodle' ),
			'striped_overlay' => __( 'Striped Overlay', 'doodle' ),
		),
	) );

	$cmb_header->add_field( array(
		'name' => __( 'Background Video', 'doodle' ),
		'desc' => __( 'Enter a Youtube URL.', 'doodle' ),
		'id'   => $prefix . 'background_video',
		'type' => 'oembed',
	) );

	$cmb_header->add_field( array(
		'name'         => __( 'Background Slider', 'doodle' ),
		'desc'         => __( 'Upload or add multiple images.', 'doodle' ),
		'id'           => $prefix . 'background_slider_files',
		'type'         => 'file_list',
		'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
	) );

	$cmb_header->add_field( array(
		'name'    => __( 'Header Content', 'doodle' ),
		'desc'    => __( 'Choose whether to display some content in the header', 'doodle' ),
		'id'      => $prefix . 'content',
		'type'    => 'radio',
		'show_option_none' => __( 'None', 'doodle' ),
		'options' => array(
			'boxed_text' => __( 'Boxed Text', 'doodle' ),
			'unboxed_text' => __( 'Unboxed Text', 'doodle' ),
		),
	) );

	$cmb_header->add_field( array(
	    'name'    => 'Text box',
	    'desc'    => 'Enter the content that will be displayed in the header',
	    'id'      => $prefix . 'text_box',
	    'type'    => 'wysiwyg',
	    'options' => array( 
	    	'media_buttons' => true,
	    	'teeny' => false,
	    	'textarea_rows' => 8,
	    ),
	) );

}

add_action( 'cmb2_admin_init', 'doodle_register_contact_header_metabox' );
/**
 * Hook in and add the header options metabox. Can only happen on the 'cmb2_admin_init' hook.
 */
function doodle_register_contact_header_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_doodle_contact_header_';

	/**
	 * Header Options metabox
	 */
	$cmb_header = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Header Options', 'doodle' ),
		'object_types'  => array( 'page', ), // Post type
		'show_on_cb' => 'doodle_show_if_contact_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

	$cmb_header->add_field( array(
	    'name' => __( 'Location', 'doodle' ),
	    'desc' => __( 'Drag the marker to set the exact location', 'doodle' ),
	    'id' => $prefix . 'location',
	    'type' => 'pw_map',
	    'show_on_cb' => 'doodle_show_if_contact_page', // function should return a bool value
	    // 'split_values' => true, // Save latitude and longitude as two separate fields
	) );

	$cmb_header->add_field( array(
	    'name'    => __( 'Google Map Infowindow', 'doodle' ),
	    'desc'    => 'Content that will be displayed in a popup window above the map when the marker is clicked',
	    'id'      => $prefix . 'infowindow',
	    'type'    => 'wysiwyg',
	    'options' => array( 
	    	'media_buttons' => true,
	    	'teeny' => false,
	    	'textarea_rows' => 8,
	    ),
	) );

	$cmb_header->add_field( array(
		'name'    => __( 'Map Color', 'doodle' ),
		'desc'    => __( 'Select the map color scheme.', 'doodle' ),
		'id'      => $prefix . 'map_color',
		'type'    => 'radio',
		'show_option_none' => __( 'Black and white', 'doodle' ),
		'options' => array(
			'standard' => __( 'Standard', 'doodle' ),
		),
	) );

}

add_action( 'cmb2_admin_init', 'doodle_register_portfolio_metabox' );
/**
 * Hook in and add the portfolio options metabox. Can only happen on the 'cmb2_admin_init' hook.
 */
function doodle_register_portfolio_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_doodle_portfolio_';

	/**
	 * Portfolio Options metabox
	 */
	$cmb_portfolio = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Portfolio Options', 'doodle' ),
		'object_types'  => array( 'page', ), // Post type
		'show_on_cb' => 'doodle_show_if_portfolio_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

	$cmb_portfolio->add_field( array(
		'name'             => __( 'Number of columns', 'doodle' ),
		'desc'             => __( 'Number of columns for the portfolio grid', 'doodle' ),
		'id'               => $prefix . 'number_of_columns',
		'type'             => 'select',
		'show_option_none' => false,
		'options'          => array(
			2 => 2,
			3 => 3,
			4 => 4,
			6 => 6,
		),
		'default' => 3,
	) );

	$cmb_portfolio->add_field( array(
		'name'             => __( 'Thumbnail format', 'doodle' ),
		'desc'             => __( 'Format of the portfolio grid items', 'doodle' ),
		'id'               => $prefix . 'thumbnail_format',
		'type'             => 'select',
		'show_option_none' => false,
		'options'          => array(
			'doodle-thumb' => 'Landscape',
			'doodle-thumb-portrait' => 'Portrait',
			'doodle-thumb-square' => 'Square',
		),
		'default' => 3,
	) );

	$cmb_portfolio->add_field( array(
		'name'     => __( 'Portfolio category to Show', 'doodle' ),
		'desc'     => __( 'Enter the slug of the portfolio category to show. Leave empty to display all categories', 'doodle' ),
		'id'       => $prefix . 'category_slug',
		'type'     => 'text',
	) );

	$cmb_portfolio->add_field( array(
		'name' => __( 'Items per page', 'doodle' ),
		'desc' => __( 'Numbers of items per page. Leave empty to show all items.', 'doodle' ),
		'id'   => $prefix . 'number_of_items',
		'type' => 'text',
		'attributes' => array(
			'type' => 'number',
			'pattern' => '\d*',
		),
	) );

	$cmb_portfolio->add_field( array(
		'name' => __( 'Show animated filter', 'doodle' ),
		'desc' => __( 'Use an animated filter for the portfolio categories. This will disable pagination.', 'doodle' ),
		'id'   => $prefix . 'animated_filter',
		'type' => 'checkbox',
	) );

	$cmb_portfolio->add_field( array(
		'name' => __( 'Hide item title', 'doodle' ),
		'desc' => __( 'Hide the title of portfolio items.', 'doodle' ),
		'id'   => $prefix . 'hide_title',
		'type' => 'checkbox',
	) );

	$cmb_portfolio->add_field( array(
		'name' => __( 'Hide item excerpt', 'doodle' ),
		'desc' => __( 'Hide the excerpt of portfolio items.', 'doodle' ),
		'id'   => $prefix . 'hide_excerpt',
		'type' => 'checkbox',
	) );

	$cmb_portfolio->add_field( array(
		'name' => __( 'Hide item tags', 'doodle' ),
		'desc' => __( 'Hide the tags of portfolio items.', 'doodle' ),
		'id'   => $prefix . 'hide_tags',
		'type' => 'checkbox',
	) );

}
