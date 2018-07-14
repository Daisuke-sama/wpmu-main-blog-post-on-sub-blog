<?php
/*
Plugin Name: WPMU Other Post Blog Renderer
Plugin URI: https://github.com/Daisuke-sama/wpmu-main-blog-post-on-sub-blog
Description: The plugin allows for any sub-blog from the network to load and render a page content from the main blog as it is its
 own and under the requested URI of the sub-blog without 404 error.
Version: 1.0.0
Author: Daisuke-sama
Author URI: https://rpr.by
License: GPL3
Text Domain: main-blog-post
*/

if (defined('WP_ALLOW_MULTISITE') && WP_ALLOW_MULTISITE === true) {
	add_filter('the_posts', 'dts_mbp_fill_empty_posts');
}

/**
 * This is the filter processor, which attempts to reach the post from the main blog if it haven't been found on the
 * sub-blog.
 *
 * @param array $posts Posts that have been already found by the request.
 *
 * @return array
 */
function dts_mbp_fill_empty_posts(array $posts) {
	if (empty($posts)) {
		$post = dts_mbp_get_main_blog_post();
		if (null !== $post) {
			$posts[] = $post;
		}
	}

	return $posts;
}

/**
 * Retrieves post from the main blog if it exists by the requested path.
 *
 * @return null|WP_Post The found post object, or null.
 */
function dts_mbp_get_main_blog_post() {
	global $switched;
	global $wp_query;

	$path = $wp_query->query['pagename'];

	switch_to_blog(SITE_ID_CURRENT_SITE);
	$post = get_page_by_path($path, OBJECT);
	restore_current_blog();

	return $post;
}