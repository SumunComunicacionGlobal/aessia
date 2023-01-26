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
$id = 'card-group-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'wp-block-card-group';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$post_type = get_field('post_type') ?: false;
$taxonomy = get_field('taxonomy') ?: false;
$term_id = get_field('term') ?: false;


if ( $is_preview ) $enlace = false;

$args = array();

if ( $post_type ) {
	$args['post_type'] = $post_type;
}

if ( $taxonomy ) {

	$posts_ids = get_posts( array( 'post_type' => $post_type, 'posts_per_page' => -1, 'fields' => 'ids' ) );
	$terms = get_terms( array( 'taxonomy' => $taxonomy, 'object_ids' => $posts_ids ) );

	if ( $terms ) {

		echo '<div class="row">';

		foreach ( $terms as $term ) {

			if( is_a( $term, 'WP_Term' ) ) {
				if ( wp_is_mobile() ) {

					switch ( $taxonomy ) {
						case 'perfil':
							$taxonomy = '_perfiles_dropdown';
							break;
						
						case 'tema':
							$taxonomy = '_temas_dropdown';
							break;
						
						default:
							# code...
							break;
					}

				} else {

					switch ( $taxonomy ) {
						case 'perfil':
							$taxonomy = '_perfiles';
							break;
						
						case 'tema':
							$taxonomy = '_temas';
							break;
						
						default:
							# code...
							break;
					}

				}

				$titulo = $term->name;
				$resumen = wpautop( $term->description );
				// $enlace = get_term_link( $term );
				$enlace = get_post_type_archive_link( $post_type );
				$enlace = add_query_arg( $taxonomy, $term->slug, $enlace );
				$imagen_id = get_term_meta( $term->term_id, 'term_image', true );
				$target = '_self';
						

				echo '<div class="col-xs-6 col-md-4 mb-2">';

						echo get_tarjeta( $titulo, $resumen, $enlace, $imagen_id, $target );

				echo '</div>';

			}

		}

		echo '</div>';

	}

} else {

	if ( $term_id ) {
		$term_taxonomy = get_term($term_id)->taxonomy;
		$args['tax_query'] = array( array(
									'taxonomy'		=> $term_taxonomy,
									'field'			=> 'term_id',
									'terms'			=> $term_id,

								));
	}

	if ( $args ) {
		$args['posts_per_page'] = -1;

		$q = new WP_Query( $args );

		if ( $q->have_posts() ) {

			echo '<div class="row">';

					while ( $q->have_posts() ) { $q->the_post();

						global $post;

						$titulo = get_the_title();
						$resumen = wpautop( $post->post_excerpt );
						$enlace = get_the_permalink();
						$imagen_id = get_post_thumbnail_id();
						$target = '_self';
								

						echo '<div class="col-xs-6 col-md-4 mb-2">';

								echo get_tarjeta( $titulo, $resumen, $enlace, $imagen_id, $target );

						echo '</div>';
					}

			echo '</div>';
		}

		wp_reset_postdata();
	}

}

?>