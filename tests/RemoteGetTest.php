<?php

/**
 * Title: TargetPay remote get tests
 * Description:
 * Copyright: Copyright (c) 2005 - 2015
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_TargetPay_RemoteGetTest extends PHPUnit_Framework_TestCase {
	/**
	 * Pre HTTP request
	 *
	 * @see https://github.com/WordPress/WordPress/blob/3.9.1/wp-includes/class-http.php#L150-L164
	 * @return string
	 */
	public function pre_http_request( $preempt, $request, $url ) {
		$response = file_get_contents( __DIR__ . '/Mock/GetIssuersXml200.http' );

		$processedResponse = WP_Http::processResponse( $response );

		$processedHeaders = WP_Http::processHeaders( $processedResponse['headers'], $url );
		$processedHeaders['body'] = $processedResponse['body'];

		return $processedHeaders;
	}

	public function test_get_issuers() {
		add_filter( 'pre_http_request', array( $this, 'pre_http_request' ), 10, 3 );

		$url = 'https://www.targetpay.com/ideal/getissuers.php?format=xml';

		$response = wp_remote_get( $url );

		$this->assertEquals( 200, wp_remote_retrieve_response_code( $response ) );
	}
}
