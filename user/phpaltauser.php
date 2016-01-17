<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageUser($bd);
$user = new User();
$user->read();
$fechalta = date("Y-m-d H:i:s");
$user->setFechalta($fechalta);
$user->setActivo(0);
$r = $gestor->insert($user);

if($r==1){
    $id = md5(Constant::PEZARANA.$user->getEmail());
    $email=$user->getEmail();
    $direccion = Server::getEnlaceCarpeta("phpconfirmar.php?id=$id&email=$email");
    header ("Location: bienvenida.php?direccion=$direccion");
    exit;
}
header ("Location: viewalta.php?error=$r");