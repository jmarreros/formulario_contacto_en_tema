<?php
/*Este archivo es parte de twentytwentyone-child, twentytwentyone child theme.

Todas las funciones de este archivo se cargarán antes que las funciones del tema padre.
Aprende más en https://codex.wordpress.org/Child_Themes.

Nota: esta función carga antes la hoja de estilos padre, después la hoja de estilos del tema hijo
(déjalo en su lugar, salvo que sepas lo que estás haciendo).
*/

if ( ! function_exists( 'suffice_child_enqueue_child_styles' ) ) {
	function twentytwentyone_child_enqueue_child_styles() {
	    // loading parent style
	    wp_register_style(
	      'parente2-style',
	      get_template_directory_uri() . '/style.css'
	    );

	    wp_enqueue_style( 'parente2-style' );
	    // loading child style
	    wp_register_style(
	      'childe2-style',
	      get_stylesheet_directory_uri() . '/style.css'
	    );
	    wp_enqueue_style( 'childe2-style');
	 }
}
add_action( 'wp_enqueue_scripts', 'twentytwentyone_child_enqueue_child_styles' );

/*Escribe aquí tus propias funciones */

include_once('includes/contacto/contacto.php');


add_action("wp_enqueue_scripts", "dcms_insertar_js");
function dcms_insertar_js(){
    wp_register_script('wescript', get_stylesheet_directory_uri(). '/js/script.js', array('jquery'), '1', true );
    wp_enqueue_script('wescript');

	wp_localize_script('wescript','we_vars',[
											'ajaxurl'=>admin_url('admin-ajax.php'),
											'dcmscontact' => wp_create_nonce('contacto-nonce')
											]
					);
}