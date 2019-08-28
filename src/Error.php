<?php

namespace Pronamic\WordPress\Pay\Gateways\TargetPay;

/**
 * Title: TargetPay error
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
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

	/**
	 * Constructs and initializes an TargetPay client object
	 *
	 * @param string $code        Error code.
	 * @param string $description Error description.
	 */
	public function __construct( $code, $description ) {
		$this->code        = $code;
		$this->description = $description;
	}

	/**
	 * Get code.
	 *
	 * @return string
	 */
	public function get_code() {
		return $this->code;
	}

	/**
	 * Set code.
	 *
	 * @param string $code Code.
	 */
	public function set_code( $code ) {
		$this->code = $code;
	}

	/**
	 * Get description.
	 *
	 * @return string
	 */
	public function get_description() {
		return $this->description;
	}

	/**
	 * Set description.
	 *
	 * @param string $description Description.
	 */
	public function set_description( $description ) {
		$this->description = $description;
	}

	/**
	 * Create an string representation of this TargetPay error object.
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->get_code() . ' ' . $this->get_description();
	}
}
