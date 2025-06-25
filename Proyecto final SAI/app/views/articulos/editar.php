<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>MODIFICACION DE ARTICULO</h1>

    <h2>DATOS ARTICULO</h2>
    <?php
    session_start();
    
    $rol = $_SESSION["idRol"];

    if($rol != 1 && $rol != 2 ){
        header("Location: /");
    }
    require "../includes/funciones_articulos.php";
    // Verificar si se recibió el ID del usuario a modificar
    if(isset($_POST["idArticulo"])) {
            $idArticulo = $_POST["idArticulo"];
            $articulo = consulta_datos_articulo($idArticulo);
        }
    // Aquí puedes recuperar los datos del usuario con el ID recibido
    // y mostrar un formulario con esos datos para permitir su modificación
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="idArticulo">ID</label>
        <input type="text" name="idArticulo" value="<?php echo $articulo["idArticulo"];?>" readonly><br>

        <label for="nombre">NOMBRE</label>
        <input type="text" name="nombre" value="<?php echo $articulo["nombre"];?>"><br>

        <label for="ean">EAN</label>
        <input type="text" name="ean" value="<?php echo $articulo["ean"];?>"><br>
        
        <label for="imagenes">IMAGEN</label><br>
        <img src ="../imagenes/<?php echo $articulo["imagen"]; ?>" width="70" height="70"></td><br>
        <input type="file" name="imagen" accept="image/jpeg, image/png"><br>

        <input type="submit" name="modificarArticulo" value="Confirmar"></input>

        <?php
        if(isset($_POST["modificarArticulo"])){
            echo "<pre>";
            var_dump($_POST["modificarArticulo"]);
            echo "</pre>";
            $idArticulo = $_POST["idArticulo"];
            $nombre = $_POST["nombre"];
            $imagen = $_FILES["imagen"];
            $ean = $_POST['ean'];
            $modificarArticulo = actualizar_datos_articulo($idArticulo,$nombre,$imagen, $ean);
    
            if(!$modificarArticulo){
                header("Location: adm_articulos.php");
            exit;
                
            } else{
                echo "ARTICULO NO CREADO";
            }
        }
        ?>



    </form>
</body>
</html>