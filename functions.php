<?php
/**
 * Understrap functions and definitions
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

define( 'THEME_AESSIA_VERSION', '1.0.3' );

define( 'TERM_ID_INSTALADOR', 62);
define( 'TERM_ID_INGENIERIA', 61);
define( 'TERM_ID_PROGRAMAS_TV', 89);

$understrap_includes = array(
    '/theme-settings.php',                  // Initialize theme default settings.
    '/setup.php',                           // Theme setup and custom theme supports.
    '/widgets.php',                         // Register widget area.
    '/enqueue.php',                         // Enqueue scripts and styles.
    '/template-tags.php',                   // Custom template tags for this theme.
    '/pagination.php',                      // Custom pagination for this theme.
    '/hooks.php',                           // Custom hooks.
    '/extras.php',                          // Custom functions that act independently of the theme templates.
    '/customizer.php',                      // Customizer additions.
    '/custom-comments.php',                 // Custom Comments file.
    '/jetpack.php',                         // Load Jetpack compatibility file.
    '/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker.
    '/woocommerce.php',                     // Load WooCommerce functions.
    '/editor.php',                          // Load Editor functions.
    '/deprecated.php',                      // Load deprecated functions.
    '/post-types.php',
    '/shortcodes.php',
    // '/dummy-content.php',
    '/blocks-sumun.php',
    '/seo.php',
    '/wpo.php',
    '/facetwp.php',
);

foreach ( $understrap_includes as $file ) {
    $filepath = locate_template( 'inc' . $file );
    if ( ! $filepath ) {
        trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
    }
    require_once $filepath;
}

$content_width = 1140;
add_theme_support('editor-styles');
add_filter( 'widget_text', 'do_shortcode');
add_filter( 'wpcf7_form_elements', 'do_shortcode' );
function understrap_wpdocs_theme_add_editor_styles() {
    add_editor_style( 'css/custom-editor-style.css' );
}

add_action( 'after_setup_theme', 'editor_color_palette' );
function editor_color_palette() {

    $colores = array(
        array(
            'nombre'    => 'Primary',
            'valor'     => '#9CC117',
        ),
        array(
            'nombre'    => 'Secondary',
            'valor'     => '#004075',
        ),
        array(
            'nombre'    => 'Yellow',
            'valor'     => '#FFFAE4',
        ),
        array(
            'nombre'    => 'Dark Yellow',
            'valor'     => '#E2EDBB',
        ),
        array(
            'nombre'    => 'White',
            'valor'     => '#ffffff',
        ),
        array(
            'nombre'    => 'Light',
            'valor'     => '#F2F2F2',
        ),
        array(
            'nombre'    => 'Black',
            'valor'     => '#000000',
        ),
        array(
            'nombre'    => 'Dark',
            'valor'     => '#797979',
        ),
    );

    $colores_atts = array();
    foreach ($colores as $color) {
        $colores_atts[] = array(
            'name'      => $color['nombre'] . ' ' . $color['valor'],
            'slug'      => sanitize_title_with_dashes( $color['nombre'] ),
            'color'     => $color['valor'],
        );
    }

    add_theme_support( 'editor-color-palette', $colores_atts );
}

// add_filter('acf/settings/remove_wp_meta_box', '__return_false');


function author_page_redirect() {
    if ( is_author() ) {
        wp_redirect( home_url() );
    }
}
add_action( 'template_redirect', 'author_page_redirect' );

function es_blog() {

    if( is_singular('post') || is_category() || is_tag() || ( is_home() && !is_front_page() ) ) {
        return true;
    }

    return false;
}

add_filter( 'theme_mod_understrap_sidebar_position', 'cargar_sidebar');
function cargar_sidebar( $valor ) {
    global $wp_query;

    if ( is_singular( array( 'funcionalidad', 'tv' ) ) ) return $valor;
    if ( is_singular( array( 'prestador', 'formacion' ) ) ) return false;

    if ( is_singular() && !is_page() ) {
        $valor = 'right';
    }
    return $valor;
}

add_action( 'wp_body_open', 'top_anchor');
function top_anchor() {
    echo '<span class="sr-only" id="top"></span>';
}

add_action( 'wp_body_open', 'top_bar');
function top_bar() {
    if ( is_active_sidebar( 'top-bar' ) ) {

        echo '<div id="wrapper-top-bar">';

            echo '<div class="container">';

                echo '<div class="row">';

                    echo '<div class="col-md-8">';

                        $tagline = get_bloginfo( 'description', 'display' );
                        if ( is_front_page() ) {
                            echo '<h1 class="tagline sin-borde">'.$tagline.'</h1>';
                        } else {
                            echo '<strong class="tagline">'.$tagline.'</strong>';
                        }

                    echo '</div>';

                    echo '<div class="col-md-4 text-right">';

                        dynamic_sidebar( 'top-bar' );

                    echo '</div>';

                echo '</div>';

            echo '</div>';

        echo '</div>';
    }
}


add_action( 'wp_footer', 'back_to_top' );
function back_to_top() {
    echo '<a href="#top" class="back-to-top"></a>';
}

add_action( 'wp_footer', 'aessia_mega_menu' );
function aessia_mega_menu() {
    require_once('global-templates/modal-mega-menu.php');
    require_once('global-templates/modal-buscador.php');
}

// Nuevos tamaños de letra
function alessia_define_font_sizes() {

        add_theme_support( 'disable-custom-font-sizes' );
        // Add custom editor font sizes.
        add_theme_support(
            'editor-font-sizes',
            array(
                array(
                    'name'      => esc_html__( 'Pequeño', 'aessia-admin' ),
                    'shortName' => esc_html_x( 'S', 'Font size', 'aessia-admin' ),
                    'size'      => 13,
                    'slug'      => 'small',
                ),
                array(
                    'name'      => esc_html__( 'Normal', 'aessia-admin' ),
                    'shortName' => esc_html_x( 'M', 'Font size', 'aessia-admin' ),
                    'size'      => 16,
                    'slug'      => 'normal',
                ),
                array(
                    'name'      => esc_html__( 'Medio', 'aessia-admin' ),
                    'shortName' => esc_html_x( 'M', 'Font size', 'aessia-admin' ),
                    'size'      => 20,
                    'slug'      => 'medium',
                ),
                array(
                    'name'      => esc_html__( 'Grande', 'aessia-admin' ),
                    'shortName' => esc_html_x( 'L', 'Font size', 'aessia-admin' ),
                    'size'      => 36,
                    'slug'      => 'large',
                ),
                array(
                    'name'      => esc_html__( 'Enorme', 'aessia-admin' ),
                    'shortName' => esc_html_x( 'XXL', 'Font size', 'aessia-admin' ),
                    'size'      => 42,
                    'slug'      => 'huge',
                ),
                array(
                    'name'      => esc_html__( 'Antetítulo', 'aessia-admin' ),
                    'shortName' => esc_html_x( 'Ante', 'Font size', 'aessia-admin' ),
                    'size'      => 22,
                    'slug'      => 'antetitulo',
                ),
            )
        );
    }
add_action( 'after_setup_theme', 'alessia_define_font_sizes' );

// add_action ( 'astra_primary_content_bottom', 'tarjetas_relacionadas' );
function tarjetas_relacionadas() {

    global $post;
    $ids = false;

    if ( is_page() ) {
        $args = array(
            'post_type'         => $post->post_type,
            'post_parent'       => $post->ID,
            'posts_per_page'    => -1,
            'fields'            => 'ids',
        );
        $ids = get_posts( $args );

    }

    if ( $ids ) {
        $shortcode = '[tarjetas ids_posts="'.implode(',', $ids ).'"]';
        echo do_shortcode( $shortcode );
    }

}

function get_aessia_perfil() {

    $terms = wp_get_post_terms( get_the_ID(), array('perfil'/*, 'perfil-tutorial', 'perfil-guia', 'perfil-faq'*/), array( 'fields' => 'names' ) );
    

    $r = '';

    if ( $terms ) {

        $perfiles = '<span class="font-weight-bold">' . implode( ' / ', $terms ) . '</span>';
    
        $r .= '<p><span class="badge badge-pill badge-warning badge-lg">';
            $r .= sprintf( __( 'Esta información está dirigida a %s', 'aessia' ), $perfiles );
        $r .= '</span></p>';

    }

    return $r;
}

