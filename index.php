<? get_header(); ?>
	<div id="primary" class="row-fluid">
		<div id="content" role="main" class="span8 offset2">

			<? if (have_posts()) : ?>

				<? while (have_posts()) : the_post(); ?>

					<article class="post">

						<h1 class="title">
							<a href="<? the_permalink(); ?>" title="<? the_title(); ?>"><? the_title(); ?>
							</a>
						</h1>

						<div class="post-meta"> <? the_time('m/d/Y'); ?> |
							<? if (comments_open()) : ?>
								<span class="comments-link">
									<? comments_popup_link(
										__('Comment', 'break'), __('1 Comment', 'break'), __('% Comments', 'break')
									); ?>
								</span>
							<? endif; ?>

						</div>

						<div class="the-content">
							<? the_content('Continue...'); ?>
							<? wp_link_pages(); ?>
						</div>

						<div class="meta clearfix">
							<div class="category"><?= get_the_category_list(); ?></div>
							<div class="tags"><?= get_the_tag_list('| &nbsp;', '&nbsp;'); ?></div>
						</div>

					</article>

				<? endwhile; ?>


				<div id="pagination" class="clearfix">
					<div class="past-page"><? previous_posts_link('newer'); ?></div>
					<div class="next-page"><? next_posts_link('older'); ?></div>
				</div>


			<? else : ?>

				<article class="post error">
					<h1 class="404">Nothing has been posted like that yet</h1>
				</article>

			<? endif; ?>
		</div>
	</div>
<? get_footer(); ?>