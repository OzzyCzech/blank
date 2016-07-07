<?php

namespace {
	function src($uri) {
		return get_stylesheet_directory_uri() . '/' . $uri;
	}
}

namespace helpers {

	function mail($email, $text = null) {
		return '<script type="text/javascript">document.write("' .
		addslashes(
			str_rot13(
				'<a href="mailto:' . $email . '" rel="nofollow">' . ($text ?: $email) . '</a>'
			)
		) . '".replace(/[a-zA-Z]/g,function(c){return String.fromCharCode((c<="Z"?90:122)>=(c=c.charCodeAt(0)+13)?c:c-26);}));</script>' .
		'<noscript><span style="unicode-bidi: bidi-override; direction: rtl;">' . strrev($email) . '</span></noscript>';
	}

	function phone($number) {
		$number = preg_replace('#[^0-9\+]#', '', $number);
		preg_match('/^(\+[0-9]{3})?([0-9]{3})([0-9]{3})([0-9]{3})$/', $number, $matches);
		array_shift($matches);
		return '<a href="tel://' . $number . '">' . implode(' ', $matches) . '</a>';
	}

	function data($var, $data = null) {
		return '<script type="text/javascript">/* <![CDATA[ */ var $var = ' . json_encode($data) . ';/* ]]> */</script>';
	}
}

namespace filters {
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
}