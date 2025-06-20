<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>MODIFICACION DE USUARIO</h1>

    <h2>DATOS USUARIOS</h2>
    <?php
    session_start();
    
    $rol = $_SESSION["idRol"];

    if($rol != 1){
        header("Location: /");
    }
    require "../includes/funciones_usuarios.php";
    // Verificar si se recibió el ID del usuario a modificar
    if(isset($_POST["id"])) {
            $id = $_POST["id"];
            $usuario = consulta_datos_usuario($id);
        }
    // Aquí puedes recuperar los datos del usuario con el ID recibido
    // y mostrar un formulario con esos datos para permitir su modificación
    ?>
    <form action="" method="POST">
        <label for="id">ID</label>
        <input type="text" name="id" value="<?php echo $usuario["id"];?>" readonly><br>

        <label for="nombre">NOMBRE</label>
        <input type="text" name="nombre" value="<?php echo $usuario["nombre"];?>"><br>

        <label for="apellidos">APELLIDOS</label>
        <input type="text" name="apellidos" value="<?php echo $usuario["apellidos"];?>"><br>

        <label for="email">EMAIL</label>
        <input type="email" name="email" value="<?php echo $usuario["email"];?>"><br>

        <label for="contraseña">CONTRASEÑA</label>
        <input type="password" name="contraseña"><br>

        <label for="idRol">Rol</label>
        <select name="idRol">
            <option value="2" <?php if($usuario["idRol"] == 2) echo "selected"; ?>>Admin</option>
            <option value="3" <?php if($usuario["idRol"] == 3) echo "selected"; ?>>Standar</option>
        </select>
        <input type="submit" name="modificarUsario" value="Confirmar"></input>

        <?php
        if(isset($_POST["modificarUsario"])){
            $id = $_POST["id"];
            $nombre = $_POST["nombre"];
            $apellidos = $_POST["apellidos"];
            $email = $_POST["email"];
            $contraseña = $_POST["contraseña"];
            $idRol = $_POST["idRol"];
            $modificarUsuario = actualizar_datos_usuario($id,$nombre,$apellidos,$email,$contraseña,$idRol);
    
            if(!$modificarUsuario){
                header("Location: adm_usuarios.php");
            exit;
                
            } else{
                echo "USUARIO NO CREADO";
            }
        }
        ?>



    </form>
</body>
</html>