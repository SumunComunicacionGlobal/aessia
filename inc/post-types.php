<?php 
add_post_type_support( 'page', 'excerpt' );
// add_action( 'init', 'sumun_settings', 1000 );
function sumun_settings() {  
    // register_taxonomy_for_object_type('category', 'page');  
}


if ( ! function_exists('custom_post_type_slide') ) {

// Register Custom Post Type
function custom_post_type_slide() {

	$labels = array(
		'name'                  => _x( 'Slides', 'Post Type General Name', 'sumun' ),
		'singular_name'         => _x( 'Slide', 'Post Type Singular Name', 'sumun' ),
		'menu_name'             => __( 'Slides', 'sumun-admin' ),
		'name_admin_bar'        => __( 'Slides', 'sumun-admin' ),
		'add_new'               => __( 'Añadir nueva Slide', 'sumun-admin' ),
		'new_item'              => __( 'Nueva Slide', 'sumun-admin' ),
		'edit_item'             => __( 'Editar Slide', 'sumun-admin' ),
		'update_item'           => __( 'Actualizar Slide', 'sumun-admin' ),
		'view_item'             => __( 'Ver Slide', 'sumun-admin' ),
		'view_items'            => __( 'Ver Slides', 'sumun-admin' ),
	);
	$args = array(
		'label'                 => __( 'Slides', 'sumun' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 3,
		'menu_icon'             => 'dashicons-slides',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest' 			=> true,
		'taxonomies'			=> array(),
	);
	register_post_type( 'slide', $args );

}
// add_action( 'init', 'custom_post_type_slide', 0 );

}


add_post_type_support( 'page', 'excerpt' );

if ( ! function_exists('prestador_custom_post_type') ) {

// Register Custom Post Type
function prestador_custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Prestadores de servicios', 'Post Type General Name', 'aessia' ),
		'singular_name'         => _x( 'Prestador de servicios', 'Post Type Singular Name', 'aessia' ),
		'menu_name'             => __( 'Prestadores', 'aessia-admin' ),
		'name_admin_bar'        => __( 'Prestador', 'aessia-admin' ),
		'archives'              => __( 'Archivos de Prestadores', 'aessia-admin' ),
		'attributes'            => __( 'Atributo de Prestador', 'aessia-admin' ),
		'parent_item_colon'     => __( 'Prestador superior:', 'aessia-admin' ),
		'all_items'             => __( 'Todos los Prestadores', 'aessia-admin' ),
		'add_new_item'          => __( 'Añadir nuevo Prestador', 'aessia-admin' ),
		'add_new'               => __( 'Añadir nuevo', 'aessia-admin' ),
		'new_item'              => __( 'Nuevo Prestador', 'aessia-admin' ),
		'edit_item'             => __( 'Editar Prestador', 'aessia-admin' ),
		'update_item'           => __( 'Actualizar Prestador', 'aessia-admin' ),
		'view_item'             => __( 'Ver Prestador', 'aessia-admin' ),
		'view_items'            => __( 'Ver Prestadores', 'aessia-admin' ),
		'search_items'          => __( 'Buscar Prestador', 'aessia-admin' ),
		'not_found'             => __( 'No encontrado', 'aessia-admin' ),
		'not_found_in_trash'    => __( 'No encontrado en la papelera', 'aessia-admin' ),
		'featured_image'        => __( 'Imagen principal', 'aessia-admin' ),
		'set_featured_image'    => __( 'Establecer Imagen principal', 'aessia-admin' ),
		'remove_featured_image' => __( 'Quitar Imagen principal', 'aessia-admin' ),
		'use_featured_image'    => __( 'Usar como Imagen principal', 'aessia-admin' ),
		'insert_into_item'      => __( 'Insertar en el Prestador', 'aessia-admin' ),
		'uploaded_to_this_item' => __( 'Subido a este Prestador', 'aessia-admin' ),
		'items_list'            => __( 'Lista de Prestadores', 'aessia-admin' ),
		'items_list_navigation' => __( 'Navegación de la lista de Prestadores', 'aessia-admin' ),
		'filter_items_list'     => __( 'Filtrar lista de Prestadores', 'aessia-admin' ),
	);
	$args = array(
		'label'                 => __( 'Prestador', 'aessia-admin' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'author', 'custom-fields', 'revisions' ),
		'taxonomies'            => array( 'zona', 'colegiatura', 'asociacion', 'ambito', 'tipo_entidad', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-nametag',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		// 'has_archive'           => __( 'seguridad-industrial/prestadores/directorio', 'aessia' ),
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => array(
										'slug'			=> __( 'seguridad-industrial/prestadores' ),
									),
		'query_var'				=> true,
		'capability_type'       => 'post',
		'show_in_rest'          => false,
	);
	register_post_type( 'prestador', $args );

}
add_action( 'init', 'prestador_custom_post_type', 10 );

}

if ( ! function_exists('prestador_potencial_custom_post_type') ) {

// Register Custom Post Type
function prestador_potencial_custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Prestadores potenciales', 'Post Type General Name', 'aessia' ),
		'singular_name'         => _x( 'Prestador potencial', 'Post Type Singular Name', 'aessia' ),
		'menu_name'             => __( 'Prestadores potenciales', 'aessia-admin' ),
		'name_admin_bar'        => __( 'Prestador', 'aessia-admin' ),
		'archives'              => __( 'Archivos de Prestadores', 'aessia-admin' ),
		'attributes'            => __( 'Atributo de Prestador', 'aessia-admin' ),
		'parent_item_colon'     => __( 'Prestador superior:', 'aessia-admin' ),
		'all_items'             => __( 'Todos los Prestadores potenciales', 'aessia-admin' ),
		'add_new_item'          => __( 'Añadir nuevo Prestador', 'aessia-admin' ),
		'add_new'               => __( 'Añadir nuevo', 'aessia-admin' ),
		'new_item'              => __( 'Nuevo Prestador', 'aessia-admin' ),
		'edit_item'             => __( 'Editar Prestador', 'aessia-admin' ),
		'update_item'           => __( 'Actualizar Prestador', 'aessia-admin' ),
		'view_item'             => __( 'Ver Prestador', 'aessia-admin' ),
		'view_items'            => __( 'Ver Prestadores', 'aessia-admin' ),
		'search_items'          => __( 'Buscar Prestador', 'aessia-admin' ),
		'not_found'             => __( 'No encontrado', 'aessia-admin' ),
		'not_found_in_trash'    => __( 'No encontrado en la papelera', 'aessia-admin' ),
		'featured_image'        => __( 'Imagen principal', 'aessia-admin' ),
		'set_featured_image'    => __( 'Establecer Imagen principal', 'aessia-admin' ),
		'remove_featured_image' => __( 'Quitar Imagen principal', 'aessia-admin' ),
		'use_featured_image'    => __( 'Usar como Imagen principal', 'aessia-admin' ),
		'insert_into_item'      => __( 'Insertar en el Prestador', 'aessia-admin' ),
		'uploaded_to_this_item' => __( 'Subido a este Prestador', 'aessia-admin' ),
		'items_list'            => __( 'Lista de Prestadores', 'aessia-admin' ),
		'items_list_navigation' => __( 'Navegación de la lista de Prestadores', 'aessia-admin' ),
		'filter_items_list'     => __( 'Filtrar lista de Prestadores', 'aessia-admin' ),
	);
	$args = array(
		'label'                 => __( 'Prestador potencial', 'aessia-admin' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'author', 'custom-fields', 'revisions' ),
		'taxonomies'            => array( 'zona', 'colegiatura', 'asociacion', 'ambito', 'tipo_entidad', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-nametag',
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'query_var'				=> true,
		'capability_type'       => 'post',
		'show_in_rest'          => false,
	);
	register_post_type( 'prestador_potencial', $args );

}
add_action( 'init', 'prestador_potencial_custom_post_type', 10 );

}

if ( ! function_exists( 'zona_custom_taxonomy' ) ) {

// Register Custom Taxonomy
function zona_custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Provincias', 'Taxonomy General Name', 'aessia' ),
		'singular_name'              => _x( 'Provincia', 'Taxonomy Singular Name', 'aessia' ),
		'menu_name'                  => __( 'Provincia', 'aessia-admin' ),
		'all_items'                  => __( 'Todas las Provincias', 'aessia-admin' ),
		'parent_item'                => __( 'Provincia superior', 'aessia-admin' ),
		'parent_item_colon'          => __( 'Provincia superior:', 'aessia-admin' ),
		'new_item_name'              => __( 'Nombre de la nueva Provincia', 'aessia-admin' ),
		'add_new_item'               => __( 'Añadir nueva Provincia', 'aessia-admin' ),
		'edit_item'                  => __( 'Editar Provincia', 'aessia-admin' ),
		'update_item'                => __( 'Actualizar Provincia', 'aessia-admin' ),
		'view_item'                  => __( 'Ver Provincia', 'aessia-admin' ),
		'separate_items_with_commas' => __( 'Separar Provincias con comas', 'aessia-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Provincias', 'aessia-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre las más usadas', 'aessia-admin' ),
		'popular_items'              => __( 'Provincias más usadas', 'aessia-admin' ),
		'search_items'               => __( 'Buscar', 'aessia-admin' ),
		'not_found'                  => __( 'No encontrada', 'aessia-admin' ),
		'no_terms'                   => __( 'No hay Provincias', 'aessia-admin' ),
		'items_list'                 => __( 'Lista de Provincias', 'aessia-admin' ),
		'items_list_navigation'      => __( 'Lista de navegación de Provincias', 'aessia-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => false,
		'show_in_rest'               => false,
	);
	register_taxonomy( 'zona', array( 'prestador' ), $args );

}
add_action( 'init', 'zona_custom_taxonomy', 0 );

}

