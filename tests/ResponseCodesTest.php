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
	 * @dataProvider statusMatrixProvider
	 */
	public function testTransform( $responseCode, $expected ) {
		$status = Pronamic_WP_Pay_Gateways_TargetPay_ResponseCodes::transform( $responseCode );

		$this->assertEquals( $expected, $status );
	}

	public function statusMatrixProvider() {
		return array(
			array( Pronamic_WP_Pay_Gateways_TargetPay_ResponseCodes::OK, Pronamic_WP_Pay_Statuses::SUCCESS ),
			array( Pronamic_WP_Pay_Gateways_TargetPay_ResponseCodes::TRANSACTION_NOT_COMPLETED, Pronamic_WP_Pay_Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_TargetPay_ResponseCodes::TRANSACTION_CANCLLED, Pronamic_WP_Pay_Statuses::CANCELLED ),
			array( Pronamic_WP_Pay_Gateways_TargetPay_ResponseCodes::TRANSACTION_EXPIRED, Pronamic_WP_Pay_Statuses::EXPIRED ),
			array( 'not existing response code', null ),
		);
    }
}
