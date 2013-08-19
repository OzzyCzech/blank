<?php
namespace blank;
/**
 * @author Roman Ozana <ozana@omdesign.cz>
 */
class Theme {

	public static $js = array('js/main.min.js');
	public static $css = array('style.css');

	public function __construct() {
		add_action('wp_enqueue_scripts', array($this, 'loadScripts'));

		register_nav_menus(
			array('primary' => __('Primary Menu', BLANK),)
		);

		load_theme_textdomain(BLANK, get_template_directory() . '/languages');

		add_theme_support('automatic-feed-links');
		add_action('widgets_init', array($this, 'widgetsInit'));
	}

	public function loadScripts() {
		foreach (static::$css as $css) {
			wp_enqueue_style(
				sanitize_title_with_dashes($css),
				get_template_directory_uri() . '/' . $css, '10000',
				'all'
			);
		}

		foreach (static::$js as $js) {
			wp_enqueue_script(
				sanitize_title_with_dashes($js),
				get_template_directory_uri() . '/' . $js, array(), 55, true
			);
		}
	}

	public function widgetsInit() {
		register_sidebar(
			array(
				'id' => 'sidebar',
				'name' => 'Sidebar',
				'description' => 'Take it on the side...',
				'before_widget' => '<div>',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="side-title">',
				'after_title' => '</h3>',
				'empty_title' => '',
			)
		);
	}
}