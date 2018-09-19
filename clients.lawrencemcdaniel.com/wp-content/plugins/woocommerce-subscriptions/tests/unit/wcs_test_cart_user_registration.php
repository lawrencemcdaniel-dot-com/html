<?php


class WCS_Test_Cart_User_Registration extends WCS_Unit_Test_Case {
	public static function data_provider()
	{
		return array(
			// More details at https://github.com/Prospress/woocommerce-subscriptions/issues/1651#issuecomment-302155374
			array( array( 'enable_guest_checkout' => true, 'enable_signup' => true, 'users_can_register' => true ), true),
			array( array( 'enable_guest_checkout' => true, 'enable_signup' => true, 'users_can_register' => false ), true),
			array( array( 'enable_guest_checkout' => false, 'enable_signup' => true, 'users_can_register' => true ), true),
			array( array( 'enable_guest_checkout' => true, 'enable_signup' => false, 'users_can_register' => true ), false),
			array( array( 'enable_guest_checkout' => true, 'enable_signup' => false, 'users_can_register' => false ), false),
			array( array( 'enable_guest_checkout' => false, 'enable_signup' => true, 'users_can_register' => false ), true),
			array( array( 'enable_guest_checkout' => false, 'enable_signup' => false, 'users_can_register' => true ), false),
			array( array( 'enable_guest_checkout' => false, 'enable_signup' => false, 'users_can_register' => false ), false),
		);
	}

	/**
	 * @dataProvider data_provider
	 */
	public function test_user_registration(Array $settings, $expected)
	{
		// Create a global WC_Cart
		wc_empty_cart();

		// Add any subscription product
		add_filter( 'woocommerce_subscription_is_purchasable', '__return_true' );
		$product = WCS_Helper_Product::create_simple_subscription_product();
		$product_id = wcs_get_objects_property( $product, 'id' );
		$ret = WC()->cart->add_to_cart( $product->get_id() );
		remove_filter( 'woocommerce_subscription_is_purchasable', '__return_true' );

		// Create a fake checkout object, we don't check the type and it will
		// work for testing as long as it is an object.
		$checkout = (object)$settings;
		$checkout->must_create_account = false;

		// Also set the values on update_option (We only care about users_can_register to be honest)
		foreach ( $settings as $key => $value ) {
			update_option( $key, $value );
		}

		// Make sure there is no current user
		$GLOBALS['current_user'] = '';
		$this->assertFalse( is_user_logged_in(),  'Make sure there is no user logged in' );

		// Test the behaviour
		WC_Subscriptions_Checkout::make_checkout_registration_possible( $checkout );

		$this->assertEquals( $expected, $checkout->enable_signup, 'enable_signup' );
		$this->assertFalse( $checkout->enable_guest_checkout, 'enable_guest_checkout' );
		if ( $settings['enable_guest_checkout'] ) {
			$this->assertTrue( $checkout->must_create_account, 'must_create_account' );
		}
	}
}
