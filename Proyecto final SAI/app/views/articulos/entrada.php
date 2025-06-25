<?php
ob_start();
session_start();
$rol = $_SESSION["idRol"];


require "../includes/funciones_entrada.php";
?>


<?php 
    include  "../includes/templates/header.php"
?>
    <div class="contenedor-principal">

<div class="columna1">
    
    <form class="formulario" action="" method="POST">
    <h2>ENTRADAS DE ARTICULOS</h2>
    <div class="contenedor-campos">

    <div class="campo">
        <label for="ean">Ean</label>
        <input type="text" name="ean" required><br>
    </div>
        <div class="campo">
        <label for="ubicacion">Ubicacion</label>
        <input type="text" name="ubicacion" required><br>
        </div>
        <div class="campo">
        <label for="cantidad">Cantidad</label>
        <input type="number" name="cantidad" required><br>
        </div>

    </div>
        <input type="submit" name="darEntrada">

    </form>
</div>

    <?php

    if(isset($_POST["darEntrada"])){
        $ean = $_POST["ean"];
        $cantidad = $_POST["cantidad"];
        $ubicacion = $_POST["ubicacion"];


        
        $darEntrada = dar_entrada($ean,$cantidad, $ubicacion);

        if($darEntrada){

            header("Location: entrada_articulos.php");
            
        } else{
            echo "ARTICULO NO CREADO";
        }
    }

    ?>

<div class="columna2-articulos scroll">
    <table class="tabla">
        <tr>
        <th>ID ENTRADA ||</th>
        <th>NOMBRE ARTICULO ||</th>
        <th>NOMBRE UBICACION ||</th>
        <th>STOCK</th>
        
        </tr>

        <?php
        $consulta = consulta_entradas();
        while($entrada = mysqli_fetch_assoc($consulta)) {
        ?>
        <tr>
        <td><?php echo $entrada["ID Ubicación-Artículo"]; ?></td>
        <td><?php echo $entrada["Nombre Artículo"]; ?></td>
        <td><?php echo $entrada["Nombre Ubicación"]; ?></td>
        <td><?php echo $entrada["Cantidad"]; ?></td>
            <td>
                <form action="" method="POST">
                    <input type="hidden" name="idEntrada" value="<?php echo $entrada["ID Ubicación-Artículo"]; ?>">
                    <button type="submit" name="eliminarEntrada">Eliminar</button>
                </form>
            </td>

        </tr><?php } ?>
    
            
            <?php
                if(isset($_POST["eliminarEntrada"])){
                    $idEntrada = $_POST["idEntrada"];
                    $eliminarEntrada = eliminar_entrada($idEntrada);

                    if(!$eliminarArticulo){
                        
                        header("Location: entrada_articulos.php");
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