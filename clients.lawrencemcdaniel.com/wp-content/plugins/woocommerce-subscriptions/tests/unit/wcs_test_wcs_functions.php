<?php

function wcs_max_log_size_filter() {
	return $GLOBALS['wcs_max_log_size_filter'];
}

/**
 *
 */
class WCS_Functions_Unit_Tests extends WCS_Unit_Test_Case {

	public function setUp() {
		parent::setUp();
	}

	public function tearDown() {
		remove_action( 'before_delete_post', 'WC_Subscriptions_Manager::maybe_cancel_subscription', 10, 1 );
		_delete_all_posts();
		$this->commit_transaction();
		parent::tearDown();
		add_action( 'before_delete_post', 'WC_Subscriptions_Manager::maybe_cancel_subscription', 10, 1 );
	}

	public function test_wcs_cleanup_logs_no_changes() {
		$file = wc_get_log_file_path( 'wcs-cache' );

		// Nothing should happen here
		$content = uniqid();
		file_put_contents( $file, $content );
		WCS_Cached_Data_Manager::cleanup_logs();
		$this->assertEquals( $content, file_get_contents( $file ) );
	}

	public function test_wcs_cleanup_logs() {
		$file = wc_get_log_file_path( 'wcs-cache' );

		// random lines
		$lines = array();
		for( $i=0; $i < 10000; ++$i ) {
			$lines[] = uniqid( true );
		}
		$log = implode( "\n", $lines );
		file_put_contents( $file, $log );

		add_filter( 'wcs_max_log_size', 'wcs_max_log_size_filter' );
		$GLOBALS['wcs_max_log_size_filter'] = strlen( $log );

		WCS_Cached_Data_Manager::cleanup_logs();
		$content = file_get_contents( $file );
		$this->assertNotEquals( $log, $content );

		// Make sure we have "log file automatically truncated" message
		$this->assertFalse( (bool)preg_match( "/log.+truncated/", $log ) );
		$this->assertTrue( (bool) preg_match( "/log.+truncated/", $content ) );

		$new_lines = explode( "\n", $content );
		// make sure that 1000 (default lines to keep) +1 is being saved
		$this->assertEquals( 1001, count( $new_lines ) );

		// Make sure the last 1000 entries are kept
		$this->assertEquals( array_slice( $lines, -1000 ), array_slice( $new_lines, 0, 1000 ) );
	}

	public function test_wcs_is_subscription() {
		// test cases
		$subscription_object = WCS_Helper_Subscription::create_subscription( array( 'status' => 'active' ) );
		$subscription_id_int = $subscription_object->get_id();
		$subscription_id_float = (float) $subscription_id_int;
		$subscription_id_string = (string) $subscription_id_int;
		$subscription_id_zeropad = '00' . $subscription_id_string;

		$non_subscription_object = $this->factory->post->create_and_get();
		$non_subscription_id_int = (int) 9993993;
		$non_subscription_id_float = (float) 9993993.23;
		$non_subscription_id_string = '9993993';
		$non_subscription_id_zeropad = '009993993';

		$this->assertEquals( true,  wcs_is_subscription( $subscription_object ) );
		$this->assertEquals( true,  wcs_is_subscription( $subscription_id_int ) );
		$this->assertEquals( true,  wcs_is_subscription( $subscription_id_float ) );
		$this->assertEquals( true,  wcs_is_subscription( $subscription_id_string ) );
		$this->assertEquals( true,  wcs_is_subscription( $subscription_id_zeropad ) );

		$this->assertEquals( false, wcs_is_subscription( $non_subscription_object ) );
		$this->assertEquals( false, wcs_is_subscription( $non_subscription_id_int ) );
		$this->assertEquals( false, wcs_is_subscription( $non_subscription_id_float ) );
		$this->assertEquals( false, wcs_is_subscription( $non_subscription_id_string ) );
		$this->assertEquals( false, wcs_is_subscription( $non_subscription_id_zeropad ) );

		// // garbage
		$this->assertEquals( false, wcs_is_subscription( 'foo' ) );
		$this->assertEquals( false, wcs_is_subscription( array( 4 ) ) );
		$this->assertEquals( false, wcs_is_subscription( false ) );
		$this->assertEquals( false, wcs_is_subscription( true ) );
		$this->assertEquals( false, wcs_is_subscription( null ) );
	}

	public function test_wcs_do_subscriptions_exist() {
		$this->assertEquals( false, wcs_do_subscriptions_exist(), 'Subscriptions should not exist, yet wcs_do_subscriptions_exist is reporting they do' );

		$subscription = WCS_Helper_Subscription::create_subscription( array( 'status' => 'active' ) );

		$this->assertEquals( true, wcs_do_subscriptions_exist(), 'There should be a subscription, yet wcs_do_subscriptions_exist is reporting they do not.' );
	}


	public function test_wcs_get_subscription() {
		$subscription_object = WCS_Helper_Subscription::create_subscription( array( 'status' => 'active' ) );
		$non_subscription_object = $this->factory->post->create_and_get();

		$this->assertEquals( $subscription_object, wcs_get_subscription( $subscription_object ) );
		$this->assertEquals( $subscription_object, wcs_get_subscription( $subscription_object->get_id() ) );

		$this->assertEquals( false, wcs_get_subscription( $non_subscription_object ) );
		$this->assertEquals( false, wcs_get_subscription( $non_subscription_object ) );

		$this->assertEquals( false, wcs_get_subscription( 'foo' ), 'Passing a string does not return false.' );
		$this->assertEquals( false, wcs_get_subscription( null ), 'Passing null does not return false.' );
		$this->assertEquals( false, wcs_get_subscription( array( 4 ) ), 'Passing an array does not return false.' );
		$this->assertEquals( false, wcs_get_subscription( array( $subscription_object->get_id() ) ), 'Passing an array with the subscription\'s id does not return false.' );
		$this->assertEquals( false, wcs_get_subscription( true ), 'Passing true does not return false.' );
		$this->assertEquals( false, wcs_get_subscription( false ), 'Passing false does not return false.' );
	}

