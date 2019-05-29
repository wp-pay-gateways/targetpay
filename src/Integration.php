<?php

namespace Pronamic\WordPress\Pay\Gateways\TargetPay;

use Pronamic\WordPress\Pay\Gateways\Common\AbstractIntegration;

/**
 * Title: TargetPay integration
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class Integration extends AbstractIntegration {
	public function __construct() {
		$this->id            = 'targetpay-ideal';
		$this->name          = 'TargetPay - iDEAL';
		$this->product_url   = __( 'https://www.targetpay.com/info/ideal?setlang=en', 'pronamic_ideal' );
		$this->dashboard_url = 'https://www.targetpay.com/login';
		$this->provider      = 'targetpay';
	}

	public function get_config_factory_class() {
		return __NAMESPACE__ . '\ConfigFactory';
	}

	/**
	 * Get settings fields.
	 *
	 * @return array
	 */
	public function get_settings_fields() {
		$fields = array();

		// Intro.
		$fields[] = array(
			'type' => 'html',
			'html' => sprintf(
				/* translators: 1: TargetPay */
				__( 'Account details are provided by %1$s after registration. These settings need to match with the %1$s dashboard.', 'pronamic_ideal' ),
				__( 'TargetPay', 'pronamic_ideal' )
			),
		);

		// Layout Code.
		$fields[] = array(
			'filter'   => FILTER_SANITIZE_STRING,
			'section'  => 'general',
			'meta_key' => '_pronamic_gateway_targetpay_layoutcode',
			'title'    => __( 'Layout Code', 'pronamic_ideal' ),
			'type'     => 'text',
			'tooltip'  => __( 'Layout code as mentioned at <strong>Sub accounts</strong> in the TargetPay dashboard.', 'pronamic_ideal' ),
		);

		return $fields;
	}
}
