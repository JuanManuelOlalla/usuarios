<?php
require '../clases/AutoCarga.php';
$sesion = new Session();
$sesion->administrador();

$bd = new DataBase();
$gestor = new ManageUser($bd);
$user = new User();
$user->read();
$fechalta = date("Y-m-d H:i:s");
$user->setFechalta($fechalta);

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
    
$r = $gestor->insert($user);

if($r==1){
    header ("Location: viewadmin.php");
    exit;
}
header ("Location: viewaltaAdmin.php?error=$r");