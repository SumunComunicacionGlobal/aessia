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

$is_mobile = wp_is_mobile();

?>

<?php

// if ( is_home() || ( is_archive() && isset( $wp_query->query['post_type'] ) ) ) :
if ( is_home() || is_archive() ) {

	$taxonomy_filter = false;

	if ( is_post_type_archive( 'guia' ) ) {
		$taxonomy_filter = 'perfiles';
	} elseif ( is_post_type_archive( 'tutorial' ) ) {
		$taxonomy_filter = 'perfiles';
	} elseif ( is_post_type_archive( 'preguntas-frecuentes' ) ) {
		$taxonomy_filter = 'perfiles';
	} elseif ( is_post_type_archive( 'funcionalidad' ) ) {
		// $taxonomy_filter = 'tipo_funcionalidad';
		$taxonomy_filter = false;
	} elseif ( is_post_type_archive( 'tv' ) ) {
		$taxonomy_filter = 'categoria_tv';
		get_template_part( 'global-templates/programas' );
	} elseif ( is_post_type_archive( 'formacion' ) ) {
		$taxonomy_filter = array( 'area_formativa_dropdown', 'tipo_formacion_dropdown' );
	} elseif ( is_home() ) {
		$taxonomy_filter = 'categoria';
	}


	if ( $is_mobile ) {

		if ( is_post_type_archive( 'guia' ) ) {
			$taxonomy_filter = 'perfiles_dropdown';
		} elseif ( is_post_type_archive( 'tutorial' ) ) {
			$taxonomy_filter = 'perfiles_dropdown';
		} elseif ( is_post_type_archive( 'preguntas-frecuentes' ) ) {
			$taxonomy_filter = 'perfiles_dropdown';
		} elseif ( is_post_type_archive( 'funcionalidad' ) ) {
			// $taxonomy_filter = 'tipo_funcionalidad';
			$taxonomy_filter = false;
		} elseif ( is_post_type_archive( 'tv' ) ) {
			$taxonomy_filter = 'categoria_tv_dropdown';
		} elseif ( is_post_type_archive( 'formacion' ) ) {
			$taxonomy_filter = array( 'area_formativa_dropdown', 'tipo_formacion_dropdown' );
		} elseif ( is_home() ) {
			$taxonomy_filter = 'categoria_dropdown';
		}

	}

	// if ( !isset( $wp_query->query['post_type'] ) ) return false;
	
	if ( isset( $wp_query->query['post_type'] ) ) {
		$post_type = $wp_query->query['post_type'];
	} else {
		$post_type = 'post';
	}
	$pt_object = get_post_type_object( $post_type );
	$pt_taxonomies = $pt_object->taxonomies;

	// if ( $taxonomy_filter ) :

	if ( is_home() || is_category() ) {

		$terms = get_categories( array( 'orderby' => 'count' ) );

		if ( $terms ) { 

			$blog_link = false;
			$blog_id = get_option( 'page_for_posts' );
			if ( $blog_id ) {
				$blog_link = get_the_permalink( $blog_id );
			}
			$current_term = get_queried_object_id();

			$active_class = '';
			if ( is_home() ) {
				$active_class = ' active';
			}
			?>

			<div class="nav">

				<nav class="navbar navbar-filtros navbar-expand-md navbar-light">

					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-filtro" aria-controls="navbar-filtro" aria-expanded="false" aria-label="Navegar">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse" id="navbar-filtro">

						<ul class="navbar-nav flex-wrap">

							<li class="nav-item<?php echo $active_class; ?>">

								<a class="nav-link" href="<?php echo $blog_link; ?>"><?php echo __( 'Todo', 'aessia' ) ?></a>

							</li>

							<?php foreach ( $terms as $term ) {

								$active_class = '';
								if ( $current_term == $term->term_id ) {
									$active_class = ' active';
								}
								?>

								<li class="nav-item<?php echo $active_class; ?>">

									<a class="nav-link" href="<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?></a>

								</li>

							<?php } ?>
					
						</ul>

					</div>

				</nav>

			</div>

		<?php }

	} elseif ( 'funcionalidad' == $post_type ) {

		if ( $wp_query->posts ) { ?>

			<!-- <nav class="nav navbar navbar-expand navbar-light"> -->
			<nav>

				<ul class="slick-navbar">

					<?php foreach ( $posts as $post ) { ?>

						<li class="nav-item">

							<a class="nav-link" href="#post-<?php echo $post->ID; ?>"><?php echo $post->post_title; ?></a>

						</li>

					<?php } ?>

				</ul>

			</nav>

		<?php }
		

	} else { ?>

		<div class="navbar navbar-filtros">

			<?php if ( $taxonomy_filter ) :

				if ( !is_array( $taxonomy_filter ) ) $taxonomy_filter = array( $taxonomy_filter );

				echo '<div class="filter-main d-flex">';

					foreach ( $taxonomy_filter as $taxonomy_filter_slug ) {

						echo do_shortcode( '[facetwp facet="'.$taxonomy_filter_slug.'"]' );

					}

				echo '</div>';

			endif; ?>

			<?php if ( in_array( 'tema', $pt_taxonomies ) ) :

				echo do_shortcode( '[facetwp facet="temas"]' );

			endif; ?>

		</div>

	<?php }

}
