# Change Log

All notable changes to this project will be documented in this file.

This projects adheres to [Semantic Versioning](http://semver.org/) and [Keep a CHANGELOG](http://keepachangelog.com/).

## [Unreleased][unreleased]
-

## [3.0.0] - 2021-08-05
- Updated to `pronamic/wp-pay-core` version `3.0.0`.
- Updated to `pronamic/wp-money` version `2.0.0`.
- Switched to `pronamic/wp-coding-standards`.

## [2.2.0] - 2021-05-28
- Deprecated gateway in favor of DigiWallet.
- Improved error handling.
- Added documentation.

## [2.1.1] - 2021-04-26
- Happy 2021.

## [2.1.0] - 2020-03-19
- Update setting consumer bank details.
- Extend from AbstractGatewayIntegration class.

## [2.0.3] - 2019-12-22
- Added URL to manual in gateway settings.
- Improved error handling with exceptions.
- Updated payment status class name.

## [2.0.2] - 2019-08-28
- Updated packages.

## [2.0.1] - 2018-12-12

- Use issuer field from core gateway.
- Updated deprecated function calls.

## [2.0.0] - 2018-05-11
- Switched to PHP namespaces.

## [1.1.1] - 2017-12-12
- WordPress Coding Standards optimizations.

## [1.1.0] - 2016-10-20
- Added `payment_status_request` feature support.
- Removed schedule status check event, this will be part of the Pronamic iDEAL plugin.

## [1.0.9] - 2016-06-08
- Simplified the gateway payment start function.

## [1.0.8] - 2016-03-23
- Updated gateway settings.
- Added product URL.

## [1.0.7] - 2016-03-02
- Added get settings function.
- Use iDEAL payment method also if none set in issuer field
- WordPress Coding Standards.
- Moved get_gateway_class() function to the configuration class.
- Removed get_config_class(), no longer required.

## [1.0.6] - 2016-02-06
- Improved unit tests.

## [1.0.5] - 2016-02-01
- Added an gateway settings class.

## [1.0.4] - 2015-10-21
- Fixed some issues on the TargetPay library.
- Fixed Strict standards: Declaration of Pronamic_WP_Pay_Gateways_TargetPay_Gateway::start().

## [1.0.3] - 2015-10-14
- Add scheduled transaction status request.

## [1.0.2] - 2015-08-04
- Make sure to use wp-pay/core library for XML filter.

## [1.0.1] - 2015-03-03
- Changed WordPress pay core library requirement from `~1.0.0` to `>=1.0.0`.

## 1.0.0 - 2015-01-19
- First release.

[unreleased]: https://github.com/wp-pay-gateways/targetpay/compare/3.0.0...HEAD
[3.0.0]: https://github.com/wp-pay-gateways/targetpay/compare/2.2.0...3.0.0
[2.2.0]: https://github.com/wp-pay-gateways/targetpay/compare/2.1.1...2.2.0
[2.1.1]: https://github.com/wp-pay-gateways/targetpay/compare/2.1.0...2.1.1
[2.1.0]: https://github.com/wp-pay-gateways/targetpay/compare/2.0.3...2.1.0
[2.0.3]: https://github.com/wp-pay-gateways/targetpay/compare/2.0.2...2.0.3
[2.0.2]: https://github.com/wp-pay-gateways/targetpay/compare/2.0.1...2.0.2
[2.0.1]: https://github.com/wp-pay-gateways/targetpay/compare/2.0.0...2.0.1
[2.0.0]: https://github.com/wp-pay-gateways/targetpay/compare/1.1.1...2.0.0
[1.1.1]: https://github.com/wp-pay-gateways/targetpay/compare/1.1.0...1.1.1
[1.1.0]: https://github.com/wp-pay-gateways/targetpay/compare/1.0.9...1.1.0
[1.0.9]: https://github.com/wp-pay-gateways/targetpay/compare/1.0.8...1.0.9
[1.0.8]: https://github.com/wp-pay-gateways/targetpay/compare/1.0.7...1.0.8
[1.0.7]: https://github.com/wp-pay-gateways/targetpay/compare/1.0.6...1.0.7
[1.0.6]: https://github.com/wp-pay-gateways/targetpay/compare/1.0.5...1.0.6
[1.0.5]: https://github.com/wp-pay-gateways/targetpay/compare/1.0.4...1.0.5
[1.0.4]: https://github.com/wp-pay-gateways/targetpay/compare/1.0.3...1.0.4
[1.0.3]: https://github.com/wp-pay-gateways/targetpay/compare/1.0.2...1.0.3
[1.0.2]: https://github.com/wp-pay-gateways/targetpay/compare/1.0.1...1.0.2
[1.0.1]: https://github.com/wp-pay-gateways/targetpay/compare/1.0.0...1.0.1
