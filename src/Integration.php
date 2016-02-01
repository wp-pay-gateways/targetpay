<?php

class Pronamic_WP_Pay_Gateways_TargetPay_Integration extends Pronamic_WP_Pay_Gateways_AbstractIntegration {
	public function __construct() {
		$this->id            = 'targetpay-ideal';
		$this->name          = 'TargetPay - iDEAL';
		$this->dashboard_url = 'https://www.targetpay.com/login';
		$this->provider      = 'targetpay';
	}

	public function get_config_factory_class() {
		return 'Pronamic_WP_Pay_Gateways_TargetPay_ConfigFactory';
	}

	public function get_config_class() {
		return 'Pronamic_WP_Pay_Gateways_TargetPay_Config';
	}

	public function get_settings_class() {
		return 'Pronamic_WP_Pay_Gateways_TargetPay_Settings';
	}

	public function get_gateway_class() {
		return 'Pronamic_WP_Pay_Gateways_TargetPay_Gateway';
	}
}
