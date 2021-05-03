<?php

namespace Pronamic\WordPress\Pay\Gateways\TargetPay;

/**
 * Title: TargetPay error
 * Description:
 * Copyright: 2005-2021 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class Error extends \Exception {
	/**
	 * Error code.
	 *
	 * @var string|null
	 */
	private $error_code;

	/**
	 * Description.
	 *
	 * @var string|null
	 */
	private $description;

	/**
	 * Constructs and initializes an TargetPay error.
	 *
	 * @param string $value Value.
	 */
	public function __construct( $value ) {
		parent::__construct( $value );

		$space_position = \strpos( $value, ' ' );

		if ( false !== $space_position ) {
			$this->error_code  = \substr( $value, 0, $space_position );
			$this->description = \substr( $value, $space_position + 1 );
		}
	}

	/**
	 * Get code.
	 *
	 * @return string|null
	 */
	public function get_code() {
		return $this->error_code;
	}

	/**
	 * Set code.
	 *
	 * @param string|null $code Code.
	 */
	public function set_code( $code ) {
		$this->error_code = $code;
	}

	/**
	 * Get description.
	 *
	 * @return string|null
	 */
	public function get_description() {
		return $this->description;
	}

	/**
	 * Set description.
	 *
	 * @param string|null $description Description.
	 */
	public function set_description( $description ) {
		$this->description = $description;
	}
}
