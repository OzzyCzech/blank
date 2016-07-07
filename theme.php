<?php
namespace theme {

	// menus
	register_nav_menus(
		[
			'primary' => __('Primary Menu', THEME),
		]
	);

	// translation
	load_theme_textdomain(theme, get_template_directory() . '/languages');

	// theme support
	add_theme_support('title-tag');
	add_theme_support('html5', ['comment-list', 'comment-form', 'search-form', 'gallery', 'caption']);
	add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails');

	function init() {
		add_editor_style('editor.css');
	}

	function wp_enqueue_scripts() {
		wp_enqueue_style('style', src('style.css'), VERSION, 'all');
		wp_enqueue_script('main', src('js/app.min.js'), [], VERSION, true);

		if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
	}

	function widgets_init() {
		register_sidebar(
			[
				'id' => 'sidebar',
				'name' => 'Sidebar',
				'description' => 'Take it on the side...',
				'before_widget' => '<div>',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="side-title">',
				'after_title' => '</h3>',
				'empty_title' => '',
			]
		);
	}

	function after_switch_theme() {
		flush_rewrite_rules();
	}

	function template_include($template) {
		if (is_home() && is_paged()) {
			return get_template_directory() . '/index.php';
		}
		return $template;
	}

	function body_class($classes) {
		global $post;
		if (isset($post)) {
			$classes[] = $post->post_type . '-' . $post->post_name;
			$classes[] = $post->post_name;
		}
		return $classes;
	}

	add_action('init', 'init');
	add_action('widgets_init', 'widgets_init');
	add_action('wp_enqueue_scripts', 'wp_enqueue_scripts');
	add_action('after_switch_theme', 'after_switch_theme');
	add_action('template_include', 'template_include');
	add_action('body_class', 'body_class');
}

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