<?php

/**
 * Class WCS_Helper_Product
 *
 * This helper class should ONLY be used for unit tests!
 */
class WCS_Helper_Product {

	/**
	 * Create a simple subscription product
	 *
	 * @param array $meta_filter
	 * @param array $post_meta
	 * @since 2.0
	 */
	public static function create_simple_subscription_product( $meta_filters = array(), $post_filters = array() ) {
		$default_meta_args = array (
			'stock_status'                   => 'instock',
			'downloadable'                   => 'no',
			'virtual'                        => 'no',
			'sold_individually'              => 'no',
			'back_orders'                    => 'no',
			'subscription_payment_sync_date' => 0,
			'subscription_price'             => 10,
			'subscription_period'            => 'month',
			'subscription_period_interval'   => 1,
			'subscription_trial_period'      => 'day',
			'subscription_length'            => 0,
			'subscription_trial_length'      => 0,
			'subscription_limit'             => 'no',
		);
		$meta_data = wp_parse_args( $meta_filters, $default_meta_args );

		$default_post_args = array(
			'post_status'    => 'publish',
			'post_type'      => 'product',
			'post_title'     => 'Monthly WooNinja Goodies',
		);
		$post_data = wp_parse_args( $post_filters, $default_post_args );

		$product_id = wp_insert_post( $post_data );

		if ( is_wp_error( $product_id ) ) {
			return false;
		}

		foreach ( $meta_data as $meta_key => $meta_value ) {
			update_post_meta( $product_id, '_' . $meta_key, $meta_value );
		}

		wp_set_object_terms( $product_id, 'subscription', 'product_type' );

		return wc_get_product( $product_id );
	}

	/**
	 * Create a variable subscription product
	 *
	 * @param string $return_product The product object to return. Default is 'variable', but can also be 'variation' to return the variation.
	 * @return WC_Abstract_Product
	 * @since 2.3.0
	 */
	public static function create_variable_subscription_product( $return_product = 'variable' ) {
		global $wpdb;

		// Create all attribute related things
		$attribute_data = WC_Helper_Product::create_attribute();

		// Create the product
		$product_id = wp_insert_post( array(
			'post_title'  => 'Dummy Product',
			'post_type'   => 'product',
			'post_status' => 'publish',
		) );

		// Set it as variable.
		wp_set_object_terms( $product_id, 'variable-subscription', 'product_type' );

		// Price related meta
		update_post_meta( $product_id, '_price', '10' );
		update_post_meta( $product_id, '_min_variation_price', '10' );
		update_post_meta( $product_id, '_max_variation_price', '15' );
		update_post_meta( $product_id, '_min_variation_regular_price', '10' );
		update_post_meta( $product_id, '_max_variation_regular_price', '15' );

		// General meta
		update_post_meta( $product_id, '_sku', 'DUMMY SKU' );
		update_post_meta( $product_id, '_manage_stock', 'no' );
		update_post_meta( $product_id, '_tax_status', 'taxable' );
		update_post_meta( $product_id, '_downloadable', 'no' );
		update_post_meta( $product_id, '_virtual', 'no' );
		update_post_meta( $product_id, '_stock_status', 'instock' );

		// Attributes
		update_post_meta( $product_id, '_default_attributes', array() );
		update_post_meta( $product_id, '_product_attributes', array(
			'pa_size' => array(
				'name'         => 'pa_size',
				'value'        => '',
				'position'     => '1',
				'is_visible'   => 0,
				'is_variation' => 1,
				'is_taxonomy'  => 1,
			),
		) );

		// Link the product to the attribute
		$wpdb->insert( $wpdb->prefix . 'term_relationships', array(
			'object_id'        => $product_id,
			'term_taxonomy_id' => $attribute_data['term_taxonomy_id'],
			'term_order'       => 0,
		) );

		// Create the variation
		$variation_id = wp_insert_post( array(
			'post_title'  => 'Variation #' . ( $product_id + 1 ) . ' of Dummy Product',
			'post_type'   => 'product_variation',
			'post_parent' => $product_id,
			'post_status' => 'publish',
			'menu_order'  => 1,
			'post_date'   => date( 'Y-m-d H:i:s', time() - 30 ), // Makes sure post dates differ if super quick.
		) );

		// Price related meta
		update_post_meta( $variation_id, '_price', '10' );
		update_post_meta( $variation_id, '_regular_price', '10' );

		// General meta
		update_post_meta( $variation_id, '_sku', 'DUMMY SKU VARIABLE SMALL' );
		update_post_meta( $variation_id, '_manage_stock', 'no' );
		update_post_meta( $variation_id, '_downloadable', 'no' );
		update_post_meta( $variation_id, '_virtual', 'no' );
		update_post_meta( $variation_id, '_stock_status', 'instock' );

		wp_set_object_terms( $variation_id, 'variation', 'product_type' );

		// Attribute meta
		update_post_meta( $variation_id, 'attribute_pa_size', 'small' );

		// Create the variation
		$variation_id = wp_insert_post( array(
			'post_title'  => 'Variation #' . ( $product_id + 2 ) . ' of Dummy Product',
			'post_type'   => 'product_variation',
			'post_parent' => $product_id,
			'post_status' => 'publish',
			'menu_order'  => 2,
		) );

		// Price related meta
		update_post_meta( $variation_id, '_price', '15' );
		update_post_meta( $variation_id, '_regular_price', '15' );

		// General meta
		update_post_meta( $variation_id, '_sku', 'DUMMY SKU VARIABLE LARGE' );
		update_post_meta( $variation_id, '_manage_stock', 'no' );
		update_post_meta( $variation_id, '_downloadable', 'no' );
		update_post_meta( $variation_id, '_virtual', 'no' );
		update_post_meta( $variation_id, '_stock_status', 'instock' );

		// Attribute meta
		update_post_meta( $variation_id, 'attribute_pa_size', 'large' );

		// Add the variation meta to the main product
		update_post_meta( $product_id, '_max_price_variation_id', $variation_id );

		wp_set_object_terms( $variation_id, 'variation', 'product_type' );

		if ( 'variable' === $return_product ) {
			return wc_get_product( $product_id );
		} else {
			return wc_get_product( $variation_id );
		}
	}

