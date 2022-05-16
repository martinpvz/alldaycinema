<?php

namespace Database;

use DataBase\DataBase;
use DataBase\Perfiles;

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/profile.php';

class Cuenta extends Database
{

    public function __construct($string = 'vod')
    {
        $this->response = "";
        parent::__construct($string);
    }

    public function getResponse()
    {
        return json_encode($this->response, JSON_PRETTY_PRINT);
    }

    public function create($post)
    {
        $this->response = array(
            'estatus'  => 'Error',
            'mensaje' => 'La cuenta ya existe'
        );
        if (isset($post['name'])) {
            $sql = "SELECT * FROM cuentas where nombre = '{$post['name']}' AND eliminado = 0";
            $result = $this->conexion->query($sql);
            if ($result->num_rows == 0) {
                $this->conexion->set_charset("utf8");
                //SE REALIZA LA CONSULTA PARA INSERTAR LOS DATOS EN LA TABLA DE CUENTA
                $sql = "INSERT INTO cuentas(idcuenta, nombre, apellidos, correo, tipo, pais, numTarjeta, periodicidad, fechaCreacion) VALUES (NULL,'{$post['name']}','{$post['lastname']}','{$post['email']}', '{$post['account']}','{$post['country']}','{$post['card']}','{$post['suscription']}', now())";
                if ($this->conexion->query($sql)) {
                    $this->response['estatus'] =  "Correcto";
                    $this->response['mensaje'] =  "La cuenta se agregó correctamente";
                    $this->conexion->set_charset("utf8");
                    //SE REALIZA LA CONSULTA PARA INSERTAR LOS DATOS EN LA TABLA DE USUARIO
                    $sql = "INSERT INTO usuarios (idusuario, idcuenta, user, pass) VALUES (NULL, (SELECT idcuenta FROM cuentas WHERE nombre='{$post['name']}'), '{$post['user']}', '{$post['password']}')";
                    if ($this->conexion->query($sql)) {
                        $this->response['estatus'] =  "Correcto";
                        $this->response['mensaje'] =  "El usuario se agregó correctamente";
                        header("location:../../index.php");
                    } else {
                        $this->response['mensaje'] = "No se pudo ejecutar la instrucción $sql. " . mysqli_error($this->conexion);
                    }
                } else {
                    $this->response['mensaje'] = "No se pudo ejecutar la instrucción $sql. " . mysqli_error($this->conexion);
                }
            }
        }
        $this->conexion->close();
    }
}
