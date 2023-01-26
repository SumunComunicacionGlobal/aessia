<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$link = get_post_meta( get_the_ID(), 'url', true );
$excerpt = wpautop( get_the_date() );
$excerpt .= get_the_excerpt();
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php echo get_tarjeta( get_the_title(), $excerpt, $link, get_post_thumbnail_id(), '_blank', false ); ?>

</article><!-- #post-## -->
