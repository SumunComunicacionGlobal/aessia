<?php

/**
 * Tarjeta Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'featured-links-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'wp-block-featured-links';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$ids = get_field('post_ids') ?: false;

?>

<div id="<?php echo esc_attr($id); ?>" class="wp-block <?php echo esc_attr($className); ?>">

<?php

if ( $ids ) {

	echo '<div class="wp-block-buttons is-vertical">';

	foreach ( $ids as $id ) {

		$post = get_post($id);
		if ( 'publish' != $post->post_status ) continue;

		$titulo = get_the_title( $id );
		$enlace = get_the_permalink( $id );
		if ( $is_preview ) $enlace = false;
		
		echo '<div class="wp-block-button is-style-arrow-link">';

			echo '<a class="wp-block-button__link" href="'.$enlace.'" title="'.$titulo.'">'.$titulo.'</a>';

		echo '</div>';

	}

	echo '</div>';

}

?>

</div>