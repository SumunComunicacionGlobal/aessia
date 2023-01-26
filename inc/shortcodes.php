<?php 
function contenido_pagina($atts) {
	extract( shortcode_atts(
		array(
				'id' 	=> 0,
				'imagen'	=> 'no',
				'dominio'	=> false,

		), $atts)	
	);
	if ($dominio) {
		$api_url = $dominio . '/wp-json/wp/v2/pages/' . $id;
		$data = wp_remote_get( $api_url );
		$data_decode = json_decode( $data['body'] );

		// echo '<pre>'; print_r($data_decode); echo '</pre>';

		$content = $data_decode->content->rendered;
		return $content;
	} else {
		if ( 0 != $id) {
			$content_post = get_post($id);
			$content = $content_post->post_content;
			$content = '<div class="post-content-container">'.apply_filters('the_content', $content) .'</div>';
			if ('si' == $imagen) {
				$content = '<div class="entry-thumbnail">'.get_the_post_thumbnail($id, 'full') . '</div>' . $content;
			}
			return $content;
		}
	}
}
add_shortcode('contenido_pagina','contenido_pagina');

function home_url_shortcode() {
	return get_home_url();
}
add_shortcode('home_url','home_url_shortcode');

function theme_url_shortcode() {
	return get_stylesheet_directory_uri();
}
add_shortcode('theme_url','theme_url_shortcode');

function uploads_url_shortcode() {
	$upload_dir = wp_upload_dir();
	$uploads_url = $upload_dir['baseurl'];
	return $uploads_url;
}
add_shortcode('uploads_url','uploads_url_shortcode');

function year_shortcode() {
  $year = date('Y');
  return $year;
}
add_shortcode('year', 'year_shortcode');

function term_link_sh( $atts ) {
	extract( shortcode_atts(
		array(
				'id' 	=> 0,
		), $atts)	
	);
	$id = intval($id);
	return get_term_link( $id );
}
add_shortcode('cat_link', 'term_link_sh');

function post_link_sh( $atts ) {
	extract( shortcode_atts(
		array(
				'id' 	=> 0,
		), $atts)	
	);
	$id = intval($id);
	return get_the_permalink( $id );
}
add_shortcode('post_link', 'post_link_sh');

// Link Sumun
function link_sumun( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'texto' => 'Diseño web: Sumun.net',
			'url'	=> 'https://sumun.net',
		), $atts )
	);

    $link = '<a href="'.$url.'" target="_blank">'.$texto.'</a>';
    if (is_front_page()) {
        return $link;
    }
    return $texto;
}
add_shortcode( 'link_sumun', 'link_sumun' );

function paginas_hijas() {
	global $post;
	if ( is_post_type_hierarchical( $post->post_type ) /*&& '' == $post->post_content */) {
		$args = array(
			'post_type'			=> array($post->post_type),
			'posts_per_page'	=> -1,
			'post_status'		=> 'publish',
			'orderby'			=> 'menu_order',
			'order'				=> 'ASC',
			'post_parent'		=> $post->ID,
		);
		$r = '';
		$query = new WP_Query($args);
		if ($query->have_posts() ) {
			$r .= '<div class="contenido-adicional mt-5">';
			// $r .= '<h3>'.__( 'Contenido en', 'sumun' ).' "'.$post->post_title.'"</h3>';
			// $r .= '<ul>';
			while($query->have_posts() ) {
				$query->the_post();
				// $r .= '<li>';
					$r .= '<a class="btn btn-outline-secondary btn-lg mr-2 mb-2 pagina-hija" href="'.get_permalink( get_the_ID() ).'" title="'.get_the_title().'" role="button" aria-pressed="false">'.get_the_title().'</a>';
				$r .= '</li>';
			}
			// $r .= '</ul>';
			// $r .= '</div>';
		} elseif(0 != $post->post_parent) {
			wp_reset_postdata();
			$current_post_id = get_the_ID();
			$args['post_parent'] = $post->post_parent;
			$query = new WP_Query($args);
			if ($query->have_posts() && $query->found_posts > 1 ) {
				$r .= '<div class="contenido-adicional">';
				while($query->have_posts() ) {
					$query->the_post();
					if ($current_post_id == get_the_ID()) {
						$r .= '<span class="btn btn-outline-dark btn-sm mr-2 mb-2">'.get_the_title().'</span>';
					} else {
						$r .= '<a class="btn btn-outline-primary btn-sm mr-2 mb-2" href="'.get_permalink( get_the_ID() ).'" title="'.get_the_title().'" role="button" aria-pressed="false">'.get_the_title().'</a>';
					}
				}
				$r .= '</div>';
			}
		}
		wp_reset_postdata();
		return $r;
	}
}
add_shortcode( 'paginas_hijas', 'paginas_hijas' );

