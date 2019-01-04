<?php

namespace Pronamic\WordPress\Pay\Gateways\TargetPay;

use Pronamic\WordPress\Pay\Core\GatewayConfigFactory;

/**
 * Title: TargetPay config factory
 * Description:
 * Copyright: 2005-2019 Pronamic
 * Company: Pronamic
 *
 * @author  Remco Tolsma
 * @version 2.0.0
 * @since   1.0.0
 */
class ConfigFactory extends GatewayConfigFactory {
	public function get_config( $post_id ) {
		$config = new Config();

		$config->layoutcode = get_post_meta( $post_id, '_pronamic_gateway_targetpay_layoutcode', true );
		$config->mode       = get_post_meta( $post_id, '_pronamic_gateway_mode', true );

		return $config;
	}
}
