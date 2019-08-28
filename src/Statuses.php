<?php

namespace Pronamic\WordPress\Pay\Gateways\TargetPay;

use Pronamic\WordPress\Pay\Core\Statuses as Core_Statuses;

/**
 * Title: TargetPay response codes
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class Statuses {
	/**
	 * OK
	 *
	 * @var string
	 */
	const OK = '000000';

	/**
	 * Transaction has not been completed, try again later
	 *
	 * @var string
	 */
	const TRANSACTION_NOT_COMPLETED = ' TP0010';

	/**
	 * Transaction has been cancelled
	 *
	 * @var string
	 */
	const TRANSACTION_CANCLLED = 'TP0011';

	/**
	 * Transaction has expired (max. 10 minutes)
	 *
	 * @var string
	 */
	const TRANSACTION_EXPIRED = 'TP0012';

	/**
	 * The transaction could not be processed
	 *
	 * @var string
	 */
	const TRANSACTION_NOT_PROCESSED = 'TP0013';

	/**
	 * Already used
	 *
	 * @var string
	 */
	const ALREADY_USED = 'TP0014';

	/**
	 * Layoutcode not entered
	 *
	 * @var string
	 */
	const LAYOUTCODE_NOT_ENTERED = 'TP0020';

	/**
	 * Tansaction ID not entered
	 *
	 * @var string
	 */
	const TRANSACTION_ID_NOT_ENTERED = 'TP0021';

	/**
	 * No transaction found with this ID
	 *
	 * @var string
	 */
	const TRANSACTION_NOT_FOUND = 'TP0022';

	/**
	 * Layoutcode does not match this transaction
	 *
	 * @var string
	 */
	const LAYOUCODE_NOT_MATCH_TRANSACTION = 'TP0023';

	/**
	 * Transform an TargetPay response code to an more global status
	 *
	 * @param string $response_code
	 *
	 * @return null|string
	 */
	public static function transform( $response_code ) {
		switch ( $response_code ) {
			case self::OK:
				return Core_Statuses::SUCCESS;

			case self::TRANSACTION_NOT_COMPLETED:
				return Core_Statuses::OPEN;

			case self::TRANSACTION_CANCLLED:
				return Core_Statuses::CANCELLED;

			case self::TRANSACTION_EXPIRED:
				return Core_Statuses::EXPIRED;

			default:
				return null;
		}
	}
}
