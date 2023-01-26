<?php
/**
 * Theme basic setup.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

add_action( 'after_setup_theme', 'understrap_setup' );

if ( ! function_exists ( 'understrap_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function understrap_setup() {

	    add_theme_support( 'align-full' );
	    add_theme_support( 'align-wide' );
	    
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on understrap, use a find and replace
		 * to change 'understrap' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'understrap', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'understrap' ),
			'mega_menu' => __( 'Mega Menu', 'understrap' ),
	        'legal' => __( 'Páginas legales', 'sumun-admin' ),
	        // 'account'  => __( 'Páginas de usuario', 'sumun-admin' ),
	        // 'movil'  => __( 'Menú móvil', 'sumun-admin' ),
		) );


		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Adding Thumbnail basic support
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Adding support for Widget edit icons in customizer
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'understrap_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Set up the WordPress Theme logo feature.
		add_theme_support( 'custom-logo' );
		
		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Check and setup theme default settings.
		understrap_setup_theme_default_settings();

	}
}

add_filter( 'the_content_more_link', 'aessia_content_more_link', 10, 2 );
function aessia_content_more_link ( $more_link_element, $more_link_text ) {
	return false;
}

add_filter( 'excerpt_more', 'understrap_custom_excerpt_more' );

if ( ! function_exists( 'understrap_custom_excerpt_more' ) ) {
	/**
	 * Removes the ... from the excerpt read more link
	 *
	 * @param string $more The excerpt.
	 *
	 * @return string
	 */
	function understrap_custom_excerpt_more( $more ) {
		if ( ! is_admin() ) {
			$more = '';
		}
		return $more;
	}
}

add_filter( 'wp_trim_excerpt', 'understrap_all_excerpts_get_more_link' );

if ( ! function_exists( 'understrap_all_excerpts_get_more_link' ) ) {
	/**
	 * Adds a custom read more link to all excerpts, manually or automatically generated
	 *
	 * @param string $post_excerpt Posts's excerpt.
	 *
	 * @return string
	 */
	function understrap_all_excerpts_get_more_link( $post_excerpt ) {
		if ( ! is_admin() ) {
			$post_excerpt = $post_excerpt;

			// $post_excerpt = '<p><a class="btn btn-secondary understrap-read-more-link" href="' . esc_url( get_permalink( get_the_ID() ) ) . '">' . __( 'Read More...',
			// 'understrap' ) . '</a></p>';
		}
		return $post_excerpt;
	}
}

function custom_excerpt_length( $length ) {
     return 25;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function prefix_category_title( $title ) {

 	if ( is_post_type_archive( 'funcionalidad' ) ) {

 		$post_type = get_post_type();
		$pto = get_post_type_object( $post_type );

		$title = '<p><img src="'.get_stylesheet_directory_uri().'/img/pegasso-neg-logo.svg" alt="'.__( 'Pegasso', 'aessia' ).'" class="logo-pegasso-breadcrumb" /></p>' . post_type_archive_title( '', false );
		// $title .= $pto->labels->name;

 		// if ( is_tax() ) {
 		// 	$title .= '<span clss="breacrumb-separator"> > </span><span>' . single_term_title( '', false ) . '</span>';
 		// }


	} elseif ( is_tax() || is_category() || is_tag() ) {
    	$title = '';
    	if ( is_post_type_archive() ) {
    				global $wp_query;
					// echo '<pre>'; print_r($wp_query); echo '</pre>';
    		// $pto = get_post_type_object( get_post_type() );
    		$pto = get_post_type_object( $wp_query->query['post_type'] );

    		$title .= '<span>' . $pto->labels->name . '</span> <span class="breadcrumb-separator">></span> ';
    	}
        $title .= '<span>' . single_term_title( '', false ) . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'prefix_category_title' );

function aessia_archive_description( $description ) {
    if ( is_tax() || is_category() || is_tag() ) {

    	if ( !$description && is_post_type_archive() ) {
    		$custom_description = get_theme_mod( get_post_type() . '-descripcion', false );
    		if ( $custom_description ) return $custom_description;
    	}

    } elseif ( is_post_type_archive() ) {
		$custom_description = get_theme_mod( get_post_type() . '-descripcion', false );
		if ( $custom_description ) return $custom_description;
    }

    return $description;
}
add_filter( 'get_the_archive_description', 'aessia_archive_description' );

add_action( 'pre_get_posts', 'sumun_pre_get_posts' );
function sumun_pre_get_posts($query) {
    if (!$query->is_main_query() || is_admin() ) return;

    // $query->set('posts_per_page', 12);

    if ( is_search() ) {
        $query->set('posts_per_page', 18);
    }

    if ( is_post_type_archive( 'prestador' ) ) {
    	$query->set('posts_per_page', 24);
    	$query->set('orderby', 'title');
    	$query->set('order', 'ASC');
    }

    if ( is_post_type_archive( 'tv' ) ) {
    	$query->set( 'tax_query', array(
	        array(
	            'taxonomy' => 'categoria-tv',
	            'terms' => array( TERM_ID_PROGRAMAS_TV ),
	            'operator' => 'NOT IN'
	        )
	    ) );
    }
}

add_action( 'loop_start', 'aessia_loop_start', 10 );
function aessia_loop_start() {

	if ( is_post_type_archive( 'funcionalidad' ) ) return;

	if ( is_archive() || is_home() || is_search() ) {
		echo '<div class="row">';
	}
}

add_action( 'loop_end', 'aessia_loop_end', 10 );
function aessia_loop_end() {

	if ( is_post_type_archive( 'funcionalidad' ) ) return;

	if ( is_archive() || is_home() || is_search() ) {
		echo '</div>';
	}
}

add_filter( 'post_class', 'aessia_columns_post_class', 10, 3 );
function aessia_columns_post_class( $classes, $class, $post_id ) {

	if ( is_post_type_archive( 'funcionalidad' ) ) return $classes;

	if ( is_archive() || is_home() || is_search() ) {
		$classes[] = 'col-xs-6 col-md-4 mb-2';
	}

	return $classes;
}