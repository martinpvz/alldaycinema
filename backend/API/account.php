<?php

namespace DataBase;

use DataBase\DataBase;

require_once __DIR__ . '/database.php';

class Cuentas extends DataBase
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

    public function list()
    {
        $this->response = array();
        $sql = "
        SELECT idcuenta AS id, nombre, apellidos, correo, tipo AS subscripcion, pais, numTarjeta AS tarjeta, periodicidad, fechaCreacion FROM cuentas WHERE eliminado = 0
            ";

        if ($result = $this->conexion->query($sql)) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            if (!is_null($rows)) {
                foreach ($rows as $num => $row) {
                    foreach ($row as $key => $value) {
                        $this->response[$num][$key] = $value;
                    }
                }
            }
            $result->free();
        } else {
            die('No se pudo completar la operación');
        }
        $this->conexion->close();
    }

    public function add($post)
    {
        $this->response = array(
            'estatus'  => 'Error',
            'mensaje' => 'La cuenta ya existe en la base de datos'
        );

        if (isset($post['correo'])) {
            $sql = "
                SELECT * FROM cuentas WHERE correo = '{$post['correo']}'
                ";
            $result = $this->conexion->query($sql);
            if ($result->num_rows == 0) {
                $this->conexion->set_charset("utf8");

                $sql = "
                INSERT INTO cuentas (idcuenta, nombre, apellidos, correo, tipo, pais, numTarjeta, periodicidad, fechaCreacion) VALUES
                (NULL, '{$post['nombre']}', '{$post['apellidos']}', '{$post['correo']}', '{$post['tipo']}', '{$post['pais']}', '{$post['tarjeta']}', '{$post['periodicidad']}', now())
                    ";

                if ($this->conexion->query($sql)) {
                    $this->response['estatus'] =  "Correcto";
                    $this->response['mensaje'] =  "La cuenta se agregó correctamente";
                } else {
                    $this->response['mensaje'] = "No se pudo ejecutar la instrucción $sql. " . mysqli_error($this->conexion);
                }
            }
            $result->free();
            $this->conexion->close();
        }
    }

    public function edit($post)
    {
        $this->response = array(
            'estatus'  => 'Error',
            'mensaje' => 'La cuenta no existe en la base de datos'
        );
        if (isset($post['id'])) {
            $sql = "
                    UPDATE cuentas SET nombre = '{$post['nombre']}', apellidos = '{$post['apellidos']}', correo ='{$post['correo']}', tipo = '{$post['tipo']}', pais = '{$post['pais']}', numTarjeta = '{$post['tarjeta']}', periodicidad = '{$post['periodicidad']}', eliminado = '{$post['eliminado']}' WHERE idcuenta = '{$post['id']}'
                    ";
            $this->conexion->set_charset("utf8");
            if ($this->conexion->query($sql)) {
                $this->response['estatus'] =  "Correcto";
                $this->response['mensaje'] =  "La cuenta se actualizó correctamente";
            } else {
                $this->response['mensaje'] = "No se pudo ejecutar la instrucción $sql. " . mysqli_error($this->conexion);
            }
            $this->conexion->close();
        }
    }

    public function delete($post)
    {
        $this->response = array(
            'estatus'  => 'Error',
            'mensaje' => 'No se pudo realizar la operación'
        );

        if (isset($post['id'])) {
            $sql = "
                UPDATE cuentas SET eliminado = 1 WHERE idcuenta = {$post['id']}
                ";
            if ($this->conexion->query($sql)) {
                $this->response['estatus'] =  "Correcto";
                $this->response['mensaje'] =  "La cuenta se deshabilitó correctamente";
            } else {
                $this->response['estatus'] = "Error";
                $this->response['message'] = "No se pudo ejecutar la instrucción $sql. " . mysqli_error($this->conexion);
            }
            $this->conexion->close();
        }
    }

    public function search($get)
    {
        $this->response = array();
        if (isset($get['search'])) {
            $sql = "
                SELECT * FROM (
                    SELECT idcuenta AS id, nombre, apellidos, correo, tipo AS subscripcion, pais, periodicidad, fechaCreacion FROM cuentas WHERE eliminado = 0
                )contenido 
                WHERE id = '{$get['search']}' 
                    OR nombre LIKE '%{$get['search']}%' 
                    OR apellidos LIKE '%{$get['search']}%' 
                    OR correo LIKE '%{$get['search']}%' 
                    OR pais LIKE '%{$get['search']}%' 
                    OR fechaCreacion LIKE '%{$get['search']}%' 
                ";
            if ($result = $this->conexion->query($sql)) {
                $rows = $result->fetch_all(MYSQLI_ASSOC);
                if (!is_null($rows)) {
                    foreach ($rows as $num => $row) {
                        foreach ($row as $key => $value) {
                            $this->response[$num][$key] = $value;
                        }
                    }
                }
                $result->free();
            } else {
                die('No se pudo completar la operación');
            }
            $this->conexion->close();
        }
    }
}
