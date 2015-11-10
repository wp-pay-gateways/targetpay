<?php

class Pronamic_WP_Pay_Gateways_TargetPay_GatewayIntegration {
	public function __construct() {
		$this->id = 'targetpay-ideal';
	}

	public function get_config_factory_class() {
		return 'Pronamic_WP_Pay_Gateways_TargetPay_ConfigFactory';
	}

	public function get_config_class() {
		return 'Pronamic_WP_Pay_Gateways_TargetPay_Config';
	}

	public function get_gateway_class() {
		return 'Pronamic_WP_Pay_Gateways_TargetPay_Gateway';
	}
}
