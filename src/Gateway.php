<?php

/**
 * Title: TargetPay gateway
 * Description:
 * Copyright: Copyright (c) 2005 - 2015
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_TargetPay_Gateway extends Pronamic_WP_Pay_Gateway {
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
	 * @param Pronamic_WP_Pay_Gateways_TargetPay_Config $config
	 */
	public function __construct( Pronamic_WP_Pay_Gateways_TargetPay_Config $config ) {
		parent::__construct( $config );

		$this->set_method( Pronamic_WP_Pay_Gateway::METHOD_HTTP_REDIRECT );
		$this->set_has_feedback( true );
		$this->set_amount_minimum( 0.84 );
		$this->set_slug( self::SLUG );

		$this->client = new Pronamic_WP_Pay_Gateways_TargetPay_Client();
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
		return array(
			'id'       => 'pronamic_ideal_issuer_id',
			'name'     => 'pronamic_ideal_issuer_id',
			'label'    => __( 'Choose your bank', 'pronamic_ideal' ),
			'required' => true,
			'type'     => 'select',
			'choices'  => $this->get_transient_issuers(),
		);
	}

	/////////////////////////////////////////////////

	/**
	 * Start
	 *
	 * @see Pronamic_WP_Pay_Gateway::start()
	 */
	public function start( Pronamic_Pay_PaymentDataInterface $data, Pronamic_Pay_Payment $payment, $payment_method = null ) {
		$parameters = new Pronamic_WP_Pay_Gateways_TargetPay_IDealStartParameters();
		$parameters->rtlo              = $this->config->layoutcode;
		$parameters->bank              = $data->get_issuer_id();
		$parameters->description       = $data->get_description();
		$parameters->amount            = $data->get_amount();
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

		// Schedule transaction status request
		// @since 1.0.3
		$time = time();
		wp_schedule_single_event( $time + 30, 'pronamic_ideal_check_transaction_status', array( 'payment_id' => $payment->get_id(), 'seconds' => 30 ) );
	}

	/////////////////////////////////////////////////

	/**
	 * Update status of the specified payment
	 *
	 * @param Pronamic_Pay_Payment $payment
	 */
	public function update_status( Pronamic_Pay_Payment $payment ) {
		$status = $this->client->check_status(
			$this->config->layoutcode,
			$payment->get_transaction_id(),
			false,
			Pronamic_IDeal_IDeal::MODE_TEST === $this->config->mode
		);

		if ( $status ) {
			$payment->set_status( Pronamic_WP_Pay_Gateways_TargetPay_ResponseCodes::transform( $status->code ) );

			if ( Pronamic_WP_Pay_Gateways_TargetPay_ResponseCodes::OK === $status->code ) {
				$payment->set_consumer_name( $status->account_name );
				$payment->set_consumer_account_number( $status->account_number );
				$payment->set_consumer_city( $status->account_city );
			}
		}
	}
}
