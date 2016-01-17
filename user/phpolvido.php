<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$email = Request::post("email");

$id = md5(Constant::PEZARANA.$email);
$direccion = Server::getEnlaceCarpeta("viewcambiar.php?id=$id&email=$email");
header ("Location: cambiar.php?direccion=$direccion");
exit;
    
header ("Location: viewalta.php?error=$r");