function aessia_perfil() {
    echo get_aessia_perfil();
}

function get_normativa_relacionada() {

    if ( !is_singular() || is_singular( 'tutorial' ) ) return false;

    if( have_rows('legislacion_y_normas') ):

        $legislacion_label = get_field_object( 'legislacion_y_normas' )['label'];

        $r = '';
        $r .= '<div class="widget">';

            $r .= '<p class="widget-title">'. $legislacion_label .'</p>'; 

            $r .= '<ul class="contenidos-relacionados">';

            while( have_rows('legislacion_y_normas') ) : the_row();

                $r .= '<li class="contenido-relacionado">';

                    $codigo_norma = get_sub_field('codigo_norma');
                    $nombre_norma = get_sub_field('nombre_norma');
                    $enlace_norma = get_sub_field('enlace_norma');

                    if ( $codigo_norma ) {
                        $r .= '<p><span class="badge badge-pill badge-secondary">'.$codigo_norma.'</span></p>';
                    }
                    if ( !$nombre_norma ) {
                        $nombre_norma = __( 'Ir a la norma', 'aessia' );
                    }

                    $r .= '<p>';

                        if ( $enlace_norma ) {
                            $r .= '<a href="'.$enlace_norma.'" rel="nofollow noopener noreferrer" title="'.$nombre_norma.'" target="_blank">';
                        }

                            $r .= $nombre_norma;

                        if ( $enlace_norma ) {
                            $r .= '</a>';
                        }

                    $r .= '</p>';

                $r .= '</li>';

            endwhile;

            $r .= '</ul>';

        $r .= '</div>';

        return $r;

    endif;
}

function normativa_relacionada() {
    echo get_normativa_relacionada();
}

