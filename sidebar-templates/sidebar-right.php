<?php
/**
 * The right sidebar containing the main widget area.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// if ( ! is_active_sidebar( 'right-sidebar' ) ) {
// 	return;
// }

// when both sidebars turned on reduce col size to 3 from 4.
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>

<?php if ( 'both' === $sidebar_pos ) : ?>
	<div class="col-md-3 widget-area" id="right-sidebar" role="complementary">
<?php else : ?>
	<div class="col-md-4 col-xl-3 offset-xl-1 widget-area" id="right-sidebar" role="complementary">
<?php endif; ?>

<?php contenido_relacionado(); ?>

<?php if ( !is_singular( 'tutorial' ) ) {
	dynamic_sidebar( 'right-sidebar' );
} else {
	dynamic_sidebar( 'right-sidebar-tutorial' );
} ?>

<?php normativa_relacionada(); ?>

<?php contenido_relacionado( true ); ?>

</div><!-- #right-sidebar -->
