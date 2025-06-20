<?php

require "db.php";

//--------------- CONSULTA DE EAN ---------------//
function consulta_ean($ean){
    $db = conexionDB();

    // Comprobaremos si el ean que se introduce como parametro existe en la tabla de articulos
    $sql = "SELECT * FROM articulos WHERE ean = '$ean'";

    $consulta = mysqli_query($db, $sql);

    $articulo = mysqli_fetch_assoc($consulta);

    if($articulo){
        return $articulo["idArticulo"];
    } else {
        return false;
    }

}

//--------------- CONSULTA DE UBICACION ---------------//

function consulta_ubicacion($ubicacion){
    $db = conexionDB();

    // Comprobaremos si la ubicacion que se introduce como parametro existe en la tabla de articulos
    $sql = "SELECT * FROM ubicaciones WHERE nombre = '$ubicacion'";

    $consulta = mysqli_query($db, $sql);

    $ubicacion = mysqli_fetch_assoc($consulta);

    if($ubicacion){
        return $ubicacion["idUbi"];
    } else {
        return false;
    }

}

//--------------- FUNCION DE DAR DE ENTRADA AL ARTICULO ---------------//

function dar_entrada($ean, $cantidad, $ubicacion) {

    $db = conexionDB();

    // Usaremos las funciones de consulta de ubicacion y ean para saber si dichos parametros existen en nuestra base de datos
    $idUbi = consulta_ubicacion($ubicacion);
    $idArticulo = consulta_ean($ean);

    // En caso de que existan, haremos la consulta e insertaremos los datos
    if(consulta_ean($ean) && consulta_ubicacion($ubicacion)){
        
        $sql = "INSERT INTO ubicacion_articulo (idUbi, idArticulo, cantidad) VALUES ('$idUbi','$idArticulo','$cantidad')";
        $consulta = mysqli_query($db, $sql);

        mysqli_close($db); 
        return true;
        
    } else {
        mysqli_close($db);
        return false;
    }

}

//--------------- CONSULTA TODAS LAS ENTRADAS---------------//

function consulta_entradas(){

    $db = conexionDB();

    // Consultaremos todas las entradas existentes de la tabla ubicacion_articulo. Haremos una INNER JOIN ya que queremos seleccionar el nombre del articulo, el nombre de la ubicacion y la cantidad de las respectivas entradas.


    $sql = "SELECT ua.ID AS 'ID Ubicación-Artículo', a.nombre AS 'Nombre Artículo', u.nombre AS 'Nombre Ubicación', ua.Cantidad
    FROM ubicacion_articulo ua
    JOIN articulos a ON ua.idArticulo = a.idArticulo
    JOIN ubicaciones u ON ua.idUbi = u.idUbi
    ORDER BY u.nombre;"; // Estoy haciendo referencia con ua = tabla ubicacion articulo, a = tabla a, u = tabla ubicacion
    $consulta = mysqli_query($db, $sql);

    mysqli_close($db); 
    return $consulta;

}

function eliminar_entrada($idEntrada) {

    $db = conexionDB();
    
        $sql = "DELETE FROM ubicacion_articulo WHERE ID = '$idEntrada'";
        $consulta = mysqli_query($db, $sql);


        mysqli_close($db);

}

?>
