<?php

// translation
define('LD', basename(dirname(__DIR__))); // Language Domain name
register_nav_menus(['primary' => __('Primary Menu', LD),]);
load_theme_textdomain(LD, get_template_directory() . '/languages');

// theme support
add_theme_support('title-tag');
add_theme_support('html5', ['comment-list', 'comment-form', 'search-form', 'gallery', 'caption']);
add_theme_support('automatic-feed-links');
add_theme_support('post-thumbnails');

// actions
add_action('init','\Theme\init');
add_action('wp_head','\Theme\wp_head');
add_action('wp_enqueue_scripts', '\Theme\wp_enqueue_scripts');
add_action('body_class', '\Theme\body_class');
add_action('template_include', '\Theme\template_include');
add_action('widgets_init', '\Theme\widgets_init');
add_action('after_switch_theme', '\flush_rewrite_rules');
