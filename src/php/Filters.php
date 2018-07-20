<?php

namespace Filters;

function nofollow($html, $skip = null) {
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
