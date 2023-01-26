<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
$post_type = get_post_type();
?>

<div class="wrapper" id="archive-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<?php if ( is_post_type_archive( 'tutorial' ) ) {

			the_archive_title( '<h1 class="entry-title sin-borde"><img src="'.get_stylesheet_directory_uri().'/img/pegasso-logo.svg" alt="'.__( 'Pegasso', 'aessia' ).'" class="logo-pegasso-breadcrumb" /><span clss="breacrumb-separator"> > </span>', '</h1>' );

		} ?>

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php get_template_part( 'global-templates/filtros' ); ?>

				<?php if ( have_posts() ) : ?>

					<?php aessia_mostrar_webinar_destacado(); ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						if ( 'tutorial' == $post_type ) {
							get_template_part( 'loop-templates/content', 'card' );
						} elseif ( 'post' == $post_type ) {
							get_template_part( 'loop-templates/content', get_post_format() );
						} else {
							get_template_part( 'loop-templates/content', $post_type );
						}
						?>

					<?php endwhile; ?>

				<?php else : ?>

					<?php get_template_part( 'loop-templates/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php understrap_pagination(); ?>

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div> <!-- .row -->

	</div><!-- #content -->

	</div><!-- #archive-wrapper -->

<?php get_footer(); ?>
