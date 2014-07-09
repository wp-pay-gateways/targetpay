<?php

/**
 * Title: TargetPay response codes tests
 * Description:
 * Copyright: Copyright (c) 2005 - 2014
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_TargetPay_ResponseCodesTest extends PHPUnit_Framework_TestCase {
	/**
	 * @dataProvider status_matrix_provider
	 */
	public function test_transform( $responseCode, $expected ) {
		$status = Pronamic_WP_Pay_Gateways_TargetPay_ResponseCodes::transform( $responseCode );

		$this->assertEquals( $expected, $status );
	}

	public function status_matrix_provider() {
		return array(
			array( Pronamic_WP_Pay_Gateways_TargetPay_ResponseCodes::OK, Pronamic_WP_Pay_Statuses::SUCCESS ),
			array( Pronamic_WP_Pay_Gateways_TargetPay_ResponseCodes::TRANSACTION_NOT_COMPLETED, Pronamic_WP_Pay_Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_TargetPay_ResponseCodes::TRANSACTION_CANCLLED, Pronamic_WP_Pay_Statuses::CANCELLED ),
			array( Pronamic_WP_Pay_Gateways_TargetPay_ResponseCodes::TRANSACTION_EXPIRED, Pronamic_WP_Pay_Statuses::EXPIRED ),
			array( 'not existing response code', null ),
		);
	}
}
