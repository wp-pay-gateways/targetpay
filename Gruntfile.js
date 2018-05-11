module.exports = function( grunt ) {
	require( 'load-grunt-tasks' )( grunt );

	// Project configuration.
	grunt.initConfig( {
		// Package
		pkg: grunt.file.readJSON( 'package.json' ),

		// JSHint
		jshint: {
			all: [ 'Gruntfile.js', 'composer.json', 'package.json' ]
		},

		// PHP Code Sniffer
		phpcs: {
			application: {
				src: [
					'**/*.php',
					'!node_modules/**',
					'!vendor/**'
				]
			},
			options: {
				bin: 'vendor/bin/phpcs',
				standard: 'phpcs.xml.dist',
				showSniffCodes: true
			}
		},

		// PHPLint
		phplint: {
			all: [
				'**/*.php',
				'!node_modules/**',
				'!vendor/**'
			]
		},

		// PHP Mess Detector
		phpmd: {
			application: {
				dir: 'src'
			},
			options: {
				bin: 'vendor/bin/phpmd',
				reportFormat: 'xml',
				rulesets: 'phpmd.ruleset.xml'
			}
		},

		// PHP Copy/Paste Detector (PHPCPD)
		phpcpd: {
			application: {
				dir: 'src'
			},
			options: {
				bin: 'vendor/bin/phpcpd'
			}
		},

		// PHPUnit
		phpunit: {
			options: {
				bin: 'vendor/bin/phpunit'
			},
			application: {

			}
		}
	} );

	// Default task(s).
	grunt.registerTask( 'default', [ 'jshint', 'phplint', 'phpmd', 'phpcpd', 'phpcs' ] );
};
