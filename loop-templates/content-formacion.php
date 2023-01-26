<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$areas_formativas = get_the_term_list( get_the_ID(), 'area-formativa', '', ' · ', '' );
$areas_formativas = strip_tags( $areas_formativas );

$tipo_formacion = get_the_term_list( get_the_ID(), 'tipo-formacion', '', ' · ', '' );
$sticker = strip_tags( $tipo_formacion );


$extracto = aessia_get_resumen_datos_formacion();

// echo $extracto;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php echo get_tarjeta( get_the_title(), $extracto, get_the_permalink(), get_post_thumbnail_id(), false, false, $areas_formativas, $sticker ); ?>

</article><!-- #post-## -->
