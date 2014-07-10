<?php
require_once __DIR__ . '/vendor/autoload.php';

define('BLANK', BLANK); //

/**
 * Return current theme URI
 *
 * @param $uri
 * @return string
 */
function src($uri) {
	return get_stylesheet_directory_uri() . '/' . $uri;
}

/**
 * Output Javascript data
 *
 * @param $name
 * @param string $data
 */
function jsData($name, $data = null) {
	echo "<script type=\"text/javascript\">/* <![CDATA[ */ var $name = " . json_encode($data) . ";/* ]]> */</script>";
}


$blank = new \blank\Theme();
