<?php

namespace Pronamic\WordPress\Pay\Gateways\TargetPay;

use PHPUnit_Framework_TestCase;
use WP_Http;

/**
 * Title: TargetPay remote get tests
 * Description:
 * Copyright: Copyright (c) 2005 - 2018
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.1.1
 * @since 1.0.0
 */
class RemoteGetTest extends \PHPUnit_Framework_TestCase {
	/**
	 * Pre HTTP request
	 *
	 * @see https://github.com/WordPress/WordPress/blob/3.9.1/wp-includes/class-http.php#L150-L164
	 *
	 * @param $preempt
	 * @param $request
	 * @param $url
	 *
	 * @return array
	 */
	public function pre_http_request( $preempt, $request, $url ) {
		$response = file_get_contents( dirname( __FILE__ ) . '/Mock/GetIssuersXml200.http' );

		$processed_response = WP_Http::processResponse( $response );

		$processed_headers         = WP_Http::processHeaders( $processed_response['headers'], $url );
		$processed_headers['body'] = $processed_response['body'];

		return $processed_headers;
	}

	public function test_get_issuers() {
		add_filter( 'pre_http_request', array( $this, 'pre_http_request' ), 10, 3 );

		$url = 'https://www.targetpay.com/ideal/getissuers.php?format=xml';

		$response = wp_remote_get( $url );

		$this->assertEquals( 200, wp_remote_retrieve_response_code( $response ) );
	}
}
