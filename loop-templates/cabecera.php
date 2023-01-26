<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$antetitulo = false;

if ( is_singular( array( 'preguntas-frecuentes', 'guia', 'tutorial' ) ) ) {
	$pto = get_post_type_object( get_post_type() );
	$antetitulo = $pto->labels->singular_name;
} elseif( is_singular( 'formacion' ) ) {
	$areas_formativas = get_the_term_list( get_the_ID(), 'area-formativa', '', ' · ', '' );
	$tipo_formacion = get_the_term_list( get_the_ID(), 'tipo-formacion', '', ' · ', '' );
	$tags = array();
	if ( $tipo_formacion ) $tags[] = $tipo_formacion;
	if ( $areas_formativas ) $tags[] = $areas_formativas;
	$antetitulo = implode( ' / ', $tags );
}


?>

<header class="entry-header wrapper">

	<div class="wp-block-group imagen-cabecera-split">

		<div class="container">

			<!-- <div class="row align-items-center"> -->
			<div class="imagen-cabecera-split-content">

				<!-- <div class="col-md-6 col-lg-5"> -->

					<?php if ( $antetitulo ) echo '<p class="has-antetitulo-font-size">' . $antetitulo . '</p>'; ?>

					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

					<?php
					$localidad = get_localidad();
					if ( $localidad ) echo '<p class="icon-p zona ficha-field-value">' . $localidad . '</p>';
					?>

					<?php 
					if ( 'tv' == $post->post_type ) {
						// echo '<div class="wp-post-image">';
						// 	the_content();
						// echo '</div>';
					} else {
						the_post_thumbnail( 'medium_large', array( 'class' => 'wp-block-cover__image-background' ) ); 
					} ?>

					<?php 
					if ( 'prestador' != $post->post_type && 'formacion' != $post->post_type ) { ?>
						<div class="entry-meta">
							<?php understrap_posted_on(); ?>
						</div><!-- .entry-meta -->
					<?php } ?>
					
					<?php if ( $post->post_excerpt ) {
						echo '<div class="header-excerpt">' . wpautop( $post->post_excerpt ) . '</div>'; 
					} ?>

					<footer class="entry-footer">

						<?php aessia_perfil(); ?>

					</footer><!-- .entry-footer -->

				<!-- </div> -->

				<!-- <div class="col-md-6 col-lg-7"> -->


				<!-- </div> -->

			</div>

			<?php 
			if ( 'tv' == $post->post_type ) {
				echo '<div class="">';
					the_content();
				echo '</div>';
			} else {
				// the_post_thumbnail( 'medium_large', array( 'class' => 'wp-block-cover__image-background' ) ); 
			} 
			?>

		</div>

	</div>

</header>
