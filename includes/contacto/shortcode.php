<?php


add_action( 'init', 'dcms_add_shortcode' );

function dcms_add_shortcode(){
	add_shortcode('ws_contacto', 'dcms_create_form_contact');
}

function dcms_create_form_contact( $atts, $content ){

	ob_start();
		include 'template.php';
	$output = ob_get_clean();

	return $output;
}

