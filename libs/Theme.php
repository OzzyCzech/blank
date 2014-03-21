<?php
namespace blank;
/**
 * @author Roman Ozana <ozana@omdesign.cz>
 */
class Theme {

	/** @var null */
	public static $version = null;

	public function __construct() {
		add_action('wp_enqueue_scripts', array($this, 'loadScripts'));

		register_nav_menus(
			array('primary' => __('Primary Menu', BLANK),)
		);

		load_theme_textdomain(BLANK, get_template_directory() . '/languages');

		add_theme_support('automatic-feed-links');
		add_action('widgets_init', array($this, 'widgetsInit'));
		add_action('after_switch_theme', array($this, 'after_switch_theme'));
	}

	public function loadScripts() {
		wp_enqueue_style('style', uri('style.css'), static::$version, 'all');
		wp_enqueue_script('main', uri('js/main.min.js'), ['jquery'], static::$version, true);
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

	public function after_switch_theme() {
		flush_rewrite_rules();
	}

}
