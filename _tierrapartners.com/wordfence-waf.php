<?php
// Before removing this file, please verify the PHP ini setting `auto_prepend_file` does not point to this.

// This file was the current value of auto_prepend_file during the Wordfence WAF installation (Tue, 07 Nov 2017 21:26:38 +0000)
if (file_exists('/var/www/html/tierrapartners.com/wordfence-waf.php')) {
	include_once '/var/www/html/tierrapartners.com/wordfence-waf.php';
}
if (file_exists('/var/www/html/tierrapartners.com/wp-content/plugins/wordfence/waf/bootstrap.php')) {
	define("WFWAF_LOG_PATH", '/var/www/html/tierrapartners.com/wp-content/wflogs/');
	include_once '/var/www/html/tierrapartners.com/wp-content/plugins/wordfence/waf/bootstrap.php';
}
?>