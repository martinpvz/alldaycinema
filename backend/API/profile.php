<?php

namespace DataBase;

use DataBase\DataBase;

require_once __DIR__ . '/database.php';

class Perfiles extends DataBase
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

    public function list($get)
    {
        $this->response = array();
        $sql = "
            SELECT * FROM perfiles WHERE idcuenta = '{$get['cuenta']}' AND eliminado = 0;
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
            'mensaje' => 'El perfil ya existe en la base de datos'
        );

        if (isset($post['nombre'])) {
            $sql = "
                SELECT * FROM perfiles WHERE nombre = '{$post['nombre']}' AND idcuenta = '{$post['cuenta']}'
                ";
            $result = $this->conexion->query($sql);
            if ($result->num_rows == 0) {
                $this->conexion->set_charset("utf8");

                $sql = "
                    INSERT INTO perfiles (idperfil, idcuenta, nombre, idioma, edad, rutaImagen) VALUES
                    (null, '{$post['cuenta']}', '{$post['nombre']}', '{$post['idioma']}', '{$post['edad']}', '{$post['imagen']}')
                    ";

                if ($this->conexion->query($sql)) {
                    $this->response['estatus'] =  "Correcto";
                    $this->response['mensaje'] =  "El perfil se agregó correctamente";
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
            'mensaje' => 'El perfil no existe en la base de datos'
        );
        if (isset($post['id'])) {
            $sql = "
                UPDATE perfiles SET idcuenta = '{$post['cuenta']}', nombre = '{$post['nombre']}', idioma ='{$post['idioma']}', edad = '{$post['edad']}', rutaImagen = '{$post['imagen']}', eliminado = '{$post['eliminado']}' WHERE idperfil = '{$post['id']}'
                ";
            $this->conexion->set_charset("utf8");
            if ($this->conexion->query($sql)) {
                $this->response['estatus'] =  "Correcto";
                $this->response['mensaje'] =  "El perfil se actualizó correctamente";
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
                UPDATE perfiles SET eliminado = 1 WHERE idperfil = {$post['id']}
                ";
            if ($this->conexion->query($sql)) {
                $this->response['estatus'] =  "Correcto";
                $this->response['mensaje'] =  "El perfil se deshabilitó correctamente";
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
                    SELECT p.idperfil AS id, c.correo AS usuario, p.nombre AS perfil, p.idioma, p.edad, p.rutaImagen AS imagen FROM perfiles AS p LEFT JOIN cuentas AS c ON p.idcuenta = c.idcuenta
                )contenido
                WHERE id = '{$get['search']}' 
                    OR usuario LIKE '%{$get['search']}%' 
                    OR perfil LIKE '%{$get['search']}%' 
                    OR idioma LIKE '%{$get['search']}%' 
                    OR edad LIKE '%{$get['search']}%'
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
