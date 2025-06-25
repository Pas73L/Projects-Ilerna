<?php
require "../includes/funciones_usuarios.php";

if(isset($_POST["iniciarSesion"])) {
    $email = $_POST["email"];
    $contraseña = $_POST["contraseña"];

    if(inicioSesion($email, $contraseña)) {

        if($_SESSION["idRol"] == 1){
            header("Location: adm_usuarios.php");
            exit;
        }
        elseif($_SESSION["idRol"] == 2){
            header("Location: www.google.com");
            exit;
        }
        elseif($_SESSION["idRol"] == 3){
            header("Location: entrada_articulos.php");
            exit;
        }

    } else {
        
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" href="../includes/templates/normalize.css" as="style">
    <link rel="stylesheet" href="../includes/templates/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anta&family=Overpass:ital,wght@0,900;1,900&display=swap" rel="stylesheet">
    <link href="../includes/templates/estilo.css" rel="stylesheet">
</head>
<body>
    
    <div class = "contenedor-log">

    <form class="formulario" method="POST">
        <fieldset>
            <legend>INICIO DE SESIÓN</legend>

            <div class="formulario__campo">
            <label for="email">Email</label>
            <input type="text" name="email">
            </div>

            <div class="formulario__campo">
            <label for="contraseña">Contraseña</label>
            <input type="password" name="contraseña">
            </div>

            <div class="formulario__boton">
            <input type="submit" name="iniciarSesion" value="Iniciar Sesión">
            </div>
        </fieldset>
    </form>
    </div>

    </body>

</html>