<?php
/**
 * Understrap enqueue scripts
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function understrap_remove_animation_scripts() {
    wp_dequeue_style( 'edsanimate-animo-css' );
    wp_deregister_style( 'edsanimate-animo-css' );
}
// add_action( 'wp_enqueue_scripts', 'understrap_remove_animation_scripts', 20 );

// add_action( 'wp_head', 'aessia_google_fonts', 10 );
function aessia_google_fonts() { ?>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Text:wght@400;700&family=Encode+Sans:wght@400;700;900&display=swap" rel="stylesheet">
<?php }

if ( ! function_exists( 'understrap_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function understrap_scripts() {

	    // wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/js/slick/slick.css' );
	    // wp_enqueue_style( 'slick-theme', get_stylesheet_directory_uri() . '/js/slick/slick-theme.css' );

		$css_version = THEME_AESSIA_VERSION . '.' . filemtime( get_template_directory() . '/css/theme.min.css' );
		// wp_enqueue_style( 'aessia-blocks', get_stylesheet_directory_uri() . '/css/blocks.css', array(), $css_version, 'all' );
		wp_enqueue_style( 'aessia-styles', get_template_directory_uri() . '/css/theme.min.css', array(), $css_version );
		
		wp_enqueue_script( 'aessia-button-double', get_template_directory_uri() . '/js/aessiabuttondouble.js', array(), '1.0.0', true );
		wp_enqueue_script( 'jquery' );

		// wp_register_script( 'qr-code-and-vcard', get_stylesheet_directory_uri() . '/js/QrCode.js', array(), '0.9.2', false );

	    // wp_enqueue_script( 'sticky-sidebar', get_stylesheet_directory_uri() . '/js/jquery.sticky-sidebar.min.js', array(), false, true );
	    wp_enqueue_script( 'slick', get_stylesheet_directory_uri() . '/js/slick/slick.min.js', null, null, true );

		$js_version = THEME_AESSIA_VERSION . '.' . filemtime( get_template_directory() . '/js/theme.min.js' );
		wp_enqueue_script( 'aessia-scripts', get_template_directory_uri() . '/js/theme.min.js', array(), $js_version, true );
	    wp_enqueue_script( 'livebeep', get_stylesheet_directory_uri() . '/js/livebeep.js', null, null, false );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
} // endif function_exists( 'understrap_scripts' ).

add_action( 'wp_enqueue_scripts', 'understrap_scripts' );

/**
 * Gutenberg scripts and styles
 * @link https://www.billerickson.net/wordpress-color-palette-button-styling-gutenberg
 */
function aessia_gutenberg_scripts() {
	wp_enqueue_script( 'aessia-editor', get_stylesheet_directory_uri() . '/js/editor.js', array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-components'/*, 'wp-editor', 'wp-edit-blocks', 'wp-dom-ready', 'wp-edit-post'*/ ), filemtime( get_stylesheet_directory() . '/js/editor.js' ), true );
	wp_enqueue_style(
    'aessia-blocks',
    get_stylesheet_directory_uri() . '/css/blocks.css',
    null,
    filemtime( get_stylesheet_directory() . '/css/blocks.css' ));
}
add_action( 'enqueue_block_editor_assets', 'aessia_gutenberg_scripts' );

