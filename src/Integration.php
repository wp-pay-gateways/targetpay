<?php

namespace Pronamic\WordPress\Pay\Gateways\TargetPay;

use Pronamic\WordPress\Pay\AbstractGatewayIntegration;

/**
 * Title: TargetPay integration
 * Description:
 * Copyright: 2005-2021 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.2.0
 * @since   1.0.0
 */
class Integration extends AbstractGatewayIntegration {
	/**
	 * Construct TargetPay integration.
	 *
	 * @param array $args Arguments.
	 */
	public function __construct( $args = array() ) {
		$args = wp_parse_args(
			$args,
			array(
				'id'            => 'targetpay-ideal',
				'name'          => 'TargetPay - iDEAL',
				'product_url'   => \__( 'https://www.targetpay.com/info/ideal?setlang=en', 'pronamic_ideal' ),
				'dashboard_url' => 'https://www.targetpay.com/login',
				'provider'      => 'targetpay',
				'manual_url'    => \__( 'https://www.pronamic.eu/support/how-to-connect-targetpay-with-wordpress-via-pronamic-pay/', 'pronamic_ideal' ),
				'deprecated'    => true,
			)
		);

		parent::__construct( $args );
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
			'section' => 'general',
			'type'    => 'html',
			'html'    => sprintf(
				/* translators: 1: payment provider name */
				__( 'Account details are provided by %1$s after registration. These settings need to match with the %1$s dashboard.', 'pronamic_ideal' ),
				__( 'TargetPay', 'pronamic_ideal' )
			),
		);

		// Layout Code.
		$fields[] = array(
			'section'  => 'general',
			'filter'   => FILTER_SANITIZE_STRING,
			'meta_key' => '_pronamic_gateway_targetpay_layoutcode',
			'title'    => __( 'Layout Code', 'pronamic_ideal' ),
			'type'     => 'text',
			'tooltip'  => __( 'Layout code as mentioned at <strong>Sub accounts</strong> in the TargetPay dashboard.', 'pronamic_ideal' ),
		);

		return $fields;
	}

	public function get_config( $post_id ) {
		$config = new Config();

		$config->layoutcode = get_post_meta( $post_id, '_pronamic_gateway_targetpay_layoutcode', true );
		$config->mode       = get_post_meta( $post_id, '_pronamic_gateway_mode', true );

		return $config;
	}

	/**
	 * Get gateway.
	 *
	 * @param int $post_id Post ID.
	 * @return Gateway
	 */
	public function get_gateway( $post_id ) {
		return new Gateway( $this->get_config( $post_id ) );
	}
}
