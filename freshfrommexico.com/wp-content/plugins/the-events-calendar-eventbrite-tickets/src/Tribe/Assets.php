<?php
/**
 * Class Tribe__Events__Tickets__Eventbrite__Assets
 *
 * @since 4.5
 *
 */
class Tribe__Events__Tickets__Eventbrite__Assets {

	/**
	 * Enqueue scripts for admin views
	 *
	 * @since 4.5
	 */
	public function register_admin_assets() {

		// Set up our base list of enqueues
		$enqueue_array = array(
			array( 'tribe-eventbrite-admin', 'eb-tec-admin.css', array() ),
		);

		// and the engine...
		tribe_assets(
			tribe( 'eventbrite.main' ),
			$enqueue_array,
			'admin_enqueue_scripts'
		);
	}
}
