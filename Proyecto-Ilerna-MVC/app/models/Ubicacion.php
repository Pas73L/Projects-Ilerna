<?php

require "db.php";



////////////////////////

function consulta_ubicaciones(){
    try{
        //IMPORTAR CREDENCIALES
        $db = conexionDB();

        //CONSULTA SQL
        $sql = "SELECT * FROM ubicaciones;";

        //REALIZAR LA CONSULTA
        $consulta = mysqli_query($db, $sql);

        return $consulta;




    } catch (\Throwable $th) {
        var_dump($th);
    }
}

///////////////////////////



                    


function consulta_ubicacion($nombre){
    $db = conexionDB();

    $sql = "SELECT * FROM ubicaciones WHERE nombre = '$nombre'";

    $consulta = mysqli_query($db, $sql);

    $ubicacion = mysqli_fetch_assoc($consulta);

    if($ubicacion){
        return true;
    } else {
        return false;
    }

}

function crear_ubicacion($nombre){
    


        $db = conexionDB();

        $comprobarUbicacion = consulta_ubicacion($nombre);

        if(!$comprobarUbicacion) {

            $sql = "INSERT INTO ubicaciones (nombre) VALUES ('$nombre')";
            $consulta = mysqli_query($db, $sql);

            if($consulta){
                mysqli_close($db);
                return true;
            } else {
                mysqli_close($db);
                return false;
            }
            
        } else {
            mysqli_close($db);
            return false;
        }


        

}

///////////////////////////

function eliminar_ubicacion($idUbi){
    try {
        $db = conexionDB();


        $sql = "DELETE FROM ubicaciones WHERE idUbi = '$idUbi'";

        $consulta = mysqli_query($db, $sql);
        mysqli_close($db);

    } catch (\Throwable $th) {
        var_dump($th) ;
    }
}




////////////////
function consulta_datos_ubicacion($idUbi){
    try {
        $db = conexionDB();

        $sql = "SELECT * FROM ubicaciones WHERE idUbi = '$idUbi'";

        $consulta = mysqli_query($db, $sql);

        $ubicacion = mysqli_fetch_assoc($consulta);


        mysqli_close($db);
        return $ubicacion;



    } catch (\Throwable $th) {
        var_dump($th) ;
    }
    }

///////////////////////

function actualizar_datos_ubicacion($idUbi, $nombre){
    try {
        $db = conexionDB();

        $sql = "UPDATE ubicaciones SET nombre='$nombre' WHERE idArticulo='$idUbi'";

        $consulta = mysqli_query($db, $sql);
        mysqli_close($db);

    } catch (\Throwable $th) {
        var_dump($th) ;
    }
}

?>
