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
$id = 'calculadora-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'wp-block-calculadora';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

?>

<div id="<?php echo esc_attr($id); ?>" class="wp-block <?php echo esc_attr($className); ?>">

	<?php

	if ( $is_preview ) :

		echo '<p>back</p>';
		_e( 'Aquí va la calculadora (no es visible en el editor)', 'aessia' );

	else :

		$reglamentos = array( 'baja-tension', 'rite' );
		$moneda = '<span class="moneda"> €</span>';

		$tasa_iva = get_field('tasa_de_iva', 'option');
		$max_boletines = get_field('numero_maximo_de_boletines', 'option');
		$precio_boletin_sin_calidad = get_field('precio_boletin_sin_calidad', 'option');
		$precio_boletin_con_calidad = get_field('precio_boletin_con_calidad', 'option');
		$tasa_boletin_gda = get_field('tasa_boletin_gobierno_de_aragon', 'option');
		$tasa_boletin_gda_sin_calidad = get_field('tasa_boletin_gobierno_de_aragon_sin_calidad', 'option');

		$explicacion_baja_tension = get_field('explicacion_baja_tension', 'option');
		$explicacion_rite = get_field('explicacion_rite', 'option');

		$explicacion_sin_calidad = get_field('explicacion_sin_calidad', 'option');
		$explicacion_con_calidad = get_field('explicacion_con_calidad', 'option');



		?>

		<nav>

			<ul class="nav nav-tabs" role="tablist">

				<?php

				foreach ( $reglamentos as $reglamento ) :

					$label_tab_reglamento = __( 'Baja Tensión', 'aessia' );
					$reglamento_tab_class = '';
					$reglamento_aria_selected = 'false';

					switch ($reglamento) {
						case 'baja-tension':

							$reglamento_tab_class = 'active';
							$reglamento_aria_selected = 'true';

							break;

						case 'rite':

							$label_tab_reglamento = __( 'RITE', 'aessia' );

							break;
						
						default:
							break;
					} 


					?>


					<li class="nav-item" role="presentation">

						<a class="nav-link <?php echo $reglamento_tab_class; ?>" id="tab-<?php echo $reglamento; ?>" data-toggle="tab" href="#tab-content-<?php echo $reglamento; ?>" role="tab" aria-controls="tab-content-<?php echo $reglamento; ?>" aria-selected="<?php echo $reglamento_aria_selected; ?>">

							<?php echo '<div class="tab-title">' . $label_tab_reglamento . '</div>'; ?>

						</a>
	
					</li>

				<?php endforeach; ?>

			</ul>

		</nav>

		<div class="tab-content">

			<?php foreach ( $reglamentos as $reglamento ) : 

				$reglamento_content_class = '';

				switch ( $reglamento ) {

					case 'baja-tension':

						$reglamento_content_class = 'active show';

						break;
					
					default:
						break;
				}
				?>
				
				<div class="tab-pane fade <?php echo $reglamento_content_class; ?>" id="tab-content-<?php echo $reglamento; ?>" role="tabpanel" aria-labelledby="tab-<?php echo $reglamento; ?>">


					<?php if( have_rows('tarifas', 'option') ): 

						$i_tabs = 0;
						$i_contents = 0;
						?>

						<div class="row">

							<div class="col-md-6 col-lg-6 col-xl-8">

								<nav>

									<ul class="nav nav-tabs flex-column" role="tablist" aria-orientation="">

									    <?php while( have_rows('tarifas', 'option') ): the_row(); ?>


								        	<?php 
								        		$mostrar_selector_boletines = get_sub_field('selector_boletines');
								        		$titulo_tarifa = get_sub_field('titulo_tarifa');
								        		$descripcion_tarifa = get_sub_field('descripcion_tarifa');
								        		$reglamento_tarifa = get_sub_field('reglamento');


														$tab_class = '';
														$aria_selected = 'false';

														if ( $i_tabs == 0 ) {
															$tab_class = 'active';
															$aria_selected = 'true';
														}

														if ( $mostrar_selector_boletines ) {
															$tab_class .= ' mostrar-selector-boletines';
														} else {
															$tab_class .= ' ocultar-selector-boletines';
														}


								        		if ( in_array( $reglamento, $reglamento_tarifa) ) :

														$random_id = $reglamento . '-' . sanitize_title( $titulo_tarifa );

														$i_tabs++;

											        	?>

														<li class="nav-item" role="presentation">

															<a class="nav-link <?php echo $tab_class; ?>" id="tab-<?php echo $random_id; ?>" data-toggle="tab" href="#tab-content-<?php echo $random_id; ?>" role="tab" aria-controls="tab-content-<?php echo $random_id; ?>" aria-selected="<?php echo $aria_selected; ?>">

																<?php echo '<div class="tab-title">' . $titulo_tarifa . '</div>'; ?>

																<?php echo '<div class="tab-excerpt">' . $descripcion_tarifa . '</div>'; ?>
																	
															</a>
										
														</li>

												<?php endif; ?>


									    <?php endwhile; ?>

									</ul>

								</nav>

								<div class="slider-boletines-wrapper">

									<?php the_field( 'explicacion_boletines', 'option'); ?>

									<div class="my-1">

										<span class="h1 numero-boletines" id="numero-boletines-<?php echo $reglamento; ?>">X</span>
										 <!-- - <span class="h1" id="precio-boletines-sin-calidad">X</span> 
										 - <span class="h1" id="precio-boletines-con-calidad">X</span> -->
										<input type="range" list="tickmarks-<?php echo $reglamento; ?>" value="1" min="1" max="<?php echo $max_boletines; ?>" id="slider-boletines-<?php echo $reglamento; ?>" class="slider-boletines" step="1">
										<div class="track">
											<div class="track-inner"></div>
										</div>
										<div class="thumb"></div>

										<datalist id="tickmarks-<?php echo $reglamento; ?>">
										  <option value="1" label="1"></option>
										  <option value="100" label="100"></option>
										  <option value="200" label="200"></option>
										  <option value="<?php echo $max_boletines; ?>" label="<?php echo $max_boletines; ?>"></option>
										</datalist>



									</div>

									<?php the_field( 'titulo_desplegable', 'option' ); ?>

									<?php $contenido_desplegable = get_field( 'contenido_desplegable', 'option' ); ?>

									<?php if ( $contenido_desplegable ) {

										echo '<a class="read-more-link" data-toggle="collapse" href="#desplegable-calculadora" role="button" aria-expanded="false" aria-controls="desplegable-calculadora">'.__( 'Ver más', 'aessia' ).'</a>';

									} ?>

									<?php if ( $contenido_desplegable ) {

										echo '<div class="collapse" id="desplegable-calculadora">';

											echo '<div class="card card-body mt-2">';

												echo $contenido_desplegable;

												echo '<hr>';

											echo '</div>';

										echo '</div>';

									} ?>

								</div>

							</div>

							<div class="col-md-6 col-lg-6 col-xl-4">

								<div class="tab-content">

								    <?php while( have_rows('tarifas', 'option') ): the_row(); ?>


							        	<?php 
							        		$reglamento_tarifa = get_sub_field( 'reglamento' );

							        		if ( in_array( $reglamento, $reglamento_tarifa) ) :

							        			$mostrar_selector_boletines = get_sub_field( 'selector_boletines' );

								        		$titulo_tarifa = get_sub_field( 'titulo_tarifa'); 
								        		$cuota_sin_calidad = get_sub_field( 'cuota_de_uso_sin_iva_sin_calidad'); 
								        		$cuota_con_calidad = get_sub_field( 'cuota_de_uso_sin_iva_con_calidad');
								        		$tasa_gda = get_sub_field( 'tasa_gobierno_de_aragon' );
								        		$tasa_gda_sin_calidad = get_sub_field( 'tasa_gobierno_de_aragon_sin_calidad' );

								        		$cuota_iva_sin_calidad = round( $cuota_sin_calidad * $tasa_iva/100, 2 );
								        		$cuota_iva_con_calidad = round( $cuota_con_calidad * $tasa_iva/100, 2 );

								        		$total_sin_calidad = $cuota_sin_calidad + $cuota_iva_sin_calidad + $tasa_gda_sin_calidad;
								        		$total_con_calidad = $cuota_con_calidad + $cuota_iva_con_calidad + $tasa_gda;

												$content_class = '';

												if ( $i_contents == 0 ) {
													$content_class = 'active show';
												}

												$i_contents++;

												$random_id = $reglamento . '-' . sanitize_title( $titulo_tarifa );
												$data_tarifa_id = 'resultado-tarifa-' . $random_id;
												?>


												<div class="tab-pane fade resultados-tarifa <?php echo $content_class; ?>" id="tab-content-<?php echo $random_id; ?>" role="tabpanel" aria-labelledby="tab-<?php echo $random_id; ?>">

													<div class="row">

														<?php
														$variaciones_calidad = array( 'con-calidad', 'sin-calidad' );

														foreach ( $variaciones_calidad as $variacion_calidad ) :

															$titulo_tabla_resultado = __( 'Sin calidad', 'aessia' );
															$total = aessia_formatear_precio( $total_sin_calidad );
															$cuota_de_uso = $cuota_sin_calidad;
															$cuota_iva = $cuota_iva_sin_calidad;
															$explicacion = $explicacion_sin_calidad;
															$tasa_gda_desglose = $tasa_gda_sin_calidad;

															if ( $variacion_calidad == 'con-calidad' ) {

																$titulo_tabla_resultado = __( 'Con calidad', 'aessia' );
																$total = aessia_formatear_precio( $total_con_calidad );
																$cuota_de_uso = $cuota_con_calidad;
																$cuota_iva = $cuota_iva_con_calidad;
																$explicacion = $explicacion_con_calidad;
																$tasa_gda_desglose = $tasa_gda;

															}
														?>

															
															<div class="col-6 resultado-tarifa" id="<?php echo $data_tarifa_id; ?>-<?php echo $variacion_calidad; ?>">
																
																<p class="widget-title"><?php echo $titulo_tabla_resultado; ?></p>

																<p class="resultado-tarifa-total">

																	<span class="cifra total-tarifa" data-tarifa-id="<?php echo $data_tarifa_id; ?>-<?php echo $variacion_calidad; ?>" data-calidad="<?php echo $variacion_calidad; ?>"data-valor-original="<?php echo $total; ?>">

																		<?php echo $total; ?>

																	</span>

																	<?php echo $moneda; ?>


																</p>

																<p class="has-antetitulo-font-size sin-borde"><?php echo __( 'Desglose', 'aessia' ); ?></p>

																<div class="desglose-tarifa">

																	<div>
																		<span>
																			<?php _e( 'Cuota de uso', 'aessia' ); ?>
																		</span>

																		<span>
																			<span class="cifra desglose-cuota-de-uso" data-tarifa-id="<?php echo $data_tarifa_id; ?>-<?php echo $variacion_calidad; ?>" data-calidad="<?php echo $variacion_calidad; ?>" data-valor-original="<?php echo $cuota_de_uso; ?>">
																				<?php echo $cuota_de_uso; ?>
																			</span>

																			<?php echo $moneda; ?>

																		</span>
																	</div>

																	<?php if ( $mostrar_selector_boletines ) { ?>

																	<div>
																		<span>
																			<?php _e( 'Boletines adic.', 'aessia' ); ?>
																		</span>
																		
																		<span>

																			<span class="cifra desglose-boletines-adicionales" data-tarifa-id="<?php echo $data_tarifa_id; ?>-<?php echo $variacion_calidad; ?>" data-calidad="<?php echo $variacion_calidad; ?>" data-valor-original="0">
																				0
																			</span>

																			<?php echo $moneda; ?>

																		</span>
																	</div>

																	<?php } ?>

																	<div>
																		<span>
																			<?php _e( 'I.V.A.', 'aessia' ); ?> <?php echo $tasa_iva; ?> %
																		</span>
																		<span>
																			<span class="cifra desglose-iva" data-tarifa-id="<?php echo $data_tarifa_id; ?>-<?php echo $variacion_calidad; ?>" data-calidad="<?php echo $variacion_calidad; ?>" data-valor-original="<?php echo $cuota_iva; ?>">
																				<?php echo $cuota_iva; ?>
																			</span>

																			<?php echo $moneda; ?>

																		</span>
																	</div>

																	<div>
																		<span>
																			<?php _e( 'Tasa Gob. Aragón', 'aessia' ); ?>
																		</span>
																		<span>
																			<span class="cifra desglose-tasa-gda" data-tarifa-id="<?php echo $data_tarifa_id; ?>-<?php echo $variacion_calidad; ?>" data-calidad="<?php echo $variacion_calidad; ?>" data-valor-original="<?php echo $tasa_gda_desglose; ?>">

																				<?php echo $tasa_gda_desglose; ?>

																			</span>

																			<?php echo $moneda; ?>
																				
																		</span>
																	</div>

																</div>

																<div class="explicacion-calidad">

																	<?php echo $explicacion; ?>

																</div>
																
															</div>

														<?php endforeach; // $variaciones_calidad ?>

													</div>

												</div>

											<?php endif; ?>

								    <?php endwhile; ?>

								</div>

							</div>

						</div>

					<?php endif; ?>

					<?php if ( $reglamento == 'baja-tension' ) {
						echo $explicacion_baja_tension;
					} elseif ( $reglamento == 'rite' ) {
						echo $explicacion_rite;
					} ?>

				</div> <!-- .tab-pane -->

			<?php endforeach; ?>

		</div>


	<?php endif; ?>

