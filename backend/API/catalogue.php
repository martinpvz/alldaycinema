<?php

namespace DataBase;

use DataBase\DataBase;

require_once __DIR__ . '/database.php';

class Catalogo extends DataBase
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
            SELECT p.idpelicula AS id, concat('Pelicula') AS tipo, r.clave AS region, g.nombre AS genero, c.clave AS clasificacion, p.lanzamiento, p.titulo
            FROM peliculas AS p 
            LEFT JOIN regiones AS r ON p.idgenero = r.idregion
            LEFT JOIN generos AS g ON p.idgenero = g.idgenero
            LEFT JOIN clasificaciones AS c ON p.idclasificacion = c.idclasificacion
            WHERE p.eliminado = 0
            UNION
            SELECT s.idserie AS id, concat('Serie') AS tipo, r.clave, g.nombre, c.clave, s.lanzamiento, s.titulo
            FROM series AS s 
            LEFT JOIN regiones AS r ON s.idgenero = r.idregion
            LEFT JOIN generos AS g ON s.idgenero = g.idgenero
            LEFT JOIN clasificaciones AS c ON s.idclasificacion = c.idclasificacion
            WHERE s.eliminado = 0
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

    public function addPelicula($post)
    {
        $this->response = array(
            'estatus'  => 'Error',
            'mensaje' => 'La película ya existe en la base de datos'
        );

        if (isset($post['titulo'])) {
            $sql = "
                SELECT * FROM peliculas WHERE titulo = '{$post['titulo']}'
                ";
            $result = $this->conexion->query($sql);
            if ($result->num_rows == 0) {
                $this->conexion->set_charset("utf8");

                $sql = "
                    INSERT INTO peliculas (idpelicula, idregion, idgenero, idclasificacion, lanzamiento, titulo, duracion, rutaPortada) VALUES
                    (null, '{$post['region']}', '{$post['genero']}', '{$post['clasificacion']}', '{$post['lanzamiento']}', '{$post['titulo']}', '{$post['duracion']}', '{$post['imagen']}')
                    ";

                if ($this->conexion->query($sql)) {
                    $this->response['estatus'] =  "Correcto";
                    $this->response['mensaje'] =  "La película se agregó correctamente";
                } else {
                    $this->response['mensaje'] = "No se pudo ejecutar la instrucción $sql. " . mysqli_error($this->conexion);
                }
            }
            $result->free();
            $this->conexion->close();
        }
    }

    public function addSerie($post)
    {
        $this->response = array(
            'estatus'  => 'Error',
            'mensaje' => 'La serie ya existe en la base de datos'
        );

        if (isset($post['titulo'])) {
            $sql = "
                SELECT * FROM series WHERE titulo = '{$post['titulo']}'
                ";
            $result = $this->conexion->query($sql);
            if ($result->num_rows == 0) {
                $this->conexion->set_charset("utf8");

                $sql = "
                    INSERT INTO series (idserie, idregion, idgenero, idclasificacion, lanzamiento, titulo, numTemporadas, totalCapitulos, rutaPortada) VALUES
                    (null, '{$post['region']}', '{$post['genero']}', '{$post['clasificacion']}', '{$post['lanzamiento']}', '{$post['titulo']}', '{$post['temporadas']}', '{$post['capitulos']}', '{$post['imagen']}')
                    ";

                if ($this->conexion->query($sql)) {
                    $this->response['estatus'] =  "Correcto";
                    $this->response['mensaje'] =  "La serie se agregó correctamente";
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
            'mensaje' => 'La película o serie no existe en la base de datos'
        );
        if (isset($post['id'])) {
            if ($post['tipo'] == 'Pelicula') {
                $sql = "
                    UPDATE peliculas SET idregion = '{$post['region']}', idgenero = '{$post['genero']}', idclasificacion ='{$post['clasificacion']}', lanzamiento = '{$post['lanzamiento']}', titulo = '{$post['titulo']}', duracion = '{$post['duracion']}', rutaPortada = '{$post['imagen']}', eliminado = '{$post['eliminado']}' WHERE idpelicula = '{$post['id']}'
                    ";
                $this->conexion->set_charset("utf8");
                if ($this->conexion->query($sql)) {
                    $this->response['estatus'] =  "Correcto";
                    $this->response['mensaje'] =  "La película se actualizó correctamente";
                } else {
                    $this->response['mensaje'] = "No se pudo ejecutar la instrucción $sql. " . mysqli_error($this->conexion);
                }
            } else {
                $sql = "
                UPDATE series SET idregion = '{$post['region']}', idgenero = '{$post['genero']}', idclasificacion ='{$post['clasificacion']}', lanzamiento = '{$post['lanzamiento']}', titulo = '{$post['titulo']}', numTemporadas = '{$post['temporadas']}', totalCapitulos = '{$post['capitulos']}', rutaPortada = '{$post['imagen']}', eliminado = '{$post['eliminado']}' WHERE idserie = '{$post['id']}'
                    ";
                $this->conexion->set_charset("utf8");
                if ($this->conexion->query($sql)) {
                    $this->response['estatus'] =  "Correcto";
                    $this->response['mensaje'] =  "La serie se actualizó correctamente";
                } else {
                    $this->response['mensaje'] = "No se pudo ejecutar la instrucción $sql. " . mysqli_error($this->conexion);
                }
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
            if ($post['tipo'] == 'Pelicula') {
                $sql = "
                    UPDATE peliculas SET eliminado = 1 WHERE idpelicula = {$post['id']}
                    ";
                if ($this->conexion->query($sql)) {
                    $this->response['estatus'] =  "Correcto";
                    $this->response['mensaje'] =  "La película se deshabilitó correctamente";
                } else {
                    $this->response['estatus'] = "Error";
                    $this->response['message'] = "No se pudo ejecutar la instrucción $sql. " . mysqli_error($this->conexion);
                }
            } else {
                $sql = "
                UPDATE series SET eliminado = 1 WHERE idserie = {$post['id']}
                ";
                if ($this->conexion->query($sql)) {
                    $this->response['estatus'] =  "Correcto";
                    $this->response['mensaje'] =  "La serie se deshabilitó correctamente";
                } else {
                    $this->response['estatus'] = "Error";
                    $this->response['message'] = "No se pudo ejecutar la instrucción $sql. " . mysqli_error($this->conexion);
                }
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
                    SELECT p.idpelicula AS id, concat('Pelicula') AS tipo, r.clave AS region, r.descripcion, g.nombre AS genero, c.clave AS clasificacion, c.publico, p.lanzamiento, p.titulo, p.rutaPortada AS imagen
                    FROM peliculas AS p 
                    LEFT JOIN regiones AS r ON p.idgenero = r.idregion
                    LEFT JOIN generos AS g ON p.idgenero = g.idgenero
                    LEFT JOIN clasificaciones AS c ON p.idclasificacion = c.idclasificacion
                    WHERE p.eliminado = 0
                    UNION
                    SELECT s.idserie AS id, concat('Serie') AS tipo, r.clave AS region, r.descripcion, g.nombre AS genero, c.clave AS clasificacion, c.publico, s.lanzamiento, s.titulo, s.rutaPortada AS imagen
                    FROM series AS s 
                    LEFT JOIN regiones AS r ON s.idgenero = r.idregion
                    LEFT JOIN generos AS g ON s.idgenero = g.idgenero
                    LEFT JOIN clasificaciones AS c ON s.idclasificacion = c.idclasificacion
                    WHERE s.eliminado = 0
                )contenido 
                WHERE id = '{$get['search']}' 
                    OR region LIKE '%{$get['search']}%' 
                    OR descripcion LIKE '%{$get['search']}%' 
                    OR genero LIKE '%{$get['search']}%' 
                    OR clasificacion LIKE '%{$get['search']}%' 
                    OR publico LIKE '%{$get['search']}%' 
                    OR lanzamiento LIKE '%{$get['search']}%' 
                    OR titulo LIKE '%{$get['search']}%'
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
