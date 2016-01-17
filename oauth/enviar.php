<?php
session_start();
$origen = "666manlo666@gmail.com";
$alias = "Gestion de usuario";
$destino = Request::get("destino");
$asunto = "activar";
$mensaje = Request::get("mensaje");

require_once '../clases/Google/autoload.php';
require_once '../clases/class.phpmailer.php';  //las últimas versiones también vienen con autoload
$cliente = new Google_Client();
$cliente->setApplicationName('ProyectoEnviarCorreo');
$cliente->setClientId('304670743598-f6luuojm498kah8fnuqarr0mmcrg918n.apps.googleusercontent.com');
$cliente->setClientSecret('ep2o5eER7ELsUJvptEEkonTk');
$cliente->setRedirectUri('https://pruebacorreo-juanmanuelolalla.c9users.io/oauth/guardar.php');
$cliente->setScopes('https://www.googleapis.com/auth/gmail.compose');
$cliente->setAccessToken(file_get_contents('token.conf'));
if ($cliente->getAccessToken()) {
    $service = new Google_Service_Gmail($cliente);
    try {
        $mail = new PHPMailer();
        $mail->CharSet = "UTF-8";
        $mail->From = $origen;
        $mail->FromName = $alias;
        $mail->AddAddress($destino);
        $mail->AddReplyTo($origen, $alias);
        $mail->Subject = $asunto;
        $mail->Body = $mensaje;
        $mail->preSend();
        $mime = $mail->getSentMIMEMessage();
        $mime = rtrim(strtr(base64_encode($mime), '+/', '-_'), '=');
        $mensaje = new Google_Service_Gmail_Message();
        $mensaje->setRaw($mime);
        $service->users_messages->send('me', $mensaje);
        echo "correo enviado correctamente";
    } catch (Exception $e) {
        echo "Algun error";
        print($e->getMessage());
    }
}
?>