function get_contenido_relacionado( $pegasso = false, $in_row = false ) {

    if ( !is_singular() ) return false;
    if ( is_singular( 'tutorial' ) && !$pegasso ) return false;

    $args = array(
        'post_type'         => array('post', 'guia'),
        'posts_per_page'    => 3,
        'post__not_in'      => array( get_the_ID() ),
        'ignore_sticky_posts'   => 1,
    );

    if ( 'post' == get_post_type() ) {
        $args['post_type'] = array('post');

        $tag_ids = wp_get_post_tags( get_the_ID(), array( 'fields' => 'ids' ) );
        if ( $tag_ids ) {
            $args['tag__in'] = $tag_ids;
        }
    }

    if ( $pegasso ) {
        $args['post_type'] = array('tutorial');
        $args['orderby'] = 'rand';
    }

    if ( 'prestador' == get_post_type() ) {
        $tag_ids = wp_get_post_tags( get_the_ID(), array( 'fields' => 'ids' ) );
        if ( !$tag_ids ) return false;

        $args['post_type'] = array('post');
        $args['posts_per_page'] = 6;
        $args['tag__in'] = $tag_ids;

    }

    
    $q = new WP_Query( $args );

    // if ( current_user_can( 'manage_options' ) ) {
    //     echo '<pre>'; 
    //         print_r( $q ); 
    //     echo '</pre>';
    // }

    $r = '';

    if( $q->have_posts() ):

        $titulo_widget = __( 'También te puede interesar', 'aessia' );
        
        if ( $pegasso ) {
            
            if ( is_singular( 'tutorial' ) ) {
                $titulo_widget = __( 'Relacionados', 'aessia' );
            } else {
                $titulo_widget = __( 'En Pegasso', 'aessia' );
            }
        }

        if ( is_singular( 'prestador' ) ) {
            $titulo_widget = sprintf( __( 'Noticias sobre %s', 'aessia' ), get_the_title() );
        }

        $r .= '<div class="widget">';


            if ( $in_row ) {
                $r .= '<div class="wrapper contenidos-relacionados">';
                    $r .= '<p class="h4">'. $titulo_widget .'</p>';
                    $r .= '<div class="row">';
            } else {
                $r .= '<p class="widget-title">'. $titulo_widget .'</p>';
                $r .= '<ul class="contenidos-relacionados">';
            }

            while( $q->have_posts() ) : $q->the_post();

                if ( $in_row ) {
                    $r .= '<div class="col-sm-6 col-md-4 mb-2 contenido-relacionado archive-post">';
                } else {
                    $r .= '<li class="contenido-relacionado archive-post">';
                }

                    if ( $pegasso ) {

                        $r .= '<div class="entry-header wp-block-buttons is-vertical mb-0">';

                            $r .= '<div class="wp-block-button is-style-arrow-link"><a href="'.get_the_permalink().'" title="'.get_the_title().'" class="wp-block-button__link">'.get_the_title().'</a></div>';

                        $r .= '</div>';

                    } else {

                        $r .= get_the_post_thumbnail( null, 'medium' );

                        $r .= '<div class="entry-header">';

                            $r .= '<div><a href="'.get_the_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></div>';

                        $r .= '</div>';

                        $r .= '<div class="widget-excerpt">' . get_the_excerpt() . '</div>';
                    }

                if ( $in_row ) {
                    $r .= '</div>';
                } else {
                    $r .= '</li>';
                }

            endwhile;

            if ( $in_row ) {
                    $r .= '</div>';
                $r .= '</div>';
            } else {
                $r .= '</ul>';
            }

        $r .= '</div>';

    endif;

    wp_reset_postdata();

    return $r;

}

function contenido_relacionado( $pegasso = false ) {
    echo get_contenido_relacionado( $pegasso );
}

function get_pegasso_title_breadcrumb() {
    return '<img src="'.get_stylesheet_directory_uri().'/img/pegasso-logo.svg" alt="'.__( 'Pegasso', 'aessia' ).'" class="logo-pegasso-breadcrumb" /><span class="breadcrumb-separator"> > </span>';
}

add_action('bcn_after_fill', 'bcnext_remove_current_item');
function bcnext_remove_current_item($trail) {

    if ( is_singular( 'post' ) ) {

        //Check to ensure the breadcrumb we're going to play with exists in the trail
        if(isset($trail->breadcrumbs[0]) && $trail->breadcrumbs[0] instanceof bcn_breadcrumb)
        {
            $types = $trail->breadcrumbs[0]->get_types();
            //Make sure we have a type and it is a current-item
            if(is_array($types) && in_array('current-item', $types))
            {
                //Shift the current item off the front
                array_shift($trail->breadcrumbs);
            }
        }

    }
}

add_filter( 'the_content', 'thumbs_rating_print' );
function thumbs_rating_print( $content ) {

    if ( !function_exists( 'thumbs_rating_getlink' ) ) return $content;
    
    if ( is_singular( array( 'post', 'tutorial', 'preguntas-frecuentes', 'guia', 'page' ) ) ) {

        if ( is_page() ) {
            $mostrar_valoracion = get_post_meta( get_the_ID(), 'mostrar_valoracion', true );
            if ( !$mostrar_valoracion ) return $content;
        }
    
        $content .= '<div class="aessia-rating my-2">';
            $content .= '<span class="rating-title">' . __( '¿Te ha resultado útil este artículo?', 'aessia' ) . '</span>';
            $content .= thumbs_rating_getlink();
        $content .= '</div>';
    
    }

    return $content;
}

if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'Ajustes web',
        'menu_title'    => 'Ajustes web',
        'menu_slug'     => 'ajustes-web',
        'capability'    => 'edit_pages',
        'redirect'      => false
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'Página de inicio',
        'menu_title'    => 'Página de inicio',
        'menu_slug'     => 'pagina-inicio',
        'capability'    => 'edit_pages',
        'icon'          => 'home',
        'parent_slug'   => 'ajustes-web',
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'Calculadora de Tarifas',
        'menu_title'    => 'Calculadora',
        'menu_slug'     => 'calculadora',
        'capability'    => 'edit_pages',
        'icon'          => 'calculator',
        'parent_slug'   => 'ajustes-web',
    ));
    
}

function aessia_formatear_precio( $float ) {

    $float = round ( $float, 2 );
    // $float = number_format( $float, 2, ",", "." );

    return $float;

}

