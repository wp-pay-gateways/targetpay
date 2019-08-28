<?php

namespace Pronamic\WordPress\Pay\Gateways\TargetPay;

/**
 * Title: TargetPay status
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class Status {
	/**
	 * Code
	 *
	 * @var string
	 */
	public $code;

	/**
	 * Description
	 *
	 * @var string
	 */
	public $description;

	/**
	 * Account number
	 *
	 * @var string
	 */
	public $account_number;

	/**
	 * Account name
	 *
	 * @var string
	 */
	public $account_name;

	/**
	 * Account city
	 *
	 * @var string
	 */
	public $account_city;

	/**
	 * Constructs and initializes an TargetPay status object
	 */
	public function __construct() {

	}

	// @todo getters and setters

	/**
	 * Create an string representation of this TargetPay error object
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->code . ' ' . $this->description;
	}
}