	/**
	 * This should throw a PHP error about a missing argument
	 */
	public function test_garbage_wcs_get_subscription() {
		if ( ! method_exists( 'PHPUnit_Runner_Version', 'id' ) || version_compare( PHPUnit_Runner_Version::id(), '6.0', '>=' ) ) {
			$this->expectException( PHP_VERSION_ID >= 70100 ? 'ArgumentCountError' : '\PHPUnit\Framework\Error\Warning' );
		} else {
			$this->setExpectedException( PHP_VERSION_ID >= 70100 ? 'ArgumentCountError' : 'PHPUnit_Framework_Error', null );
		}

		$this->assertEquals( false, wcs_get_subscription() );
	}

	/**
	 * @dataProvider wcs_create_subscription_errors_provider
	 */
	public function test_wcs_create_subscription_errors( $args, $error_code, $message = null ) {
		$subscription = wcs_create_subscription( $args );

		$this->assertEquals( true, is_wp_error( $subscription ), $message );
		$this->assertEquals( $error_code, $subscription->get_error_code(), $message );
	}

	public function wcs_create_subscription_errors_provider() {
		return array(
			// A working example here to break
			// array(
				// array(
				// 	'status'             => '',
				// 	'order_id'           => 0,
				// 	'customer_note'      => '',
				// 	'customer_id'        => 1,
				// 	'start_date'         => current_time( 'timestamp' ),
				// 	'created_via'        => '',
				// 	'order_version'      => WC_VERSION,
				// 	'currency'           => 'GBP',
				// 	'prices_include_tax' => 'yes',
				// 	'billing_period'     => 'month',
				// 	'billing_interval'   => 3,

				// ),
				// 'woocommerce_subscription_invalid_start_date_format_',
			// ),

			// #0: breaking the start date format
			array(
				array(
					'status'             => '',
					'order_id'           => 0,
					'customer_note'      => '',
					'customer_id'        => 1,
					'start_date'         => wcs_strtotime_dark_knight( 'now' ),
					'created_via'        => '',
					'order_version'      => WC_VERSION,
					'currency'           => 'GBP',
					'prices_include_tax' => 'yes',
					'billing_period'     => 'month',
					'billing_interval'   => 3,
				),
				'woocommerce_subscription_invalid_start_date_format',
			),

			// #1: breaking the start date (has to be less than now)
			array(
				array(
					'status'             => '',
					'order_id'           => 0,
					'customer_note'      => '',
					'customer_id'        => 1,
					'start_date'         => gmdate( 'Y-m-d H:i:s', wcs_strtotime_dark_knight( '+1 week' ) ),
					'created_via'        => '',
					'order_version'      => WC_VERSION,
					'currency'           => 'GBP',
					'prices_include_tax' => 'yes',
					'billing_period'     => 'month',
					'billing_interval'   => 3,
				),
				'woocommerce_subscription_invalid_start_date',
			),

			// #2 Breaking the start date other ways
			array(
				array(
					'status'             => '',
					'order_id'           => 0,
					'customer_note'      => '',
					'customer_id'        => 1,
					'start_date'         => null,
					'created_via'        => '',
					'order_version'      => WC_VERSION,
					'currency'           => 'GBP',
					'prices_include_tax' => 'yes',
					'billing_period'     => 'month',
					'billing_interval'   => 3,
				),
				'woocommerce_subscription_invalid_start_date_format',
				'Passed NULL into start date, it\' valid.',
			),

			// #3
			array(
				array(
					'status'             => '',
					'order_id'           => 0,
					'customer_note'      => '',
					'customer_id'        => 1,
					'start_date'         => false,
					'created_via'        => '',
					'order_version'      => WC_VERSION,
					'currency'           => 'GBP',
					'prices_include_tax' => 'yes',
					'billing_period'     => 'month',
					'billing_interval'   => 3,
				),
				'woocommerce_subscription_invalid_start_date_format',
				'Passed false to start_date',
			),

			// #4
			array(
				array(
					'status'             => '',
					'order_id'           => 0,
					'customer_note'      => '',
					'customer_id'        => 1,
					'start_date'         => true,
					'created_via'        => '',
					'order_version'      => WC_VERSION,
					'currency'           => 'GBP',
					'prices_include_tax' => 'yes',
					'billing_period'     => 'month',
					'billing_interval'   => 3,
				),
				'woocommerce_subscription_invalid_start_date_format',
				'Passed true to start_date',
			),

			// #5
			array(
				array(
					'status'             => '',
					'order_id'           => 0,
					'customer_note'      => '',
					'customer_id'        => 1,
					'start_date'         => 'foo',
					'created_via'        => '',
					'order_version'      => WC_VERSION,
					'currency'           => 'GBP',
					'prices_include_tax' => 'yes',
					'billing_period'     => 'month',
					'billing_interval'   => 3,
				),
				'woocommerce_subscription_invalid_start_date_format',
				'Passed "foo" to start_date',
			),

			// #6
			array(
				array(
					'status'             => '',
					'order_id'           => 0,
					'customer_note'      => '',
					'customer_id'        => 1,
					'start_date'         => array( 42 ),
					'created_via'        => '',
					'order_version'      => WC_VERSION,
					'currency'           => 'GBP',
					'prices_include_tax' => 'yes',
					'billing_period'     => 'month',
					'billing_interval'   => 3,
				),
				'woocommerce_subscription_invalid_start_date_format',
				'Passed array( 42 ) to start_date.',
			),

			// #7
			array(
				array(
					'status'             => '',
					'order_id'           => 0,
					'customer_note'      => '',
					'customer_id'        => 1,
					'start_date'         => array( 'foo' ),
					'created_via'        => '',
					'order_version'      => WC_VERSION,
					'currency'           => 'GBP',
					'prices_include_tax' => 'yes',
					'billing_period'     => 'month',
					'billing_interval'   => 3,
				),
				'woocommerce_subscription_invalid_start_date_format',
				'Passed array( "foo" ) to start_date',
			),

			// #8
			array(
				array(
					'status'             => '',
					'order_id'           => 0,
					'customer_note'      => '',
					'customer_id'        => 1,
					'start_date'         => new stdClass(),
					'created_via'        => '',
					'order_version'      => WC_VERSION,
					'currency'           => 'GBP',
					'prices_include_tax' => 'yes',
					'billing_period'     => 'month',
					'billing_interval'   => 3,
				),
				'woocommerce_subscription_invalid_start_date_format',
				'Passed new stdClass to start_date',
			),

			// #9
			array(
				array(
					'status'             => '',
					'order_id'           => 0,
					'customer_note'      => '',
					'customer_id'        => 1,
					'start_date'         => -1,
					'created_via'        => '',
					'order_version'      => WC_VERSION,
					'currency'           => 'GBP',
					'prices_include_tax' => 'yes',
					'billing_period'     => 'month',
					'billing_interval'   => 3,
				),
				'woocommerce_subscription_invalid_start_date_format',
				'Passed -1 to start_date',
			),

			// #10: Break the customer IDs
			array(
				array(
					'status'             => '',
					'order_id'           => 0,
					'customer_note'      => '',
					// 'customer_id'        => 1,
					'start_date'         => gmdate( 'Y-m-d H:i:s' ),
					'created_via'        => '',
					'order_version'      => WC_VERSION,
					'currency'           => 'GBP',
					'prices_include_tax' => 'yes',
					'billing_period'     => 'month',
					'billing_interval'   => 3,
				),
				'woocommerce_subscription_invalid_customer_id',
			),

			// #11
			array(
				array(
					'status'             => '',
					'order_id'           => 0,
					'customer_note'      => '',
					'customer_id'        => 'foo',
					'start_date'         => gmdate( 'Y-m-d H:i:s' ),
					'created_via'        => '',
					'order_version'      => WC_VERSION,
					'currency'           => 'GBP',
					'prices_include_tax' => 'yes',
					'billing_period'     => 'month',
					'billing_interval'   => 3,
				),
				'woocommerce_subscription_invalid_customer_id',
			),

			// #12
			array(
				array(
					'status'             => '',
					'order_id'           => 0,
					'customer_note'      => '',
					'customer_id'        => array( 1 ),
					'start_date'         => gmdate( 'Y-m-d H:i:s' ),
					'created_via'        => '',
					'order_version'      => WC_VERSION,
					'currency'           => 'GBP',
					'prices_include_tax' => 'yes',
					'billing_period'     => 'month',
					'billing_interval'   => 3,
				),
				'woocommerce_subscription_invalid_customer_id',
			),

			// #13
			array(
				array(
					'status'             => '',
					'order_id'           => 0,
					'customer_note'      => '',
					'customer_id'        => -1,
					'start_date'         => gmdate( 'Y-m-d H:i:s' ),
					'created_via'        => '',
					'order_version'      => WC_VERSION,
					'currency'           => 'GBP',
					'prices_include_tax' => 'yes',
					'billing_period'     => 'month',
					'billing_interval'   => 3,
				),
				'woocommerce_subscription_invalid_customer_id',
				'Passed -1 to customer_id.',
			),

			// #14
			array(
				array(
					'status'             => '',
					'order_id'           => 0,
					'customer_note'      => '',
					'customer_id'        => false,
					'start_date'         => gmdate( 'Y-m-d H:i:s' ),
					'created_via'        => '',
					'order_version'      => WC_VERSION,
					'currency'           => 'GBP',
					'prices_include_tax' => 'yes',
					'billing_period'     => 'month',
					'billing_interval'   => 3,
				),
				'woocommerce_subscription_invalid_customer_id',
				'Passed false to customer_id',
			),

			// #15
			array(
				array(
					'status'             => '',
					'order_id'           => 0,
					'customer_note'      => '',
					'customer_id'        => true,
					'start_date'         => gmdate( 'Y-m-d H:i:s' ),
					'created_via'        => '',
					'order_version'      => WC_VERSION,
					'currency'           => 'GBP',
					'prices_include_tax' => 'yes',
					'billing_period'     => 'month',
					'billing_interval'   => 3,
				),
				'woocommerce_subscription_invalid_customer_id',
			),

			// #16: Let's break the billing periods
			array(
				array(
					'status'             => '',
					'order_id'           => 0,
					'customer_note'      => '',
					'customer_id'        => 1,
					'start_date'         => gmdate( 'Y-m-d H:i:s' ),
					'created_via'        => '',
					'order_version'      => WC_VERSION,
					'currency'           => 'GBP',
					'prices_include_tax' => 'yes',
					// 'billing_period'     => 'month',
					'billing_interval'   => 3,
				),
				'woocommerce_subscription_invalid_billing_period',
			),

			// #17
			array(
				array(
					'status'             => '',
					'order_id'           => 0,
					'customer_note'      => '',
					'customer_id'        => 1,
					'start_date'         => gmdate( 'Y-m-d H:i:s' ),
					'created_via'        => '',
					'order_version'      => WC_VERSION,
					'currency'           => 'GBP',
					'prices_include_tax' => 'yes',
					'billing_period'     => 'eon',
					'billing_interval'   => 3,
				),
				'woocommerce_subscription_invalid_billing_period',
			),

			// #18
			array(
				array(
					'status'             => '',
					'order_id'           => 0,
					'customer_note'      => '',
					'customer_id'        => 1,
					'start_date'         => gmdate( 'Y-m-d H:i:s' ),
					'created_via'        => '',
					'order_version'      => WC_VERSION,
					'currency'           => 'GBP',
					'prices_include_tax' => 'yes',
					'billing_period'     => 'month',
					'billing_interval'   => 0,
				),
				'woocommerce_subscription_invalid_billing_interval',
			),

			// #19
			array(
				array(
					'status'             => '',
					'order_id'           => 0,
					'customer_note'      => '',
					'customer_id'        => 1,
					'start_date'         => gmdate( 'Y-m-d H:i:s' ),
					'created_via'        => '',
					'order_version'      => WC_VERSION,
					'currency'           => 'GBP',
					'prices_include_tax' => 'yes',
					'billing_period'     => 'month',
					// 'billing_interval'   => -1,
				),
				'woocommerce_subscription_invalid_billing_interval',
			),

			// #20
			array(
				array(
					'status'             => '',
					'order_id'           => 0,
					'customer_note'      => '',
					'customer_id'        => 1,
					'start_date'         => gmdate( 'Y-m-d H:i:s' ),
					'created_via'        => '',
					'order_version'      => WC_VERSION,
					'currency'           => 'GBP',
					'prices_include_tax' => 'yes',
					'billing_period'     => 'month',
					'billing_interval'   => 'foo',
				),
				'woocommerce_subscription_invalid_billing_interval',
			),

			// #21
			array(
				array(
					'status'             => '',
					'order_id'           => 0,
					'customer_note'      => '',
					'customer_id'        => 1,
					'start_date'         => gmdate( 'Y-m-d H:i:s' ),
					'created_via'        => '',
					'order_version'      => WC_VERSION,
					'currency'           => 'GBP',
					'prices_include_tax' => 'yes',
					'billing_period'     => 'month',
					'billing_interval'   => array( 3 ),
				),
				'woocommerce_subscription_invalid_billing_interval',
				'Passed array( 3 ) into billing interval, apparently valid.',
			),

			// #22
			array(
				array(
					'status'             => '',
					'order_id'           => 0,
					'customer_note'      => '',
					'customer_id'        => 1,
					'start_date'         => gmdate( 'Y-m-d H:i:s' ),
					'created_via'        => '',
					'order_version'      => WC_VERSION,
					'currency'           => 'GBP',
					'prices_include_tax' => 'yes',
					'billing_period'     => 'month',
					'billing_interval'   => array( 'foo' ),
				),
				'woocommerce_subscription_invalid_billing_interval',
				'Passed array( "foo" ) into billing_interval, apparently valid',
			),
		);
	}


