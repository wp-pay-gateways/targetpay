<?php

namespace Pronamic\WordPress\Pay\Gateways\TargetPay;

use Pronamic\WordPress\Pay\Core\GatewaySettings;

/**
 * Title: TargetPay gateway settings
 * Description:
 * Copyright: Copyright (c) 2005 - 2018
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class Settings extends GatewaySettings {
	/**
	 * Settings constructor.
	 */
	public function __construct() {
		add_filter( 'pronamic_pay_gateway_sections', array( $this, 'sections' ) );
		add_filter( 'pronamic_pay_gateway_fields', array( $this, 'fields' ) );
	}

	/**
	 * Settings sections.
	 *
	 * @param array $sections Settings sections.
	 *
	 * @return array
	 */
	public function sections( array $sections ) {
		// TargetPay.
		$sections['targetpay'] = array(
			'title'       => __( 'TargetPay', 'pronamic_ideal' ),
			'methods'     => array( 'targetpay' ),
			'description' => sprintf(
				/* translators: 1: TargetPay */
				__( 'Account details are provided by %1$s after registration. These settings need to match with the %1$s dashboard.', 'pronamic_ideal' ),
				__( 'TargetPay', 'pronamic_ideal' )
			),
		);

		return $sections;
	}

	/**
	 * Settings fields.
	 *
	 * @param array $fields Settings fields.
	 *
	 * @return array
	 */
	public function fields( array $fields ) {
		// Layout Code.
		$fields[] = array(
			'filter'   => FILTER_SANITIZE_STRING,
			'section'  => 'targetpay',
			'meta_key' => '_pronamic_gateway_targetpay_layoutcode',
			'title'    => __( 'Layout Code', 'pronamic_ideal' ),
			'type'     => 'text',
			'tooltip'  => __( 'Layout code as mentioned at <strong>Sub accounts</strong> in the TargetPay dashboard.', 'pronamic_ideal' ),
		);

		// Transaction feedback.
		$fields[] = array(
			'section' => 'targetpay',
			'title'   => __( 'Transaction feedback', 'pronamic_ideal' ),
			'type'    => 'description',
			'html'    => sprintf(
				'<span class="dashicons dashicons-yes"></span> %s',
				__( 'Payment status updates will be processed without any additional configuration.', 'pronamic_ideal' )
			),
		);

		return $fields;
	}
}
