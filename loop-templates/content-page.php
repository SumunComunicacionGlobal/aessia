<?php
/**
 * Partial template for content in page.php
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="entry-content">

		<?php
			if ( is_page_template( 'page-templates/pegasso.php' ) && $post->post_parent != 0 ) {
				the_title( '<div class="h1 title-breadcrumb">' . get_pegasso_title_breadcrumb() . '<h1 class="entry-title">', '</h1></div>' );
			}

		?>

		<?php if ( is_front_page() ) {

			$post_destacado = get_field( 'publicacion_destacada', 'option' );
			$webinar_destacado = get_field( 'webinar_destacado', 'option' );

			if ( $webinar_destacado && $webinar_destacado->post_status == 'publish' ) {

				global $post;
				$post = $webinar_destacado;
				setup_postdata( $post );

				get_template_part( 'loop-templates/content', 'destacado-webinar' );

				wp_reset_postdata();
			
			} elseif ( $post_destacado && $post_destacado->post_status == 'publish' ) {

				global $post;
				$post = $post_destacado;
				setup_postdata( $post );

				get_template_part( 'loop-templates/content', 'destacado' );

				wp_reset_postdata();
			}


		} ?>

		<?php the_content(); ?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