if ( ! function_exists( 'colegiatura_custom_taxonomy' ) ) {

// Register Custom Taxonomy
function colegiatura_custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Colegiaturas', 'Taxonomy General Name', 'aessia' ),
		'singular_name'              => _x( 'Colegiatura', 'Taxonomy Singular Name', 'aessia' ),
		'menu_name'                  => __( 'Colegiaturas', 'aessia-admin' ),
		'all_items'                  => __( 'Todas las Colegiaturas', 'aessia-admin' ),
		'parent_item'                => __( 'Colegiatura superior', 'aessia-admin' ),
		'parent_item_colon'          => __( 'Colegiatura superior:', 'aessia-admin' ),
		'new_item_name'              => __( 'Nombre de la nueva Colegiatura', 'aessia-admin' ),
		'add_new_item'               => __( 'Añadir nueva Colegiatura', 'aessia-admin' ),
		'edit_item'                  => __( 'Editar Colegiatura', 'aessia-admin' ),
		'update_item'                => __( 'Actualizar Colegiatura', 'aessia-admin' ),
		'view_item'                  => __( 'Ver Colegiatura', 'aessia-admin' ),
		'separate_items_with_commas' => __( 'Separar Colegiaturas con comas', 'aessia-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Colegiaturas', 'aessia-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre las más usadas', 'aessia-admin' ),
		'popular_items'              => __( 'Colegiaturas más usadas', 'aessia-admin' ),
		'search_items'               => __( 'Buscar', 'aessia-admin' ),
		'not_found'                  => __( 'No encontrada', 'aessia-admin' ),
		'no_terms'                   => __( 'No hay Colegiaturas', 'aessia-admin' ),
		'items_list'                 => __( 'Lista de Colegiaturas', 'aessia-admin' ),
		'items_list_navigation'      => __( 'Lista de navegación de Colegiaturas', 'aessia-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => false,
		'show_in_rest'               => false,
	);
	register_taxonomy( 'colegiatura', array( 'prestador', 'prestador_potencial' ), $args );

}
add_action( 'init', 'colegiatura_custom_taxonomy', 0 );

}

if ( ! function_exists( 'asociacion_custom_taxonomy' ) ) {

// Register Custom Taxonomy
function asociacion_custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Asociaciones', 'Taxonomy General Name', 'aessia' ),
		'singular_name'              => _x( 'Asociación', 'Taxonomy Singular Name', 'aessia' ),
		'menu_name'                  => __( 'Asociaciones', 'aessia-admin' ),
		'all_items'                  => __( 'Todas las Asociaciones', 'aessia-admin' ),
		'parent_item'                => __( 'Asociación superior', 'aessia-admin' ),
		'parent_item_colon'          => __( 'Asociación superior:', 'aessia-admin' ),
		'new_item_name'              => __( 'Nombre de la nueva Asociación', 'aessia-admin' ),
		'add_new_item'               => __( 'Añadir nueva Asociación', 'aessia-admin' ),
		'edit_item'                  => __( 'Editar Asociación', 'aessia-admin' ),
		'update_item'                => __( 'Actualizar Asociación', 'aessia-admin' ),
		'view_item'                  => __( 'Ver Asociación', 'aessia-admin' ),
		'separate_items_with_commas' => __( 'Separar Colegiaturas con comas', 'aessia-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Asociaciones', 'aessia-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre las más usadas', 'aessia-admin' ),
		'popular_items'              => __( 'Asociaciones más usadas', 'aessia-admin' ),
		'search_items'               => __( 'Buscar', 'aessia-admin' ),
		'not_found'                  => __( 'No encontrada', 'aessia-admin' ),
		'no_terms'                   => __( 'No hay Asociaciones', 'aessia-admin' ),
		'items_list'                 => __( 'Lista de Asociaciones', 'aessia-admin' ),
		'items_list_navigation'      => __( 'Lista de navegación de Asociaciones', 'aessia-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => false,
		'show_in_rest'               => false,
	);
	register_taxonomy( 'asociacion', array( 'prestador', 'prestador_potencial' ), $args );

}
add_action( 'init', 'asociacion_custom_taxonomy', 0 );

}

if ( ! function_exists( 'ambito_custom_taxonomy' ) ) {

// Register Custom Taxonomy
function ambito_custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Ámbitos', 'Taxonomy General Name', 'aessia' ),
		'singular_name'              => _x( 'Ámbito', 'Taxonomy Singular Name', 'aessia' ),
		'menu_name'                  => __( 'Ámbito', 'aessia-admin' ),
		'all_items'                  => __( 'Todos los Ámbitos', 'aessia-admin' ),
		'parent_item'                => __( 'Ámbito superior', 'aessia-admin' ),
		'parent_item_colon'          => __( 'Ámbito superior:', 'aessia-admin' ),
		'new_item_name'              => __( 'Nombre del nuevo Ámbito', 'aessia-admin' ),
		'add_new_item'               => __( 'Añadir nuevo Ámbito', 'aessia-admin' ),
		'edit_item'                  => __( 'Editar Ámbito', 'aessia-admin' ),
		'update_item'                => __( 'Actualizar Ámbito', 'aessia-admin' ),
		'view_item'                  => __( 'Ver Ámbito', 'aessia-admin' ),
		'separate_items_with_commas' => __( 'Separar Ámbitos con comas', 'aessia-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Ámbitos', 'aessia-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre los más usados', 'aessia-admin' ),
		'popular_items'              => __( 'Ámbitos más usados', 'aessia-admin' ),
		'search_items'               => __( 'Buscar', 'aessia-admin' ),
		'not_found'                  => __( 'No encontrado', 'aessia-admin' ),
		'no_terms'                   => __( 'No hay Ámbitos', 'aessia-admin' ),
		'items_list'                 => __( 'Lista de Ámbitos', 'aessia-admin' ),
		'items_list_navigation'      => __( 'Lista de navegación de Ámbitos', 'aessia-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => false,
		'show_in_rest'               => false,
	);
	register_taxonomy( 'ambito', array( 'prestador' ), $args );

}
add_action( 'init', 'ambito_custom_taxonomy', 0 );

}

if ( ! function_exists( 'tipo_entidad_custom_taxonomy' ) ) {

// Register Custom Taxonomy
function tipo_entidad_custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Tipos de entidad', 'Taxonomy General Name', 'aessia' ),
		'singular_name'              => _x( 'Tipo de entidad', 'Taxonomy Singular Name', 'aessia' ),
		'menu_name'                  => __( 'Tipo de entidad', 'aessia-admin' ),
		'all_items'                  => __( 'Todos los Tipos de entidad', 'aessia-admin' ),
		'parent_item'                => __( 'Tipo de entidad superior', 'aessia-admin' ),
		'parent_item_colon'          => __( 'Tipo de entidad superior:', 'aessia-admin' ),
		'new_item_name'              => __( 'Nombre del nuevo Tipo de entidad', 'aessia-admin' ),
		'add_new_item'               => __( 'Añadir nuevo Tipo de entidad', 'aessia-admin' ),
		'edit_item'                  => __( 'Editar Tipo de entidad', 'aessia-admin' ),
		'update_item'                => __( 'Actualizar Tipo de entidad', 'aessia-admin' ),
		'view_item'                  => __( 'Ver Tipo de entidad', 'aessia-admin' ),
		'separate_items_with_commas' => __( 'Separar Tipos de entidad con comas', 'aessia-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Tipos de entidad', 'aessia-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre los más usados', 'aessia-admin' ),
		'popular_items'              => __( 'Tipos de entidad más usados', 'aessia-admin' ),
		'search_items'               => __( 'Buscar', 'aessia-admin' ),
		'not_found'                  => __( 'No encontrado', 'aessia-admin' ),
		'no_terms'                   => __( 'No hay Tipos de entidad', 'aessia-admin' ),
		'items_list'                 => __( 'Lista de Tipos de entidad', 'aessia-admin' ),
		'items_list_navigation'      => __( 'Lista de navegación de Tipos de entidad', 'aessia-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => false,
		'show_in_rest'               => false,
	);
	register_taxonomy( 'tipo_entidad', array( 'prestador' ), $args );

}
add_action( 'init', 'tipo_entidad_custom_taxonomy', 0 );

}