// add_action( 'loop_start', 'aessia_mostrar_webinar_destacado', 5 );
function aessia_mostrar_webinar_destacado() {

    if ( !is_post_type_archive( 'tv' ) ) return false;

    $webinar_destacado = get_field( 'webinar_destacado', 'option' );

    if ( $webinar_destacado ) {

        global $post;
        $post = $webinar_destacado;
        setup_postdata( $post );

        get_template_part( 'loop-templates/content', 'destacado-webinar' );

        wp_reset_postdata();

        echo '<p class="has-antetitulo-font-size">'.__( 'Más webinars', 'aessia' ).'</p>';
    
    } 

}

add_filter( 'write_your_story', 'cambiar_content_placeholder', 10, 2 );
function cambiar_content_placeholder ( $text, $post ) {
    if ( 'tv' == $post->post_type ) {
        $text = __( 'Pega aquí la url del vídeo o un bloque html con el código de incrustación', 'aessia-admin' );
    } elseif ( 'funcionalidad' == $post->post_type ) {
        $text = __( 'Te recomendamos insertar un bloque "Pestañas" y, si quieres añadir más contenido debajo, añade un bloque "Más" y seguido el contenido que quieras. Teclea / para añadir un bloque.', 'aessia-admin' );
    }

    return $text;
}

function get_field_label_and_value( $key, $icon = '' ) {

    $field_object = get_field_object( $key );

    if ( $field_object['value'] ) {

        $r = '<span class="ficha-field-label">'.$field_object['label'].'</span>: <span class="ficha-field-value">'.$field_object['value'].'</span>';

        if ( $icon ) {
            $r = '<p class="icon-p ' . $icon . '">' . $r . '</p>';
        } else {
            $r = '<p>'.$r.'</p>';
        }

        return $r;

    }
}

function get_field_value( $key, $icon = '' ) {

    $field_value = get_field( $key );

    if ( $field_value ) {

        $r = '<span class="ficha-field-value">'.$field_value.'</span>';

        if ( $icon ) {
            $r = '<p class="icon-p ' . $icon . '">' . $r . '</p>';
        } else {
            $r = '<p>'.$r.'</p>';
        }

        return $r;
    }

    return false;
}

function get_localidad() {

    $localidad = get_field('localidad'); 
    $zonas = strip_tags( get_the_term_list( get_the_ID(), 'zona', '(', ' · ', ')' ) );
    $localidad_array = array();
    if($localidad) $localidad_array[] = $localidad;
    if($zonas) $localidad_array[] = $zonas;
    $localidad = implode(' ', $localidad_array);

    return $localidad;
}

function get_datos_prestador_card() {

    $r = '';

    $localidad = get_localidad();

    if ( $localidad ) $r .= '<p class="icon-p zona ficha-field-value">' . $localidad . '</p>';

    $r .= strip_tags( get_the_term_list( get_the_ID(), 'tipo_entidad', '<p class="tipo-entidad icon-p">', '</p><p class="tipo-entidad icon-p">', '</p>' ), '<p>' );

    $ambitos = strip_tags( get_the_term_list( get_the_ID(), 'ambito', '<li class="pertenencia-prestador">', '</li><li class="pertenencia-prestador">', '</li>' ), '<li>' );
    if ( $ambitos ) {

        // $r .= '<p class="ambitos">'.__( 'Ámbitos de actuación', 'aessia' ).'</p>';
        $r .= '<ul class="pertenencias-prestador">'.$ambitos.'</ul>';

    }

    return $r;

}

