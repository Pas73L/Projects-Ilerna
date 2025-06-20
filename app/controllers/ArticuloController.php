<?php
require_once 'app/models/Articulo.php';
$articulos = obtenerArticulos(); // función ejemplo desde el modelo
require 'app/views/articulos/index.php';
?>
