<?php

namespace Pronamic\WordPress\Pay\Gateways\TargetPay;

use PHPUnit_Framework_TestCase;
use Pronamic\WordPress\Pay\Payments\PaymentStatus as Core_Statuses;

/**
 * Title: TargetPay response codes tests
 * Description:
 * Copyright: 2005-2020 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.3
 * @since   1.0.0
 */
class ResponseCodesTest extends PHPUnit_Framework_TestCase {
	/**
	 * Test transform
	 *
	 * @dataProvider status_matrix_provider
	 *
	 * @param $response_code
	 * @param $expected
	 */
	public function test_transform( $response_code, $expected ) {
		$status = Statuses::transform( $response_code );

		$this->assertEquals( $expected, $status );
	}

	public function status_matrix_provider() {
		return array(
			array( Statuses::OK, Core_Statuses::SUCCESS ),
			array( Statuses::TRANSACTION_NOT_COMPLETED, Core_Statuses::OPEN ),
			array( Statuses::TRANSACTION_CANCLLED, Core_Statuses::CANCELLED ),
			array( Statuses::TRANSACTION_EXPIRED, Core_Statuses::EXPIRED ),
			array( 'not existing response code', null ),
		);
	}
}