	/**
	 * Create a simple subscription product and group it within a group product.
	 *
	 * @param string $return_product The product object to return. Default is 'simple' to return the simple product, but can also be 'group' to return the group.
	 * @return WC_Abstract_Product
	 * @since 2.3.0
	 */
	public static function create_grouped_subscription_product( $return_product = 'simple' ) {
		// Create the product
		$product = wp_insert_post( array(
			'post_title'  => 'Dummy Grouped Product',
			'post_type'   => 'product',
			'post_status' => 'publish',
		) );

		$simple_product_1 = self::create_simple_subscription_product();
		$simple_product_2 = self::create_simple_subscription_product();

		update_post_meta( $product, '_sku', 'DUMMY GROUPED SKU' );
		update_post_meta( $product, '_manage_stock', 'no' );
		update_post_meta( $product, '_tax_status', 'taxable' );
		update_post_meta( $product, '_downloadable', 'no' );
		update_post_meta( $product, '_virtual', 'no' );
		update_post_meta( $product, '_stock_status', 'instock' );

		// Set the subscription product grouped relationship in a version compatible way.
		if ( WC_Subscriptions::is_woocommerce_pre( '3.0.0' ) ) {
			wp_update_post( array( 'ID' => $simple_product_1->id, 'post_parent' => $product ) );
			wp_update_post( array( 'ID' => $simple_product_2->id, 'post_parent' => $product ) );
		} else {
			update_post_meta( $product, '_children', array( $simple_product_1->get_id(), $simple_product_2->get_id() ) );
		}

		wp_set_object_terms( $product, 'grouped', 'product_type' );

		if ( 'simple' === $return_product ) {
			return wc_get_product( $simple_product_1 );
		} else {
			return wc_get_product( $product );
		}
	}
}
