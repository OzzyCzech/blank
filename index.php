<? get_header(); ?>

	<div class="container">


		<? if (have_posts()) : ?>


			<div class="articles">
				<? while (have_posts()) : the_post(); ?>
					<? get_template_part('content', get_post_format()); ?>
				<? endwhile; ?>
			</div>

			<?= \blank\Pagination::show() ?>

		<? else : ?>
			<? get_template_part('content', 'none'); ?>
		<? endif; ?>
	</div>
<? get_footer(); ?>