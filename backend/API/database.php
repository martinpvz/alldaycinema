<?php

namespace DataBase;

abstract class Database
{
    protected $conexion;
    protected $response;

    public function __construct($string)
    {
        $this->conexion = @mysqli_connect(
            'localhost',
            'root',
            'Martin.13',
            $string
        );
        if (!$this->conexion) {
            die('No se pudo conectar a la base de datos');
        }
    }
}