	/**
	 * @dataProvider wcs_create_subscription_provider
	 */
	public function test_wcs_create_subscription_no_order( $args, $expects ) {
		$default_expects = array(
			'post_date_gmt' => gmdate( 'Y-m-d H:i:s' ),
		);
		$expects = wp_parse_args( $expects, $default_expects );

		$default_include_tax = get_option( 'woocommerce_prices_include_tax' );
		update_option( 'woocommerce_prices_include_tax', $expects['set_tax'] );

		$subscription = wcs_create_subscription( $args );
		$subscription_id = $subscription->get_id();

		$this->assertEquals( false, is_wp_error( $subscription ) );
		$this->assertEquals( true, wcs_is_subscription( $subscription ) );

		$this->assertEquals( $expects['currency']   , get_post_meta( $subscription_id, '_order_currency',     true ) );
		$this->assertEquals( $expects['period']     , get_post_meta( $subscription_id, '_billing_period',     true ) );
		$this->assertEquals( $expects['interval']   , get_post_meta( $subscription_id, '_billing_interval',   true ) );
		$this->assertEquals( $expects['customer']   , get_post_meta( $subscription_id, '_customer_user',      true ) );
		$this->assertEquals( $expects['version']    , get_post_meta( $subscription_id, '_order_version',      true ) );
		$this->assertEquals( $expects['include_tax'], get_post_meta( $subscription_id, '_prices_include_tax', true ) );
		$this->assertEquals( $expects['created_via'], get_post_meta( $subscription_id, '_created_via',        true ) );
		$this->assertEquals( $expects['status']     , 'wc-' . $subscription->get_status() );
		$this->assertEquals( $expects['parent_id']  , $subscription->get_parent_id() );
		$this->assertEquals( $expects['excerpt']    , $subscription->get_customer_note() );
		$this->assertDateTimeString( $subscription->get_date( 'date_created' ) );
		$this->assertEquals( wcs_date_to_time( $expects['post_date_gmt'] ), $subscription->get_time( 'date_created' ), sprintf( 'Expected %s and actual %s dates are out of bound of the allowed 2 second discrepancy (actual difference is %s).', $expects['post_date_gmt'], $subscription->get_date( 'date_created' ), ( wcs_date_to_time( $expects['post_date_gmt'] ) - $subscription->get_time( 'date_created' ) ) ), 2 );

		update_option( 'woocommerce_prices_include_tax', $default_include_tax );
	}

