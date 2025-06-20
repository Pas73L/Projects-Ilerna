<?php
ob_start();

session_start();


$rol = $_SESSION["idRol"];

if($rol != 1 && $rol != 2 ){
    header("Location: /");
}
include  "../includes/templates/header.php"; 
require "../includes/funciones_articulos.php";
?>

    <div class="contenedor-principal">

    <div class="columna1">

    <form class="formulario" action="" method="POST" enctype="multipart/form-data"> 
    <h2>CREACION DEL ARTICULO</h2>

        <div class="contenedor-campos">
        <div class="campo">
            <label for="nombre">Nombre</label>
            <input class="input-text" type="text" name="nombre" required oninput="this.value = this.value.toUpperCase()">
        </div>

        <div class="campo">
            <label for="ean">Ean</label>
            <input class="input-text" type="text" name="ean" required>
        </div>

        <div class="campo">
            <label for="imagen">Imagen</label>
        <input type="file" name="imagen" accept="image/jpeg, image/png" >
        </div>

        </div>

        <input type="submit" name="crearArticulo">
        

    </form>

    <?php
            // Verificamos si $_SESSION['ok'] está establecido y es verdadero
            if (isset($_SESSION['ok'])) {
                if ($_SESSION['ok']){
                    echo "<p class = 'correcto'>creado</p>";
                } else {
                    echo "<p class = 'incorrecto'>ya existe el articulo</p>";
                }
                // Limpiamos la variable de sesión después de mostrar el mensaje
                unset($_SESSION['ok']);
            }
            ?>

            

    <?php

    if(isset($_POST["crearArticulo"])){
        $nombre = $_POST["nombre"];
        $ean = $_POST["ean"];
        $imagen = $_FILES["imagen"];

        
        $crearArticulo = crear_articulo($nombre,$imagen, $ean);

        if($crearArticulo) {

            $_SESSION['ok'] = true;
        
            } else{
                $_SESSION['ok'] = false;

                }
                header("Location: adm_articulos.php");
    }

    ?>
    </div>

    <div class="columna2-articulos scroll">
    <table class="tabla">
        <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>STOCK</th>
        <th>EAN</th>
        <th>IMAGEN</th>
        
        </tr>

        <?php
        $consulta = consulta_articulo();
        while($articulo = mysqli_fetch_assoc($consulta)) {
        ?>
        <tr>
            <td><?php echo $articulo["idArticulo"]; ?></td>
            <td><?php echo $articulo["nombre"]; ?></td>
            <td><?php echo $articulo["CantidadStock"]; ?></td>
            <td><?php echo $articulo["ean"]; ?></td>
            
            <td>
                <img src ="../imagenes/<?php echo $articulo["imagen"]; ?>" width="75" height="75"></td>
            <td>
                <form action="" method="POST">
                    <input type="hidden" name="idArticulo" value="<?php echo $articulo["idArticulo"]; ?>">
                    <button type="submit" name="eliminarArticulo">Eliminar</button>
                </form>
            </td>
            <td>
                <form action="mod_articulo.php" method="POST">
                    <input type="hidden" name="idArticulo" value="<?php echo $articulo["idArticulo"]; ?>">
                    <button type="submit" name="modificArticulo">Modificar</button>
                </form>
            </td>
        </tr><?php } ?>
    
            
            <?php
                if(isset($_POST["eliminarArticulo"])){
                    $idArticulo = $_POST["idArticulo"];
                    $eliminarArticulo = eliminar_articulo($idArticulo);

                    if(!$eliminarArticulo){
                        
                        header("Location: adm_articulos.php");
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