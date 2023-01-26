<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php echo get_tarjeta( get_the_title(), get_the_excerpt(), get_the_permalink(), get_post_thumbnail_id(), false ); ?>

</article><!-- #post-## -->