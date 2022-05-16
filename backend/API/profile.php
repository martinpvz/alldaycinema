<?php

namespace DataBase;

use DataBase\DataBase;

require_once __DIR__ . '/database.php';
session_start();
class Perfiles extends DataBase
{
    public function __construct($string = 'vod')
    {
        $this->response;
        parent::__construct($string);
    }

    public function getResponse()
    {
        return json_encode($this->response, JSON_PRETTY_PRINT);
    }

    public function list($get)
    {
        $data = array();
        $user = $_SESSION['user'];
        // $idCuenta = $this->conexion->query("SELECT idCuenta FROM usuarios WHERE user = '$user'")
        // echo $user;
        // $this->response = array();
        $sql = "
            SELECT * FROM perfiles WHERE idcuenta = (SELECT idCuenta FROM usuarios WHERE user = '$user') AND eliminado = 0;
            ";
        if ($result = $this->conexion->query($sql)) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            if (!is_null($rows)) {
                foreach ($rows as $num => $row) {
                    foreach ($row as $key => $value) {
                        $data[$num][$key] = $value;
                    }
                }
            }
            $result->free();
        } else {
            die('No se pudo completar la operación');
        }
        $this->conexion->close();
        $this->response = $data;
    }

    public function listNumber($get)
    {
        $data = 0;
        $user = $_SESSION['user'];
        // $idCuenta = $this->conexion->query("SELECT idCuenta FROM usuarios WHERE user = '$user'")
        // echo $user;
        // $this->response = array();
        $sql = "
            SELECT COUNT(*) FROM perfiles WHERE idcuenta = (SELECT idCuenta FROM usuarios WHERE user = '$user') AND eliminado = 0;
            ";
        if ($result = $this->conexion->query($sql)) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            if (!is_null($rows)) {
                $data = $rows[0];
            }
            $result->free();
        } else {
            die('No se pudo completar la operación');
        }
        $this->conexion->close();
        $this->response = $data;
    }

    public function add($post)
    {
        $this->response = array(
            'estatus'  => 'Error',
            'mensaje' => 'El perfil ya existe en la base de datos'
        );
        $user = $_SESSION['user'];

        if (isset($post['user'])) {
            $sql = "
                SELECT * FROM perfiles WHERE nombre = '{$post['user']}' AND idcuenta = (SELECT idCuenta FROM usuarios WHERE user = '$user') AND eliminado = 0
                ";
            $result = $this->conexion->query($sql);
            $sql2 = "
                SELECT * FROM perfiles WHERE idcuenta = (SELECT idCuenta FROM usuarios WHERE user = '$user') AND eliminado = 0
                ";
            $result2 = $this->conexion->query($sql2);
            if ($result->num_rows == 0 && $result2->num_rows < 7) {
                $this->conexion->set_charset("utf8");

                $sql = "
                    INSERT INTO perfiles (idperfil, idcuenta, nombre, idioma, edad, rutaImagen) VALUES
                    (null, (SELECT idCuenta FROM usuarios WHERE user = '$user'), '{$post['user']}', '{$post['language']}', '{$post['age']}', '{$post['image']}')
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
            header("location:../../profiles.php"); 
        }
    }

    public function edit($post)
    {
        $this->response = array(
            'estatus'  => 'Error',
            'mensaje' => 'El perfil no existe en la base de datos'
        );
        var_dump($post);
        if (isset($post['idprofile'])) {
            $sql = "
                UPDATE perfiles SET idcuenta = '{$post['idaccount']}', nombre = '{$post['user']}', idioma ='{$post['language']}', edad = '{$post['age']}', rutaImagen = '{$post['image']}' WHERE idperfil = '{$post['idprofile']}'
                ";
            $this->conexion->set_charset("utf8");
            if ($this->conexion->query($sql)) {
                $this->response['estatus'] =  "Correcto";
                $this->response['mensaje'] =  "El perfil se actualizó correctamente";
            } else {
                $this->response['mensaje'] = "No se pudo ejecutar la instrucción $sql. " . mysqli_error($this->conexion);
            }
            $this->conexion->close();
            header("location:../../profiles.php"); 
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
            // header("location:../../profiles.php"); 
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
    public function searchById($get)
    {
        $this->response = array();
        if (isset($get['search'])) {
            $sql = "
                SELECT * FROM Perfiles
                WHERE idperfil = '{$get['search']}'
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
                // $nombre = $this->response[0]['nombre'];
                // $imagen = $this->response[0]['rutaImagen'];
                // $_SESSION['profile'] = $nombre;
                // $_SESSION['imagen'] = $imagen;
                $result->free();
            } else {
                die('No se pudo completar la operación');
            }
            $this->conexion->close();
        }
    }
}
