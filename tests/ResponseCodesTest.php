<?php
use Pronamic\WordPress\Pay\Core\Statuses;

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
	 */
	public function test_transform( $responseCode, $expected ) {
		$status = Pronamic_WP_Pay_Gateways_TargetPay_ResponseCodes::transform( $responseCode );

		$this->assertEquals( $expected, $status );
	}

	public function status_matrix_provider() {
		return array(
			array( Pronamic_WP_Pay_Gateways_TargetPay_ResponseCodes::OK, Statuses::SUCCESS ),
			array( Pronamic_WP_Pay_Gateways_TargetPay_ResponseCodes::TRANSACTION_NOT_COMPLETED, Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_TargetPay_ResponseCodes::TRANSACTION_CANCLLED, Statuses::CANCELLED ),
			array( Pronamic_WP_Pay_Gateways_TargetPay_ResponseCodes::TRANSACTION_EXPIRED, Statuses::EXPIRED ),
			array( 'not existing response code', null ),
		);
	}
}
