<?php
require '../clases/AutoCarga.php';
$sesion = new Session();
$sesion->autentificado();
$user = $sesion->getUser();
$bd = new DataBase();
$gestor = new ManageUser($bd);
$error = Request::get("r");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>View User</title>
    </head>
    <body>
        <?php 
        echo $error;
        echo $gestor->getAvatar($user);
        echo "User: ".$user->getEmail()." --> <a href='phplogout.php'>Logout</a> <br/><br/>";
        ?>
        <a href="viewedit.php">Editar</a>
        <a href="phpbaja.php">Baja</a>
    </body>
</html>
