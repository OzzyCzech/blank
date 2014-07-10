<?php
namespace blank\helpers;

/**
 * @author Roman Ožana <ozana@omdesign.cz>
 */
class Filters {

	/**
	 * Add nofollow to HTML links
	 *
	 * @param $html
	 * @param null|string $skip
	 * @return mixed
	 */
	public static function nofollow($html, $skip = null) {
		return preg_replace_callback(
			"#(<a[^>]+?)>#is", function ($mach) use ($skip) {
				return (
					!($skip && strpos($mach[1], $skip) !== false) &&
					strpos($mach[1], 'rel=') === false
				) ? $mach[1] . ' rel="nofollow">' : $mach[0];
			},
			$html
		);
	}
} 