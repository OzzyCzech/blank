<?php
require_once __DIR__ . '/vendor/autoload.php';

define('BLANK', BLANK); //

/**
 * Return current theme URI
 *
 * @param $uri
 * @return string
 */
function uri($uri) {
	return get_stylesheet_directory_uri() . '/' . $uri;
}


$blank = new \blank\Theme();
