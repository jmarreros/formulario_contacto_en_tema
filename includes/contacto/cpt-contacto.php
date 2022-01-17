<?php
// Register Custom Post Type

add_action( 'init', 'dcms_create_contacto', 0 );

function dcms_create_contacto() {

	$labels = array(
		'name'                  => _x( 'Contactos', 'Post Type General Name', 'dcms_contacto' ),
		'singular_name'         => _x( 'Contacto', 'Post Type Singular Name', 'dcms_contacto' ),
		'menu_name'             => __( 'Contacto', 'dcms_contacto' ),
		'name_admin_bar'        => __( 'Contacto', 'dcms_contacto' ),
		'archives'              => __( 'Contactos', 'dcms_contacto' ),
		'attributes'            => __( 'Item', 'dcms_contacto' ),
		'parent_item_colon'     => __( 'Parem Item', 'dcms_contacto' ),
		'all_items'             => __( 'Todos', 'dcms_contacto' ),
		'add_new_item'          => __( 'Agregar nuevo', 'dcms_contacto' ),
		'add_new'               => __( 'Agregar nuevo', 'dcms_contacto' ),
		'new_item'              => __( 'Nuevo', 'dcms_contacto' ),
		'edit_item'             => __( 'Editar', 'dcms_contacto' ),
		'update_item'           => __( 'Actualizar', 'dcms_contacto' ),
		'view_item'             => __( 'Ver', 'dcms_contacto' ),
		'view_items'            => __( 'Ver Contactos', 'dcms_contacto' ),
		'search_items'          => __( 'Buscar contacto', 'dcms_contacto' ),
		'not_found'             => __( 'No encontrado', 'dcms_contacto' ),
		'not_found_in_trash'    => __( 'No encontrado', 'dcms_contacto' ),
		'featured_image'        => __( 'Imagen destacada', 'dcms_contacto' ),
		'set_featured_image'    => __( 'Establecer imagen destacada', 'dcms_contacto' ),
		'remove_featured_image' => __( 'Eliminar imagen destacada', 'dcms_contacto' ),
		'use_featured_image'    => __( 'Usar imagen destacada', 'dcms_contacto' ),
		'insert_into_item'      => __( 'Insertar', 'dcms_contacto' ),
		'uploaded_to_this_item' => __( 'Actualizarr', 'dcms_contacto' ),
		'items_list'            => __( 'Lista', 'dcms_contacto' ),
		'items_list_navigation' => __( 'Navegación Items', 'dcms_contacto' ),
		'filter_items_list'     => __( 'Filtrar', 'dcms_contacto' ),
	);
	$args = array(
		'label'                 => __( 'Contacto', 'dcms_contacto' ),
		'description'           => __( 'Formulario de contacto integrado con el tema', 'dcms_contacto' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'custom-fields' ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-email',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'post',
        'capabilities' => array(
            'create_posts' => false,
          ),
        'map_meta_cap' => true,
	);
	register_post_type( 'dcms_contacto', $args );

}

