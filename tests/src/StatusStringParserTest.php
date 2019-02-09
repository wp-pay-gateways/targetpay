<?php

namespace Pronamic\WordPress\Pay\Gateways\TargetPay;

use PHPUnit_Framework_TestCase;

/**
 * Title: TargetPay status string parser test
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class StatusStringParserTest extends PHPUnit_Framework_TestCase {
	public function test_parse_status_ok() {
		$status_string = '000000 OK';

		$status = StatusStringParser::parse( $status_string );

		$this->assertInstanceOf( 'Pronamic\WordPress\Pay\Gateways\TargetPay\Status', $status );

		$this->assertEquals( '000000', $status->code );
		$this->assertEquals( 'OK', $status->description );
	}

	public function test_parse_status_ok_cinfo() {
		$status_string = '00000 OK|123456789|Pronamic|Drachten';

		$status = StatusStringParser::parse( $status_string );

		$this->assertInstanceOf( 'Pronamic\WordPress\Pay\Gateways\TargetPay\Status', $status );

		$this->assertEquals( '00000', $status->code );
		$this->assertEquals( 'OK', $status->description );
		$this->assertEquals( '123456789', $status->account_number );
		$this->assertEquals( 'Pronamic', $status->account_name );
		$this->assertEquals( 'Drachten', $status->account_city );
	}

	public function test_parse_status_tp0010() {
		$status_string = 'TP0010 Transaction has not been completed, try again later';

		$status = StatusStringParser::parse( $status_string );

		$this->assertInstanceOf( 'Pronamic\WordPress\Pay\Gateways\TargetPay\Status', $status );

		$this->assertEquals( 'TP0010', $status->code );
		$this->assertEquals( 'Transaction has not been completed, try again later', $status->description );
	}
}
