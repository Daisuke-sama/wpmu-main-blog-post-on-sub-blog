<?php
/*
Plugin Name: WPMU Other Post Blog Renderer
Plugin URI: https://github.com/Daisuke-sama/wpmu-main-blog-post-on-sub-blog
Description: The plugin allows for any sub-blog from the network to load and render a page content from the main blog as it is its
 own and under the requested URI of the sub-blog without 404 error.
Version: 1.0.1
Author: Daisuke-sama
Author URI: https://rpr.by
License: GPL3
Text Domain: main-blog-post
*/

if ( defined( 'WP_ALLOW_MULTISITE' ) && WP_ALLOW_MULTISITE === true ) {
    add_filter( 'the_posts', 'dts_mbp_fill_empty_posts' );
}

/**
 * This is the filter processor, which attempts to reach the post from the main blog if it haven't been found on the
 * sub-blog.
 *
 * @param array $posts Posts that have been already found by the request.
 *
 * @param int $parent_id An id of a blog where to look for posts.
 *
 * @return array
 */
function dts_mbp_fill_empty_posts( array $posts, int $parent_id = 0 ) {
    if ( empty( $posts ) && $parent_id ) {
        $post = dts_mbp_get_main_blog_post( $parent_id );

        if ( null !== $post ) {
            $posts[] = $post;
        }
    }

    return $posts;
}

/**
 * Retrieves post from the main blog if it exists by the requested path.
 *
 * @param int $blog_id An id of a blog where to look for posts.
 *
 * @return null|WP_Post The found post object, or null.
 */
function dts_mbp_get_main_blog_post( $blog_id ) {
    global $wp_query;
    $path = $wp_query->query['pagename'];

    _dts_mbp_switched_on( $blog_id );
    $post = get_page_by_path( $path );
    _dts_mbp_switched_off();

    return $post;
}

/**
 * Retrieving of a post meta from a another blog by id of the blog and similar pagename property of the post.
 *
 * @param int $blog_id A unique identifier of a blog where the data is searched.
 *
 * @return mixed An array of metadata or nothing.
 */
function dts_mbp_get_main_blog_post_meta( $blog_id ) {
    global $wp_query;
    $path = $wp_query->query['pagename'];

    _dts_mbp_switched_on( $blog_id );
    $post = get_page_by_path($path);
    $meta = get_post_meta($post->ID);
    _dts_mbp_switched_off();

    return $meta;
}

/**
 * Switching to another blog.
 *
 * @param int $id The blog id to be switched on.
 */
function _dts_mbp_switched_on( $id ) {
    global $switched;

    switch_to_blog( $id );
}

/**
 * Switching back to the current blog.
 */
function _dts_mbp_switched_off() {
    restore_current_blog();
}