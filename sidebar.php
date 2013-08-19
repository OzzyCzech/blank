<? if (!dynamic_sidebar('sidebar')) : ?>
	<aside id="archives" class="widget">
		<h3 class="side-title"><? _e('Archives', 'blank'); ?></h3>
		<ul>
			<? wp_get_archives(array('type' => 'monthly')); ?>
		</ul>
	</aside>

	<aside id="meta" class="widget">
		<h3 class="side-title"><? _e('Meta', 'blank'); ?></h3>
		<ul>
			<? wp_register(); ?>
			<li><? wp_loginout(); ?></li>
			<? wp_meta(); ?>
		</ul>
	</aside>

<? endif; ?>