function tarjetas_paginas_hijas() {
	global $post;
	if ( is_post_type_hierarchical( $post->post_type ) ) {

		$args = array(
			'post_type'			=> array($post->post_type),
			'posts_per_page'	=> -1,
			'post_status'		=> 'publish',
			'orderby'			=> 'menu_order',
			'order'				=> 'ASC',
			'post_parent'		=> $post->ID,
		);

		if ( has_block( 'acf/tarjeta', $post ) || has_block( 'acf/tarjetas', $post ) ) {
			return false;
		}

		$r = '';

		$query = new WP_Query($args);

		if ( !$query->have_posts() && 0 != $post->post_parent ) {

			$args['post_parent'] = $post->post_parent;
			$args['post__not_in'] = array($post->ID);
			$query = new WP_Query($args);

		}

		if ($query->have_posts() ) {

			$r .= '<div class="wrapper contenido-relacionado">';

				$r .= '<h3>' . __( 'También te puede interesar', 'aessia' ) . '</h3>';

				$r .= '<div class="row">';

				while($query->have_posts() ) { $query->the_post();

					$url = get_the_permalink();
					$img_id = get_post_thumbnail_id();

					$r .= '<div class="col-xs-6 col-md-4 mb-2">';

						$r .= get_tarjeta(
							get_the_title(),
							false,
							$url,
							$img_id,
							'_self',
							get_the_ID()
						);

					$r .= '</div>';

				}

				$r .= '</div>';

			$r .= '</div>';

		}

		wp_reset_postdata();

		return $r;
	}
}
add_shortcode( 'tarjetas_paginas_hijas', 'tarjetas_paginas_hijas' );

add_filter('the_content', 'mostrar_paginas_hijas', 100);
function mostrar_paginas_hijas($content) {

	if (is_admin() || !is_singular() || !in_the_loop() || is_front_page() ) return $content;
	global $post;
	// if ( has_shortcode( $post->post_content, 'paginas_hijas' ) ) return $content;

	return $content . tarjetas_paginas_hijas();

}

function get_redes_sociales() {

	$r = '';
	
    $redes_sociales = array(
        'email' => 'envelope',
        'whatsapp' => 'whatsapp',
        'linkedin' => 'linkedin',
        'twitter' => 'twitter',
        'facebook' => 'facebook',
        'instagram' => 'instagram',
        'youtube' => 'youtube',
        'skype' => 'skype',
        'pinterest' => 'pinterest',
        'flickr' => 'flickr',
        'blog' => 'rss',
    );
    $r .= '<div class="redes-sociales px-0 navbar navbar-expand">';

	    $r .= '<div class="navbar-nav">';

	    foreach ($redes_sociales as $red => $fa_class) {
	    	$url = get_theme_mod( $red, '' );
	    	if( '' != $url) {
		    	$r .= '<a href="'.$url.'" target="_blank" rel="nofollow" title="'.sprintf( __( 'Abrir %s en otra pestaña', 'sumun' ), $red ).'"><span class="red-social nav-link '.$red.' fa fa-'.$fa_class.'"></span></a>';
	    	}
	    }

	    // $r .= '<span class="follow-us">' . __( 'Follow us', 'sumun' ) . '</span>';

	    $r .= '</div>';

    $r .= '</div>';

    return $r;

}
add_shortcode( 'redes_sociales', 'get_redes_sociales' );

