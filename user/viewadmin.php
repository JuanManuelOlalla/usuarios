<?php
require '../clases/AutoCarga.php';
$sesion = new Session();
$sesion->administrador();
$bd = new DataBase();
$gestor = new ManageUser($bd);
$sesion->autentificado();
$user = $sesion->getUser();
$sesion->administrador("viewuser.php");
$error = Request::get("r");

$lista = $gestor->getList();
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
            echo "Admin: ".$user->getEmail()."--> <a href='phplogout.php'>Logout</a> <br/><br/>";
            
            foreach ($lista as $indice => $usu) {
                echo $usu;

                echo "<a href='vieweditAdmin.php?email={$usu->getEmail()}'>Editar</a>";
                echo '<br/>';
            }
        ?>
        <br/><br/>
        <a href="viewaltaAdmin.php">Alta Usuario</a>
    </body>
</html>
