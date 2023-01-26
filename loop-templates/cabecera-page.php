<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$antetitulo = false;
?>

<header class="entry-header wrapper">

	<div class="wp-block-cover has-black-background-color has-background-dim alignfull imagen-cabecera">

		<?php the_post_thumbnail( 'large', array( 'class' => 'wp-block-cover__image-background' ) ); ?>
	
		<div class="wp-block-cover__inner-container">

			<?php if ( $antetitulo ) echo '<p class="has-antetitulo-font-size">' . $antetitulo . '</p>'; ?>

			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

			<?php wpautop( $post->post_excerpt ); ?>

		</div>

	</div>

</header>
