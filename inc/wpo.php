<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function remove_jquery_migrate( $scripts ) {
    if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
        $script = $scripts->registered['jquery'];
        if ( $script->deps ) { 
            // Check whether the script has any dependencies
            $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
        }
    }
}
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );

/* DISABLE SELF PINGBACKS */
function wpo_tweaks_no_self_ping( &$links ) {

$home = get_option( 'home' );

foreach ( $links as $l => $link )

  if ( 0 === strpos( $link, $home ) )

    unset($links[$l]);
}

add_action( 'pre_ping', 'wpo_tweaks_no_self_ping' );

/** REMOVE DASHICONS FROM ADMIN BAR FOR NON LOGGED IN USERS **/
add_action( 'wp_print_styles', function() {
if ( ! is_admin_bar_showing() && ! is_customize_preview() ) {
  wp_deregister_style( 'dashicons' );
}
}, 100);

/** DISABLE REST API **/
add_filter('json_enabled', '__return_false');
add_filter('json_jsonp_enabled', '__return_false');

/** CONTROL HEARTBEAT API **/
function wpo_tweaks_control_heartbeat( $settings ) {
    $settings['interval'] = 60;
    return $settings;
}
add_filter( 'heartbeat_settings', 'wpo_tweaks_control_heartbeat' );

/** REMOVE QUERIES FROM STATIC RESOURCES **/
function wpo_tweaks_remove_script_version( $src ) {
	$parts = explode( '?ver', $src );

	return $parts[0];
}
// add_filter( 'script_loader_src', 'wpo_tweaks_remove_script_version', 15, 1 );
// add_filter( 'style_loader_src', 'wpo_tweaks_remove_script_version', 15, 1 );

/** REMOVE GRAVATAR QUERY STRINGS **/
function wpo_tweaks_avatar_remove_querystring( $url ) {
	$url_parts = explode( '?', $url );
	return $url_parts[0];
}
add_filter( 'get_avatar_url', 'wpo_tweaks_avatar_remove_querystring' );

/** REMOVE CAPITAL P DANGIT **/
remove_filter( 'the_title', 'capital_P_dangit', 11 );
remove_filter( 'the_content', 'capital_P_dangit', 11 );
remove_filter( 'comment_text', 'capital_P_dangit', 31 );

/** DISABLE PDF THUMBNAILS PREVIEW **/
function wpo_tweaks_disable_pdf_previews() {
$fallbacksizes = array();
return $fallbacksizes;
}
// add_filter('fallback_intermediate_image_sizes', 'wpo_tweaks_disable_pdf_previews');

/**
 * Header items cleaning.
 *
 * @return void
 *
 * @since 0.9.2/3
 */
function wpo_tweaks_clean_header() {
	remove_action( 'wp_head', 'wp_generator' ); // REMOVE WORDPRESS GENERATOR VERSION.
	remove_action( 'wp_head', 'wp_resource_hints', 2 ); // REMOVE S.W.ORG DNS-PREFETCH.
	remove_action( 'wp_head', 'wlwmanifest_link' ); // REMOVE wlwmanifest.xml.
	remove_action( 'wp_head', 'rsd_link' ); // REMOVE REALLY SIMPLE DISCOVERY LINK.
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 ); // REMOVE SHORTLINK URL.
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); // REMOVE EMOJI'S STYLES AND SCRIPTS.
	remove_action( 'wp_print_styles', 'print_emoji_styles' ); // REMOVE EMOJI'S STYLES AND SCRIPTS.
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' ); // REMOVE EMOJI'S STYLES AND SCRIPTS.
	remove_action( 'admin_print_styles', 'print_emoji_styles' ); // REMOVE EMOJI'S STYLES AND SCRIPTS.
    remove_action( 'wp_head', 'index_rel_link' ); // REMOVE LINK TO HOME PAGE.
	remove_action( 'wp_head', 'feed_links_extra', 3 ); // REMOVE EVERY EXTRA LINKS TO RSS FEEDS.
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 ); // REMOVE PREV-NEXT LINKS FROM HEADER -NOT FROM POST-.
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // REMOVE PREV-NEXT LINKS.
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // REMOVE RANDOM LINK POST.
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // REMOVE PARENT POST LINK.

	add_filter( 'the_generator', '__return_false' ); // REMOVE GENERATOR NAME FROM RSS FEEDS.
}
add_action( 'after_setup_theme', 'wpo_tweaks_clean_header' );

/** SECURE METHOD FOR DEFER PARSING OF JAVASCRIPT MOVING ALL JS FROM HEADER TO FOOTER **/
function wpo_defer_parsing_of_js($tag, $handle) {
    if (is_admin()){
        return $tag;
    }
    if (strpos($tag, '/wp-includes/js/jquery/jquery')) {
        return $tag;
    }
    if (strpos($tag, 'QrCode')) {
        return $tag;
    }
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 9.') !==false) {
	return $tag;
    }
    else {
        return str_replace(' src',' defer src', $tag);
    }
}
add_filter('script_loader_tag', 'wpo_defer_parsing_of_js',10,2);

function rjs_lwp_contactform_css_js() {
    global $post;
    if( is_a( $post, 'WP_Post' ) && ( has_shortcode( $post->post_content, 'contact-form-7') || has_shortcode( $post->post_content, 'cf7form') ) ) {
        wp_enqueue_script('contact-form-7');
        wp_enqueue_style('contact-form-7');

    } else {
        wp_dequeue_script( 'contact-form-7' );
        wp_dequeue_style( 'contact-form-7' );
    }
}
add_action( 'wp_enqueue_scripts', 'rjs_lwp_contactform_css_js');