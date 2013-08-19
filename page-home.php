<? get_header(); ?>
	<div id="primary" class="row-fluid">
		<div id="content" role="main" class="span8">
			<? if (have_posts()) : ?>

				<? while (have_posts()) : the_post(); ?>

					<article class="post">

						<? if (!is_front_page()) : ?>
							<h1 class='title'>
								<? the_title(); ?>
							</h1>
						<? endif; ?>

						<div class="the-content">
							<? the_content(); ?>
							<? wp_link_pages(); ?>
						</div>

					</article>

				<? endwhile; ?>

			<? else : ?>

				<article class="post error">
					<h1 class="404">Nothing has been posted like that yet</h1>
				</article>

			<? endif; ?>
		</div>
		<div id="sidebar" role="sidebar" class="span4">
			<? get_sidebar(); ?>
		</div>
	</div>
<? get_footer(); ?>