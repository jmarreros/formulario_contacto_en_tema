<?php
// Procesa el requets de Ajax

add_action('wp_ajax_nopriv_dcms_process_form','dcms_process_form');
add_action('wp_ajax_dcms_process_form','dcms_process_form');

function dcms_process_form(){


    $form = [];
    parse_str($_POST['form'], $form);

    validate_nonce('contacto-nonce');
    validate_recaptcha($form);

    $email  = filter_var($form['email'], FILTER_VALIDATE_EMAIL);

    // Validacion
    $res = [];
    if ( ! $email ) $res = [ 'status' => '0', 'msg' => "Error en el corre enviado"];
    elseif ( ! $form['name'] )  $res = [ 'status' => '0', 'msg' => "Error debes ingresar un nombre"];
    elseif ( ! $form['msg'] )   $res = [ 'status' => '0', 'msg' => "Error debes ingresar un mensaje"];

    if ( empty($res) ){

        $title = "Contacto - {$form['relacionada']} - {$form['name']}";
        $message = create_message($form);

        // Save post
        $result_save = wp_insert_post([
                                    'post_title' => $title,
                                    'post_type' => 'dcms_contacto',
                                    'post_content' => $message,
                                    'post_status' => 'publish'
                                ]);

        // Send email
        $result_send = wp_mail($email, $title, $message, [
                                    "Content-Type: text/html; charset=UTF-8",
                                    "Reply-To: {$form['name']} <{$email}>"
                                ]);

        if ( ! $result_save  || ! $result_send ) {
            $res = [ 'status' => '0', 'msg' => "Existe un error al enviar el formulario, inténtelo más tarde"];

            error_log('Error al grabar o enviar el formulario de contacto:');
            error_log(print_r($form,true));
        } else {
            $res = [ 'status' => '1', 'msg' => "Se ha enviado tu mensaje correctamente"];
        }

    }

    echo json_encode($res);
	wp_die();
}


function create_message($form){
    $str =  "-Nombre: {$form['name']} <br>";
    $str .= "-Email: {$form['email']} <br>";
    $str .= $form['tel']?"-Tel: {$form['tel']} <br>":'';
    $str .= "-Consulta: {$form['relacionada']} <br>";
    $str .= $form['url']?"Sitio: {$form['url']} <br>":'';
    $str .= "-Mensaje:<br>{$form['msg']} <br>";

    return $str;
}


function validate_recaptcha($form){
    $token = $form['token'];
    $action = $form['action'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => RECAPTCHA_V3_SECRET_KEY, 'response' => $token)));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $arrResponse = json_decode($response, true);

    // verify the response
    if($arrResponse["success"] != '1' || $arrResponse["action"] != $action || $arrResponse["score"] < 0.5) {
        $res = [
            'status' => 0,
            'msg' => '✋ Error, refresca la página para volver a enviar'
        ];
        echo json_encode($res);
        wp_die();
    }
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



