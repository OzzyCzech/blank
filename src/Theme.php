<?php
namespace blank;
/**
 * @author Roman Ozana <ozana@omdesign.cz>
 */
class Theme {

	/** @var null */
	public static $version = null;

	public function __construct() {

		register_nav_menus(
			[
				'primary' => __('Primary Menu', BLANK),
			]
		);

		load_theme_textdomain(BLANK, get_template_directory() . '/languages');

		add_action('widgets_init', [$this, 'widgets_init']);
		add_action('wp_enqueue_scripts', [$this, 'wp_enqueue_scripts']);
		add_action('after_switch_theme', [$this, 'after_switch_theme']);
		add_action('init', [$this, 'init']);
		add_action('template_include', [$this, 'template_include']);
		add_action('body_class', [$this, 'body_class']);
		add_theme_support('automatic-feed-links');
	}


	public function init() {
		add_editor_style('editor.css');
	}


	public function wp_enqueue_scripts() {
		wp_enqueue_style('style', src('style.css'), static::$version, 'all');
		//wp_enqueue_script('main', src('js/main.min.js'), ['jquery'], static::$version, true);

		if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
	}

	public function widgets_init() {
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

	public function after_switch_theme() {
		flush_rewrite_rules();
	}

	/**
	 * Split homepage to archive.php and home.php
	 *
	 * @param $template
	 * @return string
	 */
	public function template_include($template) {
		if (is_home() && is_paged()) {
			return get_template_directory() . '/index.php';
		}
		return $template;
	}


	/**
	 * Add more classes to bodyclass
	 *
	 * @param $classes
	 * @return array
	 */
	public function body_class($classes) {
		global $post;
		if (isset($post)) {
			$classes[] = $post->post_type . '-' . $post->post_name;
			$classes[] = $post->post_name;
		}
		return $classes;
	}

}