function get_datos_prestador() {

    $r = '';

    $r .= '<div class="mb-2">';

        $tipos_entidad = get_the_term_list( get_the_ID(), 'tipo_entidad', '', ' / ', '' );

        if ( $tipos_entidad ) {

            $r .= '<p class="icon-p tipo-entidad">';

                $r .= '<span class="ficha-field-label">' . __( 'Tipología', 'aessia' ) . ':</span> ';

                $r .= '<span class="ficha-field-value">';

                    $r .= strip_tags( $tipos_entidad );

                $r .= '</span>';

            $r .= '</p>';

        }

        $localidad = get_localidad();

        if ( $localidad ) $r .= '<p class="icon-p zona"><span class="ficha-field-label">'.get_field_object('localidad')['label'].':</span> <span class="ficha-field-value">' . $localidad . '</span></p>';

        $r .= get_field_label_and_value( 'nif', 'nif' );
        $r .= get_field_label_and_value( 'telefono_notificaciones', 'telefono' );
        $r .= get_field_label_and_value( 'email_notificaciones', 'email' );

        $sitio_web = get_field('sitio_web');

        if ( $sitio_web ) {
            $parsed = parse_url( $sitio_web );
            $link = $sitio_web;
            if ( empty ( $parsed['scheme'] ) ) {
                $link = 'http://' . ltrim( $sitio_web, '/');
            }
            $r .= '<p class="icon-p web"><span class="ficha-field-label">'. get_field_object( 'sitio_web')['label'].':</span> <span class="ficha-field-value"><a href="'. $link .'" target="_blank">' . $sitio_web . '</a></span></p>';
        }

        $r .= get_field( 'comentarios' );

    $r .= '</div>'; // .wrapper

    // foreach ( $tipos_entidad as $term ) {

    //     $r .= '<hr>';

    //     $r .= '<div class="mb-2">';

    //         $r .= '<p class="h4 icon-p tipo-entidad">'. $term->name .'</p>';

            // switch ( $term->term_id ) {

            //     case TERM_ID_INSTALADOR:

                    // $r .= get_field_label_and_value( 'numero_registro_industrial', 'sin-icono badge badge-pill badge-secondary' );

                    // $asociado_en = strip_tags( get_the_term_list( get_the_ID(), 'asociacion', '<li class="pertenencia-prestador">', '</li><li class="pertenencia-prestador">', '</li>' ), '<li>' );
                    // if ( $asociado_en ) $r .= '<ul class="pertenencias-prestador">'.$asociado_en.'</ul>';

                    // $ambitos = strip_tags( get_the_term_list( get_the_ID(), 'ambito', '<li class="pertenencia-prestador">', '</li><li class="pertenencia-prestador">', '</li>' ), '<li>' );
                    // if ( $ambitos ) {

                    //     $r .= '<p class="ambitos">'.__( 'Ámbitos de actuación', 'aessia' ).'</p>';
                    //     $r .= '<ul class="pertenencias-prestador">'.$ambitos.'</ul>';

                    // }

                    // $r .= get_field_label_and_value( 'vencimiento_iso9001_instalador' );
                    // $r .= get_field_label_and_value( 'vencimiento_carta_calidad_instalador' );

                    // $pdf_carta_instalador = get_field_object( 'pdf_carta_instalador' );
                    
                    // if ( $pdf_carta_instalador['value'] ) {

                    //     $r .= '<p class="icon-p cartas-calidad">';

                    //         $r .= '<a class="font-weight-bold" href="'.wp_get_attachment_url( $pdf_carta_instalador['value'] ).'" target="_blank">';

                    //             $r .= $pdf_carta_instalador['label'] .' [ ' . __( 'Descargar', 'aessia' ) . ']';

                    //         $r .= '</a>';

                    //         $r .= '<br>';

                    //         $r .= '<small>' . sprintf( __( '<a href="%s" target="_blank">¿Qué son las Cartas de Calidad?</a>', 'aessia' ), get_home_url( null, '/cartas-calidad/' ) ) . '</a></small>';

                    //     $r .= '</p>'; 

                    // }

                //     break;
                
                // case TERM_ID_INGENIERIA:

                    // $r .= get_field_label_and_value( 'numero_colegiado', 'sin-icono badge badge-pill badge-secondary' );

                    // $colegiado_en = strip_tags( get_the_term_list( get_the_ID(), 'colegiatura', '<li class="pertenencia-prestador">', '</li><li class="pertenencia-prestador">', '</li>' ), '<li>' );
                    // if ( $colegiado_en ) $r .= '<ul class="pertenencias-prestador">'.$colegiado_en.'</ul>';

                    // $r .= get_field_label_and_value( 'vencimiento_iso9001_ingeniería' );
                    // $r .= get_field_label_and_value( 'vencimiento_carta_calidad_ingenieria' );

                    // $pdf_carta_ingenieria = get_field_object( 'pdf_carta_ingenieria' );

                    // if ( $pdf_carta_ingenieria['value'] ) {

                    //     $r .= '<p class="icon-p cartas-calidad">';

                    //         $r .= '<a class="font-weight-bold" href="'.wp_get_attachment_url( $pdf_carta_ingenieria['value'] ).'" target="_blank">';

                    //             $r .= $pdf_carta_ingenieria['label'] .' [ ' . __( 'Descargar', 'aessia' ) . ']';

                    //         $r .= '</a>';

                    //         $r .= '<br>';

                    //         $r .= '<small>' . sprintf( __( '<a href="%s" target="_blank">¿Qué son las Cartas de Calidad?</a>', 'aessia' ), get_home_url( null, '/cartas-calidad/' ) ) . '</a></small>';

                    //     $r .= '</p>'; 

                    // }

            //         break;
                
            //     default:
            //         # code...
            //         break;
            // }

    //     $r .= '</div>';

    // }

    return $r;   
}

function get_fields_cards_prestador() {

    $r = '';

    $col_class = 'col-sm-6 col-md-4 mb-2';

    $r .= get_card_cartas_de_calidad_prestador( $col_class );

    $r .= get_card_iso_9001_prestador( $col_class );

    $r .= get_card_numero_registro_y_colegiado_prestador( $col_class );

    $r .= get_card_pertenencias_prestador( $col_class );

    if ( $r ) {

        $return = '<div class="row">';

            $return .= $r;

        $return .= '</div>';

        return $return;
    }


}

function get_card_cartas_de_calidad_prestador( $col_class = 'col-sm-6 col-md-4' ) {

    $titulo = false;
    $r = '';
    $output = '';

    $pdfs = array();

    $pdf_carta_instalador = get_field_object( 'pdf_carta_instalador' );
    $pdf_carta_ingenieria = get_field_object( 'pdf_carta_ingenieria' );


    if( $pdf_carta_instalador['value'] ) $pdfs[] = $pdf_carta_instalador;
    if( $pdf_carta_ingenieria['value'] ) $pdfs[] = $pdf_carta_ingenieria;

    foreach ( $pdfs as $pdf ) {

        $r = '';

        $titulo = $pdf['label'];

        switch ( $pdf ) {
            case $pdf_carta_instalador:
                $fecha_vencimiento = get_field('vencimiento_carta_calidad_instalador');
                break;
            
            case $pdf_carta_ingenieria:
                $fecha_vencimiento = get_field('vencimiento_carta_calidad_ingenieria');
                break;
            
            default:
                # code...
                break;
        }


        if ( $fecha_vencimiento ) {

            $r .= '<p>' . sprintf( __( 'Vence el %s', 'aessia' ), $fecha_vencimiento ) . '</p>';

        }

        $r .= '<p><a class="btn btn-primary btn-pill" href="'.wp_get_attachment_url( $pdf['value'] ).'" target="_blank">';

            $r .= __( 'Ver', 'aessia' );

        $r .= '</a></p>';

        $field_mas_info = get_field_object( 'que_son_las_cartas_de_calidad', 'option' );

        if ( $field_mas_info['value'] ) {

            $r .= '<p class="card-mas-info"><a href="' . $field_mas_info['value'] . '" title="' . $field_mas_info['label'] . '" target="_blank">' . $field_mas_info['label'] . '</a></p>';

        }



        if ( $r ) {

            $output .= '<div class="'.$col_class.'">';

                $output .= get_tarjeta( $titulo, $r, false, false, '_blank' );

            $output .= '</div>';

        }

    }


    return $output;

}

