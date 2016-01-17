<?php
require '../clases/AutoCarga.php';
$error = Request::get("error");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Recuperar Contraseña</title>
    </head>
    <body>
        <?php echo $error; ?>
        <form action="phpolvido.php" method="POST"> 
            <input type="email" name="email" value="" id="email" placeholder="email" required/><br/>
            <input type="submit" value="Recuperar" />
        </form>
    </body>
</html>
