<?php
namespace blank\helpers;

/**
 * @author Roman Ožana <ozana@omdesign.cz>
 */
class Phone {

	/**
	 * Format phone number
	 *
	 * @param $phone
	 * @return string
	 */
	public static function phone($phone) {
		$phone = preg_replace('#[^0-9\+]#', '', $phone);
		preg_match('/^(\+[0-9]{3})?([0-9]{3})([0-9]{3})([0-9]{3})$/', $phone, $matches);
		array_shift($matches);
		return '<a href="tel://' . $phone . '">' . implode(' ', $matches) . '</a>';
	}
}