<?php
ob_start();
session_start();


$rol = $_SESSION["idRol"];

if($rol != 1 && $rol != 2 ){
    header("Location: /");
}


require "../includes/funciones_ubicaciones.php";
?>




<?php 
    include  "../includes/templates/header.php"
?>


    

    <?php
            // Verificamos si $_SESSION['ok'] está establecido y es verdadero
            if (isset($_SESSION['ok']) && $_SESSION['ok']) {
                echo "<p class = 'correcto'>creado</p>";
                // Limpiamos la variable de sesión después de mostrar el mensaje
                unset($_SESSION['ok']);
            }
            ?>

<div class="contenedor-principal">

<div class="columna1">

    <form class="formulario" action="" method="POST" onsubmit="return comprobacionFormato()">
    <h2>CREACION DE UBICACION</h2>

        <label for="nombre">UBICACIÓN</label>
        <input type="text" id="nombre" name="nombre" required oninput="this.value = this.value.toUpperCase()" placeholder="Ejem.: P01B01C01"><br> <!--Creare un id en este caso para poder facilitar el script de comprobacion y --> 

        

        <input type="submit" name="crearUbicacion">


    </form>
</div>


            <script>
                function comprobacionFormato(){
                    var nombre = document.getElementById("nombre").value; // Cogemos el valor del input de nombre

                    var formato = /^P\d{2}C\d{2}B\d{2}$/; // Este sera el formato permitido

                    if(formato.test(nombre)) {
                        return true;
                    } else {
                        alert("El nombre de la ubicacion no cumple el formato (PnºnºCnºnºBºº)");
                        event.preventDefault();
                    }


                }
            </script>
                <?php
            // Verificamos si $_SESSION['ok'] está establecido y es verdadero
            if (isset($_SESSION['ok'])) {
                if ($_SESSION['ok']){
                    echo "<p class = 'correcto'>creado</p>";
                } else {
                    echo "<p class = 'incorrecto'>la ubicacion ya existe</p>";
                }
                // Limpiamos la variable de sesión después de mostrar el mensaje
                unset($_SESSION['ok']);
            }
            ?>
    <?php


    if(isset($_POST["crearUbicacion"])){
        $nombre = $_POST["nombre"];
        
        
        $crearUbicacion = crear_ubicacion($nombre);

        if($crearUbicacion){
            $_SESSION['ok'] = true;

            
        } else{
            $_SESSION['ok'] = false;
        }
        header("Location: adm_ubicaciones.php");
    }

    ?>

    <div class="columna2-articulos scroll">
    <table class="tabla">

        <tr>
        <th>ID</th>
        <th>NOMBRE</th>

        
        </tr>

        <?php
        $consulta = consulta_ubicaciones();
        while($ubicacion = mysqli_fetch_assoc($consulta)) {
        ?>
        <tr>
            <td><?php echo $ubicacion["idUbi"]; ?></td>
            <td><?php echo $ubicacion["nombre"]; ?></td>
                <form action="" method="POST">
                <td>
                    <input type="hidden" name="idUbi" value="<?php echo $ubicacion["idUbi"]; ?>">
                    <button type="submit" name="eliminarUbicacion">Eliminar</button>
                </form>
            </td>
            <td>
                <form action="mod_ubicacion.php" method="POST">
                    <input type="hidden" name="idUbi" value="<?php echo $ubicacion["idUbi"]; ?>">
                    <button type="submit" name="modificUbicacion">Modificar</button>
                </form>
            </td>
        </tr><?php } ?>
    
            
            <?php
                if(isset($_POST["eliminarUbicacion"])){
                    $idUbi = $_POST["idUbi"];
                    $eliminarUbicacion = eliminar_ubicacion($idUbi);

                    if(!$eliminarUbicacion){
                        
                        header("Location: adm_ubicaciones.php");
                        exit;
                    }else{
                        echo "ERROR";
                    }
                }


            ?>
            </table>
    </div>
</body>
</html>                