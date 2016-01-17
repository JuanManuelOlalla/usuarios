<?php
require '../clases/AutoCarga.php';
$sesion = new Session();
$bd = new DataBase();
$gestor = new ManageUser($bd);
$claveNueva = Request::post("claveNueva");
$claveConfirmada = Request::post("claveConfirmada");
$id = Request::post("id");
$email = Request::post("email");

if($claveNueva!=$claveConfirmada){
    $r="No coinciden las contraseñas";
    header("Location:".Server::getURL());
    exit();
}

if(md5(Constant::PEZARANA.$email)==$id){
    
    $user = $gestor->get($email);
    $user->setClave($claveNueva);
    $r =  $gestor->set($user, $email);
    
    var_dump($user);
    if($r==1){
        $sesion->login($user);
    }
    
}else{
    $r = "ID incorrecto";
    header("Location:index.php?$r");
}