<?php
defined( 'ABSPATH' ) or die( 'Cheatin\' uh?' );

define( 'WP_ROCKET_ADVANCED_CACHE', true );
$rocket_cache_path  = '/var/www/html/safestructures.us/wp-content/cache/wp-rocket/';
$rocket_config_path = '/var/www/html/safestructures.us/wp-content/wp-rocket-config/';

if ( file_exists( '/var/www/html/safestructures.us/wp-content/plugins/wp-rocket/inc/front/process.php' ) && file_exists( '/var/www/html/safestructures.us/wp-content/plugins/wp-rocket/vendor/autoload.php' ) && version_compare( phpversion(), '5.4' ) >= 0 ) {
	include '/var/www/html/safestructures.us/wp-content/plugins/wp-rocket/vendor/autoload.php';
	include '/var/www/html/safestructures.us/wp-content/plugins/wp-rocket/inc/front/process.php';
} else {
	define( 'WP_ROCKET_ADVANCED_CACHE_PROBLEM', true );
}
