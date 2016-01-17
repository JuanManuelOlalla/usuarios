<?php
require '../clases/AutoCarga.php';
$error = Request::get("error");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
        <?php echo $error; ?>
        <form action="phplogin.php" method="POST">            
            <input type="email" name="email" value="" id="email" placeholder="email" required/>
            <input type="password" name="clave" value="" id="clave" placeholder="clave" required/>
            <input type="submit" value="Login" />
        </form>
        <a href="viewalta.php">Alta Usuario</a>
        <a href="viewolvido.php">Olvido</a>
    </body>
</html>
