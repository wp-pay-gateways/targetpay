<?php

namespace Pronamic\WordPress\Pay\Gateways\TargetPay;

use Pronamic\WordPress\Pay\Core\Gateway as Core_Gateway;
use Pronamic\WordPress\Pay\Core\PaymentMethods;
use Pronamic\WordPress\Pay\Payments\Payment;

/**
 * Title: TargetPay gateway
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.1
 * @since   1.0.0
 */
class Gateway extends Core_Gateway {
	/**
	 * Client.
	 *
	 * @var Client
	 */
	protected $client;

	/**
	 * Constructs and initializes an TargetPay gateway
	 *
	 * @param Config $config Config.
	 */
	public function __construct( Config $config ) {
		parent::__construct( $config );

		$this->set_method( self::METHOD_HTTP_REDIRECT );

		// Supported features.
		$this->supports = array(
			'payment_status_request',
		);

		// Client.
		$this->client = new Client();
	}

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

	/**
	 * Start
	 *
	 * @see Core_Gateway::start()
	 *
	 * @param Payment $payment Payment.
	 */
	public function start( Payment $payment ) {
		$parameters                    = new IDealStartParameters();
		$parameters->rtlo              = $this->config->layoutcode;
		$parameters->bank              = $payment->get_issuer();
		$parameters->description       = $payment->get_description();
		$parameters->amount            = $payment->get_total_amount()->get_cents();
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

	/**
	 * Update status of the specified payment
	 *
	 * @param Payment $payment Payment.
	 */
	public function update_status( Payment $payment ) {
		// Get transaction status.
		$status = $this->client->check_status(
			$this->config->layoutcode,
			$payment->get_transaction_id(),
			false,
			self::MODE_TEST === $this->config->mode
		);

		if ( ! $status ) {
			return;
		}

		// Update payment status.
		$payment->set_status( Statuses::transform( $status->code ) );

		// Set payment consumer details.
		if ( Statuses::OK === $status->code ) {
			$payment->set_consumer_name( $status->account_name );
			$payment->set_consumer_account_number( $status->account_number );
			$payment->set_consumer_city( $status->account_city );
		}
	}
}
