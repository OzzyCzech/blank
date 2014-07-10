<?php
namespace blank;

/**
 * @author Roman Ozana <ozana@omdesign.cz>
 */
class Highlight {

	public function __construct() {
		add_filter('the_excerpt', [$this, 'highlight']);
		add_filter('the_title', [$this, 'highlight']);
	}

	function highlight($text) {
		if (is_search()) {
			return preg_replace(
				'/(' . str_replace(' ', '|', preg_quote(get_search_query())) . ')/iu',
				'<span class="search-keyword">$1</span>',
				$text
			);
		}

		return $text;
	}

}