function get_info_basica_privacidad() {

	$r = '';
	
	$text = get_theme_mod( 'info_privacidad_formularios', '' );
	if( '' != $text) {
		$r .= '<div class="info-basica-privacidad">';
	    	$r .= wpautop( $text );
		$r .= '</div>';
	}

    return $r;

}
add_shortcode( 'info_basica_privacidad', 'get_info_basica_privacidad' );

function sitemap() {
	$pt_args = array(
		'has_archive'		=> true,
	);
	$pts = get_post_types( $pt_args );
	// if (isset($pts['rl_gallery'])) unset $pts['rl_gallery'];
	$pts = array_merge( array('page'), $pts, array('post') );
	$r = '';

	foreach ($pts as $pt) {
		$pto = get_post_type_object( $pt );
		$taxonomies = get_object_taxonomies( $pt );

		$posts_args = array(
				'post_type'			=> $pt,
				'posts_per_page'	=> -1,
				'orderby'			=> 'menu_order',
				'order'				=> 'asc',
		);

		$posts_q = new WP_Query($posts_args);
		if ($posts_q->have_posts()) {

			$r .= '<h3 class="mt-3">'.$pto->labels->name.'</h3>';
			if ($taxonomies) {
				foreach ($taxonomies as $tax) {
					$terms = get_terms( array('taxonomy' => $tax) );
					foreach ($terms as $term) {
						$r .= '<a href="'.get_term_link( $term ).'" class="btn btn-dark btn-sm mr-1 mb-1">'.$term->name.'</a>';
					}
				}
			}

			while ($posts_q->have_posts()) { $posts_q->the_post();
				$r .= '<a href="'.get_the_permalink().'" class="btn btn-outline-primary btn-sm mr-1 mb-1">'.get_the_title().'</a>';
			}
		}

		wp_reset_postdata();
	}

	return $r;
}
add_shortcode( 'sitemap', 'sitemap' );

function testimonios() {
	ob_start();
	get_template_part( 'global-templates/carousel-testimonios' );
	$r = ob_get_clean();

	return $r;
}
add_shortcode( 'testimonios', 'testimonios' );

function sumun_get_reusable_block( $block_id = '' ) {
    if ( empty( $block_id ) || (int) $block_id !== $block_id ) {
        return;
    }
    $content = get_post_field( 'post_content', $block_id );
    return apply_filters( 'the_content', $content );
}

function sumun_reusable_block( $block_id = '' ) {
    echo sumun_get_reusable_block( $block_id );
}

function sumun_reusable_block_shortcode( $atts ) {
    extract( shortcode_atts( array(
        'id' => '',
    ), $atts ) );
    if ( empty( $id ) || (int) $id !== $id ) {
        return;
    }
    $content = advent_get_reusable_block( $id );
    return $content;
}
add_shortcode( 'reusable', 'sumun_reusable_block_shortcode' );


