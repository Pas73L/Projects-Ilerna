<?php
$pagina = $_GET['pagina'] ?? 'login';

switch ($pagina) {
    case 'articulos':
        require 'app/controllers/ArticuloController.php';
        break;
    case 'usuarios':
        require 'app/controllers/UsuarioController.php';
        break;
    case 'ubicaciones':
        require 'app/controllers/UbicacionController.php';
        break;
    default:
        require 'app/views/login.php';
}
?>
