<?php

/**
 * Tarjeta Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'card-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'wp-block-card';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$titulo = get_field('titulo') ?: false;
$resumen = get_field('resumen') ?: false;
$enlace_tipo = get_field('enlace_tipo');
$imagen_id = get_field('imagen');
$target = '_self';

switch ( $enlace_tipo ) {
	case 'post':
		$enlace_post = get_field( 'enlace_post' );
		$enlace = get_the_permalink( $enlace_post );
		$target = '_self';
		if ( !$imagen_id && has_post_thumbnail( $enlace_post ) ) {
			$imagen_id = get_post_thumbnail_id( $enlace_post );
		}
		if ( !$titulo ) $titulo = get_the_title( $enlace_post );
		break;

	case 'term':
		$enlace_term = get_field( 'enlace_term' );
		$enlace = get_term_link( $enlace_term );
		$target = '_self';
		break;

	case 'url':
		$enlace = get_field( 'enlace_url' );
		$target = '_blank';
		break;

	case 'post_type':
		$post_type = get_field( 'post_type' );
		$enlace = get_post_type_archive_link( $post_type );
		if ( !$titulo ) {
			$pto = get_post_type_object( $post_type );
			$titulo = $pto->labels->name;
		}
		break;

	default:
		$enlace = false;
		$target = '_self';
		break;
}

if ( $is_preview ) $enlace = false;

?>
<div id="<?php echo esc_attr($id); ?>" class="wp-block <?php echo esc_attr($className); ?>">

	<?php echo get_tarjeta( $titulo, $resumen, $enlace, $imagen_id, $target ); ?>

</div>