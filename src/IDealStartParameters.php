<?php
/**
 * Title: TargetPay iDEAL start parameters
 * Description:
 * Copyright: Copyright (c) 2005 - 2015
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_TargetPay_IDealStartParameters {
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

	//////////////////////////////////////////////////

	/**
	 * Constructs and initialize start parameters
	 */
	public function __construct() {

	}

	//////////////////////////////////////////////////

	/**
	 * Get array
	 *
	 * @rerturn array
	 */
	protected function get_array() {
		$array = parent::get_array();

		$array['bank']              = $this->bank;
		$array['cinfo_in_callback'] = $this->cinfo_in_callback;

		return $array;
	}
}
