<?php
namespace theme {

	// menus
	register_nav_menus(
		[
			'primary' => __('Primary Menu', THEME),
		]
	);

	// translation
	load_theme_textdomain(THEME, get_template_directory() . '/languages');

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

	add_action('init', '\theme\init');
	add_action('widgets_init', '\theme\widgets_init');
	add_action('wp_enqueue_scripts', '\theme\wp_enqueue_scripts');
	add_action('after_switch_theme', '\theme\after_switch_theme');
	add_action('template_include', '\theme\template_include');
	add_action('body_class', '\theme\body_class');
}
