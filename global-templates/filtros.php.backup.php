<?php
/**
 * Hero setup.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

global $wp_query;
// echo '<pre>'; print_r($wp_query); echo '</pre>';

?>

<?php

if ( is_archive() && isset( $wp_query->query['post_type'] ) ) :

	$taxonomy_filter = false;
	$post_type = $wp_query->query['post_type'];

	if ( is_post_type_archive( 'guia' ) ) {
		$taxonomy_filter = 'perfil-guia';
	} elseif ( is_post_type_archive( 'tutorial' ) ) {
		$taxonomy_filter = 'perfil-tutorial';
	} elseif ( is_post_type_archive( 'preguntas-frecuentes' ) ) {
		$taxonomy_filter = 'perfil-faq';
	} elseif ( is_post_type_archive( 'funcionalidad' ) ) {
		$taxonomy_filter = 'tipo-funcionalidad';
	} elseif ( is_post_type_archive( 'tv' ) ) {
		$taxonomy_filter = 'categoria-tv';
	}

	if ( $taxonomy_filter ) :

	?>
		<div class="navbar navbar-filtros">

			<?php
			// $post_type = get_post_type();
			$terms = get_terms( array( 'taxonomy' => $taxonomy_filter ) );
			$reciente_active_class = '';

			$pt_taxonomies = get_post_type_object( $wp_query->query['post_type'] )->taxonomies;

			$q_obj = get_queried_object();
			if ( is_post_type_archive() && !is_tax() ) {
				$reciente_active_class = 'active';
			}



			if ( $terms ) : ?>

				<nav class="nav navbar navbar-expand-xl navbar-light">

					<button class="navbar-toggler pl-0" type="button" data-toggle="collapse" data-target="#navbarPerfiles" aria-controls="navbarPerfiles" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span> <span class="menu-title"><?php _e( 'Perfiles', 'aessia' ); ?></span>
					</button>

					<div class="collapse navbar-collapse" id="navbarPerfiles">

						<ul class="navbar-nav mr-auto">

							<li class="nav-item <?php echo $reciente_active_class; ?>">

								<a class="nav-link" href="<?php echo get_post_type_archive_link( $post_type ); ?>"><?php _e( 'Reciente', 'aessia' ); ?></a>

							</li>


							<?php foreach ( $terms as $term ) : 
								$link = get_term_link( $term );
								$link = add_query_arg( 'post_type', $post_type, $link );
								$perfil_active_class = '';

								if ( is_a( $q_obj, 'WP_Term') && $q_obj->term_id == $term->term_id ) {
									$perfil_active_class = 'active';
								}

								?>

								<li class="nav-item <?php echo $perfil_active_class; ?>">

									<a class="nav-link" href="<?php echo $link; ?>"><?php echo $term->name; ?></a>

								</li>

							<?php endforeach; ?>

						</ul>

					</div>

				</nav>

			<?php endif; ?>

			<?php if ( in_array( 'tema', $pt_taxonomies ) ) : ?>

				<?php 
					$temas = get_terms( array( 'taxonomy' => 'tema') );
					if ( $temas ) :

						$tema_slug = false;
						$texto_primera_opcion = __( 'Temas', 'aessia' );

						if ( isset( $wp_query->query['tema'] ) ) {
							$tema_slug = $wp_query->query['tema'];
							$texto_primera_opcion = __( 'Todos los temas', 'aessia' );
						}
				?>

					<div class="navbar navbar-expand">

						<select class="custom-select filtro-tema" name="filtro-tema">

							<option value="<?php echo get_post_type_archive_link( $post_type ); ?>" <?php if ( !$tema_slug) echo 'selected'; ?>><?php echo $texto_primera_opcion; ?></option>

							<?php foreach ($temas as $term) : ?>
								
								<?php
									$term_url = get_term_link( $term );
									$term_url = add_query_arg( array(
									    'post_type' => $post_type,
									    // 'key2' => 'value2',
									), $term_url );
								?>
								<option value="<?php echo $term_url; ?>" <?php if ( $tema_slug == $term->slug ) echo 'selected'; ?>><?php echo $term->name; ?></option>

							<?php endforeach; ?>

						</select>

					</div>

				<?php endif; ?>

			<?php endif; ?>

		</div>

	<?php endif; ?>

<?php endif; ?>
