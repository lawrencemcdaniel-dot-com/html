<?php
// Before removing this file, please verify the PHP ini setting `auto_prepend_file` does not point to this.

// This file was the current value of auto_prepend_file during the Wordfence WAF installation (Sun, 18 Nov 2018 17:12:01 +0000)
if (file_exists('/var/www/html/www.allsteelstructure.com/wordfence-waf.php')) {
	include_once '/var/www/html/www.allsteelstructure.com/wordfence-waf.php';
}
if (file_exists('/var/www/html/www.allsteelstructure.com/wp-content/plugins/wordfence/waf/bootstrap.php')) {
	define("WFWAF_LOG_PATH", '/var/www/html/www.allsteelstructure.com/wp-content/wflogs/');
	include_once '/var/www/html/www.allsteelstructure.com/wp-content/plugins/wordfence/waf/bootstrap.php';
}
?>