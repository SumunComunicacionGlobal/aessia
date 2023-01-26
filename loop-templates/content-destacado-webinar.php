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

<div class="wp-block-media-text mb-2 alignwide has-media-on-the-right is-stacked-on-mobile is-image-fill" style="grid-template-columns:auto 63%">

	<?php if ( has_post_thumbnail() ) { ?>

		<figure class="wp-block-media-text__media" style="background-image:url(<?php echo get_the_post_thumbnail_url( null, 'large' ); ?> );background-position:50% 50%">

			<?php the_post_thumbnail( 'large', array( 'class' => 'size-full' ) ); ?>

		</figure>

	<?php } else {

		the_content();

	} ?>

	<div class="wp-block-media-text__content">

		<div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>

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

		<div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>

	</div>

</div>


