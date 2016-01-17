<?php
require '../clases/AutoCarga.php';
$sesion = new Session();
$bd = new DataBase();
$gestor = new ManageUser($bd);
$email = Request::post("email");
$clave = Request::post("clave");
$user = $gestor->login($email, $clave);
$bd->closeConnection();
if($user == false ){
    $sesion->destroy();
    header("Location:index.php?error=Login incorrecto o usuario inactivo");
} else {
    $sesion->login($user);
}