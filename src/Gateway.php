<?php

/**
 * Title: TargetPay gateway
 * Description:
 * Copyright: Copyright (c) 2005 - 2014
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
			'choices'  => $this->get_transient_issuers()
		);
	}

	/////////////////////////////////////////////////

	/**
	 * Start
	 *
	 * @see Pronamic_WP_Pay_Gateway::start()
	 */
	public function start( Pronamic_Pay_PaymentDataInterface $data, Pronamic_Pay_Payment $payment ) {
		$result = $this->client->start_transaction(
			$this->config->layoutcode,
			$data->get_issuer_id(),
			$data->get_description(),
			$data->get_amount(),
			add_query_arg( 'payment', $payment->get_id(), home_url( '/' ) ),
			add_query_arg( 'payment', $payment->get_id(), home_url( '/' ) )
		);

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
	 * @param Pronamic_Pay_Payment $payment
	 */
	public function update_status( Pronamic_Pay_Payment $payment ) {
		$status = $this->client->check_status(
			$this->config->layoutcode,
			$payment->get_transaction_id(),
			false,
			$this->config->mode == Pronamic_IDeal_IDeal::MODE_TEST
		);

		if ( $status ) {
			$payment->set_status( Pronamic_WP_Pay_Gateways_TargetPay_ResponseCodes::transform( $status->code ) );

			if ( Pronamic_WP_Pay_Gateways_TargetPay_ResponseCodes::OK == $status->code ) {
				$payment->set_consumer_name( $status->account_name );
				$payment->set_consumer_account_number( $status->account_number );
				$payment->set_consumer_city( $status->account_city );
			}
		}
	}
}