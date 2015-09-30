<?php
// Do not allow this page to be embedded in a frame
header('X-Frame-Options: deny');

// Set some basic header information
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: '.gmdate('D, d M Y H:i:s').'GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

// PHP Settings
mb_internal_encoding('UTF-8');
ini_set('default_socket_timeout', 30);
date_default_timezone_set('Europe/London');

// Set location of class files and automatically require them
function autoload($name) {
	require_once(ROOT.'inc/class.'.strtolower($name).'.php');
}
spl_autoload_register('autoload');
?>
