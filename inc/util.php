<?php

/**
 * Get the first image from a post
 *
 * @link http://css-tricks.com/snippets/wordpress/get-the-first-image-from-a-post/ Get the first image from a post
 * @return string Image path
 */
function gannet_catch_that_image() {

	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
	$first_img = $matches[1][0];

	return $first_img;
}
