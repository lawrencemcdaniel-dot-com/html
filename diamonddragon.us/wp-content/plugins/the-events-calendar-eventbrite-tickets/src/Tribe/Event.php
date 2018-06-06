<?php


/**
 * Class Tribe__Events__Tickets__Eventbrite__Event
 *
 * @since 4.5
 *
 */
class Tribe__Events__Tickets__Eventbrite__Event {

	/**
	 * Meta key for the save event object from Eventbrite
	 */
	public $key_tickets = '_tribe_eventbrite_tickets';

	/**
	 * Get saved event object from custom field
	 *
	 * @since 4.5
	 *
	 * @param null $post
	 *
	 * @return bool|mixed
	 */
	public function get_event( $post = null ) {

		if ( is_null( $post ) ) {
			$post = get_the_ID();
		}

		$post = get_post( $post );

		if ( ! is_object( $post ) || ! $post instanceof WP_Post ) {
			return false;
		}

		$event_obj = get_post_meta( $post->ID, $this->key_tickets, true );

		if ( is_wp_error( $event_obj ) ) {
			return false;
		}

		return $event_obj;
	}

	/**
	 * Get Eventbrite ID from saved event object
	 *
	 * @since 4.5
	 *
	 * @param null $post
	 *
	 * @return bool|mixed
	 */
	public function get_event_id( $post = null ) {

		if ( is_null( $post ) ) {
			$post = get_the_ID();
		}
		$post = get_post( $post );

		if ( ! is_object( $post ) || ! $post instanceof WP_Post ) {
			return false;
		}

		return get_post_meta( $post->ID, '_EventBriteId', true );
	}

	/**
	 * Get Eventbrite status from saved event object
	 *
	 * @since 4.5
	 *
	 * @param null $post
	 *
	 * @return bool
	 */
	public function get_event_status( $post = null ) {

		if ( is_null( $post ) ) {
			$post = get_the_ID();
		}
		$post = get_post( $post );

		if ( ! is_object( $post ) || ! $post instanceof WP_Post ) {
			return false;
		}

		$event = $this->get_event( $post );

		if ( ! $event ) {
			return false;
		}

		return $event->status;
	}

	/**
	 * Detect if event is live on Eventbrite
	 *
	 * @since 4.5
	 *
	 * @param null $post
	 *
	 * @return bool
	 */
	public function is_live( $post = null ) {

		if ( is_null( $post ) ) {
			$post = get_the_ID();
		}
		$post = get_post( $post );

		if ( ! is_object( $post ) || ! $post instanceof WP_Post ) {
			return false;
		}

		$event = $this->get_event( $post );

		if ( ! $event ) {
			return false;
		}

		if ( empty( $event->ticket_classes ) || ! in_array( $event->status, tribe( 'eventbrite.sync.utilities' )->get_live_statues(), true ) ) {
			return false;
		}

		$now = Tribe__Events__Timezones::to_tz( strtotime( time() ), $event->end->timezone );

		if ( strtotime( $event->end->local ) < $now ) {
			return false;
		}

		return true;
	}

	/**
	 * Get the ticket costs from Eventbrite
	 *
	 * @since 4.5
	 *
	 * @param $postId       the TEC event to get the Eventbrite ticket costs from
	 * @param $only_if_live Only return the cost if the event is live
	 * @param $range        Return only the Lowest and High prices
	 *
	 * @return string|array $prices the price or range of prices of the Eventbrite tickets
	 */
	public function get_cost( $post, $only_if_live = true, $range = true ) {
		$event = $this->get_event( $post );

		// we don't have an associated eventbrite event
		if ( ! $event ) {
			return false;
		}

		// the event isn't live, we shouldn't use the cost from EB
		if ( ! in_array( $event->status, tribe( 'eventbrite.sync.utilities' )->get_live_statues() ) && $only_if_live ) {
			return false;
		}

		// no tickets attached to the eventbrite event
		if ( empty( $event->ticket_classes ) ) {
			return false;
		}

		$tickets     = $event->ticket_classes;
		$cost        = '';
		$is_donation = true;
		$is_free     = true;
		$prices      = array();

		foreach ( $tickets as $key => $ticket ) {

			if ( ! empty( $ticket->hidden ) ) {
				continue;
			}

			if ( ! $ticket->free ) {
				$is_free = false;
			} else {
				$prices[0] = esc_attr__( 'Free', 'events-eventbrite' );
			}

			if ( ! $ticket->donation ) {
				$is_donation = false;
			}

			if ( ! empty( $ticket->cost ) ) {
				$now = current_time( 'timestamp' );

				// Check if sales_start is matters
				if ( ! empty( $ticket->sales_start ) ) {
					$start = strtotime( $ticket->sales_start );
					if ( $now < $start ) {
						continue;
					}
				}

				// Check if sales_end is matters
				if ( ! empty( $ticket->sales_end ) ) {
					$end = strtotime( $ticket->sales_end );
					if ( $now > $end ) {
						continue;
					}
				}

				// if we get here it's a valid price tag
				$prices[ $ticket->cost->value ] = $ticket->cost->display;
			}
		}

		if ( $is_donation ) {
			return esc_attr__( 'Donation', 'events-eventbrite' );
		}

		if ( $is_free ) {
			return esc_attr__( 'Free', 'events-eventbrite' );
		}

		// There's more than one ticket, grab the lowest and highest price
		if ( count( $prices ) > 1 && true === $range ) {
			$_prices_key = array_keys( $prices );
			$min         = min( $_prices_key );
			$max         = max( $_prices_key );

			$_prices[ $min ] = $prices[ $min ];
			$_prices[ $max ] = $prices[ $max ];
			$prices          = $_prices;
		}

		if ( 1 === count( $prices ) ) {
			$prices = reset( $prices );
		}

		return $prices;
	}

}