if ( ! function_exists('asociado_custom_post_type') ) {

// Register Custom Post Type
function asociado_custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Asociados', 'Post Type General Name', 'aessia' ),
		'singular_name'         => _x( 'Asociado', 'Post Type Singular Name', 'aessia' ),
		'menu_name'             => __( 'Logos Asociados', 'aessia-admin' ),
		'name_admin_bar'        => __( 'Logo Asociado', 'aessia-admin' ),
		'archives'              => __( 'Archivos de Asociados', 'aessia-admin' ),
		'attributes'            => __( 'Atributo de Asociado', 'aessia-admin' ),
		'parent_item_colon'     => __( 'Asociado superior:', 'aessia-admin' ),
		'all_items'             => __( 'Todos los Asociados', 'aessia-admin' ),
		'add_new_item'          => __( 'Añadir nuevo Asociado', 'aessia-admin' ),
		'add_new'               => __( 'Añadir nuevo', 'aessia-admin' ),
		'new_item'              => __( 'Nuevo Asociado', 'aessia-admin' ),
		'edit_item'             => __( 'Editar Asociado', 'aessia-admin' ),
		'update_item'           => __( 'Actualizar Asociado', 'aessia-admin' ),
		'view_item'             => __( 'Ver Asociado', 'aessia-admin' ),
		'view_items'            => __( 'Ver Asociados', 'aessia-admin' ),
		'search_items'          => __( 'Buscar Asociado', 'aessia-admin' ),
		'not_found'             => __( 'No encontrado', 'aessia-admin' ),
		'not_found_in_trash'    => __( 'No encontrado en la papelera', 'aessia-admin' ),
		'featured_image'        => __( 'Logo', 'aessia-admin' ),
		'set_featured_image'    => __( 'Establecer Logo', 'aessia-admin' ),
		'remove_featured_image' => __( 'Quitar Logo', 'aessia-admin' ),
		'use_featured_image'    => __( 'Usar como Logo', 'aessia-admin' ),
		'insert_into_item'      => __( 'Insertar en el contenido', 'aessia-admin' ),
		'uploaded_to_this_item' => __( 'Subido a este Asociado', 'aessia-admin' ),
		'items_list'            => __( 'Lista de Asociados', 'aessia-admin' ),
		'items_list_navigation' => __( 'Navegación de la lista de Asociados', 'aessia-admin' ),
		'filter_items_list'     => __( 'Filtrar lista de Asociados', 'aessia-admin' ),
	);
	$args = array(
		'label'                 => __( 'Asociado', 'aessia-admin' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail' ),
		'taxonomies'            => array( 'asociado_cat' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-buddicons-buddypress-logo',
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'rewrite'               => false,
		'capability_type'       => 'post',
		'show_in_rest'          => false,
	);
	register_post_type( 'asociado', $args );

}
add_action( 'init', 'asociado_custom_post_type', 10 );

}



if ( ! function_exists( 'asociado_cat_custom_taxonomy' ) ) {

// Register Custom Taxonomy
function asociado_cat_custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Categorías de asociados', 'Taxonomy General Name', 'aessia' ),
		'singular_name'              => _x( 'Categoría de asociado', 'Taxonomy Singular Name', 'aessia' ),
		'menu_name'                  => __( 'Categoría de asociado', 'aessia-admin' ),
		'all_items'                  => __( 'Todas las Categorías de asociado', 'aessia-admin' ),
		'parent_item'                => __( 'Categoría de asociado superior', 'aessia-admin' ),
		'parent_item_colon'          => __( 'Categoría de asociado superior:', 'aessia-admin' ),
		'new_item_name'              => __( 'Nombre de la nueva Categoría de asociado', 'aessia-admin' ),
		'add_new_item'               => __( 'Añadir nueva Categoría de asociado', 'aessia-admin' ),
		'edit_item'                  => __( 'Editar Categoría de asociado', 'aessia-admin' ),
		'update_item'                => __( 'Actualizar Categoría de asociado', 'aessia-admin' ),
		'view_item'                  => __( 'Ver Categoría de asociado', 'aessia-admin' ),
		'separate_items_with_commas' => __( 'Separar Categorías de asociados', 'aessia-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Categorías de asociados', 'aessia-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre las más usadas', 'aessia-admin' ),
		'popular_items'              => __( 'Categorías de asociados más usadas', 'aessia-admin' ),
		'search_items'               => __( 'Buscar', 'aessia-admin' ),
		'not_found'                  => __( 'No encontrada', 'aessia-admin' ),
		'no_terms'                   => __( 'No hay categorías', 'aessia-admin' ),
		'items_list'                 => __( 'Lista de Categorías de asociados', 'aessia-admin' ),
		'items_list_navigation'      => __( 'Lista de navegación de Categorías de asociados', 'aessia-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => false,
		'show_in_rest'               => false,
	);
	register_taxonomy( 'asociado_cat', array( 'asociado' ), $args );

}
add_action( 'init', 'asociado_cat_custom_taxonomy', 0 );

}

if ( ! function_exists('custom_post_type_tv') ) {

// Register Custom Post Type
function custom_post_type_tv() {

	$labels = array(
		'name'                  => _x( 'Aessia TV', 'Post Type General Name', 'sumun' ),
		'singular_name'         => _x( 'Vídeo', 'Post Type Singular Name', 'sumun' ),
		'menu_name'             => __( 'Aessia TV', 'sumun-admin' ),
		'name_admin_bar'        => __( 'Vídeo', 'sumun-admin' ),
		'add_new'               => __( 'Añadir nuevo Vídeo', 'sumun-admin' ),
		'new_item'              => __( 'Nuevo Vídeo', 'sumun-admin' ),
		'edit_item'             => __( 'Editar Vídeo', 'sumun-admin' ),
		'update_item'           => __( 'Actualizar Vídeo', 'sumun-admin' ),
		'view_item'             => __( 'Ver Vídeo', 'sumun-admin' ),
		'view_items'            => __( 'Ver Vídeos', 'sumun-admin' ),
	);
	$args = array(
		'label'                 => __( 'Vídeos', 'sumun' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-video-alt',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => __( 'tv', 'aessia' ),
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest' 			=> true,
		'taxonomies'			=> array( 'categoria-tv' ),
	);
	register_post_type( 'tv', $args );

}
add_action( 'init', 'custom_post_type_tv', 10 );

}

if ( ! function_exists( 'tv_cat_custom_taxonomy' ) ) {

// Register Custom Taxonomy
function tv_cat_custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Categorías de vídeos', 'Taxonomy General Name', 'aessia' ),
		'singular_name'              => _x( 'Categoría de vídeos', 'Taxonomy Singular Name', 'aessia' ),
		'menu_name'                  => __( 'Categorías de vídeos', 'aessia-admin' ),
		'all_items'                  => __( 'Todas las Categorías de vídeos', 'aessia-admin' ),
		'parent_item'                => __( 'Categoría de vídeos superior', 'aessia-admin' ),
		'parent_item_colon'          => __( 'Categoría de vídeos superior:', 'aessia-admin' ),
		'new_item_name'              => __( 'Nombre de la nueva Categoría de vídeos', 'aessia-admin' ),
		'add_new_item'               => __( 'Añadir nueva Categoría de vídeos', 'aessia-admin' ),
		'edit_item'                  => __( 'Editar Categoría de vídeos', 'aessia-admin' ),
		'update_item'                => __( 'Actualizar Categoría de vídeos', 'aessia-admin' ),
		'view_item'                  => __( 'Ver Categoría de vídeos', 'aessia-admin' ),
		'separate_items_with_commas' => __( 'Separar Categorías de vídeos con comas', 'aessia-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Categorías de vídeos', 'aessia-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre las más usadas', 'aessia-admin' ),
		'popular_items'              => __( 'Categoría de vídeos más usadas', 'aessia-admin' ),
		'search_items'               => __( 'Buscar', 'aessia-admin' ),
		'not_found'                  => __( 'No encontrado', 'aessia-admin' ),
		'no_terms'                   => __( 'No hay Categorías de vídeos', 'aessia-admin' ),
		'items_list'                 => __( 'Lista de Categoría de vídeos', 'aessia-admin' ),
		'items_list_navigation'      => __( 'Lista de navegación de Categoría de vídeos', 'aessia-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'rewrite'                    => array(
											'slug'			=> __( 'tv/categoria-tv', 'aessia' ),
											'with_front'	=> true,
										),
		'show_in_rest'               => true,
		'sort'						 => true,
	);
	register_taxonomy( 'categoria-tv', array( 'tv' ), $args );

}
add_action( 'init', 'tv_cat_custom_taxonomy', 0 );

}

if ( ! function_exists('carta_calidad_custom_post_type') ) {

// Register Custom Post Type
function carta_calidad_custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Cartas de Calidad', 'Post Type General Name', 'aessia' ),
		'singular_name'         => _x( 'Carta de Calidad', 'Post Type Singular Name', 'aessia' ),
		'menu_name'             => __( 'Cartas de Calidad', 'aessia-admin' ),
		'name_admin_bar'        => __( 'Carta de Calidad', 'aessia-admin' ),
		'archives'              => __( 'Archivos de Cartas de Calidad', 'aessia-admin' ),
		'attributes'            => __( 'Atributo de Carta de Calidad', 'aessia-admin' ),
		'parent_item_colon'     => __( 'Carta de Calidad superior:', 'aessia-admin' ),
		'all_items'             => __( 'Todas las Cartas de Calidad', 'aessia-admin' ),
		'add_new_item'          => __( 'Añadir nueva Carta de Calidad', 'aessia-admin' ),
		'add_new'               => __( 'Añadir nueva', 'aessia-admin' ),
		'new_item'              => __( 'Nueva Carta de Calidad', 'aessia-admin' ),
		'edit_item'             => __( 'Editar Carta de Calidad', 'aessia-admin' ),
		'update_item'           => __( 'Actualizar Carta de Calidad', 'aessia-admin' ),
		'view_item'             => __( 'Ver Carta de Calidad', 'aessia-admin' ),
		'view_items'            => __( 'Ver Cartas de Calidad', 'aessia-admin' ),
		'search_items'          => __( 'Buscar Carta de Calidad', 'aessia-admin' ),
		'not_found'             => __( 'No encontrado', 'aessia-admin' ),
		'not_found_in_trash'    => __( 'No encontrado en la papelera', 'aessia-admin' ),
		'featured_image'        => __( 'Imagen principal', 'aessia-admin' ),
		'set_featured_image'    => __( 'Establecer Imagen principal', 'aessia-admin' ),
		'remove_featured_image' => __( 'Quitar Imagen principal', 'aessia-admin' ),
		'use_featured_image'    => __( 'Usar como Imagen principal', 'aessia-admin' ),
		'insert_into_item'      => __( 'Insertar en la Carta de Calidad', 'aessia-admin' ),
		'uploaded_to_this_item' => __( 'Subido a esta Carta de Calidad', 'aessia-admin' ),
		'items_list'            => __( 'Lista de Cartas de Calidad', 'aessia-admin' ),
		'items_list_navigation' => __( 'Navegación de la lista de Cartas de Calidad', 'aessia-admin' ),
		'filter_items_list'     => __( 'Filtrar lista de Cartas de Calidad', 'aessia-admin' ),
	);
	$args = array(
		'label'                 => __( 'Carta de Calidad', 'aessia-admin' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'author', 'excerpt', 'custom-fields', 'revisions', 'page-attributes' ),
		// 'taxonomies'            => array( 'carta-cat' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-media-document',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		// 'has_archive'           => __( 'cartas-calidad', 'aessia' ),
		'has_archive'			=> false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => array(
										'slug'			=> __( 'cartas-calidad', 'aessia' ),
										'with_front'	=> true
									),
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'carta-calidad', $args );

}
add_action( 'init', 'carta_calidad_custom_post_type', 10 );

}




