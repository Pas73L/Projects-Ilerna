<?php



function conexionDB() {
    $db = mysqli_connect("localhost", "root", "Ilerna861996", "sai");

    if(!$db){
        echo "HUBO UN ERROR";
        exit;
    }
    
    return $db;
}




?>