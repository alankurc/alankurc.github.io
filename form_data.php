<?php
    if(isset($_POST['email'])) {
          
        $email_to = "im.alan.kurc@gmail.com";
        $email_subject = "Contacto desde la web";
         
        
        $nombre = $_POST['nombre']; // required
        $email = $_POST['email']; // required
		$mensaje = $_POST['mensaje']; // required
         
        $email_message = "Mensaje: \n\n";
         
        function clean_string($string) {
          $bad = array("content-type","bcc:","to:","cc:","href");
          return str_replace($bad,"",$string);
        }
         
		$email_message .= "Nombre: ".clean_string($nombre)."\n";
        $email_message .= "Email: ".clean_string($email)."\n";
        $email_message .= "Mensaje: ".clean_string($mensaje)."\n";
         
         
    // create email headers
    $headers = 'From: '.$email."\r\n".
    'Reply-To: '.$email."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    if(@mail($email_to, $email_subject, $email_message, $headers)) {
        $data['status'] = TRUE;
        $data['msg'] = 'El E-mail ha sido enviado!';
        $data['class'] = 'success';
    } else {
        $data['status'] = FALSE;
        $data['msg'] = 'El e-mail no ha sido enviado!';
        $data['class'] = 'error';
    }
    
    echo json_encode($data);
}else{
    $data['status'] = FALSE;
    $data['msg'] = 'Debe completar todos los campos';
    $data['class'] = 'error';
    echo json_encode($data);
}
?>