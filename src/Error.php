<?php

namespace Pronamic\WordPress\Pay\Gateways\TargetPay;

/**
 * Title: TargetPay error
 * Description:
 * Copyright: Copyright (c) 2005 - 2018
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 1.0.0
 * @since   1.0.0
 */
class Error {
	/**
	 * Code
	 *
	 * @var string
	 */
	private $code;

	/**
	 * Description
	 *
	 * @var string
	 */
	private $description;

	//////////////////////////////////////////////////

	/**
	 * Constructs and initializes an TargetPay client object
	 *
	 * @param string $code
	 * @param string $description
	 */
	public function __construct( $code, $description ) {
		$this->code        = $code;
		$this->description = $description;
	}

	//////////////////////////////////////////////////

	// @todo getters and setters

	//////////////////////////////////////////////////

	/**
	 * Create an string representation of this TargetPay error object
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->code . ' ' . $this->description;
	}
}
