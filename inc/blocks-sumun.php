<?php 
function sumun_nocookie_youtube_block( $block_content, $block ) {
    // echo '<pre>'; print_r($block); echo '</pre>';

    $aviso = '<p class="small text-muted">' . __( 'Al reproducir el vídeo aceptas la <a href="https://policies.google.com/technologies/cookies?hl=es" target="_blank" rel="nofollow">política de cookies y de privacidad de Google</a>.', 'sumun' ) . '</p>';
    if ( function_exists( 'gdpr_cookie_is_accepted' ) ) {
        if ( gdpr_cookie_is_accepted( 'thirdparty' ) ) {
            $aviso = '';
        }
    }

    if ( $block['blockName'] === 'core-embed/youtube' ) {
        $block_content = str_replace('www.youtube.com', 'www.youtube-nocookie.com', $block_content);
        $block_content .= $aviso;
    }
    if ( $block['blockName'] === 'acf/video-emergente' ) {
        $block_content .= $aviso;
    }
    return $block_content;
}
 
add_filter( 'render_block', 'sumun_nocookie_youtube_block', 10, 2 );

add_action('acf/init', 'sumun_init_block_types');
function sumun_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        acf_register_block_type(array(
            'name'              => 'tarjeta',
            'title'             => __('Tarjeta'),
            'description'       => __('Bloque rectangular de color o con imagen para destacar información'),
            'render_template'   => 'block-templates/tarjeta.php',
            'category'          => 'text',
            'icon'              => 'index-card',
            'keywords'          => array( 'card', 'tarjeta', 'imagen' ),
            'mode'              => 'edit',
        ));

        acf_register_block_type(array(
            'name'              => 'tarjetas',
            'title'             => __('Grupo de Tarjetas'),
            'description'       => __('Obtiene posts en forma de tarjetas'),
            'render_template'   => 'block-templates/tarjetas.php',
            'category'          => 'text',
            'icon'              => 'index-card',
            'keywords'          => array( 'card', 'tarjeta', 'imagen' ),
            'mode'              => 'edit',
        ));

        acf_register_block_type(array(
            'name'              => 'tabs',
            'title'             => __('Pestañas'),
            'description'       => __('Muestra contenido en forma de pestañas'),
            'render_template'   => 'block-templates/tabs.php',
            'category'          => 'text',
            'icon'              => 'table-row-after',
            'keywords'          => array( 'tabs', 'pestaña', 'contenido' ),
            'mode'              => 'edit',
        ));

        acf_register_block_type(array(
            'name'              => 'calculadora-tarifas',
            'title'             => __('Calculadora de tarifas'),
            'description'       => __('Calcula las tarifas'),
            'render_template'   => 'block-templates/calculadora.php',
            'category'          => 'widgets',
            'icon'              => 'calculator',
            'keywords'          => array( 'tarifas', 'precios', 'calculadora' ),
            'mode'              => 'edit',
            'supports'          => array( 'mode' => false ),
        ));

        acf_register_block_type(array(
            'name'              => 'enlaces-destacados',
            'title'             => __('Enlaces destacados'),
            'description'       => __('Conjunto de enlaces en forma de lista'),
            'render_template'   => 'block-templates/enlaces-destacados.php',
            'category'          => 'text',
            'icon'              => 'admin-links',
            'keywords'          => array( 'enlaces', 'destacados', 'lista' ),
            'mode'              => 'edit',
            'supports'          => array( 'mode' => false ),
        ));

        acf_register_block_type(array(
            'name'              => 'team',
            'title'             => __('Profesor / Miembro'),
            'description'       => __('Muestra una tarjeta con los detalles de una persona'),
            'render_template'   => 'block-templates/team.php',
            'category'          => 'design',
            'icon'              => 'id',
            'keywords'          => array( 'equipo', 'miembro', 'team', 'profesor', 'persona' ),
            'mode'              => 'edit',
            'supports'          => array( 'mode' => false ),
        ));

        acf_register_block_type(array(
            'name'              => 'accordion',
            'title'             => __('Acordeón'),
            'description'       => __('Muestra un desplegable'),
            'render_template'   => 'block-templates/accordion.php',
            'category'          => 'design',
            'icon'              => 'id',
            'keywords'          => array( 'acordeon', 'accordion', 'toggle', 'desplegable' ),
            'mode'              => 'edit',
            'supports'          => array( 'mode' => false ),
        ));


    }
}

add_filter('acf/load_field/name=post_type', 'acf_load_post_types');
function acf_load_post_types( $field )
{
    foreach ( get_post_types( array( 'public' => true ), 'names' ) as $post_type ) {
       $field['choices'][$post_type] = $post_type;
    }

    // return the field
    return $field;
}

add_filter('acf/load_field/name=taxonomy', 'acf_load_taxonomies');
function acf_load_taxonomies( $field )
{
    foreach ( get_taxonomies( array( 'public' => true ), 'names' ) as $taxonomy ) {
       $field['choices'][$taxonomy] = $taxonomy;
    }

    // return the field
    return $field;
}

add_filter('acf/load_field/name=term', 'acf_load_terms');
function acf_load_terms( $field )
{
    $taxonomies = get_taxonomies( array( 'public' => true ), 'objects' );

    foreach ( $taxonomies as $taxonomy ) {
        $label = $taxonomy->labels->name;
        $terms = get_terms( array( 'taxonomy' => $taxonomy->name, 'hide_empty' => false ) );

        foreach ($terms as $term) {
            $field['choices'][$term->term_id] = $label . ' - ' . $term->name;
        }
    }

    // return the field
    return $field;
}

add_filter( 'render_block', 'sumun_bootstrap_buttons', 10, 2 );
function sumun_bootstrap_buttons( $block_content, $block ) {

    if ( $block['blockName'] !== 'core/button' ) return $block_content;

    // echo '<pre>'; print_r($block['attrs']); echo '</pre>';

    if ( isset( $block['attrs']['className'] ) && strpos( $block['attrs']['className'], 'is-style-arrow-link' ) !== false ) return $block_content;

    if ( isset( $block['attrs']['className'] ) && strpos( $block['attrs']['className'], 'is-style-outline' ) !== false ) {

        $block_content = str_replace( 'is-style-outline', '', $block_content);
        $block_content = str_replace( 'wp-block-button__link', 'wp-block-button__link btn btn-outline-primary', $block_content);

        return $block_content;

    }

    $block_content = str_replace( 'wp-block-button__link', 'wp-block-button__link btn btn-primary', $block_content);
    return $block_content;

}

add_filter( 'render_block', 'sumun_block_list', 10, 2 );
function sumun_block_list( $block_content, $block ) {

    if ( $block['blockName'] !== 'core/list' ) return $block_content;

    return '<div class="wp-block-list">' . $block_content . '</div>';

}