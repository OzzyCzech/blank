<? get_header(); ?>
<div id="primary" class="row-fluid">
	<div id="content" role="main" class="span8 offset2">
		<?
		if (have_posts()) :?>

			<? while (have_posts()) : the_post(); ?>

				<article class="post">

					<h1 class="title"><? the_title(); ?></h1>

					<div class="post-meta">  <? the_time('m.d.Y'); ?> <? the_author(); ?></div>

					<div class="the-content">
						<? the_content(); ?>
						<? wp_link_pages(); ?>
					</div>

					<div class="meta clearfix">
						<div class="category"><?= get_the_category_list(); ?></div>
						<div class="tags"><?= get_the_tag_list('| &nbsp;', '&nbsp;') ?></div>
					</div>

				</article>

			<? endwhile; ?>

			<?
			if (comments_open() || '0' != get_comments_number())
				comments_template('', true);
			?>
		<? else : ?>

			<article class="post error">
				<h1 class="404">Nothing has been posted like that yet</h1>
			</article>

		<? endif; ?>

	</div>
</div>
<? get_footer(); ?>
