<?php

use Pronamic\WordPress\Pay\Core\Statuses as Core_Statuses;
use Pronamic\WordPress\Pay\Gateways\TargetPay\Statuses;

/**
 * Title: TargetPay response codes tests
 * Description:
 * Copyright: Copyright (c) 2005 - 2018
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_TargetPay_ResponseCodesTest extends PHPUnit_Framework_TestCase {
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
