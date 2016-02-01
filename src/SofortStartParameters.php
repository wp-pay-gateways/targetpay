<?php

/**
 * Title: TargetPay SOFORT Banking start parameters
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_TargetPay_SofortStartParameters extends Pronamic_WP_Pay_Gateways_TargetPay_StartParameters {
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

	//////////////////////////////////////////////////

	/**
	 * Get array
	 *
	 * @rerturn array
	 */
	protected function get_array() {
		$array = parent::get_array();

		$array['userip'] = $this->user_ip;
		$array['type']   = $this->type;

		return $array;
	}
}
