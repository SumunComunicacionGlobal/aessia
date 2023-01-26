<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">

		<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>

		<nav class="navbar navbar-expand-md navbar-light bg-white">

		<?php if ( 'container' == $container ) : ?>
			<div class="container">
		<?php endif; ?>

				<!-- Your site title as branding in the menu -->
				<?php if ( ! has_custom_logo() ) { ?>

					<a href="<?php echo get_home_url(); ?>" class="navbar-brand custom-logo-link default-logo" rel="home">
						<img src="<?php echo get_stylesheet_directory_uri() ?>/img/aessia.svg" class="img-fluid" alt="<?php bloginfo('name'); ?>" width="170" height="52">
					</a> 

				<?php } else {
					the_custom_logo();
				} ?><!-- end custom logo -->

				<div class="d-flex align-items-center">

					<button class="navbar-toggler" type="button" data-toggle="modal" data-target="#aessia-buscador-modal" aria-label="<?php esc_attr_e( 'Search' ); ?>">
						<span class="navbar-toggler-icon fa fa-search"></span>
					</button>

					<button class="navbar-toggler" type="button" data-toggle="modal" data-target="#aessia-menu-modal" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
						<span class="navbar-toggler-icon"></span>
					</button>

				</div>

				<!-- The WordPress Menu goes here -->
				<?php wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container_class' => 'collapse navbar-collapse',
						'container_id'    => 'navbarNavDropdown',
						'menu_class'      => 'navbar-nav ml-auto',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'depth'           => 2,
						'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
					)
				); ?>
			<?php if ( 'container' == $container ) : ?>
			</div><!-- .container -->
			<?php endif; ?>

		</nav><!-- .site-navigation -->

	</div><!-- #wrapper-navbar end -->

	<?php if ( !is_front_page() ) {

		if( function_exists( 'bcn_display') ) {
			echo '<div class="breadcrumbs container" typeof="BreadcrumbList" vocab="https://schema.org/">';
				bcn_display(); 
			echo '</div>';
		} elseif ( function_exists( 'rank_math_the_breadcrumbs' ) ) {
			echo '<div class="breadcrumbs container">';
				rank_math_the_breadcrumbs();
			echo '</div>';
		}

	} ?>

	<?php if ( ( !is_page() && is_singular() ) || is_archive() || ( is_home() && !is_front_page() ) ) {

		$antetitulo = false;
		$title = false;
		$excerpt = false;
		$bg_image = false;

		if ( is_singular() && 'tutorial' != $post_type && 'funcionalidad' != $post_type ) {

			get_template_part( 'loop-templates/cabecera', $post_type );

		} elseif ( is_archive() || ( is_home() && !is_front_page() ) ) {

			if ( !is_post_type_archive( 'tutorial' ) ) {

				$title = get_the_archive_title();
				$excerpt = get_the_archive_description();
				$image_id = false;
				$bg_image = false;

				if ( is_tax() || is_category() || is_tag() ) {

					$image_id = get_term_meta( get_queried_object_id(), 'term_image', true );

					global $wp_query;
					if ( !$image_id && isset( $wp_query->query['post_type'] ) ) {
						$image_id = get_theme_mod( $wp_query->query['post_type'] . '-imagen-cabecera', false );
					}

					if( is_tax( array( 'area-formativa', 'tipo-formacion' ) ) ) {

						$antetitulo = get_post_type_object( get_post_type() )->labels->name;
						
					}

				} elseif ( is_post_type_archive() && !$image_id ) {

					$image_id = get_theme_mod( get_post_type() . '-imagen-cabecera', false );

				} elseif ( is_home() && !is_front_page() ) {

					$post = get_post( get_option( 'page_for_posts' ) );
					$title = get_the_title( $post->ID );
					$excerpt = apply_filters( 'the_content', $post->post_content );

				}

				if ( !$image_id ) {

					$image_id = get_theme_mod( 'aessia-imagen-por-defecto');

				}

				if ( $image_id ) {
					$bg_image = wp_get_attachment_image( $image_id, 'large', false, array( 'class' => 'wp-block-cover__image-background' ) );
				}

				echo '<header class="entry-header">';

					echo '<div class="wp-block-cover has-black-background-color has-background-dim alignfull is-style-imagen-cabecera">';

						echo $bg_image;
					
						echo '<div class="wp-block-cover__inner-container">';

							echo '<div class="mw-600">';

								if ( $antetitulo ) echo '<p class="has-antetitulo-font-size">' . $antetitulo . '</p>';

								if ( $title ) echo '<h1 class="entry-title">'.$title.'</h1>';

								if ( $excerpt ) echo $excerpt;

							echo '</div>';

						echo '</div>';

					echo '</div>';

				echo '</header>';

			}

		}

	} ?>