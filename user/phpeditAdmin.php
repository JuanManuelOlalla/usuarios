<?php
require '../clases/AutoCarga.php';
$sesion = new Session();
$sesion->administrador();

$bd = new DataBase();
$gestor = new ManageUser($bd);

$error = Request::get("error");

$email = Request::post("email");
$emailpk = Request::post("emailpk");
$fechalta = Request::post("fechalta");
$clave = Request::post("clave");
$alias = Request::post("alias");

$user = new User($email, $clave, $alias, $fechalta);


if(Request::post("rol")=="administrador"){
    $user->setAdministrador(1);
    $user->setPersonal(1);
}elseif(Request::post("rol")=="personal"){
    $user->setAdministrador(0);
    $user->setPersonal(1);
}elseif(Request::post("rol")=="usuario"){
    $user->setAdministrador(0);
    $user->setPersonal(0);
}

$user->setActivo(Request::post("activo"));

$subir = new FileUpload("avatar");
$cambioAvatar = $_FILES["avatar"]['name'];

if($email != $emailpk){
    rename ("avatar/$emailpk.jpg", "avatar/$email.jpg");
}

if($cambioAvatar!="" || $cambioAvatar!=null){
    $destino = "avatar/".$user->getEmail();
    $subir->setDestino($destino);
    $subir->subida();
}

if($clave!=""){
        $r =  $gestor->set($user, $emailpk);
    echo $r;
} else {
    $r =  $gestor->setSin($user, $emailpk);
    echo $r;
}

header("Location:viewadmin.php?r=$r");   