<?php
include_once __DIR__.'/database.php';

echo "Holaaa";
$pais = $_POST["country"];
echo $pais;

/*if(isset($_POST["guardar"])){
    if(strlen($_POST["name"]) < 1 && strlen($_POST["lastname"])<1 && strlen($_POST["account"])<1 && strlen($_POST["account"])<1 && strlen($_POST["card"])<1 && strlen($_POST["suscription"])<1 && strlen($_POST["user"])<1 && strlen($_POST["password"]) <1){
        $nombre = trim($_POST["name"]);
        $apellidos = trim($_POST["lastname"]);
        $tipoCuenta = trim($_POST["account"]);
        $pais = trim($_POST["account"]);
        $numTarjeta = trim($_POST["card"]);
        $suscripcion = trim($_POST["suscription"]);
        $usuario = trim($_POST["user"]);
        $contraseña = trim($_POST["password"]);

        $sql = "INSERT INTO cuenta(nombre, apellidos, correo, tipo, pais, numTarjeta, periodicidad, fechaCreacion, eliminado) VALUES ('$nombre','$apellidos','$usuario', '$tipoCuenta','$pais','$numTarjeta','$suscripcion')";
    }
}*/
?>