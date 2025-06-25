<?php
ob_start();

session_start();

$rol = $_SESSION["idRol"];


if($rol != 1){

    header("Location: /dasdsa" );

}
include  "../includes/templates/header.php";
require "../includes/funciones_usuarios.php";

?>
   <div class="contenedor-principal">

   <div class="columna1">

    <form class="formulario" action="" method="POST">
    <h2>CREACION DE USUARIO</h2>

    <div class="contenedor-campos">
        
        <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required>
        </div>

        <div class="campo">
        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" required>
        </div>

        <div class="campo">
        <label for="email">Email</label>
        <input type="email" name="email" required>
        </div>

        <div class="campo">
        <label for="contraseña">Contraseña</label>
        <input type="password" name="contraseña" required>
        </div>

        <div class="campo">
        <label for="idRol">Rol</label>
        <select name="idRol" required>
            <option value="2">Admin</option>
            <option value="3">Standar</option>
        </select>
        </div>
    </div>

        <input type="submit" name="crearUsuario" value="Crear Usuario">
        <input type="reset" value="Restablcer">
    </form>
    
    <?php
            // Verificamos si $_SESSION['ok'] está establecido y es verdadero
            if (isset($_SESSION['ok'])) {
                if ($_SESSION['ok']){
                    echo "<p class = 'correcto'>creado</p>";
                } else {
                    echo "<p class = 'incorrecto'>ya existe el usuario</p>";
                }
                // Limpiamos la variable de sesión después de mostrar el mensaje
                unset($_SESSION['ok']);
            }
            ?>
</div>



    <?php

    if(isset($_POST["crearUsuario"])){

        $nombre = $_POST["nombre"];
        $apellidos = $_POST["apellidos"];
        $email = $_POST["email"];
        $contraseña = $_POST["contraseña"];
        $idRol = $_POST["idRol"];

        $crearUsuario = crear_usuario($nombre,$apellidos,$email,$contraseña,$idRol);

        if($crearUsuario){
            $_SESSION['ok'] = true;
            
        } else{
            $_SESSION['ok'] = false;
        }
        header("Location: adm_usuarios.php");
    }

    ?>







    <div class="columna2-usuarios scroll " >
        

    
    <table class="tabla">

        <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Email</th>
        <th>Rol</th>
        
        </tr>

        <?php
        $consulta = consulta_usuarios();
        while($usuario = mysqli_fetch_assoc($consulta)) {
            if($usuario["idRol"] != 1){?>
        <tr>
            <td><?php echo $usuario["id"]; ?></td>
            <td><?php echo $usuario["nombre"]; ?></td>
            <td><?php echo $usuario["apellidos"]; ?></td>
            <td><?php echo $usuario["email"]; ?></td>
            <td><?php if ($usuario["idRol"] == 2) {
                echo "Admin";
            } elseif ($usuario["idRol"] == 3) {
                echo "Standar";
            } ?></td>
            <td>
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?php echo $usuario["id"]; ?>">
                    <button type="submit" name="eliminarUsuario">Eliminar</button>
                </form>
            </td>
            <td>
                <form action="mod_usuario.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $usuario["id"]; ?>">
                    <button type="submit" name="modificarUsuario">Modificar</button>
                </form>
            </td>
        </tr><?php } ?>
    
            <?php } ?>
            <?php
                if(isset($_POST["eliminarUsuario"])){
                    $id = $_POST["id"];
                    $eliminarUsuario = eliminar_usuario($id);

                    if(!$eliminarUsuario){
                        
                        header("Location: adm_usuarios.php");
                        exit;
                    }else{
                        echo "ERROR";
                    }
                }


            ?>
            </table>

            </div>
            
    </div>


</body>
</html>                