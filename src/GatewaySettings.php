<?php

/**
 * Title: TargetPay gateway settings
 * Description:
 * Copyright: Copyright (c) 2005 - 2015
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.1.0
 * @since 1.1.0
 */
class Pronamic_WP_Pay_Gateways_TargetPay_GatewaySettings extends Pronamic_WP_Pay_GatewaySettings {
	public function __construct() {
		add_filter( 'pronamic_pay_gateway_sections', array( $this, 'sections' ) );
		add_filter( 'pronamic_pay_gateway_fields', array( $this, 'fields' ) );
	}

	public function sections( array $sections ) {
		// TargetPay
		$sections['targetpay'] = array(
			'title'   => __( 'TargetPay', 'pronamic_ideal' ),
			'methods' => array( 'targetpay' ),
		);

		// Return
		return $sections;
	}

	public function fields( array $fields ) {
		// Layout Code
		$fields[] = array(
			'section'     => 'targetpay',
			'meta_key'    => '_pronamic_gateway_targetpay_layoutcode',
			'title'       => __( 'Layout Code', 'pronamic_ideal' ),
			'type'        => 'text',
			'description' => __( 'De layoutcode waarop de betaling geboekt moet worden. Zie subaccounts.', 'pronamic_ideal' ),
		);

		// Return
		return $fields;
	}
}
