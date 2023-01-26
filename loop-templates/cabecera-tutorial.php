<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$antetitulo = false;

if ( is_singular( array( 'preguntas-frecuentes', 'guia', 'tutorial' ) ) ) {
	$pto = get_post_type_object( get_post_type() );
	$antetitulo = $pto->labels->singular_name;
}


?>

<header class="entry-header wrapper">


	<div class="container">


				<?php if ( $antetitulo ) echo '<p class="has-antetitulo-font-size">' . $antetitulo . '</p>'; ?>

				<?php the_title( '<div class="h1 title-breadcrumb">' . get_pegasso_title_breadcrumb() . '<h1 class="entry-title">', '</h1></div>' ); ?>

				<div class="entry-meta">
					<?php understrap_posted_on(); ?>
				</div><!-- .entry-meta -->

				<?php if ( $post->post_excerpt ) {
					echo '<div class="header-excerpt">' . wpautop( $post->post_excerpt ) . '</div>'; 
				} ?>


				<footer class="entry-footer">

					<?php aessia_perfil(); ?>

				</footer><!-- .entry-footer -->


	</div>

</header>
