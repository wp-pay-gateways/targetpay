<?php

/**
 * Title: TargetPay start parameters
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_TargetPay_StartParameters implements IteratorAggregate {
	/**
	 * Layoutcode
	 *
	 * @var string
	 */
	public $rtlo;

	/**
	 * Description
	 *
	 * @var string
	 */
	public $description;

	/**
	 * Amount
	 *
	 * @var string
	 */
	public $amount;

	/**
	 * Country
	 *
	 * @var string
	 */
	public $country;

	/**
	 * Language
	 *
	 * @var string
	 */
	public $language;

	/**
	 * Return URL
	 *
	 * @var string
	 */
	public $return_url;

	/**
	 * Report URL
	 *
	 * @var string
	 */
	public $report_url;

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
	public function get_array() {
		return array(
			'rtlo'        => $this->rtlo,
			'description' => $this->description,
			'amount'      => Pronamic_WP_Pay_Util::amount_to_cents( $this->amount ),
			'country'     => $this->country,
			'lang'        => $this->language,
			'returnurl'   => $this->return_url,
			'reporturl'   => $this->report_url,
		);
	}

	//////////////////////////////////////////////////

	/**
	 * Get iterator
	 *
	 * @return ArrayIterator
	 */
	public function getIterator() {
		return new ArrayIterator( $this->get_array() );
	}
}