if ( ! function_exists('tutorial_custom_post_type') ) {

// Register Custom Post Type
function tutorial_custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Tutoriales', 'Post Type General Name', 'aessia' ),
		'singular_name'         => _x( 'Tutorial', 'Post Type Singular Name', 'aessia' ),
		'menu_name'             => __( 'Tutoriales', 'aessia-admin' ),
		'name_admin_bar'        => __( 'Tutorial', 'aessia-admin' ),
		'archives'              => __( 'Archivos de Tutoriales', 'aessia-admin' ),
		'attributes'            => __( 'Atributo de Tutorial', 'aessia-admin' ),
		'parent_item_colon'     => __( 'Tutorial superior:', 'aessia-admin' ),
		'all_items'             => __( 'Todos los Tutoriales', 'aessia-admin' ),
		'add_new_item'          => __( 'Añadir nuevo Tutorial', 'aessia-admin' ),
		'add_new'               => __( 'Añadir nuevo', 'aessia-admin' ),
		'new_item'              => __( 'Nuevo Tutorial', 'aessia-admin' ),
		'edit_item'             => __( 'Editar Tutorial', 'aessia-admin' ),
		'update_item'           => __( 'Actualizar Tutorial', 'aessia-admin' ),
		'view_item'             => __( 'Ver Tutorial', 'aessia-admin' ),
		'view_items'            => __( 'Ver Tutoriales', 'aessia-admin' ),
		'search_items'          => __( 'Buscar Tutorial', 'aessia-admin' ),
		'not_found'             => __( 'No encontrado', 'aessia-admin' ),
		'not_found_in_trash'    => __( 'No encontrado en la papelera', 'aessia-admin' ),
		'featured_image'        => __( 'Imagen principal', 'aessia-admin' ),
		'set_featured_image'    => __( 'Establecer Imagen principal', 'aessia-admin' ),
		'remove_featured_image' => __( 'Quitar Imagen principal', 'aessia-admin' ),
		'use_featured_image'    => __( 'Usar como Imagen principal', 'aessia-admin' ),
		'insert_into_item'      => __( 'Insertar en el Tutorial', 'aessia-admin' ),
		'uploaded_to_this_item' => __( 'Subido a este Tutorial', 'aessia-admin' ),
		'items_list'            => __( 'Lista de Tutoriales', 'aessia-admin' ),
		'items_list_navigation' => __( 'Navegación de la lista de Tutoriales', 'aessia-admin' ),
		'filter_items_list'     => __( 'Filtrar lista de Tutoriales', 'aessia-admin' ),
	);
	$args = array(
		'label'                 => __( 'Tutorial', 'aessia-admin' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'revisions', 'page-attributes' ),
		'taxonomies'            => array( 'perfil', /*'perfil-tutorial',*/ 'cat-tutorial', 'tema' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-book',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => __( 'pegasso/tutoriales', 'aessia' ),
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => array(
										'slug'			=> __( 'pegasso/tutoriales', 'aessia' ),
									),
		'query_var'				=> true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'tutorial', $args );

}
add_action( 'init', 'tutorial_custom_post_type', 10 );

}

if ( ! function_exists( 'tutorial_cat_custom_taxonomy' ) ) {

// Register Custom Taxonomy
function tutorial_cat_custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Categorías de Tutoriales', 'Taxonomy General Name', 'aessia' ),
		'singular_name'              => _x( 'Categoría de Tutoriales', 'Taxonomy Singular Name', 'aessia' ),
		'menu_name'                  => __( 'Categoría de Tutoriales', 'aessia-admin' ),
		'all_items'                  => __( 'Todas las Categorías de Tutoriales', 'aessia-admin' ),
		'parent_item'                => __( 'Categoría de Tutoriales superior', 'aessia-admin' ),
		'parent_item_colon'          => __( 'Categoría de Tutoriales superior:', 'aessia-admin' ),
		'new_item_name'              => __( 'Nombre de la nueva Categoría de Tutoriales', 'aessia-admin' ),
		'add_new_item'               => __( 'Añadir nueva Categoría de Tutoriales', 'aessia-admin' ),
		'edit_item'                  => __( 'Editar Categoría de Tutoriales', 'aessia-admin' ),
		'update_item'                => __( 'Actualizar Categoría de Tutoriales', 'aessia-admin' ),
		'view_item'                  => __( 'Ver Categoría de Tutoriales', 'aessia-admin' ),
		'separate_items_with_commas' => __( 'Separar Categorías de Tutoriales', 'aessia-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Categorías de Tutoriales', 'aessia-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre las más usadas', 'aessia-admin' ),
		'popular_items'              => __( 'Categorías de Tutoriales más usadas', 'aessia-admin' ),
		'search_items'               => __( 'Buscar', 'aessia-admin' ),
		'not_found'                  => __( 'No encontrada', 'aessia-admin' ),
		'no_terms'                   => __( 'No hay categorías', 'aessia-admin' ),
		'items_list'                 => __( 'Lista de Categorías de Tutoriales', 'aessia-admin' ),
		'items_list_navigation'      => __( 'Lista de navegación de Categorías de Tutoriales', 'aessia-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => false,
		'show_in_rest'               => false,
	);
	register_taxonomy( 'cat-tutorial', array( 'tutorial' ), $args );

}
// add_action( 'init', 'tutorial_cat_custom_taxonomy', 0 );

}

if ( ! function_exists( 'tema_custom_taxonomy' ) ) {

// Register Custom Taxonomy
function tema_custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Temas', 'Taxonomy General Name', 'aessia' ),
		'singular_name'              => _x( 'Tema', 'Taxonomy Singular Name', 'aessia' ),
		'menu_name'                  => __( 'Temas', 'aessia-admin' ),
		'all_items'                  => __( 'Todos los Temas', 'aessia-admin' ),
		'parent_item'                => __( 'Tema superior', 'aessia-admin' ),
		'parent_item_colon'          => __( 'Tema superior:', 'aessia-admin' ),
		'new_item_name'              => __( 'Nombre del nuevo Tema', 'aessia-admin' ),
		'add_new_item'               => __( 'Añadir nuevo Tema', 'aessia-admin' ),
		'edit_item'                  => __( 'Editar Tema', 'aessia-admin' ),
		'update_item'                => __( 'Actualizar Tema', 'aessia-admin' ),
		'view_item'                  => __( 'Ver Tema', 'aessia-admin' ),
		'separate_items_with_commas' => __( 'Separar Temas con comas', 'aessia-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Temas', 'aessia-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre los más usados', 'aessia-admin' ),
		'popular_items'              => __( 'Temas más usados', 'aessia-admin' ),
		'search_items'               => __( 'Buscar', 'aessia-admin' ),
		'not_found'                  => __( 'No encontrado', 'aessia-admin' ),
		'no_terms'                   => __( 'No hay Temas', 'aessia-admin' ),
		'items_list'                 => __( 'Lista de Temas', 'aessia-admin' ),
		'items_list_navigation'      => __( 'Lista de navegación de Temas', 'aessia-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'rewrite'                    => array(
											'slug'		=> __( 'tema', 'aessia' ),
										),
		'show_in_rest'               => true,
		'sort'						 => true,
	);
	register_taxonomy( 'tema', array( 'tutorial', 'guia', 'preguntas-frecuentes' ), $args );

}
add_action( 'init', 'tema_custom_taxonomy', 0 );

}