add_shortcode( 'carrusel_logos', 'get_carrusel_logos' );
function get_carrusel_logos( $atts ) {

	extract( shortcode_atts(
		array(
				'formato' 	=> false,
		), $atts)	
	);

	$r = '';

	$terms = get_terms( 'asociado_cat' );

	$link_destino_interno = get_field( 'logos_link', 'option' );

	if ( $link_destino_interno) {
		$link_seccion = get_field( 'logos_link_section_id', 'option' );
		if ( $link_seccion ) $link_destino_interno .= '#' . $link_seccion;
	}

	if ( $terms ) {

		foreach ($terms as $term) {

			$args = array(
				'post_type'				=> 'asociado',
				'posts_per_page'		=> -1,
				'tax_query'				=> array( array(
												'taxonomy'		=> 'asociado_cat',
												'terms'			=> $term->term_id,
											)),

			);

			$q = new WP_Query( $args );

			if ( $q->have_posts() ) {

				$r .= '<div class="wrapper">';

					$r .= '<p class="widget-title">'.$term->name.'</p>';

					if ( $formato == 'grid' ) {

						$r .= '<div class="row carousel-logos" id="carousel-'.$term->slug.'">';

					} else {

						$r .= '<div class="carousel-logos" id="carousel-'.$term->slug.'">';

					}

						while ( $q->have_posts() ) { 

							$q->the_post();

							if ( $formato == 'grid' ) {

								$r .= '<div class="col-6 col-sm-4 col-md-3 col-lg-2">';

								$link = get_post_meta( get_the_ID(), 'link', true );

								if ( $link ) $r .= '<a href="'.$link.'" target="_blank" rel="nofollow">';

							} else {

								$r .= '<a href="'.$link_destino_interno.'">';

							}

								$r .= '<div class="logo-asociado">';

									$r .= get_the_post_thumbnail( null, 'medium' );

									$r .= '<p class="has-small-font-size">'.get_the_title().'</p>';

								$r .= '</div>';

							if ( $formato == 'grid' ) {

								if ( $link ) $r .= '</a>';

								$r .= '</div>';

							} else {

								$r .= '</a>';

							}


						}

					$r .= '</div>';

				$r .= '</div>';

			}

			wp_reset_postdata();
		}

	}

	return $r;
}

function carrusel_logos() {
	echo get_carrusel_logos();
}


// Add Shortcode
function tarjetas_shortcode( $atts ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'id_categoria' => '10',
			'ids_posts' => false,
			'posts_per_page' => 6,
		),
		$atts
	);

	$r = '';

	$args = array(
			'post_type'				=> 'post',
			'posts_per_page'		=> $atts['posts_per_page'],
			'cat'					=> $atts['id_categoria'],
	);

	if( $atts['ids_posts'] ) {
		unset($args['cat']);
		$args['post_type'] = 'any';
		$args['post__in'] = explode( ',', $atts['ids_posts'] );
	}

	$q = new WP_Query( $args );

	if ( $q->have_posts() ) {

		$r .= '<div class="row">';

			while ( $q->have_posts() ) { 

				$q->the_post();

				$r .= '<div class="col-xs-6 col-md-4 mb-2">';

					$r .= get_tarjeta( get_the_title(), false, get_the_permalink(), get_post_thumbnail_id() );

				$r .= '</div>';

			}

		$r .= '</div>';

	}

	wp_reset_postdata();

	return $r;
}
add_shortcode( 'tarjetas', 'tarjetas_shortcode' );

function get_tarjeta( $titulo, $resumen = false, $url = false, $id_imagen = false, $target = '_self', $post_id = false, $antetitulo = false, $sticker = false ) {

	$r = '';

	$background_dim = '';
	$text_color = 'has-black-color has-text-color';
	$post_type = get_post_type( $post_id );
	$link_rel = '';

	if ( $id_imagen ) {
		$background_dim = 'has-background-dim';
		$text_color = '';
	}

	if ( $url ) {

		if ( '_blank' == $target ) {
			$link_rel = 'rel="nofollow"';
		}
		
		$r .= '<a href="'.$url.'" target="'.$target.'" ' . $link_rel . ' class="wp-block-cover '.$background_dim.' aessia-card">';

	} else {

		$r .= '<div class="wp-block-cover '.$background_dim.' aessia-card">';
	}

		if ( $sticker ) {
			$r .= '<span class="card-sticker">' . $sticker . '</span>';
		}

		if ( $id_imagen ) {
			add_filter( 'wp_calculate_image_srcset_meta', '__return_null' );
			$r .= wp_get_attachment_image( $id_imagen, 'medium_large', false, array('class' => 'wp-block-cover__image-background') );
			remove_filter( 'wp_calculate_image_srcset_meta', '__return_null' );
		}

		if ( is_search() ) {
			$post_type_obj = get_post_type_object( get_post_type( $post_id ) );
			$antetitulo = $post_type_obj->labels->singular_name;
		}

		$r .= '<div class="wp-block-cover__inner-container '.$text_color.'">';

			$r .= '<div class="">';

				if ( $antetitulo ) {
					$r .= '<div class="has-antetitulo-font-size">'.$antetitulo.'</div>';
				}

				$r .= '<h2 class="aessia-card-title">';

						$r .= $titulo;

				$r .= '</h2>';

				if ( $resumen ) {
					$r .= $resumen;
				}

			$r .= '</div>';

			if ( $url ) $r .= '<span class="flecha"></span>';

		$r .= '</div>';

	if ( $url ) {
		$r .= '</a>';
	} else {
		$r .= '</div>';
	}

	return $r;

}