function get_card_iso_9001_prestador( $col_class = 'col-sm-6 col-md-4' ) {

    $r = '';
    $output = '';

    $fields = array();

    $fields[] = get_field_object( 'vencimiento_iso9001_instalador' );
    $fields[] = get_field_object( 'vencimiento_iso9001_ingeniería' );


    foreach ( $fields as $field_obj ) {

        $r = '';

        if ( $field_obj['value'] ) {

            $r .= '<p>' . sprintf( __( 'Vence el %s', 'aessia' ), $field_obj['value'] ) . '</p>';

            $field_mas_info = get_field_object( 'que_es_la_ISO_9001', 'option' );

            if ( $field_mas_info && $field_mas_info['value'] ) {

                $r .= '<p class="card-mas-info"><a href="' . $field_mas_info['value'] . '" title="' . $field_mas_info['label'] . '" target="_blank">' . $field_mas_info['label'] . '</a></p>';

            }

             

        }

        if ( $r ) {

            $output .= '<div class="'.$col_class.'">';

                $output .= get_tarjeta( $field_obj['label'], $r, false, false, '_blank' );

            $output .= '</div>';
        }

    }

    return $output;

}


function get_card_numero_registro_y_colegiado_prestador( $col_class = 'col-sm-6 col-md-4' ) {

    $r = '';
    $output = '';

    $fields = array();

    $field_numero_registro = get_field_object( 'numero_registro_industrial' );
    $field_numero_colegiado = get_field_object( 'numero_colegiado' );

    if ( $field_numero_registro['value'] ) $fields[] = $field_numero_registro;
    if ( $field_numero_colegiado['value'] ) $fields[] = $field_numero_colegiado;

    foreach ( $fields as $field ) {

        $r = '';

        switch ( $field ) {
            case $field_numero_registro:
                $field_mas_info = get_field_object( 'que_es_el_registro_industrial_instalador', 'option' );
                break;
            
            case $field_numero_colegiado:
                $field_mas_info = get_field_object( 'que_es_el_numero_de_colegiado', 'option' );
                break;
            
            default:
                $field_mas_info = false;
                break;
        }

        $titulo = $field['value'];
        $r .= '<p>' . $field['label'] . '</p>';

        if ( $field_mas_info && $field_mas_info['value'] ) {
            $r .= '<p class="card-mas-info"><a href="' . $field_mas_info['value'] . '" title="' . $field_mas_info['label'] . '" target="_blank">' . $field_mas_info['label'] . '</a></p>';
        }

        $output .= '<div class="'.$col_class.'">';

            $output .= get_tarjeta( $titulo, $r );

        $output .= '</div>';

    }


    return $output;

}


function get_card_pertenencias_prestador( $col_class = 'col-sm-6 col-md-4' ) {

    $r = '';
    $output = '';

    $taxonomias = array(
        'colegiatura',
        'asociacion'
    );

    $terms = wp_get_object_terms( get_the_ID(), $taxonomias );

    foreach ( $terms as $term ) {

        $r = '';

        $titulo_corto = get_field( 'titulo_corto', $term );
        if ( !$titulo_corto ) $titulo_corto = $term->name;
        $link = get_term_meta( $term->term_id, 'term_link', true );
        
        switch ( $term->taxonomy ) {
            case 'colegiatura':
                $titulo = sprintf( __( 'Colegiado en %s', 'aessia' ), $titulo_corto );
                $string_que_es = __( '¿Qué es el %s?', 'aessia' );
                break;
            
            case 'asociacion':
                $titulo = sprintf( __( 'Asociado a %s', 'aessia' ), $titulo_corto );
                $string_que_es = __( '¿Qué es la %s?', 'aessia' );
                break;
            
            default:
                $titulo = sprintf( __( 'Miembro de %s', 'aessia' ), $titulo_corto );
                $string_que_es = __( '¿Qué es %s?', 'aessia' );
                break;
        }

        if ( $link ) {
            $titulo = '<a class="ljoptimizer" href="' . $link . '" target="_blank">'. $titulo .'</a>';
            $titulo = apply_filters( 'the_content', $titulo );
        }

        $r .= wpautop( $term->name );

        $link_mas_info = get_field( 'post_relacionado', $term );
        if ( $link_mas_info ) {
            $r .= '<p><a href="' . $link_mas_info . '" title="' . sprintf( __( '¿Qué es %s?', 'aessia' ), $titulo_corto ) . '" target="_blank">' . sprintf( $string_que_es, $titulo_corto ) . '</a></p>';
        }

        if ( $r ) {

            $output .= '<div class="'.$col_class.'">';

                $output .= get_tarjeta( $titulo, $r );

            $output .= '</div>';
        }



    }
    
    return $output;

}

