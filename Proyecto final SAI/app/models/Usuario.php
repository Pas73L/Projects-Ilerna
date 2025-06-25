<?php


require "db.php";

function inicioSesion($email, $contraseña){
        //IMPORTAR CREDENCIALES
        $db = conexionDB();

        //CONSULTA SQL
        $sql = "SELECT * FROM usuarios WHERE email = '$email';";
        ;

        //REALIZAR LA CONSULTA
        $consulta = mysqli_query($db, $sql);

        

        if ($consulta -> num_rows) {
            $usuario = mysqli_fetch_assoc($consulta);

            
            echo "EL USUARIO SI EXISTE<br>";

            $auth = password_verify($contraseña, $usuario["contraseña"]);


            if($auth) {
                session_start();
                $_SESSION["login"] = true;
                $_SESSION["idRol"] = $usuario["idRol"]; 

                return $auth;


            } else {

                echo "LA CONTRASEÑA ES ERRONEA<br>";
            }

        } else {
            echo "EL USUARIO NO EXISTE<br>";
        }

}


////////////////////////

function consulta_usuarios(){
    try{
        //IMPORTAR CREDENCIALES
        $db = conexionDB();

        //CONSULTA SQL
        $sql = "SELECT * FROM usuarios;";

        //REALIZAR LA CONSULTA
        $consulta = mysqli_query($db, $sql);

        return $consulta;




    } catch (\Throwable $th) {
        var_dump($th);
    }
}

///////////////////////////

function consulta_correo($email){
    $db = conexionDB();

    $sql = "SELECT * FROM usuarios WHERE email = '$email'";

    $consulta = mysqli_query($db, $sql);

    $usuario = mysqli_fetch_assoc($consulta);

    if($usuario){
        return true;
    } else {
        return false;
    }

}

function crear_usuario($nombre, $apellidos, $email, $contraseña, $idRol){
    $contraseñaSegura = password_hash($contraseña, PASSWORD_DEFAULT);


        $db = conexionDB();

        $verificacionCorreo = consulta_correo($email);

        if(!$verificacionCorreo){

            $sql = "INSERT INTO usuarios (nombre, apellidos, email, contraseña, idRol) VALUES ('$nombre', '$apellidos', '$email', '$contraseñaSegura', '$idRol')";

            $consulta = mysqli_query($db, $sql);

            if($consulta) {
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

function eliminar_usuario($id){
    try {
        $db = conexionDB();

        $sql = "DELETE FROM usuarios WHERE id = '$id'";

        $consulta = mysqli_query($db, $sql);
        mysqli_close($db);

    } catch (\Throwable $th) {
        var_dump($th) ;
    }
}




////////////////
function consulta_datos_usuario($id){
    try {
        $db = conexionDB();

        $sql = "SELECT * FROM usuarios WHERE id = '$id'";

        $consulta = mysqli_query($db, $sql);

        $usuario = mysqli_fetch_assoc($consulta);


        mysqli_close($db);
        return $usuario;



    } catch (\Throwable $th) {
        var_dump($th) ;
    }
    }

///////////////////////

function actualizar_datos_usuario($id,$nombre, $apellidos, $email, $contraseña, $idRol){
    $contraseñaSegura = password_hash($contraseña, PASSWORD_DEFAULT);
    try {
        $db = conexionDB();

        $sql = "UPDATE usuarios SET nombre='$nombre', apellidos='$apellidos', email='$email', contraseña='$contraseñaSegura', idRol='$idRol' WHERE id='$id'";

        $consulta = mysqli_query($db, $sql);
        mysqli_close($db);

    } catch (\Throwable $th) {
        var_dump($th) ;
    }
}
?>
