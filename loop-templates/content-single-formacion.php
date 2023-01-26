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

	<div class="row">

	<div class="col-md-4">

		<div class="sticky-top">

			<div class="bg-light p-2 mb-2">

				<?php aessia_datos_formacion(); ?>

			</div>

		</div>

	</div>

		<div class="col-md-8">

			<div class="entry-content">

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

				<?php understrap_entry_footer(); ?>

			</footer><!-- .entry-footer -->

		</div>

	</div>

	<?php if ( is_active_sidebar( 'footer-formacion' ) ) : ?>

		<div class="wp-block-group alignfull bg-light mt-2 mb-0" id="footer-formacion">

			<div class="wp-block-group__inner-container py-2">

				<?php dynamic_sidebar( 'footer-formacion' ); ?>

			</div>

		</div>

	<?php endif; ?>


</article><!-- #post-## -->