function get_ambitos_prestador() {

    $r = '';

    // $ambitos = strip_tags( get_the_term_list( get_the_ID(), 'ambito', '<li class="pertenencia-prestador">', '</li><li class="pertenencia-prestador">', '</li>' ), '<li>' );
    $ambitos = strip_tags( get_the_term_list( get_the_ID(), 'ambito', '<div class="ambito col-sm-6 col-md-4 mb-1"><p class="icon-p">', '</p></div><div class="ambito col-sm-6 col-md-4 mb-1"><p class="icon-p">', '</div>' ), '<div><p>' );
    if ( $ambitos ) {

        $r .= '<div class="wrapper ambitos-actuacion">';

            $r .= '<p class="h4 ambitos">'.__( 'Ámbitos de actuación', 'aessia' ).'</p>';

            $r .= '<div class="row">';

                $r .= $ambitos;

            $r .= '</div>';

        $r .= '</div>';

    }

    return $r;

}


add_action('cf7_2_post_form_submitted_to_prestador_potencial', 'new_prestador_potencial_mapped',10,4);
  /**
  * Function to take further action once form has been submitted and saved as a post.  Note this action is only fired for submission which has been submitted as opposed to saved as drafts.
  * @param string $post_id new post ID to which submission was saved.
  * @param array $cf7_form_data complete set of data submitted in the form as an array of field-name=>value pairs.
  * @param string $cf7form_key unique key to identify your form.
  * @param array $submitted_files array of files submitted in the form, if any file fields are present.
  */
function new_prestador_potencial_mapped($post_id, $cf7_form_data, $cf7form_key, $submitted_files){

    if ( $cf7form_key != 'alta-prestador-usuario-pegasso' ) return;

    $taxonomy = 'tipo_entidad';

    // $field_instalador = get_post_meta( $post_id, 'instalador', true );
    // $field_ingenieria = get_post_meta( $post_id, 'ingenieria', true );

    if ( $cf7_form_data['your-soy-instalador'] ) {
        wp_set_object_terms( $post_id, TERM_ID_INSTALADOR, $taxonomy, true );
    } else {
        wp_remove_object_terms( $post_id, TERM_ID_INSTALADOR, $taxonomy );
    }

    if ( $cf7_form_data['your-soy-ingenieria'] ) {
        wp_set_object_terms( $post_id, TERM_ID_INGENIERIA, $taxonomy, true );
    } else {
        wp_remove_object_terms( $post_id, TERM_ID_INGENIERIA, $taxonomy );
    }

}

add_filter( 'wpcf7_mail_tag_replaced', 'aessia_filtrar_contact_form_7_tags', 10, 4);
 function aessia_filtrar_contact_form_7_tags( $replaced, $submitted, $html, $mail_tag ) {

    $field_name = $mail_tag->field_name();
    $taxonomy = false;

    switch ( $field_name ) {
        case 'your-state':
            $taxonomy = 'zona';
            break;
        
        case 'your-asociacion':
            $taxonomy = 'asociacion';
            break;
        
        case 'your-colegio':
            $taxonomy = 'colegiatura';
            break;
        
        case 'your-ambito':
            $taxonomy = 'ambito';
            break;
        
        default:
            $taxonomy = false;
            break;
    }

    if ( $taxonomy ) {

        if ( is_numeric( $submitted ) ) {

            $term_name = get_term( intval( $submitted ) )->name;
            $replaced = $term_name;

        } elseif ( is_array( $submitted ) ) {

                $terms = get_terms( array(
                    'taxonomy'      => $taxonomy,
                    'include'       => $submitted,
                    'fields'        => 'names',
                    'hide_empty'    => false,
                ) );

                $replaced = implode( PHP_EOL, $terms );

        }

    }

    return $replaced;

}

function get_vcard() {

    wp_enqueue_script( 'qr-code-and-vcard' );

    // unserialize
    // wqm_url
    // wqm_adr
    // wqm_email
    // wqm_tel
    // wqm_n - nombre

    ob_start(); ?>

    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/QrCode.min.js" type="application/javascript"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/vcard.js" type="application/javascript"></script>

    <a href="#descargar-vcard" id="export-vcard-link" class="vcard-section">
        <div id="qr_vcard"></div>
        <!-- <pre id="vcardcanvas"></pre> -->
        <p><?php _e( 'Descargar en mi móvil datos de contacto vCARD', 'aessia' ); ?></p>
    </a>

    <script>

        var qrCard = {
            version: '3.0',
            lastName: '',
            middleName: '',
            firstName: '<?php the_title(); ?>',
            organization: '<?php the_title(); ?>',
            workPhone: '<?php echo get_field('telefono_notificaciones'); ?>',
            workEmail: '<?php echo get_field('email_notificaciones'); ?>',
            // url: 'http://acemecompany/johndoe',
            workUrl: '<?php echo get_field('sitio_web'); ?>',

            workAddress: {
                label: 'Dirección del trabajo',
                // street: '123 Corporate Loop\nSuite 500',
                city: '<?php echo get_field('localidad'); ?>',
                // stateProvince: 'CA',
                // postalCode: '54321',
                // countryRegion: 'California Republic'
            },
    
        };

        function GenerarVcard() {
    
            var person = vCard.create(vCard.Version.THREE);
            person.add(vCard.Entry.FORMATTEDNAME, '<?php the_title(); ?>');
            person.add(vCard.Entry.NAME, '<?php the_title(); ?>');
            person.add(vCard.Entry.EMAIL, '<?php echo get_field('email_notificaciones'); ?>', vCard.Type.WORK);

            // person.add(vCard.Entry.LOGO, base64imgLogo, ';ENCODING=b;TYPE='+ typeLogo );
            // person.add(vCard.Entry.PHOTO, base64imgFoto, ';ENCODING=b;TYPE='+ typeFoto);

            person.add(vCard.Entry.PHONE, '<?php echo get_field('telefono_notificaciones'); ?>', vCard.Type.WORK);
            person.add(vCard.Entry.ADDRESS, ";;"+'<?php echo get_field('localidad'); ?>', vCard.Type.WORK);
            person.add(vCard.Entry.ORGANIZATION, '<?php the_title(); ?>');
            person.add(vCard.Entry.URL, '<?php echo get_field('sitio_web'); ?>');

            var link = vCard.export(person, '<?php the_title(); ?>', false) // use parameter true to force download
            // jQuery('#export-vcard-link')[0].appendChild(link);
      
        }

        // document.getElementById('vcardcanvas').innerHTML = qrCode.createVCard(qrCard);
        document.getElementById('qr_vcard').innerHTML = qrCode.createVCardQr(qrCard, {
            typeNumber: 15, 
            cellSize: 4
        });
        


    
        jQuery(document).ready(function() {
            jQuery('#export-vcard-link').click( function(e) {
                e.preventDefault();
                GenerarVcard();
                // var elemremove1 = jQuery('#vcardcanvas');
                // elemremove1.remove();
            });
        });

    
    </script> 

    <?php return ob_get_clean();

}

