<?php
require '../clases/AutoCarga.php';
$direccion = Request::get("direccion");
$email = Request::get("email");
?>
<!DOCTYPE html>
<html> <head>
        <meta charset="UTF-8">
        <title>Cambiar</title>
    </head>
    <body>
        <a href="<?php echo $direccion."&email=".$email; ?>"><?php echo $direccion."&email=".$email; ?></a>
    </body>
</html>