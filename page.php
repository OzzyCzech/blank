<? get_header(); ?>
	<div id="primary" class="row-fluid">
		<div id="content" role="main" class="span8 offset2">

			<? if (have_posts()) : ?>

				<? while (have_posts()) : the_post(); ?>

					<article class="post">

						<h1 class="title"><? the_title(); ?></h1>

						<div class="the-content">
							<? the_content(); ?>

							<? wp_link_pages(); ?>
						</div>

					</article>

				<? endwhile; ?>

			<? else : ?>

				<article class="post error">
					<h1 class="404">Nothing posted yet</h1>
				</article>

			<? endif; ?>

		</div>
	</div>
<? get_footer();?>