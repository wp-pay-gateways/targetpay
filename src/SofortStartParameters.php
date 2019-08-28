<?php

namespace Pronamic\WordPress\Pay\Gateways\TargetPay;

/**
 * Title: TargetPay SOFORT Banking start parameters
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class SofortStartParameters extends StartParameters {
	/**
	 * Type
	 *
	 * @var string
	 */
	public $type;

	/**
	 * User IP
	 *
	 * @var string
	 */
	public $user_ip;

	/**
	 * Get array
	 *
	 * @rerturn array
	 */
	public function get_array() {
		$array = parent::get_array();

		$array['userip'] = $this->user_ip;
		$array['type']   = $this->type;

		return $array;
	}
}
