<?php
require '../clases/AutoCarga.php';
$sesion = new Session();
$bd = new DataBase();
$gestor = new ManageUser($bd);
$id = Request::get("id");
$email = Request::get("email");

if(md5(Constant::PEZARANA.$email)==$id){
    $r = $gestor->activar($email);
}else{
    $r = "No se ha activado";
}

echo $r;
if ($r == 1) {
    $sesion->login($gestor->get($email));
} else {
    header("Location:index.php");
}