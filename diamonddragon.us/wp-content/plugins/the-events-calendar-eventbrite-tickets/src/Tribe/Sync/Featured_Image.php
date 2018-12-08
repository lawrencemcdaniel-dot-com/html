<?php

class Tribe__Events__Tickets__Eventbrite__Sync__Featured_Image {

	/**
	 * Works through the logic of whether the "Use image on Eventbrite.com?" checkbox should show.
	 *
	 * @since 4.5.6
	 *
	 * @param int $post_id The ID of the post itself.
	 *
	 * @return boolean
	 */
	public function should_show( $post_id ) {

		if ( ! class_exists( 'Tribe__Events__Main' ) ) {
			return false;
		}

		if ( Tribe__Events__Main::POSTTYPE !== get_post_type( $post_id ) ) {
			return false;
		}

		// Bail if there's not an EB Tickets license key.
		if ( ! tribe( 'eventbrite.pue' )->has_license_key() ) {
			return false;
		}

		// If the Update Authority is set to "Overwrite", don't show this option.
		if ( 'overwrite' === tribe( 'events-aggregator.settings' )->default_update_authority() ) {
			return false;
		}

		// Bail if this EB event is not one owned by the admin.
		$eb_event    = tribe( 'eventbrite.event' )->get_event( $post_id );
		$eb_event_id = ( isset( $eb_event->id ) && is_numeric( $eb_event->id ) ? $eb_event->id : null );

		if ( $eb_event_id && empty( $eb_event->is_owner ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Appends the "Use image on Eventbrite.com?" control to the post thumbnail meta box in posts.
	 *
	 * @since 4.5.3
	 *
	 * @param string $content The existing HTML markup for the post thumbnail meta box's content.
	 * @param int $post_id The ID of the post itself.
	 * @param int $thumbnail_id The ID of the attachment used for the post thumbnail.
	 *
	 * @return string
	 */
	public function add_featured_image_control( $content, $post_id, $thumbnail_id ) {

		if ( ! $this->should_show( $post_id ) ) {
			return $content;
		}

		ob_start();

		$eb_main = Tribe__Events__Tickets__Eventbrite__Main::instance();

		wp_nonce_field( 'eb-featured-image-control', 'eb_use_thumbnail_nonce' );

		include $eb_main->plugin_dir . 'src/views/eventbrite/eb-featured-image-control.php';

		$featured_image_control = ob_get_clean();

		return $content .= $featured_image_control;
	}

}