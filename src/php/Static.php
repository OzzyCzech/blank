<?php

namespace blank;

/**
 * @author Roman Ožana <roman@ozana.cz>
 */
class StaticPages {

	public function __construct() {
		add_filter('template_include', [$this, 'getTemplate'], 999);

		add_action(
			'template_redirect', function () {
			remove_action('template_redirect', 'wp_redirect_admin_locations', 999);
		}
		);
	}

	public static function addBreadcrumbAfterFirst() {
		$add = func_get_args();
		add_filter(
			'wpseo_breadcrumb_links', function ($links) use ($add) {
			$first = array_shift($links);
			foreach ($add as $item) array_unshift($links, $item);
			array_unshift($links, $first);
			return $links;
		},
			999
		);
	}

	public static function addBreadcrumb() {
		$add = func_get_args();
		add_filter(
			'wpseo_breadcrumb_links', function ($links) use ($add) {
			foreach ($add as $item) $links[] = $item;
			return $links;
		},
			999
		);
	}

	public static function title($title) {
		add_filter(
			'wp_title', function () use ($title) {
			return $title;
		}, 999
		);
	}

	public function getTemplate($template) {
		global $wp_query;

		$url = parse_url('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		$home = parse_url(home_url('/'));
		$request = trim(preg_replace('#^' . preg_quote($home['path']) . '#i', '', $url['path']), '/');

		if (!is_404() || empty($request)) return $template;

		// Loop throuh parts and makes ure they're sane.
		$parts = explode('/', $request);
		foreach ($parts as $part) if (!preg_match('#^[a-z0-9-]+$#i', $part)) return $template;

		// Using stylesheet directory so parent/child themes don't share static pages.
		$name = implode('-', $parts);
		if (is_file($page = get_stylesheet_directory() . '/pages/' . $name . '.php')) {
			$template = $page;

			// We want trailing slashes, this is our last chance for a redirect.
			if (trailingslashit($url['path']) != $url['path']) {
				$url['path'] = trailingslashit($url['path']);
				$redirect = set_url_scheme('http://' . $_SERVER['HTTP_HOST'] . $url['path']);
				if (!empty($url['query']))
					$redirect .= '?' . $url['query'];

				wp_safe_redirect(esc_url_raw($redirect));
				die();
			}

			$wp_query->is_404 = false;
			status_header(200);
			add_filter(
				'body_class', function ($class) use ($name) {
				$class[] = sanitize_title($name);
				return $class;
			}, 999
			);
		}

		return $template;
	}

}
