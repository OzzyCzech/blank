<?php
namespace blank\helpers;

/**
 * @author Roman Ožana <ozana@omdesign.cz>
 */
class Mail {

	/**
	 * Email anti-spam protection
	 *
	 * @param $email
	 * @param null $text
	 * @return string
	 */
	public static function mail($email, $text = null) {
		return '<script type="text/javascript">document.write("' .
		addslashes(
			str_rot13(
				'<a href="mailto:' . $email . '" rel="nofollow">' . ($text ? : $email) . '</a>'
			)
		) . '".replace(/[a-zA-Z]/g,function(c){return String.fromCharCode((c<="Z"?90:122)>=(c=c.charCodeAt(0)+13)?c:c-26);}));</script>' .
		'<noscript><span style="unicode-bidi: bidi-override; direction: rtl;">' . strrev($email) . '</span></noscript>';
	}

} 