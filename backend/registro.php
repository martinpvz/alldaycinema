<?php
namespace API\Create;
    
use  API\Database;
require_once __DIR__.'/../database.php';

class registrar extends Database {

    public function add($post){
        $nombre = trim($post["name"]);
        $apellidos = trim($post["lastname"]);
        $correo = trim($post["email"]);
        $tipoCuenta = trim($post["account"]);
        $pais = trim($post["country"]);
        $numTarjeta = trim($post["card"]);
        $suscripcion = trim($post["suscription"]);
        $usuario = trim($post["user"]);
        $contraseña = trim($post["password"]);

        //INSERT INTO usuario (idusuario, idcuenta, user, pass, nivel)
        //(NULL, 1, 'admin', 'admin', 0);
        //SELECT idcuenta FROM cuenta WHERE $_POST['nombre']=nombre;
        //(NULL, $idcuenta, $_POST['usuario'], $_POST['password'], $_POST['nivel'])

        $sql = "INSERT INTO cuenta(idcuenta, nombre, apellidos, correo, tipo, pais, numTarjeta, periodicidad, fechaCreacion) VALUES (NULL,'$nombre','$apellidos','$correo', '$tipoCuenta','$pais','$numTarjeta','$suscripcion', 'now()')";
        $result = $conexion->query($sql);

        $idcuenta = $conexion->query("SELECT idcuenta FROM cuenta WHERE nombre = $nombre");


        $sql = "INSERT INTO usuario (idusuario, idcuenta, user, pass) VALUES (NULL, '$idcuenta','$usuario','$contraseña')";
        $result = $conexion->query($sql);
        }
    }
?>