<?php
require '../clases/AutoCarga.php';
$sesion = new Session();
$sesion->autentificado();
$user = $sesion->getUser();
$bd = new DataBase();
$gestor = new ManageUser($bd);
$r = Request::get("r");
echo $r;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Editar Usuario</title>
    </head>
    <body>
        <form action="phpedit.php" method="POST" enctype="multipart/form-data">
            
            <div class="image-upload">
                <label for="avatar" style="cursor: pointer">
                    <?php echo $gestor->getAvatar($user); ?>
                </label>
                <input name="avatar" id="avatar" style="display: none" type="file"/>
            </div>
            <label for="email">Email(tendrás que activarlo)</label>
            <input type="email" name="email" value="<?php echo $user->getEmail() ?>" id="email"/><br/>
            <label for="clave">Clave</label>
            <input type="password" name="clave" value="" id="clave" /><br/>            
            <label for="claveNueva">Clave Nueva</label>
            <input type="password" name="claveNueva" value="" id="claveNueva"/><br/>            
            <label for="claveConfirmada">Confirmar Clave Nueva</label>
            <input type="password" name="claveConfirmada" value="" id="claveConfirmada"/><br/>            
            <label for="alias">Alias</label>
            <input type="text" name="alias" value="<?php echo $user->getAlias() ?>" id="alias"/><br/><br/>
            <input type="submit" id="modificar" value="Modificar" />
        </form>
    </body>
</html>