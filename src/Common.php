<?php
namespace blank;

/**
 * @author Roman Ožana <ozana@omdesign.cz>
 */
class Common {

	/**
	 * Include jquery from CDN
	 */
	public static function jQueryCDN() {
		add_action(
			'init',
			function () {
				wp_deregister_script('jquery');
				wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false, '1.10.2');
				wp_enqueue_script('jquery');
			}
		);
	}
} 