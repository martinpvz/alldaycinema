<?php
$conexion = mysqli_connect(
    "localhost",
    "root",
    "pichu2015",
    "vod");

if(!$conexion) {
    die('¡Base de datos NO conectada!');
}
?>