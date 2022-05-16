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

    public function list($get)
    {
        $this->response = array();
        $tipo = $get['type'];
        if ($get['type'] == "Movies") {
            $sql = "
            SELECT p.idpelicula AS id, concat('Pelicula') AS tipo, r.clave AS region, g.nombre AS genero, c.clave AS clasificacion, p.lanzamiento, p.titulo, p.rutaPortada
            FROM peliculas AS p 
            LEFT JOIN regiones AS r ON p.idgenero = r.idregion
            LEFT JOIN generos AS g ON p.idgenero = g.idgenero
            LEFT JOIN clasificaciones AS c ON p.idclasificacion = c.idclasificacion
            WHERE p.eliminado = 0";
        } elseif($get['type'] == "Series") {
            $sql = "
            SELECT s.idserie AS id, concat('Serie') AS tipo, r.clave, g.nombre, c.clave, s.lanzamiento, s.titulo, s.rutaPortada
            FROM series AS s 
            LEFT JOIN regiones AS r ON s.idgenero = r.idregion
            LEFT JOIN generos AS g ON s.idgenero = g.idgenero
            LEFT JOIN clasificaciones AS c ON s.idclasificacion = c.idclasificacion
            ";
        } elseif($get['type'] == "Acción") {
            $sql = "
            SELECT p.idpelicula AS id, concat('Pelicula') AS tipo, r.clave AS region, g.nombre AS genero, c.clave AS clasificacion, p.lanzamiento, p.titulo, p.rutaPortada
            FROM peliculas AS p 
            LEFT JOIN regiones AS r ON p.idgenero = r.idregion
            LEFT JOIN generos AS g ON p.idgenero = g.idgenero
            LEFT JOIN clasificaciones AS c ON p.idclasificacion = c.idclasificacion
            WHERE p.eliminado = 0 AND p.idgenero = 2
            UNION
            SELECT s.idserie AS id, concat('Serie') AS tipo, r.clave, g.nombre, c.clave, s.lanzamiento, s.titulo, s.rutaPortada
            FROM series AS s 
            LEFT JOIN regiones AS r ON s.idgenero = r.idregion
            LEFT JOIN generos AS g ON s.idgenero = g.idgenero
            LEFT JOIN clasificaciones AS c ON s.idclasificacion = c.idclasificacion
            WHERE s.eliminado = 0 AND s.idgenero = 2
            ";
        } elseif($get['type'] == "Ciencia Ficción") {
            $sql = "
            SELECT p.idpelicula AS id, concat('Pelicula') AS tipo, r.clave AS region, g.nombre AS genero, c.clave AS clasificacion, p.lanzamiento, p.titulo, p.rutaPortada
            FROM peliculas AS p 
            LEFT JOIN regiones AS r ON p.idgenero = r.idregion
            LEFT JOIN generos AS g ON p.idgenero = g.idgenero
            LEFT JOIN clasificaciones AS c ON p.idclasificacion = c.idclasificacion
            WHERE p.eliminado = 0 AND p.idgenero = 1
            UNION
            SELECT s.idserie AS id, concat('Serie') AS tipo, r.clave, g.nombre, c.clave, s.lanzamiento, s.titulo, s.rutaPortada
            FROM series AS s 
            LEFT JOIN regiones AS r ON s.idgenero = r.idregion
            LEFT JOIN generos AS g ON s.idgenero = g.idgenero
            LEFT JOIN clasificaciones AS c ON s.idclasificacion = c.idclasificacion
            WHERE s.eliminado = 0 AND s.idgenero = 1
            ";
        } elseif($get['type'] == "Drama") {
            $sql = "
            SELECT p.idpelicula AS id, concat('Pelicula') AS tipo, r.clave AS region, g.nombre AS genero, c.clave AS clasificacion, p.lanzamiento, p.titulo, p.rutaPortada
            FROM peliculas AS p 
            LEFT JOIN regiones AS r ON p.idgenero = r.idregion
            LEFT JOIN generos AS g ON p.idgenero = g.idgenero
            LEFT JOIN clasificaciones AS c ON p.idclasificacion = c.idclasificacion
            WHERE p.eliminado = 0 AND p.idgenero = 5
            UNION
            SELECT s.idserie AS id, concat('Serie') AS tipo, r.clave, g.nombre, c.clave, s.lanzamiento, s.titulo, s.rutaPortada
            FROM series AS s 
            LEFT JOIN regiones AS r ON s.idgenero = r.idregion
            LEFT JOIN generos AS g ON s.idgenero = g.idgenero
            LEFT JOIN clasificaciones AS c ON s.idclasificacion = c.idclasificacion
            WHERE s.eliminado = 0 AND s.idgenero = 5
            ";
        } elseif($get['type'] == "Suspenso") {
            $sql = "
            SELECT p.idpelicula AS id, concat('Pelicula') AS tipo, r.clave AS region, g.nombre AS genero, c.clave AS clasificacion, p.lanzamiento, p.titulo, p.rutaPortada
            FROM peliculas AS p 
            LEFT JOIN regiones AS r ON p.idgenero = r.idregion
            LEFT JOIN generos AS g ON p.idgenero = g.idgenero
            LEFT JOIN clasificaciones AS c ON p.idclasificacion = c.idclasificacion
            WHERE p.eliminado = 0 AND p.idgenero = 8
            UNION
            SELECT s.idserie AS id, concat('Serie') AS tipo, r.clave, g.nombre, c.clave, s.lanzamiento, s.titulo, s.rutaPortada
            FROM series AS s 
            LEFT JOIN regiones AS r ON s.idgenero = r.idregion
            LEFT JOIN generos AS g ON s.idgenero = g.idgenero
            LEFT JOIN clasificaciones AS c ON s.idclasificacion = c.idclasificacion
            WHERE s.eliminado = 0 AND s.idgenero = 8
            ";
        } else {
            $sql = "
            SELECT p.idpelicula AS id, concat('Pelicula') AS tipo, r.clave AS region, g.nombre AS genero, c.clave AS clasificacion, p.lanzamiento, p.titulo, p.rutaPortada, p.duracion
            FROM peliculas AS p
            LEFT JOIN regiones AS r ON p.idgenero = r.idregion
            LEFT JOIN generos AS g ON p.idgenero = g.idgenero
            LEFT JOIN clasificaciones AS c ON p.idclasificacion = c.idclasificacion
            WHERE p.eliminado = 0 AND p.idgenero = $tipo";
        }
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

    public function listAdmin()
    {
        $this->response = array();
        $sql = "
            SELECT p.idpelicula AS id, concat('Pelicula') AS tipo, r.clave AS region, g.nombre AS genero, c.clave AS clasificacion, p.lanzamiento, p.titulo, p.eliminado, p.rutaPortada as imagen
            FROM peliculas AS p 
            LEFT JOIN regiones AS r ON p.idgenero = r.idregion
            LEFT JOIN generos AS g ON p.idgenero = g.idgenero
            LEFT JOIN clasificaciones AS c ON p.idclasificacion = c.idclasificacion
            UNION
            SELECT s.idserie AS id, concat('Serie') AS tipo, r.clave, g.nombre, c.clave, s.lanzamiento, s.titulo, s.eliminado, s.rutaPortada as imagen
            FROM series AS s 
            LEFT JOIN regiones AS r ON s.idgenero = r.idregion
            LEFT JOIN generos AS g ON s.idgenero = g.idgenero
            LEFT JOIN clasificaciones AS c ON s.idclasificacion = c.idclasificacion
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
            'mensaje' => 'El elemento ya existe en la base de datos'
        );
        if($post['tipoElemento'] == 'Pelicula')
        {
            if (isset($post['title'])) {
                $sql = "
                    SELECT * FROM peliculas WHERE titulo = '{$post['title']}'
                    ";
                $result = $this->conexion->query($sql);
                if ($result->num_rows == 0) {
                    $this->conexion->set_charset("utf8");
    
                    $sql = "
                        INSERT INTO peliculas (idpelicula, idregion, idgenero, idclasificacion, lanzamiento, titulo, duracion, rutaPortada) VALUES
                        (null, '{$post['region']}', '{$post['genre']}', '{$post['clasification']}', '{$post['year']}', '{$post['title']}', '{$post['duration']}', '{$post['image']}')
                        ";
    
                    if ($this->conexion->query($sql)) {
                        $this->response['estatus'] =  "Correcto";
                        $this->response['mensaje'] =  "La película se agregó correctamente";
                    } else {
                        $this->response['mensaje'] = "No se pudo ejecutar la instrucción $sql. " . mysqli_error($this->conexion);
                    }
                }
                $result->free();
            }    
        }
        else{
            if (isset($post['title'])) {
                $sql = "
                    SELECT * FROM series WHERE titulo = '{$post['title']}'
                    ";
                $result = $this->conexion->query($sql);
                if ($result->num_rows == 0) {
                    $this->conexion->set_charset("utf8");
    
                    $sql = "
                        INSERT INTO series (idserie, idregion, idgenero, idclasificacion, lanzamiento, titulo, numTemporadas, totalCapitulos, rutaPortada) VALUES
                        (null, '{$post['region']}', '{$post['genre']}', '{$post['clasification']}', '{$post['year']}', '{$post['title']}', '{$post['seasons']}', '{$post['chapters']}', '{$post['image']}')
                        ";
    
                    if ($this->conexion->query($sql)) {
                        $this->response['estatus'] =  "Correcto";
                        $this->response['mensaje'] =  "La serie se agregó correctamente";
                    } else {
                        $this->response['mensaje'] = "No se pudo ejecutar la instrucción $sql. " . mysqli_error($this->conexion);
                    }
                }
                $result->free();
            }            
        }
        $this->conexion->close();
    }

    public function edit($post)
    {
        $this->response = array(
            'estatus'  => 'Error',
            'mensaje' => 'La película o serie no existe en la base de datos'
        );
        if (isset($post['id'])) {
            if ($post['tipoElemento'] == 'Pelicula') {
                $sql = "
                    UPDATE peliculas SET idregion = '{$post['region']}', idgenero = '{$post['genre']}', idclasificacion ='{$post['clasification']}', lanzamiento = '{$post['year']}', titulo = '{$post['title']}', duracion = '{$post['duration']}', rutaPortada = '{$post['image']}', eliminado = '{$post['available']}' WHERE idpelicula = '{$post['id']}'
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
                UPDATE series SET idregion = '{$post['region']}', idgenero = '{$post['genre']}', idclasificacion ='{$post['clasification']}', lanzamiento = '{$post['year']}', titulo = '{$post['title']}', numTemporadas = '{$post['seasons']}', totalCapitulos = '{$post['chapters']}', rutaPortada = '{$post['image']}', eliminado = '{$post['available']}' WHERE idserie = '{$post['id']}'
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

    public function searchAdmin($get)
    {
        $this->response = array();
        if (isset($get['search'])) {
            $sql = "
                SELECT * FROM (
                    SELECT p.idpelicula AS id, concat('Pelicula') AS tipo, r.clave AS region, r.descripcion, g.nombre AS genero, c.clave AS clasificacion, c.publico, p.lanzamiento, p.titulo, p.rutaPortada AS imagen, p.eliminado
                    FROM peliculas AS p
                    LEFT JOIN regiones AS r ON p.idgenero = r.idregion
                    LEFT JOIN generos AS g ON p.idgenero = g.idgenero
                    LEFT JOIN clasificaciones AS c ON p.idclasificacion = c.idclasificacion
                    UNION
                    SELECT s.idserie AS id, concat('Serie') AS tipo, r.clave AS region, r.descripcion, g.nombre AS genero, c.clave AS clasificacion, c.publico, s.lanzamiento, s.titulo, s.rutaPortada AS imagen, s.eliminado
                    FROM series AS s 
                    LEFT JOIN regiones AS r ON s.idgenero = r.idregion
                    LEFT JOIN generos AS g ON s.idgenero = g.idgenero
                    LEFT JOIN clasificaciones AS c ON s.idclasificacion = c.idclasificacion
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

    public function single($post){
        $id = $post['id'];
        $tipo = $post['tipo'];
        if($tipo == 'Pelicula'){
            $query = "SELECT * FROM peliculas WHERE idpelicula = $id";
            $result = mysqli_query($this->conexion, $query);
            if(!$result){
                die('Query fallida.');
            }        
            $this->response = array();
            while($row = mysqli_fetch_array($result)){
                $this->response = array(
                    'id' => $row['idpelicula'],
                    'region' => $row['idregion'],
                    'genero' => $row['idgenero'],
                    'clasificacion' => $row['idclasificacion'],
                    'lanzamiento' => $row['lanzamiento'],
                    'titulo' => $row['titulo'],
                    'duracion' => $row['duracion'],
                    'imagen' => $row['rutaPortada'],
                    'eliminado' => $row['eliminado']
                );      
            }
        }
        else
        {
            $query = "SELECT * FROM series WHERE idserie = $id";
            $result = mysqli_query($this->conexion, $query);
            if(!$result){
                die('Query fallida.');
            }
        
            $this->response = array();
            while($row = mysqli_fetch_array($result)){
                $this->response = array(
                    'id' => $row['idserie'],
                    'region' => $row['idregion'],
                    'genero' => $row['idgenero'],
                    'clasificacion' => $row['idclasificacion'],
                    'lanzamiento' => $row['lanzamiento'],
                    'titulo' => $row['titulo'],
                    'temporadas' => $row['numTemporadas'],
                    'capitulos' => $row['totalCapitulos'],
                    'imagen' => $row['rutaPortada'],
                    'eliminado' => $row['eliminado']
                );      
            }
        }

    }
}
