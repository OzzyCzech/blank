<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<article <? post_class(); ?>>
			<header>
				<? if (is_single()) { ?>
					<h1>
						<? the_title(); ?>
					</h1>
				<? } else { ?>
					<h2 class="entry-title">
						<a href="<? the_permalink(); ?>" title="<?= esc_attr(strip_tags(get_the_title())) ?>"
						   rel="bookmark"><? the_title(); ?></a>
					</h2>
				<? } ?>
				<div class="post-meta"><? the_date(); ?></div>

			</header>

			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<? the_content('Continue...'); ?><? wp_link_pages(); ?>

						<footer>
							<?= get_the_category_list(', ') ?>
							<?= get_the_tag_list('', ', ') ?>

							<? if (is_single()) { ?>
								<div class="author">
									<?= get_avatar(get_the_author_meta('ID'), 128); ?><br/>
									<? the_author() ?>
								</div>
							<? } ?>
						</footer>

					</div>
				</div>
			</div>

		</article>
	</div>
</div>