	public function wcs_create_subscription_provider() {
		$custom_start_date = gmdate( 'Y-m-d H:i:s', wcs_strtotime_dark_knight( '-1 week' ) );

		return array(
			array(
				array(
					'billing_period'     => 'month',
					'billing_interval'   => 3,
					'customer_id'        => 1,
				),
				array(
					'currency'    => 'GBP',
					'period'      => 'month',
					'interval'    => 3,
					'customer'    => 1,
					'version'     => WC_VERSION,
					'include_tax' => 'yes',
					'set_tax'     => 'yes',
					'status'      => 'wc-pending',
					'parent_id'   => 0,
					'excerpt'     => '',
					'created_via' => '',
				),
			),

			array(
				array(
					'billing_period'     => 'day',
					'billing_interval'   => 9,
					'status'             => 'active',
					'customer_note'      => 'This is a test',
					'created_via'        => 'Woo Subs 2 test case',
					'currency'           => 'USD',
					'customer_id'        => 2,
					'order_version'      => '1.5.11',
					'start_date'         => $custom_start_date,
				),
				array(
					'currency'      => 'USD',
					'period'        => 'day',
					'interval'      => 9,
					'customer'      => 2,
					'version'       => '1.5.11',
					'include_tax'   => 'no',
					'set_tax'       => 'no',
					'status'        => 'wc-active',
					'parent_id'     => 0,
					'excerpt'       => 'This is a test',
					'created_via'   => 'Woo Subs 2 test case',
					'post_date_gmt' => $custom_start_date,
				),
			),
		);
	}

