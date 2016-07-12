<? get_header(); ?>

<? if (have_posts()) : ?>
	<section class="articles">
		<? while (have_posts()) : the_post(); ?>
			<? get_template_part('content', get_post_format()); ?>
		<? endwhile; ?>
	</section>
<? else : ?>
	<? get_template_part('content', 'none'); ?>
<? endif; ?>

<? get_footer(); ?>