if ( ! function_exists( 'perfil_custom_taxonomy' ) ) {

// Register Custom Taxonomy
function perfil_custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Perfiles', 'Taxonomy General Name', 'aessia' ),
		'singular_name'              => _x( 'Perfil', 'Taxonomy Singular Name', 'aessia' ),
		'menu_name'                  => __( 'Perfiles', 'aessia-admin' ),
		'all_items'                  => __( 'Todos los Perfiles', 'aessia-admin' ),
		'parent_item'                => __( 'Perfil superior', 'aessia-admin' ),
		'parent_item_colon'          => __( 'Perfil superior:', 'aessia-admin' ),
		'new_item_name'              => __( 'Nombre del nuevo Perfil', 'aessia-admin' ),
		'add_new_item'               => __( 'Añadir nuevo Perfil', 'aessia-admin' ),
		'edit_item'                  => __( 'Editar Perfil', 'aessia-admin' ),
		'update_item'                => __( 'Actualizar Perfil', 'aessia-admin' ),
		'view_item'                  => __( 'Ver Perfil', 'aessia-admin' ),
		'separate_items_with_commas' => __( 'Separar Perfiles con comas', 'aessia-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Perfiles', 'aessia-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre los más usados', 'aessia-admin' ),
		'popular_items'              => __( 'Perfil más usados', 'aessia-admin' ),
		'search_items'               => __( 'Buscar', 'aessia-admin' ),
		'not_found'                  => __( 'No encontrado', 'aessia-admin' ),
		'no_terms'                   => __( 'No hay Perfiles', 'aessia-admin' ),
		'items_list'                 => __( 'Lista de Perfiles', 'aessia-admin' ),
		'items_list_navigation'      => __( 'Lista de navegación de Perfiles', 'aessia-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'rewrite'                    => array(
											'slug'		=> __( 'perfil', 'aessia' ),
										),
		'show_in_rest'               => true,
		'sort'						 => true,
	);
	register_taxonomy( 'perfil', array( 'tutorial', 'guia', 'preguntas-frecuentes' ), $args );

}
add_action( 'init', 'perfil_custom_taxonomy', 0 );

}

if ( ! function_exists( 'perfil_tutorial_custom_taxonomy' ) ) {

// Register Custom Taxonomy
function perfil_tutorial_custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Perfiles', 'Taxonomy General Name', 'aessia' ),
		'singular_name'              => _x( 'Perfil', 'Taxonomy Singular Name', 'aessia' ),
		'menu_name'                  => __( 'Perfiles tutoriales', 'aessia-admin' ),
		'all_items'                  => __( 'Todos los Perfiles', 'aessia-admin' ),
		'parent_item'                => __( 'Perfil superior', 'aessia-admin' ),
		'parent_item_colon'          => __( 'Perfil superior:', 'aessia-admin' ),
		'new_item_name'              => __( 'Nombre del nuevo Perfil', 'aessia-admin' ),
		'add_new_item'               => __( 'Añadir nuevo Perfil', 'aessia-admin' ),
		'edit_item'                  => __( 'Editar Perfil', 'aessia-admin' ),
		'update_item'                => __( 'Actualizar Perfil', 'aessia-admin' ),
		'view_item'                  => __( 'Ver Perfil', 'aessia-admin' ),
		'separate_items_with_commas' => __( 'Separar Perfiles con comas', 'aessia-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Perfiles', 'aessia-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre los más usados', 'aessia-admin' ),
		'popular_items'              => __( 'Perfil más usados', 'aessia-admin' ),
		'search_items'               => __( 'Buscar', 'aessia-admin' ),
		'not_found'                  => __( 'No encontrado', 'aessia-admin' ),
		'no_terms'                   => __( 'No hay Perfiles', 'aessia-admin' ),
		'items_list'                 => __( 'Lista de Perfiles', 'aessia-admin' ),
		'items_list_navigation'      => __( 'Lista de navegación de Perfiles', 'aessia-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'rewrite'                    => array(
											'slug'		=> __( 'pegasso/tutoriales/perfil-tutorial', 'aessia' ),
										),
		'show_in_rest'               => true,
		'sort'						 => true,
	);
	register_taxonomy( 'perfil-tutorial', array( 'tutorial' ), $args );

}
// add_action( 'init', 'perfil_tutorial_custom_taxonomy', 0 );

}

if ( ! function_exists('guia_custom_post_type') ) {

// Register Custom Post Type
function guia_custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Guías', 'Post Type General Name', 'aessia' ),
		'singular_name'         => _x( 'Guía', 'Post Type Singular Name', 'aessia' ),
		'menu_name'             => __( 'Guías', 'aessia-admin' ),
		'name_admin_bar'        => __( 'Guía', 'aessia-admin' ),
		'archives'              => __( 'Archivos de Guías', 'aessia-admin' ),
		'attributes'            => __( 'Atributo de Guía', 'aessia-admin' ),
		'parent_item_colon'     => __( 'Guía superior:', 'aessia-admin' ),
		'all_items'             => __( 'Todas las Guías', 'aessia-admin' ),
		'add_new_item'          => __( 'Añadir nueva Guía', 'aessia-admin' ),
		'add_new'               => __( 'Añadir nueva', 'aessia-admin' ),
		'new_item'              => __( 'Nueva Guía', 'aessia-admin' ),
		'edit_item'             => __( 'Editar Guía', 'aessia-admin' ),
		'update_item'           => __( 'Actualizar Guía', 'aessia-admin' ),
		'view_item'             => __( 'Ver Guía', 'aessia-admin' ),
		'view_items'            => __( 'Ver Guías', 'aessia-admin' ),
		'search_items'          => __( 'Buscar Guía', 'aessia-admin' ),
		'not_found'             => __( 'No encontrado', 'aessia-admin' ),
		'not_found_in_trash'    => __( 'No encontrado en la papelera', 'aessia-admin' ),
		'featured_image'        => __( 'Imagen principal', 'aessia-admin' ),
		'set_featured_image'    => __( 'Establecer Imagen principal', 'aessia-admin' ),
		'remove_featured_image' => __( 'Quitar Imagen principal', 'aessia-admin' ),
		'use_featured_image'    => __( 'Usar como Imagen principal', 'aessia-admin' ),
		'insert_into_item'      => __( 'Insertar en la Guía', 'aessia-admin' ),
		'uploaded_to_this_item' => __( 'Subido a esta Guía', 'aessia-admin' ),
		'items_list'            => __( 'Lista de Guías', 'aessia-admin' ),
		'items_list_navigation' => __( 'Navegación de la lista de Guías', 'aessia-admin' ),
		'filter_items_list'     => __( 'Filtrar lista de Guías', 'aessia-admin' ),
	);
	$args = array(
		'label'                 => __( 'Guía', 'aessia-admin' ),
		'labels'                => $labels,
		'description'			=> __( 'Recomendaciones y artículos sobre Seguridad Industrial, dirigidas tanto a los profesionales del ramo como al público general', 'aessia' ),
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'revisions', 'page-attributes' ),
		'taxonomies'            => array( 'guia-cat', 'perfil', 'perfil-guia', 'tema', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-book',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => __( 'seguridad-industrial/guias', 'aessia' ),
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => array(
										'slug'			=> __( 'seguridad-industrial/guias', 'aessia' ),
										// 'with_front'	=> true
									),
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'guia', $args );

}
add_action( 'init', 'guia_custom_post_type', 10 );

}

if ( ! function_exists( 'perfil_guia_custom_taxonomy' ) ) {

// Register Custom Taxonomy
function perfil_guia_custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Perfiles', 'Taxonomy General Name', 'aessia' ),
		'singular_name'              => _x( 'Perfil', 'Taxonomy Singular Name', 'aessia' ),
		'menu_name'                  => __( 'Perfiles guías', 'aessia-admin' ),
		'all_items'                  => __( 'Todos los Perfiles', 'aessia-admin' ),
		'parent_item'                => __( 'Perfil superior', 'aessia-admin' ),
		'parent_item_colon'          => __( 'Perfil superior:', 'aessia-admin' ),
		'new_item_name'              => __( 'Nombre del nuevo Perfil', 'aessia-admin' ),
		'add_new_item'               => __( 'Añadir nuevo Perfil', 'aessia-admin' ),
		'edit_item'                  => __( 'Editar Perfil', 'aessia-admin' ),
		'update_item'                => __( 'Actualizar Perfil', 'aessia-admin' ),
		'view_item'                  => __( 'Ver Perfil', 'aessia-admin' ),
		'separate_items_with_commas' => __( 'Separar Perfiles con comas', 'aessia-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Perfiles', 'aessia-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre los más usados', 'aessia-admin' ),
		'popular_items'              => __( 'Perfil más usados', 'aessia-admin' ),
		'search_items'               => __( 'Buscar', 'aessia-admin' ),
		'not_found'                  => __( 'No encontrado', 'aessia-admin' ),
		'no_terms'                   => __( 'No hay Perfiles', 'aessia-admin' ),
		'items_list'                 => __( 'Lista de Perfiles', 'aessia-admin' ),
		'items_list_navigation'      => __( 'Lista de navegación de Perfiles', 'aessia-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'rewrite'                    => array(
											'slug'		=> __( 'seguridad-industrial/guias/perfil-guia', 'aessia' ),
										),
		'show_in_rest'               => true,
		'sort'						 => true,
	);
	register_taxonomy( 'perfil-guia', array( 'guia' ), $args );

}
// add_action( 'init', 'perfil_guia_custom_taxonomy', 0 );

}