// function get_calculadora_de_tarifas() {

// 	ob_start();
// 	get_template_part( 'global-templates/calculadora' );
// 	return ob_get_clean();
// }
// add_shortcode( 'calculadora_de_tarifas', 'get_calculadora_de_tarifas' );

function get_post_destacado_secundario_home() {

	$post_destacado_secundario = get_field( 'publicacion_destacada_secundaria', 'option' );

	if ( $post_destacado_secundario && $post_destacado_secundario->post_status == 'publish' ) {

		ob_start();

		global $post;
		$post = $post_destacado_secundario;
		setup_postdata( $post );

		get_template_part( 'loop-templates/content', 'destacado' );

		wp_reset_postdata();

		return ob_get_clean();
	}


}
add_shortcode( 'publicacion_destacada_inicio', 'get_post_destacado_secundario_home' );

add_shortcode( 'listado_categorias', 'get_listado_categorias' );
function get_listado_categorias( $atts ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'taxonomy' => 'tipo-funcionalidad',
		),
		$atts
	);

	$r = '';

	$terms = get_terms( $atts['taxonomy'] );

	if ( $terms ) {

		$r .= '<div class="row mw-700">';

			foreach ($terms as $term) {


				$r .= '<div class="wp-block-buttons is-vertical col-sm-6 col-md-4">';

					$r .= '<div class="wp-block-button is-style-arrow-link">';
						$r .= '<a href="'.get_term_link( $term ).'" title="'.$term->name.'" class="wp-block-button__link">'.$term->name.'</a>';
					$r .= '</div>';

				$r .= '</div>';

			}

		$r .= '</div>';

	}

	return $r;
}

add_shortcode( 'centro_de_ayuda_buscador', 'get_centro_de_ayuda_buscador' );
function get_centro_de_ayuda_buscador() {

	$r = get_search_form( false );

	return $r;
}

add_shortcode( 'prestadores_buscador', 'get_prestadores_buscador' );
function get_prestadores_buscador() {

	$r = get_search_form( false );

	return $r;
}

add_shortcode( 'pdf_carta_de_servicios', 'get_url_pdf_carta_de_servicios' );
function get_url_pdf_carta_de_servicios() {

	$r = get_field( 'carta_de_servicios_en_pdf', 'option' );

	return $r;
}

add_shortcode( 'todos_los_prestadores', 'aessia_get_todos_los_prestadores' );
function aessia_get_todos_los_prestadores() {

	$args = array(
		'post_type'			=> 'prestador',
		'posts_per_page'	=> -1
	);

	$r = '';

	$q = new WP_Query( $args );

	if ( $q->have_posts() ) {

		$r .= '<ul>';

		while ( $q->have_posts() ) { $q->the_post();

			$r .= '<li><a href="' . get_the_permalink() . '">'. get_the_title() .'</a></li>';

		}

		$r .= '</ul>';
		
	}

	wp_reset_postdata();

	return $r;
}