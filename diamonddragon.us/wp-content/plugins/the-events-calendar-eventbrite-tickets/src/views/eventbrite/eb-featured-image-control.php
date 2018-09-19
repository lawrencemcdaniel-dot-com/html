<?php
/**
 * The "Use image on Eventbrite.com" markup to render at the bottom of events' Featured Image meta boxes.
 *
 * Override this template in your own theme by creating a file at:
 *
 *     [your-theme]/tribe-events/eventbrite/eb-featured-image-control.php
 *
 * @package Tribe__Events__Tickets__Eventbrite__Main
 * @since 4.5.3
 * @version 4.5.3
 * @author Modern Tribe Inc.
 */

// A string of "-1" is the unchecked value for this field.
$use_wp_img = get_post_meta( get_the_ID(), '_eventbrite_image_sync_mode', true );

?>

<p>
	<label class="selectit">
		<input value="1" type="checkbox" <?php checked( '-1' !== $use_wp_img ) ?> name="EventBriteUsePostThumb">
		<?php esc_html_e( 'Use image on Eventbrite.com', 'tribe-eventbrite' ); ?>
	</label>
	<span class="dashicons dashicons-editor-help tribe-sticky-tooltip" title="<?php esc_attr_e( 'If your Update Authority settings allow, then when this event is updated on WordPress, the Featured Image will be sent to Eventbrite.com and saved as the Event Image.', 'the-events-calendar' ); ?>"></span>
</p>