	/**
	 * @dataProvider wcs_subscription_statuses_provider
	 */
	public function test_wcs_get_subscription_statuses( $key, $value ) {
		$statuses = wcs_get_subscription_statuses();
		$this->assertInternalType( 'array', $statuses );
		$this->assertArrayHasKey( $key, $statuses );
		$this->assertEquals( $value, $statuses[ $key ] );
	}

	public function wcs_subscription_statuses_provider() {
		return array(
			array( 'wc-pending', 'Pending' ),
			array( 'wc-active', 'Active' ),
			array( 'wc-on-hold', 'On hold' ),
			array( 'wc-switched', 'Switched' ),
			array( 'wc-expired', 'Expired' ),
			array( 'wc-pending-cancel', 'Pending Cancellation' ),
		);
	}

	public function test_wcs_get_subscription_statuses_filterable() {
		add_filter( 'wcs_subscription_statuses', array( $this, '_filter_wcs_get_subscription_statuses' ) );

		$statuses = wcs_get_subscription_statuses();
		$this->assertArrayHasKey( 'wc-foo', $statuses );
		$this->assertEquals( 'Foo', $statuses['wc-foo'] );

		remove_filter( 'wcs_subscription_statuses', array( $this, '_filter_wcs_get_subscription_statuses' ) );
	}

	public function _filter_wcs_get_subscription_statuses( $statuses ) {
		$statuses['wc-foo'] = 'Foo';
		return $statuses;
	}

	/**
	 * @dataProvider wcs_get_subscription_status_name_provider
	 */
	public function test_wcs_get_subscription_status_name( $candidate, $expected ) {
		$this->assertEquals( $expected, wcs_get_subscription_status_name( $candidate ) );
	}

	public function wcs_get_subscription_status_name_provider() {
		return array(
			array( 'wc-pending', 'Pending' ),
			array( 'pending', 'Pending' ),
			array( 'foo', 'foo' ),
			array( '42', '42' ),
			array( '', '' ),
			array( 'foowc-bar', 'foowc-bar' ),
		);
	}

	/**
	 * @dataProvider wcs_sanitize_status_key_provider
	 */
	public function test_wcs_sanitize_status_key( $actual, $expected ) {
		$this->assertEquals( $expected, wcs_sanitize_subscription_status_key( $actual ) );
	}

	public function wcs_sanitize_status_key_provider() {
		return array(
			array( 'pending', 'wc-pending' ),
			array( 'wc-pending', 'wc-pending' ),
			array( 'foo', 'wc-foo' ),
			array( '', '' ),
			array( 42, '' ),
			array( array(), '' ),
			array( true, '' ),
			array( -1, '' ),
			array( false, '' ),
			array( null, '' ),
			array( new stdClass, '' ),
			array( new WP_Error( 'foo' ), '' ),
		);
	}

	/**
	 * ->assertWPError is not a built in phpunit assertion. It's defined in
	 * tmp/wordpress-tests-lib/includes/testcase.php
	 *
	 * @dataProvider wcs_get_subscription_status_name_error_provider
	 */
	public function test_wcs_get_subscription_status_name_error( $candidate ) {
		$this->assertWPError( wcs_get_subscription_status_name( $candidate ), 'Can not get status name. Status is not a string.' );
	}

