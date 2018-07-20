<!DOCTYPE html <? language_attributes(); ?>>
<head>
	<meta charset="<? bloginfo('charset'); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><? wp_title('|', true, 'right'); ?></title>
	<link rel="pingback" href="<? bloginfo('pingback_url') ?>"/>
	<link rel="shortcut icon" href="<?= \Theme\src('img/favicon.ico') ?>" type="image/x-icon"/>
	<link rel="author" href="<?= \Theme\src('humans.txt') ?>"/>
	<meta name="apple-mobile-web-app-title" content="<?= get_bloginfo('name') ?>"/>
	<meta name="application-name" content="<?= get_bloginfo('name') ?>"/>
	<? wp_head(); ?>
</head>

<body <? body_class(); ?>>

<header></header>