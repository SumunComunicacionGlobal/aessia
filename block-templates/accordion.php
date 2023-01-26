<?php

/**
 * Accordion Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'accordion-block--' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}
?>


<?php if( have_rows('accordion') ): ?>

    <div id="<?php echo esc_attr($id); ?>" class="accordion-block mt-2 mb-2">

        <?php while( have_rows('accordion') ): the_row(); ?>

			<?php
			$titulo = get_sub_field('accordion_title');
			$item_id = sanitize_title( $titulo ) . '-' . rand(1000,9999);
			?>			

			<!-- <div class="card"> -->
			<div class="accordion-item">

				<!-- <div class="card-header" id="heading-<?php echo $item_id; ?>"> -->
					<a class="accordion-title d-block collapsed" data-toggle="collapse" href	="#collapse-<?php echo $item_id; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $item_id; ?>">
						<?php echo $titulo; ?>
					</a>
				<!-- </div> -->

				<div id="collapse-<?php echo $item_id; ?>" class="collapse" aria-labelledby="heading-<?php echo $item_id; ?>">
					<!-- <div class="card-body"> -->
					<div class="accordion-collapse">
						<?php the_sub_field('accordion_content'); ?>
					</div>
				</div>

			</div>

        <?php endwhile; ?>

    </div>

<?php endif; ?>