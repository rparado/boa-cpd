<?php
	/**
	 * Tell WordPress to run agm_setup() when the 'after_setup_theme' hook is run.
	 *
	 * @see agm_setup()
	 */
	add_action( 'after_setup_theme', 'agm_setup' );
	/**
	 * Unregister junk hooks in wp_head
	 */
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
	/**
	 * Add hook to initiate Custom Post Types
	 * Set priority to avoid plugin conflicts
	 *
	 * @see titan_register_types_and_taxonomies()
	 */
	add_action('init', 'agm_customPostTypes_and_taxonomies', 1);
?>