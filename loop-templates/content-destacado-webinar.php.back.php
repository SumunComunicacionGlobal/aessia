<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$antetitulo = get_post_meta( get_the_ID(), 'antetitulo', true );
?>

<article class="mb-2 alignwide webinar-destacado" id="post-<?php the_ID(); ?>">

	<div class="row align-items-center">
		
		<div class="col-sm-4 mb-2">

			<?php if ( $antetitulo ) { ?>
			
				<p class="has-antetitulo-font-size"><?php echo $antetitulo; ?></p>

			<?php } ?>

			<a href="<?php the_permalink(); ?>" title="<?php get_the_title(); ?>"><?php the_title( '<h2>', '</h2>' ); ?></a>

			<?php the_excerpt(); ?>

			<div class="wp-block-buttons">
				<div class="wp-block-button is-style-arrow-link">
					<a class="wp-block-button__link" href="<?php the_permalink(); ?>" title="<?php get_the_title(); ?>"><?php _e( 'Ver', 'aessia' ); ?></a>
				</div>
			</div>

		</div>

		<div class="col-sm-8">
			
			<?php if ( has_post_thumbnail() ) {

				the_post_thumbnail( 'large' );

			} else { 
			
				the_content(); 

			}?>

		</div>


	</div>

</article><!-- #post-## -->


