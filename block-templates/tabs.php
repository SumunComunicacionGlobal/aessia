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
$id = 'tabs-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


// Create class attribute allowing for custom "className" and "align" values.
$className = 'wp-block-tabs';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

if ( have_rows( 'tabs' ) ) :

	$i = 0;
	$content_html = '';
	$vertical = get_field('tabs_format_vertical') ?: false;

	if ( $vertical && wp_is_mobile() ) :

		while ( have_rows( 'tabs' ) ) : the_row(); 

			$title = get_sub_field('tab_title') ?: false; 
			$excerpt = get_sub_field('tab_excerpt') ?: false; 
			$content = get_sub_field('tab_content') ?: false;

			?>

			<?php echo '<div class="my-2">'; ?>

				<?php echo '<h3>' . $title . '</h3>'; ?>

				<?php if ( $vertical ) echo '<div class="tab-excerpt">' . $excerpt . '</div>'; ?>

				<?php echo $content; ?>
						
			<?php echo '</div>'; ?>

		<?php endwhile; ?>

	<?php else: ?>

		<div id="<?php echo esc_attr($id); ?>" class="wp-block <?php echo esc_attr($className); ?>">

			<?php if ( $vertical ) {

				echo '<div class="row">';

					echo '<div class="col-md-3">';

					} ?>

						<nav>

							<?php if ( $vertical ) { ?>

								<ul class="nav nav-tabs flex-column" role="tablist" aria-orientation="vertical">

							<?php } else { ?>

								<ul class="nav nav-tabs" role="tablist">

							<?php } ?>

								<?php while ( have_rows( 'tabs' ) ) : the_row(); 

									$title = get_sub_field('tab_title') ?: false; 
									$excerpt = get_sub_field('tab_excerpt') ?: false; 
									$content = get_sub_field('tab_content') ?: false;

									$tab_class = '';
									$content_class = '';
									$aria_selected = 'false';

									if ( $i == 0 ) {
										$tab_class = 'active';
										$content_class = 'active show';
										$aria_selected = 'true';
									}

									$i++;

									$random_id = rand( 10000, 99999 );

									$content_html .= '<div class="tab-pane fade '.$content_class.'" id="tab-content-'.$random_id.'" role="tabpanel" aria-labelledby="tab-'.$random_id.'">';
										$content_html .= $content;
									$content_html .= '</div>';
									?>

									<li class="nav-item" role="presentation">

										<a class="nav-link <?php echo $tab_class; ?>" id="tab-<?php echo $random_id; ?>" data-toggle="tab" href="#tab-content-<?php echo $random_id; ?>" role="tab" aria-controls="tab-content-<?php echo $random_id; ?>" aria-selected="<?php echo $aria_selected; ?>">

											<?php echo '<div class="tab-title">' . $title . '</div>'; ?>

											<?php if ( $vertical ) echo '<div class="tab-excerpt">' . $excerpt . '</div>'; ?>
												
										</a>
					
									</li>


								<?php endwhile; ?>

							</ul>

						</nav>


			<?php if ( $vertical ) {

					echo '</div>'; // .col

					echo '<div class="col-md-9">';

					} ?>

						<div class="tab-content">

							<?php echo $content_html; ?>

						</div>

					<?php if ( $vertical ) {

					echo '</div>'; // .col

				echo '</div>'; // .row

			} ?>

		</div> <!-- .wp-block -->

	<?php endif; ?>

<?php endif; ?>


