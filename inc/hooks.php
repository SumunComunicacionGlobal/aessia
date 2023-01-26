<?php
/**
 * Custom hooks.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'understrap_site_info' ) ) {
	/**
	 * Add site info hook to WP hook library.
	 */
	function understrap_site_info() {
		do_action( 'understrap_site_info' );
	}
}

if ( ! function_exists( 'understrap_add_site_info' ) ) {
	add_action( 'understrap_site_info', 'understrap_add_site_info' );

	/**
	 * Add site info content.
	 */
	function understrap_add_site_info() {
		
	    if (is_active_sidebar( 'copyright' )) {
	        echo '<div class="row">';
	            dynamic_sidebar( 'copyright' );
	        echo '</div>';
	    }

	}
}

add_filter( 'pts_post_type_filter', 'aessia_modificar_posts_switchables' );
function aessia_modificar_posts_switchables( $args ) {

	$args['menu_icon'] = 'dashicons-nametag';

	return $args;
}