	public function wcs_get_subscription_status_name_error_provider() {
		return array(
			array( 42 ),
			array( array( 'foo' ) ),
			array( true ),
			array( false ),
			array( null ),
			array( new stdClass ),
			array( 0 ),
			array( -1 ),
			array( new WP_Error( 'foo' ) ),
		);
	}

	/**
	 * @dataProvider wcs_subscription_dates_provider
	 */
	public function test_wcs_get_subscription_date_types( $key, $value ) {
		$date_types = wcs_get_subscription_date_types();
		$this->assertInternalType( 'array', $date_types );
		$this->assertArrayHasKey( $key, $date_types );
		$this->assertEquals( $value, $date_types[ $key ] );
	}

	public function wcs_subscription_dates_provider() {
		return array(
			array( 'start', 'Start Date' ),
			array( 'trial_end', 'Trial End' ),
			array( 'next_payment', 'Next Payment' ),
			array( 'last_payment', 'Last Order Date' ),
			array( 'end', 'End Date' ),
		);
	}

	public function test_wcs_get_subscription_date_types_filterable() {
		add_filter( 'woocommerce_subscription_dates', array( $this, '_filter_wcs_get_subscription_date_types' ) );

		$date_types = wcs_get_subscription_date_types();

		$this->assertInternalType( 'array', $date_types );
		$this->assertArrayHasKey( 'big_bang', $date_types );
		$this->assertEquals( 'Big Bang', $date_types['big_bang'] );

		remove_filter( 'woocommerce_subscription_dates', array( $this, '_filter_wcs_get_subscription_date_types' ) );
	}

	public function _filter_wcs_get_subscription_date_types( $dates ) {
		$dates['big_bang'] = _x( 'Big Bang', 'table column header', 'woocommerce-subscriptions' );
		return $dates;
	}


	public function test_wcs_get_date_meta_key() {
		$this->assertEquals( '_schedule_foo', wcs_get_date_meta_key( 'foo' ) );
	}

	public function test_wcs_get_date_meta_key_filterable() {
		add_filter( 'woocommerce_subscription_date_meta_key_prefix', array( $this, '_filter_wcs_get_date_meta_key' ), 10, 2 );

		$this->assertEquals( '_r2d2_foo', wcs_get_date_meta_key( 'foo' ) );

		remove_filter( 'woocommerce_subscription_date_meta_key_prefix', array( $this, '_filter_wcs_get_date_meta_key' ), 10 );
	}

	public function _filter_wcs_get_date_meta_key( $prefix, $date_type ) {
		return sprintf( '_r2d2_%s', $date_type );
	}

	/**
	 * @dataProvider wcs_get_date_meta_key_error_provider
	 */
	public function test_wcs_get_date_meta_key_errors( $date_type, $message = 'Date type is not a string.' ) {
		$this->assertWPError( wcs_get_date_meta_key( $date_type ), $message );
	}

	public function wcs_get_date_meta_key_error_provider() {
		return array(
			array( '', 'Date type can not be an empty string.' ),
			array( 4 ),
			array( -1 ),
			array( (float) 34.56 ),
			array( array( 'foo' ) ),
			array( array() ),
			array( true ),
			array( false ),
			array( new stdClass ),
			array( new WP_Error( 'foo' ) ),
			array( null ),
		);
	}

	/**
	 * Deals with cases where order_id is not a shop_order
	 */
	public function test_1_wcs_get_subscriptions() {
		$non_subscription_id = $this->factory->post->create();

		$args = array( 'order_id' => $non_subscription_id );

		$subscriptions = wcs_get_subscriptions( $args );

		$this->assertEquals( array(), $subscriptions );
	}

