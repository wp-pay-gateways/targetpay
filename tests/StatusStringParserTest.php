<?php

/**
 * Title: TargetPay status string parser test
 * Description:
 * Copyright: Copyright (c) 2005 - 2018
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.1.1
 * @since 1.0.0
 */
class Pronamic_WP_Pay_Gateways_TargetPay_StatusStringParserTest extends PHPUnit_Framework_TestCase {
	public function test_parse_status_ok() {
		$status_string = '000000 OK';

		$status = Pronamic_WP_Pay_Gateways_TargetPay_StatusStringParser::parse( $status_string );

		$this->assertInstanceOf( 'Pronamic_WP_Pay_Gateways_TargetPay_Status', $status );

		$this->assertEquals( '000000', $status->code );
		$this->assertEquals( 'OK', $status->description );
	}

	public function test_parse_status_ok_cinfo() {
		$status_string = '00000 OK|123456789|Pronamic|Drachten';

		$status = Pronamic_WP_Pay_Gateways_TargetPay_StatusStringParser::parse( $status_string );

		$this->assertInstanceOf( 'Pronamic_WP_Pay_Gateways_TargetPay_Status', $status );

		$this->assertEquals( '00000', $status->code );
		$this->assertEquals( 'OK', $status->description );
		$this->assertEquals( '123456789', $status->account_number );
		$this->assertEquals( 'Pronamic', $status->account_name );
		$this->assertEquals( 'Drachten', $status->account_city );
	}

	public function test_parse_status_tp0010() {
		$status_string = 'TP0010 Transaction has not been completed, try again later';

		$status = Pronamic_WP_Pay_Gateways_TargetPay_StatusStringParser::parse( $status_string );

		$this->assertInstanceOf( 'Pronamic_WP_Pay_Gateways_TargetPay_Status', $status );

		$this->assertEquals( 'TP0010', $status->code );
		$this->assertEquals( 'Transaction has not been completed, try again later', $status->description );
	}
}
