<?php

namespace Pronamic\WordPress\Pay\Gateways\TargetPay;

use Pronamic\WordPress\Pay\Core\Gateway as Core_Gateway;
use Pronamic\WordPress\Pay\Core\PaymentMethods;
use Pronamic\WordPress\Pay\Payments\Payment;

/**
 * Title: TargetPay gateway
 * Description:
 * Copyright: Copyright (c) 2005 - 2018
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 1.1.1
 * @since   1.0.0
 */
class Gateway extends Core_Gateway {
	/**
	 * Slug of this gateway
	 *
	 * @var string
	 */
	const SLUG = 'targetpay';

	/////////////////////////////////////////////////

	/**
	 * Constructs and initializes an TargetPay gateway
	 *
	 * @param Config $config
	 */
	public function __construct( Config $config ) {
		parent::__construct( $config );

		$this->supports = array(
			'payment_status_request',
		);

		$this->set_method( Gateway::METHOD_HTTP_REDIRECT );
		$this->set_has_feedback( true );
		$this->set_amount_minimum( 0.84 );
		$this->set_slug( self::SLUG );

		$this->client = new Client();
	}

	/////////////////////////////////////////////////

	/**
	 * Get issuers
	 *
	 * @see Pronamic_WP_Pay_Gateway::get_issuers()
	 */
	public function get_issuers() {
		$groups = array();

		$result = $this->client->get_issuers();

		if ( $result ) {
			$groups[] = array(
				'options' => $result,
			);
		}

		return $groups;
	}

	/////////////////////////////////////////////////

	public function get_issuer_field() {
		$payment_method = $this->get_payment_method();

		if ( null === $payment_method || PaymentMethods::IDEAL === $payment_method ) {
			return array(
				'id'       => 'pronamic_ideal_issuer_id',
				'name'     => 'pronamic_ideal_issuer_id',
				'label'    => __( 'Choose your bank', 'pronamic_ideal' ),
				'required' => true,
				'type'     => 'select',
				'choices'  => $this->get_transient_issuers(),
			);
		}
	}

	/////////////////////////////////////////////////

	/**
	 * Get payment methods
	 *
	 * @return mixed an array or null
	 */
	public function get_payment_methods() {
		return PaymentMethods::IDEAL;
	}

	/////////////////////////////////////////////////

	/**
	 * Get supported payment methods
	 *
	 * @see Pronamic_WP_Pay_Gateway::get_supported_payment_methods()
	 */
	public function get_supported_payment_methods() {
		return array(
			PaymentMethods::IDEAL,
		);
	}

	/////////////////////////////////////////////////

	/**
	 * Start
	 *
	 * @see Core_Gateway::start()
	 *
	 * @param Payment $payment
	 */
	public function start( Payment $payment ) {
		$parameters                    = new IDealStartParameters();
		$parameters->rtlo              = $this->config->layoutcode;
		$parameters->bank              = $payment->get_issuer();
		$parameters->description       = $payment->get_description();
		$parameters->amount            = $payment->get_amount();
		$parameters->return_url        = $payment->get_return_url();
		$parameters->report_url        = $payment->get_return_url();
		$parameters->cinfo_in_callback = 1;

		$result = $this->client->start_transaction( $parameters );

		if ( $result ) {
			$payment->set_action_url( $result->url );
			$payment->set_transaction_id( $result->transaction_id );
		} else {
			$this->set_error( $this->client->get_error() );
		}
	}

	/////////////////////////////////////////////////

	/**
	 * Update status of the specified payment
	 *
	 * @param Payment $payment
	 */
	public function update_status( Payment $payment ) {
		$status = $this->client->check_status(
			$this->config->layoutcode,
			$payment->get_transaction_id(),
			false,
			Gateway::MODE_TEST === $this->config->mode
		);

		if ( $status ) {
			$payment->set_status( Statuses::transform( $status->code ) );

			if ( Statuses::OK === $status->code ) {
				$payment->set_consumer_name( $status->account_name );
				$payment->set_consumer_account_number( $status->account_number );
				$payment->set_consumer_city( $status->account_city );
			}
		}
	}
}
