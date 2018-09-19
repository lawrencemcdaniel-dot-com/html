<?php

/**
 * @group wcs-helper-functions
 */
class WCS_Helper_Functions_Unit_Tests extends WCS_Unit_Test_Case {

	/**
	 * @dataProvider wcs_maybe_unprefix_key_provider
	 *
	 * @param $expected
	 * @param $key
	 * @param $prefix
	 */
	public function test_wcs_maybe_unprefix_key( $expected, $key, $prefix ) {
		$new_key = null === $prefix ? wcs_maybe_unprefix_key( $key ) : wcs_maybe_unprefix_key( $key, $prefix );
		$this->assertEquals( $expected, $new_key );
	}

	public function wcs_maybe_unprefix_key_provider() {
		return array(
			array( 'foo_key', '_foo_key', null ),
			array( 'subscription_renewal', '_subscription_renewal', null ),
			array( 'key', '_foo_key', '_foo_' ),
			array( 'foo_key', 'foo_key', null ),
		);
	}

	/**
	 * Test @see wcs_get_minor_version_string() to make sure it returns the correct minor version string for a specific input.
	 *
	 * @dataProvider wcs_get_minor_version_string_provider
	 * @param $version
	 * @param $expected
	 */
	public function test_wcs_get_minor_version_string( $version, $expected ) {
		$this->assertEquals( wcs_get_minor_version_string( $version ), $expected );
	}

	/**
	 * A data provider for @see test_wcs_get_minor_version_string().
	 *
	 * @return array
	 */
	public function wcs_get_minor_version_string_provider() {
		return array(
			array( 'bogus', '0.0' ),
			array( 'bogus.version.string', '0.0' ),
			array( '', '0.0' ),
			array( '1', '1.0' ),
			array( '1.1', '1.1' ),
			array( '1.1.0', '1.1' ),
			array( '2.10.3', '2.10' ),
			array( '2.0.0-RC-1', '2.0' ),
			array( '2.0beta-2', '2.0' ),
			array( '3.2-beta-2', '3.2' ),
		);
	}
}