	/**
	 * Deals with cases where we're filtering for status
	 */
	public function test_2_wcs_get_subscriptions() {

		$subscription_1 = WCS_Helper_Subscription::create_subscription(array(
			'status' => 'pending'
		) );

		$subscription_2 = WCS_Helper_Subscription::create_subscription(array(
			'status' => 'pending'
		) );

		$subscription_3 = WCS_Helper_Subscription::create_subscription(array(
			'status' => 'on-hold'
		) );

		$subscription_4 = WCS_Helper_Subscription::create_subscription(array(
			'status' => 'switched'
		) );

		$subscription_5 = WCS_Helper_Subscription::create_subscription(array(
			'status' => 'active'
		) );

		$subscription_6 = WCS_Helper_Subscription::create_subscription(array(
			'status' => 'cancelled'
		) );

		$subscription_7 = WCS_Helper_Subscription::create_subscription(array(
			'status' => 'expired'
		) );

		$subscription_8 = WCS_Helper_Subscription::create_subscription(array(
			'status' => 'pending-cancel'
		) );

		// Check for on-hold
		$subscriptions = wcs_get_subscriptions( array( 'subscription_status' => 'on-hold' ) );

		$this->assertInternalType( 'array', $subscriptions );
		$this->assertEquals( 1, count( $subscriptions ) );
		$this->assertArrayHasKey( $subscription_3->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_1->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_2->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_4->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_5->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_6->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_7->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_8->get_id(), $subscriptions );
		unset( $subscriptions );

		// Pending
		$subscriptions = wcs_get_subscriptions( array( 'subscription_status' => 'pending' ) );

		$this->assertInternalType( 'array', $subscriptions );
		$this->assertEquals( 2, count( $subscriptions ) );
		$this->assertArrayHasKey( $subscription_1->get_id(), $subscriptions );
		$this->assertArrayHasKey( $subscription_2->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_3->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_4->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_5->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_6->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_7->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_8->get_id(), $subscriptions );
		unset( $subscriptions );

		// Switched
		$subscriptions = wcs_get_subscriptions( array( 'subscription_status' => 'switched' ) );

		$this->assertInternalType( 'array', $subscriptions );
		$this->assertEquals( 1, count( $subscriptions ) );
		$this->assertArrayHasKey( $subscription_4->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_1->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_2->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_3->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_5->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_6->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_7->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_8->get_id(), $subscriptions );
		unset( $subscriptions );

		// Any
		$subscriptions = wcs_get_subscriptions( array( 'subscription_status' => 'any' ) );

		$this->assertInternalType( 'array', $subscriptions );
		$this->assertEquals( 8, count( $subscriptions ) );
		$this->assertArrayHasKey( $subscription_1->get_id(), $subscriptions );
		$this->assertArrayHasKey( $subscription_2->get_id(), $subscriptions );
		$this->assertArrayHasKey( $subscription_3->get_id(), $subscriptions );
		$this->assertArrayHasKey( $subscription_4->get_id(), $subscriptions );
		$this->assertArrayHasKey( $subscription_5->get_id(), $subscriptions );
		$this->assertArrayHasKey( $subscription_6->get_id(), $subscriptions );
		$this->assertArrayHasKey( $subscription_7->get_id(), $subscriptions );
		$this->assertArrayHasKey( $subscription_8->get_id(), $subscriptions );
		unset( $subscriptions );

		// Trash
		$subscriptions = wcs_get_subscriptions( array( 'subscription_status' => 'trash' ) );

		$this->assertInternalType( 'array', $subscriptions );
		$this->assertEmpty( $subscriptions );
		unset( $subscriptions );

		// Active
		$subscriptions = wcs_get_subscriptions( array( 'subscription_status' => 'active' ) );

		$this->assertInternalType( 'array', $subscriptions );
		$this->assertEquals( 1, count( $subscriptions ) );
		$this->assertArrayHasKey( $subscription_5->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_1->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_2->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_3->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_4->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_6->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_7->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_8->get_id(), $subscriptions );
		unset( $subscriptions );

		// Cancelled
		$subscriptions = wcs_get_subscriptions( array( 'subscription_status' => 'cancelled' ) );

		$this->assertInternalType( 'array', $subscriptions );
		$this->assertEquals( 1, count( $subscriptions ) );
		$this->assertArrayHasKey( $subscription_6->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_1->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_2->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_3->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_4->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_5->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_7->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_8->get_id(), $subscriptions );
		unset( $subscriptions );

		// Expired
		$subscriptions = wcs_get_subscriptions( array( 'subscription_status' => 'expired' ) );

		$this->assertInternalType( 'array', $subscriptions );
		$this->assertEquals( 1, count( $subscriptions ) );
		$this->assertArrayHasKey( $subscription_7->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_1->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_2->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_3->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_4->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_5->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_6->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_8->get_id(), $subscriptions );
		unset( $subscriptions );

		// Pending Cancellation
		$subscriptions = wcs_get_subscriptions( array( 'subscription_status' => 'pending-cancel' ) );

		$this->assertInternalType( 'array', $subscriptions );
		$this->assertEquals( 1, count( $subscriptions ) );
		$this->assertArrayHasKey( $subscription_8->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_1->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_2->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_3->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_4->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_5->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_6->get_id(), $subscriptions );
		$this->assertArrayNotHasKey( $subscription_7->get_id(), $subscriptions );
		unset( $subscriptions );

		// Rubbish
		$subscriptions = wcs_get_subscriptions( array( 'subscription_status' => 'rubbish' ) );

		$this->assertInternalType( 'array', $subscriptions );
		$this->assertEquals( 8, count( $subscriptions ) );
		$this->assertArrayHasKey( $subscription_1->get_id(), $subscriptions );
		$this->assertArrayHasKey( $subscription_2->get_id(), $subscriptions );
		$this->assertArrayHasKey( $subscription_3->get_id(), $subscriptions );
		$this->assertArrayHasKey( $subscription_4->get_id(), $subscriptions );
		$this->assertArrayHasKey( $subscription_5->get_id(), $subscriptions );
		$this->assertArrayHasKey( $subscription_6->get_id(), $subscriptions );
		$this->assertArrayHasKey( $subscription_7->get_id(), $subscriptions );
		$this->assertArrayHasKey( $subscription_8->get_id(), $subscriptions );

		unset( $subscriptions );

		$subscriptions = wcs_get_subscriptions( array( 'subscription_status' => '' ) );

		$this->assertInternalType( 'array', $subscriptions );
		$this->assertEquals( 0, count( $subscriptions ) );

		unset( $subscriptions );

	}

