<? get_header(); ?>

<? if (have_posts()) : ?>

	<div class="articles">
		<? while (have_posts()) : the_post(); ?>
			<? get_template_part('content', get_post_format()); ?>
		<? endwhile; ?>
	</div>

<? else : ?>
	<? get_template_part('content', 'none'); ?>
<? endif; ?>

<? get_footer(); ?>
