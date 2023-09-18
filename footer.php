<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php if ( is_active_sidebar( 'prefooter' ) ) : ?>

	<!-- ******************* The Footer Full-width Widget Area ******************* -->

	<div id="wrapper-prefooter">

		<div class="<?php echo esc_attr( $container ); ?>" id="prefooter-content" tabindex="-1">

			<div class="row">

				<?php dynamic_sidebar( 'prefooter' ); ?>

			</div>

		</div>

	</div><!-- #wrapper-footer-full -->

<?php endif; ?>


<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<?php 
	$asociados = get_carrusel_logos( array() );
	if ( $asociados ) {
		echo '<div class="container">';
			echo $asociados;
		echo '</div>';
	}
?>

<?php if ( is_active_sidebar( 'precopyright-left' ) || is_active_sidebar( 'precopyright-right' ) ) { ?>

	<div class="wrapper" id="wrapper-precopyright">

		<div class="container">

			<div class="row">

				<div class="col-md-8 precopyright-left">

					<?php dynamic_sidebar( 'precopyright-left' ); ?>

				</div>

				<div class="col-md-4 precopyright-right">

					<?php dynamic_sidebar( 'precopyright-right' ); ?>

				</div>

			</div>

		</div>

	</div>

<?php } ?>

<div class="wrapper bg-dark text-white navbar-dark" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">

		<footer class="site-footer" id="colophon">

			<div class="site-info">

				<?php
				echo '<div class="row">';

					echo '<div class="col-md-3">';

						if (is_active_sidebar( 'copyright-contacto' )) {

					            dynamic_sidebar( 'copyright-contacto' );

					    } else {

							echo get_redes_sociales();

					    }

			        echo '</div>';
	
					echo '<div class="col-md-9">';
					
					    if (is_active_sidebar( 'copyright' )) {
					        echo '<div class="row">';
					            dynamic_sidebar( 'copyright' );
					        echo '</div>';
					    } else {
					    	//echo get_bloginfo( 'name' ) . ' © ' . date('Y');
					    }


						echo '<nav class="navbar-expand">';

							wp_nav_menu(
								array(
									'theme_location'  => 'legal',
									'container_class' => 'collapse navbar-collapse',
									'container_id'    => 'navbarLegal',
									'menu_class'      => 'navbar-nav flex-wrap mx-auto mr-md-0',
									'fallback_cb'     => '',
									'menu_id'         => 'legal-menu',
									'depth'           => 1,
									'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
								)
							);


				        echo '</nav>';

			        echo '</div>';

		        echo '</div>';
		        ?>

			</div><!-- .site-info -->

		</footer><!-- #colophon -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

