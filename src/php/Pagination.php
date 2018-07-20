<?php

namespace Pagination;

/**
 * @param null $query
 * @param string $args
 * @return string
 */
function show($query = null, $args = '') {
	global $wp_query;
	$query = $query ? $query : $wp_query;

	if ($query->max_num_pages <= 1 || is_single()) return;

	$defaults = [
		'base' => str_replace('91919', '%#%', get_pagenum_link(91919)),
		'format' => '?page=%#%',
		'total' => ceil($query->found_posts / get_query_var('posts_per_page')),
		'current' => max(1, get_query_var('paged')),
		'show_all' => false,
		'prev_next' => true,
		'prev_text' => '&laquo;',
		'next_text' => '&raquo;',
		'end_size' => 1,
		'mid_size' => 2,
		'add_args' => false, // array of query args to add
		'add_fragment' => '',
		'before_page_number' => '',
		'after_page_number' => '',
		'before_pagination' => '<div class="pagination-wrapper text-center">',
		'after_pagination' => '</div>',
		'pagination_class' => 'pagination',
	];

	$args = wp_parse_args($args, $defaults);
	extract($args, EXTR_SKIP);
	// Who knows what else people pass in $args
	$total = (int)$total;
	if ($total < 2) return;
	$current = (int)$current;
	$end_size = 0 < (int)$end_size ? (int)$end_size : 1; // Out of bounds?  Make it the default.
	$mid_size = 0 <= (int)$mid_size ? (int)$mid_size : 2;
	$add_args = is_array($add_args) ? $add_args : false;
	$r = '';
	$page_links = [];
	$n = 0;
	$dots = false;

	if ($prev_next && $current && 1 < $current) {
		$link = str_replace('%_%', 2 == $current ? '' : $format, $base);
		$link = str_replace('%#%', $current - 1, $link);
		if ($add_args)
			$link = add_query_arg($add_args, $link);
		$link .= $add_fragment;

		/**
		 * Filter the paginated links for the given archive pages.
		 *
		 * @since 3.0.0
		 *
		 * @param string $link The paginated link URL.
		 */
		$page_links[] = '<li><a href="' . esc_url(
				apply_filters('paginate_links', $link)
			) . '">' . $prev_text . '</a></li>';
	}

	for ($n = 1; $n <= $total; $n++) :
		if ($n == $current) :
			$page_links[] = "<li class=\"active\"><a href=\"#\">" . $before_page_number . number_format_i18n(
					$n
				) . $after_page_number . "</a></li>";
			$dots = true;
		else :
			if ($show_all || ($n <= $end_size || ($current && $n >= $current - $mid_size && $n <= $current + $mid_size) || $n > $total - $end_size)) :
				$link = str_replace('%_%', 1 == $n ? '' : $format, $base);
				$link = str_replace('%#%', $n, $link);
				if ($add_args)
					$link = add_query_arg($add_args, $link);
				$link .= $add_fragment;

				$page_links[] = "<li><a href='" . esc_url(
						apply_filters('paginate_links', $link)
					) . "'>" . $before_page_number . number_format_i18n($n) . $after_page_number . "</a></li>";
				$dots = true;
			elseif ($dots && !$show_all) :
				$page_links[] = '<li class="disabled dots"><a href="#">' . __('&hellip;') . '</a></li>';
				$dots = false;
			endif;
		endif;
	endfor;
	if ($prev_next && $current && ($current < $total || -1 == $total)) :
		$link = str_replace('%_%', $format, $base);
		$link = str_replace('%#%', $current + 1, $link);
		if ($add_args)
			$link = add_query_arg($add_args, $link);
		$link .= $add_fragment;

		/** This filter is documented in wp-includes/general-template.php */
		$page_links[] = '<li><a class="next page-numbers" href="' . esc_url(
				apply_filters('paginate_links', $link)
			) . '">' . $next_text . '</a></li>';
	endif;

	$r .= "$before_pagination<ul class='$pagination_class'>";
	$r .= join(PHP_EOL, $page_links);
	$r .= "</ul>$after_pagination";
	return $r;
}

