<?php

namespace Theme;

function src($uri) {
	return get_stylesheet_directory_uri() . '/' . $uri;
}

function init() {
	add_editor_style('editor.css');
}

function body_class($classes) {
	global $post;
	if (isset($post)) {
		$classes[] = $post->post_type . '-' . $post->post_name;
		$classes[] = $post->post_name;
	}
	return $classes;
}

function template_include() {
	function ($template) {
		if (is_home() && is_paged()) {
			return get_template_directory() . '/index.php';
		}
		return $template;
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

function wp_enqueue_scripts() {
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	// Boostrap
	wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css');
	wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js', ['jquery'], '4.1.2', true);
}

function wp_head() {
	if (is_file($index = __DIR__ . '/../dist/index.html')) {
		echo strip_tags(file_get_contents($index), '<script><link>');
	}
}
