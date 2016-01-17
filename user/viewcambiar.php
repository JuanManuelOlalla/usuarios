<?php
require '../clases/AutoCarga.php';
$email = Request::get("email");
$id = Request::get("id");

$r = Request::get("r");
echo $r;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cambiar Contraseña</title>
    </head>
    <body>
        <form action="phpcambiar.php" method="POST">          
            <label for="claveNueva">Clave Nueva</label>
            <input type="password" name="claveNueva" value="" id="claveNueva"/><br/>            
            <label for="claveConfirmada">Confirmar Clave Nueva</label>
            <input type="password" name="claveConfirmada" value="" id="claveConfirmada"/><br/>    
            <input type="hidden" name="id" value="<?php echo $id; ?>"/><br/>  
            <input type="hidden" name="email" value="<?php echo $email; ?>" /><br/>  
            <input type="submit" id="modificar" value="Modificar" />
        </form>
    </body>
</html>