if ( ! function_exists('preguntas_frecuentes_custom_post_type') ) {

// Register Custom Post Type
function preguntas_frecuentes_custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Preguntas frecuentes', 'Post Type General Name', 'aessia' ),
		'singular_name'         => _x( 'Preguntas frecuentes', 'Post Type Singular Name', 'aessia' ),
		'menu_name'             => __( 'Preguntas frecuentes', 'aessia-admin' ),
		'name_admin_bar'        => __( 'Ficha de Preguntas frecuentes', 'aessia-admin' ),
		'archives'              => __( 'Archivos de Preguntas frecuentes', 'aessia-admin' ),
		'attributes'            => __( 'Atributo de Preguntas frecuentes', 'aessia-admin' ),
		'parent_item_colon'     => __( 'Preguntas frecuentes superiores:', 'aessia-admin' ),
		'all_items'             => __( 'Todas las Preguntas frecuentes', 'aessia-admin' ),
		'add_new_item'          => __( 'Añadir nueva Ficha de Preguntas frecuentes', 'aessia-admin' ),
		'add_new'               => __( 'Añadir nueva', 'aessia-admin' ),
		'new_item'              => __( 'Nueva Ficha de Preguntas frecuentes', 'aessia-admin' ),
		'edit_item'             => __( 'Editar Ficha de Preguntas frecuentes', 'aessia-admin' ),
		'update_item'           => __( 'Actualizar Ficha de Preguntas frecuentes', 'aessia-admin' ),
		'view_item'             => __( 'Ver Ficha de Preguntas frecuentes', 'aessia-admin' ),
		'view_items'            => __( 'Ver Preguntas frecuentes', 'aessia-admin' ),
		'search_items'          => __( 'Buscar Preguntas frecuentes', 'aessia-admin' ),
		'not_found'             => __( 'No encontrado', 'aessia-admin' ),
		'not_found_in_trash'    => __( 'No encontrado en la papelera', 'aessia-admin' ),
		'featured_image'        => __( 'Imagen principal', 'aessia-admin' ),
		'set_featured_image'    => __( 'Establecer Imagen principal', 'aessia-admin' ),
		'remove_featured_image' => __( 'Quitar Imagen principal', 'aessia-admin' ),
		'use_featured_image'    => __( 'Usar como Imagen principal', 'aessia-admin' ),
		'insert_into_item'      => __( 'Insertar en las Preguntas frecuentes', 'aessia-admin' ),
		'uploaded_to_this_item' => __( 'Subido a estas Preguntas frecuentes', 'aessia-admin' ),
		'items_list'            => __( 'Lista de Preguntas frecuentes', 'aessia-admin' ),
		'items_list_navigation' => __( 'Navegación de la lista de Preguntas frecuentes', 'aessia-admin' ),
		'filter_items_list'     => __( 'Filtrar lista de Preguntas frecuentes', 'aessia-admin' ),
	);
	$args = array(
		'label'                 => __( 'Preguntas frecuentes', 'aessia-admin' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'revisions', 'page-attributes' ),
		'taxonomies'            => array( 'perfil', 'perfil-faq', 'tema' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-yes-alt',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => __( 'seguridad-industrial/faqs', 'aessia' ),
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => array(
										'slug'			=> __( 'seguridad-industrial/faqs', 'aessia' ),
									),
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'preguntas-frecuentes', $args );

}
add_action( 'init', 'preguntas_frecuentes_custom_post_type', 10 );

}

if ( ! function_exists( 'perfil_faq_custom_taxonomy' ) ) {

// Register Custom Taxonomy
function perfil_faq_custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Perfiles', 'Taxonomy General Name', 'aessia' ),
		'singular_name'              => _x( 'Perfil', 'Taxonomy Singular Name', 'aessia' ),
		'menu_name'                  => __( 'Perfiles FAQs', 'aessia-admin' ),
		'all_items'                  => __( 'Todos los Perfiles', 'aessia-admin' ),
		'parent_item'                => __( 'Perfil superior', 'aessia-admin' ),
		'parent_item_colon'          => __( 'Perfil superior:', 'aessia-admin' ),
		'new_item_name'              => __( 'Nombre del nuevo Perfil', 'aessia-admin' ),
		'add_new_item'               => __( 'Añadir nuevo Perfil', 'aessia-admin' ),
		'edit_item'                  => __( 'Editar Perfil', 'aessia-admin' ),
		'update_item'                => __( 'Actualizar Perfil', 'aessia-admin' ),
		'view_item'                  => __( 'Ver Perfil', 'aessia-admin' ),
		'separate_items_with_commas' => __( 'Separar Perfiles con comas', 'aessia-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Perfiles', 'aessia-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre los más usados', 'aessia-admin' ),
		'popular_items'              => __( 'Perfil más usados', 'aessia-admin' ),
		'search_items'               => __( 'Buscar', 'aessia-admin' ),
		'not_found'                  => __( 'No encontrado', 'aessia-admin' ),
		'no_terms'                   => __( 'No hay Perfiles', 'aessia-admin' ),
		'items_list'                 => __( 'Lista de Perfiles', 'aessia-admin' ),
		'items_list_navigation'      => __( 'Lista de navegación de Perfiles', 'aessia-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'rewrite'                    => array(
											'slug'		=> __( 'seguridad-industrial/faqs/perfil-faq', 'aessia' ),
										),
		'show_in_rest'               => true,
		'sort'						 => true,
	);
	// register_taxonomy( 'perfil-faq', array( 'preguntas-frecuentes' ), $args );

}
add_action( 'init', 'perfil_faq_custom_taxonomy', 0 );

}



if ( ! function_exists('funcionalidades_custom_post_type') ) {

// Register Custom Post Type
function funcionalidades_custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Funcionalidades', 'Post Type General Name', 'aessia' ),
		'singular_name'         => _x( 'Funcionalidad', 'Post Type Singular Name', 'aessia' ),
		'menu_name'             => __( 'Funcionalidades Pegasso', 'aessia-admin' ),
		'name_admin_bar'        => __( 'Funcionalidad', 'aessia-admin' ),
		'archives'              => __( 'Archivo de Funcionalidad', 'aessia-admin' ),
		'attributes'            => __( 'Atributo de Funcionalidad', 'aessia-admin' ),
		'parent_item_colon'     => __( 'Funcionalidad superior:', 'aessia-admin' ),
		'all_items'             => __( 'Todas las Funcionalidades', 'aessia-admin' ),
		'add_new_item'          => __( 'Añadir nueva Funcionalidad', 'aessia-admin' ),
		'add_new'               => __( 'Añadir nueva', 'aessia-admin' ),
		'new_item'              => __( 'Nueva Funcionalidad', 'aessia-admin' ),
		'edit_item'             => __( 'Editar Funcionalidad', 'aessia-admin' ),
		'update_item'           => __( 'Actualizar Funcionalidad', 'aessia-admin' ),
		'view_item'             => __( 'Ver Funcionalidad', 'aessia-admin' ),
		'view_items'            => __( 'Ver Funcionalidades', 'aessia-admin' ),
		'search_items'          => __( 'Buscar Funcionalidad', 'aessia-admin' ),
		'not_found'             => __( 'No encontrado', 'aessia-admin' ),
		'not_found_in_trash'    => __( 'No encontrado en la papelera', 'aessia-admin' ),
		'featured_image'        => __( 'Imagen principal', 'aessia-admin' ),
		'set_featured_image'    => __( 'Establecer Imagen principal', 'aessia-admin' ),
		'remove_featured_image' => __( 'Quitar Imagen principal', 'aessia-admin' ),
		'use_featured_image'    => __( 'Usar como Imagen principal', 'aessia-admin' ),
		'insert_into_item'      => __( 'Insertar en la Funcionalidad', 'aessia-admin' ),
		'uploaded_to_this_item' => __( 'Subido a esta Funcionalidad', 'aessia-admin' ),
		'items_list'            => __( 'Lista de Funcionalidades', 'aessia-admin' ),
		'items_list_navigation' => __( 'Navegación de la lista de Funcionalidades', 'aessia-admin' ),
		'filter_items_list'     => __( 'Filtrar lista de Funcionalidades', 'aessia-admin' ),
	);
	$args = array(
		'label'                 => __( 'Funcionalidades', 'aessia-admin' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'revisions', 'page-attributes' ),
		'taxonomies'            => array( 'tipo-funcionalidad' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-admin-generic',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => __( 'pegasso/funcionalidades', 'aessia' ),
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => array(
										'slug'			=> __( 'pegasso/funcionalidades', 'aessia' ),
									),
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'funcionalidad', $args );

}
add_action( 'init', 'funcionalidades_custom_post_type', 10 );

}

