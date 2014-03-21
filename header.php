<!DOCTYPE html <? language_attributes(); ?>>
<head>
	<meta charset="<? bloginfo('charset'); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><? wp_title('|', true, 'right'); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11"/>
	<link rel="pingback" href="<? bloginfo('pingback_url') ?>"/>
	<link rel="shortcut icon" href="<?= uri('favicon.ico') ?>"/>
	<link rel="author" href="<?= uri('humans.txt') ?>"/>
	<link rel="apple-touch-icon" href="<?= uri('img/touch/touch-icon-iphone.png"') ?>"/>
	<link rel="apple-touch-icon" sizes="72x72" href="<?= uri('img/touch/apple-touch-icon-ipad.png') ?>"/>
	<link rel="apple-touch-icon" sizes="114x114" href="<?= uri('img/touch/touch-icon-iphone-retina.png') ?>"/>
	<link rel="apple-touch-icon" sizes="144x144" href="<?= uri('img/touch/touch-icon-ipad-retina.png') ?>"/>
	<link rel="apple-touch-icon" sizes="512x512" href="<?= uri('img/touch/apple-touch-icon-itunes.png') ?>"/>
	<meta name="apple-mobile-web-app-title" content="<?= get_bloginfo('name') ?>"/>
	<meta name="application-name" content="<?= get_bloginfo('name') ?>"/>
	<? wp_head(); ?>
</head>

<body <? body_class(); ?>>
<div id="page">
	<header id="masthead" class="site-header" role="banner">
		<div class="container center">

			<nav role="navigation" class="site-navigation main-navigation">
				<? wp_nav_menu(array('theme_location' => 'primary')); ?>
			</nav>
		</div>
		<div class="center">

			<div id="brand">
				<h1 class="site-title">
					<a href="<? echo esc_url(home_url('/')) ?>"
					   title="<? echo esc_attr(get_bloginfo('name', 'display')); ?>"
					   rel="home"><? bloginfo('name'); ?></a>
				</h1>
				<h4 class="site-description">
					<? bloginfo('description'); ?>
				</h4>
			</div>

			<div class="clear"></div>
		</div>

	</header>

	<div class="main-fluid">