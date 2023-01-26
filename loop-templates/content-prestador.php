<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php 

		// $link = false;
		$link = get_the_permalink();


		$resumen = '<div>';

			$resumen .= get_datos_prestador_card();

		$resumen .= '</div>';

		// $resumen .= '<div class="justify-self-end">';

		//     $resumen .= '<hr>';

		//     $resumen .= '<a class="d-block mt-1 font-weight-bold" href="' . get_the_permalink() . '" title="' . get_the_title() . '">' . __( 'Ver datos de contacto', 'aessia' ) . '</a>';

		// $resumen .= '</div>';

	?>

	<?php echo get_tarjeta( get_the_title(), $resumen, $link, false, false, get_the_ID() ); ?>

</article><!-- #post-## -->
