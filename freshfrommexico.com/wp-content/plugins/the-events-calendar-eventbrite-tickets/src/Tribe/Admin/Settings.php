<?php


/**
 * Class Tribe__Events__Tickets__Eventbrite__Admin__Settings
 *
 * @since 4.5
 *
 */
class Tribe__Events__Tickets__Eventbrite__Admin__Settings {

	/**
	 * Tribe__Events__Tickets__Eventbrite__Admin__Settings constructor.
	 */
	public function __construct() {
		add_filter( 'tribe_aggregator_setting_links', array( $this, 'setting_links' ), 20 );
		add_filter( 'tribe_aggregator_fields', array( $this, 'setting_fields' ), 20, 3 );
	}

	/**
	 * Add Eventbrite link to header of Import Tab
	 *
	 * @since 4.5
	 *
	 * @param $import_setting_links
	 *
	 * @return array
	 */
	public function setting_links( $import_setting_links ) {

		$eb_links = array(
			'eventbrite-settings' => array(
				'name'     => __( 'Eventbrite', 'the-events-calendar' ),
				'priority' => 17,
			),
		);

		return array_merge( $import_setting_links, $eb_links );
	}

	/**
	 * Add Eventbrite setting fields to the import tab
	 *
	 * @since 4.5
	 *
	 * @param $fields
	 * @param $origin_categories
	 *
	 * @return array
	 */
	public function setting_fields( $fields, $origin_post_statuses, $origin_categories ) {
		$yes_no_options = array(
			'no' => __( 'No', 'tribe-eventbrite' ),
			'yes' => __( 'Yes', 'tribe-eventbrite' ),
		);
		$use_global_settings_phrase = __( 'Use global import settings', 'tribe-eventbrite' );

		$origin_show_map_options = array( '' => $use_global_settings_phrase ) + $yes_no_options;

		$eb_fields = array(
			'eventbrite-defaults' => array(
				'type' => 'html',
				'html' => '<h3 id="tribe-import-eventbrite-settings">' . esc_html__( 'Eventbrite Import Settings', 'tribe-eventbrite' ) . '</h3>',
				'priority' => 17.1,
			),
			'tribe_aggregator_default_eventbrite_post_status' => array(
				'type'            => 'dropdown',
				'label'           => esc_html__( 'Default Status', 'tribe-eventbrite' ),
				'tooltip'         => esc_html__( 'The default post status for events imported via Eventbrite', 'tribe-eventbrite' ),
				'size'            => 'medium',
				'validation_type' => 'options',
				'default'         => '',
				'can_be_empty'    => true,
				'parent_option'   => Tribe__Events__Main::OPTIONNAME,
				'options'         => $origin_post_statuses,
				'priority'        => 17.2,
			),
			'tribe_aggregator_default_eventbrite_category' => array(
				'type'            => 'dropdown',
				'label'           => esc_html__( 'Default Event Category', 'tribe-eventbrite' ),
				'tooltip'         => esc_html__( 'The default event category for events imported via Eventbrite', 'tribe-eventbrite' ),
				'size'            => 'medium',
				'validation_type' => 'options',
				'default'         => '',
				'can_be_empty'    => true,
				'parent_option'   => Tribe__Events__Main::OPTIONNAME,
				'options'         => $origin_categories,
				'priority'        => 17.3,
			),
			'tribe_aggregator_default_eventbrite_show_map' => array(
				'type'            => 'dropdown',
				'label'           => esc_html__( 'Show Google Map', 'tribe-eventbrite' ),
				'tooltip'         => esc_html__( 'Show Google Map by default on imported event and venues', 'tribe-eventbrite' ),
				'size'            => 'medium',
				'validation_type' => 'options',
				'default'         => 'no',
				'can_be_empty'    => true,
				'parent_option'   => Tribe__Events__Main::OPTIONNAME,
				'options'         => $origin_show_map_options,
				'priority'        => 17.4,
			),
		);

		return array_merge( $fields, $eb_fields );

	}
}