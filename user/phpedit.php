<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$sesion = new Session();
$gestor = new ManageUser($bd);

$sesion->autentificado();
$user = $sesion->getUser();
$error = Request::get("error");

$email = Request::post("email");
$clave = Request::post("clave");
$claveNueva = Request::post("claveNueva");
$claveConfirmada = Request::post("claveConfirmada");
$alias = Request::post("alias");

$nuevoUsuario = new User($email, $claveNueva, $alias);
$nuevoUsuario->setActivo(1);
$nuevoUsuario->setFechalta($user->getFechalta());
$nuevoUsuario->setAdministrador($user->getAdministrador());
$nuevoUsuario->setPersonal($user->getPersonal());


$cambioDeClave = strlen($claveNueva)> 0 && $claveNueva==$claveConfirmada ;
$cambioDeCorreo = $email!=$user->getEmail();

$subir = new FileUpload("avatar");
$cambioAvatar = $_FILES["avatar"]['name'];

if($cambioDeCorreo){
    rename ("avatar/".$user->getEmail().".jpg", "avatar/".$nuevoUsuario->getEmail().".jpg");
}

if($cambioAvatar!="" || $cambioAvatar!=null){
    $destino = "avatar/".$nuevoUsuario->getEmail();
    $subir->setDestino($destino);
    $subir->subida();
}

if($cambioDeClave){
    if(sha1($clave) == $user->getClave()){
        $r =  $gestor->set($nuevoUsuario, $user->getEmail());
        $nuevoUsuario->setClave(sha1($nuevoUsuario->getClave()));
    }
} else {
    $r =  $gestor->setSin($nuevoUsuario, $user->getEmail());
    echo $r;
}

if($cambioDeCorreo && $r>0){
    $r = $gestor->desactivar($nuevoUsuario->getEmail());
    $id = md5(Constant::PEZARANA.$nuevoUsuario->getEmail());
    $direccion = Server::getEnlaceCarpeta("phpconfirmar.php?id=$id&email=$email");
    header ("Location: bienvenida.php?direccion=$direccion");
    $sesion->destroy();
    $bd->closeConnection();
    exit;
}
$sesion->setUser($nuevoUsuario);
header("Location:viewuser.php?r=$r");   