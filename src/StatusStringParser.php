<?php

/**
 * Title: Status string parser
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_TargetPay_StatusStringParser {
	/**
	 * Token used by TargetPay to separate some values
	 *
	 * @var string
	 */
	const TOKEN = ' |';

	//////////////////////////////////////////////////

	/**
	 * Parse an TargetPay status string to an object
	 *
	 * @param string $string an TargetPay status string
	 * @return stdClass
	 */
	public static function parse( $string ) {
		$status = new Pronamic_WP_Pay_Gateways_TargetPay_Status();

		$position_space = strpos( $string, ' ' );
		$position_pipe  = strpos( $string, '|' );

		if ( false !== $position_space ) {
			/*
			 * @see https://www.targetpay.com/info/ideal-docu
			 *
			 * If the payment is valid the following response will be returned:
			 * 000000 OK
			 *
			 * If the payment is not valid (yet) the following response will be returned:
			 * TP0010 Transaction has not been completed, try again later
			 * TP0011 Transaction has been cancelled
			 * TP0012 Transaction has expired (max. 10 minutes)
			 * TP0013 The transaction could not be processed
			 * TP0014 Already used
			 *
			 * TP0020 Layoutcode not entered
			 * TP0021 Tansaction ID not entered
			 * TP0022 No transaction found with this ID
			 * TP0023 Layoutcode does not match this transaction
			 */
			$status->code = substr( $string, 0, $position_space );

			$position_description = $position_space + 1;
			if ( false !== $position_pipe ) {
				$length = $position_pipe - $position_description;

				$status->description = substr( $string, $position_description, $length );
			} else {
				$status->description = substr( $string, $position_description );
			}

			if ( false !== $position_pipe ) {
				$extra = substr( $string, $position_pipe + 1 );

				/*
				 * @see https://www.targetpay.com/info/directdebit-docu
				 *
				 * The response of the ideal/check call will be:
				 * 00000 OK|accountnumber|accountname|accountcity
				 * You may use accountnumber and accountname as input for the cbank and cname parameters
				 */
				$status->account_number = strtok( $extra, self::TOKEN );
				$status->account_name   = strtok( self::TOKEN );
				$status->account_city   = strtok( self::TOKEN );
			}
		}

		return $status;
	}
}
