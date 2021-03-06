<?php

namespace Pronamic\WordPress\Pay\Gateways\TargetPay;

use Pronamic\WordPress\Pay\Core\Util;
use Pronamic\WordPress\Pay\Core\XML\Security;
use stdClass;

/**
 * Title: TargetPay gateway
 * Description:
 * Copyright: 2005-2021 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.2.0
 * @since   1.0.0
 */
class Client {
	/**
	 * URL for issuers in Dutch language
	 *
	 * @var string
	 */
	const URL_ISSUERS_NL = 'https://www.targetpay.com/ideal/issuers-nl.js';

	/**
	 * URL for issuers in English language
	 *
	 * @var string
	 */
	const URL_ISSUERS_EN = 'https://www.targetpay.com/ideal/issuers-en.js';

	/**
	 * URL for retrieving issuers in HTL format
	 *
	 * @var string
	 */
	const URL_ISSUERS_HTML = 'https://www.targetpay.com/ideal/getissuers.php?format=html';

	/**
	 * URL for retrieving issuers in XML format
	 *
	 * @var string
	 */
	const URL_ISSUERS_XML = 'https://www.targetpay.com/ideal/getissuers.php?format=xml';

	/**
	 * URL to start an transaction
	 *
	 * @var string
	 */
	const URL_START_TRANSACTION = 'https://www.targetpay.com/ideal/start';

	/**
	 * URL to check an transaction
	 *
	 * @var string
	 */
	const URL_CHECK_TRANSACTION = 'https://www.targetpay.com/ideal/check';

	/**
	 * Token used by TargetPay to separate some values
	 *
	 * @var string
	 */
	const TOKEN = ' |';

	/**
	 * Status indicator for 'Ok'
	 *
	 * @var string
	 */
	const STATUS_OK = '000000';

	/**
	 * Status indicator for 'No layout code'
	 *
	 * @var string
	 */
	const STATUS_NO_LAYOUT_CODE = 'TP0001';

	/**
	 * Constructs and initializes an TargetPay client object
	 */
	public function __construct() {

	}

	/**
	 * Remote get.
	 *
	 * @param string $url URL for GET request.
	 *
	 * @return string
	 */
	private function remote_get( $url ) {
		return Util::remote_get_body( $url, 200 );
	}

	/**
	 * Start transaction
	 *
	 * @param IDealStartParameters $parameters Start parameters.
	 *
	 * @return stdClass
	 */
	public function start_transaction( IDealStartParameters $parameters ) {
		$url = Util::build_url( self::URL_START_TRANSACTION, $parameters->get_array() );

		$data = self::remote_get( $url );

		if ( false !== $data ) {
			$status = strtok( $data, self::TOKEN );

			if ( self::STATUS_OK === $status ) {
				$result = new stdClass();

				$result->status         = $status;
				$result->transaction_id = strtok( self::TOKEN );
				$result->url            = strtok( self::TOKEN );

				return $result;
			} else {
				throw new Error( $data );
			}
		}
	}

	/**
	 * Check status
	 *
	 * @param string $rtlo
	 * @param string $transaction_id
	 * @param string $once
	 * @param string $test
	 *
	 * @return null|Status
	 */
	public function check_status( $rtlo, $transaction_id, $once, $test ) {
		$result = null;

		$url = Util::build_url(
			self::URL_CHECK_TRANSACTION,
			array(
				'rtlo'  => $rtlo,
				'trxid' => $transaction_id,
				'once'  => Util::boolean_to_numeric( $once ),
				'test'  => Util::boolean_to_numeric( $test ),
			)
		);

		$data = self::remote_get( $url );

		if ( false !== $data ) {
			$result = StatusStringParser::parse( $data );
		}

		return $result;
	}

	/**
	 * Get issuers
	 *
	 * @return array
	 */
	public function get_issuers() {
		$issuers = false;

		$url = self::URL_ISSUERS_XML;

		$data = self::remote_get( $url );

		if ( false !== $data ) {
			$xml = Util::simplexml_load_string( $data );

			$issuers = array();

			foreach ( $xml->issuer as $xml_issuer ) {
				$id   = Security::filter( $xml_issuer['id'] );
				$name = Security::filter( $xml_issuer );

				$issuers[ $id ] = $name;
			}
		}

		return $issuers;
	}
}
