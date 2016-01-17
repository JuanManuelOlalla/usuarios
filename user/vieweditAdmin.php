<?php
require '../clases/AutoCarga.php';
$sesion = new Session();
$sesion->administrador();
$user = $sesion->getUser();
$bd = new DataBase();
$gestor = new ManageUser($bd);
$usuario = $gestor->get(Request::get("email"));
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
        <form action="phpeditAdmin.php" method="POST" enctype="multipart/form-data"> 
            <div class="image-upload">
                <label for="avatar"  style="cursor: pointer">
                    <?php echo $gestor->getAvatar($usuario); ?>
                </label>
                <input name="avatar" id="avatar" style="display: none" type="file"/>
            </div>
            <input type="email" name="email" value="<?php echo $usuario->getEmail() ?>" id="email" placeholder="email" required/><br/>
            <input type="hidden" name="emailpk" value="<?php echo $usuario->getEmail() ?>" id="email" /><br/>
            <input type="hidden" name="fechalta" value="<?php echo $usuario->getFechalta() ?>" id="fecha" />
            <input type="text" name="alias" value="<?php echo $usuario->getAlias() ?>" id="alias" placeholder="alias" required/><br/>
            <input type="password" name="clave" value="" id="clave" placeholder="clave"/><br/>
            <select name="rol" id="rol">
                <option id="usuario" value="usuario" <?php if ($usuario->getAdministrador() == 0 && $usuario->getPersonal() == 0) echo "selected"; ?>>Usuario</option>
                <option id="personal" value="personal"<?php if ($usuario->getAdministrador() == 0 && $usuario->getPersonal() == 1) echo "selected"; ?>>Personal</option>
                <option id="aministrador" value="administrador" <?php if ($usuario->getAdministrador() == 1) echo "selected"; ?>>Administrador</option>
            </select><br/>
            Activo: 
            <select name="activo">
                <option value="0" <?php if ($usuario->getActivo() == 0) echo "selected"; ?>>No</option>
                <option value="1" <?php if ($usuario->getActivo() == 1) echo "selected"; ?>>Si</option>                
                <option value="-1" <?php if ($usuario->getActivo() == -1) echo "selected"; ?>>Baneado</option>
            </select><br/><br/>
            <input type="submit" id="modificar" value="Modificar" />
        </form>
    </body>
</html>