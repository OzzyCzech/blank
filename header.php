<!DOCTYPE html <? language_attributes(); ?>>
<head>
	<meta charset="<? bloginfo('charset'); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><? wp_title('|', true, 'right'); ?></title>
	<link rel="pingback" href="<? bloginfo('pingback_url') ?>"/>
	<link rel="author" href="<?= src('humans.txt') ?>"/>

	<link rel="shortcut icon" href="<?= src('img/favicon.ico') ?>" type="image/x-icon"/>
	<link rel="apple-touch-icon" href="<?= src('img/touch/apple-touch-icon.png') ?>"/>
	<link rel="apple-touch-icon" sizes="57x57" href="<?= src('img/touch/apple-touch-icon-57x57.png') ?>"/>
	<link rel="apple-touch-icon" sizes="72x72" href="<?= src('img/touch/apple-touch-icon-72x72.png') ?>"/>
	<link rel="apple-touch-icon" sizes="76x76" href="<?= src('img/touch/apple-touch-icon-76x76.png') ?>"/>
	<link rel="apple-touch-icon" sizes="114x114" href="<?= src('img/touch/apple-touch-icon-114x114.png') ?>"/>
	<link rel="apple-touch-icon" sizes="120x120" href="<?= src('img/touch/apple-touch-icon-120x120.png') ?>"/>
	<link rel="apple-touch-icon" sizes="144x144" href="<?= src('img/touch/apple-touch-icon-144x144.png') ?>"/>
	<link rel="apple-touch-icon" sizes="152x152" href="<?= src('img/touch/apple-touch-icon-152x152.png') ?>"/>

	<meta name="apple-mobile-web-app-title" content="<?= get_bloginfo('name') ?>"/>
	<meta name="application-name" content="<?= get_bloginfo('name') ?>"/>

	<? wp_head(); ?>
</head>

<body <? body_class(); ?>>
<header class="main">
	<div class="container">

		<h1 class="site-title">
			<a href="<? echo esc_url(home_url('/')) ?>"
			   title="<? echo esc_attr(get_bloginfo('name', 'display')); ?>"
			   rel="home"><? bloginfo('name'); ?></a>
		</h1>

		<h4 class="site-description"><? bloginfo('description'); ?></h4>

		<nav role="navigation" class="site-navigation main-navigation">
			<? wp_nav_menu(array('theme_location' => 'primary')); ?>
		</nav>

	</div>
</header>
