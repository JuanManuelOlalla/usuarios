<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$sesion = new Session();
$gestor = new ManageUser($bd);

$sesion->autentificado();
$user = $sesion->getUser();
$error = Request::get("error");

$r = $gestor->desactivar($user->getEmail());
$sesion->destroy();

if($r==1){
$id = md5(Constant::PEZARANA.$user->getEmail());
$email=$user->getEmail();
$direccion = Server::getEnlaceCarpeta("phpconfirmar.php?id=$id&email=$email");
header ("Location: bienvenida.php?direccion=$direccion");
exit;
}

header("Location:viewuser.php?r=$r");   