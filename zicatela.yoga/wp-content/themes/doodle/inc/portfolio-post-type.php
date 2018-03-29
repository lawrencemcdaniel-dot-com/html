<?php
/**
 * Potfolio Post Type Customizations
 * See: https://github.com/devinsays/portfolio-post-type
 *
 * @package doodle
 */

/**
 * Change post type labels and arguments for Portfolio Post Type plugin.
 *
 * @param array $args Existing arguments.
 *
 * @return array Amended arguments.
 */
function doodle_change_portfolio_labels( array $args ) {

    // Disable archive.
    $args['rewrite']     = array( 'slug' => 'portfolio_items' );
    $args['has_archive'] = true;

    // Supports
    $supports = array(
		'title',
		'editor',
		'excerpt',
		'thumbnail',
		'comments',
		'author',
		'custom-fields',
		'revisions',
		'post-formats',
	);
    $args['supports'] = $supports;

    // Don't forget to visit Settings->Permalinks after changing these to flush the rewrite rules.

    return $args;
}
add_filter( 'portfolioposttype_args', 'doodle_change_portfolio_labels' );