</div>

<script>

	// Ocultar range slider según tarifa seleccionada
	jQuery('.mostrar-selector-boletines').click(function(e) {
		console.log(jQuery(this).parents('.tab-pane').find('.slider-boletines-wrapper'));
		jQuery(this).parents('.tab-pane').find('.slider-boletines-wrapper').show();
	});
	jQuery('.ocultar-selector-boletines').click(function(e) {
		jQuery(this).parents('.tab-pane').find('.slider-boletines-wrapper').hide();
	});

	// Cambiar estilos range slider
	
	// const range = document.querySelector('input[type="range"]')
	// const thumb = document.querySelector('.thumb')
	// const track = document.querySelector('.track-inner')

	// const updateSlider = (value) => {
	//   thumb.style.left = `${value}%`
	//   thumb.style.transform = `translate(-${value}%, -50%)`
	//   track.style.width = `${value}%`
	// }

	// range.oninput = (e) =>
	//   updateSlider(e.target.value)

	// updateSlider(50) // Init value



	var sliders = document.getElementsByClassName('slider-boletines');
	var slider = sliders[0];

	var restoSliders = [];
	for (var i = 1; i <= sliders.length - 1; i++ ) {
		restoSliders.push(sliders[i]);
	}
	sliders = restoSliders;

	var outputs = document.getElementsByClassName('numero-boletines');

	var tasaIva = <?php echo $tasa_iva; ?>;
	tasaIva = tasaIva / 100;

	var precio;

	calculaPrecioBoletines();
	slider.oninput = function() {
		calculaPrecioBoletines();

		Array.prototype.forEach.call(sliders, function(eachSlider) {
			eachSlider.value = slider.value;
		});

	}

	// Sincronizar sliders
	Array.prototype.forEach.call(sliders, function(eachSlider) {
		eachSlider.oninput = function() {
			slider.value = eachSlider.value;
			calculaPrecioBoletines();
		}
	});


	function calculaPrecioBoletines() {

		var cuotaBoletinesSinCalidad = roundToTwo( ( slider.value - 1 ) * <?php echo $precio_boletin_sin_calidad; ?> ); 
		var cuotaIvaBoletinesSinCalidad = roundToTwo( cuotaBoletinesSinCalidad * tasaIva );

		var cuotaBoletinesConCalidad = roundToTwo( ( slider.value - 1 ) * <?php echo $precio_boletin_con_calidad; ?> ); 
		var cuotaIvaBoletinesConCalidad = roundToTwo( cuotaBoletinesConCalidad * tasaIva );
		
		var tasaGdaBoletinesConCalidad = roundToTwo( ( slider.value - 1 ) * <?php echo $tasa_boletin_gda; ?> );
		var tasaGdaBoletinesSinCalidad = roundToTwo( ( slider.value - 1 ) * <?php echo $tasa_boletin_gda_sin_calidad; ?> );
		
		var incrementoPrecioSinCalidad = roundToTwo( cuotaBoletinesSinCalidad + cuotaIvaBoletinesSinCalidad + tasaGdaBoletinesSinCalidad );
		var incrementoPrecioConCalidad = roundToTwo( cuotaBoletinesConCalidad + cuotaIvaBoletinesConCalidad + tasaGdaBoletinesConCalidad );


		var totales = document.querySelectorAll('.resultado-tarifa');

		totales.forEach(function(total) {

			tarifaId = total.id;

			var desgloseBoletinesAdicionales = document.querySelector('.desglose-boletines-adicionales[data-tarifa-id="' + tarifaId +'"]');


			if (desgloseBoletinesAdicionales != null) {

				var totalTarifa = document.querySelector('.total-tarifa[data-tarifa-id="' + tarifaId +'"]');
				var incrementoPrecio = incrementoPrecioSinCalidad;
				if( totalTarifa.getAttribute("data-calidad") == 'con-calidad' ) {
					incrementoPrecio = incrementoPrecioConCalidad;
				}
				totalTarifa.innerHTML = roundToTwo( parseFloat( totalTarifa.getAttribute("data-valor-original") ) + incrementoPrecio );


				var cuotaBoletines = cuotaBoletinesSinCalidad;
				if( desgloseBoletinesAdicionales.getAttribute("data-calidad") == 'con-calidad' ) {
					cuotaBoletines = cuotaBoletinesConCalidad;
				}
				desgloseBoletinesAdicionales.innerHTML = roundToTwo( parseFloat( desgloseBoletinesAdicionales.getAttribute("data-valor-original") ) + cuotaBoletines );

				var desgloseIva = document.querySelector('.desglose-iva[data-tarifa-id="' + tarifaId +'"]');
				var cuotaIvaBoletines = cuotaIvaBoletinesSinCalidad;
				if( desgloseIva.getAttribute("data-calidad") == 'con-calidad' ) {
					cuotaIvaBoletines = cuotaIvaBoletinesConCalidad;
				}
				desgloseIva.innerHTML = roundToTwo( parseFloat( desgloseIva.getAttribute("data-valor-original") ) + cuotaIvaBoletines );

				var desgloseTasaGda = document.querySelector('.desglose-tasa-gda[data-tarifa-id="' + tarifaId +'"]');
				var tasaGdaBoletines = tasaGdaBoletinesSinCalidad;
				if ( desgloseTasaGda.getAttribute("data-calidad") == 'con-calidad' ) {
					tasaGdaBoletines = tasaGdaBoletinesConCalidad;
				}
				desgloseTasaGda.innerHTML = roundToTwo( parseFloat( desgloseTasaGda.getAttribute("data-valor-original") ) + tasaGdaBoletines );

			}


		});


		Array.prototype.forEach.call(outputs, function(output) {
			output.innerHTML = slider.value;
		});

		// outputPrecioSinCalidad.innerHTML = incrementoPrecioSinCalidad;
		// outputPrecioConCalidad.innerHTML = incrementoPrecioConCalidad;

	}

	function roundToTwo(num) {
	    return +(Math.round(num + "e+2")  + "e-2");
	}

</script>

