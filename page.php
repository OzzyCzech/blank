<? get_header(); ?>

<? if (have_posts()) : ?>
	<? while (have_posts()) : the_post(); ?>
		<? get_template_part('content', get_post_format()); ?>
	<? endwhile; ?>
	<? if (comments_open() || '0' != get_comments_number()) comments_template('', true); ?>
<? else : ?>
	<? get_template_part('content', 'none'); ?>
<? endif; ?>

<? get_footer(); ?>

