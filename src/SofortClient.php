<?php

namespace Pronamic\WordPress\Pay\Gateways\TargetPay;

use Pronamic\WordPress\Pay\Core\Util;

/**
 * Title: TargetPay SOFORT Banking client
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class SofortClient {
	/**
	 * URL to start an transaction
	 *
	 * @var string
	 */
	const URL_START_TRANSACTION = 'https://www.targetpay.com/directebanking/start';

	/**
	 * Constructs and initializes an TargetPay SOFORT Banking client object
	 */
	public function __construct() {

	}

	/**
	 * Remote get.
	 *
	 * @param string $url Request URL.
	 */
	private static function remote_get( $url ) {
	}

	/**
	 * Start transaction
	 *
	 * @param SofortStartParameters $parameters Sofort start parameters.
	 */
	public function start_transaction( SofortStartParameters $parameters ) {
		$url = Util::build_url( self::URL_START_TRANSACTION, (array) $parameters );

		$data = self::remote_get( $url );

		// @todo need work
	}
}
