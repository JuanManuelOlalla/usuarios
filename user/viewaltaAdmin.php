<?php
require '../clases/AutoCarga.php';
$error = Request::get("error");
$sesion = new Session();
$sesion->administrador();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Alta Usuario</title>
    </head>
    <body>
        <?php echo $error; ?>
        <form action="phpaltaAdmin.php" method="POST">            
            <input type="email" name="email" value="" id="email" placeholder="email" required/><br/>
            <input type="text" name="alias" value="" id="alias" placeholder="alias" required/><br/>
            <input type="password" name="clave" value="" id="clave" placeholder="clave" required/><br/>
            <input type="password" name="clave2" value="" id="clave2" placeholder="repite clave" required/><br/>
            <select name="rol" id="rol">
                <option id="usuario" value="usuario" selected="">Usuario</option>
                <option id="personal" value="personal">Personal</option>
                <option id="aministrador" value="administrador">Administrador</option>
            </select><br/>
            Activo: 
            <select name="activo">
                <option value="0" selected>No</option>
                <option value="1">Si</option>                
                <option value="-1">Baneado</option>
            </select><br/><br/>
            <input type="submit" value="Alta" />
        </form>
    </body>
</html>
