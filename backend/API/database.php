<?php
    namespace API;
    
    abstract class Database{
        protected $conexion;
        //protected $response;

        public function __construct($nameBd = 'vod')
        {
            $this -> conexion = @mysqli_connect(
                'localhost',
                'root',
                'faafaite',
                $nameBd
            );
            if (!$this->conexion ){
                echo "Error en la conexion";
            }
            $this->response = "";
        }

        // Función getResponse
        // public function getResponse(){
        //     return json_encode($this->response, JSON_PRETTY_PRINT);
        // }
    }
?>