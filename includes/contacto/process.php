<?php
// Procesa el requets de Ajax

add_action('wp_ajax_nopriv_dcms_process_form','dcms_process_form');
add_action('wp_ajax_dcms_process_form','dcms_process_form');

function dcms_process_form(){

    validate_nonce('contacto-nonce');

    $form = [];
    parse_str($_POST['form'], $form);

    $email  = filter_var($form['email'], FILTER_VALIDATE_EMAIL);

    // Validacion
    $res = [];
    if ( ! $email ) $res = [ 'status' => '0', 'msg' => "Error en el corre enviado"];
    elseif ( ! $form['name'] )  $res = [ 'status' => '0', 'msg' => "Error debes ingresar un nombre"];
    elseif ( ! $form['msg'] )   $res = [ 'status' => '0', 'msg' => "Error debes ingresar un mensaje"];

    if ( empty($res) ){
        save_post_contacto($form);
        $res = [ 'status' => '1', 'msg' => "Se ha enviado tu mensaje correctamente"];
    }

    echo json_encode($res);

	wp_die();
}


function save_post_contacto($form){

    $str = "Nombre: {$form['name']} \n";
    $str .= "Email: {$form['email']} \n";
    $str .= $form['tel']?"Tel: {$form['tel']} \n":'';
    $str .= "Opción: {$form['relacionada']} \n";
    $str .= $form['url']?"Sitio: {$form['url']} \n":'';
    $str .= "Mensaje:\n {$form['msg']} \n";

    error_log($str);
}



function validate_nonce( $nonce_name ){
    if ( ! wp_verify_nonce( $_POST['nonce'], $nonce_name ) ) {
        $res = [
            'status' => 0,
            'msg' => '✋ Error nonce validation!!'
        ];
        echo json_encode($res);
        wp_die();
    }
}