	/**
	 * Tests filtering for valid order id vs no order id
	 */
	public function test_3_wcs_get_subscriptions() {
		$order_1 = WCS_Helper_Subscription::create_order();
		$order_2 = WCS_Helper_Subscription::create_order();

		#subscription under order_1
		$subscription_1 = WCS_Helper_Subscription::create_subscription( array( 'order_id' => wcs_get_objects_property( $order_1, 'id' ) ) );

		#subscriptions under order_2
		$subscription_2 = WCS_Helper_Subscription::create_subscription( array( 'order_id' => wcs_get_objects_property( $order_2, 'id' ) ) );
		$subscription_3 = WCS_Helper_Subscription::create_subscription( array( 'order_id' => wcs_get_objects_property( $order_2, 'id' ) ) );

		$subscriptions_1 = wcs_get_subscriptions( array( 'order_id' => wcs_get_objects_property( $order_1, 'id' ) ) );
		$subscriptions_2 = wcs_get_subscriptions( array( 'order_id' => wcs_get_objects_property( $order_2, 'id' ) ) );

		$this->assertInternalType( 'array', $subscriptions_1 );
		$this->assertEquals( 1, count( $subscriptions_1 ) );
		$this->assertArrayHasKey( $subscription_1->get_id(), $subscriptions_1 );
		$this->assertArrayNotHasKey( $subscription_2->get_id(), $subscriptions_1 );
		$this->assertArrayNotHasKey( $subscription_3->get_id(), $subscriptions_1 );

		$this->assertInternalType( 'array', $subscriptions_2 );
		$this->assertEquals( 2, count( $subscriptions_2 ) );
		$this->assertArrayHasKey( $subscription_2->get_id(), $subscriptions_2 );
		$this->assertArrayHasKey( $subscription_3->get_id(), $subscriptions_2 );
		$this->assertArrayNotHasKey( $subscription_1->get_id(), $subscriptions_2 );

	}

	/**
	 * Tests ordering by status
	 */
	public function test_4_wcs_get_subscriptions() {
		$subscription_1 = WCS_Helper_Subscription::create_subscription(array(
			'status' => 'active'
		) );

		$subscription_2 = WCS_Helper_Subscription::create_subscription(array(
			'status' => 'pending'
		) );

		$subscription_3 = WCS_Helper_Subscription::create_subscription(array(
			'status' => 'on-hold'
		) );

		$subscription_4 = WCS_Helper_Subscription::create_subscription(array(
			'status' => 'switched'
		) );

		$subscription_5 = WCS_Helper_Subscription::create_subscription(array(
			'status' => 'expired'
		) );

		$subscription_6 = WCS_Helper_Subscription::create_subscription(array(
			'status' => 'cancelled'
		) );

		$subscription_7 = WCS_Helper_Subscription::create_subscription(array(
			'status' => 'active'
		) );

		$subscription_8 = WCS_Helper_Subscription::create_subscription(array(
			'status' => 'pending-cancel'
		) );

		$subscription_9 = WCS_Helper_Subscription::create_subscription(array(
			'status' => 'expired'
		) );

		$subscriptions = wcs_get_subscriptions( array( 'orderby' => 'status' ) );
		$this->assertInternalType( 'array', $subscriptions );
		$this->assertEquals( 9, count( $subscriptions ) );
		$correct_order = array(
			$subscription_1->get_id() => $subscription_1,
			$subscription_7->get_id() => $subscription_7,
			$subscription_6->get_id() => $subscription_6,
			$subscription_5->get_id() => $subscription_5,
			$subscription_9->get_id() => $subscription_9,
			$subscription_3->get_id() => $subscription_3,
			$subscription_2->get_id() => $subscription_2,
			$subscription_8->get_id() => $subscription_8,
			$subscription_4->get_id() => $subscription_4
		);
		$this->assertEquals( $subscriptions, $correct_order );
	}

	/**
	 * Tests ordering by start_date
	 */
	public function test_5_wcs_get_subscriptions() {

		$subscription_1 = WCS_Helper_Subscription::create_subscription(array(
			'start_date' => date( 'Y-m-d H:i:s', strtotime( '2016-05-07 00:00:00' ) )
		) );

		$subscription_2 = WCS_Helper_Subscription::create_subscription(array(
			'start_date' => date( 'Y-m-d H:i:s', strtotime( '2016-06-08 00:00:00' ) )
		) );

		$subscription_3 = WCS_Helper_Subscription::create_subscription(array(
			'start_date' => date( 'Y-m-d H:i:s', strtotime( '2016-07-30 09:08:08' ) )
		) );

		$subscription_4 = WCS_Helper_Subscription::create_subscription(array(
			'start_date' => date( 'Y-m-d H:i:s', strtotime( '2016-07-30 08:08:08' ) )
		) );

		$subscriptions = wcs_get_subscriptions( array( 'orderby' => 'start_date' ) );
		$this->assertInternalType( 'array', $subscriptions );
		$this->assertEquals( 4, count( $subscriptions ) );
		$correct_order = array( $subscription_3->get_id() => $subscription_3, $subscription_4->get_id() => $subscription_4, $subscription_2->get_id() => $subscription_2, $subscription_1->get_id() => $subscription_1 );
		$this->assertEquals( $subscriptions, $correct_order );

	}

	/**
	 * Tests ordering by trial_end_date
	 */
	// public function test_6_wcs_get_subscriptions() {
	//
	// }

	/**
	 * Tests ordering by end_date
	 */
	// public function test_7_wcs_get_subscriptions() {

	// }

	/**
	 * Tests filtering to a specific user
	 */
	// public function test_8_wcs_get_subscriptions() {

	// }

	/**
	 * Tests filtering to a specific product_id
	 */
	// public function test_9_wcs_get_subscriptions() {

	// }

	/**
	 * Tests filtering to a specific variation_id
	 */
	// public function test_10_wcs_get_subscriptions() {

	// }

	// public function test_wcs_get_subscriptions_for_product() {

	// }

	// public function test_wcs_get_line_items_with_a_trial() {

	// }

	// public function test_wcs_can_items_be_removed() {

	// }

	// public function test_wcs_get_order_items_product_id() {

	// }

	// public function test_wcs_get_canonical_product_id() {

	// }
}