function aessia_double_button() { ?>

    <div class="btn-double js-btn-double">

        <div class="btn-double__wrap">
            <a class="btn-double__main-action wp-block-button__link btn btn-outline-primary js-btn-double-default" href="https://www.pegasso.org/pegasso/inicio.public">Acceso a Pegasso</a>
            <div class="btn-double__more js-btn-double-more">+</div>
        </div>
        
        <div class="btn-double__options js-btn-double-options">
            <a class="btn-double__options__option js-btn-double-rite js-btn-double-option" data-pegasso-option="btrite" data-pegasso-button-text="Baja tensión + RITE" href="https://www.pegasso.org/pegasso/inicio.public">
            <strong>Acceso a Pegasso Baja Tensión + RITE</strong>
            <p>Descripción de Pegasso Baja Tensión + RITE en dos líneas</p>
            </a>
            <a class="btn-double__options__option js-btn-double-incendios js-btn-double-option" data-pegasso-option="incendios" data-pegasso-button-text="Incendios" href="https://www.pegasso.org/">
            <strong>Acceso a Pegasso Incendios</strong>
            <p>Descripción de Pegasso Incendios en dos líneas</p>
            </a>
        </div>

    </div>

<?php }

/**
* Add a custom link to the end of a specific menu that uses the wp_nav_menu() function
*/
// add_filter('wp_nav_menu_items', 'aessia_add_double_button_link', 10, 2);
function aessia_add_double_button_link($items, $args){
    if( $args->theme_location == 'primary' ){
        ob_start();
        aessia_double_button();
        $item = ob_get_clean();

        $items .= $item;
    }
    return $items;
}

function aessia_get_datos_formacion() {

    $fields = get_field_objects();


    $r = '';

    if ( $fields ) {

        unset( $fields['url'] );

        // $r .= '<div class="">';


            foreach ( $fields as $key => $field_object ) {
  
                $append = '';
                if ( isset( $field_object['append'] ) ) $append = $field_object['append'];

                $class = '';
                if ( isset( $field_object['wrapper']['class'] ) ) $class = $field_object['wrapper']['class'];
                
                if ( $field_object['value'] ) {

                    $r .= '<div class="ficha-field mb-2">';
                        $r .= '<div class="ficha-field-label d-flex"><span class="ficha-field-icon ' . $class . '"></span><span>' . $field_object['label'] . '</span></div>';
                        $r .= '<div class="ficha-field-value">' . $field_object['value'] . $append . '</div>';
                    $r .= '</div>';

                }

            }


        // $r .= '</div>';

        $r .= aessia_get_boton_inscripcion_formacion();
    
    }

    return $r;
    
}

function aessia_datos_formacion() {
    echo aessia_get_datos_formacion();
}

function aessia_get_resumen_datos_formacion() {

    $fields = get_field_objects();


    $r = '';

    if ( $fields ) {

        unset( $fields['url'] );

        foreach ( $fields as $key => $field_object ) {

            $append = '';
            if ( isset( $field_object['append'] ) ) $append = $field_object['append'];

            $class = '';
            if ( isset( $field_object['wrapper']['class'] ) ) $class = $field_object['wrapper']['class'];

            if ( $field_object['value'] ) {

                $r .= '<div class="ficha-field">';
                    $r .= '<div class="ficha-field-value d-flex"><span class="ficha-field-icon ' . $class . '"></span><span>' . $field_object['value'] . $append . '</span></div>';
                $r .= '</div>';

            }

        }
    
    }

    return $r;
    
}

function aessia_get_boton_inscripcion_formacion() {
    $url = get_post_meta( get_the_ID(), 'url', true );
    if ( $url ) {
        $r = '<p><a class="btn btn-secondary" href="'.$url.'" target="_blank" rel="noopener noreferrer nofollow">'.__( 'Quiero inscribirme', 'aessia' ).'</a></p>';
        return $r;
    }
}

function aessia_boton_inscripcion_formacion() {
    echo aessia_get_boton_inscripcion_formacion();
}