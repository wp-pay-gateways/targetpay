<?php

/**
 * Title: TargetPay SOFORT Banking client
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_TargetPay_SofortClient {
	/**
	 * URL to start an transaction
	 *
	 * @var string
	 */
	const URL_START_TRANSACTION = 'https://www.targetpay.com/directebanking/start';

	//////////////////////////////////////////////////

	/**
	 * Constructs and initializes an TargetPay SOFORT Banking client object
	 */
	public function __construct() {

	}

	//////////////////////////////////////////////////

	/**
	 * Start transaction
	 *
	 * @param Pronamic_WP_Pay_Gateways_TargetPay_Sofort_StartParameters $parameters
	 */
	public function start_transaction( Pronamic_WP_Pay_Gateways_TargetPay_SofortStartParameters $parameters ) {
		$url = Pronamic_WP_Util::build_url( self::URL_START_TRANSACTION, (array) $parameters );

		$data = self::remote_get( $url );

		// @todo need work
	}
}
