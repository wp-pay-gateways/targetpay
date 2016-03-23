<?php

/**
 * Title: TargetPay integration
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.0.8
 * @since 1.0.0
 */
class Pronamic_WP_Pay_Gateways_TargetPay_Integration extends Pronamic_WP_Pay_Gateways_AbstractIntegration {
	public function __construct() {
		$this->id            = 'targetpay-ideal';
		$this->name          = 'TargetPay - iDEAL';
		$this->product_url   = __( 'https://www.targetpay.com/info/ideal?setlang=en', 'pronamic_ideal' );
		$this->dashboard_url = 'https://www.targetpay.com/login';
		$this->provider      = 'targetpay';
	}

	public function get_config_factory_class() {
		return 'Pronamic_WP_Pay_Gateways_TargetPay_ConfigFactory';
	}

	public function get_settings_class() {
		return 'Pronamic_WP_Pay_Gateways_TargetPay_Settings';
	}

	/**
	 * Get required settings for this integration.
	 *
	 * @see https://github.com/wp-premium/gravityforms/blob/1.9.16/includes/fields/class-gf-field-multiselect.php#L21-L42
	 * @since 1.0.7
	 * @return array
	 */
	public function get_settings() {
		$settings = parent::get_settings();

		$settings[] = 'targetpay';

		return $settings;
	}
}
