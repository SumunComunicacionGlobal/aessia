<?php

/**
 * Team Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'team-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'wp-block-team';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$titulo = get_field('name_team') ?: false;
$cargo = get_field('cargo_team') ?: false;
$content = get_field('content_team') ?: false;
$link = get_field('link_team');
$img_id = get_field('img_team');
$target = '_self';
$link_attrs = '';
$modal_id = sanitize_title( $titulo ) . '-' . rand(1000, 9999);

$antetitulo = '';

if ( $link ) {
	$target = '_blank';
	$url = $link;
} else {
	$url = '#' . $modal_id;
	$link_attrs = '';
}

if ( $is_preview ) $enlace = false;

?>
<div id="<?php echo esc_attr($id); ?>" class="wp-block <?php echo esc_attr($className); ?>">

	<?php
	$background_dim = '';
	$text_color = 'has-black-color has-text-color';

	if ( $link ) {

		echo '<a href="'.$url.'" target="'.$target.'" rel="noopener noreferrer" class="wp-block-cover '.$background_dim.' aessia-card">';

	} else {

		echo '<a href="'.$url.'" data-toggle="modal" class="wp-block-cover '.$background_dim.' aessia-card">';
	}

		if ( $img_id ) {
			echo wp_get_attachment_image( $img_id, 'thumbnail', false, array( 'class' => 'card-team-img rounded-circle' ) );
		}

		echo '<div class="wp-block-cover__inner-container '.$text_color.'">';

			echo '<div class="">';

				if ( $antetitulo ) {
					echo '<div class="has-antetitulo-font-size">'.$antetitulo.'</div>';
				}

				echo '<p class="h2 aessia-card-title">';

					echo $titulo;

				echo '</p>';

				if ( $cargo ) {
					echo '<p class="">' . $cargo . '</p>';
				}

			echo '</div>';

			echo '<span class="flecha"></span>';

		echo '</div>';

	echo '</a>';
	?>

</div>



<!-- Modal -->
<div class="modal fade" id="<?php echo $modal_id; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $modal_id; ?>-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content container">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="cerrar" aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
		<?php echo wp_get_attachment_image( $img_id, 'thumbnail', false, array( 'class' => 'card-team-img rounded-circle mb-2' ) ); ?>
        <h3 class="modal-title" id="<?php echo $modal_id; ?>-label"><?php echo $titulo; ?></h3>
		<?php if( $cargo ) { ?>
			<p class="has-antetitulo-font-size"><?php echo $cargo; ?></p>
		<?php } ?>
	  	<?php echo $content; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo __( 'Close' ); ?></button>
      </div>
    </div>
  </div>
</div>