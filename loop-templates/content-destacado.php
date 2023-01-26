<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class( 'mb-2' ); ?> id="post-<?php the_ID(); ?>">

	<div class="wp-block-cover alignwide superpuesto superpuesto-arriba-izquierda is-style-superpuesto">

		<?php the_post_thumbnail( 'large', array( 'class' => 'wp-block-cover__image-background' ) ); ?>

		<div class="wp-block-cover__inner-container">
	
			<p class="has-antetitulo-font-size"><?php echo strip_tags( get_the_category_list() ); ?></p>

			<?php the_title( '<h2>', '</h2>' ); ?>

			<?php the_excerpt(); ?>

			<div class="wp-block-buttons">
				
				<div class="wp-block-button is-style-arrow-link">
					
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="wp-block-button__link"><?php _e( 'Quiero saber más', 'aessia' ); ?></a>
				
				</div>
			
			</div>
		
		</div>
	
	</div>

</article><!-- #post-## -->