if ( ! function_exists('boletin_custom_post_type') ) {

	// Register Custom Post Type
	function boletin_custom_post_type() {
	
		$labels = array(
			'name'                  => _x( 'Boletines', 'Post Type General Name', 'aessia' ),
			'singular_name'         => _x( 'Boletín', 'Post Type Singular Name', 'aessia' ),
			'menu_name'             => __( 'Boletines', 'aessia-admin' ),
			'name_admin_bar'        => __( 'Boletín', 'aessia-admin' ),
			'archives'              => __( 'Archivos de Boletines', 'aessia-admin' ),
			'attributes'            => __( 'Atributo de Boletín', 'aessia-admin' ),
			'parent_item_colon'     => __( 'Boletín superior:', 'aessia-admin' ),
			'all_items'             => __( 'Todos los Boletines', 'aessia-admin' ),
			'add_new_item'          => __( 'Añadir nuevo Boletín', 'aessia-admin' ),
			'add_new'               => __( 'Añadir nuevo', 'aessia-admin' ),
			'new_item'              => __( 'Nuevo Boletín', 'aessia-admin' ),
			'edit_item'             => __( 'Editar Boletín', 'aessia-admin' ),
			'update_item'           => __( 'Actualizar Boletín', 'aessia-admin' ),
			'view_item'             => __( 'Ver Boletín', 'aessia-admin' ),
			'view_items'            => __( 'Ver Boletines', 'aessia-admin' ),
			'search_items'          => __( 'Buscar Boletín', 'aessia-admin' ),
			'not_found'             => __( 'No encontrado', 'aessia-admin' ),
			'not_found_in_trash'    => __( 'No encontrado en la papelera', 'aessia-admin' ),
			'featured_image'        => __( 'Imagen principal', 'aessia-admin' ),
			'set_featured_image'    => __( 'Establecer Imagen principal', 'aessia-admin' ),
			'remove_featured_image' => __( 'Quitar Imagen principal', 'aessia-admin' ),
			'use_featured_image'    => __( 'Usar como Imagen principal', 'aessia-admin' ),
			'insert_into_item'      => __( 'Insertar en el Boletín', 'aessia-admin' ),
			'uploaded_to_this_item' => __( 'Subido a este Boletín', 'aessia-admin' ),
			'items_list'            => __( 'Lista de Boletines', 'aessia-admin' ),
			'items_list_navigation' => __( 'Navegación de la lista de Boletines', 'aessia-admin' ),
			'filter_items_list'     => __( 'Filtrar lista de Boletines', 'aessia-admin' ),
		);
		$args = array(
			'label'                 => __( 'Boletín', 'aessia-admin' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes' ),
			// 'taxonomies'            => array( 'perfil', 'tema' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 20,
			'menu_icon'             => 'dashicons-welcome-widgets-menus',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => __( 'boletines', 'aessia' ),
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'rewrite'               => array(
											'slug'			=> __( 'boletines', 'aessia' ),
										),
			'query_var'				=> true,
			'capability_type'       => 'post',
			'show_in_rest'          => false,
		);
		register_post_type( 'boletin', $args );
	
	}
	add_action( 'init', 'boletin_custom_post_type', 10 );
	
	}

if ( ! function_exists('formacion_custom_post_type') ) {

	// Register Custom Post Type
	function formacion_custom_post_type() {
	
		$labels = array(
			'name'                  => _x( 'Formación', 'Post Type General Name', 'aessia' ),
			'singular_name'         => _x( 'Formación', 'Post Type Singular Name', 'aessia' ),
			'menu_name'             => __( 'Formación', 'aessia-admin' ),
			'name_admin_bar'        => __( 'Formación', 'aessia-admin' ),
			'archives'              => __( 'Archivos de Formaciones', 'aessia-admin' ),
			'attributes'            => __( 'Atributo de Formación', 'aessia-admin' ),
			'parent_item_colon'     => __( 'Formación superior:', 'aessia-admin' ),
			'all_items'             => __( 'Todas las Formaciones', 'aessia-admin' ),
			'add_new_item'          => __( 'Añadir nueva Formación', 'aessia-admin' ),
			'add_new'               => __( 'Añadir nueva', 'aessia-admin' ),
			'new_item'              => __( 'Nueva Formación', 'aessia-admin' ),
			'edit_item'             => __( 'Editar Formación', 'aessia-admin' ),
			'update_item'           => __( 'Actualizar Formación', 'aessia-admin' ),
			'view_item'             => __( 'Ver Formación', 'aessia-admin' ),
			'view_items'            => __( 'Ver Formaciones', 'aessia-admin' ),
			'search_items'          => __( 'Buscar Formación', 'aessia-admin' ),
			'not_found'             => __( 'No encontrado', 'aessia-admin' ),
			'not_found_in_trash'    => __( 'No encontrado en la papelera', 'aessia-admin' ),
			'featured_image'        => __( 'Imagen principal', 'aessia-admin' ),
			'set_featured_image'    => __( 'Establecer Imagen principal', 'aessia-admin' ),
			'remove_featured_image' => __( 'Quitar Imagen principal', 'aessia-admin' ),
			'use_featured_image'    => __( 'Usar como Imagen principal', 'aessia-admin' ),
			'insert_into_item'      => __( 'Insertar en la Formación', 'aessia-admin' ),
			'uploaded_to_this_item' => __( 'Subido a esta Formación', 'aessia-admin' ),
			'items_list'            => __( 'Lista de Formaciones', 'aessia-admin' ),
			'items_list_navigation' => __( 'Navegación de la lista de Formaciones', 'aessia-admin' ),
			'filter_items_list'     => __( 'Filtrar lista de Formaciones', 'aessia-admin' ),
		);
		$args = array(
			'label'                 => __( 'Formación', 'aessia-admin' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes' ),
			'taxonomies'            => array( 'area-formativa' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 20,
			'menu_icon'             => 'dashicons-welcome-learn-more',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => __( 'formacion', 'aessia' ),
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'rewrite'               => array(
											'slug'			=> __( 'formacion', 'aessia' ),
										),
			'query_var'				=> true,
			'capability_type'       => 'post',
			'show_in_rest'          => true,
		);
		register_post_type( 'formacion', $args );
	
	}
	add_action( 'init', 'formacion_custom_post_type', 10 );
	
}

if ( ! function_exists( 'tipo_funcionalidad_custom_taxonomy' ) ) {

// Register Custom Taxonomy
function tipo_funcionalidad_custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Tipos de funcionalidad', 'Taxonomy General Name', 'aessia' ),
		'singular_name'              => _x( 'Tipo de funcionalidad', 'Taxonomy Singular Name', 'aessia' ),
		'menu_name'                  => __( 'Tipos de funcionalidad', 'aessia-admin' ),
		'all_items'                  => __( 'Todos los Tipos de funcionalidad', 'aessia-admin' ),
		'parent_item'                => __( 'Tipo de funcionalidad superior', 'aessia-admin' ),
		'parent_item_colon'          => __( 'Tipo de funcionalidad superior:', 'aessia-admin' ),
		'new_item_name'              => __( 'Nombre del nuevo Tipo de funcionalidad', 'aessia-admin' ),
		'add_new_item'               => __( 'Añadir nuevo Tipo de funcionalidad', 'aessia-admin' ),
		'edit_item'                  => __( 'Editar Tipo de funcionalidad', 'aessia-admin' ),
		'update_item'                => __( 'Actualizar Tipo de funcionalidad', 'aessia-admin' ),
		'view_item'                  => __( 'Ver Tipo de funcionalidad', 'aessia-admin' ),
		'separate_items_with_commas' => __( 'Separar Tipos de funcionalidad', 'aessia-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Tipos de funcionalidad', 'aessia-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre los más usados', 'aessia-admin' ),
		'popular_items'              => __( 'Tipos de funcionalidad más usados', 'aessia-admin' ),
		'search_items'               => __( 'Buscar', 'aessia-admin' ),
		'not_found'                  => __( 'No encontrada', 'aessia-admin' ),
		'no_terms'                   => __( 'No hay Tipos de funcionalidad', 'aessia-admin' ),
		'items_list'                 => __( 'Lista de Tipos de funcionalidad', 'aessia-admin' ),
		'items_list_navigation'      => __( 'Lista de navegación de Tipos de funcionalidad', 'aessia-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'rewrite'                    => array(
											'slug'		=> __( 'pegasso/funcionalidades/tipo-funcionalidad', 'aessia' ),
										),
		'show_in_rest'               => true,
		'sort'						 => true,
	);
	register_taxonomy( 'tipo-funcionalidad', array( 'funcionalidad' ), $args );

}
add_action( 'init', 'tipo_funcionalidad_custom_taxonomy', 0 );

}

if ( ! function_exists( 'area_formativa_custom_taxonomy' ) ) {

	// Register Custom Taxonomy
	function area_formativa_custom_taxonomy() {
	
		$labels = array(
			'name'                       => _x( 'Áreas formativas', 'Taxonomy General Name', 'aessia' ),
			'singular_name'              => _x( 'Área formativa', 'Taxonomy Singular Name', 'aessia' ),
			'menu_name'                  => __( 'Áreas formativas', 'aessia-admin' ),
			'all_items'                  => __( 'Todas las Áreas formativas', 'aessia-admin' ),
			'parent_item'                => __( 'Área formativa superior', 'aessia-admin' ),
			'parent_item_colon'          => __( 'Área formativa superior:', 'aessia-admin' ),
			'new_item_name'              => __( 'Nombre del nuevo Área formativa', 'aessia-admin' ),
			'add_new_item'               => __( 'Añadir nuevo Área formativa', 'aessia-admin' ),
			'edit_item'                  => __( 'Editar Área formativa', 'aessia-admin' ),
			'update_item'                => __( 'Actualizar Área formativa', 'aessia-admin' ),
			'view_item'                  => __( 'Ver Área formativa', 'aessia-admin' ),
			'separate_items_with_commas' => __( 'Separar Áreas formativas', 'aessia-admin' ),
			'add_or_remove_items'        => __( 'Añadir o quitar Áreas formativas', 'aessia-admin' ),
			'choose_from_most_used'      => __( 'Elegir de entre las más usadas', 'aessia-admin' ),
			'popular_items'              => __( 'Áreas formativas más usadas', 'aessia-admin' ),
			'search_items'               => __( 'Buscar', 'aessia-admin' ),
			'not_found'                  => __( 'No encontrada', 'aessia-admin' ),
			'no_terms'                   => __( 'No hay Áreas formativas', 'aessia-admin' ),
			'items_list'                 => __( 'Lista de Áreas formativas', 'aessia-admin' ),
			'items_list_navigation'      => __( 'Lista de navegación de Áreas formativas', 'aessia-admin' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => false,
			'rewrite'                    => array(
												'slug'		=> __( 'formacion/area-formativa', 'aessia' ),
											),
			'show_in_rest'               => true,
			'sort'						 => true,
		);
		register_taxonomy( 'area-formativa', array( 'formacion' ), $args );
	
	}
	add_action( 'init', 'area_formativa_custom_taxonomy', 0 );
	
}

if ( ! function_exists( 'tipo_formacion_custom_taxonomy' ) ) {

	// Register Custom Taxonomy
	function tipo_formacion_custom_taxonomy() {
	
		$labels = array(
			'name'                       => _x( 'Tipos de formación', 'Taxonomy General Name', 'aessia' ),
			'singular_name'              => _x( 'Tipo de formación', 'Taxonomy Singular Name', 'aessia' ),
			'menu_name'                  => __( 'Tipos de formación', 'aessia-admin' ),
			'all_items'                  => __( 'Todos los Tipos de formación', 'aessia-admin' ),
			'parent_item'                => __( 'Tipo de formación superior', 'aessia-admin' ),
			'parent_item_colon'          => __( 'Tipo de formación superior:', 'aessia-admin' ),
			'new_item_name'              => __( 'Nombre del nuevo Tipo de formación', 'aessia-admin' ),
			'add_new_item'               => __( 'Añadir nuevo Tipo de formación', 'aessia-admin' ),
			'edit_item'                  => __( 'Editar Tipo de formación', 'aessia-admin' ),
			'update_item'                => __( 'Actualizar Tipo de formación', 'aessia-admin' ),
			'view_item'                  => __( 'Ver Tipo de formación', 'aessia-admin' ),
			'separate_items_with_commas' => __( 'Separar Tipos de formación', 'aessia-admin' ),
			'add_or_remove_items'        => __( 'Añadir o quitar Tipos de formación', 'aessia-admin' ),
			'choose_from_most_used'      => __( 'Elegir de entre los más usados', 'aessia-admin' ),
			'popular_items'              => __( 'Tipos de formación más usados', 'aessia-admin' ),
			'search_items'               => __( 'Buscar', 'aessia-admin' ),
			'not_found'                  => __( 'No encontrada', 'aessia-admin' ),
			'no_terms'                   => __( 'No hay Tipos de formación', 'aessia-admin' ),
			'items_list'                 => __( 'Lista de Tipos de formación', 'aessia-admin' ),
			'items_list_navigation'      => __( 'Lista de navegación de Tipos de formación', 'aessia-admin' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => false,
			'rewrite'                    => array(
												'slug'		=> __( 'formacion/tipo-formacion', 'aessia' ),
											),
			'show_in_rest'               => true,
			'sort'						 => true,
		);
		register_taxonomy( 'tipo-formacion', array( 'formacion' ), $args );
	
	}
	add_action( 'init', 'tipo_formacion_custom_taxonomy', 0 );
	
}

// add_filter('post_type_link', 'aessia_update_permalink_structure', 10, 2);
function aessia_update_permalink_structure( $post_link, $post )
{
    if ( false !== strpos( $post_link, '%tutorial-cat%' ) ) {
        $taxonomy_terms = get_the_terms( $post->ID, 'tutorial-cat' );
        if ( $taxonomy_terms ) {
	        foreach ( $taxonomy_terms as $term ) { 
	            if ( ! $term->parent ) {
	                $post_link = str_replace( '%tutorial-cat%', $term->slug, $post_link );
	            }
	        } 
	    }
    }
    if ( false !== strpos( $post_link, '%guia-cat%' ) ) {
        $taxonomy_terms = get_the_terms( $post->ID, 'guia-cat' );
        if ( $taxonomy_terms ) {
	        foreach ( $taxonomy_terms as $term ) { 
	            if ( ! $term->parent ) {
	                $post_link = str_replace( '%guia-cat%', $term->slug, $post_link );
	            }
	        } 
	    }
    }
    return $post_link;
}


function wpb_change_title_text( $title ){
     $screen = get_current_screen();
  
     if  ( 'asociado' == $screen->post_type ) {
          $title = 'Nombre de la empresa o institución';
     } elseif  ( 'slide' == $screen->post_type ) {
          $title = 'Título de la slide';
     } elseif  ( 'team' == $screen->post_type ) {
          $title = 'Nombre y apellidos';
     } elseif  ( 'tv' == $screen->post_type ) {
          $title = 'Título del vídeo';
     }
  
     return $title;
}
add_filter( 'enter_title_here', 'wpb_change_title_text' );

// ADD NEW COLUMN
add_filter('manage_posts_columns', 'sumun_columns_head');
add_filter('manage_pages_columns', 'sumun_columns_head');
add_action('manage_posts_custom_column', 'sumun_columns_content', 10, 2);
add_action('manage_pages_custom_column', 'sumun_columns_content', 10, 2);
function sumun_columns_head($defaults) {
	// $defaults = array('featured_image' => 'Imagen') + $defaults;
    $defaults['featured_image'] = 'Imagen';
    $defaults['extracto'] = 'Resumen';

    return $defaults;
}

add_filter('manage_prestador_posts_columns', 'sumun_prestador_columns_head');
add_filter('manage_prestador_potencial_posts_columns', 'sumun_prestador_columns_head');
function sumun_prestador_columns_head( $defaults ) {
	// $defaults['nif'] = 'NIF';
	$defaults['datos'] = 'Datos';

	return $defaults;
}
 
// SHOW THE FEATURED IMAGE
function sumun_columns_content($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
    	echo '<div style="height:100px;">' . get_the_post_thumbnail( $post_ID, array(80,80) ) . '</div>';

    }
    if ($column_name == 'extracto') {
    	$post = get_post($post_ID);
    	echo $post->post_excerpt;
    }
    if ( $column_name == 'nif' ) {
    	echo get_post_meta( $post_ID, 'nif', true );
    }
    if ( $column_name == 'datos' ) {
    	// $post_meta = get_post_meta( $post_ID );
    	// $campos = array(
    	// 	'desea_aparecer_en_directorio',
    	// 	'ok_directorio_de_prestadores',
    	// 	'pdf_carta',
    	// 	'localidad',
    	// 	'numero_registro_industrial',
    	// 	'email_notificaciones'
    	// );
    	$acf_group_id = 963;
    	$fields = acf_get_fields( $acf_group_id );

    	echo '<small>';
    	echo '<ul style="margin-top: 0;">';

    	foreach ($fields as $field) {
    		$field_value = get_field( $field['name'] );

    		// if ( current_user_can( 'manage_options' ) ) {
    		//     echo '<pre>'; 
    		//         print_r( $field ); 
    		//     echo '</pre>';
    		// }
    		
    		

    		if ( ( $field_value && !empty( $field_value ) ) || ( $field['type'] == 'true_false' ) ) {

    			if ( $field['type'] == 'true_false' ) {
    				if ( $field_value ) {
    					$field_value = '<span class="dashicons dashicons-yes-alt" style="color:green;"></span>';
    				} else {
    					$field_value = '<span class="dashicons dashicons-no" style="color:red;"></span>';
    				}
				}

    			if ( $field['type'] == 'email' ) {
    				$field_value = '<a href="mailto:'. $field_value .'" target="_blank">'. $field_value .'</a>';
				}

    			if ( $field['type'] == 'file' ) {
					$field_value = '<a href="'.wp_get_attachment_url( $field_value ).'" target="_blank"><span class="dashicons dashicons-media-document" style="color:blue;"></span></a>';
				}

    			if ( $field['name'] == 'localidad' ) {
    				$link = 'https://google.es/maps/search/'. $field_value;
					$field_value = '<a href="'. $link .'" target="_blank"><span class="dashicons dashicons-location" style="color:blue;"></span> ' . $field_value . '</a>';
				}

    			if ( $field['name'] == 'sitio_web' ) {
    				$parsed = parse_url( $field_value );
    				$link = $field_value;
    				if ( empty ( $parsed['scheme'] ) ) {
    					$link = 'http://' . ltrim( $field_value, '/');
    				}
					$field_value = '<a href="'. $link .'" target="_blank"><span class="dashicons dashicons-admin-home" style="color:blue;"></span> ' . $field_value . '</a>';
				}

    			echo '<li><b>' . $field['label'] . '</b>: ' . $field_value . '</li>';
    		}
    	}

    	echo '</ul>';
    	echo '</small>';
    }
}

add_action('admin_menu', 'add_prestador_cpt_submenu_export');
function add_prestador_cpt_submenu_export(){

     add_submenu_page(
                     'edit.php?post_type=prestador', //$parent_slug
                     'Exportar Prestadores a excel',  //$page_title
                     'Exportar a excel',        //$menu_title
                     'manage_options',           //$capability
                     'prestador_exportar_excel',//$menu_slug
                     'prestador_exportar_excel_render_page'//$function
     );

     add_submenu_page(
                     'edit.php?post_type=prestador_potencial', //$parent_slug
                     'Exportar Prestadores potenciales a excel',  //$page_title
                     'Exportar a excel',        //$menu_title
                     'manage_options',           //$capability
                     'prestador_potencial_exportar_excel',//$menu_slug
                     'prestador_potencial_exportar_excel_render_page'//$function
     );

}

function prestador_exportar_excel_render_page() {

     echo '<h2>Exportar Prestadores a excel</h2>';

     echo '<a class="button button-primary button-large" href="'.get_home_url().'/?export=xls&post_type=prestador">Exportar ahora</a>';

}

function prestador_potencial_exportar_excel_render_page() {

     echo '<h2>Exportar Prestadores potenciales a excel</h2>';

     echo '<a class="button button-primary button-large" href="'.get_home_url().'/?export=xls&post_type=prestador_potencial">Exportar ahora</a>';

}

?>