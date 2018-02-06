<?php

use Pronamic\WordPress\Pay\Gateways\TargetPay\IDealStartParameters;

/**
 * Title: TargetPay iDEAL start parameters test
 * Description:
 * Copyright: Copyright (c) 2005 - 2018
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.1.1
 * @since 1.0.0
 */
class Pronamic_WP_Pay_Gateways_TargetPay_IDealStartParametersTest extends PHPUnit_Framework_TestCase {
	/**
	 * Test iDEAL start parameters.
	 */
	public function test() {
		$parameters                    = new IDealStartParameters();
		$parameters->rtlo              = '12345';
		$parameters->bank              = 'test';
		$parameters->description       = 'Description';
		$parameters->amount            = 100.00;
		$parameters->return_url        = 'http://example.com/';
		$parameters->report_url        = 'http://example.com/';
		$parameters->cinfo_in_callback = true;

		$array = $parameters->get_array();

		$this->assertArrayHasKey( 'rtlo', $array );
		$this->assertArrayHasKey( 'bank', $array );
		$this->assertArrayHasKey( 'description', $array );
		$this->assertArrayHasKey( 'amount', $array );
		$this->assertArrayHasKey( 'returnurl', $array );
		$this->assertArrayHasKey( 'reporturl', $array );
		$this->assertArrayHasKey( 'cinfo_in_callback', $array );
	}
}
