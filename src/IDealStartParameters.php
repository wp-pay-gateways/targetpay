<?php

namespace Pronamic\WordPress\Pay\Gateways\TargetPay;

use Pronamic\WordPress\Pay\Core\Util as Core_Util;

/**
 * Title: TargetPay iDEAL start parameters
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class IDealStartParameters extends StartParameters {
	/**
	 * Bank
	 *
	 * @var string
	 */
	public $bank;

	/**
	 * Customer info in callback
	 *
	 * @var boolean
	 */
	public $cinfo_in_callback;

	/**
	 * Constructs and initialize start parameters
	 */
	public function __construct() {

	}

	/**
	 * Get array
	 *
	 * @rerturn array
	 */
	public function get_array() {
		$array = parent::get_array();

		$array['bank']              = $this->bank;
		$array['cinfo_in_callback'] = Core_Util::boolean_to_numeric( $this->cinfo_in_callback );

		return $array;
	}
}
