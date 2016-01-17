<?php
require '../clases/AutoCarga.php';
$error = Request::get("error");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Alta Usuario</title>
    </head>
    <body>
        <?php echo $error; ?>
        <form action="phpaltauser.php" method="POST">            
            <input type="email" name="email" value="" id="email" placeholder="email" required/><br/>
            <input type="text" name="alias" value="" id="alias" placeholder="alias" required/><br/>
            <input type="password" name="clave" value="" id="clave" placeholder="clave" required/><br/>
            <input type="password" name="clave2" value="" id="clave2" placeholder="repite clave" required/><br/>
            <input type="submit" value="Alta" />
        </form>
    </body>
</html>
