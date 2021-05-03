<?php

namespace Pronamic\WordPress\Pay\Gateways\TargetPay;

/**
 * Title: TargetPay error test
 * Description:
 * Copyright: 2005-2021 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   2.0.0
 */
class ErrorTest extends \PHPUnit_Framework_TestCase {
	/**
	 * Test error.
	 */
	public function test_error() {
		$error = new Error( 'TP0001 No layoutcode specified' );

		$this->assertEquals( 'TP0001', $error->get_code() );
	}

	/**
	 * Test invalid error.
	 */
	public function test_invalid_error() {
		$error = new Error( '' );

		$this->assertNull( $error->get_code() );
	}
}
