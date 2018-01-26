<?php
use Pronamic\WordPress\Pay\Core\GatewayConfigFactory;

/**
 * Title: TargetPay config factory
 * Description:
 * Copyright: Copyright (c) 2005 - 2018
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.1.1
 * @since 1.0.0
 */
class Pronamic_WP_Pay_Gateways_TargetPay_ConfigFactory extends GatewayConfigFactory {
	public function get_config( $post_id ) {
		$config = new Pronamic_WP_Pay_Gateways_TargetPay_Config();

		$config->layoutcode = get_post_meta( $post_id, '_pronamic_gateway_targetpay_layoutcode', true );
		$config->mode       = get_post_meta( $post_id, '_pronamic_gateway_mode', true );

		return $config;
	}
}
