<?php

namespace DeliciousBrains\WP_Offload_S3\Pro\Integrations;

class Divi extends Integration {

	/**
	 * Is installed?
	 *
	 * @return bool
	 */
	public function is_installed() {
		$theme_info = wp_get_theme();

		if ( esc_html( $theme_info->get( 'Name' ) ) === 'Divi' ) {
			return true;
		}

		if ( is_child_theme() ) {
			$parent_info = $theme_info->parent();

			if ( esc_html( $parent_info->get( 'Name' ) ) === 'Divi' ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Init integration.
	 */
	public function init() {
		add_filter( 'et_fb_load_raw_post_content', function ( $content ) {
			return apply_filters( 'as3cf_filter_post_local_to_s3', $content );
		} );
	}
}
