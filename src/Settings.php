<?php

/**
 * Title: TargetPay gateway settings
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.0.8
 * @since 1.0.0
 */
class Pronamic_WP_Pay_Gateways_TargetPay_Settings extends Pronamic_WP_Pay_GatewaySettings {
	public function __construct() {
		add_filter( 'pronamic_pay_gateway_sections', array( $this, 'sections' ) );
		add_filter( 'pronamic_pay_gateway_fields', array( $this, 'fields' ) );
	}

	public function sections( array $sections ) {
		// TargetPay
		$sections['targetpay'] = array(
			'title'   => __( 'TargetPay', 'pronamic_ideal' ),
			'methods' => array( 'targetpay' ),
			'description' => sprintf(
				__( 'Account details are provided by %s after registration. These settings need to match with the %1$s dashboard.', 'pronamic_ideal' ),
				__( 'TargetPay', 'pronamic_ideal' )
			),
		);

		return $sections;
	}

	public function fields( array $fields ) {
		// Layout Code
		$fields[] = array(
			'filter'      => FILTER_SANITIZE_STRING,
			'section'     => 'targetpay',
			'meta_key'    => '_pronamic_gateway_targetpay_layoutcode',
			'title'       => __( 'Layout Code', 'pronamic_ideal' ),
			'type'        => 'text',
			'tooltip'     => __( 'Layout code as mentioned at <strong>Sub accounts</strong> in the TargetPay dashboard.', 'pronamic_ideal' ),
		);

		// Transaction feedback
		$fields[] = array(
			'section'     => 'targetpay',
			'title'       => __( 'Transaction feedback', 'pronamic_ideal' ),
			'type'        => 'description',
			'html'        => sprintf(
				'<span class="dashicons dashicons-yes"></span> %s',
				__( 'Payment status updates will be processed without any additional configuration.', 'pronamic_ideal' )
			),
		);

		return $fields;
	}
}
