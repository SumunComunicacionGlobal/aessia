<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="entry-content">

		<!-- <div class="aessia-card"> -->
		<div class="row">

			<div class="col-md-8 mb-2">

				<?php echo get_datos_prestador(); ?>

			</div>

			<div class="col-md-4 col-lg-3 mb-2">

				<?php echo get_vcard(); ?>

			</div>

		</div>

		<?php echo get_fields_cards_prestador(); ?>

		<?php echo get_ambitos_prestador(); ?>

		<?php echo get_contenido_relacionado( false, true ); ?>

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

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
